@extends('layouts.auth')
@section('title')
    {{config('app.name')}} - Reset Password
@endsection

@section('content')

    <div class="clearfix"></div>
    <br><br><br><br>
    <div class="wrapper-page">
        <div class="card-box form-zoom-in-up {{ $errors->has('email') || $errors->has('password') ? 'form-shake' : '' }}">
            <div>
                <img src="{{ url('/images/afyaCall.png') }}">
            </div>

            <div class="p-20">
                <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                    {{ csrf_field() }}

                     <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group-custom">
                        <input type="email" id="user-name" name="email" value="{{ $email or old('email') }}" required="required"/>
                        <label class="control-label" for="user-name">Email Address</label><i class="bar"></i>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="form-group-custom">
                        <input type="password" id="password" name="password" value="{{old('password')}}"
                               required="required"/>
                        <label class="control-label" for="password">Password</label><i class="bar"></i>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>


                    
                    <div class="form-group-custom">
                        <input type="password" id="password-confirm" name="password-confirm" value="{{old('password-confirm')}}"
                               required="required"/>
                        <label class="control-label" for="password-confirm"> Comfirm Password</label><i class="bar"></i>
                        @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                         @endif
                    </div>

                    <div class="form-group text-center m-t-40">
                        <div class="col-12">
                            <button class="btn btn-success btn-block text-uppercase waves-effect waves-light"
                                    type="submit"> Reset Password
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
      
    </div>
@endsection
