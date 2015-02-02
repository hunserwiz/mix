<?php
/**
 * Description of Thai Helper
 *
 * @author Oat
 */
class ThaiHelper {

    public static $thaiday = array("",
        "จ.", "อัง.", "พ.",
        "พฤ.", "ศ.", "ส.",
        "อา.");
    public static $thaiday_full = array("",
        "จันทร์", "อังคาร", "พุธ",
        "พฤหัสบดี", "ศุกร์", "เสาร์",
        "อาทิตย์");
    public static $thaimonth = array("",
        "ม.ค.", "ก.พ.", "มี.ค.",
        "เม.ย.", "พ.ค.", "มิ.ย.",
        "ก.ค.", "ส.ค.", "ก.ย",
        "ต.ค.", "พ.ย.", "ธ.ค");
    public static $thaimonth_full = array("",
        "มกราคม", "กุมภาพันธ์", "มีนาคม",
        "เมษายน", "พฤษภาคม", "มิถุนายน",
        "กรกฎาคม", "สิงหาคม", "กันยายน",
        "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
//    public static $thaimonth_full = array("",
//        "1" => "มกราคม", "2" => "กุมภาพันธ์", "3"=> "มีนาคม",
//        "4" => "เมษายน", "5" => "พฤษภาคม", "6" => "มิถุนายน",
//        "7" => "กรกฎาคม", "8" => "สิงหาคม", "9" => "กันยายน",
//        "10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม");
    public static $thainumber = array("๐", "๑", "๒", "๓", "๔", "๕", "๖", "๗", "๘", "๙");
    public static $thaiMoney = array("", "สิบ", "ร้อย", "พัน", "หมื่น", "แสน");
    public static $thaiReadNumber = array("", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
    public static $thaiReadNumberSib = array("", "", "ยี่", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
    public static $thaiReadNumberBaht = array("", "เอ็ด", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");

    public static function thaidate($formats, $timestamp = NULL, // Delete int for flexible use by Paang on August 30, 2011
            $enable_thainumber = false, $buddhist_era = true) {

        // $formats is same as format of PHP date();
        $output = "";
        if ($timestamp == NULL)
            $timestamp = time();
        $format_char = str_split($formats);
        foreach ($format_char as $format) {
            switch ($format) {
                case "D":
                    $text = self::$thaiday[(int) date("N", $timestamp)];
                    break;
                case "l":
                    $text = self::$thaiday_full[(int) date("N", $timestamp)];
                    break;
                case "S":
                    $text = date("N", $timestamp);
                    break;
                case "F":
                    $text = self::$thaimonth_full[(int) date("n", $timestamp)];
                    break;
                case "M":
                    $text = self::$thaimonth[(int) date("n", $timestamp)];
                    break;
                case "o":
                case "Y":
                    if ($buddhist_era) {
                        $text = date("o", $timestamp) + 543;
                    } else {
                        $text = date("o", $timestamp);
                    }
                    break;
                case "y":
                    if ($buddhist_era) {
                        $text = date("y", $timestamp) + 43;
                        $text = substr($text, -2);
                    } else {
                        $text = date("y", $timestamp);
                    }
                    break;
                case "H":
                    $text = date("H", $timestamp);
                    break;
                case "h":
                    $text = date("h", $timestamp);
                    break;
                case "i":
                    $text = date("i", $timestamp);
                    break;
                case "s":
                    $text = date("s", $timestamp);
                    break;
                default:
                    $text = date("$format", $timestamp);
            }
            if ($enable_thainumber) {
                $output .= self::to_thainumber($text);
            } else {
                $output .= $text;
            }
        }
        return $output;
    }

    public static function to_thainumber($text) {
        $output = "";
        $text_char = str_split($text);
        foreach ($text_char as $i) {
            if (is_numeric($i)) {
                $output.= self::$thainumber[$i];
            } else {
                $output.= $i;
            }
        }
        return $output;
    }

    /**
     * แปลงตัวเลขพร้อมทศนิยม 2 ตำแหน่ง เป็นคำอ่านเงินในภาษาไทย
     *
     * @param decimal $amount
     * @return string คำอ่านจำนวนเงิน เช่น สองแสนห้าสิบบาทแปดสิบเจ็ดสตางค์
     */
    public static function thaiBaht($amount) {
        $amount = str_replace(',', '', $amount);
        if ($amount == '') {
            return '-';
        }

        $baht = (string) $amount;

        $baht = explode(".", $baht);     // $baht[0]=บาท, $baht[1]=สตางค์
        if (!isset($baht[1])) {
            if ((!is_numeric((int) $baht[0]))) {
                return '-';
            }
        } else {
            if ((!is_numeric((int) $baht[0])) || (!is_numeric((int) $baht[$baht1]))) {
                return '-';
            }
        }


        $len = strlen($baht[0]);
        if ($len != 0) {
            $ctrl = 0;
            while ($len >= 1) {
                if ($len >= 6) {
                    $arr[$ctrl++] = substr($baht[0], -($ctrl * 6), 6);
                } else {
                    $arr[$ctrl++] = substr($baht[0], 0, $len);
                }
                $len-=6;
            }
            $str = "";
            for ($i = count($arr) - 1; $i >= 0; $i--) {
                $sub = array();
                $ctrl = strlen($arr[$i]) - 1;
                if($ctrl==0) $ctrl=9; // fix for 1,000,000 or 1,000,000,000,000 (every 6 position)
                for ($y = 0; $y < strlen($arr[$i]); $y++) {
                    $sub[$y] = substr($arr[$i], $y, 1);
                    if ($sub[$y] != "0") {
                        if ($ctrl == 1) {
                            $str .= self::$thaiReadNumberSib[$sub[$y]] . self::$thaiMoney[$ctrl];
                        } elseif ($ctrl == 0) {
                            $str .= self::$thaiReadNumberBaht[$sub[$y]] . self::$thaiMoney[$ctrl];
                        } else {
                            $str .= self::$thaiReadNumber[$sub[$y]] . self::$thaiMoney[$ctrl];
                        }
                    }else{
                        if($ctrl == 1) $ctrl=9; // fix for 101,000,000 or 101
                    }
                    $ctrl--;
                }
                if ($i > 0) {
                    $str .= "ล้าน";
                }
            }
            $str .= "บาท";
        } else {
            $str = "";
        }
        // Satang



        if (isset($baht[1])) {
            $baht[1]=substr($baht[1],0,2);

            if ($baht[1] != 0) {
                $len = strlen($baht[1]);
                if ($len < 2) {
                    $baht[1] = $baht[1] . '0';
                }
                $sub = array();
                $ctrl = strlen($baht[1]) - 1;
                for ($y = 0; $y < strlen($baht[1]); $y++) {
                    $sub[$y] = substr($baht[1], $y, 1);
                    if ($sub[$y] != "0") {
                        if ($y == 0) {
                            $str .= self::$thaiReadNumberSib[$sub[$y]] . self::$thaiMoney[$ctrl];
                        } else {
                            $str .= self::$thaiReadNumberBaht[$sub[$y]] . self::$thaiMoney[$ctrl];
                        }
                    }
                    $ctrl--;
                }
                $str .= "สตางค์";
            } else {
                $str .= "ถ้วน";
            }
        } else {
            $str .= "ถ้วน";
        }

        return $str;
    }

    /**
     * แปลงเดือนไทยจากเต็ม เป็นรูปแบบย่อ เช่น มกราคม เป็น ม.ค.
     *
     * @param string $fullMonth
     * @return string เดือนไทยแบบ ย่อ
     */
    public static function abbrThaiMonth($fullMonth) {
        return self::$thaimonth[array_search($fullMonth, self::$thaimonth_full)];
    }

    /**
     * แปลงปี พ.ศ. จากเต็ม เป็นรูปแบบย่อ เช่น 2554 เป็น 54
     * สามารถใช้กับปี ค.ศ.ก็ได้ เนื่องจากจะตัดเอา 2 ตัวหลัง return ออกมาให้
     *
     * @param string $fullY
     * @return string ปี พ.ศ. แบบย่อ
     */
    public static function abbrYear($fullY) {
        return substr($fullY, -2);
    }

    public static function CheckQtyDay($data=""){//date format 2012-01-01 00:00:00


        list($date_use,$time)=explode(" ", $data);
        list($year,$month,$day)=explode('-',$date_use);

        if($year > 1970){

        $status=true;
         $satat="0";

        if(((int)$month>12)||((int)$month<=0)){
            $status=false;


        }else{
            $satat=1;
        }

        if ($satat == 1) {
            $num_day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            if ($day > $num_day) {
                $status = false;
            }
        }
        }else{
             $status = false;
        }


     return $status;
    }

    // text for 01/01/2555
    public function getDateText($text,$is_full_month="1"){
        list($day,$month,$year)=explode("/", $text);
        if($is_full_month==1){
            $month=self::$thaimonth_full[(int) date("n", $timestamp)];
        }else{
            $month=self::$thaimonth[(int) date("n", $timestamp)];
        }

        $text_date=$day." ".$month." ".$year;
        return $text_date;
    }


       public function ChangThaiDateString($datetime) {

        list($d, $m, $y) = explode('/', $datetime); // แยกวันเป็น ปี เดือน วัน
         switch ($m) {
            case "00":$m = "";
                break;

            case "01":$m = "มกราคม";
                break;
            case "02":$m = "กุมพาพันธ์";
                break;
            case "03":$m = "มีนาคม";
                break;
            case "04":$m = "เมษายน";
                break;
            case "05":$m = "พฤษภาคม";
                break;
            case "06":$m = "มิภุนายน";
                break;
            case "07":$m = "กรกฏาคม";
                break;
            case "08":$m = "สิงหาคม";
                break;
            case "09":$m = "กันยายน";
                break;
            case "10":$m = "ตุลาคม";
                break;
            case "11":$m = "พฤศจิกายน";
                break;
            case "12":$m = "ธันวาคม";
                break;
        }
        return $d . " " . $m . " " . $y;
    }

    public static function getValidationMessage(){

        $messages = array(
            'required' => 'กรุณากรอก :attribute ',
            'integer' => 'กรุณากรอก :attribute เป็นตัวเลข',
            'numeric' => 'กรุณากรอก :attribute เป็นตัวเลข',
            'unique'  => ':attribute นี้มีในระบบแล้ว',
            'email'   => 'กรุณากรอก :attribute ให้ถูกต้อง ',
            'same'    => 'กรุณากรอก :attribute และ :other ให้เหมือนกัน',
            'size'    => 'กรุณากรอก :attribute จำนวน :size ตัว',
            'between' => 'กรุณากรอก :attribute ให้มีค่าระหว่าง :min - :max.',
            'min' => ':attribute ต้องไม่น้อยกว่า :min. ตัว',
            'max' => ':attribute ต้องไม่เกิน :max. ตัว',
            'mimes' => ':attribute ไม่ถูกต้อง',
            'regex' => ':attribute ไม่ถูกต้อง (xx-xxx-xxx)',
        );

        return $messages;
    }
     public static function getValidationMessageSignIn(){

        $messages = array(
            'required' => 'กรุณากรอก :attribute ',
            'integer' => 'กรุณากรอก :attribute เป็นตัวเลข',
            'numeric' => 'กรุณากรอก :attribute เป็นตัวเลข',
            'unique'  => ':attribute นี้มีในระบบแล้ว',
            'email'   => 'กรุณากรอก :attribute ให้ถูกต้อง ',
            'same'    => 'กรุณากรอก :attribute และ :other ให้เหมือนกัน',
            'size'    => 'กรุณากรอก :attribute จำนวน :size ตัว',
            'between' => 'กรุณากรอก :attribute ให้มีค่าระหว่าง :min - :max.',
            'mimes' => ':attribute ไม่ถูกต้อง',
            'min' => ':attribute ต้องไม่น้อยกว่า :min หลัก',
            'max' => ':attribute ต้องไม่เกิน :max หลัก',
        );

        return $messages;
    }


    public static function convertDateToShowTH($date){ // $date = 'yyyy-mm-dd' $result = ex. '01 ม.ค. 2557'
        $result = ""; 
        if($date != ""){
            $ex = explode(' ', $date);
            list($y, $m, $d) = explode('-', $ex[0]); // แยกวันเป็น ปี เดือน วัน
            switch ($m) {
                case "00":$m = "";
                    break;
                case "01":$m = "ม.ค.";
                    break;
                case "02":$m = "ก.พ.";
                    break;
                case "03":$m = "มี.ค.";
                    break;
                case "04":$m = "เม.ย.";
                    break;
                case "05":$m = "พ.ค.";
                    break;
                case "06":$m = "มิ.ย.";
                    break;
                case "07":$m = "ก.ค.";
                    break;
                case "08":$m = "ส.ค.";
                    break;
                case "09":$m = "ก.ค.";
                    break;
                case "10":$m = "ต.ค.";
                    break;
                case "11":$m = "พ.ย.";
                    break;
                case "12":$m = "ธ.ค.";
                    break;
            }
            $y = (int)$y + 543;

            $result = $d . " " . $m . " " . $y;
        }
        
        return $result;
    }

    public static function convertDateTHToDB($date){ // $date = ex. '01 ม.ค. 2557' $result = 'yyyy-mm-dd'
        $result = "";
        if($date != ""){
            list($d, $m, $y) = explode(' ', $date); // แยกวันเป็น ปี เดือน วัน
            switch ($m) {
                case "":$m = "00";
                    break;
                case "ม.ค.":$m = "01";
                    break;
                case "ก.พ.":$m = "02";
                    break;
                case "มี.ค.":$m = "03";
                    break;
                case "เม.ย.":$m = "04";
                    break;
                case "พ.ค.":$m = "05";
                    break;
                case "มิ.ย.":$m = "06";
                    break;
                case "ก.ค.":$m = "07";
                    break;
                case "ส.ค.":$m = "08";
                    break;
                case "ก.ค.":$m = "09";
                    break;
                case "ต.ค.":$m = "10";
                    break;
                case "พ.ย.":$m = "10";
                    break;
                case "ธ.ค.":$m = "12";
                    break;
            }
            $y = (int)$y - 543;

            $result = $y . "-" . $m . "-" . $d;
        } 

        return $result;
    }

    public static function encryptIt($q) {
        $cryptKey = 'encryptByQool';
        $qEncoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), $q, MCRYPT_MODE_CBC, md5(md5($cryptKey))));
        return( $qEncoded );
    }

    public static function decryptIt($q) {
        $cryptKey = 'encryptByQool';
        $qDecoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode($q), MCRYPT_MODE_CBC, md5(md5($cryptKey))), "\0");
        return( $qDecoded );
    }

    public static function is_mobile(){
        $useragent=$_SERVER['HTTP_USER_AGENT'];
        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
            $result = true;
        }else{
            $result = false;
        }
        return $result;
    }

    public static function getArrListPage($arr_page,$arr_count_page){
        $arr_list_page = array();
        if($arr_page <= 5){
            for($i = 1;$i <= $arr_page; $i++ ){
                if($i <= $arr_count_page){
                    $arr_list_page[$i] = $i;
                }
            }
        }else{
            for($i = ($arr_page - 5 );$i <= $arr_page; $i++ ){
                if($i <= $arr_count_page){
                    $arr_list_page[$i] = $i;
                }
            }
        }
        for($i = ($arr_page + 1) ;$i <= ($arr_page + 5 ); $i++ ){
            if($i <= $arr_count_page){
                $arr_list_page[$i] = $i;
            }
        }
        return $arr_list_page;
    }

    public static function getPaginationLink($name,$arr_page,$arr_count_page,$arr_list_page){
        $result = '';
        if ($arr_count_page > 1){
            // $result .= '<div class="text-center">';
                $result .= '<ul class="pagination '.$name.'">';
                    if ($arr_page == 1){
                        $result .= '<li class="disabled"><span>«</span></li>';
                    }else{
                        $result .= '<li><a id="'.$name.'_page_'.($arr_page - 1).'" href="#"><span>«</span></a></li>';
                    }
                    if (reset($arr_list_page) > 1){
                      $result .= '<li><span>...</span></li>';
                    }
                    foreach($arr_list_page as $i => $page){
                        if($arr_page == $i){
                            $result .= '<li class="active"><span>'. $i .'</span></li>';
                        }else{
                            $result .= '<li><a id="'.$name.'_page_'. $i .'" href="#">'. $i .'</a></li>';
                        }
                    }
                    if($arr_count_page > end($arr_list_page)){
                      $result .= '<li><span>...</span></li>';
                    }
                    if ($arr_page == $arr_count_page){
                        $result .= '<li class="disabled"><span>»</span></li>';
                    }else{
                        $result .= '<li><a id="'.$name.'_page_'. ($arr_page + 1) .'" href="#">»</a></li>'; 
                    }
                $result .= '</ul>';
            // $result .= '</div>';
        }

        return $result;
    }
    public static function getDataList($name = null){
        $arr = array();
        if($name == 'prefix'){
            $arr = array(
                ''=>'กรุณาเลือก',
                '1'=>'นาง',
                '2'=>'นางสาว',
                '3'=>'นาย'
                );
        }else if($name == 'gender'){
            $arr = array(
                ''=>'กรุณาเลือก',
                '1'=>'หญิง',
                '2'=>'ชาย',
                );
        }else if($name == 'position'){
            $arr = array(
                ''=>'กรุณาเลือก',
                '1'=>'ประธานบริษัท',
                '2'=>'รองประธานบริษัท',
                '3'=>'รักษาการเเทน',
                '4'=> 'พนักงาน'
                );
        }
        return $arr;
    }
    public static function getLocationList($option = null){
        return array('1'=>'พัทยาเหนือ','2'=>'พัทยาใต้');
    }
    public static function getTypeAccountList($option = null){
        return array('1'=>'รายรับ','2'=>'รายจ่าย','3'=>'อื่น ๆ','4'=>'เก็บหนี้ + จ่ายค้าง');
    }

    public static function getTypeAccount($id = null){
        $text = "";
        if($id == 1){
            $text = "รายรับ";
        }else if($id == 2){
            $text = "รายจ่าย";
        }else if($id == 3){
            $text = "อื่น ๆ";
        }else if($id == 4){
            $text = "เก็บหนี้ + จ่ายค้าง";
        }
        
        return $text;
    }

    public static function DateToDB($date = null){
        $result = "";
        if($date != null){
            $ex = explode("-", $date);
            $result = $ex[2]."-".$ex[1]."-".$ex[0];
        }
        return $result;        
    }

    public static function DateToShowForm($date = null){
        $result = "";
        if($date != null){
            $ex = explode("-", $date);
            $result = $ex[2]."-".$ex[1]."-".$ex[0];
        }
        return $result;        
    }
    
    public static function GetUser($id){
          $model = User::find($id);
          return $model->name;
    }
}

?>
