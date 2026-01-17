@extends('admin.layouts')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container-fluid dashboard-container">

        @include('admin.general.part5') {{-- Bộ lọc --}}

        @include('admin.general.part4') {{-- Thông tin chung --}}

        @include('admin.general.part2') {{-- Biểu đồ danh mục - gói cước --}}

        @include('admin.general.part3') {{-- Báo số lượng hàng sắp hết - Nhân viên trực tuyến --}}

        @include('admin.general.part1') {{-- Top sản phẩm hot --}}
    </div>


@endsection

@include('admin.general.lib')
