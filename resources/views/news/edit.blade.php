@extends('layouts.app')

@section('content')
    @php /** @var \App\Models\News $item */  @endphp
    <form method="post" action="{{ route('news.update', $item->id)  }}">
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
                                                <input name="name" value="{{ $item->name  }}"
                                                       id="title"
                                                       minlength="3"
                                                       required
                                                       type="text">
                                            </div>
                                            <div class="form-group">
                                                <label for="short_text">Short Text:</label><br>
                                                <textarea name="short_text"
                                                          id="short_text"
                                                          minlength="10"
                                                          required>{{ old('short_text', $item->short_text)  }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="full_text">Full Text:</label><br>
                                                <textarea name="full_text"
                                                          cols="40"
                                                          rows="5"
                                                          id="full_text"
                                                          minlength="10"
                                                          required>{{ old('full_text', $item->full_text)  }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="category">Category:</label>
                                                <select name="category_id"
                                                        class="form-control"
                                                        id="category">
                                                    @foreach($categoryList as $category)
                                                        <option value="{{ $category->id  }}"
                                                                @if($category->id == $item->category_id) selected @endif>
                                                            {{ $category->title  }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                                                    <div class="form-group">
                                                        <label for="published">Published:</label>
                                                        <input id="published" name="published" type="checkbox"
                                                               @if($item->is_published) checked @endif>
                                                    </div>
                                                @endif
                                                <div class="form-group mt-2">
                                                    <label for="created">Created at:</label>
                                                    <input id="created" type="text" value="{{ $item->created_at }}"
                                                           class="form-control" disabled>

                                                </div>
                                                <div class="form-group">
                                                    <label for="updated">Updated at:</label>
                                                    <input type="text" id="updated" value="{{ $item->updated_at }}"
                                                           class="form-control" disabled>

                                                </div>
                                                <div class="form-group">
                                                    <label for="deleted">Deleted at:</label>
                                                    <input type="text" id="deleted" value="{{ $item->deletd_at }}"
                                                           class="form-control" disabled>

                                                </div>
                                                <button id="save" type="submit" class="btn btn-primary">Save</button>
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