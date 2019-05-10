@extends('layout.email')

@section('body')
# Hello {{ $user->name }}!

You are receiving this email because your account status has changed to administrator.

Administrators

■ can manage the users (their leave categories and user groups)

■ can manage the leave categories (create, delete)

■ can accept or decline the leave requests

■ can browse the requests

■ can create new leave entry for himself/herself

■ can access calendar view

@component('mail::button', ['url' => url('/').'/browse-requests/pending', 'color' => 'green'])
Browse requests
@endcomponent

@endsection