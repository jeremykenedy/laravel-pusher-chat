@extends('layouts.app')

@section('content')
<div class="container">
    <chat-component :user="{{ auth()->user() }}"></chat-component>
</div>
@endsection
