<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function productcard($pid){
        $data = product::find($pid);
        return response()->json($data);
    }

    public function orderstore(Request $req){
        if(Auth::check()){
            $data = new Order();
            $data->order_total_amount = $req->order_total_amount; 
            $data->product_id = $req->product_id;
            $data->user_id    = Auth::user()->id; 
            $data->save();
            return response()->json();
        }else{
            return redirect('home');
        }
    }

    public function manageorders(){
        if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('manager')){
            // $data = DB::table('orders')->where('order_status', '=', 'pending')->get();
            $data = Order::all();
            $all = count($data);
            $pending = count(DB::table('orders')->where('order_status', '=', 'Pending')->get());
            $inprogress = count(DB::table('orders')->where('order_status', '=', 'Inprogress')->get());
            $shipped = count(DB::table('orders')->where('order_status', '=', 'Shipped')->get());
            $delivered = count(DB::table('orders')->where('order_status', '=', 'Delivered')->get());
            $canceled = count(DB::table('orders')->where('order_status', '=', 'Canceled')->get());
            return view('orders.manageorders', ['items' => $data, 'all' => $all, 'pending' => $pending, 'inprogress' => $inprogress, 'shipped' => $shipped, 'delivered' => $delivered, 'canceled' => $canceled]);
        }else{
            return redirect('products');
        }
    }

    public function pendingorders(){
        if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('manager')){
            $all = count(Order::all());
            $data = DB::table('orders')->where('order_status', '=', 'Pending')->get();
            $pending = count($data);
            $inprogress = count(DB::table('orders')->where('order_status', '=', 'Inprogress')->get());
            $shipped = count(DB::table('orders')->where('order_status', '=', 'Shipped')->get());
            $delivered = count(DB::table('orders')->where('order_status', '=', 'Delivered')->get());
            $canceled = count(DB::table('orders')->where('order_status', '=', 'Canceled')->get());
            return view('orders.pendingorders', ['items' => $data, 'all' => $all, 'pending' => $pending, 'inprogress' => $inprogress, 'shipped' => $shipped, 'delivered' => $delivered, 'canceled' => $canceled]);
        }else{
            return redirect('products');
        }
    }

    public function inprogressorders(){
        if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('manager')){
            $all = count(Order::all());
            $pending = count(DB::table('orders')->where('order_status', '=', 'Pending')->get());
            $data = DB::table('orders')->where('order_status', '=', 'Inprogress')->get();
            $inprogress = count($data);
            $shipped = count(DB::table('orders')->where('order_status', '=', 'Shipped')->get());
            $delivered = count(DB::table('orders')->where('order_status', '=', 'Delivered')->get());
            $canceled = count(DB::table('orders')->where('order_status', '=', 'Canceled')->get());
            return view('orders.inprogressorders', ['items' => $data, 'all' => $all, 'pending' => $pending, 'inprogress' => $inprogress, 'shipped' => $shipped, 'delivered' => $delivered, 'canceled' => $canceled]);
        }else{
            return redirect('products');
        }
    }

   

    public function shippedorders(){
        if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('manager')){
            $all = count(Order::all());
            $pending = count(DB::table('orders')->where('order_status', '=', 'Pending')->get());
            $inprogress = count(DB::table('orders')->where('order_status', '=', 'Inprogress')->get());
            $data = DB::table('orders')->where('order_status', '=', 'Shipped')->get();
            $shipped = count($data);
            $delivered = count(DB::table('orders')->where('order_status', '=', 'Delivered')->get());
            $canceled = count(DB::table('orders')->where('order_status', '=', 'Canceled')->get());
            return view('orders.shippedorders', ['items' => $data, 'all' => $all, 'pending' => $pending, 'inprogress' => $inprogress, 'shipped' => $shipped, 'delivered' => $delivered, 'canceled' => $canceled]);
        }else{
            return redirect('products');
        }
    }

    public function deliveredorders(){
        if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('manager')){
            $all = count(Order::all());
            $pending = count(DB::table('orders')->where('order_status', '=', 'Pending')->get());
            $inprogress = count(DB::table('orders')->where('order_status', '=', 'Inprogress')->get());
            $shipped = count(DB::table('orders')->where('order_status', '=', 'Shipped')->get());
            $data = DB::table('orders')->where('order_status', '=', 'Delivered')->get();
            $delivered = count($data);
            $canceled = count(DB::table('orders')->where('order_status', '=', 'Canceled')->get());
            return view('orders.deliveredorders', ['items' => $data, 'all' => $all, 'pending' => $pending, 'inprogress' => $inprogress, 'shipped' => $shipped, 'delivered' => $delivered, 'canceled' => $canceled]);
        }else{
            return redirect('products');
        }
    }

    public function canceledorders(){
        if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('manager')){
            $all = count(Order::all());
            $pending = count(DB::table('orders')->where('order_status', '=', 'Pending')->get());
            $inprogress = count(DB::table('orders')->where('order_status', '=', 'Inprogress')->get());
            $shipped = count(DB::table('orders')->where('order_status', '=', 'Shipped')->get());
            $delivered = count(DB::table('orders')->where('order_status', '=', 'Delivered')->get());
            $data = DB::table('orders')->where('order_status', '=', 'Canceled')->get();
            $canceled = count($data);
            return view('orders.canceledorders', ['items' => $data, 'all' => $all, 'pending' => $pending, 'inprogress' => $inprogress, 'shipped' => $shipped, 'delivered' => $delivered, 'canceled' => $canceled]);
        }else{
            return redirect('products');
        }
    }

    public function cit_progress($oid){
        if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('manager')){
            $data = Order::find($oid);
            $data->order_status = 'Inprogress';
            $data->save();
            return response()->json();
        }else{
            return redirect('products');
        }
    }

    public function cit_cancel($oid){
        if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('manager')){
            $data = Order::find($oid);
            $data->order_status = 'Canceled';
            $data->save();
            return response()->json();
        }else{
            return redirect('products');
        }
    }

    public function cit_shipped($oid){
        if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('manager')){
            $data = Order::find($oid);
            $data->order_status = 'Shipped';
            $data->save();
            return response()->json();
        }else{
            return redirect('products');
        }
    }

    public function cit_delivered($oid){
        if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('manager')){
            $data = Order::find($oid);
            $data->order_status = 'Delivered';
            $data->save();
            return response()->json();
        }else{
            return redirect('products');
        }
    }


    public function myorders(){
        if(Auth::check()){
            $data = User::find(1)->order;
            return view('myorders.myorders', ['items' => $data]);
        }else{
            return redirect('home');
        }
    }

    public function myorder_cancel($oid){
        if(Auth::check()){
            $data = Order::find($oid);
            $data->order_status = 'Canceled';
            $data->save();
            return response()->json();
        }else{
            return redirect('products');
        }
    }

    public function myorder_reorder($oid){
        if(Auth::check()){
            $data = Order::find($oid);
            $data->order_status = 'Pending';
            $data->save();
            return response()->json();
        }else{
            return redirect('products');
        }
    }
}
