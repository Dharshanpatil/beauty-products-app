<?php

?>

<aside class="aside">
    <!-- Aside Header -->
    <div class="aside-header">
        <!-- Aside Toggle Menu Button -->
        <button class="toggle-menu-button aside-toggle border-0 bg-transparent p-0 bgwhite">
            <span class="material-icons">menu</span>
        </button>
        <!-- End Aside Toggle Menu Button -->
    </div>
    <!-- End Aside Header -->

    <!-- Aside Body -->
    <div class="aside-body" data-trigger="scrollbar">


        <!-- Nav -->
        <ul class="nav">
            <li class="nav-category bgwhite">main</li>
            <li>
                <a href="{{route('admin.dashboard')}}" class="{{request()->is('admin/dashboard')?'active-menu':''}}">
                    <span class="material-icons" title="dashboard">dashboard</span>
                    <span class="link-title">dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{route('admin.category')}}" class="{{request()->is('admin/category')?'active-menu':''}}">
                    <span class="material-icons" title="category">category</span>
                    <span class="link-title">category</span>
                </a>
            </li>
          
            <li>
                <a href="{{route('admin.sub-category')}}" class="{{request()->is('admin/dashboard')?'active-menu':''}}">
                    <span class="material-icons" title="category">category</span>
                    <span class="link-title">Sub category</span>
                </a>
            </li>

            <li>
                <a href="{{route('admin.products')}}" class="{{request()->is('admin/dashboard')?'active-menu':''}}">
                    <span class="material-icons" title="watch">watch</span>
                    <span class="link-title">Products</span>
                </a>
            </li>
             <li>
                <a href="{{route('admin.blogs')}}" class="{{request()->is('admin/dashboard')?'active-menu':''}}">
                    <span class="material-icons" title="watch">watch</span>
                    <span class="link-title">Blogs</span>
                </a>
            </li>
                 <li>
                <a href="{{route('admin.users')}}" class="{{request()->is('admin/users')?'active-menu':''}}">
                    <span class="material-icons" title="user">chat</span>
                    <span class="link-title">Users</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.shops')}}" class="{{request()->is('admin/shops')?'active-menu':''}}">
                    <span class="material-icons" title="watch">shop</span>
                    <span class="link-title">Shops</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.requsts_shops')}}" class="{{request()->is('admin/requsts_shops')?'active-menu':''}}">
                    <span class="material-icons" title="watch">shop</span>
                    <span class="link-title">Shop Requsts</span>
                </a>
            </li>

{{-- 
                <li>
                    <a href="{{route('admin.employee.index')}}"
                       class="{{request()->is('admin/employee/list')?'active-menu':''}}">
                        <span class="material-icons" title="{{translate('employee_list')}}">list</span>
                        <span class="link-title">{{translate('employee list')}}</span>
                    </a>
                </li> --}}


            </ul>

        

        </ul>
        <!-- End Nav -->
    </div>
    <!-- End Aside Body -->
</aside>
