@extends('layouts.main')

@section('navigate')
        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}"><i class="icon-home"></i></a> <span class="divider">/</span></li>
          <li><a href="{{ url('manage-product') }}">จัดการสินค้า</a> <span class="divider">/</span></li>
          <li class="active" lang="En">เพิ่มสินค้า</li>
        </ul>
@stop
@section('content')
<div>
{{ Form::open(array('url' => 'post-product')) }}
@if($model != null)
{{ Form::hidden('product_id',$model->product_id) }}
@endif		
			<div class="row-fluid" >
					<!-- <div class="span6">
						<label class="span4">วันที่เพิ่มสินค้า  :</label>
						<div class="span8">					
							<input class="span6" type="text" name=""  >
						</div>
					</div> -->
					<div class="span6">
						<label class="span4">ประเภทสินค้า  :</label>
						<div class="span8">		
						@if($model == null)
							 {{ Form::select('categorise_id', $array_categories, Input::old('categorise_id') ,
                                          array("class"=>"form-control","id"=>"categorise_id")) }}
						@else
							 {{ Form::select('categorise_id', $array_categories, $model->categorise_id ,
                                          array("class"=>"form-control","id"=>"categorise_id")) }}
						@endif			
							

						</div>
					</div>

			</div>
			<div class="row-fluid" >
					<div class="span6">
						<label class="span4">ชื่อสินค้า :</label>
						<div class="span8">
						@if($model == null)
							 {{ Form::text('name',Input::old('name') ,
                                        array('class'=>'form-control',"id"=>"name",'placeholder'=>'กรอกชื่อสินค้า')) }}
						@else
							 {{ Form::text('name',$model->name,
                                        array('class'=>'form-control',"id"=>"name",'placeholder'=>'กรอกชื่อสินค้า')) }}
						@endif
							 
						@if($errors->has('name'))
                        	{{ $errors->first('name') }}
                        @endif
						</div>
					</div>
				<div class="span6">
					<label class="span4">ราคาต่อหน่วย :</label>
					<div class="span8">
						@if($model == null)
							 {{ Form::text('price',Input::old('price') ,
                                        array('class'=>'form-control',"id"=>"price",'placeholder'=>'กรอกราคาต่อหน่วย')) }}
						@else
							 {{ Form::text('price',$model->price ,
                                        array('class'=>'form-control',"id"=>"price",'placeholder'=>'กรอกราคาต่อหน่วย')) }}
						@endif
						
						@if($errors->has('price'))
                        	{{ $errors->first('price') }}
                        @endif                   
					</div>
				</div>
			</div>

			<div class="row-fluid" >
				  <div class="span6">
					<label class="span4">รส  :</label>
					<div class="span8">
						@if($model == null)
							{{ Form::text('flavor',Input::old('flavor') ,
                                        array('class'=>'form-control',"id"=>"flavor",'placeholder'=>'กรอกรส')) }}
						@else
							{{ Form::text('flavor',$model->flavor ,
                                        array('class'=>'form-control',"id"=>"flavor",'placeholder'=>'กรอกรส')) }}
						@endif
							 
						@if($errors->has('flavor'))
                        	{{ $errors->first('flavor') }}
                        @endif            
					</div>
				   </div>
				<div class="span6">
				<label class="span4">ขนาด   :</label>
				<div class="span8">					
					<div class="span8">
						@if($model == null)
							{{ Form::text('size',Input::old('size') ,
                                        array('class'=>'form-control',"id"=>"size",'placeholder'=>'กรอกขนาด')) }}
						@else
							{{ Form::text('size',$model->size ,
                                        array('class'=>'form-control',"id"=>"size",'placeholder'=>'กรอกขนาด')) }}
						@endif
						 
						@if($errors->has('size'))
                        	{{ $errors->first('size') }}
                        @endif                           
				</div>
				</div>
			</div>
			</div>
		<div class="row-fluid" >
			<div class="span6">
					<label class="span4">จำนวน:</label>
					<div class="span8">
						@if($model == null)
							{{ Form::text('product_balance',Input::old('product_balance') ,
                                        array('class'=>'form-control',"id"=>"product_balance",'placeholder'=>'กรอกจำนวน')) }}
						@else
							{{ Form::text('product_balance',$model_stock->product_balance,
                                        array('class'=>'form-control',"id"=>"product_balance",'placeholder'=>'กรอกจำนวน')) }}
						@endif
							
						@if($errors->has('product_balance'))
                        	{{ $errors->first('product_balance') }}
                        @endif                  
					</div>
				   </div>
			</div>
			
		</div>
		 <div class="text-right" style="padding-right:19%">
		 	{{ Form::submit('บันทึก',array('class'=>'btn btn-success')) }}
{{ Form::Close() }}
		 	<a href="{{ url('manage-product') }}" >
		 		<button class='btn btn-danger'>ยกเลิก</button>
		 	</a>
		</div>

</div>
@stop