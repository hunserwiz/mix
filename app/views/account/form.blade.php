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
@if($model != null)
	{{ Form::hidden('id',$model->id) }}
@endif	

{{ $errors->first() }}
<div>
	<form name="form-sep">
		<!-- ################################################################################ -->
			<div class="row-fluid" >
					<div class="span6">
						<label class="span4"> firstName  :</label>
						<div class="span8">		
						@if($model->id)			
							{{ Form::text('first_name', Input::old('first_name'),
                                            array("id"=>"first_name",'required'=>'','class'=>'date-picker form-control','placeholder'=>'กรอกวันที่ลงข้อมูล')) }}
						@else
							{{ Form::text('first_name', $model->first_name,
                                            array("id"=>"first_name",'required'=>'','class'=>'date-picker form-control','placeholder'=>'กรอกวันที่ลงข้อมูล')) }}
						@endif
						</div>
					</div>
			</div>
			<!-- ################################################################################ -->
			<div class="row-fluid" >
					<div class="span6">
						<label class="span4"> LastName  :</label>
						<div class="span8">		
						@if($model->id)			
							{{ Form::text('last_name', Input::old('last_name'),
                                            array("id"=>"last_name",'required'=>'','class'=>'date-picker form-control','placeholder'=>'กรอกวันที่ลงข้อมูล')) }}
						@else
							{{ Form::text('last_name', $model->last_name,
                                            array("id"=>"last_name",'required'=>'','class'=>'date-picker form-control','placeholder'=>'กรอกวันที่ลงข้อมูล')) }}
						@endif			
						</div>
					</div>
			</div>
    	<!-- ################################################################################ -->
			<div class="row-fluid" >
				<div class="span6">
					<label class="span4"> username :</label>
					<div class="span8">
						@if($model->id)					
							{{ Form::text('price', Input::old('price'),
                                            array("id"=>"price",'required'=>'','class'=>'form-control','placeholder'=>'กรอกจำนวนเงิน')) }}
						@else
							{{ Form::text('price', $model->price,
                                            array("id"=>"price",'required'=>'','class'=>'form-control','placeholder'=>'กรอกจำนวนเงิน')) }}
						@endif						
					</div>
				</div>
			</div>
		<!-- ################################################################################ -->
			<div class="row-fluid" >
				<div class="span6">
					<label class="span4"> password :</label>
					<div class="span8">
						@if($model->id)					
							{{ Form::text('password', Input::old('password'),
                                            array("id"=>"password",'required'=>'','class'=>'form-control','placeholder'=>'กรอกจำนวนเงิน')) }}
						@else
							{{ Form::text('password', $model->password,
                                            array("id"=>"password",'required'=>'','class'=>'form-control','placeholder'=>'กรอกจำนวนเงิน')) }}
						@endif						
					</div>
				</div>
			</div>
		<!-- ################################################################################ -->
			<div class="row-fluid" >
				<div class="span6">
					<label class="span4"> re-password :</label>
					<div class="span8">
						@if($model->id)				
							{{ Form::text('password_re', Input::old('password_re'),
                                            array("id"=>"password_re",'required'=>'','class'=>'form-control','placeholder'=>'กรอกจำนวนเงิน')) }}
						@else
							{{ Form::text('password_re', $model->password_re,
                                            array("id"=>"password_re",'required'=>'','class'=>'form-control','placeholder'=>'กรอกจำนวนเงิน')) }}
						@endif						
					</div>
				</div>
			</div>

		<div class="text-center">
		 	{{ Form::submit('บันทึก',array('class'=>'btn btn-success')) }}
{{ Form::Close() }}
				<a href="{{ url('/finance') }}">
					<input type="button" class="btn btn-danger" value="ยกเลิก">
				</a>
		</div>
     </form> 
</div>

@stop