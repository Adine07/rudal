<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\IngredientMenu;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    function __construct()
    {
        $this->model = new Ingredient;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = $this->model->all();

        return view('admin.ingredient.index', compact('ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ingredient.create');
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
            'ingredient_name' => 'required',
            'stock' => 'required',
            'format' => 'required',
        ]);

        $this->model->create($request->all());

        return redirect('/admin/ingredients');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ingredient = $this->model->find($id);

        return view('admin.ingredient.edit', compact('ingredient'));
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
            'ingredient_name' => 'required',
            'stock' => 'required',
            'format' => 'required',
        ]);

        $this->model->find($id)->update($request->all());

        return redirect('/admin/ingredients');
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
        $b = IngredientMenu::all();
        $a = $b->where('ingredient_id', $id);
        $a = $a->all();
        if ($a == []) {
            $model->delete();
            return redirect('/admin/ingredients');
        } else {
            return redirect('/admin/ingredients');
        }
    }
}
