@extends('layouts.dash')

@section('title', 'Edit User')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-tag-multiple"></i>
        </span>
        Users
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/home">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/users">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit User</h4>
                <p class="card-description"> Edit new <code>user.</code>
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
                <form action="{{ route('admin.users.update', $user->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control" value="{{ old('name', $user->name) }}" name="name" placeholder="User name...">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Role</label>
                                <select name="role" class="form-control">
                                    <option>-- Select user Role --</option>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="operator" {{ $user->role == 'operator' ? 'selected' : '' }}>Operator</option>
                                    <option value="kasir" {{ $user->role == 'kasir' ? 'selected' : '' }}>Kasir</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="email">E-Mail</label>
                                <input type="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" name="email" placeholder="User email...">
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-gradient-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection