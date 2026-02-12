
<?php

//namespace App\Http\Controllers;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{
    // This method will show login page  for customer
    public function index() {
       return view('login');
    }
     // This method will authenticte user 
    public function authenticate(Request $request)
{
    $request->validate([
    'email' => 'required|email',
       'password' => 'required|min:6'
   ]);
         // if($validator->passes()){
             
           // $user = new User();
           // $user->name = $request->name;
           // $user->email = $request->email;
           // $user->password =  Hash::make($request->password);
           // $user->role = 'customer';
           //  $user->save();

    if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){

        $request->session()->regenerate(); // session create karega

       return redirect()->route('account.dashboard');
    }

    return redirect()->route('account.login')
        ->with('error','Either email or password is incorrect.');
}

 
           

      // return redirect()->route('account.login')->with('success','You have registered successfully');

      //if(Auth::attempt(['email' => $request->email,'password' => $request->password])){
       //   return redirect()->route('account.dashboard');
        //}else{
          //    return redirect()->route('account.login')->with('error','Either email or password is incorrect.');

            public function logout(){
             Auth::logout();
            return redirect()->route('account.login');
  }   
        }


     return redirect()->back()
      ->withErrors($validator)
      ->withInput();
//}

//}

