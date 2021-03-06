@extends('layouts.dash')

@section('title', 'Dashboard')

@section('head-script')
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-home"></i>
        </span>
        Dashboard
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
</div>
<div class="row">
    <div class="col stretch-card grid-margin">
        <div class="card bg-gradient-info card-img-holder text-white">
            <div class="card-body">
                <img src="/ppadmin/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">All Orders <i
                        class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5">{{ count(DB::table('orders')->get()) }}</h2>
                <h6 class="card-text">live time update</h6>
            </div>
        </div>
    </div>
    <div class="col-md-5 stretch-card grid-margin">
        <div class="card bg-gradient-success card-img-holder text-white">
            <div class="card-body">
                <img src="/ppadmin/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Number of items <i class="mdi mdi-diamond mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5">{{ count(DB::table('menus')->get()) }}</h2>
                <h6 class="card-text">live time update</h6>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="clearfix">
                    <h4 class="card-title float-left">Stock and Items Sold</h4>
                    <div id="daysold-legend"
                        class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                </div>
                <div style="height: 30vh;" id="daysold" class="mt-4"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('end-script')
<!-- Charting library -->
<script src="https://unpkg.com/chart.js@2.9.3/dist/Chart.min.js"></script>
<!-- Chartisan -->
<script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>
<script>
    @php
        $menus = DB::table('menus')->get();
        $categories = DB::table('categories')->get();
        // dd($menustock);
    @endphp

    var chart = new Chartisan({
        el: '#daysold',
        data:{
            chart:{
                labels:[
                    @foreach ($menus as $menu )
                        '{{ $menu->name }}',
                    @endforeach
                ]
            },
            datasets:[
                { name: 'Item Stock', values: [@foreach ($menus as $menu) {{$menu->stock}}, @endforeach]},
                { name: 'Item Sold', values: [@foreach ($menus as $menu) {{$menu->sold}}, @endforeach]},
            ]
        },
        hooks: new ChartisanHooks()
            .beginAtZero()
            .colors(),
    })
</script>
@endsection
