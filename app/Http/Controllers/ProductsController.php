<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function showproducts(){
        $data = product::all();
        return view('products.products', ['items' => $data]);
    }
    public function index(){
        if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('manager')){
            $data = product::all();
            return view('products.manageproducts', ['items' => $data]);
        }else{
            return redirect('products');
        }
    }
    public function edit($id){
        if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('manager')){
            $data = product::find($id);
            return response()->json($data);
        }else{
            return redirect('products');
        }
    }

    public function store(Request $req){
        if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('manager')){
            if($req->product_id != ''){
                $data = product::find($req->product_id);
            }
            else{
                $data = new product();
            }
            $image = $req->file('product_image');
            $filename = $image->getClientOriginalName();
            $saveimage = $req->product_image->move(('images/product'), $filename);
            $data->product_image = $saveimage;

            $data->product_name = $req->product_name;
            $data->product_price = $req->product_price;
            $data->product_color = $req->product_color;
            $data->save();
            $fdata = product::all();
            return view('products.manageproducts', ['items' => $fdata]);
           
        }else{
            return redirect('products');
        }
    }

    public function delete($id){
        if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin')){
            $data = product::find($id);
            $data->delete();
            return response()->json($data);
        }else{
            return redirect('products');
        }
    }
    
}
