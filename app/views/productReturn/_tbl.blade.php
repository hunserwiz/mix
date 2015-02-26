<table id="dtable_siteShow" class="table table-striped table-bordered table-condensed dtabler trcolor">
							<thead>
								<tr>
									<th style="text-align:center" lang="En">วันที่คืนสินค้า</th>
									<th style="text-align:center" lang="En">เขตการขาย</th>
									<th style="text-align:center" lang="En">คืนโดย</th>
									<th style="text-align:center" lang="En">จัดการ</th>						
								</tr>
							</thead>	
							<tbody>	
							@if($model->count() > 0)
							@foreach($model as $data)
							<tr>
								<td style="text-align:center">{{ $data->date_return }}</td>
								<td style="text-align:center">{{ ThaiHelper::GetLocation($data->location_id) }}</td>
								<td style="text-align:center">{{ ThaiHelper::GetUser($data->return_by) }}</td>
								<td style="text-align:center">
                                    <span class="" >
                                        <a href="#" id="view_{{ $data->id }}" data-product-return-id='{{ $data->id }}' title="view">
                                            <i class="icon-eye-open"></i>
                                        </a>
                                    </span>
                                    @if(ThaiHelper::CheckRight())
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
    {{ ThaiHelper::getPaginationLink('product',$arr_page['product'],$arr_count_page['product'],$arr_list_page) }}
</div>
<div id="modal_product_return"></div>
<script type="text/javascript">
$(document).ready(function(){
        // modal //
        $("[id^='view_']").click(function(){
            var id = $("#"+this.id).attr("data-product-return-id");
            $.ajax({
                    url: "{{ url('view-product-return') }}",
                    data: {id:id},
                    type:"POST",
                    beforeSend : function(){
                             
                    },
                    success:function(r){                    
                        $("#modal_product_return").html(r);
                        $("#viewProductReturn").modal();
                }
            });
        });
        // closemodal //
        // ============= Delete ==============
        $("[id^='del']").click(function(){
        var result = confirm("คุณต้องการลบข้อมูลหรือไม่?");
            if (result==true) {
                var id = $("#"+this.id).attr("data-product-return-id");
                var page = {{ $arr_page['product'] }};
                // ============= Ajax Delete ==============
                $.ajax({
                    url: "{{ url('delete-product-return') }}",
                    type: "post",
                    data: {id:id},
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
            var keyword = "{{ $keyword }}";
            var keydate = "{{ $keydate }}";

            Search(page,keyword,keydate);

            return false;
        });

		var perpage = {{ $arr_perpage['product'] }};

        function Search(page,keyword,keydate){
            $.ajax({
                type:"POST",
                url:"{{ url('search-product-return') }}",
                data:{ page: page, perpage: perpage, keyword: keyword ,keydate:keydate  },
                success:function(result){
                    $("div#tbl").html(result);
                }
            });
    }
});
</script>