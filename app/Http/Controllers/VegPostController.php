<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Category;
use App\Product;

class VegPostController extends Controller
{
  public function addveg(){
    return view('addvegetable');
  }

  public function postveg(Request $request){
    // dd($request);

    //validate the data
    $this->validate($request,array(
    'pname'=>'required|max:255',
    'pcat' => 'required',
    'pdate' => 'required',
    'ptime'=>'required',
    'pquantity' => 'required',
    'price' => 'required'
    ));
    //store in data base
    $product = new Product;
    $product->name=$request->pname;
    $product->category_id = $request->pcat;
    $product->base_price = $request->price;
    $product->seller_id = Auth::user()->id;
    $product->quantity = $request->pquantity;
    $product->date = $request->pdate;
    $product->time = $request->ptime;

    $product->save();
    // Product::create(['name'=>$request->pname,'category_id'=>$request->pcat,'date'=>$request->pdate,'time'=>$request->ptime,'quantity'=>$request->pquantity,'base_price'=>$request->price,'seller_id'=>$seller_id]);

      return redirect()->to('/profile');
  }
  public function editveg(Request $request){
     $this->validate($request,array(
    'pname'=>'required|max:255',
    'pcat' => 'required',
    'pdate' => 'required',
    'ptime'=>'required',
    'pquantity' => 'required',
    'price' => 'required'
    ));
    //store in data base

 Product::where('id',$request->id)->update(['name'=>$request->pname,
          'category_id' => $request->pcat,
            'base_price' => $request->price,
            'seller_id' => Auth::user()->id,
            'quantity' => $request->pquantity,
            'date' => $request->pdate,
            'time' => $request->ptime,
]);

    // Product::create(['name'=>$request->pname,'category_id'=>$request->pcat,'date'=>$request->pdate,'time'=>$request->ptime,'quantity'=>$request->pquantity,'base_price'=>$request->price,'seller_id'=>$seller_id]);

      return redirect()->to('/profile');
  }

}
