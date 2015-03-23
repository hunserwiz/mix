@extends('layouts.main')
@section('navigate')
        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}"><i class="icon-home"></i></a> <span class="divider">/</span></li>
          <li class="active" lang="En"><a href="{{ url('/order') }}">รายการใบวางบิล</a><span class="divider">/</span></li>
          <li class="active" lang="En">เพิ่มใบวางบิล</li>
        </ul>
@stop
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
                                            array("id"=>"order_title",'required'=>'','class'=>'form-control','placeholder'=>'กรอกรื่อง')) }}
							@else
							{{ Form::text('order_title', $model->order_title,
                                            array("id"=>"order_title",'required'=>'','class'=>'form-control','placeholder'=>'กรอกเรื่อง')) }}
							@endif				
						</div>
					</div>
			</div>
			<!-- ################################################################################ -->
			<!--
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

			--->
    <!-- ################################################################################ -->
    		<!--
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
			--->
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
				<label class="span4">สถานะพนักงาน :</label>
					<div class="span8">		
					@if($model == null)
						{{ Form::select('type', array(''=> 'กรุณาเลือก','1'=>'พนักงานทั่วไป','2'=>'โครงการ 500')   , null , array('required'=>'',"class"=>"form-control")) }}			
					@else
						{{ Form::select('type', array(''=> 'กรุณาเลือก','1'=>'พนักงานทั่วไป','2'=>'โครงการ 500')  , $model->type , array('required'=>'',"class"=>"form-control")) }}			
					@endif				
					</div>
			</div>
			<div class="span6">
				<label class="span4"> ประเภทสมาชิก :</label>
				<div class="span8">
					@if($model == null)
						{{ Form::select('type_member', array(''=> 'กรุณาเลือก','1'=>'สมาชิก','2'=>'ร้านค้า')   , null , array('required'=>'',"class"=>"form-control")) }}			
					@else
						{{ Form::select('type_member', array(''=> 'กรุณาเลือก','1'=>'สมาชิก','2'=>'ร้านค้า')   ,  $model->receive_by, array('required'=>'',"class"=>"form-control")) }}					
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
						{{ Form::hidden('order_no',$model->order_no) }}
						{{ Form::text('order_no', $model->order_no,
                                        array("id"=>"order_no",'disabled'=> true,'required'=>'',
                                        'class'=>'form-control','placeholder'=>'กรอกเลขที่ใบเสร็จ')) }}								
				</div>
			</div>
		<div>

			<hr>
<!--
		<div class="text-center">
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
		</div>
	-->


		<div id='tbl_product'>
			@include('order._tbl_item')
		</div>

		<div class="text-center">
			{{ Form::submit('บันทึก',array('class'=>'btn btn-success')) }}
			{{ Form::Close() }}
				<a href="{{ url('/') }}">
					<input type="button" class="btn btn-danger" value="ยกเลิก">
				</a>
		</div>
     </form> 
</div>
<script type="text/javascript">
$(document).ready(function(){
	// var product_id = '';
	// var product_name = '';
	// var price = $("#price").val();
	// var amount = $("#amount").val();
	// var key = 0;
	// var mode = "{{ $mode }}";

	// if(mode == 'add')
	// $("#tbl_product").hide();

	// if(mode == 'edit')
	// var order_id = "{{ $model->order_id }}";

	// $("#add").prop('disabled',true);
	// $("#product_id").change(function(){
	// 	product_id = this.value;
	// 	$("#add").prop('disabled',true);
	// 	$("#price").val(null);
	// 	$("#amount").val(null);
	// });
	
	// $("#price").keypress(function (e) {
 //     //if the letter is not digit then display error and don't type anything
	//     amount = $("#amount").val();
	//     price = $("#price").val();
	//     if(product_id != ""){
	//     		$("#add").prop('disabled',false);
	//     	}else{
	//     		$("#add").prop('disabled',true);	    		
	//     	}
 //    });

    // $("#amount").keypress(function (e) {

    //  //if the letter is not digit then display error and don't type anything
	   //  if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
	   //      return false; 
	   //  }else{
	   //  	if(product_id != ""){
	   //  		$("#add").prop('disabled',false);
	   //  	}else{
	   //  		$("#add").prop('disabled',true);	    		
	   //  	}
	   //  }
	    
    // });

		// $("#add").click(function(){
		// 	price = $("#price").val();
		// 	amount = $("#amount").val();
		// 	console.log(price +" : "+ amount);
		// 	if(amount != "" && price != ""){
		// 		if(mode == 'add'){					
		// 			$.ajax({
	 //                    url: "{{ url('post-product-name') }}",
	 //                    type: "post",
	 //                    data: {product_id:product_id},
	 //                    success:function(r){                       
	 //                        if(r.status == 'success'){
	 //                        	if(parseInt(r.stock) >= parseInt(amount)){
	 //                        		$("#tbl_product").show();
		//                         	key = key + 1;
		//                             product_name = r.name;
		//                             var tr = "<tr id='"+key+"'>"+
		// 								"<td style='text-align:left'>"+ product_name +"</td>"+
		// 								"<td style='text-align:right'>"+ price +"</td>"+
		// 								"<td style='text-align:right'>"+ amount +"</td>"+
		// 								"<td style='text-align:center'>"+
		// 								"<input type='button' id='add-del_"+key+"' data-key='"+key+"' class='btn btn-danger' value='ลบ'>"+
		// 								"</td>"+
		// 								"<input type='hidden' name='product["+product_id+"][product_id]' value='"+product_id+"'>"+
		// 								"<input type='hidden' name='product["+product_id+"][price]' value='"+price+"'>"+
		// 								"<input type='hidden' name='product["+product_id+"][amount]' value='"+amount+"'>"+
		// 								"</tr>";
		// 							$('div#tbl_product tbody tr:last').after(tr);

		// 							$("[id^='add-del_']").click(function(){
		// 								var key_id = $("#"+this.id).attr("data-key"); 
		// 								$('div#tbl_product tbody tr#'+key_id).remove();
		// 								});
		// 						}else{
		// 							alert("Stock คงเหลือ " + r.stock);
		// 						}
	 //                        }
	 //                    }
	 //                }); 
		// 			}else{
		//             	$.ajax({
		//                     url: "{{ url('post-add-order-item') }}",
		//                     type: "post",
		//                     data: {order_id:order_id,product_id:product_id,price:price,amount:amount},
		//                     success:function(r){                       
		//                         if(r.status == 'success'){
		//                         	$.ajax({
	 //                                    url:"{{ url('product-order-item') }}",
	 //                                    type: "post",
	 //                                    data: {mode:mode,order_id:order_id},
	 //                                    success:function(r){
	 //                                        $("div#tbl_product").html(r);
	 //                                    }
	 //                           		});
		//                         }else{
		//                         	alert("Stock คงเหลือ " + r.stock);
		//                         }
		//                     }
		//                 });
		//             }
		// 		}

		// });

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