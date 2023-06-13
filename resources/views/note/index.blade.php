@extends('layouts.dashboard')

@section('content')

<Note :data ='{{ json_encode($data) }}'></Note>

@endsection
