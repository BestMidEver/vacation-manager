@extends('layout.email')

@section('body')
# Hello {{ $user->name }}!

You are receiving this email because your account status has changed to pending.

Please contact with administrators, if you think that something is wrong.

@endsection