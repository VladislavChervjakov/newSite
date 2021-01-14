@extends('layouts.app')

@section('content')
    <div class="container">
        <div class=" justify-content-center row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                       Title: {{ $item->name }}
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                           Full text:  {{ $item->full_text }}
                        </div>
                    </div>
                    <a class="my-2 btn btn-primary" href="{{ route('news.edit', $item->id)  }}">Edit</a>
                    <a class="btn btn-info" href="{{route('dashboard')}}">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection