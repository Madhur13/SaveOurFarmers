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
                <img src="img/{{ Auth::user()->name }}.jpg" height="120" class="img-circle" style="border-radius:3%;">
              </div>
            </center>
          <div class="row">
            <h2 class="text-center">{{ Auth::user()->name }}</h2>
          </div>
          </div>
      </div>
    </div>
    </div>
  </div>


<div class="container">
    <form class="container" role="form" method="POST" action="{{ url('/postveg') }}">
        <h2 class="text-center">Post Your Vegetable</h2>
        <div class="row">
          <div class="col-md-offset-2 col-md-4">
            <div class="form-group text-center">
              <label>Select Vegetable</label>
              <br>
              <input type="text" name="pname" id="pname" class="form-control">
              {{-- <select class="js-example-basic-single form-control" name="pname">
                <option value="AL">Tomato</option>
                <option value="WY">Potato</option>
              </select> --}}
            </div>
        </div>
          <div class="col-md-4">
            <div class="form-group text-center">
              <label>Select Category</label>
              <br>
              <select class="js-example-basic-single form-control" name="pcat" id="pcat">
                @foreach ($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
              </select>
            </div>
    </div>
    </div>
    <div class="row">
      <div class="col-md-offset-2 col-md-4">
        <div class="form-group text-center">
          <label>Sales Start Date</label>
          <br>
          <input type="date" id="startdate" class="form-control" name="pdate">
        </div>
      </div>
      <div class="col-md-4">
      <div class="form-group text-center">
        <label>Sales Start Time</label>
        <br>
        <input type="time" id="starttime" class="form-control" name="ptime">
      </div>
    </div>
  </div>
      <div class="row">
        <div class="col-md-offset-2 col-md-4">
          <div class="form-group text-center">
            <label>Price</label><br>
            <input type="text" id="price" class="form-control" name="price">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group text-center">
            <label>Quantity</label><br>
            <input type="number" id="quantity" class="form-control" name="pquantity">
          </div>
        </div>
      </div>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="row">
        <div class="col-md-offset-4 col-md-4">
          <div class="form-group text-center">
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
      </div>
      <div class="col-md-4">
      </div>
    </div>
    </form>
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
