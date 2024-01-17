<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="{{route('admin.dashboard')}}">
                        <img src="{{asset('images/logo/logo.png')}}" alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title divider-text">
                    <div class="divider">
                        <div class="divider-text">{{__('admin.menu')}}</div>
                    </div>
                </li>

                <li class="sidebar-item {{request()->routeIs('admin.dashboard') ? 'active' : ''}}">
                    <a href="{{route('admin.dashboard')}}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>{{__('admin.dashboard')}}</span>
                    </a>
                </li>

                <li class="sidebar-item {{request()->routeIs('admin.customers') ? 'active' : ''}}">
                    <a href="{{route('admin.customers.index')}}" class='sidebar-link'>
                        <i class="bi bi-people"></i>
                        <span>{{__('admin.customers')}}</span>
                    </a>
                </li>

                <li class="sidebar-item {{request()->routeIs('admin.categories') ? 'active' : ''}}">
                    <a href="{{route('admin.categories.index')}}" class='sidebar-link'>
                        <i class="bi bi-list"></i>
                        <span>{{__('admin.categories')}}</span>
                    </a>
                </li>

                <li class="sidebar-item {{request()->routeIs('admin.products.*') ? 'active' : ''}}">
                    <a href="{{route('admin.products.index')}}" class='sidebar-link'>
                        <i class="bi bi-shop"></i>
                        <span>{{__('admin.products')}}</span>
                    </a>
                </li>

                <li class="sidebar-item {{request()->routeIs('admin.users.*') ? 'active' : ''}}">
                    <a href="{{route('admin.users.index')}}" class='sidebar-link'>
                        <i class="bi bi-person-check-fill"></i>
                        <span>{{__('admin.users')}}</span>
                    </a>
                </li>

                <li class="sidebar-item has-sub {{request()->routeIs('admin.profile') ? 'active' : ''}}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-person-circle"></i>
                        <span>{{__('admin.my_account')}}</span>
                    </a>
                    <ul class="submenu {{request()->routeIs('admin.profile') ? 'active' : ''}}">
                        <li class="submenu-item {{request()->routeIs('admin.profile') ? 'active' : ''}}">
                            <a class="dropdown-item" href="{{route('admin.profile')}}">
                                <i class="icon-mid bi bi-person-check me-2"></i>
                                {{__('admin.profile')}}
                            </a>
                        </li>
                        <li class="submenu-item">
                            <a href="{{route('logout')}}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="icon-mid bi bi-box-arrow-left me-2"></i>
                                {{__('admin.logout')}}
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-title"></li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
