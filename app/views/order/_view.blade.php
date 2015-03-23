<div class="text-dialog modal fade" id="viewOrder">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">View Order</h4>
            </div>
            <div class="modal-body">
               <div class="panel">
                   <div class="panel-body">
                       <div class="clearfix">
                            <table id="dtable_siteShow" class="table table-striped table-bordered table-condensed dtabler trcolor">
                                <thead>
                                    <tr>
                                        <th style="text-align:center">สินค้า</th>
                                        <th style="text-align:center">ราคาต่อหน่วย</th>
                                        <th style="text-align:center">จำนวน</th>  
                                        <th style="text-align:center">ผลที่ได้</th>                                                                   
                                    </tr>
                                </thead>    
                                <tbody> 
                                @if($model->count() > 0)
                                @foreach($model as $k => $data)
                                <tr>
                                    <td style="text-align:center">{{ $data->product->name }}</td>
                                    <td style="text-align:right">{{ $data->product->price }}</td>
                                    <td style="text-align:right">{{ $data->amount }}</td>   
                                    <td style="text-align:right">{{ number_format($data->product->price * $data->amount, 2) }}</td> 
                                    <?php $total += ($data->product->price * $data->amount); ?>  
                                </tr>
                                @endforeach
                                <tr>
                                    <td style="text-align:center">รวม</td>
                                    <td style="text-align:center"></td>
                                    <td style="text-align:center"></td>
                                    <td style="text-align:right">{{ number_format($total, 2) }}</td>                      
                                </tr>
                                @else
                                <tr>
                                    <td style="text-align:center" colspan="4">ไม่พบข้อมูล</td>                      
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