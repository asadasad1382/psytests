<li class="nav-item dropdown dropdown-notification me-25">
    <a class="nav-link dropdown-toggle dropdown-notification-link" href="#"
       data-bs-toggle="dropdown"
       aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-bell"></i>
        <span
            class="badge rounded-pill bg-{{$notificationCount > 0 ? 'danger' : 'success'}} badge-up">{{$notificationCount}}</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
        <li class="dropdown-menu-header">
            <div class="dropdown-header d-flex">
                <h4 class="notification-title mb-0 me-auto">@lang('global.notifications')</h4>
                <div class="badge rounded-pill badge-light-primary">{{$notificationCount}} @lang('global.new')</div>
            </div>
        </li>
        <li class="scrollable-container media-list">
            @foreach($unreadNotifications as $notification)
                <a class="d-flex"
                   href="{{url($notification->data['url'])}}">
                    <div class="list-item d-flex align-items-start">
                        <div class="me-1">
                            <div class="avatar bg-light-danger">
                                <div class="avatar-content">
                                    <i class="feather icon-check-circle font-medium-5 warning"></i>
                                </div>
                            </div>
                        </div>
                        <div class="list-item-body flex-grow-1">
                            <p class="media-heading">
                                <span class="fw-bolder">{{$notification->data['subject']}}</span>
                            </p>
                            <small class="notification-text">{{$notification->data['message']}}</small>
                        </div>
                        <small>
                            <time class="media-meta"
                                  datetime="2015-06-11T18:29:20+08:00">
                                {{\Morilog\Jalali\Jalalian::forge($notification->created_at)->ago()}}
                            </time>
                        </small>
                    </div>
                </a>
            @endforeach
        </li>
        <li class="dropdown-menu-footer">
            <a class="btn btn-primary w-100"
               href="javascript:void(0)" wire:click="markAll">
                <i class="fa-light fa-check-double"></i>
                @lang('global.mark all as read')
            </a>
        </li>
    </ul>
</li>
