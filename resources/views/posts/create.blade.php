@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/p" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <h2>Add new image</h2>
                </div>
                <div class="form-group row">
                    <label for="caption" class="col-md-4 col-form-label">Image Caption</label>

                        <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}" autocomplete="caption" autofocus>

                            @error('caption')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                </div>
                <div class="row">
                    <label for="image" class="col-md-4 col-form-label">Upload Image</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                    @error('image')
                                        <strong>{{ $message }}</strong>
                    @enderror
                </div>
                <div class="row">
                    <button class="btn btn-primary mt-3">Add New Post</button>
                </div>  
            </div>
        </div>
    </form>
</div>
@endsection
