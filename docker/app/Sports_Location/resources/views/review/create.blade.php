@extends('layouts.app')

@section('content')
@include('review.form', ['target' => 'create'])
@endsection
