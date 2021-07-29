<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Invoice;
use App\Item;
use PDF;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('order.create');
    }

    public function create(Request $request){
        $request->validate([
            'product_name' => ['required']
        ]);

        $order = new Invoice();

        $order->payment_status = $request->payment_status;
        $order->created_at = $request->date;
        $order->grand_total = $request->grand_total;
        $order->customerID = $request->customer_id;
        $order->customer_name = $request->customer_name;

        $order->save();

        $lastInvoiceId = $order->id;

        for ($i = 0 ; $i<count($request->productID); $i++){
            $item = new Item();
            $item->productID = $request->productID[$i];
            $item->invoiceID = $lastInvoiceId;
            $item->name = $request->product_name[$i];
            $item->qty = $request->qty[$i];
            $item->price = $request->price[$i];
            $item->total = $request->total[$i];
            $item->save();
        }

        session()->flash('status', 'You saved successfully');

        //return back(); //still in save page
        return redirect()->route('order.list');
    }

    public function list(){
        $orders = Invoice::orderBy('id','desc')->get();

        return view('order.list',[
            'orders' => $orders
        ]);
    }

    public function searchTerm(Request $request){
        $search_customer = Customer::Where('id','LIKE','%'.$request->term.'%')
            ->orWhere('name','LIKE','%'.$request->term.'%')->get();

        $rowsData = array();
        if ($search_customer) {
            foreach($search_customer as $row) {
                $data['id'] = $row['id'];
                $data['value'] = $row['name'];
                array_push($rowsData, $data);
            }
        }

        return response()->json($rowsData);
    }

    public function update($id){
        $invoice = Invoice::findOrFail($id);
        //dd($invoice);

        return view('order.update',[
            'invoice' => $invoice
        ]);
    }

    public function processUpdate(Request $request){
        $order = Invoice::findOrFail($request->invoice_id);
//        dd($order);
        $order->payment_status = $request->payment_status;
        $order->created_at = $request->date;
        $order->grand_total = $request->grand_total;
        $order->customerID = $request->customer_id;
        $order->customer_name = $request->customer_name;

        $order->save();

//        dd($order->items[1]);
//        dd($request->product_name[0]);
        for ($j=0 ; $j<count($request->productID); $j++){
            if ($request->addnew[$j] ==1){
                $order->items[$j]->productID = $request->productID[$j];
                $order->items[$j]->invoiceID = $request->invoice_id;
                $order->items[$j]->name = $request->product_name[$j];
                $order->items[$j]->qty = $request->qty[$j];
                $order->items[$j]->price = $request->price[$j];
                $order->items[$j]->total = $request->total[$j];

                $order->items[$j]->save();
            } else{

                $items = new Item();

                $items->productID = $request->productID[$j];
                $items->invoiceID = $request->invoice_id;
                $items->name = $request->product_name[$j];
                $items->qty = $request->qty[$j];
                $items->price = $request->price[$j];
                $items->total = $request->total[$j];

                $items->save();

            }
        }

        session()->flash('status', 'You\'re updated successfully');

        return back();
    }

    public function delete_item(Request $request){
        $item = Item::findOrFail($request->item_id);

        $item->delete();

        return response()->json([
            'msg' => 'delete successfully'
        ]);

    }

    public function delete($id){
        $order_list = Invoice::findOrFail($id);

        foreach ($order_list->items as $item){
            $item->delete();
        }

        $order_list->delete();

        session()->flash('status', 'You have deleted successfully');

        return back();
//        dd  ($order_list->items);
    }

    public function print($id){
        $show = Invoice::findOrFail($id);

        $pdf = PDF::loadView('print.invoice_bill',['show'=>$show])->setPaper('a5');
       // dd($pdf);
        return $pdf->stream('inv-'.$show->id.'.pdf');
    }

    public function inv_view($id){
        $show = Invoice::findOrFail($id);

      return view('order.inv_view',['show'=>$show]);
    }
}
