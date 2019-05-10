@extends('layout.email')

@section('body')
# Hello {{ $user->name }}!

You are receiving this email because your account status has changed to employee.

Employees

■ can create new leave request for himself/herself

■ can access calendar view

@component('mail::button', ['url' => url('/').'/new-leave', 'color' => 'green'])
Create a new leave request
@endcomponent

@endsection