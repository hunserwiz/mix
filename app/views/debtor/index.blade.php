@extends('layouts.main')

@section('navigate')
        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}"><i class="icon-home"></i></a> <span class="divider">/</span></li>
          <li class="active" lang="En">รายการลูกหนี้</li>
        </ul>
@stop
@section('content')
<div>
	<form name="form-sep">
		<div class="text-right" style="padding-bottom:1%">
			<!-- Search Box -->
			<div class="input-group input-search">
				{{ "ค้นหาลูกหนี้: " }}
				{{ Form::select('txt_keyword', 
				array(''=> 'กรุณาเลือก') + $list_debtor 
				, null, array('id'=>'txt_keyword','required'=>'',"class"=>"form-control")) }}
				<input type="text" id="txt_date" class="date-picker form-control" placeholder="ค้นหา : วันที่จ่าย">
	            <span class="input-group-btn">
	                <button class="btn btn-default btn-primary" id='btn_search' type="button">
	                    <span class="icon-search"></span>
	                </button>
	            </span>
	        </div>
			<a class="btn btn-primary" href="{{ url('form-debtor') }}">
				<i class="icon-plus-sign icon-white"></i>&nbsp;
				<span lang="En" >เพิ่ม</span>
			</a>			
		</div>
		<div id='tbl' class="row-fluid" style="padding-top: 0%;">
				@include('debtor._tbl')		
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
	var perpage = {{ $arr_perpage['debtor'] }};

	$("#btn_search").click(function(){
            var keyword = $("#txt_keyword").val();
            var keydate = $("#txt_date").val();
            var keytype = $("#type").val();
            Search(1,keyword,keydate,keytype);
    });

    $("#txt_keyword").change(function(){
            var txt_keyword = $("#txt_keyword").val();
            Search(1,txt_keyword,null);
    });

	$("#txt_date").keypress(function(e){  
            if (e.keyCode == 13) {
                var keydate = $("#txt_date").val();
                Search(1,null,keydate);
            }
	});

	function Search(page,keyword,keydate){
            $.ajax({
                type:"POST",
                url:"{{ url('search-debtor') }}",
                data:{ page: page, perpage: perpage, keyword: keyword ,keydate:keydate  },
                success:function(result){
                    $("div#tbl").html(result);
                }
            });
	}
});
</script>
@stop