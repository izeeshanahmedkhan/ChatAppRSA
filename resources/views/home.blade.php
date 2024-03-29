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
                            <div class="col-sm">
                                <div>
                                    <new-message />
                                </div>
                                <div class="my-2">
                                    <latest-messages />
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="my-2">
                                    <messages />
                                </div>
                                <div class="my-2">
                                    <create-message />
                                </div>
                            </div>
{{--                            <div class="row">--}}
{{--                                <form method="post" id="upload-image-form" enctype="multipart/form-data">--}}
{{--                                    @csrf--}}
{{--                                    <div class="form-group">--}}
{{--                                        <input type="file" name="file" class="form-control" id="image-input">--}}
{{--                                        <span class="text-danger" id="image-input-error"></span>--}}
{{--                                    </div>--}}

{{--                                    <div class="form-group">--}}
{{--                                        <button type="submit" class="btn btn-success">Upload</button>--}}
{{--                                    </div>--}}

{{--                                </form>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
