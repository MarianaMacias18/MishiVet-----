<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomEmailVerificationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Mail\VerificationEmail;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
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

        // Verificacion de Correo por medio de Mailtrap <-
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
        

        // Sin verificacion de correo al iniciar sesion 
        // $user->email_verified_at = now(); // Se verifica el email sin correo para tests
        //Auth::login($user);
        //$user->save();
        //return redirect()->route('users.loginshow')->with('success', '¡Te has registrado exitosamente! Inicia sesión para continuar.');

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
            return redirect()->route('dashboard.index')->with('success', '¡Has iniciado sesión exitosamente!');
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
            // Validar los campos del formulario
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'apellidoP' => 'required|string|max:255',
                'apellidoM' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'telefono' => 'nullable|string|max:20',
                'direccion' => 'nullable|string|max:255',
                'password' => 'nullable|string|min:8|confirmed',
                'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'delete_avatar' => 'nullable|boolean',
            ]);
           
            // Se hashéa la contraseña antes de actualizar <-
            if (!empty($validatedData['password'])) {
                $validatedData['password'] = bcrypt($validatedData['password']);
            } else {
                unset($validatedData['password']); // Elimina la contraseña si no se proporciona
            }
            //dd($validatedData);

            // Actualizar el usuario con los nuevos datos
            $user->update($validatedData);

            // Maneja la eliminación del avatar o img
            if ($request->has('delete_avatar') && $request->delete_avatar) {
                // Elimina la imagen actual si existe
                if ($user->avatar && !filter_var($user->avatar, FILTER_VALIDATE_URL)) {
                    Storage::delete('public/avatars/' . $user->avatar);
                    $user->avatar = null;  // Eliminar referencia a la imagen en la base de datos
                }
            }

            // Maneja la subida de una nueva imagen de avatar
            if ($request->hasFile('avatar')) {
                if ($user->avatar && !filter_var($user->avatar, FILTER_VALIDATE_URL)) {
                    // Eliminar la imagen anterior si existe y no es una URL externa
                    Storage::delete('public/avatars/' . $user->avatar);
                }

                // Guardar la nueva imagen
                $avatarPath = $request->file('avatar')->store('avatars', 'public');
                $user->avatar = basename($avatarPath); // Guardar solo el nombre del archivo
            }

            $user->save(); // Guarda todos los cambios en el modelo
            // Redirigir con un mensaje de éxito
            return redirect()->route('users.edit', $user)->with('success', 'Perfil actualizado exitosamente.');
        }


        public function destroy(Request $request, User $user) 
        {

            // Verifica si existe un avatar ligado al Usuario
            if ($user->avatar) {
                // Ruta completa al archivo en el disco 'public'
                $fotoPath = 'avatars/' . $user->avatar;
    
                if (Storage::disk('public')->exists($fotoPath)) {
                    Storage::disk('public')->delete($fotoPath); // Elimina la imagen almacenada en public
                }
            }

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
        public function verify(CustomEmailVerificationRequest $request)
        {
            try {
                $user = $request->user();

                if ($user->hasVerifiedEmail()) {
                    return redirect()->route('dashboard.index')->with('danger', 'Tu correo ya ha sido verificado previamente.');
                }

                $request->fulfill();

                Auth::login($user);
                session(['first_login' => true]);

                return redirect()->route('dashboard.index')
                    ->with('success', 'Tu correo ha sido verificado y has sido autenticado automáticamente.');

            } catch (AuthorizationException $e) {
                return redirect()->route('users.loginshow')->with('error', $e->getMessage());
            }
        }
        // Reenvio de correo electronico
        public function resendVerificationEmail()
        {
         
            $user = auth()->user();

            // Verificar si el usuario está presente
            if (!$user) {
                return back()->with('danger', 'No se encontró al usuario. Por favor, intenta registrarte nuevamente.');
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

