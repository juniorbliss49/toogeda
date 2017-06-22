@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ url('css/theme.css') }}">
<style type="text/css">
	.btnformat{
	border-radius: 15px;
	font-weight: bold;
	background-color: #f7921e !important;
	color: #fff;
}

.raffle-text {
    padding: 45px;
}
.checkbox-inline{
	float: left;
	margin-right: 10px;
}
#firstname_error{
	display: none;
}
#phone_error{
	display: none;
}
#donationerror{
	display: none;
}
#show{
  display: none;
}

</style>
<div class="container-fluid">
<br>
<br>
  <div class="row">

    <div class="col-lg-6">
 <!-- <section class="fw-section with-overlay bg-parallax padding-top-8x padding-bottom-8x" data-parallax-speed="0.4" data-parallax-type="scale" id="home"
                                                                    style="background-image: url('assets/img/hands-making-equipment_1150-99.jpg');">
            <span class="overlay" style="opacity: 0.6; background-color: #0a0a0a;"></span> -->

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <img class="img-responsive mrgt7" src="/{{$campaign->campaignimage}}">
                    </div>
                </div>
            </div>
        <!-- </section> -->
        <div class="col-md-12">
            <div class="row raffle-text">
            <div class="col-sm-6">
              <h4>Beyond A Curved Spine</h4>
            </div>
                              <div class="col-sm-6">
                              	<hr>
                              <!-- <h3 class="heading-title">John Doe needs your help. hr</h3> -->
                                <p>Participate by Donating your Time to this event! </p>
                              </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-md-12">
                              
                              
                                <p>This is our primary motivation at Beyond a Curved Spine Initiative, knowing that by EARLY DETECTION, children
living with Scoliosis can immediately get help, reducing the health complications and issues that arise from a
badly curved spine and also building a community of love and strength for ScoliWarriors!</p>

<p>“We all have the power to change a child’s world. The change I’m referring to doesn’t involve mountains of
time or even a large charitable contribution. It’s a fairly simple step that has the potential to change a life. It
could change one’s self image, interactions with others, as well as improve their happiness and quality of life.
All you have to do is be observant. <b>Screening your child for scoliosis is so very important. Why? Because early
diagnosis leads to better outcomes!” –Marce K</b></p>
                                <div class="addthis_inline_share_toolbox"></div>

                        </div>

                    </div>
                </div>
                <br>
                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                
            </div>
        </div>
  </div>
  <div class="col-lg-5">
    <div class="text-bold fs-2 btn-orange">
    <h4>{{$campaign->title}}</h4>
    <br>
      
    </div>
      <div class="raffle-form">
              <div class="row">

              		<div class='col-md-12'>
                  <!--<div class="form-group">
                      <label for="referral-id">Referral ID</label>
                      <input type="text"  name="referral-id" id="referral-id" value="" diabled>
                  </div>-->
                  <div class="form-group" autocomplete="on">
                      <label for="full-name">Full Name</label>
                      <input type="text" class="form-control" autocomplete="off" id="full_name" name="full_name" min-length="3" placeholder="Full Name" required="" value=
                      <?php
                      if (!is_null(Auth::User())) {
                      	echo Auth::User()->first_name.' '.Auth::User()->last_name;
                      }else{

                      }
                      ?> >
                      <span id="firstname_error" style="color:orange;">Name is missing</span>
                  </div>
                  <div class="form-group">
                      <label for="phone">Phone Number</label>
                      <input type="text" autocomplete="on" id="phone_number" name="phone_number" value="" placeholder="Phone Number" min-length="11" required="">
                      <span id="phone_error" style="color:red;">Phone Number is missing</span>
                  </div>
                  <div class="form-group">
                      <label for="email">Email</label>
                      <input type="text" autocomplete="on" id="email" name="email" placeholder="Email" required="" value=
                      <?php
                      if (!is_null(Auth::User())) {
                      	echo Auth::User()->email;
                      }else{

                      }
                      ?>
                      >

                  </div>
                              
                  <!-- <div class="input-group">
                    <p>Coming to Event?</p>
                    <label class="checkbox-inline"><input type="checkbox" value="">Option 1</label>
                    <label class="checkbox-inline"><input type="checkbox" value="">Option 2</label>
                  </div> --><br>
                  
                  <!--<div class="form-group">
                      <label for="location">How many Tickets?</label>
                      <select id="qty" name="qty">
                          <option value="1" selected>1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option>
                      </select>
                  </div>-->
                  <label class="checkbox-inline"><input type="checkbox" name="anonymous" id="anonymous" value="1"> Donate Anonymously</label>
                  </div>
              </div>
              <div class="row">
              	<div class="col-sm-12">
              		<p>Please indicate by clicking the option you want to donate</p>
              		<?php echo $view ?>

                      <span id="donationerror" style="color:red;">Please click one of the options</span>
              		<br>
              	<div class="form-group" id="amountshow" style="display: none;">
                      <span class="">Amount in NGN (₦)</span>
                      <input type="number" autocomplete="off" max-length="8" name="amount" value="" placeholder="Enter amount" id="qty" required="">

                  </div>
              	</div>
              </div>
              <!-- <button type="but
              ton" class="btn   btn-primary btn-nl ">Secure payment by Paystack&nbsp;<i class="fa fa-credit-card"></i></button>-->
              <button type="submit" name="submit"  class="btn btn-solid btn-pill btnformat donate">Participate</button>
              <input type="hidden" id="campaign" name="campaign" value="{{$campaign->id}}">
              <br>
              <br>
              <div id="show" class="alert alert-success" role="alert"></div>
          
      <br>  
      <br>
      <br>

      <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Supporters</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @foreach($donationall as $donates)
     
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-warning">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"> 
                                                @if($donates->anonymous == 'yes')
                                                	Anonymous
                                                @else
                                                	{{$donates->name}}
                                                @endif
                                                </h3>
                                			</div>
			                                <div class="panel-body">
			                                </div>
                            				</div>
			                        	</div>
			                    </div>
		 @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>     

      <div class="container">
      <h4>Supporters</h4>
      @foreach($donation as $donate)
     
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-warning">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"> 
                                                @if($donate->anonymous == 'yes')
                                                	Anonymous
                                                @else
                                                	{{$donate->name}}
                                                @endif
                                                </h3>
                                			</div>
			                                <div class="panel-body">
			                                </div>
                            				</div>
			                        	</div>
			                    </div>
		 @endforeach
		 @if($countdonation > 10)
		 <div class="row">
		 <div class="col-md-12">
		 	<button class="btn btn-outline-warning btn-sm btn-block" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-plus" aria-hidden="true"></i> See all</button>
		 </div>
		 	
		 </div>
		 @endif
		 
                                </div>                        
                            </div>
                        </div>
                        <!-- /col-sm-5 -->
                    </div>

                </div>
@endsection
@section('scripts')
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58f6229f176c1248"></script>
@endsection










