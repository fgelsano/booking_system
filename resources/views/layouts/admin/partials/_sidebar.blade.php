 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('assets/logo/sqr/bw-25.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Sea Vessel BOOKING</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!-- <img src="" class="img-circle elevation-2" alt="User Image"> -->
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ Route::currentRouteName() === 'dashboard' ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('bookings.index') }}" class="nav-link {{ Route::currentRouteName() === 'bookings.index' ? 'active' : '' }}">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Bookings
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('payments.index') }}" class="nav-link {{ Route::currentRouteName() === 'payments.index' ? 'active' : '' }}">
              <i class="nav-icon fas fa-credit-card"></i>
              <p>
                Payments
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('passengers.index') }}" class="nav-link {{ Route::currentRouteName() === 'passengers.index' ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Passengers
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('reports.index') }}" class="nav-link {{ Route::currentRouteName() === 'reports.index' ? 'active' : '' }}">
              <i class="nav-icon fas fa-print"></i>
              <p>
                Reports
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('schedules.index') }}" class="nav-link {{ Route::currentRouteName() === 'schedules.index' ? 'active' : '' }}">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Schedules
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item {{ Route::currentRouteName() === 'accomodations.index' ? 'active' : '' }}">
                <a href="{{ route('accomodations.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Accomodations</p>
                </a>
              </li>
              <li class="nav-item {{ Route::currentRouteName() === 'rates.index' ? 'active' : '' }}">
                <a href="{{ route('rates.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rates</p>
                </a>
              </li>
              <li class="nav-item {{ Route::currentRouteName() === 'vessels.index' ? 'active' : '' }}">
                <a href="{{ route('vessels.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vessels</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>