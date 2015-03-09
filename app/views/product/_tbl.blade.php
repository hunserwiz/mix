<table id="dtable_siteShow" class="table table-striped table-bordered table-condensed dtabler trcolor">
							<thead>
								<tr>
									<th style="text-align:center">ชื่อสินค้า</th>
									<th style="text-align:center">ประเภท</th>
									<th style="text-align:center">ราคาต่อหน่วย</th>
									<th style="text-align:center">รส</th>
									<th style="text-align:center">ขนาด</th>
									<th style="text-align:center">จำนวนคงเหลือ</th>	
									<th style="text-align:center">จัดการ</th>									
								</tr>
							</thead>	
							<tbody>	
							@if($model->count() > 0)
							@foreach($model as $data)
							<tr>
								<td style="text-align:center">{{ $data->name }}</td>
								<td style="text-align:center">{{ $data->categorise($data->categorise_id) }}</td>
								<td style="text-align:center">{{ $data->price }}</td>
								<td style="text-align:center">{{ $data->flavor }}</td>
								<td style="text-align:center">{{ $data->size }}</td>
								<td style="text-align:center">{{ $data->product_balance }}</td>
								<td style="text-align:center">
									<span class="" >
										<a href="{{ url('edit-product/'.$data->id) }}" title="">
											<i class="icon-edit"></i>
										</a>
									</span>
									<span class="" >
										<a id='del_{{ $data->id }}' data-product-id='{{ $data->id }}' href="#" title="">
											<i class="icon-trash"></i>
										</a>
									</span>
								</td>							
							</tr>
							@endforeach
							@else
							<tr>
								<td style="text-align:center" colspan="7">ไม่พบข้อมูล</td>						
							</tr>
							@endif
							</tbody>
					</table>
<div class="text-center">
    {{ ThaiHelper::getPaginationLink('product',$arr_page['product'],$arr_count_page['product'],$arr_list_page) }}
</div>
<script type="text/javascript">
$(document).ready(function(){
        // ============= Delete ==============
        $("[id^='del']").click(function(){
        var result = confirm("คุณต้องการลบข้อมูลหรือไม่?");
            if (result==true) {
                var id = $("#"+this.id).attr("data-product-id");
                var page = {{ $arr_page['product'] }};
                // ============= Ajax Delete ==============
                $.ajax({
                    url: "{{ url('delete-product') }}",
                    type: "post",
                    data: {id:id},
                    success:function(r){                       
                        if(r.status == 'success'){
                            $.ajax({
                                    url:"{{ url('search-product') }}",
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
		$("ul.pagination.product li a").click(function(){
            var arr_id = (this.id).split("_");
            var page = arr_id.pop();
            var keyword = {{ $keyword }}

            Search(page,keyword);

            return false;
        });

		var perpage = {{ $arr_perpage['product'] }};

        function Search(page,keyword){
            $.ajax({
                type:"POST",
                url:"{{ url('search-product') }}",
                data:{ page: page, perpage: perpage, keyword: keyword },
                success:function(result){
                    $("div#tbl").html(result);
                }
            });
        }
});
</script>