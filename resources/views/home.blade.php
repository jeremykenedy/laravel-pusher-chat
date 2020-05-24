@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body ">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="text-center mt-3 mb-5">
                            <P>
                                You are logged in!
                            </P>

                            <a class="btn btn-primary shadow" href="{{ url('/chats') }}">
                                Start Chatting
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
