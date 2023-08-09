@extends('layouts.app')
@section('page-title', 'Credit History')
@section('body')

@endsection

@push('js')
    <script src="{{ asset('assets/js/user/credit.js?t=' . config('app.t')) }}"></script>
@endpush
