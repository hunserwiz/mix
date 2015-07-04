@extends('layouts.main')
@section('navigate')
        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}"><i class="icon-home"></i></a> <span class="divider">/</span></li>
          <li><a href="{{ url('/debtor') }}">รายการลูกหนี้</a> <span class="divider">/</span></li>
          <li class="active" lang="En">เพิ่มลูกหนี้</li>
        </ul>
@stop
@section('content')
{{ Form::open(array('url' => 'post-debtor')) }}
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
							{{ Form::text('date_debtor', Input::old('date_debtor'),
                                            array("id"=>"date_debtor",'required'=>'','class'=>'date-picker form-control','placeholder'=>'วันที่ลงข้อมูล')) }}
						@else
							{{ Form::text('date_debtor', $model->date_debtor,
                                            array("id"=>"date_debtor",'required'=>'','class'=>'date-picker form-control','placeholder'=>'วันที่ลงข้อมูล')) }}
						@endif
						</div>
					</div>
			</div>
			<!-- ################################################################################ -->
			<div class="row-fluid" >
					<div class="span6">
						<label class="span4">  ชื่อลูกหนี้  :</label>
						<div class="span8">		
						@if($model == null)			
							{{ Form::select('debtor_id', array(''=> 'กรุณาเลือก') + $list_user  , null, array('required'=>'',"class"=>"form-control")) }}
						@else
							{{ Form::select('debtor_id', array(''=> 'กรุณาเลือก') + $list_user  , $model->debtor_id , array('required'=>'',"class"=>"form-control")) }}
						@endif			
						</div>
					</div>
			</div>
			<!-- ################################################################################ -->
			<div class="row-fluid" >
					<div class="span6">
						<label class="span4">  วันที่จ่ายเงินค้างชำระ  :</label>
						<div class="span8">		
						@if($model == null)			
							{{ Form::text('date_pay', Input::old('date_pay'),
                                            array("id"=>"date_pay",'required'=>'','class'=>'date-picker form-control','placeholder'=>' วันที่จ่ายเงินค้างชำระ')) }}
						@else
							{{ Form::text('date_pay', $model->date_pay,
                                            array("id"=>"date_pay",'required'=>'','class'=>'date-picker form-control','placeholder'=>' วันที่จ่ายเงินค้างชำระ')) }}
						@endif
						</div>
					</div>
			</div>
    	<!-- ################################################################################ -->
			<div class="row-fluid" >
				<div class="span6">
					<label class="span4">  จำนวนเงินที่ค้างชำระ :</label>
					<div class="span8">
						@if($model == null)			
							{{ Form::text('payable', Input::old('payable'),
                                            array("id"=>"payable",'required'=>'','class'=>'form-control','placeholder'=>'กรอกจำนวนเงินที่ค้างชำระ')) }}
						@else
							{{ Form::text('payable', $model->payable,
                                            array("id"=>"payable",'required'=>'','class'=>'form-control','placeholder'=>'กรอกจำนวนเงินที่ค้างชำระ')) }}
						@endif						
					</div>
				</div>
			</div>
			 	<!-- ################################################################################ -->
			<div class="row-fluid" >
				<div class="span6">
					<label class="span4">   จำนวนเงินที่จ่าย :</label>
					<div class="span8">
						@if($model == null)			
							{{ Form::text('pay', Input::old('pay'),
                                            array("id"=>"pay",'required'=>'','class'=>'form-control','placeholder'=>'กรอกจำนวนเงินที่จ่าย')) }}
						@else
							{{ Form::text('pay', $model->pay,
                                            array("id"=>"pay",'required'=>'','class'=>'form-control','placeholder'=>'กรอกจำนวนเงินที่จ่าย')) }}
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
				<label class="span4">  เจ้าหน้ารับเงิน :</label>
				<div class="span8">
					@if($model == null)			
						{{ Form::select('create_by', array(''=> 'กรุณาเลือก') + $list_user_operate  , null, array('required'=>'',"class"=>"form-control")) }}			
					@else
						{{ Form::select('create_by', array(''=> 'กรุณาเลือก') + $list_user_operate  , $model->create_by , array('required'=>'',"class"=>"form-control")) }}			
					@endif	
				</div>
			</div>
		</div>

		<div class="text-center">
		 	{{ Form::submit('บันทึก',array('class'=>'btn btn-success')) }}
{{ Form::Close() }}
				<a href="{{ url('/debtor') }}">
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