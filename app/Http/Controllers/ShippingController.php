<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\division_information;
use App\Models\district_information;
use App\Models\shipping;
use App\Models\upazila_information;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;


class ShippingController extends Controller
{
    protected $lang;
    protected $sl;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->lang = config ("app.locale");
        $this->sl = 0;
        if ($request->ajax()) {
            $data = shipping::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('sl',function($row){

                        return $this->sl = $this->sl+1;
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
                    ->addColumn('upazila_id',function($v){
                        if($v->upazila_id > 0)
                        {
                            $upazila_name = upazila_information::where('id',$v->upazila_id)->first();
                        }
                        else
                        {
                            $upazila_name = '-';
                        }

                        return $upazila_name->upazila_name;

                    })
                    ->addColumn('charge',function($v){
                        
                        return $v->charge;
                    })
                    ->addColumn('status',function($v){
                        if($v->status == 1)
                        {
                            $checked = 'checked';
                        }
                        else
                        {
                            $checked = '';
                        }

                        return '<label class="switch rounded">
                                <input type="checkbox" id="shippingStatus-'.$v->id.'" '.$checked.' onclick="return shippingStatusChange('.$v->id.')">
                                <span class="slider round"></span>
                            </label>';
                    })
                    ->addColumn('action', function($row){



                        return '<div class="btn-group">
                        <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cogs"></i> '.__('common.action').' <i class="fa fa-angle-down"></i></button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="'.route('shipping.edit',$row->id).'"><i class="fa fa-edit"></i> '.__('common.edit').'</a>
                            </li>
                            <li>
                            <form method="post" action="'.route('shipping.destroy',$row->id).'" id="deleteForm">
                            '.csrf_field().'
                            '.method_field('DELETE').'
                            <button onclick="return confirmation();" class="dropdown-item" type="submit">
                                <i class="fa fa-trash"></i> '.__('common.delete').'
                            </button>
                            </form>
                            </li>

                        </ul>
                    </div>';

                    })
                    ->rawColumns(['sl','division_id','district_id','upazila_id','charge','status','action'])
                    ->make(true);
        }
        return view('backend.shipping.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $division = division_information::all();

        return view('backend.shipping.create',compact('division'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array(
            'division_id'=>$request->division_id,
            'district_id'=>$request->district_id,
            'upazila_id'=>$request->upazila_id,
            'charge'=>$request->charge,
            'status'=>$request->status
        );

        $insert = shipping::create($data);

        Toastr::success(__('shipping.create_message'), __('common.success'));
        return redirect()->back();
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
        $shipping = shipping::where('id',$id)->first();
        $division = division_information::all();
        $div_info = division_information::where('id',$shipping->division_id)->first();
        $dis_info = district_information::where('id',$shipping->district_id)->first();
        $upazila_info = upazila_information::where('id',$shipping->upazila_id)->first();

        return view('backend.shipping.edit',compact('shipping','division','div_info','dis_info','upazila_info'));
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
        $data = array(
            'division_id'=>$request->division_id,
            'district_id'=>$request->district_id,
            'upazila_id'=>$request->upazila_id,
            'charge'=>$request->charge,
            'status'=>$request->status
        );

        shipping::find($id)->update($data);
        Toastr::success(__('shipping.update_message'), __('common.success'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        shipping::find($id)->delete();
        Toastr::success(__('shipping.delete_message'), __('common.success'));
        return redirect()->back();
    }

    public function GetDistrict($division_id)
    {

        $this->lang = config('app.locale');
        $data = district_information::where('division_id',$division_id)->get();

        if($this->lang == 'en')
        {
            $sl_data = '<option value="">Select One</option>';
        }
        elseif($this->lang == 'bn')
        {
            $sl_data = '<option value="">নির্বাচন করুন</option>';
        }


        foreach($data as $v)
        {
            
            $sl_data .= '<option value="'.$v->id.'">'.$v->district_name.'</option>';

        }
        return $sl_data;
    }

    public function GetUpazila($district_id)
    {
        $this->lang = config('app.locale');
        $data = upazila_information::where('district_id',$district_id)->get();

        if($this->lang == 'en')
        {
            $sl_data = '<option value="">Select One</option>';
        }
        elseif($this->lang == 'bn')
        {
            $sl_data = '<option value="">নির্বাচন করুন</option>';
        }


        foreach($data as $v)
        {
            
            $sl_data .= '<option value="'.$v->id.'">'.$v->upazila_name.'</option>';

        }
        return $sl_data;
    }


    public function shippingStatusChange($id)
    {
       $check = shipping::find($id);

       if($check->status == 1)
       {
        shipping::find($id)->update(['status'=>0]);
       }
       else
       {
        shipping::find($id)->update(['status'=>1]);
       }

       return 1;
    }
}
