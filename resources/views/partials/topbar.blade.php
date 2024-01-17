<header>
    <nav class="navbar navbar-expand navbar-light ">
        <div class="container-fluid">
            <a href="javascript:void(0)" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown me-3">
                        <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            <i class="fas fa-language fa-2x"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="dropdownMenuButton">
                            <li>
                                <h6 class="dropdown-header">{{__('admin.language')}}</h6>
                            </li>
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li>
                                    <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                       class="dropdown-item">{{$properties['native']}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-gray-600">{{Auth::user()->name}}</h6>
                                <p class="mb-0 text-sm text-gray-600">{{__('admin.admin')}}</p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <img src="{{asset('images/faces/'.rand(1,8).'.jpg')}}">
                                </div>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <li>
                            <a class="dropdown-item" href="{{route('admin.profile')}}">
                                <i class="icon-mid bi bi-person me-2"></i>
                                {{__('admin.profile')}}
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{route('logout')}}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="icon-mid bi bi-box-arrow-left me-2"></i>
                                {{__('admin.logout')}}
                            </a>
                            <form id="logout-form" action="{{route('logout')}}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
