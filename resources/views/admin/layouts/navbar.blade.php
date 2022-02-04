<div class="col-lg-6">
    <div class="app-header-right">
        <div class="header-dots">
            <div class="dropdown">
                <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown"
                    class="p-0 mr-2 btn btn-link">
                    <span class="icon-wrapper icon-wrapper-alt rounded-circle">
                        <span class="icon-wrapper-bg bg-danger"></span>
                        <i class="fa fa-bell"></i>
                        @php
                            if ($notification->unreadCount > 0) {
                                echo '<span class="badge badge-danger navbar-badge header-badge">' . $notification->unreadCount . '</span>';
                            } elseif ($notification->unreadCount > 99) {
                                echo '<span class="badge badge-danger navbar-badge header-badge">99+</span>';
                            } else {
                                echo '';
                            }
                        @endphp
                    </span>
                </button>
                <div tabindex="-1" role="menu" aria-hidden="true"
                    class="dropdown-menu-xl rm-pointers dropdown-menu dropdown-menu-right">
                    <div class="dropdown-menu-header mb-0">
                        <div class="dropdown-menu-header-inner bg-deep-blue">
                            <div class="menu-header-image opacity-1"
                                style="background-image: url('assets/images/dropdown-header/city3.jpg');"></div>
                            <div class="menu-header-content text-dark">
                                <h5 class="menu-header-title">Notifications</h5>
                                @if (count($notification) > 0)
                                            You have
                                            <b>{{ $notification->unreadCount }}</b> unread
                                            {{ $notification->unreadCount == 1 ? 'notification' : 'notifications' }}
                                        @else
                                            No New Notification
                                        @endif
                            </div>
                        </div>
                    </div>
                    <div class="scroll-area-sm">
                        <div class="scrollbar-container">
                            <div class="p-3">
                                <div class="dropdown-holder">

                                    @foreach ($notification as $noti)

                                        <div class="vertical-timeline-item vertical-timeline-element">
                                            <div>
                                                <span class="vertical-timeline-element-icon bounce-in">
                                                    <i class="badge badge-dot badge-dot-xl badge-success"> </i>
                                                </span>
                                                <div class="vertical-timeline-element-content bounce-in">
                                    {{-- <h4 class="timeline-title">All Hands Meeting</h4> --}}
                                    @php
                                        if(strpos($noti->title, ':') !== false){
                                            $notification_title = explode(':',$noti->title);
                                        }else {
                                            $notification_title = '';
                                        }

                                    @endphp

                                    <a href="javascript:void(0)"
                                                        class=" {{ $noti->read_flag == 0 ? 'unread' : 'read' }}"
                                                        onclick="readNotification('{{ $noti->id }}', '{{ $noti->route ? route($noti->route) : '' }}')">
                                                        <p>
                                                            @if ($notification_title !== '')
                                                                {{ $notification_title[0] }} <span class="text-info">{{ $notification_title[1] }}</span>
                                                            @else
                                                                {{ $noti->title }}
                                                            @endif

                                                            <span class="font-weight-bold">{{ getAsiaTime($noti->created_at) }}</span>
                                                        </p>
                                                    </a>

                                                    <span class="vertical-timeline-element-date"></span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-btn-lg pr-0">
            <div class="widget-content p-0">
                <div class="widget-content-wrapper">
                    <div class="widget-content-left header-user-info">
                        <div class="widget-heading"> {{ Auth::user()->first_name }}
                            {{ Auth::user()->last_name }}</div>
                        <div class="widget-subheading">
                            {{ Auth::user()->email }}
                        </div>
                    </div>
                    <div class="widget-content-left ml-3">
                        <div class="btn-group">
                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                class="p-0 btn">
                                {{-- <img width="42" class="rounded-circle"
                                    src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('frontend/assets/images/avatars/1.jpg') }}"
                                    alt=""> --}}
                                <i class="fa fa-angle-down ml-2 opacity-8"></i>
                            </a>
                            <div tabindex="-1" role="menu" aria-hidden="true"
                                class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
                                <div class="dropdown-menu-header">
                                    <div class="dropdown-menu-header-inner bg-info">
                                        <div class="menu-header-image opacity-2"
                                            style="background-image: url('{{ asset('frontend/assets/images/dropdown-header/city3.jpg') }}');">
                                        </div>
                                        <div class="menu-header-content text-left">
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper justify-content-between p-2">
                                                    {{-- <div class="widget-content-left mr-3">
                                                        <img width="42" class="rounded-circle"
                                                            src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('frontend/assets/images/avatars/1.jpg') }}"
                                                            alt="">
                                                    </div> --}}
                                                    <div class="widget-content-left">
                                                        <div class="widget-heading text-white">
                                                            {{ Auth::user()->first_name }}
                                                            {{ Auth::user()->last_name }}</div>
                                                        {{-- <div class="widget-subheading">{{ Auth::user()->email }}</div> --}}
                                                    </div>
                                                    <div class="widget-content-right mr-2">

                                                        <a class="btn-pill btn-shadow btn-shine btn btn-focus"
                                                            href="{{ route('logout') }}" onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                                                            {{ __('Logout') }}
                                                        </a>

                                                        <form id="logout-form" action="{{ route('logout') }}"
                                                            method="POST" class="d-none">
                                                            @csrf
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="scroll-area-xs" style="height: auto">
                                    <div>
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <p class="nav-link mb-0 pb-0"><b class="mr-2">Email:</b>{{ Auth::user()->email }} </p>
                                                <p class="nav-link mb-0 pb-0"><b class="mr-2">Department:</b>{{ Auth::user()->role['name'] }}</p>
                                                <p class="nav-link mb-0 pb-0"><b class="mr-2">Id:</b>{{ Auth::user()->id_no }}</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
