@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('management.inc.sidebar')
            <div class="col-md-8">
                <i class="fas fa-hamburger"></i> Edit Menu
                <hr>
                @if($errors -> any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="/management/menu/{{$menu->id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="menuName">Menu Name</label>
                    <input type="text" name="name" value="{{$menu->name}}" class="form-control" placeholder="Menu...">
                    </div>
                    <label for="menuPrice">Price</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" name="price" value="{{$menu->price}}" class="form-control" aria-label="Amount(to nearest dollar)">
                    </div>
                    <label for="menuImage">Image</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                          </div>
                    </div>
                      
                    <div class="form-group">
                        <label for="Description">Description</label>
                        <input type="text" name="description" class="form-control" value="{{$menu->description}}" placeholder="Description...">
                    </div>
                    <div class="form-group">
                        <label for="Category">Category</label>
                        <select name="category_id" class="form-control">
                            @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $menu->category_id === $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection