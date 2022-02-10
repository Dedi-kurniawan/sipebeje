<li class="dropdown notification-list topbar-dropdown">
              <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                  <i class="fe-bell noti-icon"></i>
                  <span class="badge bg-danger rounded-circle noti-icon-badge">{{ $countnotifikasi }}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-lg">
                  <div class="dropdown-item noti-title">
                      <h5 class="m-0">
                          <span class="float-end">
                          </span>Notification
                      </h5>
                  </div>
  
                  <div class="noti-scroll" data-simplebar>
                    @forelse ($user->unreadNotifications->take(10) as $notification)
                        <a href="{{ route('admin.read.notif', $notification->id) }}" class="dropdown-item notify-item">
                            <div class="notify-icon bg-primary">
                                <i class="mdi mdi-comment-account-outline"></i>
                            </div>
                            <p class="notify-details">{{ $notification->data['notif'] }}
                                <small class="text-muted">{{ $notification->data['date'] }}</small>
                            </p>
                        </a>
                    @empty
                        <div class="d-flex flex-column font-weight-bold">
                            <span class="text-center">TIDAK ADA NOTIFIKASI</span>
                        </div>
                    @endforelse
                  </div>
  
                  <!-- All-->
                  {{-- <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                      View all
                      <i class="fe-arrow-right"></i>
                  </a> --}}
  
              </div>
            </li>