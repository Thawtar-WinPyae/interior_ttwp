@extends('main')

@section('content')
<div class="container">
    <div class="row align-content-center pt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('bimage.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="title" value="{{old('title')}}">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input onchange="previewImage(event)"   type="file" accept="image/png, .jpeg, .jpg,image/webp, image/gif" class="form-control d-none  p-1 @error('image') is-invalid @enderror" name="image" id="image" value="{{old('image')}}" placeholder="Ads image" onchange="readURL(this);">
                                        @error('image')
                                        <small class="invalid-feedback font-weight-bold" role="alert">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                        <img id="preview" onclick="$('#image').trigger('click');" class="mx-auto rounded" src="{{asset('/upload.png')}}" alt="your image" style="max-height: 400px; max-width:100%;" />

                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-outline-primary">Create</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('summernote')
    <script>
        function previewImage(event) {
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function(){
                var img = document.getElementById('preview');
                img.src = reader.result;
                img.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }

        $(document).ready(function() {
        // $('#summernote').summernote();
        });
    </script>
@endpush