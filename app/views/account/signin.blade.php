@extends('layouts.login')

@section('content')
{{ Form::open(array('url' => 'account/sign-in','class'=>"form-signin")) }}
	@if(Session::has('global'))
			<p class="alert alert-danger"> {{ Session::get('global') }} </p>
		@endif
  <form class="form-signin">
        <h2 class="form-signin-heading" style="color: #273BDD;">Login Page</h2>
        {{ Form::text('login_username',Input::old('login_username'),array("id"=>"login_username",'class'=>'input-block-level','placeholder'=>'Username','data-required' => 'true')) }}
        @if($errors->has('login_username'))
            {{ $errors->first('login_username') }}
        @endif
        {{ Form::password('login_password',array('id'=> 'login_password','class'=>'input-block-level','placeholder'=>'Password','data-required' => 'true')) }}
        @if($errors->has('login_password'))
            {{ $errors->first('login_password') }}
        @endif
        <label class="checkbox">
          	<input type="checkbox" value="remember-me"> Remember me
        </label>
        {{ Form::submit('Sign in',array('class'=>'btn btn-large btn-primary')) }}
      </form>

{{ Form::close() }}
<script type="text/javascript">
$(document).ready(function(){

});     
</script>
@stop