<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\organization;
use App\Models\voter;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Illuminate\Support\Carbon;
use PDF;

class CustomAuthController extends Controller
{
    
    public function index()
    {
        return view('index');
    }

    public function login()
    {
        return view('auth.login_organization');
    } 

    public function forgot(){
        return view('auth.identify');
    }

    function searchEmail(Request $request){
        $user = organization::where('email', '=', $request->email)->first();

        if($user){
            $request->session()->put('data',$user);
            return redirect()->route('change.password');
        }else{
            return back()->with('fail',"Email does not exist");
        }
    }

    public function changePassword(){
        $data =  session('data');
        return view('auth.password-reset')->with(['data' => $data]);
    }

    public function registration()
    {
        return view('auth.signup_organization');
    }
      

    public function otpForm(){
        $data = session('LoggedUser1');
        return view('auth.verify-otp')->with(['email' => $data]);
    }
     

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
      
        $userLogin = organization::where('email', '=', $request->email)->first();
        $user = [];
        if($userLogin && Hash::check($request->password,$userLogin->password)){
            $code = mt_rand(100000,999999);
            $content = ['name' => $userLogin->fname . " " . $userLogin->lname,
                    'message' => "Here's your One-time password",
                     'code' => $code];
            $userOtp = organization::where('email','=',$request->email)->update(['token' => $code]);
            $request->session()->put('LoggedUser1',$request->email);
            Mail::to($request->email)->send(new SendMail($content));
            return redirect()->route('otp.form');
            
        }else{
            return back()->with('fail', 'Invalid email and password');
        }
      
    }

    public function submitOtp(Request $request){

        $otpBoxes = $request->first . $request->second . $request->third . $request->fourth . $request->fifth . $request->sixth;
        $user = organization::where([['email','=',session('LoggedUser1')],['token','=',$otpBoxes]])->first();
        if($user){
            $request->session()->put('LoggedUser',$user->id);
            session()->pull('LoggedUser1');
            return response()->json([
                'status' => true,
            ]);
        }else{
            // return back()->with('fail', 'Invalid Code');
            return response()->json([
                'status' => false,
                'msg' => 'Invalid Code',
            ]);
        }
        
    } 

    function resendOtp($email){
        $code = mt_rand(100000,999999);
        organization::where('email','=',$email)->update(['token' => $code]);
        $content = ['message' => "Here's your One-time password",
                     'code' => $code];

        Mail::to($email)->send(new SendMail($content));

        return back();

    }

    public function customRegistration(Request $request)
    {         
     $valid = $request->validate([
            'orgName' => 'required|unique:organizations',
            'lname' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:organizations',
            'password' => 'required|min:8',
            'NoS' => 'required',
            'PoS' => 'required',
            $request,
                    [   
                        'orgName.unique' => 'This Organization Name has already been taken.',
                        'email.unique'   => 'This Email has already been taken',
                    ]
        ]);

        
        $data = $request->all();
        
        if(!$valid){
            return back()->withErrors($valid);
        }else{
            $code = mt_rand(100000,999999);
            $data = array_merge($data, array("code"=>$code));

            $request->session()->put('registerUser',$data);
            
            $content = ['name' => $request->fname . " " . $request->lname,
                        'message' => "Here's your One-time password to confirm your Email",
                        'code' => $code]; 
                        
            Mail::to($request->email)->send(new SendMail($content));

            return redirect()->route('verify.form');
        }   
            
    }   

    public function verifyForm(){
        $data = session('registerUser');
        $email = $data['email'];
        return view('auth.verify-org',)
                ->with('registerUser', $data)
                ->with(['email' => $email]);
    }
    
    public function verifyOrg(Request $request){
        $data = session('registerUser');
        $otpBoxes = $request->first . $request->second . $request->third . $request->fourth . $request->fifth . $request->sixth;

        if($otpBoxes == $data['code']){
            $this->create($data); 
            session()->pull('registerUser');
            return response()->json([
                'status' => true,
            ]);  
            
        }else{

            // return back()->with('fail','Invalid Code');
            return response()->json([
                'status' => false,
                'msg' => 'Invalid Code',
            ]);
        } 
        
    }

    function resendToVerifyOrg($email){
        $data = session('registerUser');
        $code = mt_rand(100000,999999);
        $data = array_merge($data, array("code"=>$code));

        session()->put('registerUser',$data);

        $content = [
                    'message' => "Here's your One-time password to confirm your Email",
                    'code' => $code
                   ]; 
                        
        Mail::to($email)->send(new SendMail($content));

        return back();
    }

    public function create(array $data)
    {
      return organization::create([
        'orgName' => $data['orgName'],
        'lname' => $data['lname'],
        'fname' => $data['fname'],
        'mname' => $data['mname'],
        'address' => $data['address'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'NoS' => $data['NoS'],
        'PoS' => $data['PoS'],
        'Profile' => "img/user-icon.png",
        'Status' => "Active"      
      ]);
    } 

    function dashboard(){
        $data = ['LoggedUserInfo'=>organization::where('id','=', session('LoggedUser'))->first()];
        $date = DB::table('election_dates')
                    ->select('*')
                    ->where('id', session('LoggedUser'))
                    ->first();
        $position = Schema::hasTable('candidates'.session('LoggedUser'));
        $candidate = Schema::hasTable('candidates'.session('LoggedUser'));
        $count =[];
        if($position){
                $count = DB::select('SELECT COUNT(v.id) as voterCount, 
                (SELECT COUNT(p.position) FROM positions'.session('LoggedUser').' p) as positionCount,
                (SELECT COUNT(c.id) FROM candidates'.session('LoggedUser').' c where status = "active") as candidateCount
                FROM voters v LIMIT 1');
        }
        
                            
        return view('org.overview-organization', $data)
                    ->with(['date' => $date])
                    ->with(['position' => $position])
                    ->with(['candidate' => $candidate])
                    ->with(['users' => $count]);
    }

    public function orgProfile(){
        $data = ['LoggedUserInfo'=>organization::where('id','=', session('LoggedUser'))->first()];
        return view('org.org-profile', $data);
    }

    public function changeProfile(Request $request){
        $data = $request->all(); 
        if($request->hasFile('image')){
            $data = $request->all(); 
            $photo = $request->file('image');
            $photoDestinationPath = 'orgImage';
            $photoImage =  $photoDestinationPath . "/" . $photo->getClientOriginalName();
            $photo->move($photoDestinationPath, $photo->getClientOriginalName());
            $data['image'] = "$photoImage";
            DB::update('UPDATE organizations SET lname = ?, fname = ?, mname = ?, orgName = ?, address = ?, NoS = ?, PoS = ?, Profile = ? WHERE id = ?', 
                    [$data['lname'], $data['fname'], $data['mname'], $data['orgName'], $data['address'], $data['NoS'], $data['PoS'], $data['image'], session('LoggedUser')]);
        }else{
            DB::update('UPDATE organizations SET lname = ?, fname = ?, mname = ?, orgName = ?, address = ?, NoS = ?, PoS = ? WHERE id = ?', 
                    [$data['lname'], $data['fname'], $data['mname'], $data['orgName'], $data['address'], $data['NoS'], $data['PoS'], session('LoggedUser')]);
        }
    
    }

    public function changeEmail(Request $request){
        $valid = $request->validate(['email' => 'required|unique:organizations|email',]);
        
        if($valid){
            $user = organization::where('id','=',session('LoggedUser'))->first();
            $code = mt_rand(100000,999999); 

            organization::where('id','=',session('LoggedUser'))->update(['token' => $code]); 
            
            $content = ['name' => $user->fname. " " . $user->lname,
                        'message' => "Here's your One-time password to confirm your Email",
                        'code' => $code]; 
                       
            Mail::to($request->email)->send(new SendMail($content));

            $request->session()->put('newEmail',$request->email);
            return redirect()->route('change.email.otp');

        }else{
            return back()->withInput($request->input());
        }

    }

    public function changeEmailOtp(){
        $new = session('newEmail');
        return view('org.change-email')->with('new',$new);
    }

    function resendEmailOtp($email){
        $code = mt_rand(100000,999999);
        organization::where('id','=',session('LoggedUser'))->update(['token' => $code]);
        $content = ['message' => "Here's your One-time password",
                     'code' => $code];

        Mail::to($email)->send(new SendMail($content));

        return back();

    }

    function submitEmailOtp(Request $request){

        $otpBoxes = $request->first . $request->second . $request->third . $request->fourth . $request->fifth . $request->sixth;

        $user = organization::where([['id','=',session('LoggedUser')],['token','=',$otpBoxes]])->first();
        if($user){
            organization::where('id','=',session('LoggedUser'))->update(['email' => session('newEmail')]); 
            session()->pull('newEmail');
            return response()->json([
                'status' => true,
                'msg' => 'Invalid Code',
            ]);
           
        }else{
            return response()->json([
                'status' => false,
                'msg' => 'Invalid Code',
            ]);
        }

    }

    function createElection(Request $request){

        $request->validate(['name' => 'required|unique:election_dates',
                            'electionStart' => 'required',
                            'electionEnd' => 'required',
                            ]);
        $data = $request->all();
        DB::insert('insert into election_dates(id, name, startdate, enddate) values(?, ?, ?, ?)', 
        [   session('LoggedUser'), 
            $data['name'], 
            $data['electionStart'], 
            $data['electionEnd']
        ]);

        Schema::dropIfExists('positions'.session('LoggedUser'));
        Schema::dropIfExists('partylist'.session('LoggedUser'));
        Schema::dropIfExists('candidates'.session('LoggedUser'));
        Schema::dropIfExists('section'.session('LoggedUser'));
        Schema::dropIfExists('electionresult'.session('LoggedUser'));

        Schema::create('positions'.session('LoggedUser'), function (Blueprint $table) {
            $table->id('id');
            $table->string('position');
            $table->integer('maxWeight');
        });

        Schema::create('partylist'.session('LoggedUser'), function (Blueprint $table) {
            $table->id('id');
            $table->string('partyName');
            $table->string('abbreviate');
        });

        Schema::create('candidates'.session('LoggedUser'), function (Blueprint $table) {
            $table->id('id');
            $table->string('position');
            $table->string('partyList');
            $table->string('name');
            $table->string('gender');
            $table->date('bday');
            $table->string('email');
            $table->string('photo');
            $table->longText('info');
            $table->string('status');
        });

        Schema::create('section'.session('LoggedUser'), function (Blueprint $table){
            $table->string('cid');
            $table->string('section');
            $table->string('votes');
        });

        Schema::create('electionresult'.session('LoggedUser'), function (Blueprint $table) {
            $table->bigInteger('CandidateID');
            $table->string('Position');
            $table->string('Name');
            $table->bigInteger('Votes');
            $table->string('img');
            $table->string('status');
        });

        return redirect('dashboard');  
    }

    function resetElection(Request $request){
        $userLogin = organization::where('id', '=', session('LoggedUser'))->first();
        if(Hash::check($request->password,$userLogin->password)){
            DB::table('voters')
                ->where('id',session('LoggedUser'))
                ->delete();
            DB::table('election_dates')
                ->where('id',session('LoggedUser'))
                ->delete();

            Schema::dropIfExists('positions'.session('LoggedUser'));
            Schema::dropIfExists('partylist'.session('LoggedUser'));
            Schema::dropIfExists('candidates'.session('LoggedUser'));
            Schema::dropIfExists('section'.session('LoggedUser'));
            Schema::dropIfExists('electionresult'.session('LoggedUser'));
            return response()->json([
                'status' => true,
            ]);    
            
        }else{
            return response()->json([
                'status' => false,
                'msg' => 'Invalid Password',
            ]);
        }

    }


    function positions(){
        $data = ['LoggedUserInfo'=>organization::where('id','=', session('LoggedUser'))->first()];
        $positions[] = "";
        $checker = true;
        
        try{
            $date = DB::select('SELECT id FROM election_dates WHERE id = ? AND  NOW() BETWEEN startdate AND enddate OR NOW() > enddate',[session('LoggedUser')]);
            $positions = DB::select('SELECT p.position, p.maxWeight, (SELECT COUNT(Name) FROM candidates'.session('LoggedUser').' c WHERE p.position = c.position) AS Total FROM positions'.session('LoggedUser').'  p ORDER BY p.id ASC;');
            $checker  = true;
        }catch(Exception $e){
             $checker = false;
        }
       
        return view('org.positions', $data)
                    ->with(['positions' => $positions])
                    ->with(['checker' => $checker])
                    ->with(['date' => $date]);           
    }

    public function createPosition(Request $request){
        $request->validate([
            'position' => 'required|unique:positions'.session('LoggedUser'),
            'maxWeight' => 'required|numeric',    
        ]);
        $posData = $request->all();
        DB::insert('insert into positions'. session('LoggedUser') .' (position, maxWeight) values (?, ?)', [$posData['position'], $posData['maxWeight']]);
                  
    }

    public function createRepresentative(Request $request){      
        $request->validate([
            'representative' => 'required|unique:positions'.session('LoggedUser').',position'
        ]);
        $posData = $request->all();
        DB::insert('insert into positions'. session('LoggedUser') .' (position, maxWeight) values (?, ?)', [$posData['representative'], 1]);
                    
    }

    public function deletePosition(Request $request){
        $userLogin = organization::where('id', '=', session('LoggedUser'))->first();
        if(Hash::check($request->password,$userLogin->password)){
            DB::table('positions'.session('LoggedUser'))
                ->where('position',$request->positionName)
                ->delete();
            return response()->json([
                'status' => true,
            ]);      
        }else{
            return response()->json([
                'status' => false,
                'msg' => 'Invalid Password',
            ]);
        }
    }

    function partyList(){
        $data = ['LoggedUserInfo'=>organization::where('id','=', session('LoggedUser'))->first()];
        $checker = true;
        $partylist[] = "";
        try{
            $date = DB::select('SELECT id FROM election_dates WHERE id = ? AND  NOW() BETWEEN startdate AND enddate OR NOW() > enddate',[session('LoggedUser')]);
            $partylist = DB::select('SELECT p.id, p.partyName, p.abbreviate, 
                                (SELECT COUNT(c.partylist) FROM candidates'. session('LoggedUser') .' c WHERE p.partyName = c.partylist) AS Total
                                FROM partylist'. session('LoggedUser') .' p');
            $checker = true;
        }catch(Exception $e){
            $checker = false;
        }
        
        return view('org.partylist', $data)
                ->with(['partylists' => $partylist])
                ->with(['checker' => $checker])
                ->with(['date' => $date]);
    }

    function addparty(Request $request){
        $request->validate([
            'partyName' => 'required|unique:partylist'.session('LoggedUser'),
            'abbreviate' => 'required'
        ]);
        $data = $request->all();
        DB::insert('insert into partylist'. session('LoggedUser') .' (partyName, abbreviate) values (?, ?)', [$data['partyName'], $data['abbreviate']]);
    }

    public function deleteParty(Request $request){

        $request->validate(['password' => 'required']);

        $userLogin = organization::where('id', '=', session('LoggedUser'))->first();
        if(Hash::check($request->password,$userLogin->password)){
            DB::table('partylist'.session('LoggedUser'))
                ->where('id',$request->partyID)
                ->delete();      
            return response()->json([
                'status' => true,
            ]);    
        }else{  
            return response()->json([
                'status' => false,
                'msg' => 'Invalid Password',
            ]);
        }
    }

    function candidates(){
        $data = ['LoggedUserInfo'=>organization::where('id','=', session('LoggedUser'))->first()];
        $checker = true;
        $positions[] = "";
        $partylists[] = "";
        $candidates[] =  "";
        try{
            $date = DB::select('SELECT id FROM election_dates WHERE id = ? AND  NOW() BETWEEN startdate AND enddate OR NOW() > enddate',[session('LoggedUser')]);
            $positions = DB::select('select position from positions'.session('LoggedUser'));
            $partylists = DB::select('select partyName from partylist'.session('LoggedUser'));
            $candidates = DB::table('candidates'.session('LoggedUser').' as c')
                            ->select('c.id','c.name','c.photo','p.position','pl.partyName')
                            ->join('positions'.session('LoggedUser').' as p', 'c.position', '=', 'p.position')
                            ->join('partylist'.session('LoggedUser').' as pl','c.partyList','=', 'pl.partyName')
                            ->where('status',"active")
                            ->get();
            $checker = true;                
        }catch(Exception $e){
            $checker = false;
        }
        
        return view('org.candidates', $data)
                    ->with(['positions' => $positions])
                    ->with(['candidates' => $candidates])
                    ->with(['partylists' => $partylists])
                    ->with(['checker' => $checker])
                    ->with(['date' => $date]);
    }

    public function addCandidate(Request $request){
        $data = $request->all();
        $request->validate([
            'position' => 'required',
            'partylist' => 'required',
            'candidateName' => 'required',
            'gender' => 'required',
            'bdate' => 'required|date',
            'email' => 'required|email|unique:candidates'.session('LoggedUser'),
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  
            'info' => 'required',           
        ]);
        if($request->hasFile('image')){
            
            $photo = $request->file('image');
            $photoDestinationPath = 'orgImage';
            $photoImage =  $photoDestinationPath . "/" . $photo->getClientOriginalName();
            $photo->move($photoDestinationPath, $photo->getClientOriginalName());
            $data['image'] = "$photoImage";

            //$loggedUser = ['LoggedUserInfo'=>organization::where('id','=', session('LoggedUser'))->first()];
            DB::insert('insert into candidates'. session('LoggedUser') .' (position, partylist, name, gender, bday, email, photo, info, status) 
            values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [$data['position'], $data['partylist'], $data['candidateName'], $data['gender'], $data['bdate'], $data['email'], $data['image'], $data['info'], "active"] );

            DB::insert('INSERT INTO electionresult'.session('LoggedUser').' (CandidateID, Position, Name, img, status) SELECT id, position, name, photo, status FROM candidates'.session('LoggedUser').' ORDER BY id DESC LIMIT 1');
        }else{
            DB::insert('insert into candidates'. session('LoggedUser') .' (position, partylist, name, gender, bday, email, photo, info, status) 
            values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [$data['position'], $data['partylist'], $data['candidateName'], $data['gender'], $data['bdate'], $data['email'], $data['image'], $data['info'], "active"] );

        }
    }

    public function candidateProfile($id){
        $data = ['LoggedUserInfo'=>organization::where('id','=', session('LoggedUser'))->first()];

        $candidates = DB::table('candidates'.session('LoggedUser'))
                        ->select('*')
                        ->where('id', $id)
                        ->first();

        return view('org.candidate-profile',$data)
                ->with(['candidates' => $candidates]);
    }

    public function disqualifyCandidate(Request $request){
        $request->validate(['rPassword' => 'required']);

        $userLogin = organization::where('id', '=', session('LoggedUser'))->first();
        if(Hash::check($request->rPassword,$userLogin->password)){
            DB::table('candidates'.session('LoggedUser'))
                ->where('id',$request->CID1)
                ->update(['status' => "disqualified"]);  
            DB::table('electionresult'.session('LoggedUser'))
                ->where('CandidateID',$request->CID1)
                ->update(['status' => "disqualified"]);    
            return response()->json([
                'status' => true,
            ]);    
        }else{  
            return response()->json([
                'status' => false,
                'msg' => 'Invalid Password',
            ]);
        }
    }


    public function deleteCandidate(Request $request){

        $request->validate(['dPassword' => 'required']);

        $userLogin = organization::where('id', '=', session('LoggedUser'))->first();
        if(Hash::check($request->dPassword,$userLogin->password)){
            DB::table('candidates'.session('LoggedUser'))
                ->where('id',$request->CID)
                ->update(['status' => "remove"]);  
            DB::table('electionresult'.session('LoggedUser'))
                ->where('CandidateID',$request->CID)
                ->update(['status' => "remove"]);    
            return response()->json([
                'status' => true,
            ]);    
        }else{  
            return response()->json([
                'status' => false,
                'msg' => 'Invalid Password',
            ]);
        }
    }

    function ballot(){
        $user = ['LoggedUserInfo'=>organization::where('id','=', session('LoggedUser'))->first()];

        $positions = DB::table('positions'.session('LoggedUser'))
                        ->get();
        
        $candidates = DB::table('candidates'.session('LoggedUser'))
                        ->select('electionresult'.session('LoggedUser').'.Name as name' , 'candidates'.session('LoggedUser').'.partylist as partylist', 'candidates'.session('LoggedUser').'.position as position')
                        ->join('electionresult'.session('LoggedUser') ,'candidates'.session('LoggedUser').'.id', '=', 'electionresult'.session('LoggedUser').'.CandidateID')
                        ->get();

        return view('org.previewBallot', $user)
                ->with(['candidates' => $candidates])
                ->with(['positions' => $positions]);
    }

    function candidateArchive(){
        $user = ['LoggedUserInfo'=>organization::where('id','=', session('LoggedUser'))->first()];
       
        $date = DB::select('SELECT id FROM election_dates WHERE id = ? AND NOW() > enddate',[session('LoggedUser')]);

        $candidates = DB::table('candidates'.session('LoggedUser'))
                        ->where('status','remove')
                        ->orWhere('status','disqualified')
                        ->get();

        return view('org.candidate-archives', $user)
                ->with(['candidates' => $candidates])
                ->with(['date' => $date]);
    }

    function restoreCandidate($id){
        DB::table('candidates'.session('LoggedUser'))
            ->where('id',$id)
            ->update(['status' => "active"]);  
        DB::table('electionresult'.session('LoggedUser'))
            ->where('CandidateID',$id)
            ->update(['status' => "active"]);  
        
        return redirect()->to('candidateArchive'); 

    }

    function voters(){
        $user = ['LoggedUserInfo'=>organization::where('id','=', session('LoggedUser'))->first()];
        // $voters = DB::select('select * from voters where id ='. session('LoggedUser').' AND status = pending');
        $voters = DB::table('voters')
                    ->where('id', session('LoggedUser'))
                    ->where('status','pending')
                    ->orWhere('status', 'voted')
                    ->get();
        $position = Schema::hasTable('positions'.session('LoggedUser'));
        $date = DB::select('SELECT id FROM election_dates WHERE id = ? AND NOW() BETWEEN startdate AND enddate OR NOW() > enddate',[session('LoggedUser')]);
        $rep = [];
        if($position){
            $rep = DB::table('positions'.session('LoggedUser'))
            ->select('position')
            ->where('position', 'LIKE', '%Representative')
            ->get();
        }
        
        return view('org.voters', $user)
                    ->with(['voters' => $voters])
                    ->with(['reps' => $rep])
                    ->with(['position' => $position])
                    ->with(['date' => $date]);
    }

    public function addVoter(Request $request){
        $request->validate([
            'name' => 'required|regex:/^[\pL\s]+$/u',
            'section' => 'required|alpha_num',
            'representative' => 'required|regex:/^[\pL\s]+$/u',
            'gender' => 'required|alpha',
            'bdate' => 'required|date',
            'voterID' => 'required|alpha_dash|unique:voters',
            'email' => 'required|email|unique:voters',
            'phone' => 'required|numeric'
        ]);

        $data = $request->all();
        $voterKey = substr(sha1(mt_rand()),17,8);

        $content = ['name' => $request->name,
                    'message' => "Here's your Voter Account",
                    'code' => "VoterID: $request->voterID, Voter Key: $voterKey",];

        voter::create([
            'id' => session('LoggedUser'),
            'name' => $data['name'],
            'section' => $data['section'],
            'representative' => $data['representative'],
            'gender' => $data['gender'],
            'bday' => $data['bdate'],
            'voterID' => $data['voterID'],
            'voterKey' => hash::make($voterKey),
            'email' => $data['email'],
            'mobileNo' => $data['phone'],
            'status' => "pending"      
            ]);

            Mail::to($request->email)->send(new SendMail($content));  
        
    }

    public function importVoter(Request $request){

        $request->validate([
                'document' => 'required|mimes:csv'
            ]);
        
        $document = $request->file('document');
        $fileDestinationPath = 'files';
        $file = $fileDestinationPath . "/" . $document->getClientOriginalName();
        $document->move($fileDestinationPath, $document->getClientOriginalName());
        $csvData = fopen(public_path($file), 'r');
        $i = 0;   

        while (($data = fgetcsv($csvData, 1000, ',')) !== false) {
         
            // Skip first row (Remove below comment if you want to skip the first row)
            if ($i == 0) {
                $i++;
                continue;
            }

            $voterKey = substr(sha1(mt_rand()),17,8); 

            $content = ['name' => $request->name,
                    'message' => "Here's your Voter Account",
                    'code' => "VoterID: ".$data['5'].",\nVoter Key: $voterKey",];

            Voter::create([                    
                'id' => session('LoggedUser'),
                'name' => $data['0'],
                'section' => $data['1'],
                'representative' => $data['2'],
                'gender' => $data['3'],
                'bday' => $data['4'],
                'voterID' => $data['5'],
                'voterKey' => hash::make($voterKey),
                'email' => $data['7'],
                'mobileNo' => $data['8'],
                'status' => 'Pending'
            ]);  

            Mail::to($request->email)->send(new SendMail($content)); 
        }
  
        fclose($csvData);

        return redirect('voters');
    }

    public function deleteVoter(Request $request){
        $request->validate(['password' => 'required']);

        $userLogin = organization::where('id', '=', session('LoggedUser'))->first();
        if(Hash::check($request->password,$userLogin->password)){
            DB::table('voters')
                ->where('id', session('LoggedUser'))
                ->where('voterID',$request->vid)
                ->update(['status' => "remove"]);    
                

            return response()->json([
                'status' => true,
            ]);    
        }else{  
            return response()->json([
                'status' => false,
                'msg' => 'Invalid Password',
            ]);
        }

    }   

    function viewVoter($id)
    {
        $data = ['LoggedUserInfo'=>organization::where('id','=', session('LoggedUser'))->first()];

        $voterProfile = DB::table('voters')
                        ->select('name', 'section', 'representative', 'gender', 'bday', 'email', 'mobileNo', 'img', 'status')
                        ->where('voterID', $id)
                        ->first();

        return view('org.voter-profile',$data)
                ->with(['voter' => $voterProfile]);
    }

    function voterArchive(){
        $data = ['LoggedUserInfo'=>organization::where('id','=', session('LoggedUser'))->first()];

        $voters = DB::table('voters')
            ->where('id', session('LoggedUser'))
            ->where('status','remove')
            ->get();
        
        return view('org.voter-archives', $data)
                ->with(['voters' => $voters]);
    }

    function restoreVoter($id){

        DB::table('voters')
            ->where('id', session('LoggedUser'))
            ->where('voterID', $id)
            ->update(['status' => 'pending']);

        return redirect('voter-archives');
    }


    public function results(){
        $data = ['LoggedUserInfo'=>organization::where('id','=', session('LoggedUser'))->first()];
        $date = DB::select('SELECT id FROM election_dates WHERE id = ? AND NOW() > enddate',[session('LoggedUser')]);
        $checker = true;
        $pending['pending'] = 0;
        $voted['voted'] = 0;
        $electionResult[] = "";
        try{
            $dates = DB::table('election_dates')
            ->select('*')
            ->where('id', session('LoggedUser'))
            ->first();

            $pending = DB::table('voters')
                            ->select(DB::raw('COUNT(status) AS pending'))
                            ->where('id',session('LoggedUser'))
                            ->where('status','Pending')
                            ->first();

            $voted = DB::table('voters')
                            ->select(DB::raw('COUNT(status) AS voted'))
                            ->where('id',session('LoggedUser'))
                            ->where('status','Voted')
                            ->first();

            $users = collect();

            $position = Schema::hasTable('positions'.session('LoggedUser'));
            if($position){
            $positions = DB::table('positions'.session('LoggedUser'))
                            ->select('position','maxWeight')
                            ->get();

            foreach ($positions as $position) {
                $users->push($candidates = DB::table('electionresult'.session('LoggedUser'))
                ->select('position','name')
                ->where('Position', '=', $position->position)
                ->where('Status', '=', 'active')
                ->orderBy('Votes', 'DESC')
                ->limit($position->maxWeight)
                ->get());
            }

            $users = $users->flatten();   

        }          
           
            $checker = true;
        }catch(Exception $e){
            $checker =  false;
            echo $e;
        }
             
        return view('org.view-election', $data)
                ->with(['dates' => $dates])
                ->with(['pending' => $pending, 'voted' => $voted])
                ->with(['checker' => $checker])
                ->with(['date' => $date])
                ->with(compact('users'));
    }

    function positionResult($position){
        $data = ['LoggedUserInfo'=>organization::where('id','=', session('LoggedUser'))->first()];
        $date = DB::table('election_dates')
                ->where('id', '=', session('LoggedUser'))
                ->first();
        $candidates =  DB::table('electionResult'.session('LoggedUser'))
            ->Select('candidateID','Name','Votes','img')
            ->where('position',$position)
            ->where('status', 'active')
            ->orderBy('Votes', 'DESC')
            ->get();

        $dataChart = DB::table('electionResult'.session('LoggedUser'))
                        ->select('Name','Votes')
                        ->where('Position',$position)
                        ->where('status', "active")
                        ->orderby('Votes','DESC')
                        ->get();

        return view('org.election-result',$data)
                ->with(['position' => $position])
                ->with(['candidates' => $candidates])
                ->with(['chart' => $dataChart])
                ->with(['date' => $date]);
        
    }

    function candidateResult($id){
        $data = ['LoggedUserInfo'=>organization::where('id','=', session('LoggedUser'))->first()];
        $dataChart = DB::table('section'.session('LoggedUser'))
                        ->select('name','section','votes')
                        ->join('candidates'.session('LoggedUser'),'cid', '=', 'id')
                        ->where('cid',$id)
                        ->get();

        $position = DB::table('candidates'.session('LoggedUser'))
                ->select('position')
                ->where('id', $id)
                ->first();
                        
        return view('org.election-result-candidates',$data)
                ->with(['chart' => $dataChart])
                ->with(['position' => $position]);
    }

    function generatePDF(){

        $signatory = DB::table('organizations')
                        ->select('fname','lname','NoS','PoS')
                        ->where('id',session('LoggedUser'))
                        ->first();

        $NoOfVoters = DB::table('voters')
                        ->where('id', session('LoggedUser'))
                        ->count();

        $NoOfVoted = DB::table('voters')
                        ->where('id',session('LoggedUser'))
                        ->where('status', 'voted')
                        ->count();

        $PendingVoters = DB::table('voters')
                            ->where('id', session('LoggedUser'))
                            ->where('status', 'pending')
                            ->count();

        $data = collect();

        $position = Schema::hasTable('positions'.session('LoggedUser'));
        
        $positions = DB::table('positions'.session('LoggedUser'))
                        ->select('position','maxWeight')
                        ->get();

        foreach ($positions as $position) {
            $data->push($candidates = DB::table('electionresult'.session('LoggedUser'))
            ->select('Position','Name', 'Votes')
            ->where('Position', '=', $position->position)
            ->where('Status', '=', 'active')
            ->orderBy('Votes', 'DESC')
            ->limit($position->maxWeight)
            ->get());
        }

        $data = $data->flatten();

        $collection = ['data' => $data, 'sign' => $signatory, 'NoOfVoters' => $NoOfVoters, 'NoOfVoted' => $NoOfVoted, 'PendingVoters' => $PendingVoters];

        $pdf = PDF::loadView('tablePdf', $collection);
                   
        return $pdf->stream('result.pdf');
    }
    
    function logout(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            session()->pull('LoggedUser1');
            return redirect('index');
        }
    }

    function logoutEmail(){
        if(session()->has('LoggedUser1')){
            session()->pull('LoggedUser1');
            return redirect('login');
        }
    }

}
