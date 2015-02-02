@extends('layouts.main')

@section('content')
{{ Form::open(array('url' => 'post-order')) }}
@if($model != null)
	{{ Form::hidden('order_id',$model->order_id) }}
@endif	

{{ $errors->first() }}
<div>
	<form name="form-sep">
		<!-- ################################################################################ -->
			<div class="row-fluid" >
					<div class="span6">
						<label class="span4">วันที่ออกใบสินค้า  :</label>
						<div class="span8">					
							@if($model == null)
							{{ Form::text('order_date', Input::old('order_date'),
                                            array("id"=>"order_date",'required'=>'','class'=>'date-picker form-control','placeholder'=>'กรอกวันที่ออกใบสินค้า')) }}
							@else
							{{ Form::text('order_date', $model->order_date,
                                            array("id"=>"order_date",'required'=>'','class'=>'date-picker form-control','placeholder'=>'กรอกวันที่ออกใบสินค้า')) }}
							@endif						
						</div>
					</div>
					<div class="span6">
						<label class="span4">เรื่อง  :</label>
						<div class="span8">	
							@if($model == null)
							{{ Form::text('order_title', Input::old('order_title'),
                                            array("id"=>"order_title",'required'=>'','class'=>'form-control','placeholder'=>'กรอก หัวเรื่อง')) }}
							@else
							{{ Form::text('order_title', $model->order_title,
                                            array("id"=>"order_title",'required'=>'','class'=>'form-control','placeholder'=>'กรอก หัวเรื่อง')) }}
							@endif				
						</div>
					</div>
			</div>
			<!-- ################################################################################ -->
			<div class="row-fluid" >
					<div class="span6">
						<label class="span4">ประเภทสินค้า  :</label>
						<div class="span8">	
							@if($model == null)
								{{ Form::select('category', array(''=> 'กรุณาเลือก') + $list_categorise  , null, array('required'=>'',"class"=>"form-control")) }}
							@else
								{{ Form::select('category', array(''=> 'กรุณาเลือก') + $list_categorise  , $model->category_id , array('required'=>'',"class"=>"form-control")) }}
							@endif	
								
						</div>
					</div>
					<div class="span6">
						<label class="span4">ชื่อสินค้า :</label>
						<div class="span8">
							@if($model == null)
								{{ Form::select('product_id', array(''=> 'กรุณาเลือก') + $list_product  , null, array('required'=>'',"class"=>"form-control")) }}
							@else
								{{ Form::select('product_id', array(''=> 'กรุณาเลือก') + $list_product  , $model->product_id, array('required'=>'',"class"=>"form-control")) }}
							@endif								
						</div>
					</div>

			</div>
    <!-- ################################################################################ -->

			<div class="row-fluid" >
		
				<div class="span6">
					<label class="span4">ราคาต่อหน่วย :</label>
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
				<label class="span4"> จำนวนสินค้า :</label>
				<div class="span8">
					@if($model == null)
						{{ Form::text('amount',Input::old('amount'), 
                                            array("id"=>"amount",'required'=>'','class'=>'form-control','placeholder'=>'กรอกจำนวนสินค้า')) }}
					@else
						{{ Form::text('amount', $model->amount_total,
                                            array("id"=>"amount",'required'=>'','class'=>'form-control','placeholder'=>'กรอกจำนวนสินค้า')) }}
					@endif	
				</div>
			</div>

			</div>
       <!-- ################################################################################ -->
		<div class="row-fluid" >
			<div class="span6">
				<label class="span4">ชื่อ-นามสกุลตัวแทนจำหน่าย   :</label>
				<div class="span8">		
					@if($model == null)
						{{ Form::select('agent_id', array(''=> 'กรุณาเลือก') + $list_agent  , null , array('required'=>'',"class"=>"form-control")) }}
					@else
						{{ Form::select('agent_id', array(''=> 'กรุณาเลือก') + $list_agent  , $model->agent_id, array('required'=>'',"class"=>"form-control")) }}
					@endif	
				</div>
			</div>
			<div class="span6">
				<label class="span4">เขตการขาย :</label>
					<div class="span8">		
					@if($model == null)
						{{ Form::select('location_id', array(''=> 'กรุณาเลือก') + $list_location  , null , array('required'=>'',"class"=>"form-control")) }}			
					@else
						{{ Form::select('location_id', array(''=> 'กรุณาเลือก') + $list_location  , $model->location_id , array('required'=>'',"class"=>"form-control")) }}			
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
						{{ Form::select('operate_by', array(''=> 'กรุณาเลือก') + $list_user  , null , array('required'=>'',"class"=>"form-control")) }}			
					@else
						{{ Form::select('operate_by', array(''=> 'กรุณาเลือก') + $list_user  ,  $model->receive_by, array('required'=>'',"class"=>"form-control")) }}					
					@endif
				</div>
			</div>
    
			<div class="span6">
				<label class="span4">เลขที่ใบเสร็จ :</label>
				<div class="span8">
					@if($model == null)
						{{ Form::text('order_no', Input::old('order_no'),
                                            array("id"=>"order_no",'required'=>'','class'=>'form-control','placeholder'=>'กรอกเลขที่ใบเสร็จ')) }}			
					@else
						{{ Form::text('order_no', $model->order_no,
                                            array("id"=>"order_no",'required'=>'','class'=>'form-control','placeholder'=>'กรอกเลขที่ใบเสร็จ')) }}					
					@endif				
				</div>
			</div>
		<div>

		<div class="text-right" style="padding-right:19%">
		 	{{ Form::submit('บันทึก',array('class'=>'btn btn-success')) }}
{{ Form::Close() }}
				<a href="{{ url('/') }}">
					<input type="button" class="btn btn-danger" value="Cancel">
				</a>
		</div>
     </form> 
</div>
<script type="text/javascript">
$(document).ready(function(){
$(".date-picker").datepicker({
	format: 'dd-mm-yyyy',
});

$(".date-picker").on("change", function () {
    var id = $(this).attr("id");
    var val = $("label[for='" + id + "']").text();
    $("#msg").text(val + " changed");
});
});

</script>

@stop