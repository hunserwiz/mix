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
<h3 class='text-center'>ตารางโบนัส</h3>
<table id="dtable_siteShow" class="table table-striped table-bordered table-condensed dtabler trcolor">
							<thead>
								<tr>
									<th style="text-align:center">ยอดขายคะแนน</th>
									<th style="text-align:center">ได้โบนัส</th>
                                    <th style="text-align:center">ได้รับโบนัส</th>
									<th style="text-align:center">โบนัสรวม 6 เดือน</th>
								</tr>
							</thead>	
							<tbody>	
							<tr>
								<td style="text-align:center">ขวด/เดือน</td>
                                <td style="text-align:center">(บาท/ขวด)</td>
                                <td style="text-align:center">(บาท/เดือน)</td>
                                <td style="text-align:center">(บาท)</td>
							</tr>
							<tr>
								<td style="text-align:center">10,000-14,000</td>
                                <td style="text-align:center">0.08</td>
                                <td style="text-align:center">800-1,120</td>
                                <td style="text-align:center">4,800-6,720</td>
							</tr>
							<tr>
								<td style="text-align:center">14,001-18,000</td>
                                <td style="text-align:center">0.09</td>
                                <td style="text-align:center">1,260-1,620</td>
                                <td style="text-align:center">7,560-9,720</td>
							</tr>
							<tr>
								<td style="text-align:center">18,001 ขึ้นไป</td>
                                <td style="text-align:center">0.1</td>
                                <td style="text-align:center">1,800 ขึ้นไป</td>
                                <td style="text-align:center">10,800 ขึ้นไป</td>
							</tr>								
							</tbody>
</table>
<div>
	{{ number_format($total_result) ." x 26 = ".  number_format($point) ." คะแนน/เดือน "}} 
</div> 
<div>
	{{ number_format($point) ." x ". $multiply . " = ". $bonus . " จำนวนโบนัส"}} 
</div> 
<div>
	{{ number_format($bonus) ." x 6 = ". number_format($salary) . " รายได้ต่อเดือน"}} 
</div>
<script type="text/javascript">
$(document).ready(function(){
  
});
</script>