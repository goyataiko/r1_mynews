@extends('layouts.admin')
@section('title', 'Profile Index')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Profile Index</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('admin.profile.add') }}" role="button" class="btn btn-primary">Create Profile</a>
            </div>
            <div class="col-md-8">
                <form action="{{ route('admin.profile.index') }}" method="get">
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
                                <th width="10%">Name</th>
                                <th width="5%">Age</th>
                                <th width="30%">Introduction</th>
                                <th width="10%">CRUD</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($every_profile as $each_profile)
                                <tr>
                                    <td>{{ Str::limit($each_profile->id, 10) }}</td>
                                    <td>{{ Str::limit($each_profile->name, 20) }}</td>
                                    <td>{{ Str::limit($each_profile->age, 3) }}</td>
                                    <td>{{ Str::limit($each_profile->introduction, 100) }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ route('admin.profile.edit', ['id' => $each_profile->id]) }}">Edit</a>
                                        </div>
                                        <div>
                                            <a href="{{ route('admin.profile.delete', ['id' => $each_profile->id]) }}">Delete</a>
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