<?php

namespace App\Http\Controllers\Admin;

use Datatables;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = Product::orderBy('id','desc')->get();
         
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)

                            ->editColumn('price', function(Product $data) {
                                $sign = Currency::where('is_default','=',1)->first();
                                $price = $sign->sign.$data->price;
                                return  $price;
                            })
                            ->addColumn('action', function(Product $data) {
                                return '<div class="action-list"><a href="' . route('admin-prod-edit',$data->id) . '"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="' . route('admin-prod-delete',$data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            }) 
                            ->rawColumns(['action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }


    //*** GET Request
    public function index()
    {
        return view('admin.product.index');
    }

    public function info()
    {
        return view('admin.product.info');
    }

    //*** GET Request
    public function create()
    {
        $sign = Currency::where('is_default','=',1)->first();
        return view('admin.product.create',compact('sign'));
    }

    //*** GET Request
    public function status($id1,$id2)
    {
        $data = Product::findOrFail($id1);
        $data->status = $id2;
        $data->update();
    }

    //*** POST Request
    public function store(Request $request)
    {
        
        //--- Logic Section 
            $percentage = $request->percentage;  
            $data = new Product;
            $input = $request->all();

            if($percentage>=100)
            {
                $input['percentage'] =  $percentage;
                $data->fill($input)->save();
                //logic Section Ends

                //--- Redirect Section        
                $msg = 'New Plan Added Successfully.<a href="'.route('admin-prod-index').'">View Plan Lists.</a>';
                return response()->json($msg);      
                //--- Redirect Section Ends  
            }
            else{
                $msg = 'Payout Rate Must be Larger than 100%';
                return response()->json(array('errors' => $msg));
            }
              
    }
 
    //*** GET Request
    public function edit($id)
    {
        $data = Product::findOrFail($id);
        $sign = Currency::where('is_default','=',1)->first();
        return view('admin.product.edit',compact('data','sign'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //-- Logic Section
        $data = Product::findOrFail($id);
        $input = $request->all();
        $percentage = $request->percentage; 
        if($percentage>=100)
            {
                $input['percentage'] =  $percentage;
                $data->update($input);
                //logic Section Ends
                
                //--- Redirect Section        
                $msg = 'Plan Updated Successfully.<a href="'.route('admin-prod-index').'">View Plan Lists.</a>';
                return response()->json($msg);      
                //--- Redirect Section Ends    
            }
            else{
                $msg = 'Payout Rate Must be Larger than 100%';
                return response()->json(array('error' => $msg));
            }
        
    }

    //*** GET Request
    public function destroy($id)
    {
        $data = Product::findOrFail($id);
        $data->delete();
        //--- Redirect Section     
        $msg = 'Plan Deleted Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends    

        // PRODUCT DELETE ENDS  
    }
}
