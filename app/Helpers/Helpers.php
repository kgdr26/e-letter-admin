<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function idn_user($id){
    $arr    = collect(\DB::select("SELECT * FROM users WHERE id='$id'"))->first();
    return $arr;
}

function getRomawi($bln){
    switch ($bln){
        case 1:
            return "I";
            break;
        case 2:
            return "II";
            break;
        case 3:
            return "III";
            break;
        case 4:
            return "IV";
            break;
        case 5:
            return "V";
            break;
        case 6:
            return "VI";
            break;
        case 7:
            return "VII";
            break;
        case 8:
            return "VIII";
            break;
        case 9:
            return "IX";
            break;
        case 10:
            return "X";
            break;
        case 11:
            return "XI";
            break;
        case 12:
            return "XII";
            break;
    }
}


function countingfile(){
    $folder    = DB::select("SELECT * FROM trx_folder where is_active=1");
    $arr       = [];

    foreach($folder as $key => $val){
        $file               = DB::table('trx_file')->where('id_folder', $val->id)->where('is_active', 1)->get();
        $arr[$val->id]    = count($file);
    }

    return $arr;
}


?>
