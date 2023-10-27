<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dati2;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Dati2Request;
use App\Http\Controllers\Controller;
use App\Models\Propinsi;
use Illuminate\Http\Request;

class Dati2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    private $title = 'Kabupaten';
    public function index()
    {
        $data['title'] = $this->title;
        if (request()->ajax()) {
            $query = Dati2::get();

            // kd_Dati2
            // nm_Dati2
            return DataTables::of($query)
                ->addColumn('action', function ($Dati2) {
                    return '
                        <a class="block w-full px-2 py-1 mb-1 text-xs text-center text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline" 
                            href="' . route('admin.dati2.editnew', array('KD_PROPINSI' => $Dati2->kd_propinsi_new, 'KD_KABUPATEN' => $Dati2->kd_Dati2_new)) . '">
                            Sunting
                        </a>
                        <form class="block w-full" onsubmit="return confirm(\'Apakah anda yakin?\');" -block" action="' . route('admin.dati2.deletetenew', array('KD_PROPINSI' => $Dati2->kd_propinsi_new, 'KD_KABUPATEN' => $Dati2->kd_Dati2_new)) . '" method="POST">
                        <button class="w-full px-2 py-1 text-xs text-white transition duration-500 bg-red-500 border border-red-500 rounded-md select-none ease hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                            Hapus
                        </button>
                            ' . method_field('delete') . csrf_field() . '
                        </form>';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('admin.dati2.index', $data);
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
        $data['propinsi'] = Propinsi::get();
        // dd($data['propinsi']);

        return view('admin.dati2.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Dati2Request $request)
    {
        $data = $request->all();
        // dd($data);
        // $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

        Dati2::create($data);

        return redirect()->route('admin.dati2.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dati2  $Dati2
     * @return \Illuminate\Http\Response
     */
    public function show(Dati2 $Dati2)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dati2  $Dati2
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(string $kd_propinsi, string $kd_dati2)
    {
        $data = dati2::where(['kd_propinsi' => $kd_propinsi, 'kd_dati2' => $kd_dati2])->get();
        // dd($data);
        $data['title'] = $this->title;
        $data['action'] = "Edit";
        if (count($data) > 0) {
            $data['Dati2'] = $data;

            $data['propinsi'] = Propinsi::get();
            return view('admin.dati2.edit', $data);;
        } else {
            return view('admin.dati2', $data);;
            // return $this->sendError(['Data Tidak Ditemukan']);
        }
    }

    public function edit_new(string $kd_propinsi, string $kd_dati2)
    {
        $data['data'] = dati2::where(['kd_propinsi' => $kd_propinsi, 'kd_dati2' => $kd_dati2])->firstOrFail();
        $data['title'] = $this->title;
        $data['action'] = "Edit";
        // dd($data['data']->count()) ;
        if ($data['data']->count() > 0) {
            $data['Dati2'] = $data['data'];

            // dd($data['Dati2']);

            $data['propinsi'] = Propinsi::get();
            return view('admin.dati2.edit', $data);;
        } else {
            return view('admin.dati2', $data);;
            // return $this->sendError(['Data Tidak Ditemukan']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dati2  $Dati2
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dati2 $Dati2)
    {
        $data = $request->all();
        // $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

        $Dati2->update($data);

        return redirect()->route('admin.dati2.index');
    }

    public function update_new(Request $request, string $kd_propinsi, string $kd_dati2)
    {
        $data['data'] = dati2::where(['kd_propinsi' => $kd_propinsi, 'kd_dati2' => $kd_dati2])->firstOrFail();
        $data['title'] = $this->title;
        $data['action'] = "Edit";
        if ($data['data']->count() > 0) {
            // dd();
            dati2::where(['kd_propinsi' => $kd_propinsi, 'kd_dati2' => $kd_dati2])->update($request->all('nm_dati2'));
            // return view('admin.dati2.edit', $data);;
            return redirect()->route('admin.dati2.index');
        } else {
            return view('admin.dati2.', $data);;
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dati2  $Dati2
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dati2 $Dati2)
    {
        $Dati2->forceDelete();

        return redirect()->route('admin.dati2.index');
    }
    public function destroy_new(string $kd_propinsi, string $kd_dati2)
    {
        $data['data'] = dati2::where(['kd_propinsi' => $kd_propinsi, 'kd_dati2' => $kd_dati2])->firstOrFail();
        $data['title'] = $this->title;
        $data['action'] = "Edit";
        if ($data['data']->count() > 0) {
            dati2::where(['kd_propinsi' => $kd_propinsi, 'kd_dati2' => $kd_dati2])->forceDelete();
            return redirect()->route('admin.dati2.index');
        } else {
            return view('admin.dati2.', $data);;
        }
    }
}
