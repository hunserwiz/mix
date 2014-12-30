	@extends('layouts.main')

@section('navigate')
        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}"><i class="icon-home"></i></a> <span class="divider">/</span></li>
          <!-- <li class="active" lang="En"><a href="{{ url('manage-product') }}">จัดการสินค้า</a></li> -->
          <li class="active" lang="En">เพิ่มสินค้า</li>
        </ul>
@stop
@section('content')
<div>
	<form name="form-sep">

		<!-- ################################################################################ -->
			<div class="row-fluid" >
					<div class="span6">
						<label class="span4">วันที่เพิ่มสินค้า  :</label>
						<div class="span8">					
							<input class="span6" type="text" name=""  >
						</div>
					</div>
					<div class="span6">
						<label class="span4">ประเภทสินค้า  :</label>
						<div class="span8">					
							<input class="span6" type="text" name=""  >
						</div>
					</div>

			</div>
			<div class="row-fluid" >
					<div class="span6">
						<label class="span4">ชื่อสินค้า :</label>
						<div class="span8">
							<input class="span6" type="text" name=""  >

						</div>
					</div>
				<div class="span6">
					<label class="span4">ราคาต่อหน่วย :</label>
					<div class="span8">
						<input class="span6" type="text" name="price" >
					</div>
				</div>
			</div>

			<div class="row-fluid" >
				  <div class="span6">
					<label class="span4">รส  :</label>
					<div class="span8">
							<input class="span6" type="text" name=""  >
					</div>
				   </div>
				<div class="span6">
				<label class="span4">ขนาด   :</label>
				<div class="span8">					
					<div class="span8">
						<input class="span6" type="text" name=""  >
				</div>
				</div>
			</div>
			</div>
		<div class="row-fluid" >
			<div class="span6">
					<label class="span4">จำนวน:</label>
					<div class="span8">
							<input class="span6" type="text" name=""  >
					</div>
				   </div>
				
			</div>
			
		</div>

		 <div class="text-right" style="padding-right:19%">
		       <a class="btn btn-success" href="ListAddProducts.html">&nbsp;<span lang="En" >Save</span></a>	
				<button class="btn  btn-danger" data-ng-click="cancle()">cancle<i class="fa fa-save"></i><span></span></button>
		</div>
{{ Form::Close() }}

</div>
@stop