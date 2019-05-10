@extends('layout.email')

@section('body')
# Hello!

You are receiving this email because your leave request is deleted.

Leave request: {{ $leave_request->start_date }} | {{ $leave_request->vacation_days }} {{ $leave_request->vacation_days > 1 ? 'days' : 'day' }}

Deleted by: {{ $administrator_name }}

@component('mail::button', ['url' => url('/').'/new-leave', 'color' => 'green'])
Create a new leave request
@endcomponent

@endsection