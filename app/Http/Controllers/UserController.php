<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function index() {
        $negara = DB::table('negara')->get();
        return View('index', ['negara' => $negara]);
    }

    public function showFindTicket($from, $to, $dateFlight, $banyakOrang) {
        $dataPenerbangan = DB::table('jadwal')
                            ->where('Kota_Asal', $from)
                            ->where('Kota_Tujuan', $to)
                            ->where('Tanggal', $dateFlight)
                            ->get();

        return View('findticket', ['from' => $from, 
                                    'to' => $to, 
                                    'dateFlight' => $dateFlight, 
                                    'banyakOrang' => $banyakOrang,
                                    'dataPenerbangan' => $dataPenerbangan]);
    }

    public function filterJadwal(Request $request) {
        $awal= $request->awal;
        $tujuan= $request->tujuan;
        $tanggalPenerbangan= $request->tanggalPenerbangan;
        $banyakPenumpang= $request->banyakPenumpang;
        $airline= json_decode($request->airline);
        $depart= json_decode($request->depart);
        $arrive= json_decode($request->arrive);
        $duration= json_decode($request->duration);
        $pricePerPerson= json_decode($request->pricePerPerson);

        $airline = join("','", $airline);

        $sql = "SELECT * FROM Jadwal WHERE Kota_Asal='$awal' and Kota_Tujuan='$tujuan' and Tanggal='$tanggalPenerbangan'";
        
        if ($airline != "") {
            $sql .= " and Nama_Maskapai in ('$airline')";

        }

        if (!empty($depart)) {
            for ($i = 0; $i < count($depart); $i++) {
                if ($i == 0) {
                    $sql .= " and (Jam_Berangkat between " . "'" . $depart[$i][0] . "'" . " and " . "'" . $depart[$i][1] . "'";
                }
                else {
                    $sql .= " or Jam_Berangkat between " . "'" . $depart[$i][0] . "'" . " and " . "'" . $depart[$i][1] . "'";
                }

            }
            $sql .= ")";
        }

        if (!empty($arrive)) {
            for ($i = 0; $i < count($arrive); $i++) {
                if ($i == 0) {
                    $sql .= " and (Jam_Tiba between " . "'" . $arrive[$i][0] . "'" . " and " . "'" . $arrive[$i][1] . "'";
                }
                else {
                    $sql .= " or Jam_Tiba between " . "'" . $arrive[$i][0] . "'" . " and " . "'" . $arrive[$i][1] . "'";
                }

            }
            $sql .= ")";

        }

        if (!empty($duration)) {
            $sql .= " and (TIMESTAMPDIFF(MINUTE, Jam_Berangkat, Jam_Tiba) between " . $duration[0] * 60 . " and " . $duration[1] * 60 . ")";

        }

        if (!empty($pricePerPerson)) {
            $sql .= " and (Harga_Per_Orang between " . $pricePerPerson[0] . " and " . $pricePerPerson[1] . ")";
            
        }
        // dd($sql);
        $dataPenerbangan = DB::select($sql);
        // dd($dataPenerbangan);

        return $dataPenerbangan;
    }

    public function prebooking($noPenerbangan, $banyakPenumpang) {
        $dataPenerbangan = DB::table('jadwal')->where('No_Penerbangan', $noPenerbangan)->get();

        // dd($dataPenerbangan);

        return View('prebooking', ['noPenerbangan' => $noPenerbangan,
                                    'banyakPenumpang' => $banyakPenumpang,
                                    'dataPenerbangan' => $dataPenerbangan]);
    }
}
