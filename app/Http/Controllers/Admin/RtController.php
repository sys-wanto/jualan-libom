<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rt;
use Yajra\DataTables\DataTables;
use App\Http\Requests\RtRequest;
use App\Http\Controllers\Controller;
use App\Models\Dati2;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Propinsi;
use Illuminate\Http\Request;
use stdClass;

class RtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    private $title = 'RT';
    public function index()
    {
        $data['title'] = $this->title;
        // echo route('admin.rt.editnew', array('KD_PROPINSI' => '030', 'KD_KABUPATEN' => '030', 'KD_Rt' => '030'));
        // die();
        if (request()->ajax()) {
            $query = Rt::get();
            return DataTables::of($query)
                ->addColumn('action', function ($Rt) {
                    // dd($Rt->kd_Rt_new);
                    return '
                        <a class="block w-full px-2 py-1 mb-1 text-xs text-center text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline" 
                            href="' . route('admin.rt.editnew', array('KD_PROPINSI' => $Rt->kd_propinsi_new, 'KD_KABUPATEN' => $Rt->kd_dati2_new, 'KD_KECAMATAN' => $Rt->kd_kecamatan_new, 'KD_KELURAHAN' => $Rt->kd_Kelurahan_new, 'KD_RT' => $Rt->kd_rt_new)) . '">
                            Sunting
                        </a>
                        <form class="block w-full" onsubmit="return confirm(\'Apakah anda yakin?\');" -block" action="' . route('admin.rt.deletetenew', array('KD_PROPINSI' => $Rt->kd_propinsi_new, 'KD_KABUPATEN' => $Rt->kd_dati2_new, 'KD_KECAMATAN' => $Rt->kd_kecamatan_new, 'KD_KELURAHAN' => $Rt->kd_Kelurahan_new, 'KD_RT' => $Rt->kd_rt_new)) . '" method="POST">
                        <button class="w-full px-2 py-1 text-xs text-white transition duration-500 bg-red-500 border border-red-500 rounded-md select-none ease hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                            Hapus
                        </button>
                            ' . method_field('delete') . csrf_field() . '
                        </form>';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('admin.rt.index', $data);
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

        $kelurahan = [];
        $kelurahan[] = new stdClass;
        $kelurahan[0]->kd_kelurahan_new = "";
        $kelurahan[0]->nm_propinsi = "Pilih Kelurahan";
        $data['kelurahan'] = $kelurahan;
        // dd($data['propinsi']);

        return view('admin.rt.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RtRequest $request)
    {
        $data = $request->all();
        // dd($data);
        // $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

        Rt::create($data);

        return redirect()->route('admin.rt.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rt  $Rt
     * @return \Illuminate\Http\Response
     */
    public function show(Rt $Rt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rt  $Rt
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(string $kd_propinsi, string $kd_dati2,string $kd_kecamatan, string $kd_Kelurahan, string $kd_Rt)
    {
        $data = Rt::where(['kd_propinsi' => $kd_propinsi, 'kd_dati2' => $kd_dati2,'kd_kecamatan'=>$kd_kecamatan, 'kd_Rt' => $kd_Rt])->get();
        // dd($data);
        $data['title'] = $this->title;
        $data['action'] = "Edit";
        if (count($data) > 0) {
            $data['Rt'] = $data;
            $data_prov = [];
            $data_prov[] = new stdClass;
            $data_prov[0]->kd_propinsi = "";
            $data_prov[0]->nm_propinsi = "Pilih Propinsi";
            $propinsi = Propinsi::get();
            $data['propinsi'] = array_push($data_prov, $propinsi);
            return view('admin.rt.edit', $data);
        } else {
            return view('admin.Rt', $data);;
            // return $this->sendError(['Data Tidak Ditemukan']);
        }
    }

    public function edit_new(string $kd_propinsi, string $kd_dati2,string $kd_kecamatan, string $kd_Kelurahan, string $kd_rt)
    {
        $data['data'] = Rt::where(['kd_propinsi' => $kd_propinsi, 'kd_dati2' => $kd_dati2,'kd_kecamatan'=>$kd_kecamatan,'kd_kelurahan'=> $kd_Kelurahan,'kd_Rt' => $kd_rt])->firstOrFail();
        $data['title'] = $this->title;
        $data['action'] = "Edit";
        // dd($data['data']->count()) ;
        if ($data['data']->count() > 0) {
            $data['rt'] = $data['data'];


            $data['propinsi'] = Propinsi::get();
            $data['dati2'] = Dati2::where('kd_propinsi', $data['data']->kd_propinsi_new)->get();
            $data['kecamatan'] = Kecamatan::where(['kd_propinsi' => $kd_propinsi, 'kd_dati2' => $kd_dati2])->get();
            $data['kelurahan'] = Kelurahan::where(['kd_propinsi' => $kd_propinsi, 'kd_dati2' => $kd_dati2,'kd_kecamatan'=>$kd_kecamatan])->get();

            return view('admin.rt.edit', $data);;
        } else {
            return view('admin.Rt', $data);;
            // return $this->sendError(['Data Tidak Ditemukan']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rt  $Rt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rt $Rt)
    {
        $data = $request->all();
        // $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

        $Rt->update($data);

        return redirect()->route('admin.rt.index');
    }

    public function update_new(Request $request, string $kd_propinsi, string $kd_dati2,string $kd_kecamatan, string $kd_Kelurahan, string $kd_rt)
    {
        $data['data'] = Rt::where(['kd_propinsi' => $kd_propinsi, 'kd_dati2' => $kd_dati2,'kd_kecamatan'=>$kd_kecamatan, 'kd_kelurahan'=> $kd_Kelurahan,'kd_Rt' => $kd_rt])->firstOrFail();
        $data['title'] = $this->title;
        $data['action'] = "Edit";
        if ($data['data']->count() > 0) {
            // dd();
            // dd($request->all('nm_Rt'));
            // dd($data['Rt']);

            Rt::where(['kd_propinsi' => $kd_propinsi, 'kd_dati2' => $kd_dati2,'kd_kecamatan'=>$kd_kecamatan, 'kd_kelurahan'=> $kd_Kelurahan,'kd_Rt' => $kd_rt])->update($request->all('nm_rt'));
            // return view('admin.rt.edit', $data);;
            return redirect()->route('admin.rt.index');
        } else {
            return view('admin.rt.', $data);;
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rt  $Rt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rt $Rt)
    {
        $Rt->forceDelete();

        return redirect()->route('admin.rt.index');
    }
    public function destroy_new( string $kd_propinsi, string $kd_dati2,string $kd_kecamatan, string $kd_Kelurahan, string $kd_rt)
    {
        $data['data'] = Rt::where(['kd_propinsi' => $kd_propinsi, 'kd_dati2' => $kd_dati2,'kd_kecamatan'=>$kd_kecamatan, 'kd_kelurahan'=> $kd_Kelurahan,'kd_Rt' => $kd_rt])->firstOrFail();
        $data['title'] = $this->title;
        $data['action'] = "Edit";
        if ($data['data']->count() > 0) {
            Rt::where(['kd_propinsi' => $kd_propinsi, 'kd_dati2' => $kd_dati2,'kd_kecamatan'=>$kd_kecamatan, 'kd_kelurahan'=> $kd_Kelurahan,'kd_Rt' => $kd_rt])->forceDelete();
            return redirect()->route('admin.rt.index');
        } else {
            return view('admin.rt.', $data);;
        }
    }
}
