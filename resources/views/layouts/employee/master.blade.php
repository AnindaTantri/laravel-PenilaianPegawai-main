@extends('layouts.base')

@section('slot')
<div class="container">
    <!-- Navbar -->
    @include('layouts.employee._navbar')
    <!-- / Navbar -->

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        @yield('content')
        <!-- / Content -->

        <!-- Footer -->
        @include('layouts.employee._footer')
        <!-- / Footer -->

        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
</div>
@endsection
