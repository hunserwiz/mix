<h3 class='text-center'>{{ ThaiHelper::GetLocation($branch_id) }}</h3>
<h3 class='text-center'>ตารางข้อมูลลูกหนี้</h3>
<h4 class='text-center'>{{ ThaiHelper::getThaiMonth($month) .' / '. $year }}</h4>
<table class="table table-striped table-bordered table-condensed dtabler trcolor">
	<thead>
		<tr>
			<th style="text-align:center" colspan='{{ $days_in_month }}'>{{ 'คงค้าง' }}</th>
		</tr>
		<tr>
			<th style="text-align:center">{{ 'ลูกหนี้' }}</th>
			@if(!empty($array_date))
				@foreach($array_date as $date)
					<th colspan='2' style="text-align:center">{{ $date.'/'.$month.'/'.substr($year,2) }}</th>
				@endforeach	
			@endif
		</tr>
	</thead>	
	<tbody>	
		@if($debtor_model->count() > 0)
			@foreach($debtor_model as $debtor)
					<tr>
						<td style="text-align:center" rowspan="2">{{ ThaiHelper::GetFullName($debtor->debtor_id) }}</td>
						@foreach($array_date as $date)
							<td style="text-align:center" rowspan="2">
								@if(!empty($array_result[$date][$debtor->debtor_id]['payable']))
									{{ number_format($array_result[$date][$debtor->debtor_id]['payable'],2) }}
								@endif
							</td>
							<td style="width:100%;">
								@if(!empty($array_result[$date][$debtor->debtor_id]['pay']))
									{{ 'ต่อบิล'. number_format($array_result[$date][$debtor->debtor_id]['pay'],2) }}
								@endif
							</td>
						@endforeach	
					</tr>
					<tr>
						@foreach($array_date as $date)
							<td style="width:100%;">
								@if(!empty($array_result[$date][$debtor->debtor_id]['total']))
					    			{{ 'ค้างจ่าย'. number_format($array_result[$date][$debtor->debtor_id]['total'],2) }}
					    		@endif
				    		</td>
				    	@endforeach
				    </tr>
			@endforeach	
		@else	
			<tr>
				<td style="text-align:center" colspan='{{ $days_in_month }}'>ไม่พบข้อมูล</td>
			</tr>		
		@endif						
	</tbody>
</table>