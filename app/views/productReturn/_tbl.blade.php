<table id="dtable_siteShow" class="table table-striped table-bordered table-condensed dtabler trcolor">
							<thead>
								<tr>
									<th style="text-align:center" lang="En">ชื่อสินค้า</th>
									<th style="text-align:center" lang="En">ประเภท</th>
									<th style="text-align:center" lang="En">วันที่คืนสินค้า</th>
									<th style="text-align:center" lang="En">จำนวนที่คืน</th>
									<th style="text-align:center" lang="En">ราคา</th>
									<th style="text-align:center" lang="En">จัดการ</th>						
								</tr>
							</thead>	
							<tbody>	
							@if($model->count() > 0)
							@foreach($model as $data)
							<tr>
								<td style="text-align:center">{{ $data->product->name }}</td>
								<td style="text-align:center">{{ $data->categorise->name }}</td>
								<td style="text-align:center">{{ $data->date_return }}</td>
								<td style="text-align:center">{{ $data->amount }}</td>
								<td style="text-align:center">{{ $data->price }}</td>
								<td style="text-align:center">
									<span class="" >
										<a href="{{ url('edit-product-return/'.$data->id) }}" title="">
											<i class="icon-edit"></i>
										</a>
									</span>
									<span class="" >
										<a id='del_{{ $data->id }}' data-product-return-id='{{ $data->id }}' href="#" title="">
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
    {{ ThaiHelper::getPaginationLink('product',$arr_page['product'],$arr_count_page['product'],$arr_list_page) }}
</div>
<script type="text/javascript">
$(document).ready(function(){
        // ============= Delete ==============
        $("[id^='del']").click(function(){
        var result = confirm("คุณต้องการลบข้อมูลหรือไม่?");
            if (result==true) {
                var product_id = $("#"+this.id).attr("data-product-return-id");
                var page = {{ $arr_page['product'] }};
                // ============= Ajax Delete ==============
                $.ajax({
                    url: "{{ url('delete-product-return') }}",
                    type: "post",
                    data: {product_id:product_id},
                    success:function(r){                       
                        if(r.status == 'success'){
                            $.ajax({
                                    url:"{{ url('search-product-return') }}",
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

            SearchShop(page,keyword);

            return false;
        });

		var perpage = {{ $arr_perpage['product'] }};

        function SearchShop(page,keyword){
            $.ajax({
                type:"POST",
                url:"{{ url('search-product-return') }}",
                data:{ page: page, perpage: perpage, keyword: keyword },
                success:function(result){
                    $("div#tbl").html(result);
                }
            });
        }
});
</script>