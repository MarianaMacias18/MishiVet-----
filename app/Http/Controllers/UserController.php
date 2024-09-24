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
        
         // Intentar autenticar al usuario y pasar el valor de 'remember' en caso de tenerlo
        $remember = $request->has('remember'); // Verifica si la casilla de "Recordar sesión" fue marcada

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
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
        return redirect()->route('users.show'); 
    }
// ------------------------------------------------------------------------
// EDIT, UPDATE and DELETE User
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
            return redirect()->route('users.show')->with('success', 'Tú perfil en MishiVet ha sido eliminado correctamente.');
        }   
}

