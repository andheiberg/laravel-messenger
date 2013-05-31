@extends('messenger::master')

@section('sidebar')
    @parent
    <p>Extends Navigation in Messages</p>
@stop

@section('header')
    <h1>All Messages from specific user</h1>
@stop

@section('content')
	@include('messenger::newMessage')
    <p>List of all Messages</p>
@stop