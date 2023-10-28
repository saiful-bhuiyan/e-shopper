<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\trend;
use App\Models\categorie;
use App\Models\product;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\add_product_to_trend;
use App\Models\trend_product_info;
use DataTables;

class AddProductToTrendController extends Controller
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
            $data = add_product_to_trend::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('sl',function($row){
                        return $this->sl = $this->sl+1;
                    })
                    ->addColumn('cat_id',function($v){
                        if($v->cat_id > 0)
                        {
                            $cat_name = categorie::where('id',$v->cat_id)->first();
                        }
                        else
                        {
                            $cat_name = '-';
                        }

                        if($v->cat_id > 0)
                        {
                            if($this->lang == 'en')
                            {
                                return $cat_name->cat_name_en;
                            }
                            elseif($this->lang == 'bn')
                            {
                                return $cat_name->cat_name_bn;
                            }
                        }
                        else
                        {
                            $cat_name = '-';
                        }

                    })

                    ->addColumn('trend_id',function($v){
                        if($v->trend_id > 0)
                        {
                            $trend_name = trend::where('id',$v->trend_id)->first();
                        }
                        else
                        {
                            $trend_name = '-';
                        }

                        if($v->trend_id > 0)
                        {
                            if($this->lang == 'en')
                            {
                                return $trend_name->trend_name_en;
                            }
                            elseif($this->lang == 'bn')
                            {
                                return $trend_name->trend_name_bn;
                            }
                        }
                        else
                        {
                            $trend_name = '-';
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
                                <input type="checkbox" id="addProductToTrendStatus-'.$v->id.'" '.$checked.' onclick="return addProductToTrendStatusChange('.$v->id.')">
                                <span class="slider round"></span>
                            </label>';
                    })
                    ->addColumn('action', function($row){



                        return '<div class="btn-group">
                        <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cogs"></i> '.__('common.action').' <i class="fa fa-angle-down"></i></button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="'.route('add_product_to_trend.edit',$row->id).'"><i class="fa fa-edit"></i> '.__('common.edit').'</a>
                            </li>
                            <li>
                            <form method="post" action="'.route('add_product_to_trend.destroy',$row->id).'" id="deleteForm">
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
                    ->rawColumns(['sl','cat_id','trend_id','status','action'])
                    ->make(true);
        }
        return view('backend.add_product_to_trend.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trend_name = trend::all();

        $categorie = categorie::all();

        return view('backend.add_product_to_trend.create',compact('trend_name','categorie'));
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
            'cat_id'=>$request->cat_id,
            'trend_id'=>$request->trend_id,
        );

        $trend_count = add_product_to_trend::where('cat_id',$request->cat_id)->where('trend_id',$request->trend_id)->count();

        if($trend_count == 0)
        {
            $insert = add_product_to_trend::create($data);
        }
        
        trend_product_info::where('cat_id',$request->cat_id)->where('trend_id',$request->trend_id)->delete();

        for ($i=0; $i < count($request->product); $i++) 
        {
                
                trend_product_info::create([
                    'cat_id'=>$request->cat_id,
                    'trend_id'=>$request->trend_id,
                    'product_id'=>$request->product[$i],
                ]);
            
        }
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
        $data = add_product_to_trend::find($id);

        $trend_name = trend::all();

        $categorie = categorie::all();

        return view('backend.add_product_to_trend.edit',compact('data','trend_name','categorie'));
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
        trend_product_info::where('cat_id',$request->cat_id)->where('trend_id',$request->trend_id)->delete();

        for ($i=0; $i < count($request->product); $i++) 
        {
                
                trend_product_info::create([
                    'cat_id'=>$request->cat_id,
                    'trend_id'=>$request->trend_id,
                    'product_id'=>$request->product[$i],
                ]);
            
        }
        Toastr::success(__('trend.update_message'), __('common.success'));
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
        //
    }

    public function GetSelectProduct($cat_id)
    {
        // return $cat_id;
        $this->lang = config('app.locale');
        $data = product::where('cat_id',$cat_id)->get();

        $sl_data = '';


        foreach($data as $v)
        {
            $trend_product = trend_product_info::where('cat_id',$cat_id)->get();
            $checked = '';

            foreach($trend_product as $t)
            {
                if($t->product_id == $v->id)
                {
                    $checked = 'checked';
                }
            }

            if($this->lang == 'en')
            {

                $sl_data .= '<div class="row">
                                <div class="checkbox form-check col-lg-3 col-md-4 col-sm-6">
                                    <label>
                                        <input type="checkbox" '.$checked.' name="product[]" value="'.$v->id.'">
                                        '.$v->product_name_en.'
                                    </label>
                                </div>
                            </div>';
            }
            elseif($this->lang == 'bn')
            {
                $sl_data .= '<div class="row">
                                <div class="checkbox form-check col-lg-3 col-md-4 col-sm-6">
                                    <label>
                                        <input type="checkbox" '.$checked.' name="product[]" value="'.$v->id.'">
                                        '.$v->product_name_bn.'
                                    </label>
                                </div>
                            </div>';
            }
        }
        return $sl_data;
    }
}
