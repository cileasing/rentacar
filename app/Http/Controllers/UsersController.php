<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Service\Sms;
use Session;

use Auth;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json([
            'users' => $users
        ]);
    }

    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('rentacar')->accessToken;
            $user =  auth()->user();
            // dd($token);
            return response()->json(['token' => $token, 'user'=> $user], 200);
        } else {
            // dd($credentials);
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }
    
    public function show()
    {

        return response()->json(['user' => auth()->user()], 200);
    }


    /**
    * Function to verify OTP.
    *
    * @return Response
    */
    public function sendOtp(Request $request){

        $response = array();
        $userId = Auth::user()->id;
        // $phone = $request->input('phone_number');
        $user = User::where('id', $userId)->first();
    
        if ( isset($user['phone_number']) && $user['phone_number'] =="" ) {
        // if (  $phone =="" ) {
            $response['error'] = 1;
            $response['message'] = 'Invalid mobile number';
            $response['loggedIn'] = 1;
        } else {
    
            $otp = rand(100000, 999999);
            $sms = new Sms;
            
    
            $smsResponse = $sms->initiateSmsActivation($otp,$user['phone_number']);
            // $smsResponse = $sms->initiateSmsActivation($otp, $phone);
    
            if($smsResponse['error']){
                $response['error'] = 1;
                $response['message'] = $smsResponse['message'];
                $response['loggedIn'] = 1;
            }else{
    
                // $use
                $user->current_otp = $otp;
                $user->update();
    
                $response['error'] = 0;
                $response['message'] = 'Your OTP is created.';
                $response['OTP'] = $otp;
                $response['loggedIn'] = 1;
            }
        }
        return response()->json(['response' => $response], 200);
        // echo json_encode($response);
    }

    /**
    * Function to verify OTP.
    *
    * @return Response
    */
    public function verifyOtp(Request $request){

        $response = array();

        $enteredOtp = $request->input('OTP');
        $userId = Auth::user()->id;  //Getting UserID.
        $user = User::where('id', $userId)->first();

        if($userId == "" || $userId == null){
            $response['error'] = 1;
            $response['message'] = 'You are logged out, Login again.';
            $response['loggedIn'] = 0;
        }else{
            // $OTP = $request->get('OTP');
            $current_otp = $user->current_otp;

            if($current_otp === (int)$enteredOtp){

                // Updating user's status "isVerified" as 1.

                User::where('id', $userId)->update(['isVerified' => 1]);

                $response['error'] = 0;
                $response['isVerified'] = 1;
                $response['loggedIn'] = 1;
                $response['message'] = "Your Number is Verified.";
            }else{
                $response['error'] = 1;
                $response['isVerified'] = 0;
                $response['loggedIn'] = 1;
                $response['message'] = "OTP does not match.";
            }
        }

        return response()->json(['response' => $response], 200);
        // echo json_encode($response);
    }

}
