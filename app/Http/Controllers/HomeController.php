<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kriteria;
use App\Models\Alternatif;
use Illuminate\Http\Request;
use App\Http\Controllers\MabacController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $alt = Alternatif::all();
        $krit = Kriteria::all();
        $users = User::count();

        $widget = [
            'users' => $users,
            //...
        ];

        // Buat objek MabacController
        $mabacController = new MabacController();

        // Panggil fungsi index
        $result = $mabacController->index();

        // Ambil nilai peringkat dari hasil pemanggilan
        if (isset($result['ranking']) && !empty($result['ranking'])) {
            $ranking = $result['ranking'];
        } else {
            $ranking = []; // Atau bisa juga menggunakan null tergantung kebutuhan
        }
        $jmlhberhak = $mabacController->jumlahberhak($ranking);
        
        $alternatifNames = Alternatif::pluck('nama_alternatif', 'id')->toArray();


        return view('home', compact('widget','alt','krit','ranking','alternatifNames', 'jmlhberhak'));
    }
}
