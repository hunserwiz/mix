@extends('layouts.main')

@section('content')
{{ Form::open(array('url' => 'post-product')) }}
	<form name="form-sep">
		<!-- ################################################################################ -->
			<div class="row-fluid" >
					<div class="span6">
						<label class="span4">วันที่ออกใบสินค้า  :</label>
						<div class="span8">					
							{{ Form::text('date_order', Input::old('date_order'),
                                            array("id"=>"date_order",'required'=>'','class'=>'datepicker','placeholder'=>'กรอกวันที่ออกใบสินค้า')) }}
						</div>
					</div>
			</div>
			<!-- ################################################################################ -->
			<div class="row-fluid" >
					<div class="span6">
						<label class="span4">ประเภทสินค้า  :</label>
						<div class="span8">					
							{{ Form::select('building', array(''=> 'กรุณาเลือก') + $list_categorise  , null, array('required'=>'',"class"=>"form-control")) }}
						</div>
					</div>
					<div class="span6">
						<label class="span4">ชื่อสินค้า :</label>
						<div class="span8">
							{{ Form::text('name', Input::old('name'),
                                            array("id"=>"name",'required'=>'','class'=>'form-control','placeholder'=>'กรอกชื่อสินค้า')) }}
						</div>
					</div>

			</div>
    <!-- ################################################################################ -->

			<div class="row-fluid" >
		
				<div class="span6">
					<label class="span4">ราคาต่อหน่วย :</label>
					<div class="span8">
						{{ Form::text('price', Input::old('price'),
                                            array("id"=>"price",'required'=>'','class'=>'form-control','placeholder'=>'กรอกราคาต่อหน่วย')) }}
					</div>
				</div>
              <div class="span6">
				<label class="span4"> จำนวนสินค้า :</label>
				<div class="span8">
					{{ Form::text('amount', Input::old('amount'),
                                            array("id"=>"amount",'required'=>'','class'=>'form-control','placeholder'=>'กรอกจำนวนสินค้า')) }}
				</div>
			</div>

			</div>
       <!-- ################################################################################ -->
		<div class="row-fluid" >
			<div class="span6">
				<label class="span4">ชื่อ-นามสกุลตัวแทนจำหน่าย   :</label>
				<div class="span8">			
					{{ Form::select('agent_id', array(''=> 'กรุณาเลือก') + $list_agent  , null, array('required'=>'',"class"=>"form-control")) }}
				</div>
			</div>
			<div class="span6">
				<label class="span4">เขตการขาย :</label>
					<div class="span8">					
						{{ Form::select('location_id', array(''=> 'กรุณาเลือก') + $list_location  , null, array('required'=>'',"class"=>"form-control")) }}			
					</div>
			</div>
			
		</div>

		<!-- ################################################################################ -->
		<div class="row-fluid" >
			<div class="span6">
				<label class="span4"> เจ้าหน้าที่ออกใบเสร็จ :</label>
				<div class="span8">
						{{ Form::select('operate_by', array(''=> 'กรุณาเลือก') + $list_user  , null, array('required'=>'',"class"=>"form-control")) }}			
				</div>
			</div>
    
			<div class="span6">
				<label class="span4">เลขที่ใบเสร็จ :</label>
				<div class="span8">
					{{ Form::text('order_no', Input::old('order_no'),
                                            array("id"=>"order_no",'required'=>'','class'=>'form-control','placeholder'=>'กรอกเลขที่ใบเสร็จ')) }}			

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


<script type="text/javascript">
$(document).ready(function(){
	$('.datepicker').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-3d'
})
});

</script>

@stop