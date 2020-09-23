@extends('layouts.dash')

@section('title', 'Create Menu')

@section('head-script')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
    integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
    crossorigin="anonymous" />
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-tag-multiple"></i>
        </span>
        Menus
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/home">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/menus">Menus</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body" x-data="ingre()" x-init="() => { initSelect() }">
                <h4 class="card-title">Create Menu</h4>
                <p class="card-description"> Create new <code>menu</code>
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

                <form action="/admin/menus" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control" value="{{ old('name') }}" name="name"
                                    placeholder="Menu name...">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control" name="category_id">
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="detail">Detail</label>
                                <textarea name="detail" id="detail">{{ old('detail') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Upload Image</label>
                                <input type="file" name="photo" value="{{ old('photo') }}" accept="image/*"
                                    class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled
                                        placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-primary"
                                            type="button">Browse</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title">Ingredients</h4>
                        </div>
                    </div>
                    <template x-for="(row, index) in rows" :key="row">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Ingredient
                                    </label>
                                    <select name="ingredient_id[]" class="select form-control"
                                        :class=" 'row' + index " x-model="row.ingredient_id" style="display:none">
                                        <option value="">-- Chose Ingredients --</option>
                                        @foreach($ingredients as $ingredient)
                                        <option value="{{ $ingredient->id }}">{{ $ingredient->ingredient_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Quantity / <span x-text="row.format"></span>
                                        <input type="number" x-model="row.qty" name="qty[]" class="form-control">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </template>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <button class="btn btn-sm btn-success" type="button" x-on:click="addRows">+ Tambah</button>
                                <button class="btn btn-sm btn-danger" type="button" x-on:click="removeRows">- Kurang</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="price">price</label>
                                <input type="text" id="price" class="form-control" value="{{ old('price') }}" name="price"
                                    placeholder="Menu price...">
                            </div>
                        </div>
                    </div>
                    <br>
                    <button class="btn btn-gradient-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('end-script')
{{-- Alpih js --}}
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.min.js" defer></script>


{{-- Select 2 --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
    integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
    crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="/ppadmin/assets/js/file-upload.js"></script>

<script>
    $(document).ready(function () {
        $('#detail').summernote();
    });

    function ingre() {
        const initialRow = {
            ingredient_id: null,
            qty: 0,
            format: null,
        };

        const ingredients = @json($ingredients);

        return {
            // Data

            rows: [Object.assign({}, initialRow)],

            initSelect() {
                $('.select').select2();

                this.rows.forEach((row, index) => {
                    $('.row' + index).on('select2:select', (e) => {
                        row.ingredient_id = e.target.value
                        this.setFormat(row.ingredient_id, index)
                    })
                })
            },

            addRows() {
                console.log("add");
                this.rows.push(Object.assign({}, initialRow));
                this.$nextTick(() => {this.initSelect();})
            },

            removeRows() {
                console.log("remove");
                this.rows.pop();
            },

            setFormat(id, index) {
                const ingredient = ingredients.find(ingredient => ingredient.id == id);
                const result = ingredient && ingredient.format;

                this.rows[index].format = result;
            }
        }
    }

</script>
@endsection
