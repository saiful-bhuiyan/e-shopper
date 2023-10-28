<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\size_setting;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;

class SizeController extends Controller
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
            $data = size_setting::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('sl',function($row){
                        // $i = 1;
                        return $this->sl = $this->sl+1;
                    })
                    ->addColumn('size_name',function($v){
                        if($this->lang == 'en')
                        {
                            return $v->size_name_en;
                        }
                        elseif($this->lang == 'bn')
                        {
                            return $v->size_name_bn;
                        }
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
                                <input type="checkbox" id="sizeStatus-'.$v->id.'" '.$checked.' onclick="return sizeStatusChange('.$v->id.')">
                                <span class="slider round"></span>
                            </label>';
                    })
                    ->addColumn('action', function($row){



                        return '<div class="btn-group">
                        <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cogs"></i> '.__('common.action').' <i class="fa fa-angle-down"></i></button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="'.route('size_setting.edit',$row->id).'"><i class="fa fa-edit"></i> '.__('common.edit').'</a>
                            </li>
                            <li>
                            <form method="post" action="'.route('size_setting.destroy',$row->id).'" id="deleteForm">
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
                    ->rawColumns(['sl','size_name','order_by','status','action'])
                    ->make(true);
        }

        return view('backend.size_setting.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.size_setting.create');
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
            'size_name_en'=>$request->size_name_en,
            'size_name_bn'=>$request->size_name_bn,
            'order_by'=>$request->order_by,
            'status'=>$request->status,
        );
        size_setting::create($data);
        Toastr::success(__('size.create_message'), __('common.success'));
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
        $data = size_setting::find($id);
        return view('backend.size_setting.edit',compact('data'));
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
            'size_name_en'=>$request->size_name_en,
            'size_name_bn'=>$request->size_name_bn,
            'order_by'=>$request->order_by,
            'status'=>$request->status,
        );
        size_setting::find($id)->update($data);
        Toastr::success(__('size.update_message'), __('common.success'));
        return redirect()->back();
    }

    public function sizeStatusChange($id)
    {
       $check = size_setting::find($id);

       if($check->status == 1)
       {
        size_setting::find($id)->update(['status'=>0]);
       }
       else
       {
        size_setting::find($id)->update(['status'=>1]);
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
        size_setting::find($id)->delete();
        Toastr::success(__('size.delete_message'), __('common.success'));
        return redirect()->back();
    }

    public function retrive_size($id)
    {
        size_setting::where('id',$id)->withTrashed()->restore();
        Toastr::success(__('size.retrive_message'), __('common.success'));
        return redirect()->back();
    }

    public function size_per_delete($id)
    {
        size_setting::where('id',$id)->withTrashed()->forceDelete();
        Toastr::success(__('size.permenant_delete'), __('common.success'));
        return redirect()->back();
    }
}
