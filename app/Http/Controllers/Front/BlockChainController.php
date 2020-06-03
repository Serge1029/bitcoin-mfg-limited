<?php

namespace App\Http\Controllers\Front;

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


class BlockChainController extends Controller
{

    public function __construct() {
        //$this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('payblocktrail');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function blockInvest()
    {
        return view('front.blockchain');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function chaincallback()
    {

        $blocksettings = Generalsetting::findOrFail(1);
        $real_secret  = $blocksettings->secret_string;
        //$randString = new GetUserAgents();

        $des = $_SERVER['QUERY_STRING'];

//        $fh = fopen('transDet.txt', 'w');
//        fwrite($fh, $des);
//        fclose($fh);

        $bitTran = $_GET['transaction_hash'];
        $bitAddr = $_GET['address'];

        $trans_id = Input::get('transx_id');
        $getSec = Input::get('secret');
        if ($real_secret == $getSec){

            if (Order::where('order_number',$trans_id)->exists()){

                //$transx = Transaction::where('transid',$trans_id)->where('status',0)->first();
                //$useracc = UserAccount::findOrFail($transx->mainacc);

                $deposits = $_GET['value']/100000000;

//                $datas['status'] = 1;
//                $datas['deposit_transid'] = $bitTran;
//                $datas['amount'] = $deposits;
//                $transx->update($datas);
//
//
//                $data['current_balance'] = $useracc->current_balance + $deposits;
//                $useracc->update($data);


                $order = Order::where('order_number',$trans_id)->first();
                $data['txnid'] = $bitTran;
                $data['pay_amount'] = $deposits;
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



                return "*ok*";

            }

        }
    }


    function goRandomString($length = 10) {
        $characters = 'abcdefghijklmnpqrstuvwxyz123456789';
        $string = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, $max)];
        }
        return $string;
    }


    public function accept($id)
    {
        $blocksettings = Settings::findOrFail(1);
        $withdraw = Withdraw::findOrFail($id);

        $transid = strtoupper($this->goRandomString(4).str_random(3).$this->goRandomString(4));

        $receivertrans = new Transaction();
        $receivertrans['transid'] = $transid;
        $receivertrans['mainacc'] = $withdraw->acc->id;
        $receivertrans['accto'] = null;
        $receivertrans['accfrom'] = null;
        $receivertrans['type'] = "withdraw";
        $receivertrans['sign'] = "-";
        $receivertrans['reference'] = "Payout Withdraw Successful";
        $receivertrans['reason'] = "Withdraw Payouts";
        $receivertrans['amount'] = $withdraw->amount;
        $receivertrans['fee'] = $withdraw->fee;
        $receivertrans['withdrawid'] = $withdraw->id;
        $receivertrans['trans_date'] = date('Y-m-d H:i:s');
        $receivertrans['status'] = 1;
        $receivertrans->save();

        $data['status'] = "completed";
        $withdraw->update($data);

        return redirect('admin/withdraws')->with('message','Withdraw Accepted Successfully');
    }

    public function store(Request $request)
    {

    }

    public function deposit(Request $request)
    {
        $blocksettings = Generalsetting::findOrFail(1);

        if($request->invest > 0){

        $acc = Auth::user()->id;
            $item_number = str_random(4).time();;

        $item_amount = $request->invest;
        $currency_code = $request->currency_code;
        $amount = file_get_contents('https://blockchain.info/tobtc?currency='.$currency_code.'&value='.$request->invest);
        //return $amount;
        $secret = $blocksettings->secret_string;
        $my_xpub = $blocksettings->blockchain_xpub;
        $my_api_key = $blocksettings->blockchain_api;
        $my_gap = $blocksettings->gap_limit;
        //return $my_xpub.'-'.$secret.'-'.$my_api_key;
        $my_callback_url = url('/').'/blockchain/notify?transx_id='.$item_number.'&secret='.$secret;

        $root_url = 'https://api.blockchain.info/v2/receive';

        $parameters = 'xpub=' .$my_xpub. '&callback=' .urlencode($my_callback_url). '&key=' .$my_api_key.'&gap_limit='.$my_gap;

        $response = file_get_contents($root_url . '?' . $parameters);

        $object = json_decode($response);

        $address = $object->address;

        //session(['address' => $address,'accountnumber' => $acc]);


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
            $order['currency_sign'] = $request->currency_sign;
            $order['subtitle'] = $request->subtitle;
            $order['title'] = $request->title;
            $order['details'] = $request->details;

            $date = Carbon::now();
            $date = $date->addDays($request->days);
            $date = Carbon::parse($date)->format('Y-m-d h:i:s');
            $order['end_date'] = $date;
            $order->save();


        session(['address' => $address,'amount' => $amount,'currency_value' => $item_amount,'currency_sign' => $request->currency_sign,'accountnumber' => $acc]);

        return redirect('invest/bitcoin');

            //return redirect()->back()->with('message','Deposit Request Sent Successfully.');

        }
        return redirect()->back()->with('error','Please enter a valid amount.')->withInput();
        //return view('user.depositmoney');
    }

    public function getDepositCount()
    {
        $deposits = Deposit::where('accid',Auth::user()->id)->where('status','pending')->count();
        return $deposits;
    }

    public function getDepositData()
    {
        $deposits = Deposit::where('accid',Auth::user()->id)->where('status','pending')->orderBy('id','desc')->first();
        $totaldeposits = Deposit::where('accid',Auth::user()->id)->where('status','pending')->count();
        return response()->json([
                'status' => 'success',
                'amount' => $deposits->amount,
                'count' => $totaldeposits,
                'confirms' => 2,
                'message' => '<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Successfully Deposited '.$deposits->amount.' BTC</strong></div>'
            ]
            ,200);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
