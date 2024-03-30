@extends('layout.base')

@section('title', 'Father')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-sm-4">
           <button class="btn btn-success btn-block" data-bs-toggle="modal" data-bs-target="#addModal">Add Father Details</button>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-bordered table-striped" id="table">
                <thead class="table-dark" style="text-align: center;">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Age</th>
                        <th>Father Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody style="text-align: center;">
                    @foreach($details as $detail)
                    <tr>
                        <td>{{$detail->name}}</td>
                        <td>{{$detail->email}}</td>
                        <td>{{$detail->age}} years</td>
                        <td>Mr. {{$detail->grandfathers->name}}</td>
                        <td>
                            <button id="edit" class="btn btn-primary" 
                            data-id="{{ $detail->id }}"
                            data-name="{{ $detail->name }}"
                            data-email="{{ $detail->email }}"
                            data-age="{{ $detail->age }}"
                            data-grandfatherid="{{ $detail->grandfathers->id }}"
                            data-bs-toggle="modal" 
                            data-bs-target="#editModal"
                            >Edit</button>
                            <button class="btn btn-danger mx-2 delete" 
                            data-id="{{ $detail->id }}" 
                            data-bs-toggle="modal" 
                            data-bs-target="#deleteModal">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination justify-content-center">
                {!! $details->links() !!}
            </div>
        </div>
    </div>
    
@include("modals.father.add_father")
@include("modals.father.edit_father")
@include("modals.father.delete_father")
@endsection

@push('script')
    <script>
        $.ajaxSetup({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                    });
       $(document).ready(function () {
        // Show modal when Add button is clicked
        $('#addButton').click(function () {
            $('#addModal').modal('show');
        });

        // Adding 
        $('#addForm').submit(function (e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "{{ route('father.add') }} ",
                type: 'POST',
                data: formData,
                success: function (response) {
                    console.log(response);
                     $('#addModal').modal('hide');
                     $('#table').load(location.href + ' #table');
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        //Editing Entry
       $(document).on('click', '#edit', function () {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let email = $(this).data('email');
            let age = $(this).data('age');
            let grandfatherId = $(this).data('grandfatherid');

            $('#edit_id').val(id);
            $('#edit_name').val(name);
            $('#edit_email').val(email);
            $('#edit_age').val(age);
            $('#edit_grandfathername').val(grandfatherId);
        });  
        $('#editForm').submit(function (e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: "{{ route('father.edit') }}",
            type: 'PUT',
            data: formData,
            success: function (response) {
                console.log(response);
                $('#editModal').modal('hide');
                $('#table').load(location.href + ' #table');
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
        });
       
        //Deleting entry
        $(document).on('click', '.delete', function() {
            var id = $(this).data('id');
            $('#delete_id').val(id);
        });

        $('#deleteForm').submit(function (e) {
            e.preventDefault(); // Prevent the default form submission
            var id = $('#delete_id').val();
            $.ajax({
                url: "{{ route('father.delete') }}",
                type: 'delete',
                data: {id: id},
                success: function (response) {
                    console.log(response);
                    $('#deleteModal').modal('hide');
                    $('#table').load(location.href + ' #table');
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

    });
              
</script>
@endpush
