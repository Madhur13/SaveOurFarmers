@extends('main')
@section('title','| Search Results')
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
      <h4 style="color:white;">Find your Vegetable here</h4>
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


<div class="container">
<div class="row">
<div class="col-md-12">
 <h2 class="text-center">Search Results </h2>
</div>
</div>

@foreach ($products as $product)

<div class="row">
  <div class="col-md-12">
    <div class="card1">
      <div class="col-md-3 sale-img">
        <img src="/img/{{ $product->name }}.png">
      </div>
      <div class="col-md-6">
        <h2>{{ $product->name }}</h2>
        <p>Posted By : {{ $product->user_name }}</p>
        <p>Date Posted : {{ date('j M, Y h:ia' , strtotime($product->created_at)) }} </p>
        <p>Category : {{ $product->cat_name }}</p>
        <p>Seller Rating  : {{ DB::table('feedbacks')->where('seller_id',$product->seller_id )->avg('polarity')*100 }} %</p>
      </div>
      <div class="col-md-3 text-right sale-button">
        <p>Sale Date : {{ date('j M, Y' , strtotime($product->date)) }}</p>
        <p>Sale Time : {{ date('h:ia' , strtotime($product->time))  }}</p>

        @if(strtotime($product->date) == strtotime(date("Y-m-d")) & strtotime($product->time) <= strtotime(date("H:i:s")) && strtotime(date("H:i:s")) < strtotime($product->time)+1000)
        <a href="{{ url('/auction/'.$product->id) }}" class="btn btn-success">Buy</a>
        @elseif(strtotime($product->date) > strtotime(date("Y-m-d")) )
        <a href="" class="btn btn-primary disabled">Coming Soon</a>
      @elseif(strtotime($product->date) == strtotime(date("Y-m-d")) &&  strtotime($product->time) > strtotime(date("H:i:s")))
        <a href="" class="btn btn-primary disabled">{{ date('H:i:s') }}Coming Soon{{ ($product->time) }}</a>
        @else
        <a href="" class="btn btn-primary disabled">Auction Ended</a>
        @endif

        {{-- <a href="{{ url('/auction/'.$product->id) }}" class="btn btn-success">Buy</a> --}}
        {{-- @if ($product->buyer_id == NULL)
        @else
          <a href="{{ url('/auction/'.$product->id) }}" class="btn btn-success disabled">Sold Out</a>
        @endif --}}
        {{-- <button type="submit" class="btn btn-success">Buy</button> --}}
      </div>
    </div>
  </div>
</div>
@endforeach



<div class="reviewed">
  <div class="row">
   <h2 class="text-center">Our Top Sellers</h2>
  <?php $ratings=\DB::table('feedbacks')->select(DB::raw("(avg(polarity)*100) as avgPol,seller_id"))->groupBy('seller_id')->orderBy('avgPol','desc')->limit(4)->get();
  ?>

   <center>
     <div class="container">
       <div class="row">
       @foreach($ratings as $rating)
         <div class="card">
           <img src="../img/{{$pp = \DB::table('users')->select('name')->where('users.id',$rating->seller_id)->value('name')}}.jpg" class="avatar">
             <h5 class="center-align">{{$pp = \DB::table('users')->select('name')->where('users.id',$rating->seller_id)->value('name')}}</h5>
              <p class="center-align" style="margin:4px;">Review: {{$rating->avgPol}}%</p>
        </div>
        @endforeach
      </div>
    </div>
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
  function nextpage(){
    $("#go").click();
  }

  </script>
  <!-- Java Scripts Include all compiled plugins (below), or include individual files as needed -->

@endsection
