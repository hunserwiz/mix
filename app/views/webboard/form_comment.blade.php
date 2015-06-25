@extends('layouts.main')
@section('navigate')
        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}"><i class="icon-home"></i></a> <span class="divider">/</span></li>
          <li><a href="{{ url('/manage-webboard') }}">รายการหัวข้อสนทนา</a><span class="divider">/</span></li>
          <li class="active" lang="En">{{ $model->topic }}<span class="divider">/</span></li>
          <li class="active" lang="En">เพิ่มความคิดเห็น</li>
        </ul>
@stop
@section('content')
{{ Form::open(array('url' => 'post-comment')) }}
@if(!empty($model->id))
	{{ Form::hidden('webboard_id',$model->id) }}
@endif	

<div>
	<form name="form-sep">
		<div class="row-fluid" >
				<div class="span6">
					<div class="span8">		
					<h3>หัวข้อสนทนา : {{ $model->topic }}</h3>
					</div>
				</div>
		</div>
		<div class="row-fluid" style="padding:1%"> -------------------------------------------------------------------------------------------------------------------------------------------------------------------	</div>
		@if($model->comment->count() > 0)		
		<div class='comment'>
			@foreach($model->comment as $k => $comment)
			<?php $k++; ?>
			<div class="row-fluid" style="padding:1%">
				<div class="span6">
					<div class="span12">					
						ความคิดเห็นที่ {{ $k }} : <br />{{ $comment->comment }}
					</div>
				</div>
			</div>		
			<div class="row-fluid" style="padding:1%">
				<div class="span12">
					<div class="span4">					
						เพศ : {{ ThaiHelper::GetGender($comment->gender) }}
					</div>
					<div class="span4">					
						โดย : {{ $comment->comment_by }}
					</div>
					<div class="span4">					
						วันที่ : {{ ThaiHelper::convertDateToShowTH($comment->created_at) }}
					</div>
				</div>
			</div>
			<div style="text-align: center;">
				<span>
					<a href="{{ url('edit-comment/'.$comment->id) }}" title="edit comment">
						<i class="icon-edit"></i>
					</a>
				</span>
				<span>
					<a id='del_{{ $comment->id }}' data-comment-id='{{ $comment->id }}' href="#" title="delete comment">
						<i class="icon-trash"></i>
					</a>
				</span>	 
			</div>
			<div class="row-fluid" style="padding:1%"> -------------------------------------------------------------------------------------------------------------------------------------------------------------------	</div>
			@endforeach
		@endif		 
		
		</div>
		<div class='comment'>
			<div class="row-fluid" style="padding:1%">
				<div class="span6">
					<label class="span4">ความเห็น   :</label>
					<div class="span8">					
						{{ Form::textArea('comment', Input::old('comment'),
                                            array("id"=>"comment",'required'=>'','class'=>'form-control','placeholder'=>'กรอกความคิดเห็น','rows'=> 3,'cols'=> 10)) }}
					</div>
				</div>
			</div>		
			<div class="row-fluid" style="padding:1%">
				<div class="span6">
					<label class="span4">เพศ   :</label>
					<div class="span8">
					{{ Form::radio('gender', '1', 0 ,array('required'=>'')) ."ชาย"}}
					{{ Form::radio('gender', '2', 0 ,array('required'=>'')) ."หญิง"}}					
					</div>
				</div>
			</div>		 
			<div class="row-fluid" style="padding:1%">
				<div class="span6">
					<label class="span4">โดย   :</label>
					<div class="span8">					
						<input type="text" name="comment_by" required="">
					</div>
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
<script type="text/javascript">
$(document).ready(function(){
    // ============= Delete ==============
    $("[id^='del']").click(function(){
    var result = confirm("คุณต้องการลบข้อมูลหรือไม่?");
        if (result==true) {
            var comment_id = $("#"+this.id).attr("data-comment-id");
            // ============= Ajax Delete ==============
            $.ajax({
                url: "{{ url('delete-comment') }}",
                type: "post",
                data: {id:comment_id},
                success:function(r){                       
                    if(r.status == 'success'){
                        location.reload();
                    }
                }
            });     
            // =========== Close Ajax Delete ==========
        }
    });
});
</script>
@stop