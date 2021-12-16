@extends('adminlte::page')
@section('title', 'Add Company')
@section('content_header')
    <h1 class="m-0 text-dark">Add Company</h1>
@stop
@section('content')
    <form enctype="multipart/form-data" action="{{route('companies.store')}}" method="post">
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="inputName">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputName" placeholder="Name" name="name" value="{{old('name')}}">
                        @error('name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" placeholder="Email" name="email" value="{{old('email')}}">
                        @error('email') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputLogo">Logo</label>
                        <input type="file" class="form-control @error('logo') is-invalid @enderror" name="logo" id="inputLogo" value="{{old('logo')}}"> 
                        @error('logo') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputWebsite">Website</label>
                        <input type="text" class="form-control @error('website') is-invalid @enderror" id="inputWebsite" placeholder="Website" name="website">
                        @error('website') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{route('companies.index')}}" class="btn btn-default">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop