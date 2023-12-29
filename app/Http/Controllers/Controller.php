<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\CandidateFavoriteFamily;
use App\Models\FamilyFavoriteCandidate;
use App\Models\FamilyReview;
use App\Models\CandidateReview;
use App\Models\FrontUser;
use App\Models\NeedsBabysitter;
use App\Models\PreviousExperience;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Packages;
use Carbon\Carbon;




class Controller extends BaseController{
    use AuthorizesRequests, ValidatesRequests;

    public function store_previous_experience($input, $candidateId){
        $previous_experiance =  PreviousExperience::where('candidate_id', $candidateId)->get()->toArray();
        if(isset($previous_experiance) && !empty($previous_experiance)){
            $delete_status = PreviousExperience::where('candidate_id', $candidateId)->delete(); 
        }
            
        foreach ($input['daterange'] as $key => $value) {
            $data = array();
            $data['candidate_id']   = isset($candidateId) ? $candidateId : null;
            $data['daterange']      = isset($input['daterange'][$key]) ? $input['daterange'][$key] : null;
            $data['heading']        = isset($input['heading'][$key]) ? $input['heading'][$key] : null; 
            $data['description']    = isset($input['description'][$key]) ? $input['description'][$key] : null;             
            $data['reference']      = isset($input['reference'][$key]) ? $input['reference'][$key] : null; 
            $data['tel_number']     = isset($input['tel_number'][$key]) ? $input['tel_number'][$key] : null;  
            $data['created_at']     = date("Y-m-d H:i:s");
            $data['updated_at']     = date("Y-m-d H:i:s");
            $status = PreviousExperience::create($data);
        }
        return $status;
    }

    public function store_image($data, $path=null){
        try {
            $randomName = \Illuminate\Support\Str::random(20);
            $extension = $data->getClientOriginalExtension();
            $imageName = date('d-m-y') . '_' . $randomName . '.' . $extension;
            $path = $data->storeAs('uploads', $imageName, 'public');
        } catch (\Exception $e) {
            $imageName = null; 
        } finally {
            if (!isset($imageName)) {
                $imageName = null;
            }
        }
        return $imageName;
    }


    public function store_candidate_calender($input, $candidateId){
        $candidate = FrontUser::find($candidateId);
        if(isset($candidate) && !empty($candidate)){
            $data['morning']        = !empty($input['morning']) ? json_encode($input['morning']) : null;
            $data['afternoon']      = !empty($input['afternoon']) ? json_encode($input['afternoon']) : null;
            $data['evening']        = !empty($input['evening']) ? json_encode($input['evening']) : null;
            $data['night']          = !empty($input['night']) ? json_encode($input['night']) : null;
            $data['updated_at']     =  date("Y-m-d H:i:s");
            $availability           =  $candidate->needs_babysitter()->updateOrCreate(['family_id' => $candidateId], $data);
            return $availability->id;        
        }
    }

    public function store_family_calender($input, $candidateId){
        $candidate = FrontUser::find($candidateId);
        if(isset($candidate) && !empty($candidate)){
            $data['morning']        = !empty($input['morning']) ? json_encode($input['morning']) : null;
            $data['afternoon']      = !empty($input['afternoon']) ? json_encode($input['afternoon']) : null;
            $data['evening']        = !empty($input['evening']) ? json_encode($input['evening']) : null;
            $data['night']          = !empty($input['night']) ? json_encode($input['night']) : null;
            $data['updated_at']     =  date("Y-m-d H:i:s");
            $availability           =  $candidate->needs_babysitter()->updateOrCreate(['family_id' => $candidateId], $data);
            return $availability->id;
        }        
    }

    public function send_mail($data=null, $message){
        config(['mail.mailers.smtp.host' => 'smtp.gmail.com']);
        config(['mail.mailers.smtp.port' => '587']);
        config(['mail.mailers.smtp.username' => 'prakash.v.php@gmail.com']);
        config(['mail.mailers.smtp.password' => 'rqjmelerlcsuycnp']);
        config(['mail.mailers.smtp.encryption' => 'tls']);
        
        $message = $message;
        $emailTo = 'prakash.v.php@gmail.com';
        $name    = 'Admin';
        
        Mail::send([], [], function ($mail) use ($message, $emailTo, $name) {
            $mail->to($emailTo, $name)->subject($data['subject'])->setBody($message, 'text/html');
            $mail->from('info@onlineaupair.Co.Za', 'Onlineaupair');
        });
    }

    public function change_user_status(Request $request){
        $frontUser = FrontUser::find($request->id);
        if(empty($frontUser)){
            return response()->json(['message' => 'record not found', 'status' => 404], 404);
        }
        
        $frontUser->update(['status' => $request->status]);
        return response()->json(['status'  => 200], 200);
    }

    public function get_purchased_candidates($user_id){
        $candidates = Packages::leftJoin('user_subscriptions', 'packages.id', '=', 'user_subscriptions.package_id')
        ->select('packages.candidate', 'user_subscriptions.*')
        ->where('user_subscriptions.end_date', '>',  Carbon::now())
        ->where('user_subscriptions.status', 'active')
        ->where('user_subscriptions.user_id', $user_id)
        ->get()->pluck('candidate')->toArray();
        
        $response = !empty($candidates) ? implode(",", $candidates) : null;
        return $response;
    }
}
