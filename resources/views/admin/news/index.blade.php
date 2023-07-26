@extends('layouts.admin')
@section('title', 'newsIndex')

@section('content')
    <div class="container">
        <div class="row">
            <h2>News Index</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('admin.news.add') }}" role="button" class="btn btn-primary">Create News</a>
            </div>
            <div class="col-md-8">
                <form action="{{ route('admin.news.index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">検索</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="search_value" value="{{ $search_value }}">
                        </div>
                        <div class="col-md-2">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="Search">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="20%">Title</th>
                                <th width="20%">Text</th>
                                <th width="30%">Image</th>
                                <th width="10%">CRUD</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($news as $one_post)
                                <tr>
                                    <td>{{ Str::limit($one_post->id, 10) }}</td>
                                    <td>{{ Str::limit($one_post->title, 100) }}</td>
                                    <td>{{ Str::limit($one_post->text, 250) }}</td>
                                    <td>
                                        <img src="{{ secure_asset('storage/image/' . $one_post->image_path) }}" alt="Image {{ $one_post->id }}">
                                    </td>
                                    <td>
                                        <div>
                                            <a href="{{ route('admin.news.edit', ['id' => $one_post->id]) }}">Edit</a>
                                        </div>
                                        <div>
                                            <a href="{{ route('admin.news.delete', ['id' => $one_post->id]) }}">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection