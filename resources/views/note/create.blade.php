@extends('layouts.dashboard')

@section('content')

<create-note :categories ='{{ json_encode($categories) }}'></create-note>

@endsection
