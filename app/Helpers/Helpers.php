<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Carbon\Carbon;

function convertToIndonesianMonth($date) {
    $months = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    ];

    $date = Carbon::parse($date);
    $month = $months[$date->month];

    return $month . ' ' . $date->year;
}

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


function detailtimeline($id){
    $data   = collect(\DB::select("SELECT * FROM trx_assets_landing WHERE id='$id'"))->first();

    $arr    = '';
    $arr  .='<li class="timeline-item">';
    $arr  .='<div class="timeline-badge primary"><i class="glyphicon glyphicon-check"></i></div>';
    $arr  .='<div class="timeline-panel">';
    $arr  .='<div class="timeline-heading">';
    $arr  .='<h4 class="timeline-title">CREATE</h4>';
    $arr  .='<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>'.$data->date_create.'</small></p>';
    $arr  .='</div>';
    $arr  .='<div class="timeline-body">';
    $arr  .='<div class="row">';
    $usr   = collect(\DB::select("SELECT * FROM users WHERE id='$data->id_user'"))->first();
    $arr  .='<div class="col-lg-4 col-md-4 label ">User Action</div>';
    $arr  .='<div class="col-lg-8 col-md-8">'.$usr->name.'</div>';
    $arr  .='</div>';
    $arr  .='<div class="row">';
    $arr  .='<div class="col-lg-4 col-md-4 label ">NPK</div>';
    $arr  .='<div class="col-lg-8 col-md-8">'.$usr->npk.'</div>';
    $arr  .='</div>';
    $arr  .='<div class="row">';
    $arr  .='<div class="col-lg-4 col-md-4 label ">Note</div>';
    $arr  .='<div class="col-lg-8 col-md-8">'.$data->necessity.'</div>';
    $arr  .='</div>';
    $arr  .='</div>';
    $arr  .='</div>';
    $arr  .='</li>';

    $dtid_dephed = $data->id_dephed;
    if($dtid_dephed != null || $dtid_dephed != ''){
        $arr  .='<li class="timeline-item">';
        $arr  .='<div class="timeline-badge primary"><i class="glyphicon glyphicon-check"></i></div>';
        $arr  .='<div class="timeline-panel">';
        $arr  .='<div class="timeline-heading">';
        $arr  .='<h4 class="timeline-title">CREATE</h4>';
        $dtrinci    = json_decode($data->dephed_detail);
        if($data->dephed_detail != null || $data->dephed_detail != ''){
            $arr  .='<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>'.$dtrinci[0].'</small></p>';
        }else{
            $arr  .='<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>-</small></p>';
        }
        $arr  .='</div>';
        $arr  .='<div class="timeline-body">';
        $arr  .='<div class="row">';
        $usr   = collect(\DB::select("SELECT * FROM users WHERE id='$data->id_dephed'"))->first();
        $arr  .='<div class="col-lg-4 col-md-4 label ">User Action</div>';
        $arr  .='<div class="col-lg-8 col-md-8">'.$usr->name.'</div>';
        $arr  .='</div>';
        $arr  .='<div class="row">';
        $arr  .='<div class="col-lg-4 col-md-4 label ">NPK</div>';
        $arr  .='<div class="col-lg-8 col-md-8">'.$usr->npk.'</div>';
        $arr  .='</div>';
        $arr  .='<div class="row">';
        $arr  .='<div class="col-lg-4 col-md-4 label ">Note</div>';
        if($data->dephed_detail != null || $data->dephed_detail != ''){
            $arr  .='<div class="col-lg-8 col-md-8">'.$dtrinci[1].'</div>';
        }else{
            $arr  .='<div class="col-lg-8 col-md-8">-</div>';
        }
        $arr  .='</div>';
        $arr  .='</div>';
        $arr  .='</div>';
        $arr  .='</li>';
    }

    $dtid_first = $data->id_first;
    if($dtid_first != null || $dtid_first != ''){
        $arr  .='<li class="timeline-item">';
        $arr  .='<div class="timeline-badge primary"><i class="glyphicon glyphicon-check"></i></div>';
        $arr  .='<div class="timeline-panel">';
        $arr  .='<div class="timeline-heading">';
        $arr  .='<h4 class="timeline-title">HRGA APPROVED</h4>';
        $dtrinci    = json_decode($data->first_detail);
        if($data->first_detail != null || $data->first_detail != ''){
            $arr  .='<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>'.$dtrinci[0].'</small></p>';
        }else{
            $arr  .='<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>-</small></p>';
        }
        $arr  .='</div>';
        $arr  .='<div class="timeline-body">';
        $arr  .='<div class="row">';
        $usr   = collect(\DB::select("SELECT * FROM users WHERE id='$data->id_first'"))->first();
        $arr  .='<div class="col-lg-4 col-md-4 label ">User Action</div>';
        $arr  .='<div class="col-lg-8 col-md-8">'.$usr->name.'</div>';
        $arr  .='</div>';
        $arr  .='<div class="row">';
        $arr  .='<div class="col-lg-4 col-md-4 label ">NPK</div>';
        $arr  .='<div class="col-lg-8 col-md-8">'.$usr->npk.'</div>';
        $arr  .='</div>';
        $arr  .='<div class="row">';
        $arr  .='<div class="col-lg-4 col-md-4 label ">Note</div>';
        if($data->first_detail != null || $data->first_detail != ''){
            $arr  .='<div class="col-lg-8 col-md-8">'.$dtrinci[1].'</div>';
        }else{
            $arr  .='<div class="col-lg-8 col-md-8">-</div>';
        }
        $arr  .='</div>';
        $arr  .='</div>';
        $arr  .='</div>';
        $arr  .='</li>';
    }

    $dtid_second = $data->id_second;
    if($dtid_second != null || $dtid_second != ''){
        $arr  .='<li class="timeline-item">';
        $arr  .='<div class="timeline-badge primary"><i class="glyphicon glyphicon-check"></i></div>';
        $arr  .='<div class="timeline-panel">';
        $arr  .='<div class="timeline-heading">';
        $arr  .='<h4 class="timeline-title">SCURITY</h4>';
        $dtrinci    = json_decode($data->second_detail);
        if($data->second_detail != null || $data->second_detail != ''){
            $arr  .='<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>'.$dtrinci[0].'</small></p>';
        }else{
            $arr  .='<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>-</small></p>';
        }
        $arr  .='</div>';
        $arr  .='<div class="timeline-body">';
        $arr  .='<div class="row">';
        $usr   = collect(\DB::select("SELECT * FROM users WHERE id='$data->id_second'"))->first();
        $arr  .='<div class="col-lg-4 col-md-4 label ">User Action</div>';
        $arr  .='<div class="col-lg-8 col-md-8">'.$usr->name.'</div>';
        $arr  .='</div>';
        $arr  .='<div class="row">';
        $arr  .='<div class="col-lg-4 col-md-4 label ">NPK</div>';
        $arr  .='<div class="col-lg-8 col-md-8">'.$usr->npk.'</div>';
        $arr  .='</div>';
        $arr  .='<div class="row">';
        $arr  .='<div class="col-lg-4 col-md-4 label ">Note</div>';
        if($data->second_detail != null || $data->second_detail != ''){
            $arr  .='<div class="col-lg-8 col-md-8">'.$dtrinci[1].'</div>';
        }else{
            $arr  .='<div class="col-lg-8 col-md-8">-</div>';
        }
        $arr  .='</div>';
        $arr  .='</div>';
        $arr  .='</div>';
        $arr  .='</li>';
    }

    $dtid_director = $data->id_director;
    if($dtid_director != null || $dtid_director != ''){
        $arr  .='<li class="timeline-item">';
        $arr  .='<div class="timeline-badge primary"><i class="glyphicon glyphicon-check"></i></div>';
        $arr  .='<div class="timeline-panel">';
        $arr  .='<div class="timeline-heading">';
        $arr  .='<h4 class="timeline-title">RETURNED</h4>';
        $dtrinci    = json_decode($data->director_detail);
        if($data->director_detail != null || $data->director_detail != ''){
            $arr  .='<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>'.$dtrinci[0].'</small></p>';
        }else{
            $arr  .='<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>-</small></p>';
        }
        $arr  .='</div>';
        $arr  .='<div class="timeline-body">';
        $arr  .='<div class="row">';
        $usr   = collect(\DB::select("SELECT * FROM users WHERE id='$data->id_director'"))->first();
        $arr  .='<div class="col-lg-4 col-md-4 label ">User Action</div>';
        $arr  .='<div class="col-lg-8 col-md-8">'.$usr->name.'</div>';
        $arr  .='</div>';
        $arr  .='<div class="row">';
        $arr  .='<div class="col-lg-4 col-md-4 label ">NPK</div>';
        $arr  .='<div class="col-lg-8 col-md-8">'.$usr->npk.'</div>';
        $arr  .='</div>';
        $arr  .='<div class="row">';
        $arr  .='<div class="col-lg-4 col-md-4 label ">Note</div>';
        if($data->director_detail != null || $data->director_detail != ''){
            $arr  .='<div class="col-lg-8 col-md-8">'.$dtrinci[1].'</div>';
        }else{
            $arr  .='<div class="col-lg-8 col-md-8">-</div>';
        }
        $arr  .='</div>';
        $arr  .='</div>';
        $arr  .='</div>';
        $arr  .='</li>';
    }

    $arr  .='<li class="timeline-item" style="display:none">';
    $arr  .='<div class="timeline-badge primary"><i class="glyphicon glyphicon-check"></i></div>';
    $arr  .='<div class="timeline-panel">';
    $arr  .='<div class="timeline-heading">';
    $arr  .='<h4 class="timeline-title">CREATE</h4>';
    $arr  .='<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>'.$data->date_create.'</small></p>';
    $arr  .='</div>';
    $arr  .='<div class="timeline-body">';
    $arr  .='<div class="row">';
    $usr   = collect(\DB::select("SELECT * FROM users WHERE id='$data->id_user'"))->first();
    $arr  .='<div class="col-lg-4 col-md-4 label ">User Action</div>';
    $arr  .='<div class="col-lg-8 col-md-8">'.$usr->name.'</div>';
    $arr  .='</div>';
    $arr  .='<div class="row">';
    $arr  .='<div class="col-lg-4 col-md-4 label ">NPK</div>';
    $arr  .='<div class="col-lg-8 col-md-8">'.$usr->npk.'</div>';
    $arr  .='</div>';
    $arr  .='<div class="row">';
    $arr  .='<div class="col-lg-4 col-md-4 label ">Note</div>';
    $arr  .='<div class="col-lg-8 col-md-8">'.$data->necessity.'</div>';
    $arr  .='</div>';
    $arr  .='</div>';
    $arr  .='</div>';
    $arr  .='</li>';

    return $arr;
}

