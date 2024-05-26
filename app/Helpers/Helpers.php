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
        $databulan      = new DateTime();
        $datatanggal    = $databulan->format('Y-m-d');
        $pengecualian   = $databulan->format('Y-m-27');
        if($datatanggal >= $pengecualian){
            $bln    = $databulan->format('Y-m');
        }else{
            $databulan->modify('-1 month');
            $bln    = $databulan->format('Y-m');
        }

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
                if($pem->bulan <= $bln){
                    $categories[$list]   = convertToIndonesianMonth($pem->bulan.'-01');
                    $dibayar[$list]      = intval($pem->nominal);
                    $terbayarkan[$list]  = intval($pem->terbayarkan);
                    $sisa[$list]         = intval($pem->sisa);
                }
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

function autogenerateloan(){
    $data   =  DB::table('trx_employe_loan')->select('trx_employe_loan.*', 'b.name', 'b.npk')
            ->leftJoin('mst_karyawan AS b', 'b.id', '=', 'trx_employe_loan.id_karyawan')
            ->where('trx_employe_loan.is_active', 1)->orderBy('trx_employe_loan.id', 'desc')->get();
            // ->where('trx_employe_loan.is_active', 1)->where('trx_employe_loan.id', 6)->orderBy('trx_employe_loan.id', 'desc')->get();

    $bln    = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');

    $dt     = [];

    foreach($data as $key => $val){
        $dt[$key]['id']             = $val->id;
        $dt[$key]['name']           = $val->name;
        $dt[$key]['nominal_loan']   = $val->nominal_loan;
        $dt[$key]['bulan_loan']     = $val->bulan_loan;
        $dt[$key]['loan_perbulan']  = $val->loan_perbulan;
        $dt[$key]['start_bulan']    = $val->start_bulan;

        $start_bulan                = $val->start_bulan;
        $exlp_bulan                 = explode("-", $start_bulan);
        $jml_bulan                  = $val->bulan_loan;

        $bulan_awal_index           = intval($exlp_bulan[1])-1;
        $tahun_awal                 = $exlp_bulan[0];
        $forbulan                   = [];
        $v_terbayarkan              = 0;
        $v_sisa                     = 0;
        $v_nominal                  = 0;
        $v_list_pembayaran          = '';
        for ($i = 0; $i < $jml_bulan; $i++) {
            $indeks_bulan           = ($bulan_awal_index + $i) % 12;
            $tahun                  = $tahun_awal + floor(($bulan_awal_index + $i) / 12);

            $dataExists             = DB::table('trx_setting_bulan_thr')->where('tahun', $tahun)->where('bulan', $bln[$indeks_bulan])->exists();
            if($bln[$indeks_bulan] == '12' || $dataExists == 1){
                $jmlck      = 2;
            }else{
                $jmlck      = 1;
            }

            $v_nominal                                  = $val->loan_perbulan*$jmlck;
            
            if($v_sisa == 0){
                $v_terbayarkan                              += $v_nominal;
                $v_sisa                                     = $val->nominal_loan-$v_terbayarkan;
            }elseif($v_sisa <= $v_nominal){
                $v_nominal                                  = $v_sisa;
                $v_terbayarkan                              += $v_nominal;
                $v_sisa                                     = 0;
            }else{
                $v_terbayarkan                              += $v_nominal;
                $v_sisa                                     = $v_sisa-$v_nominal;
            }

            if($v_sisa >= 0 && $v_nominal > 0){
                $dt[$key]['loopbulan'][$i]['bulan']         = $tahun."-".$bln[$indeks_bulan];
                $dt[$key]['loopbulan'][$i]['jml']           = $jmlck;
                $dt[$key]['loopbulan'][$i]['nominal']       = $v_nominal;
                $dt[$key]['loopbulan'][$i]['terbayarkan']   = $v_terbayarkan;
                $dt[$key]['loopbulan'][$i]['sisa']          = $v_sisa;
    
                $v_list_pembayaran .= '{"bulan": "'.$tahun.'-'.$bln[$indeks_bulan].'","jml": "'.$jmlck.'","nominal": "'.$v_nominal.'","terbayarkan": "'.$v_terbayarkan.'","sisa": "'.$v_sisa.'"},';
            }
            
        }
        $k_list_pembayaran              = '['.substr($v_list_pembayaran, 0, -1).']';
        $dt[$key]['list_pembayaran']    = $k_list_pembayaran;

        DB::table('trx_employe_loan')->where('id', $val->id)->update(['list_pembayaran'=>$k_list_pembayaran]);
    }

    $arr           = $dt;

    // return $arr;
    return response('success');
}

