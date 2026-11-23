@extends('layouts.admin')
@section('title', ucfirst(str_replace('-', ' ', $component)))
@section('content')
    @livewire('admin.'.$component)
@endsection
