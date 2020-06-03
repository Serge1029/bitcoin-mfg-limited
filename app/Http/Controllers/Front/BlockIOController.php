<?php

namespace App\Http\Controllers\Front;

use App;
use URL;
use Auth;
use Hash;
use Config;
use Session;
use Redirect;
use Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Classes\BlockIO;
use App\Models\Transaction;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Classes\GeniusMailer;
use App\Models\Generalsetting;
use App\Classes\CoinPaymentsAPI;
use App\Models\UserNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;


class BlockIOController extends Controller
{

    public function __construct() {
       // $this->middleware('auth')->except(['coingetCallback']);
    }

    public function blockioInvest()
    {
        return view('front.blockio');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function blockioCallback(Request $request)
    {

        $blocksettings = Generalsetting::findOrFail(1);


    // $fpbt = fopen('blockIO-Response'.time().'.txt', 'w');
    // fwrite($fpbt, $request['notification_id'].'--'.$request['data']['amount_received']);
    // fclose($fpbt);

        $notifyID = $request['notification_id'];
        $amountRec = $request['data']['amount_received'];
        $bitTran = $request['data']['txid'];


            if (Order::where('notify_id',$notifyID)->exists()){

                

                $order = Order::where('notify_id',$notifyID)->where('payment_status','Pending')->first();

                if ($order->coin_amount <= $amountRec) {
                    
                    $data['txnid'] = $bitTran;
                    $data['payment_status'] = "Completed";
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


            }

        
    }

    function curlGetCall($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec ($ch);
        curl_close ($ch);

        return $data;
    }

    public function deposit_new(Request $request){
        $blocksettings = Generalsetting::findOrFail(1);

        if($request->invest > 0){

            $methods = $request->method;

            $version = 2;
            $coin = "BTC";
            $my_api_key = $blocksettings->blockio_api_btc;

            $secret = $blocksettings->secret_string;

            if($methods == "BlockIO(LTC)"){
                $coin = "Litecoin";
                $my_api_key = $blocksettings->blockio_api_ltc;

            }elseif ($methods == "BlockIO(DGC)"){
                $coin = "Dogecoin";
                $my_api_key = $blocksettings->blockio_api_dgc;

            }


            
            $block_io = new BlockIO($my_api_key, $secret, $version);
            $biodata = $block_io->get_current_price(array('price_base' => 'USD'));
            if ($biodata->status != 'success') {
                return back()->with('danger', 'Failed to Process');
            }
            $biorate = $biodata->data->prices[0]->price;

            $acc = Auth::user()->id;
            $item_number = str_random(4).time();;

            $item_amount = $request->invest;
            $currency_code = $request->currency_code;

            $bcoin = round($item_amount / $biorate, 8);
    
                $ad = $block_io->get_new_address();
    
                if ($ad->status == 'success') {
                    $blockad = $ad->data;
                    $wallet = $blockad->address;
                    $data['btc_wallet'] = $wallet;
                    $data['btc_amo'] = $bcoin;
                    $data->update();
                } else {
                    return back()->with('danger', 'Failed to Process');
                }

            $my_callback_url = url('/').'blockio/notify?transx_id='.$item_number.'&secret='.$secret;

            $root_url = 'https://block.io/api/v2/';

            $call_address = $root_url.'get_new_address/?api_key=' .$my_api_key;
            $addResponse = $this->curlGetCall($call_address);

            $addObject = json_decode($addResponse);

            $address = $addObject->data->address;

            $notifyID ="fdgdf";
            $order = new Order;

            $order['pay_amount'] = $request->total;
            $order['user_id'] = $request->user_id;
            $order['invest'] = $request->invest;
            $order['method'] = $methods;
            $order['customer_email'] = $request->customer_email;
            $order['customer_name'] = $request->customer_name;
            $order['customer_phone'] = $request->customer_phone;
            $order['order_number'] = $item_number;
            $order['customer_address'] = $request->customer_address;
            $order['customer_city'] = $request->customer_city;
            $order['customer_zip'] = $request->customer_zip;
            $order['payment_status'] = "Pending";
            $order['currency_sign'] = $request->currency_sign;
            $order['notify_id'] = $notifyID;
            $order['subtitle'] = $request->subtitle;
            $order['title'] = $request->title;
            $order['details'] = $request->details;

            $date = Carbon::now();
            $date = $date->addDays($request->days);
            $date = Carbon::parse($date)->format('Y-m-d h:i:s');
            $order['end_date'] = $date;
            $order->save();


            session(['address' => $address,'coin' => $coin,'amount' => $bcoin,'currency_value' => $item_amount,'currency_sign' => $request->currency_sign,'accountnumber' => $acc]);

            return redirect('invest/blockio');

        }
        return redirect()->back()->with('error','Please enter a valid amount.')->withInput();

    }

    public function deposit(Request $request)
    {
        $blocksettings = Generalsetting::findOrFail(1);

        if($request->invest > 0){

            $methods = $request->method;
            $version = 2;
            $coin = "BTC";
            $my_api_key = $blocksettings->blockio_api_btc;
            //$my_api_key_live = '6ed5-46d5-80e7-7990';

            if($methods == "BlockIO(LTC)"){
                $coin = "Litecoin";
                $my_api_key = $blocksettings->blockio_api_ltc;
            //$my_api_key_live = '1625-6930-d252-aa81';

            }elseif ($methods == "BlockIO(DGC)"){
                $coin = "Dogecoin";
                $my_api_key = $blocksettings->blockio_api_dgc;
                //$my_api_key_live = '3507-857e-4685-a8fb';

            }


            $acc = Auth::user()->id;
            $item_number = str_random(4).time();;

            $item_amount = $request->invest;
            $currency_code = $request->currency_code;

            $secret = $blocksettings->secret_string;


            $my_callback_url = url('/').'/blockio/notify';


            $block_io = new BlockIO($my_api_key, $secret, $version);
            //$block_io_live = new BlockIO($my_api_key_live, $secret, $version);
            if ($methods != "BlockIO(DGC)") {
                $biodata = $block_io->get_current_price(array('price_base' => 'USD'));
                if ($biodata->status != 'success') {
                    return back()->with('danger', 'Failed to Process');
                }
                $biorate = $biodata->data->prices[0]->price;
    
            }else{
                $dogeprice = file_get_contents("https://api.coinmarketcap.com/v1/ticker/dogecoin");
                $dresult = json_decode($dogeprice);
                $biorate = $dresult[0]->price_usd;
            }
            

            $coin_amount = round($item_amount / $biorate, 8);


            $root_url = 'https://block.io/api/v2/';

            $addObject = $block_io->get_new_address();

            $address = $addObject->data->address;

            $notifyObject = $block_io->create_notification(array('type' => 'address', 'address' => $address, 'url' => $my_callback_url));

            $notifyID = $notifyObject->data->notification_id;

            $order = new Order;

            $order['pay_amount'] = $request->total;
            $order['user_id'] = $request->user_id;
            $order['invest'] = $request->invest;
            $order['method'] = $methods;
            $order['customer_email'] = $request->customer_email;
            $order['customer_name'] = $request->customer_name;
            $order['customer_phone'] = $request->customer_phone;
            $order['order_number'] = $item_number;
            $order['customer_address'] = $request->customer_address;
            $order['customer_city'] = $request->customer_city;
            $order['customer_zip'] = $request->customer_zip;
            $order['payment_status'] = "Pending";
            $order['currency_sign'] = $request->currency_sign;
            $order['notify_id'] = $notifyID;
            $order['coin_address'] = $address;
            $order['coin_amount'] = $coin_amount;
            $order['subtitle'] = $request->subtitle;
            $order['title'] = $request->title;
            $order['details'] = $request->details;

            $date = Carbon::now();
            $date = $date->addDays($request->days);
            $date = Carbon::parse($date)->format('Y-m-d h:i:s');
            $order['end_date'] = $date;
            $order->save();
            							
            $qrcode_url = "https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=bitcoin:".$address."?amount=".$coin_amount."&choe=UTF-8";


            session(['address' => $address,'coin' => $coin,'qrcode_url' => $qrcode_url,'amount' => $coin_amount,'currency_value' => $item_amount,'currency_sign' => $request->currency_sign,'accountnumber' => $acc]);

            return redirect('invest/blockio');

            //return redirect()->back()->with('message','Deposit Request Sent Successfully.');

        }
        return redirect()->back()->with('error','Please enter a valid amount.')->withInput();

    }

}
