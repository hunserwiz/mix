@extends('layouts.main')

@section('navigate')
        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}"><i class="icon-home"></i></a> <span class="divider">/</span></li>
          <li class="active" lang="En">รายการผู้ใช้งาน</li>
        </ul>
@stop
@section('content')
<div>
	<form name="form-sep">
		<div class="text-right" style="padding-bottom:1%">
			<!-- Search Box -->
			<div class="input-group input-search">
				{{ Form::select('txt_keytype', 
				array(''=> 'กรุณาเลือก',
				'1'=>'admin',
				'2'=>'operate',
				'3'=>'sell')  
				, null, array('id'=>'txt_keytype',"class"=>"form-control")) }}
	            <input type="text" id="txt_keyword" class="form-control" placeholder="ค้นหา : ชื่อผู้ใช้งาน">
	            <span class="input-group-btn">
	                <button class="btn btn-default btn-primary" id='btn_search' type="button">
	                    <span class="icon-search"></span>
	                </button>
	            </span>
	        </div>
	        <!-- Close Search Box -->
			<a class="btn btn-primary" href="{{ url('form-user') }}">
				<i class="icon-plus-sign icon-white"></i>&nbsp;
				<span lang="En" >เพิ่ม</span>
			</a>			
		</div>
		<div id='tbl' class="row-fluid" style="padding-top: 0%;">
				@include('account._tbl_user')		
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
	var perpage = {{ $arr_perpage['user'] }};

	$("#btn_search").click(function(){
            var keyword = $("#txt_keyword").val();
            var keytype = $("#txt_keytype").val();
            Search(1,keyword,keytype);
    });

    $("#txt_keytype").change(function(){
            var keytype = $("#txt_keytype").val();
            Search(1,null,keytype);
    });

	$("#txt_keyword").keypress(function(e){  
            if (e.keyCode == 13) {
                var keyword = $("#txt_keyword").val();
                var keytype = $("#txt_keytype").val();
                Search(1,keyword,keytype);
                return false;
            }
	});

	function Search(page,keyword,keytype){
            $.ajax({
                type:"POST",
                url:"{{ url('search-user') }}",
                data:{ page: page, perpage: perpage, keyword: keyword , keytype:keytype},
                success:function(result){
                    $("div#tbl").html(result);
                }
         	});
        }

});
</script>
@stop