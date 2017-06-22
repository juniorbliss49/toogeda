@extends('layouts.app')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ url('css/theme.css') }}">
	<style type="text/css">
	.fw-section {
    position: relative;
    width: 100%;
    background-position: 50% 50%;
    background-repeat: no-repeat;
    background-size: cover;
}
.padding-bottom-8x {
    padding-bottom: 192px;
}
.padding-top-8x {
    padding-top: 192px;
}
.about-overlay{

    background-color: rgba(245,245,245,0.96);

}
.white-fs {
    color: #ffffff !important;
    font-size: 70px !important;
}

.bg-major-o {
    background-color: #f7921e !important;
}

.h-2 {
    height: 2px !important;
}

.btnformat{
	border-radius: 5px;
	background-color: #f7921e !important;
	color: #fff;
}
.btnformat:hover{
	color: #fff;
}

</style>

		<section class="fw-section with-overlay bg-parallax padding-top-8x padding-bottom-8x" data-parallax-speed="0.4" data-parallax-type="scale" id="home" style="background-image: url('/images/hands-making-equipment_1150-99.jpg');">
            <span class="overlay" style="opacity: 0.6; background-color: #0a0a0a;"></span>

            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center">
                            <h1 class="white-fs">
                                {{$campaign->title}}
                            </h1>
                            <div class="sep-med mrgt2"><div class="line-half-center-mini bg-major-o h-2"></div></div>
                            <!--<p class="fs20 white">
                                V.I &nbsp;|&nbsp; SURULERE &nbsp;|&nbsp; IKEJA &nbsp;|&nbsp; EGBEDA &nbsp;|&nbsp; YABA &nbsp;|&nbsp; MAGODO
                            </p>-->

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="full-bg BB1" data-offset-top="180" id="club">

            <div class="about-overlay w-container-large">

                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6">

                            <img class="img-responsive mrgt7" src="/{{$campaign->campaignimage}}">
                            <br>
                            <div class="addthis_inline_share_toolbox"></div>

                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6">
                        <br>
                        <br>
                        <br>
                            <h3 class="text-dark mobile" style="text-transform: uppercase;">About {{$campaign->title}}</h3>
                        <div class="line-half"><span class="mini h-3 bg-major-o"></span></div>
                            <div class="fs-1 w-container-small">
                                <p class="stp">
                                    {{$campaign->description}}

                                </p>
                                <p>
                                	The event will also feature a scoliosis screening session by certified practitioners so kids are invited! Sign up for
free at bit.ly/runforscoliosis to join!
Details on locations outside Lagos (i.e. Ilorin and Port Harcourt) can be found on our social media pages.
                                </p>
                                <p>Indigenous businesses and industries are welcome to support this event in the form of direct sponsorship
and/or partnership. Businesses and Industries supporting this event include: <b>YNaija, BellaNaija, Suntory Food
and Beverages (Ribena and Lucozade), Nigerian Medical Association (Kwara state Chapter), Lagos Mums,
Truppr and Photosuite.</b></p>
                                <p>“We all have the power to change a child’s world. The change I’m referring to doesn’t involve mountains of
time or even a large charitable contribution. It’s a fairly simple step that has the potential to change a life. It
could change one’s self image, interactions with others, as well as improve their happiness and quality of life.
All you have to do is be observant. <b>Screening your child for scoliosis is so very important. Why? Because early
diagnosis leads to better outcomes!” –Marce K</b></p>
                                <p class="major-o bold fs-1" style="font-weight: bold;">
                                <?php
                                	$start = strtotime($campaign->campaignstartdate);
                                	$end = strtotime($campaign->campaignenddate);
                                	$eventdate = '';

                                	if ($start == $end || $end == '') {
                                		$date1 = date('l, j', $start);
                                		$date2 = date('S', $start);
                                		$date3 = date('F', $start);
                                		$eventdate = $date1."".$date2." of ".$date3;
                                	}else{
                                		$date1 = date('l, j', $start);
                                		$date2 = date('S', $start);
                                		$date3 = date('F', $start);

                                		$dateend1 = date('l, j', $end);
                                		$dateend2 = date('S', $end);
                                		$dateend3 = date('F', $end);

                                		$eventdate = $date1."".$date2." of ".$date3." - ".$dateend1."".$dateend2." of ".$dateend3;

                                	}
                                ?>
                                    {{$eventdate}}, {{$campaign->campaignstarttime}} – {{$campaign->campaignendtime}}; Venue: {{$campaign->venue}}
                                </p>

                                <a href="/campaign/donate/{{$campaign->id}}" class="btn btn-large btnformat" style="text-decoration: none; font-weight: bold;">Participate</a>
                                <br><br><br><br>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </section>	



@endsection
@section('scripts')
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58f6229f176c1248"></script>
@endsection
