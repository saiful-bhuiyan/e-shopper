<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\price_range;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;

class PricerangeController extends Controller
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
            $data = price_range::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('sl',function($row){
                        // $i = 1;
                        return $this->sl = $this->sl+1;
                    })
                    ->addColumn('from',function($v){
                        return $v->from;
                    })
                    ->addColumn('to',function($v){
                        return $v->to;
                    })
                    ->addColumn('order_by',function($v){
                        return $v->order_by;
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
                                    <input type="checkbox" id="PriceRangeStatus-'.$v->id.'" '.$checked.' onclick="return PriceRangeStatusChange('.$v->id.')">
                                    <span class="slider round"></span>
                                </label>';
                    })
                    ->addColumn('action', function($row){



                        return '<div class="btn-group">
                        <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cogs"></i> '.__('common.action').' <i class="fa fa-angle-down"></i></button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="'.route('price_range.edit',$row->id).'"><i class="fa fa-edit"></i> '.__('common.edit').'</a>
                            </li>
                            <li>
                            <form method="post" action="'.route('price_range.destroy',$row->id).'" id="deleteForm">
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
                    ->rawColumns(['sl','from','to','order_by','status','action'])
                    ->make(true);
        }
        return view('backend.price_range.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.price_range.create');
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
            'from'=>$request->from,
            'to'=>$request->to,
            'order_by'=>$request->order_by,
            'status'=>$request->status,
        );
        price_range::create($data);
        Toastr::success(__('price_range.create_message'), __('common.success'));
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
        $data = price_range::find($id);
        return view('backend.price_range.edit',compact('data'));
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
            'from'=>$request->from,
            'to'=>$request->to,
            'order_by'=>$request->order_by,
            'status'=>$request->status,
        );
        price_range::find($id)->update($data);
        Toastr::success(__('price_range.update_message'), __('common.success'));
        return redirect()->back();
    }

    public function PriceRangeStatusChange($id)
    {
       $check = price_range::find($id);

       if($check->status == 1)
       {
            price_range::find($id)->update(['status'=>0]);
       }
       else
       {
            price_range::find($id)->update(['status'=>1]);
       }

       return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        price_range::find($id)->delete();
        Toastr::success(__('price_range.delete_message'), __('common.success'));
        return redirect()->back();
    }

    public function retrive_price_range($id)
    {
        price_range::where('id',$id)->withTrashed()->restore();
        Toastr::success(__('price_range.retrive_message'), __('common.success'));
        return redirect()->back();
    }

    public function price_range_per_delete($id)
    {
        price_range::where('id',$id)->withTrashed()->forceDelete();
        Toastr::success(__('price_range.permenant_delete'), __('common.success'));
        return redirect()->back();
    }
}
