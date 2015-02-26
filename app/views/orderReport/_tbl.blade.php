<h3 class='text-center'>{{ Agent::GetNameAgent($agent_id); }}</h3>
<table id="dtable_siteShow" class="table table-striped table-bordered table-condensed dtabler trcolor">
							<thead>
								<tr>
									<th style="text-align:center">ขนาดสินค้า</th>
									<th style="text-align:center">จำนวนที่ได้</th>
                                    <th style="text-align:center">คะแนน</th>
									<th style="text-align:center">นำมาคูณ</th>
									<th style="text-align:center">ผลที่ได้</th>
								</tr>
							</thead>	
							<tbody>	
							@if(!empty($array_result))
							@foreach($array_result as $product => $value)
							<tr>
								<td style="text-align:center">{{ $value['name'] }}</td>
                                <td style="text-align:center">{{ number_format($value['amount']) }}</td>
                                <td style="text-align:center">{{ $value['point'] }}</td>
                                <td style="text-align:center">{{ number_format($value['amount']) ." * ". $value['point'] }}</td>
                                <td style="text-align:center">{{ number_format($value['amount'] * $value['point']) }}</td>
							</tr>
							@endforeach
							<tr>
								<td style="text-align:center">รวม</td>	
								<td style="text-align:center">{{ number_format($total_amount) }}</td>	
								<td style="text-align:center"></td>	
								<td style="text-align:center"></td>	
								<td style="text-align:center">{{ number_format($total_result) }}</td>	
							</tr>	
							@else
							<tr>
								<td style="text-align:center" colspan="4">ไม่พบข้อมูล</td>						
							</tr>
							@endif
								
							</tbody>
</table>
