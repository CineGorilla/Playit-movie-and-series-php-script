<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;


use App\Models\Newsletters;

class NewslettersController extends MainAdminController{  
    
    //Display Newsletter List
    public function lists_newsletter(Request $request){
        $data = Newsletters::orderBy('id', 'DESC')->paginate(10)->onEachSide(1);
        return view('admin.newsletter.lists',compact('data'));
    }   

    //Display Newsletter send
    public function send_newsletter(){
        return view('admin.newsletter.send');
    }  

    //Display Newsletter send mail
    public function send_email(Request $request){
    	$app_name = config('app.name');
        $admin_email = config('mail.from.address');

        $newsletter_body = base64_decode($request->page_body);
        $newsletter_subject = $request->subject;

        if(isset($request->emails)){
        	$newsletter_emails = explode(",", $request->emails);
            $emails = $newsletter_emails;

            foreach($emails as $email) {
            	$data = array(
                    'email' => $email,
                    'bodyMessage' => $newsletter_body,
                    'subject' => $newsletter_subject,
                    'app_name' => $app_name,
                    'admin_email' =>$admin_email
                );

                Mail::send('emails.subscribers',$data, function($message) use ($data){
                    $message->from($data['admin_email']);
                    $message->to($data['email']);
                    $message->subject($data['subject']);
                });	
            }	
        }else{
        	$newsletter = Arr::flatten(Newsletters::get(['email'])->toArray());
            $emails = str_replace(' ','',$newsletter);

            foreach($emails as $email) {
                $data = array(
                    'email' => $email,
                    'bodyMessage' => $newsletter_body,
                    'subject' => $newsletter_subject,
                    'app_name' => $app_name,
                    'admin_email' =>$admin_email
                );

                Mail::send('emails.subscribers',$data, function($message) use ($data){
                    $message->from($data['admin_email']);
                    $message->to($data['email']);
                    $message->subject($data['subject']);
                });
            }
        }

        return redirect()->action([NewslettersController::class,'lists_newsletter'])->with('success','Messages Send Successfully');
    }

    //Store Newsletter
    public function store(Request $request){

        $validator = Validator::make($request->all(), [ 
            'email' => 'required|email|unique:newsletters,email'
        ], [ 
            'email.required' => 'Email Field is Required!',
            'email.unique' => 'Email Already Subscribed!!',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous().'#newsletter')
                        ->withErrors($validator)
                        ->withInput();
        }

        $newsletters = new Newsletters();
        $newsletters->email = $request->email;

        $ip_address = request()->ip();
        $userData = geoip()->getLocation($ip_address);
        $newsletters->country = $userData->country;

        $newsletters->save();

        return redirect(url()->previous().'#newsletter')->with('subscribed','Subscribed Successfully');
    }
}