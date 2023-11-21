<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\admin;
use Illuminate\Support\Facades\DB;
use App\Models\organization;


class adminController extends Controller
{

    public function loginAdmin()
    {
        return view('auth.login_admin');
        
    }  
    
    public function adminLogin(Request $request)
    {
        $request->validate([
            'adminID' => 'required',
            'password' => 'required',
        ]);
      
        $adminUser = admin::where('name', '=', $request->adminID)->first();

        if(!$adminUser){
            return back()->with('fail','We do not recognize this account');
        }else{
            if(Hash::check($request->password,$adminUser->password)){
                $request->session()->put('AdminUser',$adminUser->id);
                return redirect("adminDashboard");
            }else{
                return back()->with('fail', 'Incorrect Password');
            }
        }
  
    }  
    
    function adminDashboard(){
        $data = ['AdminUser'=>admin::where('id','=', session('AdminUser'))->first()];
        $organizations = DB::select('select * from organizations');

       // $active = organization::where('Status','Active')->count();
        //$pending = organization::where('Status','Pending')->count();
        $pending = organization::where('Status','=','Pending')->count();
        $active = organization::where('Status','=','Active')->count();
        return view('admin.home_admin')
                    ->with($data)
                    ->with(['organizations'=>$organizations])
                    ->with('pending',$pending)
                    ->with('active',$active);
    }

    function viewOrganization(){
        $data = ['AdminUser'=>admin::where('id','=', session('AdminUser'))->first()];
        $organizations = DB::select('select * from organizations');
        return view('admin.view-organization')
                    ->with($data)
                    ->with(['organizations'=>$organizations]);
    }


    function activityLog(){
        $data = ['AdminUser'=>admin::where('id','=', session('AdminUser'))->first()];
        return view('admin.log-files', $data);
    }

    function orgProfile(Request $request, $id){
        $data = ['AdminUser'=>admin::where('id','=', session('AdminUser'))->first()];
        //$id=organization::where('id','=',$id)->first();
        $id = organization::where('id', $id)->first();
        //return view('tampilkan', ['user' => $user]);

        return view('admin.organization-details',['id' => $id])
                    ->with($data);
    }


    function logout(){
        if(session()->has('AdminUser')){
            session()->pull('AdminUser');
            return redirect('loginAdmin');
        }
    }



/*    
    public function customRegistration(Request $request)
    {  
        $request->validate([
            'adminID' => 'required',
            'password' => 'required'
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
        return redirect('loginAdmin');
    }

    public function create(array $data)
    {
        return admin::create([
            'name' => $data['adminID'],
            'password' => Hash::make($data['password']),
        ]);
    }  
*/  
    
  
}
