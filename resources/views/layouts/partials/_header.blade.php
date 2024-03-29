<header class="header fixed-top">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-between">
            <div class="col-2">
                <!-- Header Menu -->
                <div class="header-toogle-menu">
                    <button class="toggle-menu-button aside-toggle border-0 bg-transparent p-0 dark-color">
                        <span class="material-icons">menu</span>
                    </button>
                </div>
                <!-- End Header Menu -->
            </div>
            <div class="col-10">
                <!-- Header Right -->
                <div class="header-right">
                    <ul class="nav justify-content-end align-items-center gap-30">
                    
                        <li>
                            <!-- Header Messages chat -->
                            {{-- <div class="messages">

                                <a href="" class="header-icon count-btn">
                                    <span class="material-icons">sms</span>
                                    <span class="count" id="message_count">0</span>
                                </a>
                            </div> --}}
                            <!-- End Main Header Messages -->
                        </li>
                        <li>
                            <!-- User -->
                            <div class="user mt-n1">
                                <a href="#" class="header-icon user-icon" data-bs-toggle="dropdown">
                                    <img width="30" height="30"
                                         src="{{asset('storage/app/public/user/profile_image')}}/{{ auth()->user()->profile_image ??"" }}"
                                         onerror="this.src='{{asset('public/assets')}}/img/user2x.png'"
                                         class="rounded-circle" alt="">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="#"
                                       class="dropdown-item-text media gap-3 align-items-center">
                                  
                                        <div class="media-body ">
                                            <h5 class="card-title">{{ Str::limit(auth()->user()->name??'admin', 20) }}</h5>
                                            <span class="card-text">{{ Str::limit(auth()->user()->email??'admin@admin.com', 20) }}</span>
                                        </div>
                                    </a>
                         
                                    <a class="dropdown-item" href="{{route('auth.logout')}}">
                                        <span class="text-truncate" title="Sign Out">Sign Out</span>
                                    </a>
                                </div>
                            </div>
                            <!-- End User -->
                        </li>
                    </ul>
                </div>
                <!-- End Header Right -->
            </div>
        </div>
    </div>
</header>
