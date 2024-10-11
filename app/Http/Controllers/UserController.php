<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Mail\VerificationEmail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class UserController extends Controller
{   // Metodos del Registro de Usuarios -----------------------------------
    public function create(){
      return view('Users.create');
    }
    public function store(StoreUserRequest $request) //Almacenar y enviar un correo electronico 
    {
        $user = new User($request->all());
        $user->password = Hash::make($request->password);
        $user->email_verification_hash = sha1($user->email); 
        $user->save();
        //URL de verificación con el id y el hash del email
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify', // Ruta de verificación
            now()->addMinutes(60), // Tiempo de expiración
            [
                'id' => $user->id,
                'hash' => $user->email_verification_hash,
                'redirect' => route('verification.verify', ['id' => $user->id, 'hash' => $user->email_verification_hash])
            ]
        );
        // Enviar el correo de verificación al usuario
        Mail::to($user->email)->send(new VerificationEmail($user, $verificationUrl));
        Auth::login($user);

        return redirect()->route('verification.notice')
        ->with('success', '¡Te has registrado exitosamente! Por favor, revisa tu correo electrónico para verificar tu cuenta.')
        ->with('user', $user); 
    }

// ------------------------------------------------------------------------
// Metodos de Login de Usuarios 
    public function loginshow(){
        return view('Users.loginshow');
    }
    public function login(Request $request)
    {
        // Validar las credenciales del usuario
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        
         // Intentar autenticar al usuario y pasar el valor de 'remember' en caso de tenerlo
        $remember = $request->has('remember'); // Verifica si la casilla de "Recordar sesión" fue marcada

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            // Autenticación exitosa
            session(['first_login' => true]);
            return redirect()->route('dashboard.index');
        }
    
        // Redirigir de vuelta con un mensaje de error
        return back()->withErrors([
            'email' => 'Las credenciales son incorrectas.',
        ]);
    }
    public function logout(Request $request){
        
        Auth::logout();                        #Log out
        $request->session()->invalidate();      #Invalidate session
        $request->session()->regenerateToken(); #Regenerate security token
        Session::flush();                       #Release the session flow
        return redirect()->route('users.loginshow'); 
    }
// ------------------------------------------------------------------------
// SHOW, EDIT, UPDATE and DELETE User
        public function show(User $user){
                        
            return view('Users.show',[
                'user'=> $user,
            ]);
        }
        public function edit(User $user){
                
            return view('Users.edit',[
                'user'=> $user,
            ]);
        }
        public function update(Request $request, User $user)
        {
            $request->validate([
                'name' => 'required|alpha_spaces|max:60', 
                'apellidoP' => 'required|alpha_spaces|max:50',
                'apellidoM' => 'required|alpha_spaces|max:50',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id, 
                'password' => 'nullable|string|min:8|confirmed',
                'telefono' => 'required|phone',
                'direccion' => 'required|string',
            ]);
        
            // Asignación masiva de los campos que no son la contraseña
            $user->fill($request->except('password')); 
            // Encriptar la contraseña 
            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }
            $user->save(); 
            return redirect()->route('users.edit', $user->name)
                             ->with('success', '¡Actualizaste tus datos correctamente!');
        }
        public function destroy(Request $request, User $user) 
        {
            $user->delete();
            //$deletedUsers = User::onlyTrashed()->get(); // Recupera los usuarios eliminados
            //$user = User::withTrashed()->find($id); // Restaura un usuario eliminado en "Softdeletes"
            //$user->restore();
            //$user->forceDelete(); // Forza un eliminado permanente
            Auth::logout();
            // Invalidar sesión
            Session::flush();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            // Redirigir al login con un mensaje 
            return redirect()->route('users.loginshow')->with('success', 'Tú perfil en MishiVet ha sido eliminado correctamente.');
        }   
    // ----------------------------------------------------------------------------------
    // Confirmación de correo electronico exitosa
        public function verify(EmailVerificationRequest $request)
        {
            if (!auth()->check()) {
                // Si el usuario no está autenticado
                return redirect()->route('users.loginshow')->with('error', 'La verificación de correo ha expirado.');
            }
            // Verifica el correo electrónico
            $request->fulfill();
            
            // Autenticar al usuario
            Auth::login($request->user());

            // Configurar la sesión para indicar que el usuario ha iniciado sesión
            session(['first_login' => true]);

            // Redirigir a la página deseada
            return redirect()->route('dashboard.index')
                ->with('success', 'Tu correo ha sido verificado y has sido autenticado automáticamente.');
        }
        // Reenvio de correo electronico
        public function resendVerificationEmail()
        {
            // Decodificar el JSON para obtener el usuario
            $user = auth()->user();

            // Verificar si el usuario está presente
            if (!$user) {
                return back()->with('error', 'No se encontró al usuario. Por favor, intenta registrarte nuevamente.');
            }
            // Generar la URL de verificación con el id y el hash del email
            $verificationUrl = URL::temporarySignedRoute(
                'verification.verify', // Ruta de verificación
                now()->addMinutes(60), // Tiempo de expiración
                [
                    'id' => $user->id,
                    'hash' => $user->email_verification_hash,
                    'redirect' => route('verification.verify', ['id' => $user->id, 'hash' => $user->email_verification_hash])
                ]
            );

            // Enviar el correo de verificación al usuario
            Mail::to($user->email)->send(new VerificationEmail($user, $verificationUrl));

            return redirect()->route('verification.notice')
            ->with('success', '¡Correo reenviado correctamente!')
            ->with('user', $user);  
        }

}

