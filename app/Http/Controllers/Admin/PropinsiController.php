<?php

namespace App\Http\Controllers\Admin;

use App\Models\Propinsi;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use App\Http\Requests\PropinsiRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PropinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    private $title = 'Propinsi';
    public function index()
    {
        $data['title'] = $this->title;
        if (request()->ajax()) {
            $query = Propinsi::get();
            // dd($query);
            // kd_propinsi
            // nm_propinsi
            return DataTables::of($query)
                ->addColumn('action', function ($Propinsi) {
                    return '
                        <a class="block w-full px-2 py-1 mb-1 text-xs text-center text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline" 
                            href="' . route('admin.propinsi.edit', str_pad($Propinsi->kd_propinsi,2,"0",STR_PAD_LEFT)) . '">
                            Sunting
                        </a>
                        <form class="block w-full" onsubmit="return confirm(\'Apakah anda yakin?\');" -block" action="' . route('admin.propinsi.destroy', str_pad($Propinsi->kd_propinsi,2,"0",STR_PAD_LEFT)) . '" method="POST">
                        <button class="w-full px-2 py-1 text-xs text-white transition duration-500 bg-red-500 border border-red-500 rounded-md select-none ease hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                            Hapus
                        </button>
                            ' . method_field('delete') . csrf_field() . '
                        </form>';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('admin.propinsi.index',$data);
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
        
        return view('admin.propinsi.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropinsiRequest $request)
    {
        $data = $request->all();
        // $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

        Propinsi::create($data);

        return redirect()->route('admin.propinsi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Propinsi  $Propinsi
     * @return \Illuminate\Http\Response
     */
    public function show(Propinsi $Propinsi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Propinsi  $Propinsi
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Propinsi $Propinsi)
    {
        $data['Propinsi'] = $Propinsi;
        $data['title'] = $this->title;
        $data['action'] = "Edit";
        return view('admin.propinsi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Propinsi  $Propinsi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Propinsi $Propinsi)
    {
        $data = $request->all();
        // $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

        $Propinsi->update($data);

        return redirect()->route('admin.propinsi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Propinsi  $Propinsi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Propinsi $Propinsi)
    {
        $Propinsi->forceDelete();

        return redirect()->route('admin.propinsi.index');
    }
}
