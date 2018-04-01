<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pemesanan;
use App\PemesananDetail;

class UserController extends Controller
{
    //
    public function index() {
        $negara = DB::table('negara')->get();
        return View('index', ['negara' => $negara]);
    }

    public function showFindTicket(Request $request) {
        $from = $request->input('from');
        $to = $request->input('to');
        $dateFlight = $request->input('dateFlight');
        $banyakOrang = $request->input('banyakOrang');

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

    public function prebooking(Request $request) {
        $noPenerbangan = $request->input('noPenerbangan');
        $banyakPenumpang = $request->input('banyakPenumpang');

        $dataPenerbangan = DB::table('jadwal')->where('No_Penerbangan', $noPenerbangan)->get();

        // dd($dataPenerbangan);

        return View('prebooking', ['banyakPenumpang' => $banyakPenumpang,
                                    'dataPenerbangan' => $dataPenerbangan]);
    }

    public function booking(Request $request) {
        $noPenerbangan = $request->input('noPenerbangan');
        $banyakPenumpang = $request->input('banyakPenumpang');

        $dataPenerbangan = DB::table('jadwal')->where('No_Penerbangan', $noPenerbangan)->get();

        // dd($dataPenerbangan);

        return View('booking', ['banyakPenumpang' => $banyakPenumpang,
                                    'dataPenerbangan' => $dataPenerbangan]);
    }

    public function payment(Request $request) {
        $noPenerbangan = $request->input('noPenerbangan');
        $banyakPenumpang = $request->input('banyakPenumpang');

        $dataPenerbangan = DB::table('jadwal')->where('No_Penerbangan', $noPenerbangan)->get();

        $contactDetailsFullName = $request->input('contactDetailsFullName');
        $contactDetailsMobileNumber = $request->input('contactDetailsMobileNumber');
        $contactDetailsEmail = $request->input('contactDetailsEmail');
        $travelerDetailsTitle = $request->input('travelerDetailsTitle');
        $travelerDetailsFullName = $request->input('travelerDetailsFullName');

        $pemesanan = new Pemesanan();
        $pemesanan->Nama_Pemesan = $contactDetailsFullName;
        $pemesanan->No_Handphone_Pemesan = $contactDetailsMobileNumber;
        $pemesanan->Email_Pemesan = $contactDetailsEmail;
        $pemesanan->Status_Pembayaran = 0;
        $pemesanan->No_Penerbangan = $noPenerbangan;
        $pemesanan->save();

        for($i = 0; $i < $banyakPenumpang; $i++) {
          $pemesananDetail = new PemesananDetail();
          $pemesananDetail->No_Pemesanan = $pemesanan->id;
          $pemesananDetail->Title_Penumpang = $travelerDetailsTitle[$i];
          $pemesananDetail->Nama_Penumpang = $travelerDetailsFullName[$i];
          $pemesananDetail->save();
        }

        return View('payment', ['noPemesanan' => $pemesanan->id,
                                'dataPenerbangan' => $dataPenerbangan,
                                'banyakPenumpang' => $request->input('banyakPenumpang'),
                                'travelerDetailsTitle' => $request->input('travelerDetailsTitle'),
                                'travelerDetailsFullName' => $request->input('travelerDetailsFullName')
        ]);
    }
}
