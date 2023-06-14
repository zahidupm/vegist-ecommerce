@extends('backend.layouts.app')

@section('title', 'Edit Category')
@section('page-title', 'Category')

@section('content')
<section class="bg-white p-4">
    <div class="text-end">
        <!-- Base Buttons -->
        <a href="{{ route('category.index') }}" class="btn btn-primary waves-effect waves-light">Back</a>
    </div>

    <form action="{{route('category.edit', $category->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <!-- Basic Input -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
            @error('name')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <!-- Basic Input -->
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{ $category->slug }}">
            @error('slug')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <!-- Basic File input -->
        <div class="mb-3">
            <label for="thumbanail" class="form-label">Thumbnail</label>
            <input type="file" class="form-control" id="thumbanail" name="thumbnail" value="{{ $category->thumbnail }}">
            @error('thumbnail')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <hr>
        <div class="">
            <button type="submit" class="btn btn-primary waves-effect weves-light">Update</button>
        </div>
    </form>
</section>
@endsection
