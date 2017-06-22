@extends('layouts.app')

@section('content')
    <div class="jumbotron mb-0">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1>Add some funds to your Toogedar account!</h1>
                    <p class="lead">The funds you add here will be available for you through out this platform.
                      You can use it to book new rides and make any other transactions on this platform</p>
                    <p>A user must maintain a <strong>minimum</strong> balance of ₦{{ number_format(\App\Setting::find('user_balance_threshold')->value, 2) }}</p>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-block">
                            <h4 class="card-title text-xs-center">Your balance, {{ Auth::user()->balance() }}</h4>
                            <div class="card-text">
                                <form action="/funds/add" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group{{ ($errors->has('amount'))? ' has-danger' : '' }}">
                                        <label for="form__amount">Amount</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">₦</span>
                                            <input type="number" class="form-control" id="form__amount" name="amount" required min="0">
                                        </div>
                                        @if($errors->has('amount'))
                                            <div class="form-control-feedback">
                                                {{ $errors->first('amount') }}
                                            </div>
                                        @endif
                                    </div>
                                    <button class="btn btn-primary btn-block">Add!</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-block">
                            <h4 class="card-title text-xs-center">Withdraw!</h4>
                            <div class="card-text">
                                <form action="/funds/withdraw" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group{{ ($errors->has('amount'))? ' has-danger' : '' }}">
                                        <label for="form__amount">Amount</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">₦</span>
                                            <input type="number" class="form-control" id="form__amount" name="amount" required min="0">
                                        </div>
                                        @if($errors->has('amount'))
                                            <div class="form-control-feedback">
                                                {{ $errors->first('amount') }}
                                            </div>
                                        @endif
                                    </div>
                                    <button class="btn btn-primary btn-block">Add!</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <h1>Withdrawing some funds.</h1>
                    <p class="lead">A minimum of ₦{{ number_format(\App\Setting::find('user_balance_withdraw')->value, 2) }} must be in your account to withdraw.</p>
                    <p>A driver can request for funds withdrawal here.</p>
                </div>
            </div>
        </div>
    </div>


    <div class="section text-xs-center">
        <div class="container">
            <div class="row flex-items-xs-center">
                <div class="col-md-8">
                    <h2 class="display-4">Learn more on how to save!</h2>
                    <p>use our raffle draw app to win more toogedar points for your trips!</p>
                    <button class="btn btn-info">Learn More</button>
                </div>
            </div>
        </div>
    </div>



    @if(Session::has('success'))
        <script>
            $(function(){
                swal("Good job!", "{{ Session::get('success') }}", "success")
            });
        </script>
    @endif





@endsection
