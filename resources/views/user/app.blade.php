 <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">


    <script src="https://use.fontawesome.com/db38f8431a.js"></script>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <link href="{{ url('css/vendor.css') }}" rel="stylesheet">
        <script src="{{ url('js/vendor.js') }}"></script>

        <link href="{{ url('css/app.css') }}" rel="stylesheet">
        <script src="{{ url('js/app.js') }}"></script>

        <script>
            window.Everest = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!}
        </script>

    </head>
    <body>

        <nav class="navbar navbar-light bg-warning">
            <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#nav-collapse" aria-controls="nav-collapse" aria-expanded="false" aria-label="Toggle navigation"></button>
            <div class="collapse navbar-toggleable-md" id="nav-collapse">
                <a class="navbar-brand" href="/choose">
                    <img src="/images/logo/logo-hori.png" alt="">
                </a>
                <ul class="nav navbar-nav float-lg-right" style="margin-right: 180px">
                    @if(Auth::guest())
                        <li class="nav-item dropdown">
                            <a href="#" class="dropdown-toggle btn btn-primary btn-block" data-toggle="dropdown" aria-expanded="false">Log In <span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-lr animated" style="width: 300px" role="menu">
                                <div class="col-12 col-lg-12">
                                    <form action="/login" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group{{ ($errors->has('email'))? ' has-danger' : '' }}">
                                        <label for="form__email">Email</label>
                                        <input type="text" class="form-control" id="form__email" name="email" required maxlength="255">
                                        @if($errors->has('email'))
                                            <div class="form-control-feedback">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="form__password">Password</label>
                                        <input type="password" class="form-control" id="form__password" name="password" required maxlength="255">
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="remember">
                                            Remember me
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                                </form>
                                <div class="auth-more-info">
                                    <p>
                                        <a class="pull-left" href="{{ url('/password/reset') }}">
                                            Forgot Your Password?
                                        </a>
                                    </p>
                               </div>
                               <br>
                                </div>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="dropdown-toggle btn btn-primary btn-block" data-toggle="dropdown" aria-expanded="false">Register <span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-lr animated flipInX text-lg-left" style="width: 300px;" role="menu">
                                <div class="col-lg-12" >
                                        <form action="/register") enctype="multipart/form-data" method="post">
                                        {{ csrf_field() }}
                                        @if(count($errors) > 0)
                                            <div class="alert alert-danger">
                                                @foreach($errors->all() as $error)
                                                    <div>{{ $error }}</div>
                                                @endforeach
                                            </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="form-group{{ ($errors->has('first_name'))? ' has-danger' : '' }}">
                                                    <label for="form__first_name">First Name</label>
                                                    <input type="text" class="form-control" id="form__first_name" name="first_name" value="{{ old('first_name') }}" required maxlength="255">
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group{{ ($errors->has('first_name'))? ' has-danger' : '' }}">
                                                    <label for="form__last_name">Last Name</label>
                                                    <input type="text" class="form-control" id="form__last_name" name="last_name" value="{{ old('last_name') }}" required maxlength="255">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group{{ ($errors->has('email'))? ' has-danger' : '' }}">
                                            <label for="form__email">Personal Email</label>
                                            <input type="email" class="form-control" id="form__email" name="email" value="{{ old('email') }}" required maxlength="255">
                                        </div>
                                        <div class="form-group{{ ($errors->has('phone'))? ' has-danger' : '' }}">
                                            <label for="form__phone">Phone </label>
                                            <input type="number" class="form-control" id="form__phone" name="phone" value="{{ old('phone') }}" required maxlength="255">
                                        </div>
                                        <div class="form-group{{ ($errors->has('first_name'))? ' has-danger' : '' }}">
                                            <label for="form__password">Password</label>
                                            <input type="password" class="form-control" id="form__password" name="password" required maxlength="255">
                                        </div>
                                        <div class="form-group{{ ($errors->has('first_name'))? ' has-danger' : '' }}">
                                            <label for="form__password">Confirm Password</label>
                                            <input type="password" class="form-control" id="form__password_confirmation" name="password_confirmation" required maxlength="255" min="0">
                                        </div>
                                        <div class="form-group{{ ($errors->has('referral_id'))? ' has-danger' : '' }}">
                                            <label for="form__referral_id">Referral Code</label>
                                            <input type="text" class="form-control" id="form__referral_id"
                                            name="referral_id" value="{{ old('referral_id') }}">
                                        </div>
                                       <!-- <div class="form-group{{ ($errors->has('payment'))? ' has-danger' : '' }}">
                                            <label for="form__payment">Optional Intial Account Fund (₦{{ number_format($membership_fee, 2) }})</label>
                                            <input type="text" class="form-control" id="form__payment" name="payment" value="{{ old('payment') }}" required min="{{ $membership_fee }}" max="{{ $membership_fee }}">
                                        </div>
                                        <div class="form-group{{ ($errors->has('first_name'))? ' has-danger' : '' }}">
                                            <label for="">Profile Picture</label>
                                            <input type="file" class="form-control-file" name="avatar" accept="image/*">
                                            <small class="form-text text-muted">Optional, 300x300px minimum, 5MB max</small>
                                        </div>  -->
                                        <button class="btn btn-primary btn-block">Signup</button>
                                    </form>
                                    <br>
                                </div>
                            </ul>
                        </li>

                    @else
                               <li class="nav-item">
                                    <span class="navbar-text text-muted " style="font-size: bold; color: black;">Balance {{ Auth::user()->balance() }}</span>
                                </li>
    <li class="nav-item dropdown">
    <a href="/user/{{ Auth::user()->id }}"><img src="{{ Auth::user()->avatarUrl(40) }}" class="img-fluid rounded-circle navbar-avatar" alt=""></a>
    <a class="nav-link dropdown-toggle d-inline-block" id="navbar-dropdown" href="/user/{{ Auth::user()->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ Auth::user()->first_name }}
    </a>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-dropdown">
                                <a class="dropdown-item" href="/user/{{ Auth::user()->id }}">Profile</a>
                                <a class="dropdown-item" href="/mail">Mail</a>
                                <a class="dropdown-item" href="/conversation">Conversations</a>
                                <a class="dropdown-item" href="/post/create">Create Trip</a>
                                <a class="dropdown-item" href="/funds">Add Funds</a>

                                <a class="dropdown-item" href="#"  onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                                @if(Auth::user()->hasRole('admin'))
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/user">Manage Users</a>
                                    <a class="dropdown-item" href="/post">Manage Posts</a>
                                    <a class="dropdown-item" href="/trip">Manage Trips</a>
                                    <a class="dropdown-item" href="/setting">System Settings</a>
                                @endif
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle d-inline-block" id="navbar-dropdown" href="/user/{{ Auth::user()->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Products
    </a>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-dropdown">
                                <a class="dropdown-item" href="#">Move Toogedar</a>
                                <a class="dropdown-item" href="#">Meet Toogedar</a>
                                <a class="dropdown-item" href="#">Raffle draw</a>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>

        @yield('content')

        <div class="container text-xs-center copyright">
            All rights reserved | Toogedar &copy; Copyright {{ date('Y') }} <!--Super | Made with &hearts; by <a href="https://fb.com/daveozoalor">Dave Partner</a>
    -->  </div>

        @yield('scripts')
            <script src='/js/jquery-1.11.3.min.js'></script>
            <script src='/js/script.js'></script>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBS54CCJLM_3j0RKy5Kl2TZUs2sE67dWik&libraries=places&callback=initMap"
                    async defer>
                    </script>
    </body>
    </html>
