<?php

namespace App\Http\Controllers;

use App\Models\Makanan;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function index(Request $request)
    {   
        $items = $request->items ?? 10;

        return view('category.index',[
            "categories" => Category::latest()->filter(request(['search']))->paginate($items),
            "title"    => "Kategori Makanan",
            "active" => "category",
            "active2" => "",
            "items" => $items
        ]);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create',[
            "categories" => Category::all(),
            "title"    => "Kategori Makanan",
            "active"    => "category",
            "active2"    => "category"
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
            'nama_category' => 'required|max:255'
        ]);

        $validatedData['user_id']= auth()->user()->id;

        Category::create($validatedData);

        return redirect('/category')->with('berhasil','Kategori Baru Berhasil di Tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

        return view('category.edit',[
            "category"      => $category,
            "title"         => "Category",
            "active"        => "category",
            "active2"       => "category",
            "categories"    => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $rules =[
            'nama_category' => 'required|max:255',
        ];

        $validatedData = $request->validate($rules);
        Category::where('id', $category->id)->update($validatedData);

        return redirect('/category')->with('berhasil','Kategori Makanan Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Category::destroy($category->id);
        
        return redirect('/category')->with('berhasil', 'Postingan Berhasil di Hapus');
    }
}
