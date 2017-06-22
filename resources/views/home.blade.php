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
              /** @type {!HTMLInputElement} */(document.getElementById('source-city')),
              {
                  types: ['geocode'],
                  componentRestrictions: countryRestrict
              });

          destinationAutocomplete = new google.maps.places.Autocomplete(
              /** @type {!HTMLInputElement} */(document.getElementById('destination-city')),
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
    <div class="container section">
    <a class="btn btn-success pull-right" href="{{ url('/post/create') }}">Add a Trip!</a>
    <h2 class="display-4 mb-2">
            Hello {{ Auth::user()->fullName() }}!
        </h2>
        

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
        <div class="card mb-2">
            <div class="card-block p-1" style="background-color: #f3f3f3;">
                <form action="{{url('/search/home')}}" class="form-inline">
                    <div class="form-group{{ ($errors->has('postal_start')? ' has-danger' : '' ) }}">
                        <input id="home_address" type="text" class="form-control" onFocus="geolocate()" value="{{ $user->home_address }}" name="home_address" placeholder="Home Address"  maxlength="30">
                        @if($errors->has('postal_start'))
                            <div class="form-control-feedback">
                                {{ $errors->first('postal_start') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group{{ ($errors->has('postal_end')? ' has-danger' : '' ) }}">
                        <input id="office-address" type="text" class="form-control" onFocus="geolocate()" value="{{ $user->office_address }}" name="office_address" placeholder="Office Address"  maxlength="30">
                        @if($errors->has('postal_end'))
                            <div class="form-control-feedback">
                                {{ $errors->first('postal_end') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group{{ ($errors->has('postal_start')? ' has-danger' : '' ) }}">
                        <input id="source-city" type="text" class="form-control" onFocus="geolocate()" value="{{ $user->nearest_bus_stop_to_home }}" name="postal_start" placeholder="Source City"  maxlength="30">
                        @if($errors->has('postal_start'))
                            <div class="form-control-feedback">
                                {{ $errors->first('postal_start') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group{{ ($errors->has('postal_end')? ' has-danger' : '' ) }}">
                        <input id="destination-city" type="text" class="form-control" onFocus="geolocate()" value="{{ $user->nearest_bus_stop_to_office }}" name="postal_end" placeholder="Destination City"  maxlength="30">
                        @if($errors->has('postal_end'))
                            <div class="form-control-feedback">
                                {{ $errors->first('postal_end') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <select name="radius" id="" class="form-control" title="Radius" required>
                            @for ($i = 5; $i <= 50; $i += 5)
                                <option value="{{ $i }}"{{ ($search['radius'] == $i)? ' selected' : ''}}>{{ $i }} KM</option>
                            @endfor
                        </select>
                    </div>
                    <label class="form-check-inline">
                        <input class="form-check-input" type="radio" name="type" value="0"{{ (request()->type != 0)? '' : ' checked' }}> Recurring
                    </label>
                    <label class="form-check-inline">
                        <input class="form-check-input" type="radio" name="type" value="1"{{ (request()->type != 1)? '' : ' checked' }}> One Way Trip
                    </label>
                    <label class="form-check-inline">
                        <input class="form-check-input" type="radio" name="type" value="2"{{ (request()->type != 2)? '' : ' checked' }}> Round Trip
                    </label>
                    <br/>
                    <button class="btn btn-primary float-xs-right" type="submit">Search</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="card-deck">
                    @foreach($posts as $post)
                        <div class="card card-post mb-1">
                            <div class="card-block">
                                <div><small>Posted {{ $post->created_at->diffForHumans() }}</small></div>
                                <h4 class="card-title"><a href="/post/{{ $post->id }}">{{ $post->name }}</a>
                                </h4>
                                <p class="card-text">{{ substr($post->description, 0, 160) . ((strlen($post->description) > 160)? '...' : '') }}</p>
                                <div>
                                @if($post->postable_type == \App\LocalTrip::class)
                                    S: {{ $post->departure_pcode }} | E: {{ $post->destination_pcode }} |
                                @endif
                                    {{ $post->cost() }} | <i class="fa fa-comments-o"></i> {{ count($post->messages) }} | <i class="fa fa-car" aria-hidden="true"></i>: {{ $post->num_riders }} |
                                    <a href="#"><i  class="fa fa-map" data-toggle="modal" data-target="#post-modal-{{$loop->index}}"></i></a>
                                    <div class="modal fade" id="post-modal-{{$loop->index}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <iframe class="w-100" height="360" src="https://www.google.com/maps/embed/v1/directions?origin={{ $post->departure_pcode }}&destination={{ $post->destination_pcode }}&key=AIzaSyCgfUnLm9_WaYa9hov9l8z4dhVdUuQ6nRg"></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($post->postable_type != \App\LocalTrip::class)
                                    <div>
                                        S: {{ $post->postable->departure_city }}, {{ $post->postable->departure_province }} | E: {{ $post->postable->destination_city }}, {{ $post->postable->destination_province }}
                                    </div>
                                @endif
                                <div class="tag-container">
                                    <div class="tag tag-default tag-trip">{{ ($post->postable_type == \App\LocalTrip::class)? 'Local' : 'Long Distance'}}</div>
                                    <div class="tag tag-info">{{ ($post->one_time)? 'One Time' : 'Frequent'}}</div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="media">
                                    <a class="media-left" href="/user/{{ $post->poster->id }}">
                                        <img class="media-object rounded-circle" src="{{ $post->poster->avatarUrl(45) }}" width="45">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading" style="font-size: 14px">Posted By</h4>
                                        {{ $post->poster->fullName() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if ($search['postal_start'] == $user->nearest_bus_stop_to_home || $search['postal_end'] == $user->nearest_bus_stop_to_office)
                <small class="text-muted">
                    Found {{ count($posts) }} results.
                </small>
                @endif
            </div>
            <div class="col-md-3">
                <ul class="list-group">
                    @if(count($current_trips) > 0)
                        <li class="list-group-item">
                            <h5 class="font-weight-light">Current Trips</h5>
                            @foreach($current_trips as $current_trip)
                                <div class="sidebar-item">
                                    <small class="text-muted">{{ $current_trip->status() }}</small>
                                    <a class="d-block" href="/trip/{{$current_trip->id}}">{{$current_trip->name}}</a>
                                </div>
                            @endforeach
                        </li>
                    @endif
                    @if(count($posted_trips)> 0)
                        <li class="list-group-item">
                            <h5 class="font-weight-light">Hosting Trips</h5>
                            @foreach($posted_trips as $posted_trip)
                                <div class="sidebar-item">
                                    <small class="text-muted">{{ $posted_trip->status() }}</small>
                                    <a class="d-block" href="/trip/{{$posted_trip->id}}">{{$posted_trip->name}}</a>
                                </div>
                            @endforeach
                        </li>
                    @endif
                    <li class="list-group-item">
                        <h5 class="font-weight-light">Notifications</h5>
                        @foreach($notifications as $notification)
                            <div class="sidebar-item notifications">
                                <a href="{{ $notification->data['url'] }}">{{ $notification->data['message'] }}</a>
                            </div>
                        @endforeach
                        @if(count($notifications) == 0)
                            <small class="text-muted">No notifications.</small>
                        @else
                            <form action="/notifications/clear" method="post" class="">
                                {{ csrf_field() }}
                                <button class="btn btn-sm btn-danger">
                                    Clear <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="jumbotron mb-0">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Let us know if your city is not listed!</h5>
                    <p class="lead">If your city  or route is not listed, we would like to get your  feedback so that we can create it too.</p>
                    <a href="#">Learn More</a>
                </div>
            </div>
        </div>
    </div>
@endsection
