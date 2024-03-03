<?php

namespace App\Http\Controllers;

use App\Models\Chef;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ChefController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Chef::orderBy('id','desc')->paginate(4);
        return view('admin.Chef.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Chef.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'image' => 'required',
            'specialiti' => 'required',
        ]);

        $imageName = $request->file('image')->hashName();
        $data['image'] = $imageName;
        $chefDirectory = public_path() . '/asset-gambar';
        $request->file('image')->move($chefDirectory, $imageName);

        Chef::create($data);

        return redirect('/chef')->with('success', 'Data Berhasil Diinput');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data=Chef::where('id',$id)->first();
        return view('admin.Chef.edit')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'image' => 'required',
            'specialiti' => 'required',
        ]);

        $chefs = chef::find($id);

        File::delete(public_path() . "/asset-gambar/$chefs->gambar");

        $imageName = $request->file('image')->hashName();
        $data['image'] = $imageName;
        $chefDirectory = public_path() . '/asset-gambar';
        $request->file('image')->move($chefDirectory, $imageName);
        $chefs->update($data);

        

        return redirect('/chef')->with('success', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $chefs = chef::find($id);

        File::delete(public_path() . "/asset-gambar/$chefs->gambar");
        
        $chefs->delete();

        return redirect('/chef')->with('success', 'Data Berhasil Dihapus');
        
    }
}
