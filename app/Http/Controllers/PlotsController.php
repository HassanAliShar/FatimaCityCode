<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Block_category;
use App\Models\Plot;
use Illuminate\Http\Request;

class PlotsController extends Controller
{
    public function index(){
        $plots = Plot::with('block')->get();
        return view('plots.manage',compact('plots'));
    }

    public function add(){
        $blocks = Block::all();

        $block_cat = Block_category::all();
        return view('plots.add',compact('blocks','block_cat'));
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|numeric',
            'block' => 'required|numeric',
            'type' => 'required|numeric',
            'size' => 'required|string',
            'total_price' => 'required|numeric',
            'downpay' => 'required|numeric',
            'installmentpay' => 'required|numeric',
        ]);
        $plot = new Plot();
        $plot->name = "Plot ".$request->name;
        $plot->block_id = $request->block;
        $plot->block_type_id = $request->type;
        $plot->size = $request->size;
        $plot->total_price = $request->total_price;
        $plot->down_payment = $request->downpay;
        $plot->status = 0;
        $plot->ins_payment = $request->installmentpay;
        if($plot->save()){
            return redirect('plots/add')->with('success','Plot Added Successfully');
        }
        else{
            return redirect()->back()->with('error','Plot Not Added');
        }
    }

    public function show_plot_blockid($block_id,$cat_id){
        $plots = Plot::where('block_id',$block_id)->where('block_type_id',$cat_id)->where('status',0)->get();

        return $plots;
    }

    public function getplot($id){
        $plot = Plot::find($id);
        return $plot;
    }
}
