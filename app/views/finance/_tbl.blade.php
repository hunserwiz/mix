<table id="dtable_siteShow" class="table table-striped table-bordered table-condensed dtabler trcolor">
							<thead>
								<tr>
									<th style="text-align:center">วันที่ลงข้อมูล</th>
									<th style="text-align:center">ประเภท</th>
									<th style="text-align:center">จำนวนเงิน</th>
									<th style="text-align:center">รายละเอียด</th>
									<th style="text-align:center">เจ้าหน้าที่บันทึกข้อมูล</th>	
									@if(ThaiHelper::CheckRight())
									<th style="text-align:center">จัดการ</th>		
									@endif									
								</tr>
							</thead>	
							<tbody>	
							@if($model->count() > 0)
							@foreach($model as $k => $data)
							<tr>
								<td style="text-align:center">{{ $data->date_account }}</td>
								<td style="text-align:center">{{ ThaiHelper::getTypeAccount($data->type) }}</td>
								<td style="text-align:right">{{ $data->price }}</td>
								<td style="text-align:center">{{ $data->detail }}</td>
								<td style="text-align:center">{{ ThaiHelper::GetUser($data->create_by) }}</td>
								@if(ThaiHelper::CheckRight())
								<td style="text-align:center">
									<span class="" >
										<a href="{{ url('edit-finance/'.$data->id) }}" title="">
											<i class="icon-edit"></i>
										</a>
									</span>
									<span class="" >
										<a id='del_{{ $data->id }}' data-finance-id='{{ $data->id }}' href="#" title="">
											<i class="icon-trash"></i>
										</a>
									</span>
								</td>
								@endif							
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
    {{ ThaiHelper::getPaginationLink('finance',$arr_page['finance'],$arr_count_page['finance'],$arr_list_page) }}
</div>
<script type="text/javascript">
$(document).ready(function(){
        // ============= Delete ==============
        $("[id^='del']").click(function(){
        var result = confirm("คุณต้องการลบข้อมูลหรือไม่?");
            if (result==true) {
                var id = $("#"+this.id).attr("data-finance-id");
                var page = {{ $arr_page['finance'] }};
                // ============= Ajax Delete ==============
                $.ajax({
                    url: "{{ url('delete-finance') }}",
                    type: "post",
                    data: {id:id},
                    success:function(r){                       
                        if(r.status == 'success'){
                            $.ajax({
                                    url:"{{ url('search-finance') }}",
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
	var perpage = {{ $arr_perpage['finance'] }};

	$("ul.pagination.finance li a").click(function(){
            var arr_id = (this.id).split("_");
            var page = arr_id.pop();
            var keyword = "{{ $keyword }}";
            var keydate = "{{ $keydate }}";
            var keytype = "{{ $keytype }}";

            Search(page,keyword,keydate,keydate);

            return false;
    });

	function Search(page,keyword,keydate,keytype){
            $.ajax({
                type:"POST",
                url:"{{ url('search-finance') }}",
                data:{ page: page, perpage: perpage, keyword: keyword ,keydate:keydate ,keytype:keytype },
                success:function(result){
                    $("div#tbl").html(result);
                }
            });
	}
});
</script>