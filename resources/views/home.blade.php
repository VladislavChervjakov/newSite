@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <div class="py-12">
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 bg-white border-b border-gray-200">
                                        Hi {{ \Illuminate\Support\Facades\Auth::user()->name }} !!!
                                        asdasd
                                        <table class="table-stripped">
                                            <tr>
                                                <th>Name</th>
                                                <th>Short Text</th>
                                                <th>Actions</th>
                                            </tr>
                                            @foreach($news as $new)
                                                <tr>
                                                    <td> {{ $new->name }} </td>
                                                    <td> {{ $new->short_text  }} </td>
                                                    <td><a href="" class="btn btn-danger">b</a></td>
                                                </tr>
                                            @endforeach
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
