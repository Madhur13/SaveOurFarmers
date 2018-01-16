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
        <img src="img/basket.jpg" height="120" style="border-radius:100%;">
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
        <div class="row">
          @if(Auth::check())
            <a href="/buy" class="btn btn-default col-md-2 col-md-offset-3" id="go">Buy</a>
            <a href="/sell"  class="btn btn-default col-md-2 col-md-offset-2" id="go">Sell</a>
          @endif
        </div>
      </center>
      </div>
      </div>
    </div>
    </div>
  </div>

  @if(Auth::check())
<div class="container">
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
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
@endif



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

<div class="about container" id="about">
  <h2 class="text-center">About Us</h2>

  <p style="text-align:justify;">We help farmers in making a direct contact with the sellers . This is based on online auction of the vegetables or grains between the farmers who grow it and with the seller who sells it to the customer.We help farmers in making a direct contact with the sellers . This is based on online auction of the vegetables or grains between the farmers who grow it and with the seller who sells it to the customer.We help farmers in making a direct contact with the sellers . This is based on online auction of the vegetables or grains between the farmers who grow it and with the seller who sells it to the customer.We help farmers in making a direct contact with the sellers . This is based on online auction of the vegetables or grains between the farmers who grow it and with the seller who sells it to the customer.We help farmers in making a direct contact with the sellers . This is based on online auction of the vegetables or grains between the farmers who grow it and with the seller who sells it to the customer.
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
  function nextpage(){
    $("#go").click();
  }

  </script>
  <!-- Java Scripts Include all compiled plugins (below), or include individual files as needed -->

@endsection
