@php
$configData = Helper::appClasses();
$isFront = true;
@endphp

@section('layoutContent')

@extends('layouts/commonMaster' )

@include('layouts/sections/navbar/navbar-user')

<!-- Sections:Start -->
@yield('content')
<!-- / Sections:End -->

@include('layouts/sections/footer/footer-user')
@endsection
