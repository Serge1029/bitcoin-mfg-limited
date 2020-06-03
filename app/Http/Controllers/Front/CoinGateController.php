<?php

namespace App\Http\Controllers\Front;

use App\Classes\CoinPaymentsAPI;
use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Illuminate\Support\Facades\Input;
use Session;
use Validator;
use App;
use Config;
use URL;
use Redirect;


class CoinGateController extends Controller
{

    public function __construct() {
        //$this->middleware('auth')->except(['coingetCallback']);
    }

    public function blockInvest()
    {
        return view('front.coinpay');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function coingetCallback(Request $request)
    {

        $blocksettings = Generalsetting::findOrFail(1);
        $real_secret  = $blocksettings->secret_string;
        //$randString = new GetUserAgents();

        // $des = $_SERVER['QUERY_STRING'];

        // $bitTran = $_GET['transaction_hash'];
        // $bitAddr = $_GET['address'];

        $trans_id = $request->order_id;
        $getSec = Input::get('secret');
        if ($real_secret == $getSec){

            if ($request->status == 'paid') {
                    # code...
                

                if (Order::where('order_number',$trans_id)->where('payment_status','Pending')->exists()){

                    $deposits = $request->receive_amount;


                    $order = Order::where('order_number',$trans_id)->where('payment_status','Pending')->first();
                    $data['pay_amount'] = $deposits;
                    $data['coin_amount'] = $request->pay_amount;
                    $data['payment_status'] = "Completed";
                    $data['txnid'] = $request->id;
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

                   // return "*ok*";

                }
            }

        }
    }


    public function deposit(Request $request)
    {
        $generalsettings = Generalsetting::findOrFail(1);

        if($request->invest > 0){

        $acc = Auth::user();
            $item_number = str_random(4).time();;

        $item_amount = $request->invest;
        $currency_code = $request->currency_code;
        //$amount = file_get_contents('https://blockchain.info/tobtc?currency='.$currency_code.'&value='.$request->invest);
        //return $amount;
        $secret = $generalsettings->secret_string;
        $coingateAuth = $generalsettings->coingate_auth;

        $item_name = $generalsettings->title." Invest";

        //return $my_xpub.'-'.$secret.'-'.$my_api_key;
        $my_callback_url = url('/').'/coingate/notify?transx_id='.$item_number.'&secret='.$secret;

        $return_url = action('Front\PaymentController@payreturn');
        $cancel_url = action('Front\PaymentController@paycancle');


            \CoinGate\CoinGate::config(array(
                'environment'               => 'sandbox', // sandbox OR live
                'auth_token'                => $coingateAuth
            ));


            $post_params = array(
                'order_id'          => $item_number,
                'price_amount'      => $item_amount,
                'price_currency'    => $currency_code,
                'receive_currency'  => $currency_code,
                'callback_url'      => $my_callback_url,
                'cancel_url'        => $cancel_url,
                'success_url'       => $return_url,
                'title'             => $item_name,
                'description'       => 'Deposit'
            );

            $coinGate = \CoinGate\Merchant\Order::create($post_params);

            if ($coinGate)
            {

                $order = new Order;

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
                $order['notify_id'] = $coinGate->token;
                $order['currency_sign'] = $request->currency_sign;
                $order['subtitle'] = $request->subtitle;
                $order['title'] = $request->title;
                $order['details'] = $request->details;

                $date = Carbon::now();
                $date = $date->addDays($request->days);
                $date = Carbon::parse($date)->format('Y-m-d h:i:s');
                $order['end_date'] = $date;
                $order->save();

                return redirect($coinGate->payment_url);

            }
            else
            {
                return redirect()->back()->with('unsuccess','Some Problem Occurrs! Please Try Again');
            }

        }
        return redirect()->back()->with('unsuccess','Please enter a valid amount.')->withInput();
        //return view('user.depositmoney');
    }

}
