<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Category;
use App\Product;
use App\User;
class AuctionController extends Controller
{
    public function index(Request $request){
      // dd($request);

      $product = DB::table('products')->where('products.name',$request->product)->where('seller_id','!=',Auth::user()->id)
      ->join('categories','products.category_id','categories.id')
      ->join('users','products.seller_id','users.id')
      ->select('products.*','categories.category_name as cat_name','users.name as user_name')->get();

      // $product = Product::where('name',$request->product)
      //                     join('categories')
      //                     ->get();
      // $category = Category::where('id',$product->category_id)->first();
      // $user = Users::where('id',$product->seller_id);
      return view('auction.index')->withProducts($product);
    }
    public function show($id){
      // if(Auth::user()->name == "Madhur Agrawal"){
      //   $product = Product::find($id);
      //   $product->time = date("H:i:s");
      //   $product->save();
      // }
      $product = DB::table('products')->where('products.id',$id)
      ->join('categories','products.category_id','categories.id')
      ->join('users','products.seller_id','users.id')
      ->select('products.*','categories.category_name as cat_name','users.name as user_name')->get();

      return view('auction.show')->withProducts($product);
    }
    public function getbidupdate($id){
        $product = Product::where('id',$id)->first();
        $buyer_name = DB::table('users')->where('id',$product->buyer_id)->value('name');
        $s = $product->winning_price.','.$buyer_name;
        echo $s;
        // return Response::json($product);

    }
    public function setbidupdate(Request $request){

        $product = Product::find($request->product_id);

        if(($product->base_price < $request->current_bid) && ($product->winning_price < $request->current_bid))
        {
          $product->buyer_id = Auth::user()->id;
          $product->winning_price = $request->current_bid;
          $product->save();
        }
        return redirect()->to('auction/'.$product->id);
        // return Response::json($product);

    }
    public function QuickSearch($name){
      // dd($request);

      $product = DB::table('products')->where('products.name',$name)->where('seller_id','!=',Auth::user()->id)
      ->join('categories','products.category_id','categories.id')
      ->join('users','products.seller_id','users.id')
      ->select('products.*','categories.category_name as cat_name','users.name as user_name')->get();

      // $product = Product::where('name',$request->product)
      //                     join('categories')
      //                     ->get();
      // $category = Category::where('id',$product->category_id)->first();
      // $user = Users::where('id',$product->seller_id);
      return view('auction.index')->withProducts($product);
    }
}
