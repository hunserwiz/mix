@extends('layouts.main')

@section('navigate')
        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}"><i class="icon-home"></i></a> <span class="divider">/</span></li>
          <li class="active" lang="En">บัญชีรายรับ - รายจ่าย</li>
        </ul>
@stop
@section('content')
<div>
	<form name="form-sep">
		<div class="text-Left" style="padding-right:19%">
			<a class="btn btn-primary" href="{{ url('form-finance') }}"><i class="icon-plus-sign icon-white"></i>&nbsp;<span lang="En" >Add New</span></a>			
		</div>
		<div id='tbl' class="row-fluid" style="padding-top: 0%;">
				@include('finance._tbl')		
		</div>	
	</form>		
</div>	

@stop