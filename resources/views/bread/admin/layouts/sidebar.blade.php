<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin-dashboard') }}">
          <i class="mdi mdi-grid-large menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item nav-category">Admin Tool</li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin-user') }}">
          <i class="menu-icon mdi mdi-account-circle-outline"></i>
          <span class="menu-title">Users</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin-product') }}">
          <i class="menu-icon mdi mdi-reproduction"></i>
          <span class="menu-title">Products</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin-order') }}">
          <i class="menu-icon mdi mdi-view-list"></i>
          <span class="menu-title">Order</span>
        </a>
      </li>
    </ul>
  </nav>
