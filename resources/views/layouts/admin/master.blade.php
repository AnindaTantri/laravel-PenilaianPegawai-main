@extends('layouts.base')

@section('slot')>
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <!-- Menu -->
    @include('layouts.admin._sidebar')
    <!-- / Menu -->

    <!-- Layout container -->
    <div class="layout-page">

      <!-- Content wrapper -->
      <div class="content-wrapper">
        <!-- Content -->
        @yield('content')
        <!-- / Content -->

        <!-- Footer -->
        @include('layouts.admin._footer')
        <!-- / Footer -->

        <div class="content-backdrop fade"></div>
      </div>
      <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
  </div>

  <!-- Overlay -->
  <div class="layout-overlay layout-menu-toggle"></div>
</div>
@endsection