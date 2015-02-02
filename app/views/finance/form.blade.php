@extends('layouts.main')

@section('content')
{{ Form::open(array('url' => 'post-finance')) }}

{{ $errors->first() }}
<div>
	<form name="form-sep">
		<!-- ################################################################################ -->
			<div class="row-fluid" >
					<div class="span6">
						<label class="span4"> วันที่ลงข้อมูล  :</label>
						<div class="span8">					
							{{ Form::text('date_account', Input::old('date_account'),
                                            array("id"=>"date_account",'required'=>'','class'=>'date-picker form-control','placeholder'=>'กรอกวันที่ออกใบสินค้า')) }}
						</div>
					</div>
			</div>
			<!-- ################################################################################ -->
			<div class="row-fluid" >
					<div class="span6">
						<label class="span4"> ประเภท  :</label>
						<div class="span8">					
							{{ Form::select('type', array(''=> 'กรุณาเลือก') + $list_type  , null, array('required'=>'',"class"=>"form-control")) }}
						</div>
					</div>
			</div>
    	<!-- ################################################################################ -->
			<div class="row-fluid" >
				<div class="span6">
					<label class="span4"> จำนวนเงิน :</label>
					<div class="span8">
						{{ Form::text('price', Input::old('price'),
                                            array("id"=>"price",'required'=>'','class'=>'form-control','placeholder'=>'กรอกราคาต่อหน่วย')) }}
					</div>
				</div>
			</div>
 		<!-- ################################################################################ -->
			<div class="row-fluid" >
				<div class="span6">
					<label class="span4"> รายละเอียด :</label>
					<div class="span8">
						{{ Form::textArea('detail', Input::old('detail'),
                                            array("id"=>"detail",'required'=>'','class'=>'form-control','placeholder'=>'กรอกรายละเอียด')) }}
					</div>
				</div>
			</div>
		<!-- ################################################################################ -->
		<div class="row-fluid" >
			<div class="span6">
				<label class="span4"> เจ้าหน้าที่ออกใบเสร็จ :</label>
				<div class="span8">
						{{ Form::select('create_by', array(''=> 'กรุณาเลือก') + $list_user  , null, array('required'=>'',"class"=>"form-control")) }}			
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
	format: 'dd/mm/yyyy',
});

$(".date-picker").on("change", function () {
    var id = $(this).attr("id");
    var val = $("label[for='" + id + "']").text();
    $("#msg").text(val + " changed");
});
});

</script>

@stop