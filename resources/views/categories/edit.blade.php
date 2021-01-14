@extends('layouts.app')

@section('content')
    @php /** @var \App\Models\News $item */  @endphp
    <form method="post" action="{{ route('categories.update', $category->id)  }}">
        @method('PATCH')
        @csrf
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
            @if(session('success'))
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                <span aria-hidden="true">x</span>
                            </button>
                            {{ session()->get('success')  }}
                        </div>
                    </div>
                </div>
            @endif

            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title"></div>
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a href="#maindata" class="nav-link active" role="tab">Main data</a>
                                        </li>
                                    </ul>
                                    <br>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="maindata" role="tabpanel">
                                            <div class="form-group">
                                                <label for="title">Title: </label>
                                                <input name="title" value="{{ old('title', $category->title) }}"
                                                       id="title"
                                                       minlength="3"
                                                       required
                                                       type="text">
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description:</label><br>
                                                <textarea name="description"
                                                          id="description"
                                                          minlength="10"
                                                          required>{{ old('description', $category->description)  }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="my-3 btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection