<table id="dtable_siteShow" class="table table-striped table-bordered table-condensed dtabler trcolor">
							<thead>
								<tr>
									<th style="text-align:center">วันที่ลงข้อมูล</th>
									<th style="text-align:center">ประเภท</th>
									<th style="text-align:center">จำนวนเงิน</th>
									<th style="text-align:center">รายละเอียด</th>
									<th style="text-align:center">เจ้าหน้าที่บันทึกข้อมูล</th>	
									<th style="text-align:center">จัดการ</th>									
								</tr>
							</thead>	
							<tbody>	
							@if($model->count() > 0)
							@foreach($model as $k => $data)
							<tr>
								<td style="text-align:center">{{ $data->date_account }}</td>
								<td style="text-align:center">{{ ThaiHelper::getTypeAccount($data->type) }}</td>
								<td style="text-align:center">{{ $data->price }}</td>
								<td style="text-align:center">{{ $data->detail }}</td>
								<td style="text-align:center">{{ ThaiHelper::GetUser($data->create_by) }}</td>
								<td style="text-align:center">
									<span class="" >
										<a href="{{ url('edit-debtor/'.$data->id) }}" title="">
											<i class="icon-edit"></i>
										</a>
									</span>
									<span class="" >
										<a id='del_{{ $data->id }}' data-debtor-id='{{ $data->id }}' href="#" title="">
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
    {{ ThaiHelper::getPaginationLink('debtor',$arr_page['debtor'],$arr_count_page['debtor'],$arr_list_page) }}
</div>
<script type="text/javascript">
$(document).ready(function(){
        // ============= Delete ==============
        $("[id^='del']").click(function(){
        var result = confirm("Do you want to delete?");
            if (result==true) {
                var id = $("#"+this.id).attr("data-debtor-id");
                var page = {{ $arr_page['debtor'] }};
                // ============= Ajax Delete ==============
                $.ajax({
                    url: "{{ url('delete-debtor') }}",
                    type: "post",
                    data: {id:id},
                    success:function(r){                       
                        if(r.status == 'success'){
                            $.ajax({
                                    url:"{{ url('search-debtor') }}",
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
		$("ul.pagination.debtor li a").click(function(){
            var arr_id = (this.id).split("_");
            var page = arr_id.pop();
            var keyword = {{ $keyword }}

            SearchShop(page,keyword);

            return false;
        });

		var perpage = {{ $arr_perpage['debtor'] }};

        function SearchShop(page,keyword){
            $.ajax({
                type:"POST",
                url:"{{ url('search-debtor') }}",
                data:{ page: page, perpage: perpage, keyword: keyword },
                success:function(result){
                    $("div#tbl").html(result);
                }
            });
        }
});
</script>