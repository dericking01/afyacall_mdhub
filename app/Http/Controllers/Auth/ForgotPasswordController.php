<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    // public function sendResetLinkEmail(Request $request)
    // {
    //     $this->validateEmail($request);

    //     // We will send the password reset link to this user. Once we have attempted
    //     // to send the link, we will examine the response then see the message we
    //     // need to show to the user. Finally, we'll send out a proper response.
    //     $response = $this->broker()->sendResetLink(
    //         $this->credentials($request), 
    //     );

    //     \Mail::send('emails.test', ['name' => 'julius', 'email' => 'mssmsfr@gmail.com', 'title' => "check", 'content' => 'nothing'], function ($message) {
    //         $message->to('test@afyacall.co.tz')->subject('Subject of the message!');
    //     });

    //     // $credentials = ['email' => $request->email];
    //     // $response = Password::sendResetLink($credentials, function (Message $message) {
    //     //     $message->subject($this->getEmailSubject());
    //     // });

    //     //dd($credentials);
    //     return $response == Password::RESET_LINK_SENT
    //                 ? $this->sendResetLinkResponse($request, $response)
    //                 : $this->sendResetLinkFailedResponse($request, $response);
    // }
}
