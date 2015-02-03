@extends('layouts.main')

@section('navigate')
        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}"><i class="icon-home"></i></a> <span class="divider">/</span></li>
          <li class="active" lang="En">รายการใบวางบิล</li>
        </ul>
@stop
@section('content')
<div>
	<form name="form-sep">
		<div class="text-right" style="padding-bottom:1%">
			<a class="btn btn-primary" href="{{ url('form-order') }}">
				<i class="icon-plus-sign icon-white"></i>&nbsp;
				<span lang="En" >เพิ่ม</span>
			</a>			
		</div>
		<div id='tbl' class="row-fluid" style="padding-top: 0%;">
				@include('order._tbl')		
		</div>	
	</form>		
</div>	

@stop