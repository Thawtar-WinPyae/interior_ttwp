@extends('main')

@section('content')
<div class="container">
    <div class="row align-content-center pt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('post.update',$post->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" value="{{$post->title}}" name="title" placeholder="Title">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <labeL>Content</labeL>
                            <textarea id="summernote" name="content">{{$post->content}}</textarea>
                            @error('content')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="time" class="form-label">Time</label>
                            <input type="text" class="form-control" id="time" value="{{$post->time}}" name="time" placeholder="time">
                            @error('time')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label">Author</label>
                            <input type="text" class="form-control" id="author" value="{{$post->author}}" name="author" placeholder="author">
                            @error('author')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-outline-primary">Update</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('summernote')
    <script>
        $(document).ready(function() {
        $('#summernote').summernote();
        });
    </script>
@endpush