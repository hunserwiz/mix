@extends('layouts.main')
@section('navigate')
        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}"><i class="icon-home"></i></a> <span class="divider">/</span></li>
          <li><a href="{{ url('/manage-webboard') }}">รายการหัวข้อสนทนา</a><span class="divider">/</span></li>
          <li><a href="{{ url('/comment-webboard/'.$model->webboard_id) }}">{{ $model->webboard->topic }}</a><span class="divider">/</span></li>
          <li class="active" lang="En">แก้ไขความคิดเห็น</li>
        </ul>
@stop
@section('content')
{{ Form::open(array('url' => 'post-comment')) }}
@if(!empty($model->id))
	{{ Form::hidden('id',$model->id) }}
	{{ Form::hidden('webboard_id',$model->webboard_id) }}
@endif	

<div>
	<form name="form-sep">
		<div class="row-fluid" >
				<div class="span6">
					<div class="span8">		
					<h3>หัวข้อสนทนา : {{ $model->webboard->topic }}</h3>
					</div>
				</div>
		</div>
		<div class="row-fluid" style="padding:1%"> -------------------------------------------------------------------------------------------------------------------------------------------------------------------	</div>
		<div class='comment'>
			<div class="row-fluid" style="padding:1%">
				<div class="span6">
					<label class="span4">ความเห็น   :</label>
					<div class="span8">
						{{ Form::textArea('comment', $model->comment ,
                                            array('required'=>'','class'=>'form-control','placeholder'=>'กรอกความคิดเห็น','col'=> 20 , 'rows'=> 10,)) }}
					</div>
				</div>
			</div>		
			<div class="row-fluid" style="padding:1%">
				<div class="span6">
					<label class="span4">เพศ   :</label>
					<div class="span8">
					{{ Form::radio('gender', '1', $model->gender == 1 ? 1 : 0 , array('required'=>'')) ."ชาย"}}
					{{ Form::radio('gender', '2', $model->gender == 2 ? 1 : 0 , array('required'=>'')) ."หญิง"}}					
					</div>
				</div>
			</div>		 
			<div class="row-fluid" style="padding:1%">
				<div class="span6">
					<label class="span4">โดย   :</label>
					<div class="span8">					
						<input type="text" name="comment_by" required="" value='{{ $model->comment_by }}'>
					</div>
				</div>
			</div>		 
		</div>
		<div class="text-center">
		 {{ Form::submit('บันทึก',array('class'=>'btn btn-success')) }}
{{ Form::Close() }}
		<a href="{{ url('/comment-webboard/'.$model->webboard_id) }}">
			<input type="button" class="btn btn-danger" value="ยกเลิก">
		</a>
		</div>
     </form> 
</div>

@stop