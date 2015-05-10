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
					<!-- <div class="span6"> -->
			<!-- 			<label class="span4">  ประเภทการฝาก  :</label>
						<div class="span8">		
						@if($model == null)	.
							{{ Form::radio('type_deposit_id', '1', false, array('id'=>'type_deposit_id','required'=>'')) ."ฝากกลับบ้าน" }}
							{{ Form::radio('type_deposit_id', '2', false, array('id'=>'type_deposit_id','required'=>'')) ."ฝากในตู้" }}			
						@else
							{{ Form::radio('type_deposit_id', '1', $model->type_deposit_id == 1 ? true : false, array('id'=>'type_deposit_id','required'=>'')) ."ฝากกลับบ้าน" }}
							{{ Form::radio('type_deposit_id', '2', $model->type_deposit_id == 2 ? true : false, array('id'=>'type_deposit_id','required'=>'')) ."ฝากในตู้" }}	
						@endif
						</div>
					</div> -->
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
							{{ Form::text('date_deposit_return', Input::old('date_deposit_return'),
                                            array("id"=>"date_deposit_return",'required'=>'','class'=>'date-picker form-control','placeholder'=>'กรอกวันที่มารับของฝาก')) }}
						@else
							{{ Form::text('date_deposit_return', $model->date_deposit_return,
                                            array("id"=>"date_deposit_return",'required'=>'','class'=>'date-picker form-control','placeholder'=>'กรอกวันที่มารับของฝาก')) }}
						@endif	
					</div>
				</div>
			</div>
			<hr>

		<!-- 	<div class="text-center">
				<div class="row-fluid" >
					<div class="span12">
					สินค้า :
						{{ Form::select('product_id', array(''=> 'กรุณาเลือก') + $list_product  , null, array('id'=>'product_id',"class"=>"form-control")) }}
					ราคา :     
						{{ Form::text('price', Input::old('price'),
			                                            array("id"=>"price",'class'=>'form-control','placeholder'=>'กรอกราคาต่อหน่วย')) }}
			        จำนวน :                               
			           	{{ Form::text('amount', Input::old('amount'),
			                                            array("id"=>"amount",'class'=>'form-control','placeholder'=>'กรอกจำนวนสินค้า')) }}
						
					<input type="button" id='add' class="btn btn" value="เพิ่มรายการสินค้า">			          
		            </div>                  
				</div>
			</div> -->

			<div id='tbl_product'>
				@include('deposit._tbl_item')
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
	var product_id = '';
	var product_name = '';
	var price = $("#price").val();
	var amount = $("#amount").val();
	var key = 0;
	var mode = "{{ $mode }}";

	if(mode == 'add')
	// $("#tbl_product").hide();

	if(mode == 'edit')
	var deposit_id = "{{ $model->id }}";

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
				if(mode == 'add'){
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
								// del form add //
									$("[id^='add-del_']").click(function(){
										var key_id = $("#"+this.id).attr("data-key"); 
											$('div#tbl_product tbody tr#'+key_id).remove();										
									});
								// close del form add //
	                        }
	                    }
	                });
	            }else{
	            	$.ajax({
	                    url: "{{ url('post-add-deposit-item') }}",
	                    type: "post",
	                    data: {deposit_id:deposit_id,product_id:product_id,price:price,amount:amount},
	                    success:function(r){                       
	                        if(r.status == 'success'){
	                        	$.ajax({
                                    url:"{{ url('deposit-item') }}",
                                    type: "post",
                                    data: {mode:mode,deposit_id:deposit_id},
                                    success:function(r){
                                        $("div#tbl_product").html(r);
                                    }
                           		});
	                        }
	                    }
	                });
	            } 
			}

		});
	// ---------------------------------------------------------------- //
	$(".date-picker").datepicker({
		format: 'dd-mm-yyyy',
	});
});
</script>
@stop