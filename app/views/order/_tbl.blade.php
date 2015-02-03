<table id="dtable_siteShow" class="table table-striped table-bordered table-condensed dtabler trcolor">
							<thead>
								<tr>
									<th style="text-align:center">เรื่อง</th>
									<th style="text-align:center">เลขที่ใบเสร็จ</th>
									<th style="text-align:center">วันที่ออกบิล</th>
									<th style="text-align:center">สินค้า</th>
									<th style="text-align:center">ราคา</th>
									<th style="text-align:center">จำนวน</th>
									<th style="text-align:center">location</th>
									<th style="text-align:center">agent</th>
									<th style="text-align:center">payment_by</th>	
									<th style="text-align:center">จัดการ</th>									
								</tr>
							</thead>	
							<tbody>	
							@if($model->count() > 0)
							@foreach($model as $k => $data)
							<tr>
								<td style="text-align:center">{{ $data->order_title }}</td>
								<td style="text-align:center">{{ $data->order_no }}</td>
								<td style="text-align:center">{{ $data->order_date }}</td>
								<td style="text-align:center">{{ $data->product->name }}</td>
								<td style="text-align:center">{{ $data->price }}</td>
								<td style="text-align:center">{{ $data->amount_total }}</td>
								<td style="text-align:center">{{ $data->GetLocation($data->location_id) }}</td>
								<td style="text-align:center">{{ $data->GetAgent($data->agent_id) }}</td>
								<td style="text-align:center">{{ ThaiHelper::GetUser($data->payment_by) }}</td>
								<td style="text-align:center">
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
<script type="text/javascript">
$(document).ready(function(){
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
                        }
                    }
                });     
                // =========== Close Ajax Delete ==========
            }
        });
		$("ul.pagination.order li a").click(function(){
            var arr_id = (this.id).split("_");
            var page = arr_id.pop();
            var keyword = {{ $keyword }}

            SearchShop(page,keyword);

            return false;
        });

		var perpage = {{ $arr_perpage['order'] }};

        function SearchShop(page,keyword){
            $.ajax({
                type:"POST",
                url:"{{ url('search-order') }}",
                data:{ page: page, perpage: perpage, keyword: keyword },
                success:function(result){
                    $("div#tbl").html(result);
                }
            });
        }
});
</script>