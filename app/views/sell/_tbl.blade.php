<table id="dtable_siteShow" class="table table-striped table-bordered table-condensed dtabler trcolor">
							<thead>
								<tr>
									<th style="text-align:center">วันที่ขาย</th>
									<th style="text-align:center">ชื่อ ผู้ขาย</th>
                                    <th style="text-align:center">จำนวนเงิน</th>
									<th style="text-align:center">รายละเอียด</th>
								</tr>
							</thead>	
							<tbody>	
							@if($model != null)
							@foreach($model as $k => $data)
							<tr>
								<td style="text-align:center">{{ $data->date_debtor }}</td>
                                <td style="text-align:center">{{ $data->user->name }}</td>
                                <td style="text-align:center">{{ $data->date_pay }}</td>
                                <td style="text-align:center">{{ $data->price }}</td>
								<td style="text-align:center">{{ $data->detail }}</td>							
							</tr>
							@endforeach
							@else
							<tr>
								<td style="text-align:center" colspan="4">ไม่พบข้อมูล</td>						
							</tr>
							@endif
								
							</tbody>
					</table>

<script type="text/javascript">
$(document).ready(function(){
  
});
</script>