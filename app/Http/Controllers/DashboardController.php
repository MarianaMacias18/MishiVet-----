<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use App\Models\Kitten;
use App\Models\Notification;
use App\Models\Shelter;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Stripe\Charge;
use Stripe\Stripe;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtiene todos los mishis que no pertenecen al usuario autenticado y que tienen el estado "pendiente" o "libre"
        $kittens = Kitten::whereDoesntHave('owner', function($query) {
            $query->where('id', auth()->id()); // Excluye los mishis del usuario autenticado
        })
        ->whereIn('estado', ['apartado', 'libre']) // Filtra solo mishis con estado "apartado" o "libre"
        ->orderByRaw("FIELD(estado, 'libre') DESC") // Ordena los resultados, primero los 'libre' y después los 'apartado'
        ->get();
        
        return view('dashboard', compact('kittens'));
    }
    public function nosotros(){
        return view('nosotros');
    }
    public function notificaciones(){ // Notificaciones de adopcion
         // Obtener las notificaciones del usuario logueado como "solicitante" de Mishis
        $notifications = auth()->user()->customNotifications;
       
        return view('notificaciones', compact('notifications'));
    }
    public function ADMINnotificaciones() {
        // Obtiene las notificaciones del usuario logueado como "dueño" de Shelters
        $userId = auth()->user()->id;
    
        // Obtiene las notificaciones del usuario autenticado como "dueño"
        $notificaciones = Notification::with(['kitten', 'usuarioSolicitante'])
            ->whereIn('estado_notificacion', ['aceptada', 'rechazada'])
            ->where('id_usuario_solicitante', $userId) 
            ->get();
            
        return view('admin_notificaciones', compact('notificaciones'));
    }
    #----------------------------------------------------------------------------------------------
    public function kitten(Kitten $kitten) // Mostrar Mishi en adopción de forma individual
    {
        // Obtener el refugio al que pertenece el mishi
        $shelter = $kitten->shelter; 
        // Obtener los eventos relacionados con el refugio
        $events = $shelter ? $shelter->events : collect(); // Verifica si hay un refugio antes de acceder a los eventos

        return view('Adoptions.kitten', compact('kitten', 'shelter', 'events'));
    }
    #----------------------------------------------------------------------------------------------
    #----------------------------------------------------------------------------------------------
    public function generarPDF(Kitten $kitten){ //PDF
        
        $shelter = $kitten->shelter; //Obtiene el Shelter al que pertenece el Kitten 
        
        //Carga la vista del PDF con los datos del Kitten y el Shelter respectivamente 
        $pdf = Pdf::loadView('Adoptions.pdf', [
            'kittens' => $kitten,
            'shelters' => $shelter,
        ]);

        //En lugar de retornar una vista, retorna la descarga del PDF en el navegador
        return $pdf->download('MishiVet_adoption_details.pdf'); 
        //return view('Adoptions.pdf');
    }
    #----------------------------------------------------------------------------------------------
    #----------------------------------------------------------------------------------------------
    public function generarDONACION(Kitten $kitten) { // Sistema Pago/Donacion
        return view('Adoptions.payment', compact('kitten'));
    }
    public function donations() { // Sistema Pago/Donacion
        // Obtiene las donaciones del usuario autenticado <-
        $donations = Donation::where('id_usuario_beneficiario', Auth::id())->get();
        return view('Adoptions.donations', compact('donations'));
    }
    public function pay(Request $request, Shelter $shelter) 
    {
        // Validar la entrada
        $request->validate([
            'amount' => 'required|numeric|min:10|max:10000', // Valida que el monto sea numérico y este entre 5 y 10000
            'stripeToken' => 'required', // Token requerido
            'payment_method' => 'required|string', // Validación del método de pago
        ]);

        // Configura la clave de API de Stripe
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            // Crea el cargo en pesos mexicanos
            $charge = Charge::create([
                'amount' => $request->amount * 100, // Monto en centavos
                'currency' => 'mxn', // Moneda en pesos mexicanos
                'source' => $request->stripeToken,
                'description' => '¡Hola MishiEmpresario! Has recibido una donación para el Refugio: ' . $shelter->nombre, 
            ]);

            // Crea la donacion
            Donation::create([
                'amount' => $request->amount, // Cantidad
                'date' => now(), // Fecha actual
                'numero_tarjeta' => $charge->payment_method_details->card->last4 ?? null, // Últimos 4 dígitos de la tarjeta
                'token' => $charge->id, // Token de pago de Stripe
                'id_usuario_beneficiario' => $shelter->id_usuario_dueño, // ID del usuario beneficiario (dueño del refugio)
                'id_refugio_beneficiario' => $shelter->id, // ID del refugio
                'id_usuario_donador' => auth()->id(), // ID del usuario autenticado
                'payment_method' => $request->payment_method, // Método de pago
            ]);

            // Redirige
            return redirect()->route('dashboard.index')->with('success', '¡Mishi éxito! Has realizado tú donación con éxito al refugio.');
        } catch (\Exception $e) {
            // Redirigir con error
            return redirect()->back()->with(['danger' => $e->getMessage()]);
        }
    }

   

}
