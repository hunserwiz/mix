@extends('layouts.main')

@section('navigate')
        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}"><i class="icon-home"></i></a> <span class="divider">/</span></li>
          <li><a href="{{ url('/deposit') }}">รายการฝากสินค้า</a> <span class="divider">/</span></li>
          <li class="active" lang="En">เพิ่มฝากสินค้า</li>
        </ul>
@stop
@section('content')
<div>
{{ Form::open(array('url' => 'post-deposit')) }}
@if($model != null)
{{ Form::hidden('id',$model->id) }}
@endif		

{{ $errors->first() }}
<div>
	<form name="form-sep">
		<!-- ################################################################################ -->
			<div class="row-fluid" >
					<div class="span6">
						<label class="span4">  วันที่ฝากสินค้า  :</label>
						<div class="span8">		
						@if($model == null)			
							{{ Form::text('date_deposit', Input::old('date_deposit'),
                                            array("id"=>"date_deposit",'required'=>'','class'=>'date-picker form-control','placeholder'=>'กรอกวันที่ฝากสินค้า')) }}
						@else
							{{ Form::text('date_deposit', $model->date_deposit,
                                            array("id"=>"date_deposit",'required'=>'','class'=>'date-picker form-control','placeholder'=>'กรอกวันที่ฝากสินค้า')) }}
						@endif
						</div>
					</div>
					<div class="span6">
						<label class="span4">  ประเภทการฝาก  :</label>
						<div class="span8">		
						@if($model == null)	.
							{{ Form::radio('type_deposit_id', '1', false, array('id'=>'type_deposit_id','required'=>'')) ."ฝากกลับบ้าน" }}
							{{ Form::radio('type_deposit_id', '2', false, array('id'=>'type_deposit_id','required'=>'')) ."ฝากในตู้" }}			
						@else
							{{ Form::radio('type_deposit_id', '1', $model->type_deposit_id, array('id'=>'type_deposit_id','required'=>'')) ."ฝากกลับบ้าน" }}
							{{ Form::radio('type_deposit_id', '2', $model->type_deposit_id, array('id'=>'type_deposit_id','required'=>'')) ."ฝากในตู้" }}	
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
					<label class="span4">  ราคา :</label>
					<div class="span8">
						@if($model == null)			
							{{ Form::text('price', Input::old('price'),
                                            array("id"=>"price",'required'=>'','class'=>'form-control','placeholder'=>'กรอกราคา')) }}
						@else
							{{ Form::text('price', $model->price,
                                            array("id"=>"price",'required'=>'','class'=>'form-control','placeholder'=>'กรอกราคา')) }}
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
				<label class="span4">   ผู้นำฝาก :</label>
				<div class="span8">
					@if($model == null)			
						{{ Form::select('deposit_by', array(''=> 'กรุณาเลือก') + $list_agent  , null, array('required'=>'',"class"=>"form-control")) }}			
					@else
						{{ Form::select('deposit_by', array(''=> 'กรุณาเลือก') + $list_agent  , $model->deposit_by , array('required'=>'',"class"=>"form-control")) }}			
					@endif	
				</div>
			</div>
			<div class="span6">
				<label class="span4"> ผู้รับฝาก :</label>
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
					<label class="span4">  วันที่มารับของฝาก :</label>
					<div class="span8">
						@if($model == null)			
							{{ Form::text('date_return_depoist', Input::old('date_return_depoist'),
                                            array("id"=>"date_return_depoist",'required'=>'','class'=>'date-picker form-control','placeholder'=>'กรอกวันที่มารับของฝาก')) }}
						@else
							{{ Form::text('date_return_depoist', $model->date_return_depoist,
                                            array("id"=>"date_return_depoist",'required'=>'','class'=>'date-picker form-control','placeholder'=>'กรอกวันที่มารับของฝาก')) }}
						@endif	
					</div>
				</div>
			</div>


		 <div class="text-center">
		 	{{ Form::submit('บันทึก',array('class'=>'btn btn-success')) }}
{{ Form::Close() }}
				<a href="{{ url('/deposit') }}">
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