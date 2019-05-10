@extends('layout.email')

@section('body')
# Hello!

You are receiving this email because your leave request is declined.

Leave request: {{ $leave_request->start_date }} | {{ $leave_request->vacation_days }} {{ $leave_request->vacation_days > 1 ? 'days' : 'day' }}

Declined by: {{ $administrator_name }}

@component('mail::button', ['url' => url('/').'/calendar/'.explode('-', $leave_request->start_date)[0].'/'.explode('-', $leave_request->start_date)[1], 'color' => 'green'])
Show it on calendar
@endcomponent

@endsection