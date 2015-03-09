<?php

class Date {

    public static function getDayInMon() { // use in dropDownList
        $day = array(
            '1' => '1',
            '2', '3', '4', '5', '6', '7', '8', '9', '10',
            '11', '12', '13', '14', '15', '16', '17', '18', '19', '20',
            '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31',
        );

        return $day;
    }

    public static function getDaySection() { // use in dropDownList
        $arr = array(
            '1'  => '1 - 16',
            '2'  => '17 - 31'
        );

        return $arr;
    }

    public static function getYear() { // use in dropDownList.
        $arr = array();
        $year_now = (2015 + 543) - 8;
        $year_future = (date("Y") + 543) + 10;
        for ($i = $year_now; $i <= $year_future ; $i++) { 
            $arr[$i] = $i;
        }
        return $arr;
    }

    public static function getMon($option = NULL) { // use in dropDownList
        if ($option == NULL) {
            $mon = array(
                '01' => 'มกราคม',
                '02' => 'กุมภาพันธ์',
                '03' => 'มีนาคม',
                '04' => 'เมษายน',
                '05' => 'พฤษภาคม',
                '06' => 'มิถุนายน',
                '07' => 'กรกฏาคม',
                '08' => 'สิงหาคม',
                '09' => 'กันยายน',
                '10' => 'ตุลาคม',
                '11' => 'พฤศจิกายน',
                '12' => 'ธันวาคม',
            );
        } else { // Use With PlanMaterial
            $mon = array(
                '04' => 'มกราคม',
                '05' => 'กุมภาพันธ์',
                '06' => 'มีนาคม',
                '07' => 'เมษายน',
                '08' => 'พฤษภาคม',
                '09' => 'มิถุนายน',
                '10' => 'กรกฏาคม',
                '11' => 'สิงหาคม',
                '12' => 'กันยายน',
                '01' => 'ตุลาคม',
                '02' => 'พฤศจิกายน',
                '03' => 'ธันวาคม',
            );
        }


        return $mon;
    }

    public static function getQuarterMon() { // use in dropDownList
        $mon = array(
            '1' => 'ไตรมาสที่ 1 (ต.ค.-ธ.ค.)',
            '2' => 'ไตรมาสที่ 2 (ม.ค.-มี.ค.)',
            '3' => 'ไตรมาสที่ 3 (เม.ย.-มิ.ย.)',
            '4' => 'ไตรมาสที่ 4 (ก.ค.-ก.ย.)',
        );

        return $mon;
    }

}
