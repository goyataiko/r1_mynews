@extends('layouts.admin')
@section('title', 'Edit My Profile')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>Edit My Profile</h2>
                <form action="{{ route('admin.profile.update') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">Name</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" value="{{ $profile_form->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">Age</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="age" value="{{ $profile_form->age }}">
                        </div>
                    </div>                    
                    <div class="form-group row">
                        <label class="col-md-2">Introduction</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="introduction" rows="20">{{ $profile_form->introduction }}</textarea>
                        </div>
                    </div>                   
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $profile_form->id }}">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
                <div class="row mt-5">
                    <div class="col-md-4 mx-auto">
                        <h2>編集履歴</h2>
                        <ul class="list-group">
                            <!--histories는 모델에서 옴-->
                            @if ($profile_form -> histories != NULL)
                                @foreach ($profile_form -> histories as $history)
                                    <li class="list-group-item">Title: {{ $history->profile_name }}<br>Edited_at: {{ $history->edited_at }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
