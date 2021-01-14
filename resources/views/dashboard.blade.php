@extends('layouts.app')

@section('content')
    <div class="container">
        @if($errors->any())
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true">x</span>
                        </button>
                        {{ $errors->first()  }}
                    </div>
                </div>
            </div>
        @endif
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a href="#news" data-toggle="tab" class="nav-link active" role="tab">News</a>
            </li>
            @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
            <li class="nav-item">
                <a href="#categories"
                   data-toggle="tab" role="tab" class="nav-link">Categories</a>
            </li>
             @endif
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="news" role="tabpanel">
                <div class="my-3 row justify-content-center">
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
                                                <p><a class="btn btn-success"
                                                      href="{{ route('news.create') }}">Add news +</a></p>
                                                <table class="table">
                                                    <tr class="text-center">
                                                        <th>Name</th>
                                                        <th>Short Text</th>
                                                        <th>Category</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                    @foreach($news as $item)
                                                        <tr class="text-center">
                                                            <td> {{ $item->name }} </td>
                                                            <td> {{ $item->short_text  }} </td>
                                                            <td> {{ $item->category()->get()->first()->title }} </td>
                                                            <td>
                                                                <a href="{{ route('news.edit', $item->id) }}"
                                                                   class="btn btn-primary">Edit</a>
                                                                <a href="{{ route('news.show', $item->id) }}"
                                                                   class="btn btn-info">View</a>
                                                                <form id="delete-form" method="POST"
                                                                      style="display: inline-block;"
                                                                      action="{{ route('news.destroy', $item->id)  }}">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('DELETE') }}
                                                                    <div class="form-group">
                                                                        <input onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger" value="Delete">
                                                                    </div>
                                                                </form>
                                                            </td>
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
            @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
            <div class="tab-pane" id="categories" role="tabpanel">
                <div class="my-3 row justify-content-center">
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
                                                <p><a class="btn btn-success"
                                                      href="{{ route('categories.create') }}">Add category +</a></p>
                                                <table class="table">
                                                    <tr class="text-center">
                                                        <th>Name</th>
                                                        <th>Description</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                    @foreach($categories as $item)
                                                        <tr class="text-center">
                                                            <td> {{ $item->title }} </td>
                                                            <td> {{ $item->description  }} </td>
                                                            <td>
                                                                <a href="{{ route('categories.edit', $item->id) }}"
                                                                   class="btn btn-primary">Edit</a>
                                                                @if($item->id != 1)
                                                                <form id="delete-form" method="POST"
                                                                      id="deleteCategory"
                                                                      style="display: inline-block;"
                                                                      action="{{ route('categories.destroy', $item->id)  }}">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('DELETE') }}
                                                                    <div class="form-group">
                                                                        <input onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger" value="Delete">
                                                                    </div>
                                                                </form>
                                                                @endif
                                                            </td>
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
             @endif
        </div>
    </div>
@endsection
