@extends('layouts.main')

@section('navigate')
        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}"><i class="icon-home"></i></a> <span class="divider">/</span></li>
          <li><a href="{{ url('manage-product') }}">จัดการสินค้า</a> <span class="divider">/</span></li>
          <li class="active" lang="En">รายการสินค้า</li>
        </ul>
@stop
@section('content')
<div>
	<form name="form-sep">
		<div class="text-Left" style="padding-right:19%">
			<a class="btn btn-primary" href="{{ url('form-product') }}"><i class="icon-plus-sign icon-white"></i>&nbsp;<span lang="En" >Add New</span></a>			
		</div>
				<div class="row-fluid" style="padding-top: 0%;">
					<table id="dtable_siteShow" class="table table-striped table-bordered table-condensed dtabler trcolor">
							<thead>
								<tr>
									<th style="text-align:center">ลำดับที่</th>
									<th style="text-align:center">ชื่อสินค้า</th>
									<th style="text-align:center">ประเภท</th>
									<th style="text-align:center">ราคาต่อหน่วย</th>
									<th style="text-align:center">รส</th>
									<th style="text-align:center">ขนาด</th>
									<th style="text-align:center">จำนวน</th>	
									<th style="text-align:center">จัดการ</th>									
								</tr>
							</thead>	
							<tbody>	
							@if($model->count() > 0)
							@foreach($model as $k => $data)
							<?php $k++; ?>
							<tr>
								<td style="text-align:center">{{ $k }}</td>
								<td style="text-align:center">{{ $data->name }}</td>
								<td style="text-align:center">{{ $data->categorise($data->categorise_id) }}</td>
								<td style="text-align:center">{{ $data->price }}</td>
								<td style="text-align:center">{{ $data->flavor }}</td>
								<td style="text-align:center">{{ $data->size }}</td>
								<td style="text-align:center">{{ $data->unit->product_balance }}</td>
								<td style="text-align:center">
									<span class="" >
										<a href="{{ url('edit-product/'.$data->product_id) }}" title="">
											<i class="icon-edit"></i>
										</a>
									</span>
									<span class="" >
									{{ Form::open(array(
                                    'id' => 'delete-product',  
                                    'url' => 'delete-product',
                                    'onsubmit' => 'return confirm("คุณต้องการลบข้อมูลหรือไม่?");'
                                               )) }}
                               {{ Form::hidden('product_id', $data->product_id) }}
                               {{ Form::submit('',array(
                               						'class'=>'icon-trash'
                               						)) }}
								{{ Form::close() }}
									</span>
								</td>							
							</tr>
							@endforeach
							@else
							<tr>
								<td style="text-align:center" colspan="7">ไม่พบข้อมูล</td>						
							</tr>
							@endif
								
							</tbody>
					</table>
			</div>	
	</form>		
</div>	

@stop