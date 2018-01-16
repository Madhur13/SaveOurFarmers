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
        <img src="img/logo-big.png" height="120">
      </div>
    </center>
    </div>
    <div class="row">
      <center>
      <div class="col-md-12 tag-line">
        <h4 style="color:white;">Find Vegetables in India</h4>
      </div>
    </center>
    </div>

    <div class="search">
      <center>
        <form method="POST" action="{{ url('/auction') }}" accept-charset="UTF-8" class="form-inline row" enctype="multipart/form-data">
          <input name="_token" type="hidden" value="MDZBhXFcD4Emx47MP6tM9elhdTxyBgmHFqcpFCKF">
          <div class="form-group text-center">
            <label>Category</label>
            <br>
            <select class="js-example-basic-single" id="js-example-basic-single" name="category" class="">
              @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group text-center">
            <label>Product Name</label>
            <br>
            <select class="js-example-basic-single" id="product" name="product" >
              <option value=""></option>
            </select>
          </div>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <button type="submit" class="btn btn-default" id="go">Go</button>
        </form>
      </center>
      </div>
      </div>
    </div>
    </div>
  </div>


<div class="container give-margin">
<div class="row">
<div class="col-md-12">
 <h2 class="text-center">Quick Search</h2>
</div>
</div>


<div class="row quick">
 <div class="large-12 columns">
   <div class="owl-carousel owl-theme">
     <?php
       $itemNames = \DB::table('products')->where('seller_id','!=',Auth::user()->id)
                                          ->select('name')->distinct()->get();
                                         //  echo $itemNames;
     ?>
     @foreach($itemNames as $items)

       <a href="{{ route('auc', ['name' => $items->name]) }}"><div class="item">
       <img src="img/{{ $items->name }}.png" style="height:80px;width:80px;" class="center-block">
       <p class="text-center">{{$items->name}}</p>
       </div></a>
     @endforeach
     </div>
 </div>
</div>


<div class="reviewed">
  <div class="row">
   <h2 class="text-center">Our Top Sellers</h2>
  <?php $ratings=\DB::table('feedbacks')->select(DB::raw("(avg(polarity)*100) as avgPol,seller_id"))->groupBy('seller_id')->orderBy('avgPol','desc')->limit(4)->get();
  ?>

   <center>
     <center>
     <div class="container">
       <div class="row">
       @foreach($ratings as $rating)
         <div class="col-md-3 col-sm-6 col-xs-12">
           <img src="img/{{$pp = \DB::table('users')->select('name')->where('users.id',$rating->seller_id)->value('name')}}.jpg" class="avatar">
             <h5 class="center-align">{{$pp = \DB::table('users')->select('name')->where('users.id',$rating->seller_id)->value('name')}}</h5>
              <p class="center-align" style="margin:4px;">Review: {{$rating->avgPol}}%</p>
        </div>
        @endforeach
      </div>
    </div>
  </center>
  </div>
</div>

<div class="about" id="about">
  <h2>About Us</h2>
  <h4><u>We do this by</u></h4>
  <p style="text-align:justify;">Helping people discover great places around them.
  Our team gathers information from every restaurant on a regular basis to ensure our data is fresh. Our vast community of food lovers share their reviews and photos, so you have all that you need to make an informed choice.
</p>
</div>

</div>

@endsection
@section('scripts')
  <script src="js/select2.min.js"></script>

  <script>
  $(document).ready(function() {
    var owl = $('.owl-carousel');
    owl.owlCarousel({
      items: 6,
      loop: true,
      margin: 10,
      autoplay: true,
      autoplayTimeout: 1000,
      autoplayHoverPause: true
    });
    $('.play').on('click', function() {
      owl.trigger('play.owl.autoplay', [1000])
    })
    $('.stop').on('click', function() {
      owl.trigger('stop.owl.autoplay')
    })
  })
  </script>
  <script type="text/javascript">
  $(document).ready(function() {
  $(".js-example-basic-single").select2();
  });
  </script>
  <script>
  $('#js-example-basic-single').on('change',function(e){
    console.log(e);
    var cat_id = e.target.value;

    //ajax
    $.get('/ajax-subcat?cat_id=' +cat_id, function(data){
      //success data
      $('#product').empty();
      $.each(data,function(index, productObj){
        $('#product').append('<option value="'+productObj.name+'">'+productObj.name+'</option>');
      });
    });
  });
  </script>

  <!-- Java Scripts Include all compiled plugins (below), or include individual files as needed -->

@endsection
