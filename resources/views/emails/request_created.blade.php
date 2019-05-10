@extends('layout.email')

@section('body')
# Hello!

You are receiving this email because a new leave request is created.

Leave request: {{ $leave_request->start_date }} | {{ $leave_request->vacation_days }} {{ $leave_request->vacation_days > 1 ? 'days' : 'day' }}

Created by: {{ $employee_name }}

@component('mail::button', ['url' => url('/').'/calendar/'.explode('-', $leave_request->start_date)[0].'/'.explode('-', $leave_request->start_date)[1], 'color' => 'green'])
Show it on calendar
@endcomponent

@endsection