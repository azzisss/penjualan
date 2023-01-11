<?php

namespace App\Http\Controllers;

use App\Models\Makanan;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MakananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('makanan.index', [
            "makanans"      => Makanan::latest()->filter(request(['search', 'category', 'author']))->get(),
            "categories"    => Category::all(),
            "title"         => "Makanan",
            "active"        => "makanan",
            "col"           => 1,
            "col2"          => 1,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('makanan.create', [
            "categories"    => Category::all(),
            "title"         => "Makanan",
            "active"        => "makanan",
            "active2"       => "makanan",


        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_makanan'          => 'required|max:255',
            'keterangan_makanan'    => 'required|unique:makanans',
            'gambar'                => 'image|file|max:1024',
            'category_id'           => 'required',
            'harga_makanan'         => 'required'
        ]);

        if ($request->file('gambar')) {
            $validatedData['gambar'] = $request->file('gambar')->store('post-gambar');
        }

        $validatedData['user_id']   = auth()->user()->id;

        Makanan::create($validatedData);

        return redirect('/makanan')->with('berhasil', 'Makanan Baru Berhasil di Tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Makanan  $makanan
     * @return \Illuminate\Http\Response
     */
    public function show(Makanan $makanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Makanan  $makanan
     * @return \Illuminate\Http\Response
     */
    public function edit(Makanan $makanan)
    {
        return view('makanan.edit', [
            "makanan"       => $makanan,
            "categories"    => Category::all(),
            "title"         => "Makanan",
            "active"        => "makanan",
            "active2"        => "makanan",
            // dd($makanan)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Makanan  $makanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Makanan $makanan)
    {
        $rules = [
            'nama_makanan'          => 'required|max:255',
            'keterangan_makanan'    => 'required|max:255',
            'gambar'                => 'image|file|max:1024|nullable',
            'category_id'           => 'required',
            'harga_makanan'         => 'required'
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('gambar')) {
            if ($request->gambarlama) {
                Storage::delete($request->gambarlama);
            }
            $validatedData['gambar'] = $request->file('gambar')->store('post-gambar');
        }
        Makanan::where('id', $makanan->id)->update($validatedData);

        return redirect('/makanan')->with('update', 'Data Makanan Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Makanan  $makanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Makanan $makanan)
    {
        if ($makanan->gambar) {
            Storage::delete($makanan->gambar);
        }
        Makanan::destroy($makanan->id);

        return redirect('/makanan')->with('hapus', 'Data Makanan Berhasil di Hapus');
    }
}
