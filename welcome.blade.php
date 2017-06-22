@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1>Move Toogedar.</h1>
                    <p>  Too Many Cars? Empty Seats? Traffic? </p>

                    <p>
                      <b> What if you could? </b> </br>
                      Securely get matched with someone going your way daily.
  Share the cost of the ride. Save a little money.
  Make a new friend, help reduce traffic and get to destination quicker!
</p>

<!--
                    @if($announcement->value)
                        <div class="card">
                            <div class="card-header">
                                Public Announcement ({{ $announcement->updated_at->diffForHumans() }})
                            </div>
                            <div class="card-block">
                                <div class="card-text">
                                    {{ $announcement->value }}
                                </div>
                            </div>
                        </div>
                    @endif

                  -->
                </div>
            </div>
        </div>
    </div>
    <div class="container section">
        <div class="row">
            <div class="col-md-4 text-xs-center">
                <div style="margin-bottom: 15px">
                    <i class="fa fa-bandcamp fa-5x"></i>
                </div>
                <p>Beat traffic everyday.</p>
            </div>
            <div class="col-md-4 text-xs-center">
                <div style="margin-bottom: 15px">
                    <i class="fa fa-handshake-o fa-5x"></i>
                </div>
                <p>Never drive empty again.</p>
            </div>
            <div class="col-md-4 text-xs-center">
                <div style="margin-bottom: 15px">
                    <i class="fa fa-car fa-5x"></i>
                </div>
                <p>Go to work safely, daily!</p>
            </div>
        </div>
    </div>
    <div class="jumbotron text-xs-center mb-0">
        <h1 class="display-4">
            Simple and Beautiful
        </h1>
        <p class="lead">Join Now!</p>
        <div class="mx-auto" style="max-width: 640px">
            <img src="http://previews.123rf.com/images/dolgachov/dolgachov1609/dolgachov160904796/62397628-business-trip-transportation-and-people-concept-young-smiling-african-american-woman-catching-taxi-a-Stock-Photo.jpg" alt="" class="img-fluid">
        </div>
    </div>
@endsection
