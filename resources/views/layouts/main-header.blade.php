        <!--=================================
 header start-->
        <nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <!-- logo -->
            <div class="text-left navbar-brand-wrapper">
                <a class="navbar-brand brand-logo" href="index.html"><img src="assets/images/logo-dark.png" alt=""></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-icon-dark.png"
                        alt=""></a>
            </div>

            <!-- top bar right -->
            <ul class="nav navbar-nav ml-auto">
                <!--localization AR and EN-->
                <div class="btn-group mb-1">
                    <button type="button" class="btn btn-light btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if (App::getLocale() == 'ar')
                            {{ LaravelLocalization::getCurrentLocaleName() }}
                            <img src="{{ URL::asset('assets/images/flags/EG.png') }}" alt="">
                        @else
                            {{ LaravelLocalization::getCurrentLocaleName() }}
                            <img src="{{ URL::asset('assets/images/flags/US.png') }}" alt="">
                        @endif
                    </button>
                    <div class="dropdown-menu">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
                <!--End localization AR and EN-->

                <li class="nav-item fullscreen">
                    <a id="btnFullscreen" href="#" class="nav-link"><i class="ti-fullscreen"></i></a>
                </li>
                <li class="nav-item dropdown mr-30">
                    <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="assets/images/profile-avatar.jpg" alt="avatar">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header">
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-0">{{Auth::User()->name}}</h5>
                                    <span>{{Auth::User()->email}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="text-danger ti-unlock"></i>Logout</a>
                        <form id = "logout-form" action="{{route("logout")}}" method="POST" style="display:none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>

        <!--=================================
 header End-->
