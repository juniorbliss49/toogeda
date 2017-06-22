@extends('layouts.app')

@section('content')

<script>
   // This example displays an address form, using the autocomplete feature
        // of the Google Places API to help users fill in the information.

        // This example requires the Places library. Include the libraries=places
        // parameter when you first load the API. For example:
         //<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

        var placeSearch, autocomplete;
        var countryRestrict = {'country': 'ng'};
        var countries = {
            'ng': {
              center: {lat: 9.0820, lng: 8.6753},
              zoom: 4
              }
            };
        var componentForm = {
          street_number: 'short_name',
          route: 'long_name',
          locality: 'long_name',
          administrative_area_level_1: 'short_name',
          country: 'long_name',
          postal_code: 'short_name'
        };

        function initMap() {
          // Set Search bounds
         var map = new google.maps.Map(document.getElementById('map'), {
            center: countries['ng'].center,
            zoom: countries['ng'].zoom
          });

          // Create the autocomplete object, restricting the search to geographical
          // location types.
          originAutocomplete = new google.maps.places.Autocomplete(
              /** @type {!HTMLInputElement} */(document.getElementById('form__departure_pcode')),
              {
                  types: ['geocode'],
                  componentRestrictions: countryRestrict
              });

          destinationAutocomplete = new google.maps.places.Autocomplete(
              /** @type {!HTMLInputElement} */(document.getElementById('form__destination_pcode')),
              {
                  types: ['geocode'],
                  componentRestrictions: countryRestrict
              });

            //Bounds
            originAutocomplete.bindTo('bounds', map);
            destinationAutocomplete.bindTo('bounds', map);


          // When the user selects an address from the dropdown, populate the address
          // fields in the form.
          originAutocomplete.addListener('place_changed', fillInAddress);
          destinationAutocomplete.addListener('place_changed', fillInAddress);
        }

        function fillInAddress() {
          // Get the place details from the autocomplete object.
          var place = originAutocomplete.getPlace();

          for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
          }

          // Get each component of the address from the place details
          // and fill the corresponding field on the form.
          for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
              var val = place.address_components[i][componentForm[addressType]];
              document.getElementById(addressType).value = val;
            }
          }
        }


        // Bias the autocomplete object to the user's geographical location,
        // as supplied by the browser's 'navigator.geolocation' object.
        function geolocate() {
          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
              var geolocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
              };
              var circle = new google.maps.Circle({
                center: geolocation,
                radius: position.coords.accuracy
              });
              originAutocomplete.setBounds({strictBounds: true});
             });
          }
        }

        </script>


