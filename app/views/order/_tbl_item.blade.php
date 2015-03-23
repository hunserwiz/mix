<table id="dtable_siteShow" class="table table-striped table-bordered table-condensed dtabler trcolor">
							<thead>
								<tr>
									<th style="text-align:center">ชื่อสินค้า</th>
									<th style="text-align:center">ราคาต่อหน่วย</th>
									<th style="text-align:center">stock</th>	
									<th style="text-align:center">จำนวน</th>																
								</tr>
							</thead>	
							<tbody>	
								@if($model_product->count() > 0)
									@foreach($model_product as $item)
									<tr>
										<td style="text-align:left">{{ $item->name }}</td>
										<td style="text-align:right">
											@if($type_member == null || $type_member == 1) 
												{{ $item->price }}
											@else
												{{ $item->price_member }}
											@endif
										</td>
										<td style="text-align:right">{{ $item->product_balance }}</td>
										<td style="text-align:center">
											@if($mode == 'edit')
											{{ Form::text("product[$item->id][amount]", $arr_data[$item->id],
                                            		array("id"=>"product_$item->id",'required'=>'',
                                            		'class'=>'form-control','placeholder'=>'กรอกจำนวน')) }}	
                                            @else
                                            {{ Form::text("product[$item->id][amount]", null ,
                                            		array("id"=>"product_$item->id",'required'=>'',
                                            		'class'=>'form-control','placeholder'=>'กรอกจำนวน')) }}	
                                            @endif						
											<!-- <input type='button' id='del_{{ $item->id }}' data-order-item-id='{{ $item->id }}' class='btn btn-danger' value='ลบ'> -->
										</td>							
									</tr>
									@endforeach
								@else
									<tr id='empty'>
										<td style="text-align:center" colspan="4">ไม่พบข้อมูล</td>						
									</tr>
								@endif							
							</tbody>
					</table>
<script type="text/javascript">
$(document).ready(function(){
// ============= Delete Item============== //
	var mode = "{{ $mode }}";
	console.log(mode);
	if(mode == 'edit'){
		var order_id = "{{ $model->order_id }}";
	}

	if(mode == 'edit'){
        $("[id^='del']").click(function(){
        var result = confirm("คุณต้องการลบข้อมูลหรือไม่?");
            if (result==true) {
                var id = $("#"+this.id).attr("data-order-item-id");                
                // ============= Ajax Delete ==============
                $.ajax({
                    url: "{{ url('delete-product-order-item') }}",
                    type: "post",
                    data: {id:id},
                    success:function(r){                       
                        if(r.status == 'success'){
                            $.ajax({
                                    url:"{{ url('product-order-item') }}",
                                    type: "post",
                                    data :{order_id:order_id,mode:mode},
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
	}
	// ============= Close Delete Item ============== //.
});
</script>