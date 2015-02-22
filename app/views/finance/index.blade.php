@extends('layouts.main')

@section('navigate')
        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}"><i class="icon-home"></i></a> <span class="divider">/</span></li>
          <li class="active" lang="En">รายการบัญชีรายรับ - รายจ่าย</li>
        </ul>
@stop
@section('content')
<div>
	<form name="form-sep">			
		<div class="text-right" style="padding-bottom:1%">
			<!-- Search Box -->
			<div class="input-group input-search">
				{{ Form::select('type', 
				array(''=> 'กรุณาเลือก',
				'1'=>'รายรับ',
				'2'=>'รายจ่าย',
				'3'=>'อื่นๆ',
				'4'=>'เก็บหนี้+จ่ายค้าง')  
				, null, array('id'=>'type','required'=>'',"class"=>"form-control")) }}
				<input type="text" id="txt_date" class="date-picker form-control" placeholder="ค้นหา : วันที่ลงบัญชี">
	            <input type="text" id="txt_keyword" class="form-control" placeholder="ค้นหา : รายละเอียด">
	            <span class="input-group-btn">
	                <button class="btn btn-default btn-primary" id='btn_search' type="button">
	                    <span class="icon-search"></span>
	                </button>
	            </span>
	        </div>
			<a class="btn btn-primary" href="{{ url('form-finance') }}">
				<i class="icon-plus-sign icon-white"></i>&nbsp;
				<span lang="En" >เพิ่ม</span>
			</a>			
		</div>
		<div id='tbl' class="row-fluid" style="padding-top: 0%;">
				@include('finance._tbl')		
		</div>	
	</form>		
</div>	
<script type="text/javascript">
$(document).ready(function(){
	$(".date-picker").datepicker({
		format: 'dd-mm-yyyy',
	});
	$(".date-picker").on("change", function () {
	    var id = $(this).attr("id");
	    var val = $("label[for='" + id + "']").text();
	    $("#msg").text(val + " changed");
	});
	// Search //
	var perpage = {{ $arr_perpage['finance'] }};

	$("#btn_search").click(function(){
            var keyword = $("#txt_keyword").val();
            var keydate = $("#txt_date").val();
            var keytype = $("#type").val();
            Search(1,keyword,keydate,keytype);
    });

    $("#type").change(function(){
            var keytype = $("#type").val();
            Search(1,null,null,keytype);
    });


	$("#txt_keyword").keypress(function(e){  
            if (e.keyCode == 13) {
                var keyword = $("#txt_keyword").val();
                Search(1,keyword,null,null);
            }
	});

	$("#txt_date").keypress(function(e){  
            if (e.keyCode == 13) {
                var keydate = $("#txt_date").val();
                Search(1,null,keydate,null);
            }
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
@stop