function action_showlistdataloanperuser($id){
    $databulan      = new DateTime();
    $datatanggal    = $databulan->format('Y-m-d');
    $pengecualian   = $databulan->format('Y-m-27');
    if($datatanggal >= $pengecualian){
        $bln    = $databulan->format('Y-m');
    }else{
        $databulan->modify('-1 month');
        $bln    = $databulan->format('Y-m');
    }

    $dt         = DB::table('trx_employe_loan')->select('trx_employe_loan.*', 'b.name', 'b.npk', 'b.id as id_kry')
                ->leftJoin('mst_karyawan AS b', 'b.id', '=', 'trx_employe_loan.id_karyawan')
                ->where('trx_employe_loan.id', $id)
                ->where('trx_employe_loan.is_active', 1)->first();

    $dt_lsp         = json_decode($dt->list_pembayaran);
    $dt_end_loan    = end($dt_lsp);

    $no         = 1;
    $html       = '';
    foreach($dt_lsp as $key => $val){
        if($val->bulan <= $bln){
            $html .= '<tr>';
            $html .= '<td>'.$no++.'</td>';
            $html .= '<td>'.convertToIndonesianMonth($val->bulan).'</td>';
            $html .= '<td>Rp ' . number_format($val->nominal, 0, ',', '.').'</td>';
            $html .= '<td>Rp ' . number_format($val->terbayarkan, 0, ',', '.').'</td>';
            $html .= '<td>Rp ' . number_format($val->sisa, 0, ',', '.').'</td>';
            $html .= '</tr>';
        }else{
            $html .= '';
        }
    }

    $arr['name_list_loan']      = $dt->name;
    $arr['npk_list_loan']       = $dt->npk;
    $arr['nominal_list_loan']   = 'Rp ' . number_format($dt->nominal_loan, 0, ',', '.');
    $arr['golongan_list_loan']  = $dt->golongan;
    $arr['start_list_loan']     = convertToIndonesianMonth($dt->start_bulan);
    $arr['end_list_loan']       = convertToIndonesianMonth($dt_end_loan->bulan);
    $arr['dt_html']             = $html;
    return $arr;
}

function action_listtableloanperuser($id){
    $databulan      = new DateTime();
    $datatanggal    = $databulan->format('Y-m-d');
    $pengecualian   = $databulan->format('Y-m-27');
    if($datatanggal >= $pengecualian){
        $bln    = $databulan->format('Y-m');
    }else{
        $databulan->modify('-1 month');
        $bln    = $databulan->format('Y-m');
    }
    
    $dt         = DB::table('trx_employe_loan')->select('trx_employe_loan.*', 'b.name', 'b.npk', 'b.id as id_kry')
        ->leftJoin('mst_karyawan AS b', 'b.id', '=', 'trx_employe_loan.id_karyawan')
        ->where('trx_employe_loan.id', $id)
        ->where('trx_employe_loan.is_active', 1)->first();

    $listdata    = json_decode($dt->list_pembayaran);


    $arr        = [];
    $no         = 1;
    foreach($listdata as $key => $val){
        if($val->bulan <= $bln){
            $arr[$key]['no']            = $no++;
            $arr[$key]['thnbulan']      = convertToIndonesianMonth($val->bulan);
            $arr[$key]['nominalloan']   = number_format($val->nominal, 0, ',', '.');
            $arr[$key]['nominalterbayarkan']    = number_format($val->terbayarkan, 0, ',', '.');
            $arr[$key]['nominalsisa']   = number_format($val->sisa, 0, ',', '.');
        }
    }

    return $arr;
}

function actionpelunasanloan($id,$bulan,$nominal){
    $data               = collect(\DB::select("SELECT * FROM trx_employe_loan WHERE id='$id'"))->first();
    $listpembayaran     = json_decode($data->list_pembayaran);
    $list  = '';
    foreach($listpembayaran as $dt => $pem){
        if($pem->bulan <= $bulan){
            if($pem->bulan == $bulan){
                $list .= '{"bulan": "'.$pem->bulan.'","jml": "1","nominal": "'.$nominal.'","terbayarkan": "'.$data->nominal_loan.'","sisa": "0"},';
            }else{
                $list .= '{"bulan": "'.$pem->bulan.'","jml": "'.$pem->jml.'","nominal": "'.$pem->nominal.'","terbayarkan": "'.$pem->terbayarkan.'","sisa": "'.$pem->sisa.'"},';
            }
        }
    }

    $arr  = '['.substr($list, 0, -1).']';

    DB::table('trx_employe_loan')->where('id', $id)->update(['list_pembayaran'=>$arr]);
    // return json_decode($arr);
    // return response('success');
}

function showdatapelunasanloan($id,$bulan){
    $currentDate    = new DateTime($bulan);
    $currentDate->modify('-1 month');
    $newDate        = $currentDate->format('Y-m');

    $loan               = collect(\DB::select("SELECT * FROM trx_employe_loan WHERE id='$id'"))->first();
    $listpembayaran     = json_decode($loan->list_pembayaran);
    $lunas              = 0;
    foreach($listpembayaran as $list => $pem){
        if($pem->bulan == $newDate){
            $lunas  = $pem->sisa;
        }
    }

    $arr['nominallunas']    = 'Rp ' . number_format($lunas, 0, ',', '.');
    $arr['lunas']           = $lunas;
    return $arr;
}


?>
