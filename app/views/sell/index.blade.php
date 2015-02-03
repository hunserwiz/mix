@extends('layouts.main')

@section('navigate')
        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}"><i class="icon-home"></i></a> <span class="divider">/</span></li>
          <li class="active" lang="En">sell</li>
        </ul>
@stop
@section('content')
<div>
	<div class="row-fluid" >
		<div class="span4">
		<label class="span4">วัน  :</label>
			<div class="span4">					
				{{ Form::select('day', array(''=> 'กรุณาเลือก') + Date::getDayInMon()  , null, array('required'=>'',"class"=>"form-control")) }}
			</div>
		</div>
		<div class="span4">
		<label class="span4">เดือน  :</label>
			<div class="span4">					
				{{ Form::select('month', array(''=> 'กรุณาเลือก') + Date::getMon()  , null, array('required'=>'',"class"=>"form-control")) }}
			</div>
		</div>
		<div class="span4">
		<label class="span4">ปี  :</label>
			<div class="span4">					
				{{ Form::text('year', null,
					array("id"=>"year",'required'=>'','class'=>'form-control','placeholder'=>'กรอกปี')) }}
			</div>
		</div>.
		<div class="span4">
			<!-- <div class="span4">				 -->
			<div class="text-rigth" style="padding-left:41%;padding-bottom:1%;high:20px;">	
				<a id='search' class="btn btn-primary" href="#">
				<i class="icon-plus-sign icon-white"></i>&nbsp;
				<span lang="En">ค้นหา</span>
			</a>
			</div>			
			<!-- </div> -->
		</div>
	</div>		
</div>	
<div>
	<form name="form-sep">
		<div id='tbl' class="row-fluid" style="padding-top: 0%;">
				@include('sell._tbl')		
		</div>	
	</form>		
</div>	

@stop