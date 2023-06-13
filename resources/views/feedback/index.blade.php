@extends('layouts.dashboard')

@section('content')
    <Feedback :data='{{ json_encode($data) }}'></Feedback>
@endsection
