@extends('layouts.dashboard')

@section('content')

<Project :data ='{{ json_encode($data) }}'></Project>

@endsection
