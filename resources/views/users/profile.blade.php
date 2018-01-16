@extends('main')
@section('title','| Profile')
@section('stylesheets')
    <link media="all" type="text/css" rel="stylesheet" href="css/select2.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="css/owl.carousel.min.css">
@endsection
@section('content')


 <div class="row">
      <center>
      <div class="col-md-12 big-logo">
        <img src="img/{{ Auth::user()->name }}.jpg" height="120" width="120" style="border-radius:100%;">
      </div>
    </center>
    <div class="row">
      <h2 class="text-center name">{{ Auth::user()->name }}</h2>
      {{-- <h4>Rating : @foreach ($rating as $rating) --}}
        <h4 style="color:white;" class="text-center">{{ $rating*100 }} % Ratings</h4>
        <a href="/buy" class="btn btn-default col-md-2 col-md-offset-3 col-sm-6 col-xs-12" id="go">Buy</a>
        <a href="/sell"  class="btn btn-default col-md-2 col-md-offset-2 col-sm-6 col-xs-12" id="go">Sell</a>
      {{-- @endforeach --}}
    {{-- </h4> --}}
  </div>
    </div>
    </div>
  </div>
    </div>
    </div>
    </div>

    {{-- <h2 class="text-center">Post Your Vegetable</h2> --}}

  <div class="container">
    {{-- Tab Start here --}}
  <div class="tabs">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#unsold" aria-controls="unsold" role="tab" data-toggle="tab">Unsold</a></li>
      <li role="presentation"><a href="#sold" aria-controls="profile" role="tab" data-toggle="tab">Sold</a></li>
      <li role="presentation"><a href="#bhistory" aria-controls="messages" role="tab" data-toggle="tab">Buying History</a></li>
      <li role="presentation"><a href="#feedback" aria-controls="messages" role="tab" data-toggle="tab">FeedBack</a></li>
      <!-- <li role="presentation"><a href="#rateit" aria-controls="rateit" role="tab" data-toggle="tab">Rate It</a></li> -->
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="unsold">
        <div class="row">
        @foreach($products as $product)
  <div class="col-md-12">
    <div class="card1">
      <div class="col-md-3 sale-img">
        <img src="img/{{ $product->name }}.png">
      </div>
      <div class="col-md-6">
        <h2>{{ $product->name }}</h2>
        <p>Posted By : {{ Auth::user()->name }}</p>
        <p>Date Posted : {{ date('j M, Y h:ia' , strtotime($product->created_at)) }} </p>
        <p>Category : {{ $product->cat_name }}</p>
        <p>Seller Rating : {{ $rating*100 }} % </p>
      </div>
      <div class="col-md-3 text-right sale-button">
        <p><a href="/editprod/{{ $product->id }}" class="btn btn-default"><i class="fa fa-pencil"></i>   </a> <a class="btn btn-danger" href="/deleteprod/{{ $product->id }}"><i class="fa fa-trash"></i></a></p>
        <p>Sale Date : {{ date('j M, Y' , strtotime($product->date)) }}</p>
        <p>Sale Time : {{ date('h:ia' , strtotime($product->time)) }}</p>
       <!--  <button type="submit" class="btn btn-success">Buy</button> -->
      </div>
    </div>
  </div>
  @endforeach
</div>

      </div>
      <div role="tabpanel" class="tab-pane" id="sold">
        <table class="table">
          <tr>
            {{-- <th>#</th> --}}
          <th>Name</th>
          <th>Winning Price</th>
          <th>Base Price</th>
          <th>Buyer Name</th>
          <th>Quantity</th>
          <th>Category</th>
          <th>Date &amp; Time</th>

        </tr>
          @foreach ($sold as $sold)
          <tr>
            {{-- <td>{{ $sold->id }}</td> --}}
            <td>{{ $sold->name }}</td>
            <td>{{ $sold->winning_price }}</td>
            <td>{{ $sold->base_price }}</td>
            <td>{{ $sold->user_name }}</td>
            <td>{{ $sold->quantity }}</td>
            <td>{{ $sold->cat_name }}</td>
            <td>{{ date('j M, Y' , strtotime($sold->date)) }} - {{ date('h:ia' , strtotime($sold->time)) }} </td>
          </tr>
          @endforeach
        </table>
      </div>
      <div role="tabpanel" class="tab-pane" id="bhistory">
        <table class="table">
          <tr>
            {{-- <th>#</th> --}}
          <th>Name</th>
          <th>Winning Price</th>
          <th>Base Price</th>
          <th>Seller Name</th>
          <th>Quantity</th>
          <th>Category</th>
          <th>Date &amp; Time</th>
          <th>Feedback</th>
          <th>
        </tr>
          @foreach ($unsold as $unsold)
          <tr>
            {{-- <td>{{ $unsold->id }}</td> --}}
            <td>{{ $unsold->name }}</td>
            <td>{{ $unsold->winning_price }}</td>
            <td>{{ $unsold->base_price }}</td>
            <td>{{ $unsold->user_name }}</td>
            <td>{{ $unsold->quantity }}</td>
            <td>{{ $unsold->cat_name }}</td>
            <td>{{ date('j M, Y' , strtotime($unsold->date)) }} - {{ date('h:ia' , strtotime($unsold->time)) }}</td>
            <td><a href="/feedback/{{ $unsold->id }}">feedback</a></td>
          </tr>
          @endforeach
        </table>
      </div>
        <div role="tabpanel" class="tab-pane " id="feedback">
          <div class="row">
            @foreach($feedbacks as $feedback)
            <div class="col-md-6 col-sm-12">
              <div class="card1">
                <div class="col-md-3 sale-img">
                  <img src="img/dummy.png" style="border-radius:100%;">
                </div>
                <div class="col-md-6 col-md-offset-2">
                  <h2>{{ $feedback->pname }}</h2>
                  <p> {{ $feedback->uname }} : {{ date('j M, Y' , strtotime($feedback->created_at)) }} </p>
                  <p>Feedback : {{ $feedback->body }}</p>
                  <p>Polarity :
                    @if ($feedback->polarity==1)
                      Positive
                    @else
                      Negative
                    @endif </p>
                    <p>Confidence : {{ $feedback->confidence }}</p>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>


</div>
</div>
</div>
{{-- Tab End Here --}}

@endsection
