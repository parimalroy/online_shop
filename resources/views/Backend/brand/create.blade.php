@extends('Backend.layout.app');
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Brand</h1>
                    <h6 id="message"></h6>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form id="categoryForm">
                @csrf
                <div class="card">
                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" class="form-control" placeholder="Name"
                                        name="name">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email">Slug</label>
                                    <input type="text" id="slug" class="form-control" placeholder="Slug"
                                        name="slug">
                                    <p></p>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email">Photo</label>
                                <input type="file" name="slug" id="slug" class="form-control" placeholder="Slug">
                            </div>
                        </div> --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                    <p></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="pb-5 pt-3">
                    <button id="submitBtn" class="btn btn-primary">Create</button>
                    <a href="" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
        </div>
        </form>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $("#categoryForm").submit(function(e) {
                e.preventDefault();
                let form = $("#categoryForm")[0];
                let data = new FormData(form);
                $("#submitBtn").prop('disabled', true);
                $.ajax({
                    url: "{{ route('brand.store') }}",
                    type: 'post',
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response['status'] === true) {
                            $("#message").addClass('text text-success').html(response[
                                'message']).fadeIn();
                            setTimeout(() => {
                                $("#message").fadeOut();
                            }, 5000);
                            $("#name").siblings('p').remove();
                            $("#slug").siblings('p').remove();
                            // $("#status").siblings('p').remove();


                        } else {
                            $("#submitBtn").prop('disabled', false);
                            let errors = response['errors'];
                            if (errors['name']) {
                                $("#name").siblings('p').addClass('text-danger').html(errors[
                                    'name']);
                            } else {
                                $("#name").siblings('p').remove();
                            }
                            if (errors['slug']) {
                                $("#slug").siblings('p').addClass('text-danger').html(errors[
                                    'slug']);
                            } else {
                                $("#slug").siblings('p').remove();
                            }
                            if (errors['status']) {
                                $("#status").siblings('p').addClass('text-danger').html(errors[
                                    'status']);
                            } else {
                                $("#status").siblings('p').remove();
                            }
                        }
                    },
                    errors: function(jqXHR, exception) {
                        console.log('AJAX error:', jqXHR.status, jqXHR.responseText);
                    }

                });
            });


        });
    </script>
@endsection
