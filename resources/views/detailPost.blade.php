@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Detail') }}</div>
                <div class="card-body">
                 <h4>{{$post->title}}</h4>
                 <p>{{$post->content}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
