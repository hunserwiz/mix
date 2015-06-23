<table id="dtable_siteShow" class="table table-striped table-bordered table-condensed dtabler trcolor">
		<thead>
			<tr>
				<th style="text-align:center">หัวข้อสนทนา</th>	
				<th style="text-align:center">วันที่สร้าง</th>							
				<th style="text-align:center">จัดการ</th>									
			</tr>
		</thead>	
		<tbody>	
		@if($model->count() > 0)
		@foreach($model as $k => $data)
		<tr>
			<td style="text-align:center">
				<a href="{{ url('comment-webboard/'.$data->id) }}" title="topic">
					{{ $data->topic }}
				</a>
			</td>
			<td style="text-align:center">{{ $data->created_at }}</td>
			<td style="text-align:center">
				@if(ThaiHelper::CheckRight())
				<span class="" >
					<a href="{{ url('edit-webboard/'.$data->id) }}" title="edit topic">
						<i class="icon-edit"></i>
					</a>
				</span>
				<span class="" >
					<a id='del_{{ $data->id }}' data-webboard-id='{{ $data->id }}' href="#" title="delete topic">
						<i class="icon-trash"></i>
					</a>
				</span>
				@endif
			</td>							
		</tr>
		@endforeach
		@else
		<tr>
			<td style="text-align:center" colspan="3">ไม่พบข้อมูล</td>						
		</tr>
		@endif
			
		</tbody>
</table>
<div class="text-center">
    {{ ThaiHelper::getPaginationLink('webboard',$arr_page['webboard'],$arr_count_page['webboard'],$arr_list_page) }}
</div>

<div id="modal_webboard"></div>
<script type="text/javascript">
$(document).ready(function(){
    var perpage = {{ $arr_perpage['webboard'] }};
    // ============= Delete ==============
    $("[id^='del']").click(function(){
    var result = confirm("คุณต้องการลบข้อมูลหรือไม่?");
        if (result==true) {
            var webboard_id = $("#"+this.id).attr("data-webboard-id");
            var page = {{ $arr_page['webboard'] }};
            // ============= Ajax Delete ==============
            $.ajax({
                url: "{{ url('delete-webboard') }}",
                type: "post",
                data: {id:webboard_id},
                success:function(r){                       
                    if(r.status == 'success'){
                        $.ajax({
                                url:"{{ url('search-webboard') }}",
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