<nav
  class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
  id="layout-navbar"
>
  <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    <!-- Search -->
    <div class="navbar-nav align-items-center">
      <div class="nav-item d-flex align-items-center">
        <i class="bx bx-search fs-4 lh-0"></i>
        <input
          type="text"
          class="form-control border-0 shadow-none"
          placeholder="Search..."
          aria-label="Search..."
        />
      </div>
    </div>
    <!-- /Search -->

    <ul class="navbar-nav flex-row align-items-center ms-auto">
      <!-- Alerts -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
          <i class="bx bx-bell fs-4 lh-0"></i>
          <span class="badge bg-danger rounded-pill badge-notifications">3</span> <!-- Adjust the number as needed -->
        </a>
        <ul class="dropdown-menu dropdown-menu-end py-0">
          <li>
            <div class="dropdown-menu-header border-bottom">
              <div class="dropdown-header d-flex align-items-center py-3">
                <h5 class="text-body mb-0 me-auto">Notifications</h5>
                <a href="javascript:void(0)" class="dropdown-notifications-all text-body" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark all as read"><i class="bx fs-4 bx-envelope-open"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown-notifications-list scrollable-container">
            <ul class="list-group list-group-flush notification-container" >
              @foreach($notifications as $notification)
                <li class="list-group-item list-group-item-action dropdown-notifications-item">
                  <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                      <div class="avatar">
                        @if(!empty($notification->image))
                        <img src="{{ asset('storage/' . $notification->image) }}" alt="notification image" class="w-px-40 h-auto rounded-circle">
                    @endif
                    
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <h6 class="mb-1">{{ $notification->title }}</h6>
                      <p class="mb-0">{{ $notification->message }}</p>
                      <small class="text-muted">1h ago</small>
                    </div>
                    <div class="flex-shrink-0 dropdown-notifications-actions">
                      <a href="{{ $notification->link_url }}" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                      <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="bx bx-x"></span></a>
                    </div>
                  </div>
                </li>
              @endforeach
            </ul>
          </li>
          <li class="dropdown-menu-footer border-top">
            <a href="javascript:void(0);" class="dropdown-item d-flex justify-content-center p-3">
              View all notifications
            </a>
          </li>
        </ul>
      </li>
      <!-- /Alerts -->

      <!-- Theme Toggle -->
      <li class="nav-item lh-1 me-3">
        <button id="toggle-theme" class="toggle-btn me-2">
          <i class="fa-solid fa-sun"></i>
        </button>
      </li>

      <!-- User -->
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
          <div class="avatar avatar-online">
            <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <!-- User dropdown menu items... -->
        </ul>
      </li>
      <!--/ User -->
    </ul>
  </div>
</nav>
<style>
  .notification-container
  {
    width: 28rem;
    padding: 1rem 2rem;
  }
</style>