@extends('layouts.main')

@section('navigate')
        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}"><i class="icon-home"></i></a> <span class="divider">/</span></li>
          <li class="active" lang="En">Sell</li>
        </ul>
@stop
@section('content')
<div>
	{{ Form::open(array('url' => 'post-debtor-report')) }}
	<div class="row-fluid" >
		<div class="span4">
		<label class="span4">สาขา  :</label>
			<div class="span4">					
				{{ Form::select('branch_id', array(''=> 'กรุณาเลือก') + ThaiHelper::getLocationList()  ,$branch_id, array('required'=>'',"class"=>"form-control")) }}
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
					array("id"=>"year",'required'=>'','class'=>'form-control numeric','placeholder'=>'กรอกปี','maxlength'=>4)) }}
			</div>
		</div>.
		<div class="span4">
			<div class="text-rigth" style="padding-left:41%;padding-bottom:1%;high:20px;">	
				{{ Form::submit('ค้นหา',array('class'=>'btn btn-success')) }}
			</div>			
		</div>
	</div>
	{{ Form::Close() }}		
</div>	
<div>
	<form name="form-sep">
		<div id='tbl' class="row-fluid" style="padding-top: 0%;">
			@if(!empty($array_result))
				@include('debtorReport._tbl')
			@endif
		</div>	
	</form>		
</div>	

@stop

