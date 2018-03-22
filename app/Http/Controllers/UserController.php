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

    public function findTicket(Request $request) {
        // return redirect('/findticket')->with(['from' => $request->from,
        //                                 'to' => $request->to,
        //                                 'dateFlight' => $request->dateFlight,
        //                                 'banyakOrang' => $request->banyakOrang]);
        return url("/findticket/{$request->from}/{$request->to}/{$request->dateFlight}/{$request->banyakOrang}");
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
}
