@extends('layouts.dashboard')

@section('content')
    <Map :data='{{ json_encode($data) }}'></Map>
@endsection
