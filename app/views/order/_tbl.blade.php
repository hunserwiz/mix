<table id="dtable_siteShow" class="table table-striped table-bordered table-condensed dtabler trcolor">
							<thead>
								<tr>
									<th style="text-align:center">เรื่อง</th>
									<th style="text-align:center">เลขที่ใบเสร็จ</th>
									<th style="text-align:center">วันที่ออกบิล</th>									
									<th style="text-align:center">location</th>
									<th style="text-align:center">ผู้ขาย</th>
									<th style="text-align:center">ผู้ออกใบเสร็จ</th>	
									<th style="text-align:center">สถานะใบวางบิล</th>	
									<th style="text-align:center">จัดการ</th>									
								</tr>
							</thead>	
							<tbody>	
							@if($model->count() > 0)
							@foreach($model as $k => $data)
							<tr>
								<td style="text-align:left">{{ $data->order_title }}</td>
								<td style="text-align:left">{{ $data->order_no }}</td>
								<td style="text-align:left">{{ $data->order_date }}</td>
								<td style="text-align:left">{{ ThaiHelper::GetLocation($data->location_id) }}</td>
								<td style="text-align:left">{{ $data->user->name }}</td>
								<td style="text-align:left">{{ ThaiHelper::GetUser($data->payment_by) }}</td>
								<td style="text-align:center">{{ ThaiHelper::GetStatusOrder($data->status) }}</td>
								<td style="text-align:center">
									<span class="" >
										<a href="{{ url('order-report/'.$data->order_id) }}" target='_blank' title="report">
											<i class="icon-search"></i>
										</a>
									</span>
									<span class="" >
										<a href="#" id="view_{{ $data->order_id }}" data-order-id='{{ $data->order_id }}' title="view">
											<i class="icon-eye-open"></i>
										</a>
									</span>
									@if(ThaiHelper::CheckRight())
									<span class="" >
										<a href="{{ url('edit-order/'.$data->order_id) }}" title="">
											<i class="icon-edit"></i>
										</a>
									</span>
									<span class="" >
										<a id='del_{{ $data->order_id }}' data-order-id='{{ $data->order_id }}' href="#" title="">
											<i class="icon-trash"></i>
										</a>
									</span>
									@endif
								</td>							
							</tr>
							@endforeach
							@else
							<tr>
								<td style="text-align:center" colspan="8">ไม่พบข้อมูล</td>						
							</tr>
							@endif
								
							</tbody>
					</table>
<div class="text-center">
    {{ ThaiHelper::getPaginationLink('order',$arr_page['order'],$arr_count_page['order'],$arr_list_page) }}
</div>
<div id="modal_order"></div>
<script type="text/javascript">
$(document).ready(function(){
		// modal //
		$("[id^='view_']").click(function(){
			var order_id = $("#"+this.id).attr("data-order-id");
	        $.ajax({
	            	url: "{{ url('view-order') }}",
	                data: {order_id:order_id},
	                type:"POST",
	                beforeSend : function(){
	                         
	                },
	                success:function(r){                    
	                    $("#modal_order").html(r);
	                    $("#viewOrder").modal();
	            }
	        });
	    });
	    // closemodal //
	    var perpage = {{ $arr_perpage['order'] }};
        // ============= Delete ==============
        $("[id^='del']").click(function(){
        var result = confirm("คุณต้องการลบข้อมูลหรือไม่?");
            if (result==true) {
                var order_id = $("#"+this.id).attr("data-order-id");
                var page = {{ $arr_page['order'] }};
                // ============= Ajax Delete ==============
                $.ajax({
                    url: "{{ url('delete-order') }}",
                    type: "post",
                    data: {order_id:order_id},
                    success:function(r){                       
                        if(r.status == 'success'){
                            $.ajax({
                                    url:"{{ url('search-order') }}",
                                    type: "post",
                                    data:{ page: page, perpage: perpage ,keyword: ""},
                                    success:function(r){
                                        $("div#tbl").html(r);
                                    }
                            });
                        } else {
                        	alert("กรุณาลองใหม่อีกครั้ง")
                        }
                    }
                });     
                // =========== Close Ajax Delete ==========
            }
        });
		
});
</script>