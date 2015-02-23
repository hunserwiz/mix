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
<!-- 			<div class="row-fluid" >
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
			</div> -->
    	<!-- ################################################################################ -->
<!-- 			<div class="row-fluid" >
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
			</div> -->
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
			<hr>

			<div class="text-center">
				<div class="row-fluid" >
					<div class="span12">
					สินค้า :
						{{ Form::select('product_id', array(''=> 'กรุณาเลือก') + $list_product  , null, array('id'=>'product_id','required'=>'',"class"=>"form-control")) }}
					ราคา :     
						{{ Form::text('price', Input::old('price'),
			                                            array("id"=>"price",'required'=>'','class'=>'form-control','placeholder'=>'กรอกราคาต่อหน่วย')) }}
			        จำนวน :                               
			           	{{ Form::text('amount', Input::old('amount'),
			                                            array("id"=>"amount",'required'=>'','class'=>'form-control','placeholder'=>'กรอกจำนวนสินค้า')) }}
						
					<input type="button" id='add' class="btn btn" value="เพิ่มรายการสินค้า">	
		            
		            </div>                  
				</div>
			</div>

			<div id='tbl_product'>
					@include('productReturn._tbl_item')
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
	var product_id = '';
	var product_name = '';
	var price = $("#price").val();
	var amount = $("#amount").val();
	var key = 0;
	var mode = "{{ $mode }}";

	if(mode == 'add')
	$("#tbl_product").hide();
	
	$("#add").prop('disabled',true);
	$("#product_id").change(function(){
		product_id = this.value;
		$("#add").prop('disabled',true);
		$("#price").val(null);
		$("#amount").val(null);
	});
	
	$("#price").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
	    amount = $("#amount").val();
	    price = $("#price").val();
	    if(product_id != ""){
	    		$("#add").prop('disabled',false);
	    	}else{
	    		$("#add").prop('disabled',true);	    		
	    	}
    });

    $("#amount").keypress(function (e) {

     //if the letter is not digit then display error and don't type anything
	    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
	        return false; 
	    }else{
	    	if(product_id != ""){
	    		$("#add").prop('disabled',false);
	    	}else{
	    		$("#add").prop('disabled',true);	    		
	    	}
	    }
	    
    });

		$("#add").click(function(){
			price = $("#price").val();
			amount = $("#amount").val();
			console.log(price +" : "+ amount);

			if(amount != "" && price != ""){
				$("#tbl_product").show();
					$.ajax({
	                    url: "{{ url('post-product-name') }}",
	                    type: "post",
	                    data: {product_id:product_id},
	                    success:function(r){                       
	                        if(r.status == 'success'){
	                        	var tr = $("tr#empty").html();
	                        	if(tr != undefined){  // empty
									$('tr#empty td').remove("");
								}

	                        	key = key + 1;
	                            product_name = r.name;
	                            var tr = "<tr id='"+key+"'>"+
									"<td style='text-align:left'>"+ product_name +"</td>"+
									"<td style='text-align:right'>"+ price +"</td>"+
									"<td style='text-align:right'>"+ amount +"</td>"+
									"<td style='text-align:center'>"+
									"<input type='button' id='add-del_"+key+"' data-key='"+key+"' class='btn btn-danger' value='ลบ'>"+
									"</td>"+
									"<input type='hidden' name='product["+product_id+"][product_id]' value='"+product_id+"'>"+
									"<input type='hidden' name='product["+product_id+"][price]' value='"+price+"'>"+
									"<input type='hidden' name='product["+product_id+"][amount]' value='"+amount+"'>"+
									"</tr>";
									
								$('div#tbl_product tbody tr:last').after(tr);	
								
								$("[id^='add-del_']").click(function(){
									var str = this.id.split("_");
									console.log(str[1]);
									var result = confirm("คุณต้องการลบข้อมูลหรือไม่?");
									if (result==true) 
										$('div#tbl_product tbody tr#'+str[1]).remove();
									});
	                        }
	                    }
	                }); 
				}

		});
	// ============= Delete Item============== //
        $("[id^='del']").click(function(){
        var result = confirm("คุณต้องการลบข้อมูลหรือไม่?");
            if (result==true) {
                var id = $("#"+this.id).attr("data-product-item-id");                
                // ============= Ajax Delete ==============
                $.ajax({
                    url: "{{ url('delete-product-return-item') }}",
                    type: "post",
                    data: {id:id},
                    success:function(r){                       
                        if(r.status == 'success'){
                        	var mode = "{{ $mode }}";
                			var product_return_id = "{{ $model->id }}";
                            $.ajax({
                                    url:"{{ url('product-return-item') }}",
                                    type: "post",
                                    date:{mode:mode,product_return_id:product_return_id},
                                    success:function(r){
                                        $("div#tbl_product").html(r);
                                    }
                            });
                        }
                    }
                });     
                // =========== Close Ajax Delete ==========
            }
        });
	// ============= Close Delete Item ============== //
	
	// ---------------------------------------------------------------- //
	$(".date-picker").datepicker({
		format: 'dd-mm-yyyy',
	});


});
</script>

@stop