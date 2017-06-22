@extends('layouts.app')

@section('content')
    <div class="container section">
        <!--<h2 >
            Hello {{ Auth::user()->fullName() }}!
        </h2> -->

        <h2> What do you want to do? </h2>
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

<style>
.glyphicon-lg{font-size:3em}
.blockquote-box{border-right:5px solid #E6E6E6;margin-bottom:25px}
.blockquote-box .square{width:100px;min-height:50px;margin-right:22px;text-align:center!important;background-color:#E6E6E6;padding:20px 0}
.blockquote-box.blockquote-primary{border-color:#357EBD}
.blockquote-box.blockquote-primary .square{background-color:#428BCA;color:#FFF}
.blockquote-box.blockquote-success{border-color:#4CAE4C}
.blockquote-box.blockquote-success .square{background-color:#5CB85C;color:#FFF}
.blockquote-box.blockquote-info{border-color:#46B8DA}
.blockquote-box.blockquote-info .square{background-color:#5BC0DE;color:#FFF}
.blockquote-box.blockquote-warning{border-color:#EEA236}
.blockquote-box.blockquote-warning .square{background-color:#F0AD4E;color:#FFF}
.blockquote-box.blockquote-danger{border-color:#D43F3A}
.blockquote-box.blockquote-danger .square{background-color:#D9534F;color:#FFF}
</style>
    <div class="container text-center">

      <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3 col-md-offset-3">
          <a href="/addcampaign" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Create Campaign</a>
          <br><br>
        </div>
      </div>
      <div class="row ">
          <div class="col-md-5">
              <!--<a href="/home" style="color: black;">-->
              <a href="#" style="color: black;">
              <div class="blockquote-box clearfix">
                  <div class="square pull-left">
                    <i class="fa fa-car " style="font-size: 30px;" aria-hidden="true"></i>
                  </div>
                  <h4>
                      Move Together</h4>
                  <p>
                    Share rides with working professionals moving towards your direction.

                  </p>
              </div> </a>
              <div class="blockquote-box blockquote-primary clearfix">
                  <div class="square pull-left">
                    <i class="fa fa-object-group" style="font-size: 30px;" aria-hidden="true"></i>
                  </div>
                  <h4>
                      Meet Together</h4>
                  <p>
                        Meetup and connect with other working professionals.
                  </p>
              </div>
            <!--   <div class="blockquote-box blockquote-success clearfix">
                  <div class="square pull-left">
                      <span class="glyphicon glyphicon-tree-conifer glyphicon-lg"></span>
                  </div>
                  <h4>
                      Tree conifer</h4>
                  <p>
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a
                      ante.
                  </p>
              </div> -->
          </div>




          <!--<div class="col-md-6">-->
          <!--      <div class="blockquote-box blockquote-info clearfix">-->
          <!--        <div class="square pull-left">-->
          <!--            <i class="fa fa-star-o" style="font-size: 30px;" aria-hidden="true"></i>-->
          <!--        </div>-->
          <!--        <h4>-->
          <!--            Raffle Draw</h4>-->
          <!--        <p>-->
          <!--            Win free Toogedar points in our raffle draw picks! Just get in and start participating-->
          <!--        </p>-->
          <!--    </div>-->
              
    <a href="/viewcampaign" style="color: black;">
            <div class="col-md-6">
                <div class="blockquote-box blockquote-info clearfix">
                  <div class="square pull-left">
                      <i class="fa fa-star-o" style="font-size: 30px;" aria-hidden="true"></i>
                  </div>
                  <h4>
                      Do-Good Together</h4>
                  <p>
                      Do-Good Toogedar.
                  </p>
              </div>
    </a>
  <!--<a href="/funds" style="color: black;">-->
              <div class="blockquote-box blockquote-warning clearfix">
                  <div class="square pull-left">
                        <i class="fa fa-shopping-bag" style="font-size: 30px;" aria-hidden="true"></i>
                  </div>
                  <h4>
                      Add Funds</h4>
                  <p>
                    Fund your Toogedar accouunt.
                  </p>
              </div>
            </a>
              <!--<div class="blockquote-box blockquote-danger clearfix">
                  <div class="square pull-left">
                      <span class="glyphicon glyphicon-record glyphicon-lg"></span>
                  </div>
                  <h4>
                      Danger</h4>
                  <p>
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a
                      ante.
                  </p>
              </div> -->
          </div>
      </div>
  </div>


    <div class="jumbotron mb-0">
        <div class="container">
            <div class="row">
                <!--<div class="col-md-6">
                    <h5>Let us know if your city is not listed!</h5>
                    <p class="lead">If your city  or route is not listed, we would like to get your  feedback so that we can create it too.</p>
                    <a href="#">Learn More</a>
                </div> -->
            </div>
        </div>
    </div>
@endsection