<div id="map"></div>
    <div class="jumbotron">
        <div class="container">
            <h1>Create a post!</h1>
            <p class="lead">Remember you must have a valid license plate number.</p>
        </div>
    </div>
    <div class="container section">
        <div class="row">
            <div class="col-md-8">
                @if(! empty(Auth::user()->license_num))
                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif
                    <form action="/post" method="post">
                    {{ csrf_field() }}
                    <div class="form-group{{ ($errors->has('name'))? ' has-danger' : '' }}">
                        <label class="form-control-label" for="form__name">Name</label>
                        <input type="text" class="form-control" id="form__name" name="name" value="{{ old('name') }}" required maxlength="255">
                        @if($errors->has('name'))
                            <div class="form-control-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group{{ ($errors->has('description'))? ' has-danger' : '' }}">
                        <label class="form-control-label" for="form__description">Description</label>
                        <textarea class="form-control" id="form__description" name="description" rows="3" required>{{ old('description') }}</textarea>
                        @if($errors->has('description'))
                            <div class="form-control-feedback">
                                {{ $errors->first('description') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group{{ ($errors->has('num_riders'))? ' has-danger' : '' }}">
                        <label class="form-control-label" for="form__num_riders">Number of Riders</label>
                        <input type="number" class="form-control" id="form__num_riders" name="num_riders" value="{{ old('num_riders') }}" required min="0">
                        @if($errors->has('num_riders'))
                            <div class="form-control-feedback">
                                {{ $errors->first('num_riders') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="route_bus_stops" name="destination_pcode" value="" required>
                    </div>
                    <div class="form-group{{ ($errors->has('departure_pcode'))? ' has-danger' : '' }}">
                        <label class="form-control-label" for="form__departure_pcode">Source City</label>
                        <input type="text" class="form-control" id="form__departure_pcode" onFocus="geolocate()" name="departure_pcode" value="{{ old('departure_pcode') }}" required>
                        <small class="form-control-feedback">
                            eg. Waec bus stop, Yaba
                        </small>
                        @if($errors->has('departure_pcode'))
                            <div class="form-control-feedback">
                                {{ $errors->first('departure_pcode') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group{{ ($errors->has('destination_pcode'))? ' has-danger' : '' }}">
                        <label class="form-control-label" for="form__destination_pcode">Destination city</label>
                        <input type="text" class="form-control" id="form__destination_pcode" onFocus="geolocate()" name="destination_pcode" value="{{ old('destination_pcode') }}" required>
                        <small class="form-control-feedback">
                            Eko hotel round about, yaba
                        </small>
                        @if($errors->has('destination_pcode'))
                            <div class="form-control-feedback">
                                {{ $errors->first('destination_pcode') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <legend>Trip Type</legend>
                        <label class="form-check-inline">
                            <input class="form-check-input" type="radio" name="type" value="1" {{ (old('type') == 1 || old('type') == null)? 'checked' : '' }}> Local Trip
                        </label>
                        <label class="form-check-inline">
                            <input class="form-check-input" type="radio" name="type" value="0" {{ (old('type') == 0 && old('one_time') != null)? 'checked' : '' }}> Long Distance Trip
                        </label>
                    </div>
                    <div class="form-group">
                        <legend>One Time or Frequent</legend>
                        <label class="form-check-inline">
                            <input class="form-check-input" type="radio" name="one_time" value="1" {{ (old('one_time') == 1 || old('one_time') == null)? 'checked' : '' }}> One Time
                        </label>
                        <label class="form-check-inline">
                            <input class="form-check-input" type="radio" name="one_time" value="0" {{ (old('one_time') == 0 && old('one_time') != null)? 'checked' : '' }}> Frequent
                        </label>
                    </div>
                    <div class="form-group onet-wrap{{ ($errors->has('departure_date'))? ' has-danger' : '' }}{{ (old('one_time') == 1 || old('one_time') == null)? ' active' : '' }}">
                        <label class="form-control-label" for="form__departure_date">Departure Date</label>
                        <input type="date" class="form-control form-reset" id="form__departure_date" name="departure_date" placeholder="eg. 01-Jan-2018" value="{{ old('departure_date') }}" min="{{ \Carbon\Carbon::now()->toDateString() }}">
                        @if($errors->has('departure_date'))
                            <div class="form-control-feedback">
                                {{ $errors->first('departure_date') }}
                            </div>
                        @endif
                    </div>
                    <div class="type-wrap{{ (old('type') == 1 || old('type') == null)? ' active' : '' }}">
                        <div class="freq-wrap{{ (old('one_time') == 0 && old('one_time') != null)? ' active' : '' }}">
                            <div class="form-group">
                                <legend>Frequency</legend>
                                <label class="form-check-inline">
                                    <input type="hidden" name="every_sun" value="0">
                                    <input class="form-check-input" type="checkbox" name="every_sun" value="1" {{ old('every_sun')? 'checked': ''}}> Sunday
                                </label>
                                <label class="form-check-inline">
                                    <input type="hidden" name="every_mon" value="0">
                                    <input class="form-check-input" type="checkbox" name="every_mon" value="1" {{ old('every_mon')? 'checked': ''}}> Monday
                                </label>
                                <label class="form-check-inline">
                                    <input type="hidden" name="every_tues" value="0">
                                    <input class="form-check-input" type="checkbox" name="every_tues" value="1" {{ old('every_tues')? 'checked': ''}}> Tuesday
                                </label>
                                <label class="form-check-inline">
                                    <input type="hidden" name="every_wed" value="0">
                                    <input class="form-check-input" type="checkbox" name="every_wed" value="1" {{ old('every_wed')? 'checked': ''}}> Wednesday
                                </label>
                                <label class="form-check-inline">
                                    <input type="hidden" name="every_thur" value="0">
                                    <input class="form-check-input" type="checkbox" name="every_thur" value="1" {{ old('every_thur')? 'checked': ''}}> Thursday
                                </label>
                                <label class="form-check-inline">
                                    <input type="hidden" name="every_fri" value="0">
                                    <input class="form-check-input" type="checkbox" name="every_fri" value="1" {{ old('every_fri')? 'checked': ''}}> Friday
                                </label>
                                <label class="form-check-inline">
                                    <input type="hidden" name="every_sat" value="0">
                                    <input class="form-check-input" type="checkbox" name="every_sat" value="1" {{ old('every_sat')? 'checked': ''}}> Saturday
                                </label>
                            </div>
                        </div>
                        <div class="form-group{{ ($errors->has('time'))? ' has-danger' : '' }}">
                            <label for="form__time">Departure Time</label>
                            <input type="time" class="form-control form-reset" placeholder="eg. 08:00 AM" id="form__time" name="time" value="{{ old('time') }}">
                            @if($errors->has('time'))
                                <div class="form-control-feedback">
                                    {{ $errors->first('time') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="type-wrap{{ (old('type') == 0)? ' active' : '' }}">
                        <div class="freq-wrap{{ (old('one_time') == 0)? ' active' : '' }}">
                            <div class="form-group">
                                <label for="">Frequency</label>
                                <select class="form-control" name="frequency">
                                    <option value="0" {{ (old('frequency') == 0)? 'selected' : '' }}>Every Sunday</option>
                                    <option value="1" {{ (old('frequency') == 1)? 'selected' : '' }}>Every Monday</option>
                                    <option value="2" {{ (old('frequency') == 2)? 'selected' : '' }}>Every Tuesday</option>
                                    <option value="3" {{ (old('frequency') == 3)? 'selected' : '' }}>Every Wednesday</option>
                                    <option value="4" {{ (old('frequency') == 4)? 'selected' : '' }}>Every Thursday</option>
                                    <option value="5" {{ (old('frequency') == 5)? 'selected' : '' }}>Every Friday</option>
                                    <option value="6" {{ (old('frequency') == 6)? 'selected' : '' }}>Every Saturday</option>
                                    <option value="7" {{ (old('frequency') == 7)? 'selected' : '' }}>Twice-Monthly</option>
                                    <option value="8" {{ (old('frequency') == 8)? 'selected' : '' }}>Monthly</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary">Create Post!</button>
                </form>
                @else
                    <h3>Sorry!</h3>
                    <p class="lead">You must add a license plate number to your account before creating a post!</p>
                @endif
            </div>
            <div class="col-md-4">
                <h3>Need Help?</h3>
                <p>Verification is done physically at our office at number Eko Hotel, VI, Lagos. Please come with your car and its particulars.</p>
            </div>
        </div>
    </div>

    <script>
        $(function(){
            var $type_selection = $('input[name="type"]');
            var $freq_selection = $('input[name="one_time"]');
            var $type_wrap = $('.type-wrap');
            var $freq_wrap = $('.freq-wrap');
            var $onet_wrap = $('.onet-wrap');
            var inputs = $('.form-reset');

            $type_selection.change(function(){
                var val = $(this).val();
                $('.type-wrap.active').removeClass('active');
                $type_wrap.eq(++val % 2).addClass('active');
                inputs.val('');
            });
            $freq_selection.change(function(){
                var val = $(this).val();
                if(val == 1){
                    $freq_wrap.removeClass('active');
                    $onet_wrap.addClass('active');
                } else {
                    $freq_wrap.addClass('active');
                    $onet_wrap.removeClass('active');
                }
                inputs.val('');
            });
        });
    </script>

@endsection
