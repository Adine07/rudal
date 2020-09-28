<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Menu;

class CategoryController extends Controller
{
    function __construct()
    {
        $this->model = new Category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->model->all();

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
        ]);

        $this->model->create($request->all());

        return redirect('/admin/categories')->with('status', 'Categori created success fully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->model->find($id);

        return view('admin.category.edit', compact('category'));
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

        return redirect('/admin/categories')->with('update', 'Categori updated success fully!');
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
        $b = Menu::all();
        $a = $b->where('category_id', $id);
        $a = $a->all();
        if ($a == []) {
            $model->delete();
            return redirect('/admin/categories')->with('delete', 'Categori deleted success fully!');
        } else {
            return redirect('/admin/categories')->with('cant', 'Categori used!');
        }
    }
}
