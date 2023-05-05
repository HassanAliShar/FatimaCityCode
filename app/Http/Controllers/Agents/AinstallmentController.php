<?php

namespace App\Http\Controllers\Agents;

use App\Http\Controllers\Controller;
use App\Models\Booking_installment;
use App\Models\Booking_order;
use App\Models\Customer;
use App\Models\Franchise;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AinstallmentController extends Controller
{
    public function create(){
        $customer = Customer::where('created_by',session()->get('id'))->get();
        return view('agents.installments.add',compact('customer'));
    }

    public function show_customer_info($id){
        $customer_info = Customer::with('installments')->find($id);

        return $customer_info;
    }

    public function show($id){
        $installment = Customer::with('bookings')->with('installments')->with('booking_orders')->where('id',$id)->where('created_by',session()->get('id'))->first();
        // dd($installment);
        return view('agents.installments.manage',compact('installment'));
    }

    public function viwe_all_invoices($id){
        $invoice = Customer::with('bookings')->with('installments')->with('booking_orders')->find($id);
        $date =  Carbon::now()->format('d/m/yy');
        $count_installment = $invoice->installments->count();
        // dd($invoice->bookings->down_payment);
        // dd($installment);
        return view('agents.installments.all_invoice',compact('invoice','date','count_installment'));
    }

    public function store(Request $request){
        $installment = new Booking_installment();
        $installment->booking_order_id = $request->booking_order_id;
        $installment->booking_id = $request->booking_id;
        $installment->customer_id = $request->customer_id;
        $installment->installment_amount = $request->ins_amount;
        $installment->installment_details= $request->ins_details;

        $booking_order = Booking_order::with('user.franchise')->find($request->booking_order_id);
        $total = $booking_order->total_amount;
        $booking_order->total_amount = $total - $request->ins_amount;

        $booking_order->save();

        if($installment->save()){
            $franchise = Franchise::where('user_id',$booking_order->user->id)->first();
            // dd($franchise);
            if($franchise != null){
                $franchise->total_amount += $request->ins_amount;
                $franchise->save();
            }
            return redirect('/agent/get_unique_invoice/'.$installment->id.'/'.$request->customer_id);
        //    return redirect('add/installment')->with('success','Installment Paid Successfully');
        }
        else{
            return redirect()->back()->with('error','Installment Not paid Server Issu');
        }
    }
    public function get_unique_invoice($ins_id,$id){
        $invoice = Customer::with('bookings')->with('installments')->with('booking_orders')->find($id);
        $date =  Carbon::now()->format('d/m/yy');
        $current_installent = Booking_installment::find($ins_id);
        $count_installment = $current_installent->count();
        return view('agents.installments.previus_invoice',compact('invoice','date','count_installment','current_installent'));
    }

    public function delete_invoice($id,$c_id){
        $installment = Booking_installment::find($id);
        $deleted_installment_amount = $installment->installment_amount;
        $booking_order = Booking_order::find($installment->booking_order_id);
        if($installment->delete()){
            $booking_order->total_amount += $deleted_installment_amount;
            if($booking_order->save()){
                return redirect('/agent/installment/show/'.$c_id);
            }
        }
    }

    public function edit_installment($id){
        $installment = Booking_installment::find($id);
        return view('agents.installments.edit',compact('installment'));
    }

    public function update_customer_installment(Request $request){
        $installment = Booking_installment::find($request->id);
        $amount = $installment->installment_amount -=$request->ins_amount;
        $installment->installment_amount = $request->ins_amount;
        $installment->installment_details = $request->ins_details;
        if($installment->save()){
            $booking = Booking_order::find($request->booking_order_id);
            $booking->total_amount += $amount;
            if($booking->save()){
                return redirect('/agent/edit_customer_installment/'.$request->id)->with('success','Insallmemnt Updated');
            }
            else{
                return redirect()->back()-with('error','Installment Not Update');
            }
        }
    }

    public function create_customer_installment($c_id,$b_o_id,$b_id){
        return $c_id." ".$b_o_id." ".$b_id;
    }
}
