@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card my-3">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card my-3">
                    <div class="card-header">Messages</div>

                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <form method="POST" action="{{route('image-store')}}">
                                    @csrf
                                <div class="col-sm">
                                    <input type="hidden" value="{{auth()->id()}}" name="author_id">
                                    <input type="hidden" value="" name="recipient_id">
                                    <input type="file" class="form-control" name="image">
                                </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
