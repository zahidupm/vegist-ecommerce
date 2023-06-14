@extends('backend.layouts.app')

@section('title', 'Create Category')
@section('page-title', 'Category')

@section('content')
<section class="bg-white p-4">
    <div class="text-end">
        <!-- Base Buttons -->
        <a href="{{ route('category.index') }}" class="btn btn-primary waves-effect waves-light">Back</a>
    </div>

    <form action="{{route('category.create')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Basic Input -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            @error('name')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <!-- Basic Input -->
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="sub_title" name="slug" value="{{ old('slug') }}">
            @error('slug')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <!-- Basic File input -->
        <div class="mb-3">
            <label for="thumbnail" class="form-label">Thumbnail</label>
            <input type="file" class="form-control" id="thumbnail" name="thumbnail" value="{{ old('thumbnail') }}">
            @error('thumbnail')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <hr>
        <div class="">
            <button type="submit" class="btn btn-primary waves-effect weves-light">Create</button>
        </div>
    </form>
</section>
@endsection
