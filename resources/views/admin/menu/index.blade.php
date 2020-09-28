@extends('layouts.dash')

@section('title', 'Menus')

@section('head-script')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
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
            <li class="breadcrumb-item active" aria-current="page">Menus</li>
        </ol>
    </nav>
</div>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@elseif(session('update'))
    <div class="alert alert-info">
        {{ session('update') }}
    </div>
@elseif(session('delete'))
    <div class="alert alert-danger">
        {{ session('delete') }}
    </div>
@elseif(session('cant'))
    <div class="alert alert-warning">
        {{ session('cant') }}
    </div>
@endif
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">List Menus</h4>
                <p class="card-description"> All <code>menus</code> available here
                </p>
                <table class="table table-hover" id="dtt">
                    <thead>
                        <tr>
                            <th> No. </th>
                            <th> Menu Name </th>
                            <th> Status </th>
                            <th> Price </th>
                            {{-- <th> Details </th> --}}
                            <th> Actions </th>
                        </tr>
                    </thead>
                    @php
                    $no = 1;
                    @endphp
                    <tbody>
                        @foreach($menus as $menu)
                        <tr>
                            <td> {{ $no++ }} </td>
                            <td> {{ $menu->name }} </td>
                            <td> {{ $menu->stock > 0 ? 'active' : 'non-active' }} </td>
                            <td> {{ $menu->price }} </td>
                            {{-- <td> {{ $menu->image }} </td> --}}
                            <td>
                                <a href="{{ route('admin.menus.edit', ['menu' => $menu->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form class="d-inline-block" action="{{ route('admin.menus.destroy', $menu->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('end-script')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dtt').DataTable();
    });
</script>
@endsection