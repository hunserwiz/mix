@extends('layouts.main')

@section('navigate')
        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}"><i class="icon-home"></i></a> <span class="divider">/</span></li>
          <li class="active" lang="En">Commition</li>
        </ul>
@stop
@section('content')
<div>
	{{ Form::open(array('url' => 'post-commition')) }}
	<div class="row-fluid" >
		<div class="span4">
		<label class="span4">วัน  :</label>
			<div class="span4">					
				{{ Form::select('day', array(''=> 'กรุณาเลือก') + Date::getDayInMon()  ,$day, array('required'=>'',"class"=>"form-control")) }}
			</div>
		</div>
		<div class="span4">
		<label class="span4">เดือน  :</label>
			<div class="span4">					
				{{ Form::select('month', array(''=> 'กรุณาเลือก') + Date::getMon()  , $month, array('required'=>'',"class"=>"form-control")) }}
			</div>
		</div>
		<div class="span4">
		<label class="span4">ปี  :</label>
			<div class="span4">					
				{{ Form::text('year', $year,
					array("id"=>"year",'required'=>'','class'=>'form-control','placeholder'=>'กรอกปี')) }}
			</div>
		</div>.
		<div class="span4">
			<div class="text-rigth" style="padding-left:41%;padding-bottom:1%;high:20px;">	
				{{ Form::submit('ค้นหา',array('class'=>'btn btn-success')) }}
			</div>			
		</div>
	</div>
	@if(Auth::user()->user_type == 1)
	<div class="row-fluid" >
		<div class="span4">
		<label class="span4">sell  :</label>
			<div class="span4">					
				{{ Form::select('agent_id', array(''=> 'กรุณาเลือก') +  $list_agent ,$agent_id, array('required'=>'',"class"=>"form-control")) }}
			</div>
		</div>
	</div>
	@endif
	{{ Form::Close() }}		
</div>	
<div>
	<form name="form-sep">
		<div id='tbl' class="row-fluid" style="padding-top: 0%;">
			@if(!empty($array_result))
				@include('commition._tbl')
			@else
				<h3 class='text-center'>ไม่พบข้อมูล</h3>
			@endif
		</div>	
	</form>		
</div>	

@stop