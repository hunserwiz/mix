<!-- <table id="dtable_siteShow" class="table table-striped table-bordered table-condensed dtabler trcolor">
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
								@if($model_deposit_item->count() > 0)
									@foreach($model_deposit_item as $item)
									<tr>
										<td style="text-align:left">{{ $item->product->name }}</td>
										<td style="text-align:right">{{ $item->price }}</td>
										<td style="text-align:right">{{ $item->amount }}</td>
										<td style="text-align:center">
											<input type='button' id='del_{{ $item->id }}' data-deposit-item-id='{{ $item->id }}' class='btn btn-danger' value='ลบ'>
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
</table> -->
 <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.0-rc.1/angular.min.js"></script>
 <div ng-app ng-init="home=0;box=0;market=0">
<table id="dtable_siteShow" class="table table-striped table-bordered table-condensed dtabler trcolor">
							<thead>
								<tr>
									<th style="text-align:center">ชื่อสินค้า</th>
									<th style="text-align:center">ฝากกลับบ้าน</th>
									<th style="text-align:center">ฝากในตู้</th>	
									<th style="text-align:center">ตลาดนัด</th>																
								</tr>
							</thead>	
							<tbody>	
								@if($model_product->count() > 0)
									@foreach($model_product as $item)
									<tr>
										<td style="text-align:left">{{ $item->name }}</td>
										<td style="text-align:center">
											@if($mode == 'edit')
											{{ Form::text("product[$item->id][home]", $arr_data[$item->id]['home'],
                                            		array("id"=>"product_$item->id",'required'=>'',
                                            		'class'=>'form-control-home numeric','placeholder'=>'กรอกจำนวน',
                                            		'attr-type' =>'home','maxlength'=>6)) }}	
                                            @else
                                            {{ Form::text("product[$item->id][home]", Input::old("product[$item->id][home]") ,
                                            		array("id"=>"product_$item->id",'required'=>'',
                                            		'class'=>'form-control-home numeric','placeholder'=>'กรอกจำนวน',
                                            		'attr-type' =>'home','maxlength'=>6)) }}	
                                            @endif						
										</td>	
										<td style="text-align:center">
											@if($mode == 'edit')
											{{ Form::text("product[$item->id][box]", $arr_data[$item->id]['box'],
                                            		array("id"=>"product_$item->id",'required'=>'',
                                            		'class'=>'form-control-box numeric','placeholder'=>'กรอกจำนวน',
                                            		'attr-type' =>'box','maxlength'=>6)) }}	
                                            @else
                                            {{ Form::text("product[$item->id][box]", Input::old("product[$item->id][box]") ,
                                            		array("id"=>"product_$item->id",'required'=>'',
                                            		'class'=>'form-control-box numeric','placeholder'=>'กรอกจำนวน',
                                            		'attr-type' =>'box','maxlength'=>6)) }}	
                                            @endif						
										</td>	
										<td style="text-align:center">
											@if($mode == 'edit')
											{{ Form::text("product[$item->id][market]", $arr_data[$item->id]['market'],
                                            		array("id"=>"product_$item->id",'required'=>'',
                                            		'class'=>'form-control-market numeric','placeholder'=>'กรอกจำนวน',
                                            		'attr-type' =>'market','maxlength'=>6)) }}	
                                            @else
                                            {{ Form::text("product[$item->id][market]", Input::old("product[$item->id][market]") ,
                                            		array("id"=>"product_$item->id",'required'=>'',
                                            		'class'=>'form-control-market numeric','placeholder'=>'กรอกจำนวน',
                                            		'attr-type' =>'market','maxlength'=>6)) }}	
                                            @endif						
										</td>							
									</tr>
									@endforeach
									<td></td>
									<td>Total:
										<p id='total_home'>
											@if(!empty($model->total_home))
												{{ $model->total_home }}
											@endif
										</p>
										{{ Form::hidden('home',$model->total_home,array('class'=>'home')) }}
									</td>
									<td>Total:
										<p id='total_box'>
											@if(!empty($model->total_box))
												{{ $model->total_box }}
											@endif
										</p>
										{{ Form::hidden('box',$model->total_box,array('class'=>'box')) }}
									</td>
									<td>Total:
										<p id='total_market'>
											@if(!empty($model->total_market))
												{{ $model->total_market }}
											@endif
										</p>
										{{ Form::hidden('market',$model->total_market,array('class'=>'market')) }}
									</td>
								@else
									<tr id='empty'>
										<td style="text-align:center" colspan="4">ไม่พบข้อมูล</td>						
									</tr>
								@endif							
							</tbody>
					</table>
</div>

<script type="text/javascript">
$(document).ready(function(){
// ============= Delete Item============== //
	var mode = "{{ $mode }}";

	if(mode == 'edit'){
		var deposit_id = "{{ $model->id }}";
	}

	$(".form-control-home").each(function(){
		$(this).keyup(function(e){
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				
			} else {
				calculateSum('home');
			}
		});
	});


	$(".form-control-box").each(function(){
		$(this).keyup(function(e){
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				
			} else {
				calculateSum('box');
			}
		});
	});

	$(".form-control-market").each(function(){
		$(this).keyup(function(e){
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				
			} else {
				calculateSum('market');
			}
		});
	});



	function calculateSum(type){
		var sum=0;
		if(type == 'home') {
			$(".form-control-home").each(function(){
				if(!isNaN(this.value)&&this.value.length!=0){
					sum+=parseFloat(this.value);
				}
				$("#total_home").html(sum);
				$(".home").val(sum);
			});
		} else if(type == 'box') {
			$(".form-control-box").each(function(){
				if(!isNaN(this.value)&&this.value.length!=0){
					sum+=parseFloat(this.value);
				}
				$("#total_box").html(sum);
				$(".box").val(sum);
			});
		} else {
			$(".form-control-market").each(function(){
				if(!isNaN(this.value)&&this.value.length!=0){
					sum+=parseFloat(this.value);
				}
				$("#total_market").html(sum);
				$(".market").val(sum);
			});
		}
	}

	if(mode == 'edit'){
        $("[id^='del']").click(function(){
        var result = confirm("คุณต้องการลบข้อมูลหรือไม่?");
            if (result==true) {
                var id = $("#"+this.id).attr("data-deposit-item-id");                
                // ============= Ajax Delete ==============
                $.ajax({
                    url: "{{ url('delete-deposit-item') }}",
                    type: "post",
                    data: {id:id},
                    success:function(r){                       
                        if(r.status == 'success'){
                            $.ajax({
                                    url:"{{ url('deposit-item') }}",
                                    type: "post",
                                    data :{deposit_id:deposit_id,mode:mode},
                                    success:function(r){
                                        $("div#tbl_product").html(r);
                                    }
                            });
                        }
                    }
                });     
                // =========== Close Ajax Delete ==========
            }
        });
	}
	// ============= Close Delete Item ============== //.
});
</script>