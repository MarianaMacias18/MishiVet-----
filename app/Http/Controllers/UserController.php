<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{   // Metodos del Registro de Usuarios -----------------------------------
    public function create(){
      return view('Users.create');
    }
    public function store(StoreUserRequest $request){
        $user = new User($request->all());
        $user->password = Hash::make($request->password);
        $user->save();
     // Redirigir al Login
    return redirect()->route('users.show');
    }
// ------------------------------------------------------------------------
// Metodos de Login de Usuarios 
    public function show(){
        return view('Users.show');
    }
    public function login(Request $request)
    {
        // Validar las credenciales del usuario
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    
        // Intentar autenticar al usuario
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Autenticación exitosa
            return view('dashboard');
            
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
        return redirect()->route('users.login'); 
    }
// ------------------------------------------------------------------------
}

