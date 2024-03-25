<?php

namespace App\Http\Controllers;

use App\Models\YourModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Jobs\SendEmailJob;


class NewCOntroller extends Controller
{
  public function table_mail(Request $request){
    // $emailIds = $request->input('email_ids');

    // $array = explode(",", $emailIds);

    // $email_id_send = DB::table('json')->whereIn('id', $array)->get('email');
    //   $details = ['email' => $email_id_send];
    //   SendEmailJob::dispatch($details);
    //   //------------ to delay email---------
    //   // $emailJob = (new SendEmailJob($details))->delay(now()->addMinutes(3));
    //   // dispatch($emailJob);
    //   echo "Email sent successfully!! <br><br> <br> <a href='/home'> go back to home</a>";
  }
  public function mail(Request $request){
    $details = ['email' => 'maira.yousaf@teknohus.com'];
    SendEmailJob::dispatch($details);
    echo "Email sent successfully!!";
  }
  public function register(){
      return view('register');
  }
  public function registerPost(Request $request){
    // $request->validate([
    //   'name'=>'required',
    //   'email'=>'required|unique:users|email',
    //   'password'=>'required',
    // ]);
    // User::create([
    //   'name'=>$request->name,
    //   'email'=>$request->email,
    //   'password'=> \Hash::make($request->password)
    // ]);
    // // dd($request);
    // // dd($new);
    // if(\Auth::attempt($request->only('email','password'))){
    //   return redirect('landingpage');
    // }
    // return redirect('register')->with('error','error');
    $user = new User();
 
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);

    $user->save();
    return back()->with('success', 'Register successfully');
  }
  public function showlogin(){
    return view('welcome');
  }
  public function login(Request $request){
    $credentials = [
      'email' => $request->email,
      'password' => ($request->password)
  ];

  if (Auth::attempt($credentials)) {
    $users = DB::table('json')->orderByDesc('id')->paginate(4);
      return view('landingpage',['data'=>$users]);
  }
  return back()->with('error', 'Error Email or Password');
  }
   public function showhome(){
    $users = DB::table('json')->orderByDesc('id')->paginate(4);
      return view('landingpage',['data'=>$users]);
   }
   public function showabout(){
    return view('about');
  }
  public function showcontact(){
    return view('contact');
  }
  public function logout()
  {
    \Session::flush();
      \Auth::logout();
      return redirect()->route('login');
  }

  public function showtable(Request $request){
      $query = $request->input('query');
      if(!empty($query)){
        $users = DB::table('json')
                  ->where('id',$query)
                  ->orWhere('name', 'like', '%'.$query.'%')
                  ->orWhere('address', 'like', '%'.$query.'%')
                  ->orWhere('email', 'like', '%'.$query.'%')
                  ->orWhere('phone', 'like', '%'.$query.'%')
                  ->paginate(4);
        // return $users;
        // dd($users);
        return view('landingpage', ['data' => $users]);
        
      }else{
      $users = DB::table('json')->paginate(4);
      return view('landingpage',['data'=>$users]);
      } 
  }
  public function insertrecord(Request $request){
    $name = $request->input('name');
    $email = $request->input('email');
    $address = $request->input('address');
    $phone = $request->input('phone');
    $users = DB::table('json')->get();
    $check = DB::table('json')->where('email', $email)->get();

    if($name != NULL && $email != NULL && $address != NULL && $phone != NULL){
      $existingUser = DB::table('json')->where('email', $email)->first();
      if ($existingUser) {
        echo '<script>alert("data already exit!");</script>';
      } else {
          DB::table('json')->insert([
              'name' => $name,
              'email' => $email,
              'address' => $address,
              'phone' => $phone
          ]);
          return back()->with('success', 'Added successfully!');
      }
  }
    
  }
  public function delallrecord(Request $req){
    DB::table('json')->delete(); 
    $users = DB::table('json')->paginate(4);
    return view('landingpage', ['data' => $users]);
}
 
  public function delrecord(string $id){

      DB::table('json')->where('id',$id)->delete();
      // dd($id);
        $users = DB::table('json')->paginate(4);
      return view('landingpage', ['data' => $users]);
      if($users){
        return redirect()->route('home');
      }
  }
  public function updatedrecord(string $id){

   $user = DB::table('json')->where('id',$id)->get();
   return view('updatedata', ['data' => $user]);
  // return $user;
    // dd($id);
    
    
}
 public function edit(Request $request, string $id){
  $name = $request->input('E-name');
  $email = $request->input('E-email');
  $address = $request->input('E-address');
  $phone = $request->input('E-phone');
  // dd($request);

  if($name != NULL && $email != NULL && $address != NULL && $phone != NULL){
        $user = DB::table('json')->where('id',$id)->update([
            'name' => $name,
            'email' => $email,
            'address' => $address,
            'phone' => $phone
        ]);
        $users = DB::table('json')->orderByDesc('id')->paginate(4);
        return view('landingpage', ['data' => $users]);
    }
}


}