@extends('layout.email')

@section('body')
# Hello!

You are receiving this email because someone created an account and needs your approval for using the system.

@component('mail::button', ['url' => url('/').'/browse-users/pending-employee', 'color' => 'green'])
Check pending users
@endcomponent

@endsection