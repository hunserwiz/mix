@extends('layouts.main')

@section('navigate')
        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}"><i class="icon-home"></i></a> <span class="divider">/</span></li>
          <li><a href="{{ url('/product-return') }}">รายการคืนสินค้า</a> <span class="divider">/</span></li>
          <li class="active" lang="En">เพิ่มคืนสินค้า</li>
        </ul>
@stop
@section('content')
<div>
{{ Form::open(array('url' => 'post-product-return')) }}
@if($model != null)
{{ Form::hidden('id',$model->id) }}
@endif		

{{ $errors->first() }}
<div>
	<form name="form-sep">
		<!-- ################################################################################ -->
			<div class="row-fluid" >
					<div class="span6">
						<label class="span4">  วันที่คืนสินค้า  :</label>
						<div class="span8">		
						@if($model == null)			
							{{ Form::text('date_return', Input::old('date_return'),
                                            array("id"=>"date_return",'required'=>'','class'=>'date-picker form-control','placeholder'=>'กรอกวันที่คืนสินค้า')) }}
						@else
							{{ Form::text('date_return', $model->date_return,
                                            array("id"=>"date_return",'required'=>'','class'=>'date-picker form-control','placeholder'=>'กรอกวันที่คืนสินค้า')) }}
						@endif
						</div>
					</div>
			</div>
			<!-- ################################################################################ -->
			<div class="row-fluid" >
					<div class="span6">
						<label class="span4"> ประเภทสินค้า  :</label>
						<div class="span8">		
						@if($model == null)			
							{{ Form::select('categorise_id', array(''=> 'กรุณาเลือก') + $list_category  , null, array('required'=>'',"class"=>"form-control",'id'=>"categorise_id")) }}
						@else
							{{ Form::select('categorise_id', array(''=> 'กรุณาเลือก') + $list_category  , $model->categorise_id , array('required'=>'',"class"=>"form-control",'id'=>"categorise_id")) }}
						@endif			
						</div>
					</div>
					<div class="span6">
						<label class="span4"> สินค้า  :</label>
						<div class="span8" id='product'>		
						@if($model == null)			
							{{ Form::select('product_id', array(''=> 'กรุณาเลือก') + $list_product  , null, array('required'=>'',"class"=>"form-control" ,'id'=>"product_id")) }}
						@else
							{{ Form::select('product_id', array(''=> 'กรุณาเลือก') + $list_product  , $model->product_id , array('required'=>'',"class"=>"form-control" ,'id'=>"product_id")) }}
						@endif			
						</div>
					</div>
			</div>
    	<!-- ################################################################################ -->
			<div class="row-fluid" >
				<div class="span6">
					<label class="span4">  ราคาต่อหน่วย :</label>
					<div class="span8">
						@if($model == null)			
							{{ Form::text('price', Input::old('price'),
                                            array("id"=>"price",'required'=>'','class'=>'form-control','placeholder'=>'กรอกราคาต่อหน่วย')) }}
						@else
							{{ Form::text('price', $model->price,
                                            array("id"=>"price",'required'=>'','class'=>'form-control','placeholder'=>'กรอกราคาต่อหน่วย')) }}
						@endif						
					</div>
				</div>
				<div class="span6">
					<label class="span4">   จำนวนสินค้า :</label>
					<div class="span8">
						@if($model == null)			
							{{ Form::text('amount', Input::old('amount'),
                                            array("id"=>"amount",'required'=>'','class'=>'form-control','placeholder'=>'กรอกจำนวนสินค้า')) }}
						@else
							{{ Form::text('amount', $model->amount,
                                            array("id"=>"amount",'required'=>'','class'=>'form-control','placeholder'=>'กรอกจำนวนสินค้า')) }}
						@endif						
					</div>
				</div>
			</div>
			<!-- ################################################################################ -->
		<div class="row-fluid" >
			<div class="span6">
				<label class="span4">   เจ้าหน้าที่คืนสินค้า :</label>
				<div class="span8">
					@if($model == null)			
						{{ Form::select('return_by', array(''=> 'กรุณาเลือก') + $list_agent  , null, array('required'=>'',"class"=>"form-control")) }}			
					@else
						{{ Form::select('return_by', array(''=> 'กรุณาเลือก') + $list_agent  , $model->return_by , array('required'=>'',"class"=>"form-control")) }}			
					@endif	
				</div>
			</div>
			<div class="span6">
				<label class="span4">  เขตการขาย :</label>
				<div class="span8">
					@if($model == null)			
						{{ Form::select('location_id', array(''=> 'กรุณาเลือก') + $list_location  , null, array('required'=>'',"class"=>"form-control")) }}			
					@else
						{{ Form::select('location_id', array(''=> 'กรุณาเลือก') + $list_location  , $model->location_id , array('required'=>'',"class"=>"form-control")) }}			
					@endif	
				</div>
			</div>
		</div>
			<!-- ################################################################################ -->
		<div class="row-fluid" >
			<div class="span6">
				<label class="span4"> เจ้าหน้าที่รับสินค้า :</label>
				<div class="span8">
					@if($model == null)			
						{{ Form::select('create_by', array(''=> 'กรุณาเลือก') + $list_user  , null, array('required'=>'',"class"=>"form-control")) }}			
					@else
						{{ Form::select('create_by', array(''=> 'กรุณาเลือก') + $list_user  , $model->create_by , array('required'=>'',"class"=>"form-control")) }}			
					@endif	
				</div>
			</div>
		</div>
 		<!-- ################################################################################ -->
			<div class="row-fluid" >
				<div class="span6">
					<label class="span4"> วันที่ผลิต :</label>
					<div class="span8">
						@if($model == null)			
							{{ Form::text('product_date', Input::old('product_date'),
                                            array("id"=>"product_date",'required'=>'','class'=>'date-picker form-control','placeholder'=>'กรอกวันที่ผลิต')) }}
						@else
							{{ Form::text('product_date', $model->product_date,
                                            array("id"=>"product_date",'required'=>'','class'=>'date-picker form-control','placeholder'=>'กรอกวันที่ผลิต')) }}
						@endif	
					</div>
				</div>
				<div class="span6">
				<label class="span4"> วันที่หมดอายุ :</label>
					<div class="span8">
						@if($model == null)			
							{{ Form::text('expired_date', Input::old('expired_date'),
	                                            array("id"=>"expired_date",'required'=>'','class'=>'date-picker form-control','placeholder'=>'กรอกวันที่หมดอายุ')) }}
						@else
							{{ Form::text('expired_date', $model->expired_date,
	                                            array("id"=>"expired_date",'required'=>'','class'=>'date-picker form-control','placeholder'=>'กรอกวันที่หมดอายุ')) }}
						@endif
					</div>
				</div>
			</div>


		 <div class="text-center">
		 	{{ Form::submit('บันทึก',array('class'=>'btn btn-success')) }}
{{ Form::Close() }}
				<a href="{{ url('/product-return') }}">
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
	var mode = "{{ $mode }}";

	if(mode == 'add')
		$("#product_id").prop('disabled',true);

	$("#categorise_id").change(function(){
		$.ajax({
				url:"{{ url('get-list-product') }}",
				type: "post",
				data:{ categorise_id: this.value},
				success:function(r){
					$("div#product").html(r);
				}
			});
	});
});
</script>

@stop