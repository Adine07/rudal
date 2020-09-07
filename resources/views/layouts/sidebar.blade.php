<?php

$dashboard = [
    'title' => 'Dashboard',
    'url' => '/admin/home',
    'icon' => 'mdi-home',
    'model' => App\Models\Home::class,
];

$categories = [
    'title' => 'Categories',
    'url' => '',
    'icon' => 'mdi-tag-multiple',
    'model' => App\Models\Category::class,
    'childerns' => [
        [
            'title' => 'List Categories',
            'url' => '/admin/categories',
        ],
        [
            'title' => 'Create Category',
            'url' => '/admin/categories/create',
        ],
    ]
];

$menu = [
    'title' => 'Menus',
    'url' => '',
    'icon' => 'mdi-view-list',
    'model' => App\Models\Menu::class,
    'childerns' => [
        [
            'title' => 'List Menus',
            'url' => '/admin/menu',
        ],
        [
            'title' => 'Create Menu',
            'url' => '/admin/menu/create',
        ],
    ]
];

$ingredients = [
    'title' => 'Ingredients',
    'url' => '',
    'icon' => 'mdi-nutrition',
    'model' => App\Models\Ingredient::class,
    'childerns' => [
        [
            'title' => 'List Ingredients',
            'url' => '/admin/ingredients',
        ],
        [
            'title' => 'Create Ingredients',
            'url' => '/admin/ingredients/create',
        ],
    ]
];

$order = [
    'title' => 'Order',
    'url' => '',
    'icon' => 'mdi mdi-cart',
    'model' => App\Models\Order::class,
    'childerns' => [
        [
            'title' => 'List Orders',
            'url' => '/admin/orders',
        ],
        [
            'title' => 'Create Order',
            'url' => '/admin/orders/create',
        ],
    ]
];

$users = [
    'title' => 'Users',
    'url' => '',
    'icon' => ' mdi mdi-account-box ',
    'model' => App\Models\User::class,
    'childerns' => [
        [
            'title' => 'List Users',
            'url' => '/admin/users',
        ],
        [
            'title' => 'Create User',
            'url' => '/admin/users/create',
        ],
    ]
];

$menus = [$dashboard, $categories, $menu, $ingredients, $order, $users];

$currentPath = '/' . request()->path();

?>

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="/ppadmin/assets/images/faces/face1.jpg" alt="profile" />
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">{{ auth()->user()->name }}</span>
                    <span class="text-secondary text-small">Rolenya</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>
        @foreach($menus as $index => $menu)

        @if(isset($menu['childerns']))

        <?php
        $isActive = false;
        foreach ($menu['childerns'] as $childern) {
            if ($childern['url'] == $currentPath) {
                $isActive = true;
            }
        }
        ?>

        <li class="nav-item {{ $isActive ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#menu{{ $index }}" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">{{ $menu['title'] }}</span>
                <i class="menu-arrow"></i>
                <i class="mdi {{ $menu['icon'] }} menu-icon"></i>
            </a>
            <div class="collapse {{ $isActive ? 'show' : '' }}" id="menu{{ $index }}">
                <ul class="nav flex-column sub-menu">
                    @foreach($menu['childerns'] as $childern)
                    <li class="nav-item">
                        <a class="nav-link {{ $childern['url'] === $currentPath ? 'active' : '' }}" href="{{ $childern['url'] }}">{{ $childern['title'] }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </li>
        @else
        <li class="nav-item {{ $menu['url'] ==  $currentPath ? 'active' : '' }}">
            <a class="nav-link" href="{{$menu['url']}}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi {{ $menu['icon'] }} menu-icon"></i>
            </a>
        </li>
        @endif

        @endforeach
    </ul>
</nav>