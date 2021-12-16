@extends('adminlte::page')
@section('title', 'Edit Company')
@section('content_header')
    <h1 class="m-0 text-dark">Edit Company</h1>
@stop
@section('content')
    <form action="{{route('companies.update', $companies)}}" method="post">
        @method('PUT')
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="inputFirstName">First Name</label>
                        <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="inputFirstName" placeholder="First Name" name="firstname" value="{{$employees->firstname ?? old('firstname')}}">
                        @error('firstname') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputLastName">Last Name</label>
                        <input type="text" class="form-control @error('lastname') is-invalid @enderror" id="inputLastName" placeholder="Last Name" name="lastname" value="{{$employees->lastname ?? old('lastname')}}">
                        @error('lastname') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" placeholder="Email" name="email" value="{{$employees->email ?? old('email')}}">
                        @error('email') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputPhone">Phone</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="inputPhone" placeholder="Phone" name="phone" value="{{$employees->phone ?? old('phone')}}">
                        @error('phone') <span class="text-danger">{{$message}}</span> @enderror
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