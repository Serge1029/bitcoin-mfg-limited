<?php

namespace App\Http\Controllers\Front;
use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Generalsetting;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class VougePayController extends Controller
{

 public function deposit(Request $request){

     $settings = Generalsetting::findOrFail(1);
     $order = new Order;
     $v_merchant_id = 'DEMO';
     $return_url = action('Front\PaymentController@payreturn');
     $cancel_url = action('Front\PaymentController@paycancle');
     $notify_url = route('vougepay.notify');

     $item_name = $settings->title." Invest";
     $item_number = str_random(4).time();
     $item_amount = $request->invest;

     $querystring = '';

     // Firstly Append paypal account to querystring
     $querystring .= "?v_merchant_id=".urlencode($v_merchant_id)."&";

     // Append amount& currency (£) to quersytring so it cannot be edited in html

     //The item name and amount can be brought in dynamically by querying the $_POST['item_number'] variable.
     $querystring .= "memo=".urlencode($item_name)."&";
     $querystring .= "total=".urlencode($item_amount)."&";
     $querystring .= "merchant_ref=".urlencode($item_number)."&";

    //$querystring .= "cmd=".urlencode(stripslashes($request->cmd))."&";
    //$querystring .= "bn=".urlencode(stripslashes($request->bn))."&";
    //$querystring .= "lc=".urlencode(stripslashes($request->lc))."&";
    $querystring .= "cur=".urlencode(stripslashes($request->currency_code))."&";

     // Append paypal return addresses
     $querystring .= "success_url=".urlencode(stripslashes($return_url))."&";
     $querystring .= "fail_url=".urlencode(stripslashes($cancel_url))."&";
     $querystring .= "notify_url=".urlencode($notify_url)."&";
    // Redirect to paypal IPN

                    $order['pay_amount'] = $request->total;
                    $order['user_id'] = $request->user_id;
                    $order['invest'] = $request->invest;
                    $order['method'] = $request->method;
                    $order['customer_email'] = $request->customer_email;
                    $order['customer_name'] = $request->customer_name;
                    $order['customer_phone'] = $request->customer_phone;
                    $order['order_number'] = $item_number;
                    $order['customer_address'] = $request->customer_address;
                    $order['customer_city'] = $request->customer_city;
                    $order['customer_zip'] = $request->customer_zip;
                    $order['payment_status'] = "Pending";
                    $order['currency_sign'] = $request->currency_sign;
                    $order['subtitle'] = $request->subtitle;
                    $order['title'] = $request->title;
                    $order['details'] = $request->details;

                     $date = Carbon::now();
                     $date = $date->addDays($request->days);
                     $date = Carbon::parse($date)->format('Y-m-d h:i:s');
                    $order['end_date'] = $date;
                    $order->save();

                    Session::put('paypal_order_id',$order->id);
                    return $item_number;

 }


     public function paycancle(){
        
         return redirect()->back()->with('unsuccess','Payment Cancelled.');
        
     }

     public function payreturn(){
         return view('front.success');
     }


public function notify(Request $request){

    $res="";

    $request->validate([
        'transaction_id' => 'required'
    ]);

    $txn_id = $request->transaction_id;

    $req_url = "https://voguepay.com/?v_transaction_id=".$txn_id."&type=json";
    $data = file_get_contents($req_url);
    $data = json_decode($data);

    $merchant_id = $data->merchant_id;
    $total_paid = $data->total;
    $custom = $data->merchant_ref;
    $status = $data->status;
    
    $settings = Generalsetting::findOrFail(1);

    if($status == "Approved" && $merchant_id == $settings->vouge_merchant){

        $order = Order::where('order_number' , $custom)->where('payment_status','Pending')->first();
        
        if($order->invest == $total_paid)
        {
            
            $data['txnid'] = $txn_id;
            $data['payment_status'] = 'Completed';
            $order->update($data);
            $notification = new Notification;
            $notification->order_id = $order->id;
            $notification->save();
    
                        $trans = new Transaction;
                        $trans->email = $order->customer_email;
                        $trans->amount = $order->invest;
                        $trans->type = "Invest";
                        $trans->txnid = $order->order_number;
                        $trans->user_id = $order->user_id;
                        $trans->save();
    
                        $notf = new UserNotification;
                        $notf->user_id = $order->user_id;
                        $notf->order_id = $order->id;
                        $notf->type = "Invest";
                        $notf->save();
    
                        $gs =  Generalsetting::findOrFail(1);
    
                        if($gs->is_affilate == 1)
                        {
                            $user = User::find($order->user_id);
                            if ($user->referral_id != 0) 
                            {
                                $val = $order->invest / 100;
                                $sub = $val * $gs->affilate_charge;
                                $sub = round($sub,2);
                                $ref = User::find($user->referral_id);
                                if(isset($ref))
                                {
                                    $ref->income += $sub;
                                    $ref->update();
    
                                    $trans = new Transaction;
                                    $trans->email = $ref->email;
                                    $trans->amount = $sub;
                                    $trans->type = "Referral Bonus";
                                    $trans->txnid = $order->order_number;
                                    $trans->user_id = $ref->id;
                                    $trans->save();
                                }
                            }
                        }
    
            if($gs->is_smtp == 1)
            {
            $data = [
                'to' => $order->customer_email,
                'type' => "Invest",
                'cname' => $order->customer_name,
                'oamount' => $order->order_number,
                'aname' => "",
                'aemail' => "",
                'wtitle' => "",
            ];
    
            $mailer = new GeniusMailer();
            $mailer->sendAutoMail($data);            
            }
            else
            {
               $to = $order->customer_email;
               $subject = " You have invested successfully.";
               $msg = "Hello ".$order->customer_name."!\nYou have invested successfully.\nThank you.";
               $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
               mail($to,$subject,$msg,$headers);            
            }
    
        }
    }else{
        $payment = Order::where('user_id',$_POST['custom'])
            ->where('order_number',$_POST['item_number'])->first();
        $payment->delete();
    }

}

}
