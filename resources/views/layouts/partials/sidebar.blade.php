
<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="light">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    <!--begin::Brand Link-->
    <a href="{{ URL::to('/') }}" class="brand-link">
      <!--begin::Brand Image-->
      <img
        src="{{ asset('favicon.png') }}"
        alt="{{env('APP_NAME')}} Logo"
        class="brand-image opacity-75 shadow"
      />
      <!--end::Brand Image-->
      <!--begin::Brand Text-->
      <span style="font-size:48px;" class="brand-text fw-light waterfall-regular">{{env('APP_NAME')}}</span>
      <!--end::Brand Text-->
    </a>
    <!--end::Brand Link-->
  </div>
  <!--end::Sidebar Brand-->
 
  <!--begin::Sidebar Wrapper-->
  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <!--begin::Sidebar Menu-->
      <ul
        class="nav sidebar-menu flex-column"
        data-lte-toggle="treeview"
        role="navigation"
        aria-label="Main navigation"
        data-accordion="false"
      >
        {{-- Dashboard --}}
        <li class="nav-item">
          <a href="{{ URL::to('/') }}" class="nav-link {{ request()->is('/') ? 'active' : ""; }}">
            <i class="nav-icon bi bi-speedometer"></i>
            <p>Dashboard</p>
          </a>
        </li>
       
        {{-- User Management Section --}}
        <li class="nav-header">User Management</li>
       
        {{-- Roles roles.html --}}
        <li class="nav-item">
          <a href="{{ route('roles.index') }}" class="nav-link {{ request()->is('role*') ? 'active' : ""; }}">
            <i class="nav-icon bi bi-shield-lock"></i>
            <p>Roles</p>
          </a>
        </li>
        
       
        {{-- Users --}}
        <li class="nav-item">
          <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('user*') ? 'active' : ""; }}">
            <i class="nav-icon bi bi-people"></i>
            <p>Users</p>
          </a>
        </li>
        

        {{-- Practitioner Management Section --}}
        <li class="nav-header">Practitioner Management</li>

        {{-- Practitioners --}}
        <li class="nav-item">
          <a href="{{ route('practitioners.index') }}" class="nav-link {{ request()->is('practitioner*') ? 'active' : ""; }}">
            <i class="nav-icon bi bi-person-check"></i>
            <p>Practitioners</p>
          </a>
        </li>

        {{-- Administrator Section --}}
        <li class="nav-header">Administrator </li>

         {{-- Statuses --}}
        <li class="nav-item">
          <a href="{{ route('statuses.index') }}" class="nav-link {{ request()->is('status*') ? 'active' : ""; }}">
            <i class="nav-icon bi bi-info-circle"></i>
            <p>Statuses</p>
          </a>
        </li>

        {{-- specialities --}}
        <li class="nav-item">
          <a href="{{ route('specialities.index') }}" class="nav-link {{ request()->is('speciality*') ? 'active' : ""; }}">
            <i class="nav-icon bi bi-lock"></i>
            <p>Specialities</p>
          </a>
        </li>

        {{--SubSpecialities --}}
        <li class="nav-item">
          <a href="{{ route('subspecialities.index') }}" class="nav-link {{ request()->is('subspeciality*') ? 'active' : ""; }}">
            <i class="nav-icon bi bi-star-half"></i>
            <p>SubSpecialities</p>
          </a>
        </li>

        {{-- Institutions --}}
        <li class="nav-item"> 
          <a href="{{ route('institutions.index') }}" class="nav-link {{ request()->is('institution*') ? 'active' : ""; }}">
            <i class="nav-icon bi bi-building"></i>
            <p>Institutions</p>
          </a>
        </li>

        {{-- Degrees --}}
        <li class="nav-item">     
          <a href="{{ route('degrees.index') }}" class="nav-link {{ request()->is('degree*') ? 'active' : ""; }}">
            <i class="nav-icon bi bi-mortarboard"></i>
            <p>Degrees</p>
          </a>
        </li>



        {{-- Settings --}}
        <li class="nav-header">Settings</li>
        <li class="nav-item">
          <a href="{{ route('settings.index') }}" class="nav-link {{ request()->is('settings*') ? 'active' : ""; }}">
            <i class="nav-icon bi bi-gear"></i>
            <p>System Settings</p>
          </a>
        </li>
      </ul>
      <!--end::Sidebar Menu-->
    </nav>
  </div>
  <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->
