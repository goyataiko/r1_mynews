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
                        <label class="col-md-2">タイトル</label>
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
                            @foreach($posts as $news)
                                <tr>
                                    <td>{{ Str::limit($news->id, 10) }}</td>
                                    <td>{{ Str::limit($news->title, 100) }}</td>
                                    <td>{{ Str::limit($news->text, 250) }}</td>
                                    <td>
                                        <!--이미지 파일 어떻게 표시? 이미지는 링크만 저장되고 이미지 자체는 저장이 안되는건가?-->
                                        <!--<img src="{{ asset('storage/image/' . $news->image_path) }}" alt="Image {{ $news->id }}">-->
                                    </td>
                                    <td>
                                        <div>
                                            <a href="{{ route('admin.news.edit', ['id' => $news->id]) }}">Edit</a>
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