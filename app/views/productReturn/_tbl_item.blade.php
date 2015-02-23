<table id="dtable_siteShow" class="table table-striped table-bordered table-condensed dtabler trcolor">
							<thead>
								<tr>
									<th style="text-align:center">ชื่อสินค้า</th>
									<th style="text-align:center">ราคาต่อหน่วย</th>
									<th style="text-align:center">จำนวน</th>	
									<th style="text-align:center">จัดการ</th>																
								</tr>
							</thead>	
							<tbody>	
							@if($mode == 'edit')
								@if($model_product_item->count() > 0)
									@foreach($model_product_item as $item)
									<tr>
										<td style="text-align:left">{{ $item->product->name }}</td>
										<td style="text-align:right">{{ $item->price }}</td>
										<td style="text-align:right">{{ $item->amount }}</td>
										<td style="text-align:center">
											<input type='button' id='del_{{ $item->id }}' data-product-item-id='{{ $item->id }}' class='btn btn-danger' value='ลบ'>
										</td>							
									</tr>
									@endforeach
								@else
									<tr id='empty'>
										<td style="text-align:center" colspan="4">ไม่พบข้อมูล</td>						
									</tr>
								@endif
							@else	
								<tr></tr>
							@endif							
							</tbody>
</table>
