<table id="dtable_siteShow" class="table table-striped table-bordered table-condensed dtabler trcolor">
							<thead>
								<tr>
									<th style="text-align:center" lang="En">ชื่อสินค้า</th>
									<th style="text-align:center" lang="En">ประเภทสินค้า</th>
									<th style="text-align:center" lang="En">วันที่ฝากสินค้า</th>
									<th style="text-align:center" lang="En">จำนวนที่ฝาก</th>
									<th style="text-align:center" lang="En">ราคา</th>
                                    <th style="text-align:center" lang="En">ประเภทการฝาก</th>
									<th style="text-align:center" lang="En">จัดการ</th>						
								</tr>
							</thead>	
							<tbody>	
							@if($model->count() > 0)
							@foreach($model as $data)
							<tr>
								<!-- <td style="text-align:center">{{ $data->product->name }}</td> -->
								<!-- <td style="text-align:center">{{ $data->categorise->name }}</td> -->
								<td style="text-align:center">{{ $data->date_deposit }}</td>
								<!-- <td style="text-align:center">{{ $data->amount }}</td> -->
                                <!-- <td style="text-align:center">{{ $data->price }}</td> -->
								<td style="text-align:center">{{ $data->type_deposit_id }}</td>
								<td style="text-align:center">
									<span class="" >
										<a href="{{ url('edit-deposit/'.$data->id) }}" title="">
											<i class="icon-edit"></i>
										</a>
									</span>
									<span class="" >
										<a id='del_{{ $data->id }}' data-deposit-id='{{ $data->id }}' href="#" title="">
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
    {{ ThaiHelper::getPaginationLink('deposit',$arr_page['deposit'],$arr_count_page['deposit'],$arr_list_page) }}
</div>
<script type="text/javascript">
$(document).ready(function(){
        // ============= Delete ==============
        $("[id^='del']").click(function(){
        var result = confirm("คุณต้องการลบข้อมูลหรือไม่?");
            if (result==true) {
                var id = $("#"+this.id).attr("data-deposit-id");
                var page = {{ $arr_page['deposit'] }};
                // ============= Ajax Delete ==============
                $.ajax({
                    url: "{{ url('delete-deposit') }}",
                    type: "post",
                    data: {id:id},
                    success:function(r){                       
                        if(r.status == 'success'){
                            $.ajax({
                                    url:"{{ url('search-deposit') }}",
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
        // Search //

        var perpage = {{ $arr_perpage['deposit'] }};
        
		$("ul.pagination.deposit li a").click(function(){
            var arr_id = (this.id).split("_");
            var page = arr_id.pop();
            var keyword = "{{ $keyword }}";
            var keydate = "{{ $keydate }}";
            var keytype = "{{ $keytype }}";

            Search(page,keyword,keydate,keytype);

            return false;
        });

        function Search(page,keyword,keydate,keytype){
            $.ajax({
                type:"POST",
                url:"{{ url('search-deposit') }}",
                data:{ page: page, perpage: perpage, keyword: keyword,keydate: keydate,keytype: keytype },
                success:function(result){
                    $("div#tbl").html(result);
                }
            });
        }
});
</script>