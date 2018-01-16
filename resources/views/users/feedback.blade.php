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
                <img src="../img/{{ Auth::user()->name }}.jpg" height="120">
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
    <form class="container" role="form" method="POST" action="{{ url('/postfeedback') }}">
        <h2 class="text-center">Feedback</h2>

    <input type="hidden" id="selid" class="form-control" name="selid" value="{{ $val }}">
    <input type="hidden" id="buyid" class="form-control" name="buyid" value="{{ Auth::user()->id }}">
    <input type="hidden" id="itemid" class="form-control" name="itemid" value="{{ $id }}">
      <div class="row">
        <div class="col-md-offset-4 col-md-4">
          <div class="form-group text-center">
            <label>feedback</label><br>
            <input type="text"  id="feedback" class="form-control" name="feedback" width="10%;">
          </div>
        </div>

      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="row">
        <div class="col-md-offset-4 col-md-4">
          <div class="form-group text-center">
          <button type="submit" class="btn btn-success">Submit</button>
          <a href="{{ url('/profile') }}" class="btn btn-danger">Cancel</a>
          {{-- <button type="submit" class="btn btn-danger">Cancel</button> --}}
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
