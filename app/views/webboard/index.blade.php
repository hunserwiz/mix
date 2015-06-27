@extends('layouts.main')

@section('navigate')
        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}"><i class="icon-home"></i></a> <span class="divider">/</span></li>
          <li class="active" lang="En">กระดานสนทนา</li>
        </ul>
@stop
@section('content')
<div>
	<form name="form-sep">
		<div class="text-right" style="padding-bottom:1%">
			<!-- Search Box -->
			<div class="input-group input-search">
	            <input type="text" id="txt_keyword" class="form-control" placeholder="ค้นหา : หัวข้อสนทนา">
	            <span class="input-group-btn">
	                <button class="btn btn-default btn-primary" id='btn_search' type="button">
	                    <span class="icon-search"></span>
	                </button>
	            </span>
	        </div>
	        <!-- Close Search Box -->
			<a class="btn btn-primary" href="{{ url('form-webboard') }}">
				<i class="icon-plus-sign icon-white"></i>&nbsp;
				<span lang="En" >เพิ่มหัวข้อสนทนา</span>
			</a>			
		</div>
		<div id='tbl' class="row-fluid" style="padding-top: 0%;">
				@include('webboard._tbl')		
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
	var perpage = {{ $arr_perpage['webboard'] }};

	$("#btn_search").click(function(){
            var keyword = $("#txt_keyword").val();
            Search(1,keyword);
    });

    $("ul.pagination.webboard li a").click(function(){
            var arr_id = (this.id).split("_");
            var page = arr_id.pop();
            var keyword = "{{ $keyword }}";

            Search(page,keyword);

            return false;
        });

	// $("#txt_keyword").keypress(function(e){  
 //        if (e.keyCode == 13) {
 //            var keyword = $("#txt_keyword").val();
            
 //            Search(1,keyword);
 //        }
	// });

	$("#txt_keyword").keypress(function(e){ 
	    if (e.keyCode == 13) {  //tab pressed
	        e.preventDefault(); // stops its action
	    }
	}



	function Search(page,keyword){
        $.ajax({
            type:"POST",
            url:"{{ url('search-webboard') }}",
            data:{ page: page, perpage: perpage, keyword: keyword },
            success:function(result){
                $("div#tbl").html(result);
            }
        });
	}
});
</script>
@stop