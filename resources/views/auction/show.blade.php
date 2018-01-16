@extends('main')
@section('title','| HomePage')
@section('stylesheets')
    <link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('css/select2.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('css/owl.carousel.min.css') }}">
    {{-- <link media="all" type="text/css" rel="stylesheet" href="css/"> --}}

@endsection
@section('content')

  <div class="row">
    <center>
    <div class="col-md-12 big-logo">
      <img src="{{ URL::asset('img/logo-big.png') }}" height="120">
    </div>
  </center>
  </div>
  <div class="row">
    <center>
    <div class="col-md-12 tag-line">
      <h4 style="color:white;">Your Auction</h4>
    </div>
  </center>
  </div>
</div>
      </div>
    </div>
  </div>

  @foreach ($products as $product)
  @endforeach
  <script>
    var id = {{ $product->id }}
  </script>
<div class="container">
  <div class="row">
    <div class="col-md-12">
       <h2 class="text-center">{{ $product->name }} by {{ $product->user_name }}</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
        <div class="time text-center">
          <h4>Time Left</h4>
          <p id="time"></p>
        </div>
    </div>
  </div>
  <div class="row bidding">
    <div class="col-md-8 col-sm-6 col-xs-6">
      <h1>{{ $product->name }}</h1>
      <h3>Posted By : {{ $product->user_name }}</h3>
      <h4>Base Price : {{ $product->base_price }}</h4>
      <p>Quantity : {{ $product->quantity }}</p >
      <p>Date Posted : {{ $product->created_at }}</p>
      <p>Category : {{ $product->cat_name }}</p>
      <p>Seller Review For this Product : 4.5</p>
    </div>

    <div class="col-md-4 col-sm-6 col-xs-6">
      <div class="well">
        <div class="upper">
          <form method="GET" action="{{ url('/setbidupdate') }}"  id="bid_button">
            <input type="text" style="display:none;" value="{{ $product->id }}" name="product_id">
            <div class="form-group text-center">
              <label for="bid">Put Your Bid here</label>
              <br>
              <input type="text" class="form-control" id="current_bid" placeholder="Bid" name="current_bid">
            </div>
            <div class="form-group text-center">
              <button  type="submit" class="btn btn-default">Bid</button>
            </div>

          </form>
        </div>
        <div class="center"></div>
        <div class="lower text-center">
          @if ($product->buyer_id == NULL)
            <h4>Highest Bidder  <p id="bidder_name">---</p></h4>
            <h4>Highest Bidding Price  <p id="bidding_price1">---</p></h4>
          @else

            <h4>Highest Bidder : <p id="bidder_name">{{ DB::table('users')->where('id',$product->buyer_id)->value('name') }}</p></h4>
            <h4>Highest Bidding Price : <p id="bidding_price1">{{ $product->winning_price }} </p></h4>

          @endif
        </div>
      </div>
    </div>

  </div>

</div>

@endsection
@section('scripts')
  <script src="{{ URL::asset('js/auction.js') }}"></script>
  <script src="{{ URL::asset('js/select2.min.js') }}"></script>

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
    c = {{ strtotime($product->time) + 1000 - strtotime(date("H:i:s"))}};
    setTimeout(timedCount(),1000);
    setTimeout(bid_update(),1000);
  </script>
  <!-- Java Scripts Include all compiled plugins (below), or include individual files as needed -->

@endsection
