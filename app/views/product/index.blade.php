@extends('layouts.main')

@section('navigate')
        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}"><i class="icon-home"></i></a> <span class="divider">/</span></li>
          <li class="active" lang="En">จัดการสินค้า</li>
        </ul>
@stop
@section('content')
<div>
		<div class="text-Left" style="padding-right:19%">
			<a class="btn btn-primary" href="{{ url('form-product') }}"><i class="icon-plus-sign icon-white"></i>&nbsp;<span lang="En" >Add New</span></a>			
		</div>
				<div class="row-fluid" style="padding-top: 0%;">
					<table id="dtable_siteShow" class="table table-striped table-bordered table-condensed dtabler trcolor">
							<thead>
								<tr>
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
							@foreach($model as $data)
							<tr>
								<td style="text-align:center">{{ $data->name }}</td>
								<td style="text-align:center">{{ $data->categorise_id }}</td>
								<td style="text-align:center">{{ $data->price }}</td>
								<td style="text-align:center">{{ $data->flavor }}</td>
								<td style="text-align:center">{{ $data->size }}</td>
								<td style="text-align:center">{{ $data->unit }}</td>
								<td style="text-align:center">
									<span class="" >
										<a title=""><i class="icon-edit"></i>
										</a>
									</span>
									<span class="" >
										<a title=""><i class="icon-trash"></i>
										</a>
									</span>
									<span class="" >
										<a href="BillDetailx.pdf" title="ÍÍ¡ãºàÊÃç¨"><i class="icon-eye-open"></i>
										</a>
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
</div>	

@stop