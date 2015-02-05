@extends('layouts.main')
@section('navigate')
        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}"><i class="icon-home"></i></a> <span class="divider">/</span></li>
          <li><a href="{{ url('/finance') }}">รายการบัญชีรายรับ - รายจ่าย</a><span class="divider">/</span></li>
          <li class="active" lang="En">เพิ่มบัญชีรายรับ - รายจ่าย</li>
        </ul>
@stop
@section('content')
{{ Form::open(array('url' => 'post-finance')) }}
@if($model != null)
	{{ Form::hidden('id',$model->id) }}
@endif	

{{ $errors->first() }}
<div>
	<form name="form-sep">
		<!-- ################################################################################ -->
			<div class="row-fluid" >
					<div class="span6">
						<label class="span4"> วันที่ลงข้อมูล  :</label>
						<div class="span8">		
						@if($model == null)			
							{{ Form::text('date_account', Input::old('date_account'),
                                            array("id"=>"date_account",'required'=>'','class'=>'date-picker form-control','placeholder'=>'กรอกวันที่ลงข้อมูล')) }}
						@else
							{{ Form::text('date_account', $model->date_account,
                                            array("id"=>"date_account",'required'=>'','class'=>'date-picker form-control','placeholder'=>'กรอกวันที่ลงข้อมูล')) }}
						@endif
						</div>
					</div>
			</div>
			<!-- ################################################################################ -->
			<div class="row-fluid" >
					<div class="span6">
						<label class="span4"> ประเภท  :</label>
						<div class="span8">		
						@if($model == null)			
							{{ Form::select('type', array(''=> 'กรุณาเลือก') + $list_type  , null, array('required'=>'',"class"=>"form-control")) }}
						@else
							{{ Form::select('type', array(''=> 'กรุณาเลือก') + $list_type  , $model->type , array('required'=>'',"class"=>"form-control")) }}
						@endif			
						</div>
					</div>
			</div>
    	<!-- ################################################################################ -->
			<div class="row-fluid" >
				<div class="span6">
					<label class="span4"> จำนวนเงิน :</label>
					<div class="span8">
						@if($model == null)			
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
					<label class="span4"> รายละเอียด :</label>
					<div class="span8">
						@if($model == null)			
							{{ Form::textArea('detail', Input::old('detail'),
                                            array("id"=>"detail",'required'=>'','class'=>'form-control','placeholder'=>'กรอกรายละเอียด')) }}
						@else	
							{{ Form::textArea('detail', $model->detail,
                                            array("id"=>"detail",'required'=>'','class'=>'form-control','placeholder'=>'กรอกรายละเอียด')) }}
						@endif	
					</div>
				</div>
			</div>
		<!-- ################################################################################ -->
		<div class="row-fluid" >
			<div class="span6">
				<label class="span4"> เจ้าหน้าที่ออกใบเสร็จ :</label>
				<div class="span8">
					@if($model == null)			
						{{ Form::select('create_by', array(''=> 'กรุณาเลือก') + $list_user  , null, array('required'=>'',"class"=>"form-control")) }}			
					@else
						{{ Form::select('create_by', array(''=> 'กรุณาเลือก') + $list_user  , $model->create_by , array('required'=>'',"class"=>"form-control")) }}			
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

<script type="text/javascript">
$(document).ready(function(){
	$(".date-picker").datepicker({
		format: 'dd-mm-yyyy',
	});
});

</script>

@stop