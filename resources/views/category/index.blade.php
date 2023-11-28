@extends('main')

@section('content')
<div class="container">
    <div class="row align-content-center pt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $video)
                            <tr>
                                <td>{{ $video->id}}</td>
                                <td>{{ $video->title}}</td>
                                <td class="text-nowrap">
                                    <a href="{{route('category.edit',$video->id)}}" class="btn btn-warning">
                                        <i class="fas fa-pencil-alt text-white"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>  
                    </table>      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('dataTable')
    <script>
        $(document).ready(function() {
            new DataTable('#example');
        });
        function confirmDelete(videoId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#dl_${videoId}`).click();
                }
            });
        }
    </script>
@endpush