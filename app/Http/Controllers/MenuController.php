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
        $this->ingre = new Ingredient;
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
        $ingredients = Ingredient::all();

        return view('admin.menu.create', compact('categories', 'ingredients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);

        $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required',
            'detail' => 'required',
            'photo' => 'required',
            'ingredient_id' => 'required',
            'qty' => 'required',
        ]);

        if ($request->photo) {
            $request = $this->uploadImage($request);
        }

        $menu = $this->model->create($request->all());

        for ($i = 0; $i < count($request->ingredient_id); $i++) {
            $menu->ingre_menus()->create([
                'ingredient_id' => $request->ingredient_id[$i],
                'qty' => $request->qty[$i],
            ]);
        }

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
        $menu = Menu::with('ingre_menus')->find($id);
        $ingredients = Ingredient::all();
        $categories = Category::all();

        // dd($menu->ingre_menus);

        return view('admin.menu.edit', compact('menu', 'ingredients', 'categories'));
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
            'category_id' => 'required',
            'detail' => 'required',
            'ingredient_id' => 'required',
            'qty' => 'required',
        ]);

        $menu = $this->model->find($id);
        $menu->ingre_menus()->delete();
        $menu->update($request->all());

        if ($request->photo) {
            $this->removeImage($menu->image);
            $request = $this->uploadImage($request);
        }


        for ($i = 0; $i < count($request->ingredient_id); $i++) {
            $menu->ingre_menus()->create([
                'ingredient_id' => $request->ingredient_id[$i],
                'qty' => $request->qty[$i],
            ]);
        }

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
        $model->ingre_menus()->delete();
        $model->delete();
        return redirect('/admin/menus');
    }

    public function uploadImage($request)
    {
        $img = $request->file('photo');
        $newName = time() . '.' . $img->getClientOriginalExtension();

        $img->move($this->imgPath, $newName);

        $request->merge([
            'image' => $newName,
        ]);

        return $request;
    }

    public function removeImage($img)
    {
        $fullPath = $this->imgPath . '/' . $img;

        if ($img && file_exists($fullPath)) {
            unlink($fullPath);
        }
    }
}
