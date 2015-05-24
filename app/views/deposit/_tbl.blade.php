<table id="dtable_siteShow" class="table table-striped table-bordered table-condensed dtabler trcolor">
							<thead>
								<tr>
									<th style="text-align:center" lang="En">วันที่ฝากสินค้า</th>
                                    <th style="text-align:center" lang="En">ฝากกลับบ้านทั้งหมด</th>
                                    <th style="text-align:center" lang="En">ฝากในตู้ทั้งหมด</th>
                                    <th style="text-align:center" lang="En">ฝากตลาดนัดทั้งหมด</th>
                                    <th style="text-align:center" lang="En">ผู้นำฝาก</th>
                                    <th style="text-align:center" lang="En">ผู้รับฝาก</th>
                                    <th style="text-align:center" lang="En">วันที่มารับของฝาก</th>
									<th style="text-align:center" lang="En">จัดการ</th>						
								</tr>
							</thead>	
							<tbody>	
							@if($model->count() > 0)
							@foreach($model as $data)
							<tr>
								<td style="text-align:center">{{ $data->date_deposit }}</td>
								<!-- <td style="text-align:center">{{ Deposit::GetTypeDeposit($data->type_deposit_id) }}</td> -->
                                <td style="text-align:center">{{ $data->total_home }}</td>
                                <td style="text-align:center">{{ $data->total_box }}</td>
                                <td style="text-align:center">{{ $data->total_market }}</td>
                                <td style="text-align:center">{{ ThaiHelper::GetUser($data->deposit_by) }}</td>
                                <td style="text-align:center">{{ ThaiHelper::GetUser($data->create_by) }}</td>
                                <td style="text-align:center">{{ $data->date_deposit_return }}</td>
								<td style="text-align:center">
                                    <span class="" >
                                        <a href="#" id="view_{{ $data->id }}" data-deposit-id='{{ $data->id }}' title="view">
                                            <i class="icon-eye-open"></i>
                                        </a>
                                    </span>
                                    @if(ThaiHelper::CheckRight())
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
    {{ ThaiHelper::getPaginationLink('deposit',$arr_page['deposit'],$arr_count_page['deposit'],$arr_list_page) }}
</div>
<div id="modal_deposit"></div>
<script type="text/javascript">
$(document).ready(function(){
        // modal //
        $("[id^='view_']").click(function(){
            var deposit_id = $("#"+this.id).attr("data-deposit-id");
            $.ajax({
                    url: "{{ url('view-deposit') }}",
                    data: {deposit_id:deposit_id},
                    type:"POST",
                    beforeSend : function(){
                             
                    },
                    success:function(r){                    
                        $("#modal_deposit").html(r);
                        $("#viewDeposit").modal();
                }
            });
        });
        // closemodal //
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
            var keydeposit = "{{ $keydeposit }}";

            Search(page,keyword,keydate,keydeposit);

            return false;
        });

        function Search(page,keyword,keydate,keydeposit){
            $.ajax({
                type:"POST",
                url:"{{ url('search-deposit') }}",
                data:{ page: page, perpage: perpage, keyword: keyword,keydate: keydate,keydeposit: keydeposit },
                success:function(result){
                    $("div#tbl").html(result);
                }
            });
        }
});
</script>