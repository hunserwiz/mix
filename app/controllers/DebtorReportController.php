<?php

class DebtorReportController extends BaseController {

    public function getIndex() {
        $model = Debtor::get();
        $branch_id = null;
        $month = null;
        $year = null;
        $agent_id = null;
        return View::make('debtorReport.index',compact('branch_id','month','year','model'));
    }

    public function postReport() {
        $branch_id = Input::get('branch_id');
        $month = Input::get('month');
        $year = Input::get('year') - 543;
        $agent_id = Input::get('agent_id');
        

        if(!empty($month) && !empty($year)){
            $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        }

        $date_start = $year."-".$month."-"."1";
        $date_end = $year."-".$month."-".$days_in_month;
        $year = Input::get('year');
        
        $debtor_model = Debtor::where('branch_id','=',$branch_id)
                        ->whereBetween('date_debtor',array($date_start,$date_end))
                        ->get();

        $array_result = array();
        $array_date = array();

        if(!empty($debtor_model) && !empty($days_in_month)){
            $day = 0;
            $date = new DateTime();

            for ($i=1; $i <= $days_in_month ; $i++) { 
                $array_date[]   = $i;
                $array_result[$i]= null;
            }

            foreach ($debtor_model as $debtor) {
                $timestamp = strtotime($debtor->date_debtor);
                $day = date("d", $timestamp);
                foreach ($array_date as $date) {                        
                    if ($day == $date && is_null($array_result[$date])) {
                        $array_result[$date][$debtor->debtor_id]['payable']        = $debtor->payable;
                        $array_result[$date][$debtor->debtor_id]['pay']            = $debtor->pay;
                        $array_result[$date][$debtor->debtor_id]['total']          = $debtor->payable - $debtor->pay;
                        $array_result[$date][$debtor->debtor_id]['debtor_id']      = $debtor->debtor_id;
                    } 
                }
            }
            $days_in_month = $days_in_month * 2;
        }
        // $this->alert($array_result);
        return View::make('debtorReport.index',compact('debtor_model',
                            'array_result',
                            'array_date',
                            'branch_id',
                            'month',
                            'days_in_month',
                            'year'));
    }
}
