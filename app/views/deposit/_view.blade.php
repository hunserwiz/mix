<div class="text-dialog modal fade" id="viewDeposit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">View Deposit</h4>
                <h5>ผู้ฝาก : {{ ThaiHelper::GetUser($model->deposit_by) }}</h5>
                <h5>เจ้าหน้ที่รับฝาก : {{ ThaiHelper::GetUser($model->create_by) }}</h5>
            </div>
            <div class="modal-body">
               <div class="panel">
                   <div class="panel-body">
                       <div class="clearfix">
                            <table id="dtable_siteShow" class="table table-striped table-bordered table-condensed dtabler trcolor">
                                <thead>
                                    <tr>
                                        <th style="text-align:center">สินค้า</th>
                                        <th style="text-align:center">ฝากกลับบ้าน</th>
                                        <th style="text-align:center">ฝากในตู้</th> 
                                        <th style="text-align:center">ตลาดนัด</th>
                                    </tr>
                                </thead>    
                                <tbody> 
                                @if($model_item->count() > 0)
                                @foreach($model_item as $k => $item)
                                <tr>
                                    <td style="text-align:center">{{ $item->product->name }}</td>
                                    <td style="text-align:right">{{ $item->at_home }}</td>
                                    <td style="text-align:right">{{ $item->at_box }}</td> 
                                    <td style="text-align:right">{{ $item->at_market }}</td>                         
                                </tr>
                                @endforeach
                                <tr>
                                    <td>{{ 'รวม' }}</td>
                                    <td style="text-align:right">{{ $model->total_home }}</td>
                                    <td style="text-align:right">{{ $model->total_box }}</td> 
                                    <td style="text-align:right">{{ $model->total_market }}</td>                         
                                </tr>
                                @else
                                <tr>
                                    <td style="text-align:center" colspan="3">ไม่พบข้อมูล</td>                      
                                </tr>
                                @endif
                                  
                                </tbody>
                            </table>
                       </div>
                   </div>
               </div>
            </div>

        </div>
    </div>
</div>