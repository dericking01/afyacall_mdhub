<div class="tab-pane active" id="resetpassword">

    <form action="javascript:void(0)" id="appSetupForm">
        {{csrf_field()}}
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