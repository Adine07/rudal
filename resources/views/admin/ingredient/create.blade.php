@extends('layouts.dash')

@section('title', 'Create Ingredient')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-tag-multiple"></i>
        </span>
        Ingredients
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/home">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/ingredients">Ingredients</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create ingredient</h4>
                <p class="card-description"> Create new <code>ingredient</code> for your menus.
                </p>
                <hr>
                @if($errors->any())
                <hr>
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <hr>
                @endif
                <form action="/admin/ingredients" method="post">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control" value="{{ old('ingredient_name') }}"
                                    name="ingredient_name" placeholder="Ingredient name...">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="format">Format ukuran</label>
                                <input type="text" id="format" class="form-control" name="format"
                                    value="{{ old('format') }}" placeholder="Ingredient format">
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-gradient-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
