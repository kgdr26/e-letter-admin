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


function cekketersediaanassets($reqbooking, $kategori, $date_start, $date_end){
    $reqbooking     = json_decode($reqbooking);
    $dataassets     = DB::table('mst_asset')->where('is_active', 1)->where('kategori', $kategori)->get();
    $dtmasst        = [];

    foreach($dataassets as $da => $dv){
        $dtarrast[$da] = $dv->id;
    }

    $dtmasstunq     = array_unique($dtarrast);
    $date_start     = $date_start;
    $date_end       = $date_end;
    $terbooking     = DB::table('trx_assets_landing')->whereIn('data_asset', $dtmasstunq)->whereNotIn('status', [5,6])->get();
    $arr            = [];
    $asst           = [];
    $arrloop        = 0;
    $dtass          = [];

    foreach($terbooking as $k => $v){
        $idasset        = $v->data_asset;
        $tglterbooking  = json_decode($v->arrtgl);

        foreach($tglterbooking as $kt => $vt){
            $asst[$arrloop]['id']    = $idasset;
            $asst[$arrloop]['tgl']   = $vt;
            $arrloop++;
        }

    }
    
    foreach($asst as $ka => $kv){
        if(in_array($kv['tgl'], $reqbooking)){
            $dtass[$ka]= $kv['id'];
        }
    }

    $datain         = array_unique($dtass);

    
    $asset          = DB::table('mst_asset')->where('kategori', $kategori)->where('is_active', 1)->whereNotIn('id', $datain)->get();
    
    foreach($asset as $a => $s){
        $arr[$a]['id']          = $s->id;
        $arr[$a]['no_assets']   = $s->no_assets;
        $arr[$a]['name']        = $s->name;
    }

    return $arr;
}





?>
