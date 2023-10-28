<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\brand;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;

class BrandController extends Controller
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
            $data = brand::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('sl',function($row){
                        // $i = 1;
                        return $this->sl = $this->sl+1;
                    })
                    ->addColumn('brand_name',function($v){
                        if($this->lang == 'en')
                        {
                            return $v->brand_name_en;
                        }
                        elseif($this->lang == 'bn')
                        {
                            return $v->brand_name_bn;
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
                                <input type="checkbox" id="brandStatus-'.$v->id.'" '.$checked.' onclick="return brandStatusChange('.$v->id.')">
                                <span class="slider round"></span>
                            </label>';
                    })
                    ->addColumn('action', function($row){



                        return '<div class="btn-group">
                        <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cogs"></i> '.__('common.action').' <i class="fa fa-angle-down"></i></button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="'.route('brand.edit',$row->id).'"><i class="fa fa-edit"></i> '.__('common.edit').'</a>
                            </li>
                            <li>
                            <form method="post" action="'.route('brand.destroy',$row->id).'" id="deleteForm">
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
                    ->rawColumns(['sl','brand_name','order_by','status','action'])
                    ->make(true);
        }
        return view('backend.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.brand.create');
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
            'brand_name_en'=>$request->brand_name_en,
            'brand_name_bn'=>$request->brand_name_bn,
            'order_by'=>$request->order_by,
            'status'=>$request->status,
        );
        brand::create($data);
        Toastr::success(__('brand.create_message'), __('common.success'));
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
        $data = brand::find($id);
        return view('backend.brand.edit',compact('data'));
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
            'brand_name_en'=>$request->brand_name_en,
            'brand_name_bn'=>$request->brand_name_bn,
            'order_by'=>$request->order_by,
            'status'=>$request->status,
        );
        brand::find($id)->update($data);
        Toastr::success(__('brand.update_message'), __('common.success'));
        return redirect()->back();
    }

    public function brandStatusChange($id)
    {
       $check = brand::find($id);

       if($check->status == 1)
       {
        brand::find($id)->update(['status'=>0]);
       }
       else
       {
        brand::find($id)->update(['status'=>1]);
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
        brand::find($id)->delete();
        Toastr::success(__('brand.delete_message'), __('common.success'));
        return redirect()->back();
    }

    public function retrive_brand($id)
    {
        brand::where('id',$id)->withTrashed()->restore();
        Toastr::success(__('brand.retrive_message'), __('common.success'));
        return redirect()->back();
    }

    public function brand_per_delete($id)
    {
        brand::where('id',$id)->withTrashed()->forceDelete();
        Toastr::success(__('brand.permenant_delete'), __('common.success'));
        return redirect()->back();
    }
}
