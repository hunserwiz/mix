@extends('layouts.main')
@section('navigate')
        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}"><i class="icon-home"></i></a> <span class="divider">/</span></li>
          <li><a href="{{ url('/manage-webboard') }}">รายการหัวข้อสนทนา</a><span class="divider">/</span></li>
          <li class="active" lang="En">เพิ่มหัวข้อสนทนา</li>
        </ul>
@stop
@section('content')
{{ Form::open(array('url' => 'post-webboard')) }}
@if(!empty($model->id))
	{{ Form::hidden('id',$model->id) }}
@endif	

<div>
	<form name="form-sep">
		<!-- ################################################################################ -->
			<div class="row-fluid" >
					<div class="span6">
						<label class="span4"> หัวข้อสนทนา  :</label>
						<div class="span8">		
						@if(empty($model->id))		
							{{ Form::textArea('topic', Input::old('topic'),
                                            array("id"=>"topic",'required'=>'','class'=>'date-picker form-control','placeholder'=>'กรอกหัวข้อสนทนา','rows'=> 3,'cols'=> 10)) }}
						@else
							{{ Form::textArea('topic', $model->topic,
                                            array("id"=>"topic",'required'=>'','class'=>'date-picker form-control','placeholder'=>'กรอกหัวข้อสนทนา','rows'=> 3,'cols'=> 10)) }}
						@endif
						@if($errors->has('topic'))
							<span id='span_topic'>
					        </span>
					        <p id='topic'>
					        	{{ $errors->first('topic') }}
					        </p>
						@endif	
						</div>
					</div>
			</div>
		<div class="text-center">
		 	{{ Form::submit('บันทึก',array('class'=>'btn btn-success')) }}
{{ Form::Close() }}
				<a href="{{ url('/manage-webboard') }}">
					<input type="button" class="btn btn-danger" value="ยกเลิก">
				</a>
		</div>
     </form> 
</div>

@stop