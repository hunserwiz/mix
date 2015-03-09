<table id="dtable_siteShow" class="table table-striped table-bordered table-condensed dtabler trcolor">
							<thead>
								<tr>
									<th style="text-align:center">ชื่อสินค้า</th>
									<th style="text-align:center">ราคาต่อหน่วย</th>
									<th style="text-align:center">จำนวน</th>	
									<th style="text-align:center">จัดการ</th>																
								</tr>
							</thead>	
							<tbody>	
							@if($mode == 'edit')
								@if($model_deposit_item->count() > 0)
									@foreach($model_deposit_item as $item)
									<tr>
										<td style="text-align:left">{{ $item->product->name }}</td>
										<td style="text-align:right">{{ $item->price }}</td>
										<td style="text-align:right">{{ $item->amount }}</td>
										<td style="text-align:center">
											<input type='button' id='del_{{ $item->id }}' data-deposit-item-id='{{ $item->id }}' class='btn btn-danger' value='ลบ'>
										</td>							
									</tr>
									@endforeach
								@else
									<tr id='empty'>
										<td style="text-align:center" colspan="4">ไม่พบข้อมูล</td>						
									</tr>
								@endif
							@else	
								<tr></tr>
							@endif							
							</tbody>
</table>

<script type="text/javascript">
$(document).ready(function(){
// ============= Delete Item============== //
	var mode = "{{ $mode }}";
	console.log(mode);
	if(mode == 'edit'){
		var deposit_id = "{{ $model->id }}";
	}

	if(mode == 'edit'){
        $("[id^='del']").click(function(){
        var result = confirm("คุณต้องการลบข้อมูลหรือไม่?");
            if (result==true) {
                var id = $("#"+this.id).attr("data-deposit-item-id");                
                // ============= Ajax Delete ==============
                $.ajax({
                    url: "{{ url('delete-deposit-item') }}",
                    type: "post",
                    data: {id:id},
                    success:function(r){                       
                        if(r.status == 'success'){
                            $.ajax({
                                    url:"{{ url('deposit-item') }}",
                                    type: "post",
                                    data :{deposit_id:deposit_id,mode:mode},
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