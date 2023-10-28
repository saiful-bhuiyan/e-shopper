<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;
use App\Models\division_information;
use App\Models\district_information;
use App\Models\order_info;
use App\Models\upazila_information;


class GuestOrderController extends Controller
{
    protected $lang;

    protected $sl;

    public function user_order(Request $request)
    {
        $this->lang = config ("app.locale");
        $this->sl = 0;
        if ($request->ajax()) {
            $data = order::orderBy('id','DESC')->where('status','0')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('sl',function($row){
                        return $this->sl = $this->sl+1;
                    })
                    ->addColumn('name',function($v){

                        return $v->name;  
                    })
                    ->addColumn('mobile',function($v){

                        return $v->mobile_no;  
                    })
                    ->addColumn('product_info',function($v){
                        $products  = order_info::leftjoin('products','products.id','order_infos.product_id')
                        ->leftjoin('size_settings','size_settings.id','order_infos.size_id')
                        ->leftjoin('colors','colors.id','order_infos.color_id')
                        ->select('products.product_name_en','size_settings.size_name_en','colors.color_name_en','order_infos.*')
                        ->where('order_infos.order_id',$v->id)->get();
                            $output = '';
                        foreach($products as $p)
                        {
                            $output .='<li>'.$p->product_name_en.'('.$p->size_name_en.', '.$p->color_name_en.') [ '.$p->qty.' * '.$p->price.' ] = '.$p->qty * $p->price.'</li>';
                        }

                        return $output;
                    })
                    ->addColumn('division_id',function($v){
                        if($v->division_id > 0)
                        {
                            $division_name = division_information::where('id',$v->division_id)->first();
                        }
                        else
                        {
                            $division_name = '-';
                        }

                        return $division_name->division_name;

                    })
                    ->addColumn('district_id',function($v){
                        if($v->district_id > 0)
                        {
                            $district_name = district_information::where('id',$v->district_id)->first();
                        }
                        else
                        {
                            $district_name = '-';
                        }

                        return $district_name->district_name;

                    })
                    
                    ->addColumn('address',function($v){

                            return $v->address;  
                    })
                    ->addColumn('total',function($v){

                        $total = $v->total;
                        $total += $v->shipping_cost;
                        $total -= $v->cuppon_amount;
                        
                        return $total;  
                    })
                    ->addColumn('status', function($row){
                        return '<div><a href="'.url('updateOrderStatus',$row->id).'">
                        <button class="btn btn-success">'.__('user_order.accept').' </button>
                        </a>
                    </div>';

                    })
                    ->rawColumns(['sl','name','mobile','division_id','district_id','address','total','status','product_info'])
                    ->make(true);
        }
        return view('backend.user_order.index');
    }

    public function updateOrderStatus($id)
    {
        order::find($id)->update(['status'=>1]);

        Toastr::success(__('user_order.update_message'), __('common.success'));
        return redirect()->back();
    }
}
