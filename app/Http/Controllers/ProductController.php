<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use App\Models\categorie;
use App\Models\sub_categorie;
use App\Models\size_setting;
use App\Models\color;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;
use App\Models\product_size_info;
use App\Models\product_color_info;
use App\Models\product_image_info;

class ProductController extends Controller
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
            $data = product::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('sl',function($row){
                        // $i = 1;
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
                    ->addColumn('sub_cat_id',function($v){
                        if($v->sub_cat_id > 0)
                        {
                            $sub_cat_name = sub_categorie::where('id',$v->sub_cat_id)->first();
                        }
                        else
                        {
                            $sub_cat_name = '-';
                        }

                        if($v->sub_cat_id > 0)
                        {
                            if($this->lang == 'en')
                            {
                                return $sub_cat_name->sub_cat_name_en;
                            }
                            elseif($this->lang == 'bn')
                            {
                                return $sub_cat_name->sub_cat_name_bn;
                            }
                        }
                        else
                        {
                            $sub_cat_name = '-';
                        }

                    })
                    ->addColumn('product_name',function($v){
                        if($this->lang == 'en')
                        {
                            return $v->product_name_en;
                        }
                        elseif($this->lang == 'bn')
                        {
                            return $v->product_name_bn;
                        }
                    })
                    ->addColumn('regular_price',function($v){

                            return $v->regular_price;  
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
                                <input type="checkbox" id="productStatus-'.$v->id.'" '.$checked.' onclick="return productStatusChange('.$v->id.')">
                                <span class="slider round"></span>
                            </label>';
                    })
                    ->addColumn('action', function($row){



                        return '<div class="btn-group">
                        <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cogs"></i> '.__('common.action').' <i class="fa fa-angle-down"></i></button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="'.route('product.edit',$row->id).'"><i class="fa fa-edit"></i> '.__('common.edit').'</a>
                            </li>
                            <li>
                            <form method="post" action="'.route('product.destroy',$row->id).'" id="deleteForm">
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
                    ->rawColumns(['sl','cat_id','sub_cat_id','product_name','regular_price','discount_amount','status','action'])
                    ->make(true);
        }
        return view('backend.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat_name = categorie::all();
        $size = size_setting::orderBy('order_by')->get();
        $color = color::orderBy('order_by')->get();
        return view('backend.product.create',compact('cat_name','size','color'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = array(
            'cat_id'=>$request->cat_id,
            'sub_cat_id'=>$request->sub_cat_id,
            'product_name_en'=>$request->product_name_en,
            'product_name_bn'=>$request->product_name_bn,
            'regular_price'=>$request->regular_price,
            'discount_amount'=>$request->discount_amount,
            'min_quantity'=>$request->min_quantity,
            'short_details'=>$request->short_details,
            'description'=>$request->description,
            'information'=>$request->information,
            'status'=>$request->status,
        );

        
        $insert = product::create($data);

        $product_id = $insert->id;

        for ($i=0; $i < count($request->size); $i++) 
        { 
            product_size_info::create([
                'product_id'=>$product_id,
                'size_id'=>$request->size[$i]
            ]);
        }


        for ($i=0; $i < count($request->color); $i++) 
        { 
            product_color_info::create([
                'product_id'=>$product_id,
                'color_id'=>$request->color[$i],
            ]);
        }

        $file = $request->file('image');
        if($file)
        {

            for ($i=0; $i < count($file) ; $i++) 
            {
                $imageName[$i] = rand().'.'.$file[$i]->getClientOriginalExtension();

                $file[$i]->move(public_path().'/backend/img/productImage/',$imageName[$i]);

                product_image_info::create([
                    'product_id'=>$product_id,
                    'image'=>$imageName[$i],
                ]);
            }
        }

        Toastr::success(__('product.create_message'), __('common.success'));
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $cat_name = categorie::all();
        $size = size_setting::orderBy('order_by')->get();
        $color = color::orderBy('order_by')->get();

        $data = product::find($id);
        $sub_categorie = sub_categorie::where('cat_id',$data->cat_id)->get();
        $product_id = $id;

        // return $product_id;
        return view('backend.product.edit',compact('data','cat_name','size','color','sub_categorie','product_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array(
            'cat_id'=>$request->cat_id,
            'sub_cat_id'=>$request->sub_cat_id,
            'product_name_en'=>$request->product_name_en,
            'product_name_bn'=>$request->product_name_bn,
            'regular_price'=>$request->regular_price,
            'discount_amount'=>$request->discount_amount,
            'min_quantity'=>$request->min_quantity,
            'short_details'=>$request->short_details,
            'description'=>$request->description,
            'information'=>$request->information,
            'status'=>$request->status,
        );


        product_size_info::where('product_id',$id)->forceDelete();

        product_color_info::where('product_id',$id)->forceDelete();

        for ($i=0; $i < count($request->size); $i++) 
        { 
            product_size_info::create([
                'product_id'=>$id,
                'size_id'=>$request->size[$i]
            ]);
        }


        for ($i=0; $i < count($request->color); $i++) 
        { 
            product_color_info::create([
                'product_id'=>$id,
                'color_id'=>$request->color[$i],
            ]);
        }

        $file = $request->file('image');

        if($file)
        {
            $images = product_image_info::where('product_id',$id)->get();

            foreach($images as $i)
            {
                $path = public_path().'/backend/img/productImage/'.$i->image;
                if(file_exists($path))
                {
                    unlink($path);
                }
            }

            product_image_info::where('product_id',$id)->forceDelete();
        }

        if($file)
        {
            for ($i=0; $i < count($file) ; $i++) 
            {
                $imageName[$i] = rand().'.'.$file[$i]->getClientOriginalExtension();

                $file[$i]->move(public_path().'/backend/img/productImage/',$imageName[$i]);

                product_image_info::create([
                    'product_id'=>$id,
                    'image'=>$imageName[$i],
                ]);
            } 
        }

        

        product::find($id)->update($data);
        Toastr::success(__('product.update_message'), __('common.success'));
        return redirect()->back();
    }

    public function productStatusChange($id)
    {
       $check = product::find($id);

       if($check->status == 1)
       {
        product::find($id)->update(['status'=>0]);
       }
       else
       {
        product::find($id)->update(['status'=>1]);
       }

       return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        product_color_info::where('product_id',$id)->delete();
        product_size_info::where('product_id',$id)->delete();
        product_image_info::where('product_id',$id)->delete();

        product::find($id)->delete();
        Toastr::success(__('size.delete_message'), __('common.success'));
        return redirect()->back();
    }

    public function retrive_product($id)
    {
        product_color_info::where('product_id',$id)->withTrashed()->restore();
        product_size_info::where('product_id',$id)->withTrashed()->restore();
        product_image_info::where('product_id',$id)->withTrashed()->restore();


        product::where('id',$id)->withTrashed()->restore();

        Toastr::success(__('product.retrive_message'), __('common.success'));
        return redirect()->back();
    }

    public function product_per_delete($id)
    {

        $images = product_image_info::where('product_id',$id)->onlyTrashed()->get();

            foreach($images as $i)
            {
                $path = public_path().'/backend/img/productImage/'.$i->image;
                if(file_exists($path))
                {
                    unlink($path);
                }
            }

        product_color_info::where('product_id',$id)->withTrashed()->forceDelete();
        product_size_info::where('product_id',$id)->withTrashed()->forceDelete();
        product_image_info::where('product_id',$id)->withTrashed()->forceDelete();

        product::where('id',$id)->withTrashed()->forceDelete();
        Toastr::success(__('product.permenant_delete'), __('common.success'));
        return redirect()->back();
    }

    public function GetSubCategorie($cat_id)
    {
        // return $cat_id;
        $this->lang = config('app.locale');
        $data = sub_categorie::where('cat_id',$cat_id)->get();

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
            if($this->lang == 'en')
            {

                $sl_data .= '<option value="'.$v->id.'">'.$v->sub_cat_name_en.'</option>';
            }
            elseif($this->lang == 'bn')
            {
                $sl_data .= '<option value="'.$v->id.'">'.$v->sub_cat_name_bn.'</option>';
            }
        }
        return $sl_data;
    }
}
