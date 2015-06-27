<?php

class PDFHelper {

    public static function Html($model, $model_item,$total,$input_data){ 
        $strTR = '';
        if($model_item->count() > 0){
            if ($model->type_member == 1) {
                foreach($model_item as $item):
                $strTR .= '   
                    <tr>
                        <td style="text-align:center">'. $item->product->name .'</td>
                        <td style="text-align:right">'. $item->amount .'</td>
                        <td style="text-align:right">'. $item->product->price .'</td>
                        <td style="text-align:right">'. number_format($item->amount * $item->product->price,2) .'</td>
                        
                    </tr>';
                    $total += ($item->amount * $item->product->price);
                endforeach; 
            } else {
                foreach($model_item as $item):
                $strTR .= '   
                    <tr>
                        <td style="text-align:center">'. $item->product->name .'</td>
                        <td style="text-align:right">'. $item->amount .'</td>
                        <td style="text-align:right">'. $item->product->price_member .'</td>
                        <td style="text-align:right">'. number_format($item->amount * $item->product->price_member,2) .'</td>
                        
                    </tr>';
                    $total += ($item->amount * $item->product->price_member);
                endforeach;    
            }
        }else{
            $strTR .= '   
                <tr>
                    <td style="text-align:center" colspan="4">ไม่พบข้อมูล</td>  
                </tr>';
        }

        return '
        <div>
            <form name="form-sep">
                    <div class="row-fluid" >
                            <div class="span3" style="border: 3px solid #ddd;padding-left: 1%;">
                                <label>บริษัท วันเพ็ญมาเก็ตติ้ง จำกัด</label><br>
                                <label>ต.บึง อ.ศรีราชา จ.ชลบุรี 20230 </label><br>
                                <label> โทร 038-427 515<label>  <br>
                                <label>แฟกซ์ 038-427 707<label> <br>
                                <label>เลขประจำตัวผู้เสียภาษีอากร 123456789<label>  <br>
                            </div>
                            <div class="span9" style="padding-left: 27%;">
                                <label>เรื่อง</label><br>
                                <label>'. $model->order_title .'</label><br>
                                <label>บิลเงินสด / ใบกำกับภาษี </label><br>
                                <label>'. $model->order_no .'</label><br>
                
                                <label>วันที่ '. $model->order_date  .'</label>

                                </div>


                    </div>
                    <div class="row-fluid" style="border: 1px solid #ddd;padding-left: 1%;padding-bottom: 2%;padding-top: 2%;" >
                        <div class="span6">
                                <label>ชื่อ นามสกุล ผู้ชื้อ '. ThaiHelper::GetAgent($model->agent_id)->first_name . " " .ThaiHelper::GetAgent($model->agent_id)->last_name .'</label><br>
                            
                                </div>

                                <div class="span6">
                                <label>ที่อยู่ '. ThaiHelper::GetAgent($model->agent_id)->address .' </label> 
                                <label>เบอร์โทรศัพท์ '. ThaiHelper::GetAgent($model->agent_id)->tel .'</label>
                                </div>
                    </div>
                    <div class="row-fluid" style="border: 1px solid #ddd;padding-left: 1%;padding-top: 2%;" >
                        <div class="span9">
                            <table id="dtable_siteShow" class="table table-striped table-bordered table-condensed dtabler trcolor">
                            <thead>
                                <tr>
                                    <th style="text-align:center" lang="En">รายการ</th>
                                    <th style="text-align:center" lang="En">จำนวนสินค้า</th>
                                    <th style="text-align:center" lang="En">ราคาสินค้า</th>
                                    <th style="text-align:center" lang="En">จำนวนเงิน</th>
                                </tr>
                            </thead>
                            <tbody>                    
                                '.$strTR.'
                            </tbody>                
                            </table>    
                        </div>
                    <div class="span12" style="padding-left: 39%;">
                        <label class="span4"  style="padding-left: 22%;">รวม </label>
                        <div class="span8">                 
                            <div class="span8">
                                <input class="span6" type="text" name="" value="'. number_format($total,2) .'"> บาท
                        </div>
                        </div>
                    </div>
                    <div class="span12" style="padding-left: 39%;">
                        <label class="span4"  style="padding-left: 15%;">ภาษีมูลค่าเพิ่ม </label>
                        <div class="span8">                 
                            <div class="span8">
                                <input class="span6" type="text" name="" value="'. number_format($total * 0.07) .'"> บาท
                            </div>
                        </div>
                    </div>
                    <div class="span12" style="padding-left: 39%;">
                            <label class="span4" style="padding-left: 12%;">รวมเป็นเงินทั้งสิ้น  </label>
                            <div class="span8">                 
                                <div class="span8">
                                    <input class="span6" type="text" name="" value="'. number_format(($total * 0.07) + $total) .'"> บาท
                                </div>
                            </div>
                    </div>
                    <div class="row-fluid" >
                          <div class="span5">
                            <label class="span4" style="padding-left: 12%;">วันที่รับสินค้า</label>
                            <div class="span8">
                                <input class="span6" type="text" name="data_get" value="'.$input_data['date_get'].'">
                            </div>
                           </div>
                        <div class="span7">
                        <label class="span4" style="padding-left: 12%;">ผู้รับสินค้า</label>
                        <div class="span8">                 
                            <div class="span8">
                                <input class="span6" type="text" name="get_by" value="'.$input_data['get_by'].'">
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="row-fluid" >
                          <div class="span5">
                            <label class="span4" style="padding-left: 12%;">วันที่ส่งสินค้า</label>
                            <div class="span8">
                                <input class="span6" type="text" name="date_send" value="'.$input_data['date_send'].'">
                            </div>
                           </div>
                        <div class="span7">
                        <label class="span4" style="padding-left: 12%;">ผู้ส่งสินค้า</label>
                        <div class="span8">                 
                            <div class="span8">
                                <input class="span6" type="text" name="send_by" value="'.$input_data['send_by'].'">
                            </div>
                        </div>
                    </div>
                    </div>
            </div>
        </div>';
    }
}
