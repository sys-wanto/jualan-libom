<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kelurahan;
use Yajra\DataTables\DataTables;
use App\Http\Requests\KelurahanRequest;
use App\Http\Controllers\Controller;
use App\Models\Dati2;
use App\Models\Kecamatan;
use App\Models\Propinsi;
use Illuminate\Http\Request;
use stdClass;

class KelurahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    private $title = 'Kelurahan';
    public function index()
    {
        $data['title'] = $this->title;
        // echo route('admin.kelurahan.editnew', array('KD_PROPINSI' => '030', 'KD_KABUPATEN' => '030', 'KD_Kelurahan' => '030'));
        // die();
        if (request()->ajax()) {
            $query = Kelurahan::get();
            return DataTables::of($query)
                ->addColumn('action', function ($Kelurahan) {
                    // dd($Kelurahan->kd_Kelurahan_new);
                    return '
                        <a class="block w-full px-2 py-1 mb-1 text-xs text-center text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline" 
                            href="' . route('admin.kelurahan.editnew', array('KD_PROPINSI' => $Kelurahan->kd_propinsi_new, 'KD_KABUPATEN' => $Kelurahan->kd_dati2_new, 'KD_KECAMATAN' => $Kelurahan->kd_kecamatan_new, 'KD_KELURAHAN' => $Kelurahan->kd_Kelurahan_new)) . '">
                            Sunting
                        </a>
                        <form class="block w-full" onsubmit="return confirm(\'Apakah anda yakin?\');" -block" action="' . route('admin.kelurahan.deletetenew', array('KD_PROPINSI' => $Kelurahan->kd_propinsi_new, 'KD_KABUPATEN' => $Kelurahan->kd_dati2_new, 'KD_KECAMATAN' => $Kelurahan->kd_kecamatan_new, 'KD_KELURAHAN' => $Kelurahan->kd_Kelurahan_new)) . '" method="POST">
                        <button class="w-full px-2 py-1 text-xs text-white transition duration-500 bg-red-500 border border-red-500 rounded-md select-none ease hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                            Hapus
                        </button>
                            ' . method_field('delete') . csrf_field() . '
                        </form>';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('admin.kelurahan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View returned
     */
    public function create()
    {
        $data['title'] = $this->title;
        $data['action'] = "Tambah";
        $data_prov = [];
        // $data_prov?[0]->nm_propinsi = "Pilih Propinsi";
        $propinsi = Propinsi::get();
        // array_push($data_prov, $propinsi);
        $data['propinsi'] = $propinsi;

        // dd($data_prov);
        $dati2 = [];
        $dati2[] = new stdClass;
        $dati2[0]->kd_dati2_new = "";
        $dati2[0]->nm_propinsi = "Pilih Kabupaten";
        $data['dati2'] = $dati2;

        $kecamatan = [];
        $kecamatan[] = new stdClass;
        $kecamatan[0]->kd_kecamatan_new = "";
        $kecamatan[0]->nm_propinsi = "Pilih Kecamatan";
        $data['kecamatan'] = $kecamatan;
        // dd($data['propinsi']);

        return view('admin.kelurahan.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KelurahanRequest $request)
    {
        $data = $request->all();
        // dd($data);
        // $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

        Kelurahan::create($data);

        return redirect()->route('admin.kelurahan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelurahan  $Kelurahan
     * @return \Illuminate\Http\Response
     */
    public function show(Kelurahan $Kelurahan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelurahan  $Kelurahan
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(string $kd_propinsi, string $kd_dati2,string $kd_kecamatan, string $kd_Kelurahan)
    {
        $data = Kelurahan::where(['kd_propinsi' => $kd_propinsi, 'kd_dati2' => $kd_dati2,'kd_kecamatan'=>$kd_kecamatan, 'kd_Kelurahan' => $kd_Kelurahan])->get();
        // dd($data);
        $data['title'] = $this->title;
        $data['action'] = "Edit";
        if (count($data) > 0) {
            $data['Kelurahan'] = $data;
            $data_prov = [];
            $data_prov[] = new stdClass;
            $data_prov[0]->kd_propinsi = "";
            $data_prov[0]->nm_propinsi = "Pilih Propinsi";
            $propinsi = Propinsi::get();
            $data['propinsi'] = array_push($data_prov, $propinsi);
            return view('admin.kelurahan.edit', $data);
        } else {
            return view('admin.Kelurahan', $data);;
            // return $this->sendError(['Data Tidak Ditemukan']);
        }
    }

    public function edit_new(string $kd_propinsi, string $kd_dati2,string $kd_kecamatan, string $kd_Kelurahan)
    {
        $data['data'] = Kelurahan::where(['kd_propinsi' => $kd_propinsi, 'kd_dati2' => $kd_dati2,'kd_kecamatan'=>$kd_kecamatan, 'kd_Kelurahan' => $kd_Kelurahan])->firstOrFail();
        $data['title'] = $this->title;
        $data['action'] = "Edit";
        // dd($data['data']->count()) ;
        if ($data['data']->count() > 0) {
            $data['kelurahan'] = $data['data'];


            $data['propinsi'] = Propinsi::get();
            $data['dati2'] = Dati2::where('kd_propinsi', $data['data']->kd_propinsi_new)->get();
            $data['kecamatan'] = Kecamatan::where(['kd_propinsi' => $kd_propinsi, 'kd_dati2' => $kd_dati2,'kd_kecamatan'=>$kd_kecamatan])->get();

            return view('admin.kelurahan.edit', $data);;
        } else {
            return view('admin.Kelurahan', $data);;
            // return $this->sendError(['Data Tidak Ditemukan']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelurahan  $Kelurahan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelurahan $Kelurahan)
    {
        $data = $request->all();
        // $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

        $Kelurahan->update($data);

        return redirect()->route('admin.kelurahan.index');
    }

    public function update_new(Request $request, string $kd_propinsi, string $kd_dati2,string $kd_kecamatan, string $kd_Kelurahan)
    {
        $data['data'] = Kelurahan::where(['kd_propinsi' => $kd_propinsi, 'kd_dati2' => $kd_dati2,'kd_kecamatan'=>$kd_kecamatan, 'kd_Kelurahan' => $kd_Kelurahan])->firstOrFail();
        $data['title'] = $this->title;
        $data['action'] = "Edit";
        if ($data['data']->count() > 0) {
            // dd();
            // dd($request->all('nm_Kelurahan'));
            // dd($data['Kelurahan']);

            Kelurahan::where(['kd_propinsi' => $kd_propinsi, 'kd_dati2' => $kd_dati2,'kd_kecamatan'=>$kd_kecamatan, 'kd_Kelurahan' => $kd_Kelurahan])->update($request->all('nm_kelurahan'));
            // return view('admin.kelurahan.edit', $data);;
            return redirect()->route('admin.kelurahan.index');
        } else {
            return view('admin.kelurahan.', $data);;
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelurahan  $Kelurahan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelurahan $Kelurahan)
    {
        $Kelurahan->forceDelete();

        return redirect()->route('admin.kelurahan.index');
    }
    public function destroy_new(string $kd_propinsi, string $kd_dati2,string $kd_kecamatan, string $kd_Kelurahan)
    {
        $data['data'] = Kelurahan::where(['kd_propinsi' => $kd_propinsi, 'kd_dati2' => $kd_dati2,'kd_kecamatan'=>$kd_kecamatan, 'kd_Kelurahan' => $kd_Kelurahan])->firstOrFail();
        $data['title'] = $this->title;
        $data['action'] = "Edit";
        if ($data['data']->count() > 0) {
            Kelurahan::where(['kd_propinsi' => $kd_propinsi, 'kd_dati2' => $kd_dati2,'kd_kecamatan'=>$kd_kecamatan, 'kd_Kelurahan' => $kd_Kelurahan])->forceDelete();
            return redirect()->route('admin.kelurahan.index');
        } else {
            return view('admin.kelurahan.', $data);;
        }
    }
}
