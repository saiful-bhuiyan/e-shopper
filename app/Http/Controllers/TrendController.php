<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\trend;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;

class TrendController extends Controller
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
            $data = trend::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('sl',function($row){
                        // $i = 1;
                        return $this->sl = $this->sl+1;
                    })
                    ->addColumn('trend_name',function($v){
                        if($this->lang == 'en')
                        {
                            return $v->trend_name_en;
                        }
                        elseif($this->lang == 'bn')
                        {
                            return $v->trend_name_bn;
                        }
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
                                <input type="checkbox" id="trendStatus-'.$v->id.'" '.$checked.' onclick="return trendStatusChange('.$v->id.')">
                                <span class="slider round"></span>
                            </label>';
                    })
                    ->addColumn('action', function($row){



                        return '<div class="btn-group">
                        <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cogs"></i> '.__('common.action').' <i class="fa fa-angle-down"></i></button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="'.route('trend.edit',$row->id).'"><i class="fa fa-edit"></i> '.__('common.edit').'</a>
                            </li>
                            <li>
                            <form method="post" action="'.route('trend.destroy',$row->id).'" id="deleteForm">
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
                    ->rawColumns(['sl','trend_name','status','action'])
                    ->make(true);
        }
        return view('backend.trend.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.trend.create');
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
            'trend_name_en'=>$request->trend_name_en,
            'trend_name_bn'=>$request->trend_name_bn,
            'status'=>$request->status,
        );

        trend::create($data);
        Toastr::success(__('trend.create_message'), __('common.success'));
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
        $data = trend::find($id);

        return view('backend.trend.edit',compact('data'));
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
            'trend_name_en'=>$request->trend_name_en,
            'trend_name_bn'=>$request->trend_name_bn,
            'status'=>$request->status,
        );

        trend::find($id)->update($data);
        Toastr::success(__('trend.update_message'), __('common.success'));
        return redirect()->back();
    }

    public function trendStatusChange($id)
    {
       $check = trend::find($id);

       if($check->status == 1)
       {
            trend::find($id)->update(['status'=>0]);
       }
       else
       {
            trend::find($id)->update(['status'=>1]);
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
        trend::find($id)->delete();
        Toastr::success(__('trend.delete_message'), __('common.success'));
        return redirect()->back();
    }

    public function retrive_trend($id)
    {
        trend::where('id',$id)->withTrashed()->restore();
        Toastr::success(__('trend.retrive_message'), __('common.success'));
        return redirect()->back();
    }

    public function trend_per_delete($id)
    {
        trend::where('id',$id)->withTrashed()->forceDelete();
        Toastr::success(__('trend.permenant_delete'), __('common.success'));
        return redirect()->back();
    }
}
