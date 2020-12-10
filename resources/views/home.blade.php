@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">{{ $title }}</h4>
        <div class="row ">
            <div class="col-md-8">
                {{ __('You are logged in!') }}
            </div>
        </div>
    </div>
</div>
@endsection
