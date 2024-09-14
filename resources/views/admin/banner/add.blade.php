@extends('admin.layout.index')
@section('title', __('Quản lý tin tức'))

@section('content')
    {{ __('Quản lý tin tức') }}

    <a href="{{ route('admin.tintuc.add') }}" hx-boost="true">Thêm tin tức</a>

@endsection
