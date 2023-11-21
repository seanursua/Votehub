<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\voter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class VoterController extends Controller
{
    public function loginVoter()
    {
        return view('auth.login_voter');
        
    }  

    public function voterLogin(Request $request)
    {
        $request->validate([
            'voterID' => 'required',
            'voterKey' => 'required',
        ]);
      
        $voterUser = voter::where('VoterID', '=', $request->voterID)->first();

        if($voterUser && hash::check($request->voterKey, $voterUser->voterKey)){
            $code = mt_rand(100000,999999);
            $content = ['name' => $voterUser->name,
                    'message' => "Here's your One-time password",
                     'code' => $code];
            $userOtp = voter::where('voterID','=',$request->voterID)->update(['token' => $code]);
            $request->session()->put('VerifyUser',$request->voterID);
            Mail::to($voterUser['email'])->send(new SendMail($content));
            
            return redirect()->route('verify.voter');
        }else{
            return back()->with('fail', 'Invalid VoterID and Password');
        } 
    }

    public function verifyVoter(){
        $data = voter::where('VoterID', '=', session('VerifyUser'))->first();
        return view('auth.verify-voter')->with(['email' => $data['email']]);
    }

    public function submitVoterOtp(Request $request){

        $otpBoxes = $request->first . $request->second . $request->third . $request->fourth . $request->fifth . $request->sixth;
        $user = voter::where([['voterID','=',session('VerifyUser')],['token','=',$otpBoxes]])->first();
        if($user){
            $request->session()->put('VoterUser',$user->voterID);
            session()->pull('VerifyUser');
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

    function resendVoterOtp($email){
        $code = mt_rand(100000,999999);
        voter::where('email','=',$email)->update(['token' => $code]);
        $content = ['message' => "Here's your One-time password",
                     'code' => $code];

        Mail::to($email)->send(new SendMail($content));

        return back();

    }

    function ballot(){  
        $data = ['VoterUser'=>voter::where('voterID','=', session('VoterUser'))->first()];
        $id = voter::where('VoterID', '=', session('VoterUser'))->first();

        $dates = DB::table('election_dates')
                    ->where('id', $id['id'])
                    ->first();

        $today = now();
        if($dates->startdate > now()){
            return view('voter.election')->with(['dates' => $dates]);
        }elseif($dates->enddate < now()){
           echo "Hello";
        }else{
            if($id['status'] == "voted"){
                return view('voter/voted');
            }{
                $positions  = DB::select("Select position, maxWeight from positions".$id['id']);
        
                $candidates = DB::table('candidates'.$id['id'].' as c')
                                    ->select('c.id','c.name','c.position','c.partylist')
                                    ->get();
                                
                return view('voter.vote',$data)
                    ->with(['candidates' => $candidates])
                    ->with(['positions' => $positions])
                    ->with(['dates' => $dates])
                    ->with(['today' => $today]);
            }
            
        }
                        
        
        

        // $candidates = DB::table('electionResult'.$id['id'].' as e')
        //                     ->select('p.position','e.name')
        //                     ->join('positions'.$id['id'].' as p', 'e.position', '=', 'p.position')
        //                     ->get();
        // $candidates = DB::select("SELECT p.position, (SELECT name FROM electionresult".$id['id']." as e where p.position = e.position) as name from positions".$id['id']." as p");
       
        
    }

    function reviewVotes(Request $request){
       
        $id = [];
      
        foreach($request->candidate as $value){
            array_push($id,$value);
        }


        $request->session()->put('secret',$id);    
        
        return redirect('reviewForm');

    }

    public function reviewForm(){
        $secret = session('secret');
        $id = voter::where('VoterID', '=', session('VoterUser'))->first();

        $table = DB::table('candidates'.$id['id'])
            ->select('name','position')
            ->whereIn('id',$secret)
            ->get();
        
        return view('voter.review-votes')->with(['candidates' => $table]);
    }

    public function submitForm(){
        $secret = session('secret');
        $id = voter::where('voterID', '=', session('VoterUser'))->first();

        if($id['status'] == 'pending'){
            $count = DB::table('section'.$id['id'])
                        ->select('votes','section')
                        ->where('section',$id['section'])
                        ->whereIn('cid',$secret)
                        ->get();
                        
            if($count->count() > 0){
                DB::table('section'.$id['id'])
                    ->where('section','=',$id['section'])
                    ->whereIn('cid',$secret)
                    ->increment('Votes',1);
            }else{
                $data = array();
                foreach($secret as $key){
                    $dataArray=['cid' => $key, 'section' => $id['section'], 'Votes' => 1,];
                    array_push($data,$dataArray);
                }
                
                DB::table("section".$id['id'])->insert($data);
            }
            
            voter::where('voterID','=', session('VoterUser'))->update(['status' => 'voted']);
            
            DB::table('electionresult'.$id['id'])
                ->whereIn('CandidateID',$secret)
                ->increment('Votes',1);
            return redirect('ballot');
        }else{
            echo "Error";
        }
    }


    function voterProfile(){
        $data = ['VoterUser'=>voter::where('voterID','=', session('VoterUser'))->first()];
        $voter = DB::table('voters')
            ->where('voterID', session('VoterUser'))
            ->first();

        return view('voter.voter-profile', $data)
                ->with(['voter' => $voter]);
    }

    function changeVoterProfile(Request $request){

        $data = $request->all();

        if($request->hasFile('image')){

            $photo = $request->file('image');
            $photoDestinationPath = 'orgImage';
            $photoImage =  $photoDestinationPath . "/" . $photo->getClientOriginalName();
            $photo->move($photoDestinationPath, $photo->getClientOriginalName());
            $data['image'] = "$photoImage";

            DB::table('voters')
            ->where('voterID', session('VoterUser'))
            ->update(['img' => $data['image']]);

            return redirect('/voter-profile');
        }
 
    }


    function logout(){
        if(session()->has('VerifyUser')){
            session()->pull('VerifyUser');
            return redirect('loginVoter');
        }elseif (session()->has('VoterUser')){
            session()->pull('VoterUser');
            return redirect('loginVoter');
        }
    }
    

}
