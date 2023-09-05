@extends('adminlte::page')
@section('title','cinema')
@section('content_header')
    <h1>Add cinema</h1>
@stop
@section('content')
    <form action={{route('cinema.store')}} method="post">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" value="{{old('name')}}" name="name" id="name" placeholder="Name cinema...">
        @error('name')
            <div style="color: red">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" value="{{old('address')}}" name="address" id="address" placeholder="Address cinema...">
            @error('address')
            <div style="color: red">{{$message}}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@stop
