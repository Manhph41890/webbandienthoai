@extends('client.mobile.layouts.app')

@section('content')
    @include('client.mobile.home.banner')

    {{-- @include('client.mobile.home.categories') --}}
    @include('client.mobile.home.hightlight')

    @include('client.mobile.home.topview')

    @include('client.mobile.home.outstanding-pr')
    @include('client.mobile.home.bannerphu')
    @include('client.mobile.home.outstanding-ul')

 @include('client.mobile.home.bannerphukep')

 {{-- @include('client.mobile.home.packages') --}}
    @include('client.mobile.home.sevice')
@endsection
