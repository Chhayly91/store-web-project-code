<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('product.create');
    }

    public function create(Request $request){
        $request->validate([
            'product_name'=>['required','string','max:255'],
            'price'=>['required','string','max:255']
        ]);

        $product = new Product();

        $product->name = $request->product_name;
        $product->price = $request->price;

        $product->save();
        session()->flash('status', 'You saved successfully');

        return back();
    }

    public function list(){
        $products = Product::all();

        return view('product.list',[
            'products'=> $products
        ]);
    }

    public function deleteProduct(Request $request, $id){
        $product = Product::findOrFail($id);

        $product->delete();

        return back();
    }

    public function editProduct(Request $request){
        $product = Product::findOrFail($request->product_id);

        return response()->json($product);
    }

    public function updateProduct(Request $request){
        $product = Product::findOrFail($request->product_id);

        $request->validate([
            'name'=>['required','string','max:255'],
            'price'=>['required','string','max:255']
        ]);

        $product->name = $request->name;
        $product->price = $request->price;

        $product->save();

        if ($product) {
            return response()->json([
                'success' => 1,
                'message' => 'You have been updated successfully',
                'data' => $product
            ]);
        } else {
            return response()->json([
                'success' => 0,
                'message' => 'Fail update',
                'data' =>''
            ]);
        }

    }

    public function searchTerm(Request $request){
//        $term = $_GET['term'];
        //$search_product = Product::find($request->term);
        $search_product = Product::Where('id','LIKE','%'.$request->term.'%')
                                  ->orWhere('Name','LIKE','%'.$request->term.'%')->get();

        $rowsData = array();
        if ($search_product) {
            foreach($search_product as $row) {
                $data['id'] = $row['id'];
                $data['value'] = $row['Name'];
                $data['price'] = $row['Price'];
                array_push($rowsData, $data);
            }
        }

        return response()->json($rowsData);
    }

    public function ajaxReadData(Request $request){
        $product = Product::findOrFail($request->product_id);

        $row = array(
            'status' => 0,
            'data' => array()
        );

        if ($product){
            $row['status'] = 1;
            $row['data'] = $product;
        }

        return response()->json($row);

    }

}
