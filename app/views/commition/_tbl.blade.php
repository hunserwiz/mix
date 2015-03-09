<h3 class='text-center'>{{ ThaiHelper::GetAgent($agent_id)->name; }}</h3>
<h3 class='text-center'>{{ ThaiHelper::convertDateToShowTH($date_start). " ถึง " . ThaiHelper::convertDateToShowTH($date_end) }}</h3>
<h3 class='text-center'>ตาราง Commition</h3>
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
                                <td style="text-align:center">{{ $value['benefit_sender'] }}</td>
                                <td style="text-align:center">{{ number_format($value['amount']) ." * ". $value['benefit_sender'] }}</td>
                                <td style="text-align:center">{{ number_format($value['amount'] * $value['benefit_sender'], 2) }}</td>
							</tr>
							@endforeach
							<tr>
								<td style="text-align:center">รวม</td>	
								<td style="text-align:center">{{ number_format($total_amount) }}</td>	
								<td style="text-align:center"></td>	
								<td style="text-align:center"></td>	
								<td style="text-align:center">{{ number_format($total_result, 2) }}</td>	
							</tr>	
							@else
							<tr>
								<td style="text-align:center" colspan="5">ไม่พบข้อมูล</td>						
							</tr>
							@endif
								
							</tbody>
</table>