function showdataemploye($type, $bulan, $idkry){

    $data   = DB::table('trx_employe_loan')->where('is_active', 1)->get();

    if($type == 'bulan'){
        if($bulan == '0' || $bulan == null){
            $bulan  = date('Y-m');
        }else{
            $bulan  = $bulan;
        }
        
        // $bulan  = "2024-02";
    
        $categories     = [];
        $dibayar        = [];
        $terbayarkan    = [];
        $sisa           = [];
        $tes            = [];
        $noarr          = 0;
        foreach($data as $key => $val){
            $kry                = collect(\DB::select("SELECT * FROM mst_karyawan WHERE id='$val->id_karyawan'"))->first();
            $listpembayaran     = json_decode($val->list_pembayaran);
    
            if(count($listpembayaran) !== 0){
                $categories[$noarr] = $kry->name;
                foreach($listpembayaran as $list => $pem){
                    if($pem->bulan == $bulan){
                        $dibayar[$noarr]      = intval($pem->nominal);
                        $terbayarkan[$noarr]  = intval($pem->terbayarkan);
                        $sisa[$noarr]         = intval($pem->sisa);
                        $noarr++;
                    }
                }
            }
            
        }

    }elseif($type == 'karyawan'){
        $categories     = [];
        $dibayar        = [];
        $terbayarkan    = [];
        $sisa           = [];
        $tes            = [];
        $noarr          = 0;

        $kry    = collect(\DB::select("SELECT * FROM trx_employe_loan WHERE id_karyawan='$idkry' AND is_active='1'"))->first();
        $listpembayaran     = json_decode($kry->list_pembayaran);
    
        if(count($listpembayaran) !== 0){
            foreach($listpembayaran as $list => $pem){
                $categories[$list]   = convertToIndonesianMonth($pem->bulan.'-01');
                $dibayar[$list]      = intval($pem->nominal);
                $terbayarkan[$list]  = intval($pem->terbayarkan);
                $sisa[$list]         = intval($pem->sisa);
            }
        }
    }else{
        $bulan  = date('Y-m');
        // $bulan  = "2024-02";
    
        $categories     = [];
        $dibayar        = [];
        $terbayarkan    = [];
        $sisa           = [];
        $tes            = [];
        $noarr          = 0;
        foreach($data as $key => $val){
            $kry                = collect(\DB::select("SELECT * FROM mst_karyawan WHERE id='$val->id_karyawan'"))->first();
            $listpembayaran     = json_decode($val->list_pembayaran);
    
            if(count($listpembayaran) !== 0){
                $categories[$noarr] = $kry->name;
                foreach($listpembayaran as $list => $pem){
                    if($pem->bulan == $bulan){
                        $dibayar[$noarr]      = intval($pem->nominal);
                        $terbayarkan[$noarr]  = intval($pem->terbayarkan);
                        $sisa[$noarr]         = intval($pem->sisa);
                        $noarr++;
                    }
                }
            }
            
        }
    }

    $arr['categories']      = $categories;
    $arr['dibayar']         = $dibayar;
    $arr['terbayarkan']     = $terbayarkan;
    $arr['sisa']            = $sisa;


    return $arr;
}

?>
