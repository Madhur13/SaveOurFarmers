<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use Auth;
use DB;
use App\Feedback;
class UserController extends Controller
{
  public function profile(){

    $sold = DB::table('products')->whereNotNULL('buyer_id')->where('seller_id',Auth::user()->id)
    ->join('categories','products.category_id','categories.id')
    ->join('users','products.buyer_id','users.id')
    ->select('products.*','categories.category_name as cat_name','users.name as user_name')->get();

  //  $sold=Product::whereNotNULL('buyer_id')->where('seller_id',Auth::user()->id)->get();
   $products=Product::where('buyer_id',NULL)->where('seller_id',Auth::user()->id)
   ->join('categories','products.category_id','categories.id')
   ->join('users','products.seller_id','users.id')
   ->select('products.*','categories.category_name as cat_name','users.name as user_name')->get();

   $unsold=Product::where('buyer_id',Auth::user()->id)
   ->join('categories','products.category_id','categories.id')
   ->join('users','products.seller_id','users.id')
   ->select('products.*','categories.category_name as cat_name','users.name as user_name')->get();

   $rating = DB::table('feedbacks')->where('seller_id', Auth::user()->id)->avg('polarity');
   $feedbacks=Feedback::where('feedbacks.seller_id',Auth::user()->id)
   ->join('products','feedbacks.item_id','products.id')
   ->join('users','feedbacks.buyer_id','users.id')
   ->select('products.name as pname','users.name as uname','feedbacks.*')->get();

   return view('users.profile')->with(['products'=>$products,'sold'=>$sold,'unsold'=>$unsold,'rating'=>$rating,'feedbacks'=>$feedbacks]);
  }
    public function index(){
      $categories = Category::get();
      return view('users.index')->withCategories($categories);
    }
    public function sell(){
      $categories = Category::get();
      return view('users.sell')->withCategories($categories);
    }
    public function buy(){
      return view('users.buy');
    }
    public function editproduct($id){

      $products=Product::find($id);
       $categories = Category::all();
        return view ('users.editprod')->with(['products'=>$products,'categories'=>$categories]);

    }
    public function deleteproduct($id){

      $products=Product::find($id);
      $products->delete();

        return redirect()->to('/profile');

    }
}
