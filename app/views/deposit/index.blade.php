@extends('layouts.main')

@section('navigate')
        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}"><i class="icon-home"></i></a> <span class="divider">/</span></li>
          <li class="active" lang="En">รายการฝากสินค้า</li>
        </ul>
@stop
@section('content')
<div>
	<form name="form-sep">
		<div class="text-right" style="padding-bottom:1%">
			<!-- Search Box -->
			<div class="input-group input-search">	
				{{ "ค้นหาประเภทการฝาก: " }}
				{{ Form::select('txt_type', 
				array(''=> 'กรุณาเลือก',
				'1'=>'ฝากกลับบ้าน',
				'2'=>'ฝากในตู้')  
				, null, array('id'=>'txt_type','required'=>'',"class"=>"form-control")) }}		
				<input type="text" id="txt_date" class="date-picker form-control" placeholder="ค้นหา : วันที่ฝากสินค้า">
	            <span class="input-group-btn">
	                <button class="btn btn-default btn-primary" id='btn_search' type="button">
	                    <span class="icon-search"></span>
	                </button>
	            </span>
	        </div>
			<a class="btn btn-primary" href="{{ url('form-deposit') }}">
				<i class="icon-plus-sign icon-white"></i>&nbsp;
				<span lang="En" >เพิ่ม</span>
			</a>			
		</div>
			<div id='tbl' class="row-fluid" style="padding-top: 0%;">
				@include('deposit._tbl')	
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
	var perpage = {{ $arr_perpage['deposit'] }};

	$("#btn_search").click(function(){
            var keyword = $("#txt_keyword").val();
            var keydate = $("#txt_date").val();
    		var keytype = $("#txt_type").val();

            Search(1,keyword,keydate,keytype);
    });
           
    $("#txt_type").change(function(){
            // var keyword = $("#txt_keyword").val();
            // var keydate = $("#txt_date").val();
            var keytype = $("#txt_type").val();
    
            Search(1,null,null,keytype);
    });

	function Search(page,keyword,keydate,keytype){
            $.ajax({
                type:"POST",
                url:"{{ url('search-deposit') }}",
                data:{ page: page, perpage: perpage, keyword: keyword ,keydate:keydate,keytype:keytype  },
                success:function(result){
                    $("div#tbl").html(result);
                }
            });
	}
});
</script>
@stop