@extends('layouts.main')
@section('navigate')
        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}"><i class="icon-home"></i></a> <span class="divider">/</span></li>
          <li><a href="{{ url('/finance') }}">รายการผู้ใช้งาน</a><span class="divider">/</span></li>
          <li class="active" lang="En">เพิ่มผู้ใช้งาน</li>
        </ul>
@stop
@section('content')
{{ Form::open(array('url' => 'post-user')) }}
@if(!empty($model->id))
	{{ Form::hidden('id',$model->id) }}
	{{ Form::hidden('email',$model->email) }}
@endif	

<div>
	<form name="form-sep">
		<!-- ################################################################################ -->
			<div class="row-fluid" >
					<div class="span6">
						<label class="span4"> ชื่อ  :</label>
						<div class="span8">		
						@if(empty($model->id))		
							{{ Form::text('first_name', Input::old('first_name'),
                                            array("id"=>"first_name",'class'=>'date-picker form-control','placeholder'=>'กรอกชื่อ')) }}
						@else
							{{ Form::text('first_name', $model->first_name,
                                            array("id"=>"first_name",'class'=>'date-picker form-control','placeholder'=>'กรอกชื่อ')) }}
						@endif
						@if($errors->has('first_name'))
										<span id='span_first_name'>
								        </span>
								        <p id='first_name'>
								        	{{ $errors->first('first_name') }}
								        </p>
						@endif	
						</div>
					</div>
			</div>
			<!-- ################################################################################ -->
			<div class="row-fluid" >
					<div class="span6">
						<label class="span4"> นามสกุล  :</label>
						<div class="span8">		
						@if(empty($model->id))			
							{{ Form::text('last_name', Input::old('last_name'),
                                            array("id"=>"last_name",'class'=>'date-picker form-control','placeholder'=>'กรอกนามสกุล')) }}
						@else
							{{ Form::text('last_name', $model->last_name,
                                            array("id"=>"last_name",'class'=>'date-picker form-control','placeholder'=>'กรอกนามสกุล')) }}
						@endif	
						@if($errors->has('last_name'))
										<span id='span_last_name'>
								        </span>
								        <p id='last_name'>
								        	{{ $errors->first('last_name') }}
								        </p>
						@endif			
						</div>
					</div>
			</div>
			<!-- ################################################################################ -->
			<div class="row-fluid" >
				<div class="span6">
					<label class="span4"> Email :</label>
					<div class="span8">
						@if(empty($model->id))					
							{{ Form::text('email', Input::old('email'),
                                            array("id"=>"email",'class'=>'form-control','placeholder'=>'กรอกอีเมล')) }}
						@else
							{{ Form::text('email', $model->email,
                                            array("id"=>"email",'class'=>'form-control','placeholder'=>'กรอกอีเมล','disabled'=>'true')) }}
						@endif	
						@if($errors->has('email'))
										<span id='span_email'>
								        </span>
								        <p id='email'>
								        	{{ $errors->first('email') }}
								        </p>
						@endif						
					</div>
				</div>
			</div>
			<!-- ################################################################################ -->
			<div class="row-fluid" >
				<div class="span6">
					<label class="span4"> ประเภทผู้ใช้งาน :</label>
					<div class="span8">
						@if(empty($model->id))					
							{{ Form::select('user_type', 
								array(''=> 'กรุณาเลือก',
								'1'=>'admin',
								'2'=>'operate',
								'3'=>'sell')  
								, null, array('id'=>'user_type',"class"=>"form-control")) 
							}}
						@else
							{{ Form::select('user_type', 
								array(''=> 'กรุณาเลือก',
								'1'=>'admin',
								'2'=>'operate',
								'3'=>'sell')  
								, $model->user_type, array('id'=>'user_type',"class"=>"form-control")) 
							}}
						@endif	
						@if($errors->has('user_type'))
										<span id='span_user_type'>
								        </span>
								        <p id='user_type'>
								        	{{ $errors->first('user_type') }}
								        </p>
						@endif						
					</div>
				</div>
			</div>
			
    	<!-- ################################################################################ -->
			<div class="row-fluid" >
				<div class="span6">
					<label class="span4"> ชื่อเข้าใข้งาน :</label>
					<div class="span8">
						@if(empty($model->id))					
							{{ Form::text('username', Input::old('username'),
                                            array("id"=>"username",'class'=>'form-control','placeholder'=>'กรอกชื่อใช้งาน')) }}
						@else
							{{ Form::text('username', $model->username,
                                            array("id"=>"username",'class'=>'form-control','placeholder'=>'กรอกชื่อใช้งาน')) }}
						@endif	
						@if($errors->has('username'))
										<span id='span_username'>
								        </span>
								        <p id='username'>
								        	{{ $errors->first('username') }}
								        </p>
						@endif						
					</div>
				</div>
			</div>
		<!-- ################################################################################ -->
			<div class="row-fluid" >
				<div class="span6">
					<label class="span4"> รหัสผ่าน :</label>
					<div class="span8">				
							{{ Form::password('password', null ,
                                            array("id"=>"password",'class'=>'form-control','placeholder'=>'กรอกรหัสผ่าน','minlength'=>'6','maxlength'=>'12')) }}.
						@if($errors->has('password'))
										<span id='span_password'>
								        </span>
								        <p id='password'>
								        	{{ $errors->first('password') }}
								        </p>
						@endif					
					</div>
				</div>
			</div>
		<!-- ################################################################################ -->
			<div class="row-fluid" >
				<div class="span6">
					<label class="span4"> ยืนยันรหัสผ่าน :</label>
					<div class="span8">		
							{{ Form::password('password_again', null,
                                            array("id"=>"password_again",'class'=>'form-control','placeholder'=>'กรอกรหัสผ่าน อีกครั้ง','minlength'=>'6','maxlength'=>'12')) }}
						@if($errors->has('password_again'))
										<span id='span_password_again'>
								        </span>
								        <p id='password_again'>
								        	{{ $errors->first('password_again') }}
								        </p>
						@endif	
					</div>
				</div>
			</div>

		<div class="text-center">
		 	{{ Form::submit('บันทึก',array('class'=>'btn btn-success')) }}
{{ Form::Close() }}
				<a href="{{ url('/manage-user') }}">
					<input type="button" class="btn btn-danger" value="ยกเลิก">
				</a>
		</div>
     </form> 
</div>

@stop