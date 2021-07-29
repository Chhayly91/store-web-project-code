<?php

namespace App\Http\Controllers;

use App\Customer;
use App\PhoneNumber;
use DemeterChain\C;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('customer.create');
    }

    public function create(Request $request){
        $request->validate([
            'customer_name'=>['required','string','max:255']
        ]);

        $customer = new Customer();

        $customer->name = $request->customer_name;
        $customer->save();

        $lastCustomerID = $customer->id;

        for ($i = 0; $i<count($request->phone); $i++){
            $phoneNumber = new PhoneNumber();

            $phoneNumber->phone_number = $request->phone[$i];
            $phoneNumber->customer_id = $lastCustomerID;

            $phoneNumber->save();
        }

        session()->flash('status', 'You saved successfully');

        return back();
    }

    public function list(){
//        $phoneNumbers = PhoneNumber::all();
        $customers = Customer::orderBy('id','desc')->get();

        //******method 1 *******
//        $phoneNumbers = array();
//        foreach ($customers as $customer){
//            foreach ($customer->phoneNumbers as $phoneNumber){
//                $phoneNumbers[] = $phoneNumber;
//            }
//        }
//        return view('customer.list',[
//            'customers' => $customers,
//            'phoneNumbers' => $phoneNumbers
//        ]);
        //*****method 2 *******
        //loop in phone number in view
        return view('customer.list',[
            'customers' => $customers
        ]);
    }

    public function delete(Request $request, $id){
        $customer = Customer::findOrFail($id);

        $customer->delete();
        $phones = $customer->phoneNumbers;
        foreach ($phones as $phone){
            $phone->delete();
        }

        return back();
    }

    public function deletePhone(Request $request){
        $phoneNumber = PhoneNumber::findOrFail($request->phoneID);

        $phoneNumber->delete();

        //return response()->json(PhoneNumber::all());
    }

    public function edit(Request $request){
        $customer = Customer::findOrFail($request->customer_id);

        $phoneNumbers = $customer->phoneNumbers;
        return response()->json([
            'customer' =>$customer,
            'phoneNumbers' =>$phoneNumbers
        ]);
    }

    public function update(Request $request){
        $customer = Customer::findOrFail($request->customer_id);

        $customer->name = $request->customer_name;

        $customer->save();

        //dd($request->phone_id);

        for ($j=0 ; $j<count($request->phone_number);$j++){
            if (($request->phone_id[$j]) !== null ){
                $phoneNumber = PhoneNumber::findOrFail($request->phone_id[$j]);
                $phoneNumber->phone_number = $request->phone_number[$j];
                $phoneNumber->customer_id = $request->customer_id;

                $phoneNumber->save();
            }
            else{

                $phoneNumbers = new PhoneNumber();
                $phoneNumbers->phone_number = $request->phone_number[$j];
                $phoneNumbers->customer_id = $request->customer_id;

                $phoneNumbers->save();
            }
        }

//        $phoneData = array();
//        foreach ($customer->phoneNumbers as $phone){
//            $data['id'] = $phone['id'];
//            $data['value'] =$phone['phone_number'];
//            array_push($phoneData, $data);
//        }
        if ($customer) {
            return response()->json([
                'success' => 1,
                'message' => 'You have been updated successfully',
                'data' => $customer,
                'phone' => $customer->phoneNumbers
            ]);
        } else {
            return response()->json([
                'success' => 0,
                'message' => 'Fail update',
                'data' =>'',
                'phone' => ''
            ]);
        }





//        if ($customer) {
//            return response()->json([
//                'success' => 1,
//                'message' => 'You have been updated successfully',
//                'data' => $customer
//            ]);
//        } else {
//            return response()->json([
//                'success' => 0,
//                'message' => 'Fail update',
//                'data' =>''
//            ]);
//        }
        //return response()->json($request->phone_number);
    }
}
