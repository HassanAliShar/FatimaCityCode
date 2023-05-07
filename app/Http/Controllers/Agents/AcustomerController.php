<?php

namespace App\Http\Controllers\Agents;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Block_category;
use App\Models\Booking;
use App\Models\Booking_installment;
use App\Models\Booking_order;
use App\Models\Customer;
use App\Models\Franchise;
use App\Models\Nominee;
use App\Models\Plot;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AcustomerController extends Controller
{
    public function index(){
        $customer = Customer::with('bookings')->with('booking.plot')->where('created_by',session()->get('id'))->get();
        // dd($customer);
        return view('agents.customers.manage',compact('customer'));
    }
    public function add(){
        $blocks = Block::all();
        $block_cat = Block_category::all();
        return view('agents.customers.add',compact('blocks','block_cat'));
    }

    function checkUser(){
        
        
        // dd($franchise);
    }

    public function store(Request $request){
        try{

            $request->validate([
                
                'name'=>'required|string|max:50',
                'email' => 'nullable',
                'mobile_no' => 'required|max:12|min:10',
                'cnic_no' => 'nullable|numeric|min:12|max:14',
                'phone' => 'nullable|numeric|min:10|max:12',
                'address' => 'required',
                'gender' => 'required',
                'p_address' => 'nullable',
                'passport' => 'nullable',
                'gardion' => 'nullable|string',
                'relation' => 'nullable',
                'n_email' => 'nullable',
                'preferred_choices'=>'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'n_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            DB::beginTransaction();
            $customer = new Customer();
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->mobile_no = $request->mobile_no;
            $customer->cnic_no = $request->cnic_no;
            $customer->phone = $request->phone;
            $customer->perment_address = $request->address;
            $customer->postal_address = $request->p_address;
            $customer->gender = $request->gender;
            if ($files = $request->file('image')){
                // Define upload path
                $destinationPath = public_path('/customer_images/'); // upload path
                // Upload Orginal Image
                $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profileImage);
    
                $insert['image'] = "$profileImage";
                // Save In Database
                $$customer->image="$profileImage";
            }
            $customer->passport = $request->passport;
            $customer->guardian = $request->gardion;
            $customer->relation = $request->relation;
            $customer->status = 0;
            $customer->created_by = $request->created_by;
            $customer->save();
            // $customer = Customer::orderby('id','desc')->first();
    
            $nominee = new Nominee();
            $nominee->name = $request->n_name;
            $nominee->email = $request->n_email;
            $nominee->mobile_no = $request->n_mobile_no;
            $nominee->cnic_no = $request->n_cnic_no;
            $nominee->phone = $request->n_phone;
            $nominee->perment_address = $request->n_address;
            $nominee->postal_address = $request->n_p_address;
            $nominee->passport = $request->n_passport;
            if ($files = $request->file('n_image')){
                // Define upload path
                $destinationPath = public_path('/customer_images/'); // upload path
                // Upload Orginal Image
                $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profileImage);
    
                $insert['image'] = "$profileImage";
                // Save In Database
                $$customer->image="$profileImage";
            }
            $nominee->gender = $request->n_gender;
            $nominee->guardian = $request->n_gardion;
            $nominee->relation = $request->n_relation;
            $nominee->customer_id = $customer->id;
    
            $nominee->save();
    
            $order = new Booking_order();
            $total_price = $request->total_price - ($request->installment + $request->d_payment);
            $order->total_amount = $total_price;
            $order->created_by = $request->created_by;
            $order->customer_id = $customer->id;
            $order->status = 0;
            $order->save();
    
            // $booking_order = Booking_order::orderby('id','desc')->first();
            $booking = new Booking();
            $booking->booking_orders_id = $order->id;
            $booking->customer_id = $customer->id;
            $booking->plot_id = $request->plot;
            $booking->created_by = $request->created_by;
            $booking->total_amount = $request->total_price;
            $booking->down_payment = $request->d_payment;
            $booking->pre_choice = $request->preferred_choices;
            $booking->save();
    
            // $last_booking = Booking::orderby('id','desc')->first();
            $installment = new Booking_installment();
            $installment->booking_order_id = $order->id;
            $installment->booking_id = $booking->id;
            $installment->customer_id = $customer->id;
            $installment->installment_amount = $request->installment;
    
            if($installment->save()){
                $franchise = Franchise::where('user_id',session('id'))->first();
                $franchise->total_amount += $request->installment+$request->d_payment;
                $franchise->save();
    
                $plot_status = Plot::find($request->plot);
                $plot_status->status = 1;
                $plot_status->save();
                DB::commit();
                return redirect('/agent/customer/add')->with('success','Added Succssfully');
            }
            else{
                DB::rollBack();
                return redirect()->back()->with('error','Recode Not Added');
            }
        }
        catch(Exception $ex){
            DB::rollBack();
            return redirect()->back()->with('error','Data Not Added into Database');
        }
    }

    public function show_customer($id){
        $customer_info = Customer::find($id);
        return view('agents.customers.details',compact('customer_info'));
    }

    public function update_customer(Request $request){
        $update_cus = Customer::find($request->id);
        // return $request;
        if ($files = $request->file('image')){
            // Define upload path
            $destinationPath = public_path('/customer_images/'); // upload path
            // Upload Orginal Image
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);

            $insert['image'] = "$profileImage";
            // Save In Database
            $update_cus->images="$profileImage";
        }
        $update_cus->name = $request->name;
        $update_cus->email = $request->email;
        $update_cus->mobile_no = $request->mobile_no;
        $update_cus->phone = $request->phone;
        $update_cus->perment_address = $request->address;
        $update_cus->postal_address = $request->p_address;
        $update_cus->passport = $request->passport;
        $update_cus->gender = $request->gender;
        $update_cus->guardian = $request->gardion;
        $update_cus->relation = $request->relation;

        if($update_cus->save()){
            return redirect('/agent/show_details/customer/'.$request->id)->with('success','Customer Info Updated Successfully');
        }
        else{
            return redirect()->back()->with('error','Customer Not Updated');
        }

    }

    public function nominee_details_show($id){
        $data = Customer::find($id);
        $customer_info = Nominee::where('customer_id',$id)->first();
        return view('agents.customers.nominee_details',compact('customer_info','data'));
    }

    public function update_nominee(Request $request){
        $update_cus = Nominee::find($request->id);
        // return $request;
        if ($files = $request->file('image')){
            // Define upload path
            $destinationPath = public_path('/customer_images/'); // upload path
            // Upload Orginal Image
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);

            $insert['image'] = "$profileImage";
            // Save In Database
            $update_cus->images="$profileImage";
        }
        $update_cus->name = $request->name;
        $update_cus->email = $request->email;
        $update_cus->mobile_no = $request->mobile_no;
        $update_cus->phone = $request->phone;
        $update_cus->perment_address = $request->address;
        $update_cus->postal_address = $request->p_address;
        $update_cus->passport = $request->passport;
        $update_cus->gender = $request->gender;
        $update_cus->guardian = $request->gardion;
        $update_cus->relation = $request->relation;

        if($update_cus->save()){
            return redirect('/agent/nominee_details_show/'.$request->customer_id)->with('success','Nominee Updated Successfully');
        }
        else{
            return redirect()->back()->with('error','Customer Not Updated');
        }
    }

    public function destroy(Customer $customer){
        try{
            $customer->delete();
            return redirect()->back()->with('success',"File Has Been Cancelled Successfully");
        }
        catch(Exception $ex){
            return redirect()->back()->with('error',"File Not Cancel");
        }
    }

    public function cancelledCustomers(){
        $customer = Customer::with('bookings')->with('booking.plot')->where('created_by',session()->get('id'))->onlyTrashed()->get();
        return view('agents.customers.cancelled',compact('customer'));
    }
}
