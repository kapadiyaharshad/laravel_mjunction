<style>
  .active {
    background: #4c4795;
  }

  <?php

  use Illuminate\Support\Facades\Auth;
  use Illuminate\Support\Facades\DB;

  $has_permission = DB::table('role_has_permissions')->where('role_id', Auth::id())->pluck('permission_id');
  $not_allowed = DB::table('permissions')
    ->whereNotIn('id', $has_permission)
    ->pluck('name')->toArray();
  if (in_array("payer_code.index", $not_allowed)) {
    $payer_code_menu = "payer_code";
  }
  if (in_array("profit_code.index", $not_allowed)) {
    $profit_code_menu = "profit_code";
  }
  if (in_array("roles.index", $not_allowed)) {
    $roles_menu = "roles";
  }
  if (in_array("users.index", $not_allowed)) {
    $users_menu = "users";
  }

  if (in_array("ec_nc.index", $not_allowed)) {
    $ecnc_menu = "ec_nc";
  }
  if (in_array("bu.index", $not_allowed)) {
    $bu_menu = "bu";
  }
  if (in_array("account_type.index", $not_allowed)) {
    $account_type_menu = "account_type";
  }
  if (in_array("service.index", $not_allowed)) {
    $service_menu = "service";
  }
  if (in_array("region.index", $not_allowed)) {
    $region_menu = "region";
  }

  if (in_array("category.index", $not_allowed)) {
    $category_menu = "category";
  }
  if (in_array("client.index", $not_allowed)) {
    $client_menu = "client";
  }
 
  ?>
</style>
<header class="p-3 bg-dark text-white">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
          <use xlink:href="#bootstrap" />
        </svg>
      </a>

      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="{{ route('home.index') }}" class="nav-link px-2 text-white {{ request()->is('/') ? 'active' : '' }}">Home</a></li>
        @auth
        @role('superadmin')
        <li style='display: <?php echo (isset($users_menu)) ? "none" : "block" ?>'><a href="{{ route('users.index') }}" class="nav-link px-2 text-white {{ request()->is('users*') ? 'active' : '' }}">Users</a></li>
        <li style='display: <?php echo (isset($roles_menu)) ? "none" : "block" ?>'><a href="{{ route('roles.index') }}" class="nav-link px-2 text-white {{ request()->is('roles*') ? 'active' : '' }}">Roles</a></li>
        <li style='display: <?php echo (isset($profit_code_menu)) ? "none" : "block" ?>'><a href="{{ route('profit_center.index') }}" class="nav-link px-2 text-white {{ request()->is('profit_center*') ? 'active' : '' }}">Profit Center</a></li>
        <li style='display: <?php echo (isset($payer_code_menu)) ? "none" : "block" ?>'><a href="{{ route('payer_code.index') }}" class="nav-link px-2 text-white {{ request()->is('payer_code*') ? 'active' : '' }}">Payer Code</a></li>
        <li style='display: <?php echo (isset($ecnc_menu)) ? "none" : "block" ?>'><a href="{{ route('business_segment.index') }}" class="nav-link px-2 text-white {{ request()->is('business_segment*') ? 'active' : '' }}">Business Segment</a></li>
        <li style='display: <?php echo (isset($bu_menu)) ? "none" : "block" ?>'><a href="{{ route('business_unit.index') }}" class="nav-link px-2 text-white {{ request()->is('business_unit*') ? 'active' : '' }}">Business Unit</a></li>
        <li style='display: <?php echo (isset($account_type_menu)) ? "none" : "block" ?>'><a href="{{ route('account_type.index') }}" class="nav-link px-2 text-white {{ request()->is('account_type*') ? 'active' : '' }}">Account Type</a></li>
        <li style='display: <?php echo (isset($service_menu)) ? "none" : "block" ?>'><a href="{{ route('service.index') }}" class="nav-link px-2 text-white {{ request()->is('service*') ? 'active' : '' }}">Service</a></li>
        <!-- <li style='display: <?php echo (isset($region_menu)) ? "none" : "block" ?>'><a href="{{ route('region.index') }}" class="nav-link px-2 text-white {{ request()->is('region*') ? 'active' : '' }}">Region</a></li> -->
        <li style='display: <?php echo (isset($category_menu)) ? "none" : "block" ?>'><a href="{{ route('category.index') }}" class="nav-link px-2 text-white {{ request()->is('category*') ? 'active' : '' }}">Category</a></li>
        <li style='display: <?php echo (isset($client_menu)) ? "none" : "block" ?>'><a href="{{ route('client.index') }}" class="nav-link px-2 text-white {{ request()->is('client*') ? 'active' : '' }}">Clients</a></li>
        <li style='display: <?php echo (isset($client_menu)) ? "none" : "block" ?>'><a href="{{ route('designation.index') }}" class="nav-link px-2 text-white {{ request()->is('designation*') ? 'active' : '' }}">Designation</a></li>
        @endrole
        @endauth
      </ul>

      <!-- <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
        <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
      </form> -->

      @auth
      {{auth()->user()->name}}&nbsp; <br>
      {{auth()->user()->role}}
      <div class="text-end">
        <a href="{{ route('logout.perform') }}" class="btn btn-outline-light me-2">Logout</a>
      </div>
      @endauth

      @guest
      <div class="text-end">
        <a href="{{ route('login.perform') }}" class="btn btn-outline-light me-2">Login</a>
        <a href="{{ route('register.perform') }}" class="btn btn-warning">Sign-up</a>
      </div>
      @endguest
    </div>
  </div>
</header>