@php
    $isEdit = isset($order);
    $action = $isEdit ? route('admin.orders.update', $order->id) : route('admin.orders.store');
    $put = $isEdit ? method_field('PUT') : null;
@endphp

@extends('layouts.dash')

@section('title', 'Create Order')

@section('head-script')
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
        Orders
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/home">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/orders">Orders</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body" x-data="order()" x-init="() => { initSelect() }">
                <h4 class="card-title">Create Order</h4>
                <p class="card-description"> Create new <code>order</code>.
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
                <form action="{{ $action }}" method="post">
                    @csrf
                    {{ $put }}
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="name">Customer Name</label>
                                <input type="text" id="name" class="form-control" x-model="customer_name" value="{{ old('customer_name') }}"
                                    name="customer_name" placeholder="Customer name...">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <template x-for="(row, index) in rows" :key="row">
                        <div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label style="display:block">Menu</label>
                                        <select name="item_id[]" class="select" :class="'row' + index" x-model="row.item_id" style="display:none">
                                            <option value="">-- Pilih Menu --</option>
                                            @foreach($menus as $menu)
                                            <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input type="number" class="form-control" name="qty[]" x-model="row.qty" x-on:change="setSubtotal(index)">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Harga Satuan</label>
                                        <input type="number" class="form-control" name="price[]" x-model="row.price" readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Subtotal</label>
                                        <input type="number" class="form-control" name="subtotal[]" x-model="row.subtotal" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <button class="btn btn-sm btn-info" type="button" x-on:click="addRows">Tambah</button>
                                <button class="btn btn-sm btn-danger" type="button" x-on:click="removeRows">Kurang</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Total</label>
                                <input type="number" class="form-control" name="total" x-model="total" readonly>
                            </div>
                        </div>
                    </div>
                    <br>
                    <button class="btn btn-gradient-primary">{{ $isEdit ? 'Update' : 'Create' }}</button>
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

    function order() {
        const initialRow = {
            item_id: null,
            qty: 0,
            price: 0,
            subtotal: 0,
        };

        const menus = @json($menus);

        return {
            // Data

            @if($isEdit)
                rows: @json($order->order_details),
                total: {{ $order->total }},
                customer_name: '{{ $order->customer_name }}',
            @else
                rows: [Object.assign({}, initialRow)],
                total: 0,
                customer_name: '',
            @endif


            initSelect() {
                $('.select').select2();

                this.rows.forEach((row, index) => {
                    $('.row' + index).on('select2:select', (e) => {
                        row.item_id = e.target.value
                        this.setPrice(row.item_id, index)
                    })
                })
            },

            addRows() {
                this.rows.push(Object.assign({}, initialRow));
                this.$nextTick(() => {this.initSelect();})
            },

            removeRows() {
                this.rows.pop();
                this.setTotal();
            },

            setPrice(id, index) {
                    console.log(id);

                    const menu = menus.find(menu => menu.id == id);
                    const result = menu && menu.price;

                    this.rows[index].price = result;

                    this.setSubtotal(index);
                },

                setSubtotal(index) {
                    const row = this.rows[index];

                    if (row.price && row.qty) {
                        const result = row.price * row.qty;

                        row.subtotal = result;
                    }

                    this.setTotal();
                },

                setTotal() {
                    let result = 0;

                    if (this.rows.length > 1) {
                        result = this.rows.reduce((total, row) => (total + row.subtotal), 0);
                    } else if (this.rows.length == 1) {
                        result = this.rows[0].subtotal;
                    }

                    this.total = result;
                }
        }
    }

</script>
@endsection
