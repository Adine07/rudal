<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    function __construct()
    {
        $this->model = new Menu;
        $this->imgPath = public_path('img');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = $this->model->all();

        return view('admin.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.menu.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required',
            'detail' => 'required',
            'image' => 'required',
        ]);

        Menu::create($request->all());

        return redirect('/admin/menus');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = $this->model->find($id);

        return view('admin.menu.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $this->model->find($id)->update($request->all());

        return redirect('/admin/menus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = $this->model->find($id);

        $model->delete();
        return redirect('/admin/categories');
    }

    public function uploadImage($img){
        $img = $request->file('photo');
        $newName = time() . '.' . $img->getClientOriginalExtension();

        $img->move($this->imgPath, $newName);

        $request->merge([
            'image' =>$newName,
        ]);

        return $request;
    }

    public function removeImage($img){
        $fullPath = $this->imgPath . '/' . $img;

        if ($img && file_exists($fullPath)){
            unlink($fullPath);
        }
    }
}
