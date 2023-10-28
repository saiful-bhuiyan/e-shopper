<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cuppon;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;

class CupponController extends Controller
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
            $data = cuppon::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('sl',function($row){
                        // $i = 1;
                        return $this->sl = $this->sl+1;
                    })
                    ->addColumn('cuppon_code',function($v){
                        return $v->cuppon_code;
                    })
                    ->addColumn('discount_amount',function($v){
                        return $v->discount_amount;
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
                                <input type="checkbox" id="cupponStatus-'.$v->id.'" '.$checked.' onclick="return cupponStatusChange('.$v->id.')">
                                <span class="slider round"></span>
                            </label>';
                    })
                    ->addColumn('action', function($row){



                        return '<div class="btn-group">
                        <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cogs"></i> '.__('common.action').' <i class="fa fa-angle-down"></i></button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="'.route('cuppon.edit',$row->id).'"><i class="fa fa-edit"></i> '.__('common.edit').'</a>
                            </li>
                            <li>
                            <form method="post" action="'.route('cuppon.destroy',$row->id).'" id="deleteForm">
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
                    ->rawColumns(['sl','cuppon_code','discount_amount','status','action'])
                    ->make(true);
        }
        return view('backend.cuppon.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.cuppon.create');
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
            'cuppon_code'=>$request->cuppon_code,
            'discount_amount'=>$request->discount_amount,
            'status'=>$request->status,
        );
        cuppon::create($data);
        Toastr::success(__('cuppon.create_message'), __('common.success'));
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
        $data = cuppon::find($id);
        return view('backend.cuppon.edit',compact('data'));
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
            'cuppon_code'=>$request->cuppon_code,
            'discount_amount'=>$request->discount_amount,
            'status'=>$request->status,
        );

        cuppon::find($id)->update($data);
        Toastr::success(__('cuppon.update_message'), __('common.success'));
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
        cuppon::find($id)->delete();
        Toastr::success(__('cuppon.delete_message'), __('common.success'));
        return redirect()->back();
    }

    public function cupponStatusChange($id)
    {
       $check = cuppon::find($id);

       if($check->status == 1)
       {
           cuppon::find($id)->update(['status'=>0]);
       }
       else
       {
           cuppon::find($id)->update(['status'=>1]);
       }

       return 1;
    }

    public function retrive_cuppon($id)
    {
        cuppon::where('id',$id)->withTrashed()->restore();
        Toastr::success(__('cuppon.retrive_message'), __('common.success'));
        return redirect()->back();
    }

    public function cuppon_per_delete($id)
    {
        cuppon::where('id',$id)->withTrashed()->forceDelete();
        Toastr::success(__('cuppon.permenant_delete'), __('common.success'));
        return redirect()->back();
    }
}
