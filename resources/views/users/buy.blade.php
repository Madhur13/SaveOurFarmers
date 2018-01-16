@extends('main')
@section('title','| HomePage')
@section('stylesheets')
    <link media="all" type="text/css" rel="stylesheet" href="css/select2.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="css/owl.carousel.min.css">
@endsection
@section('content')

        <div class="row">
          <center>
          <div class="col-md-12 big-logo">
            <img src="img/basket.jpg" height="120">
          </div>
        </center>
        </div>
        <div class="row">
          <center>
          <div class="col-md-12 tag-line">
            <h4 style="color:white;">Find veg name Vegetable here</h4>
          </div>
        </center>
        </div>
      </div>
      </div>
    </div>
  </div>


<div class="container">
    <div class="row">
    <div class="col-md-12">
     <h2 class="text-center">Result Search</h2>
    </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card1">
          <div class="col-md-3 sale-img">
            <img src="img/apple.png">
          </div>
          <div class="col-md-6">
            <h2>Apple</h2>
            <p>Posted By : Samay</p>
            <p>Date Posted : 11 Mar Time : 11 Am</p>
            <p>Category : Vegetable</p>
            <p>Seller Review For this Product : 4.5</p>
          </div>
          <div class="col-md-3 text-right sale-button">
            <p>Sale Date :12 March</p>
            <p>Sale Time :09:00 AM</p>
            <button type="submit" class="btn btn-success">Buy</button>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
