@extends('messenger::master')

@section('navigation')
    @parent
    <p>Extends Navigation in Conversations</p>
@stop

@section('header')
    <h1>Your Conversations</h1>
@stop

@section('content')
	@include('messenger::newConversation')
    <p>List of all Conversations</p>
@stop

