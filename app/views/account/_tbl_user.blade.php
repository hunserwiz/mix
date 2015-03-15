<table id="dtable_siteShow" class="table table-striped table-bordered table-condensed dtabler trcolor">
							<thead>
								<tr>
									<th style="text-align:center">ชื่อ</th>
									<th style="text-align:center">อีเมล์</th>
									<th style="text-align:center">ประเภทผู้ใช้งาน</th>									
									<th style="text-align:center">จัดการ</th>									
								</tr>
							</thead>	
							<tbody>	
							@if($model->count() > 0)
							@foreach($model as $k => $data)
							<tr>
								<td style="text-align:left">{{ $data->name }}</td>
								<td style="text-align:left">{{ $data->email }}</td>
								<td style="text-align:left">{{ ThaiHelper::GetTypeUser($data->user_type) }}</td>
								<td style="text-align:center">
									<span class="" >
										<a href="#" id="view_{{ $data->id }}" data-user-id='{{ $data->order_idid }}' title="view">
											<i class="icon-eye-open"></i>
										</a>
									</span>
									@if(ThaiHelper::CheckRight())
									<span class="" >
										<a href="{{ url('edit-user/'.$data->id) }}" title="">
											<i class="icon-edit"></i>
										</a>
									</span>
									<span class="" >
										<a id='del_{{ $data->id }}' data-user-id='{{ $data->id }}' href="#" title="">
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
    {{ ThaiHelper::getPaginationLink('user',$arr_page['user'],$arr_count_page['user'],$arr_list_page) }}
</div>
<div id="modal_order"></div>
<script type="text/javascript">
$(document).ready(function(){
		// modal //
		$("[id^='view_']").click(function(){
			var user_id = $("#"+this.id).attr("data-user-id");
	        $.ajax({
	            	url: "{{ url('view-user') }}",
	                data: {user_id:user_id},
	                type:"POST",
	                beforeSend : function(){
	                         
	                },
	                success:function(r){                    
	                    $("#modal_user_id").html(r);
	                    $("#viewUser_id").modal();
	            }
	        });
	    });
	    // closemodal //
        // ============= Delete ==============
        $("[id^='del']").click(function(){
        var result = confirm("คุณต้องการลบข้อมูลหรือไม่?");
            if (result==true) {
                var user_id = $("#"+this.id).attr("data-user-id");
                var page = {{ $arr_page['user'] }};
                // ============= Ajax Delete ==============
                $.ajax({
                    url: "{{ url('delete-order') }}",
                    type: "post",
                    data: {user_id:user_id},
                    success:function(r){                       
                        if(r.status == 'success'){
                            $.ajax({
                                    url:"{{ url('search-user') }}",
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
		
});
</script>