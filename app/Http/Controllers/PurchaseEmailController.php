<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class PurchaseEmailController extends Controller
{
    public function index(){
        $data=['name'=>"saugat",'data'=>"hello saugat"];
        $user['to']='saugatdhakal5@gmail.com';
     $mail=   Mail::send('purchaseMail.purchaseMails',$data,function($message) use ($user){
            $message->to($user['to']);
            $message->subject('hey dude it working');
        });
        return 'send';
    }
}
