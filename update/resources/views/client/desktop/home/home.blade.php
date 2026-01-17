@extends('client.desktop.layouts.app')

@section('content')
    @include('client.desktop.home.banner')

    {{-- @include('client.desktop.home.categories') --}}
    @include('client.desktop.home.hightlight')

    @include('client.desktop.home.topview')

    @include('client.desktop.home.outstanding-pr')
    @include('client.desktop.home.bannerphu')
    @include('client.desktop.home.outstanding-ul')

    @include('client.desktop.home.bannerphukep')

    @include('client.desktop.home.packages')
    @include('client.desktop.home.sevice')

@endsection