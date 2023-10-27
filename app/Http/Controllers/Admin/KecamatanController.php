<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kecamatan;
use Yajra\DataTables\DataTables;
use App\Http\Requests\KecamatanRequest;
use App\Http\Controllers\Controller;
use App\Models\Dati2;
use App\Models\Propinsi;
use Illuminate\Http\Request;
use stdClass;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    private $title = 'Kecamatan';
    public function index()
    {
        $data['title'] = $this->title;
        // echo route('admin.kecamatan.editnew', array('KD_PROPINSI' => '030', 'KD_KABUPATEN' => '030', 'KD_KECAMATAN' => '030'));
        // die();
        if (request()->ajax()) {
            $query = Kecamatan::get();
            // dd($query);
            // kd_Kecamatan
            // nm_Kecamatan
            return DataTables::of($query)
                ->addColumn('action', function ($Kecamatan) {
                    // dd($Kecamatan->kd_kecamatan_new);
                    return '
                        <a class="block w-full px-2 py-1 mb-1 text-xs text-center text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline" 
                            href="' . route('admin.kecamatan.editnew', array('KD_PROPINSI' => $Kecamatan->kd_propinsi_new, 'KD_KABUPATEN' => $Kecamatan->kd_dati2_new, 'KD_KECAMATAN' => $Kecamatan->kd_kecamatan_new)) . '">
                            Sunting
                        </a>
                        <form class="block w-full" onsubmit="return confirm(\'Apakah anda yakin?\');" -block" action="' . route('admin.kecamatan.deletetenew', array('KD_PROPINSI' => $Kecamatan->kd_propinsi_new, 'KD_KABUPATEN' => $Kecamatan->kd_dati2_new, 'KD_KECAMATAN' => $Kecamatan->kd_kecamatan_new)) . '" method="POST">
                        <button class="w-full px-2 py-1 text-xs text-white transition duration-500 bg-red-500 border border-red-500 rounded-md select-none ease hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                            Hapus
                        </button>
                            ' . method_field('delete') . csrf_field() . '
                        </form>';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('admin.kecamatan.index', $data);
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
        // dd($data['propinsi']);

        return view('admin.kecamatan.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KecamatanRequest $request)
    {
        $data = $request->all();
        // dd($data);
        // $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

        Kecamatan::create($data);

        return redirect()->route('admin.kecamatan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kecamatan  $Kecamatan
     * @return \Illuminate\Http\Response
     */
    public function show(Kecamatan $Kecamatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kecamatan  $Kecamatan
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(string $kd_propinsi, string $kd_dati2, string $kd_Kecamatan)
    {
        $data = Kecamatan::where(['kd_propinsi' => $kd_propinsi, 'kd_dati2' => $kd_dati2, 'kd_Kecamatan' => $kd_Kecamatan])->get();
        // dd($data);
        $data['title'] = $this->title;
        $data['action'] = "Edit";
        if (count($data) > 0) {
            $data['Kecamatan'] = $data;
            $data_prov = [];
            $data_prov[] = new stdClass;
            $data_prov[0]->kd_propinsi = "";
            $data_prov[0]->nm_propinsi = "Pilih Propinsi";
            $propinsi = Propinsi::get();
            $data['propinsi'] = array_push($data_prov, $propinsi);
            return view('admin.Kecamatan.edit', $data);
        } else {
            return view('admin.Kecamatan', $data);;
            // return $this->sendError(['Data Tidak Ditemukan']);
        }
    }

    public function edit_new(string $kd_propinsi, string $kd_dati2, string $kd_Kecamatan)
    {
        $data['data'] = Kecamatan::where(['kd_propinsi' => $kd_propinsi, 'kd_dati2' => $kd_dati2, 'kd_Kecamatan' => $kd_Kecamatan])->firstOrFail();
        $data['title'] = $this->title;
        $data['action'] = "Edit";
        // dd($data['data']->count()) ;
        if ($data['data']->count() > 0) {
            $data['kecamatan'] = $data['data'];

            // dd($data['Kecamatan']);

            $data['propinsi'] = Propinsi::get();
            $data['dati2'] = Dati2::where('kd_propinsi', $data['data']->kd_propinsi_new)->get();

            return view('admin.kecamatan.edit', $data);;
        } else {
            return view('admin.Kecamatan', $data);;
            // return $this->sendError(['Data Tidak Ditemukan']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kecamatan  $Kecamatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kecamatan $Kecamatan)
    {
        $data = $request->all();
        // $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

        $Kecamatan->update($data);

        return redirect()->route('admin.Kecamatan.index');
    }

    public function update_new(Request $request, string $kd_propinsi, string $dati2, string $kd_Kecamatan)
    {
        $data['data'] = Kecamatan::where(['kd_propinsi' => $kd_propinsi, 'kd_dati2' => $dati2, 'kd_Kecamatan' => $kd_Kecamatan])->firstOrFail();
        $data['title'] = $this->title;
        $data['action'] = "Edit";
        if ($data['data']->count() > 0) {
            // dd();
            // dd($request->all('nm_kecamatan'));
            Kecamatan::where(['kd_propinsi' => $kd_propinsi, 'kd_dati2' => $dati2, 'kd_Kecamatan' => $kd_Kecamatan])->update($request->all('nm_kecamatan'));
            // return view('admin.Kecamatan.edit', $data);;
            return redirect()->route('admin.kecamatan.index');
        } else {
            return view('admin.kecamatan.', $data);;
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kecamatan  $Kecamatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kecamatan $Kecamatan)
    {
        $Kecamatan->forceDelete();

        return redirect()->route('admin.kecamatan.index');
    }
    public function destroy_new(string $kd_propinsi, string $dati2, string $kd_Kecamatan)
    {
        $data['data'] = Kecamatan::where(['kd_propinsi' => $kd_propinsi, 'kd_dati2' => $dati2, 'kd_Kecamatan' => $kd_Kecamatan])->firstOrFail();
        $data['title'] = $this->title;
        $data['action'] = "Edit";
        if ($data['data']->count() > 0) {
            Kecamatan::where(['kd_propinsi' => $kd_propinsi, 'kd_dati2' => $dati2, 'kd_Kecamatan' => $kd_Kecamatan])->forceDelete();
            return redirect()->route('admin.kecamatan.index');
        } else {
            return view('admin.kecamatan.', $data);;
        }
    }
}
