@extends('layouts.dash')

@section('title', 'Orders')

@section('head-script')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-tag-multiple"></i>
        </span>
        Orders
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/home">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Orders</li>
        </ol>
    </nav>
</div>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">List Orders</h4>
                <p class="card-description"> All <code>orders</code> available here
                </p>
                <table class="table table-hover" id="dtt">
                    <thead>
                        <tr>
                            <th> No. </th>
                            <th> Kasir_Name </th>
                            <th> Customer_Name </th>
                            <th> Date </th>
                            <th> Total </th>
                            <th> Actions </th>
                        </tr>
                    </thead>
                    @php
                    $no = 1;
                    @endphp
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td> {{ $no++ }} </td>
                            <td> {{ $order->user->name }} </td>
                            <td> {{ $order->customer_name }} </td>
                            <td> {{ $order->created_at }} </td>
                            <td> {{ $order->total }} </td>
                            <td>
                                <a href="{{ route('admin.orders.edit', ['order' => $order->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form class="d-inline-block" action="{{ route('admin.orders.destroy', $order->id) }}" method="post">
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