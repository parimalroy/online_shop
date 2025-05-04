@extends('Backend.layout.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Category</h1>
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
                        <input type="hidden" name="id" value="{{ $category->id }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" class="form-control" placeholder="Name"
                                        name="name" value="{{ $category->name }}">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email">Slug</label>
                                    <input type="text" id="slug" class="form-control" placeholder="Slug"
                                        name="slug" value="{{ $category->slug }}">
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
                                        <option value="active" {{ $category->status == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="inactive"{{ $category->status == 'inactive' ? 'selected' : '' }}>
                                            Inactive
                                        </option>
                                    </select>
                                    <p></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="pb-5 pt-3">
                    <button id="submitBtn" class="btn btn-primary">Update</button>
                    <a href="{{ route('category.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
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
                    url: "{{ route('category.update') }}",
                    type: 'post',
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response['status'] == true) {

                            $("#message").addClass('text text-success').html(response[
                                'message']);

                            $("#name").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html(errors['name']);

                            $("#slug").addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(errors['slug']);

                            $("#stauts").removeClass('is-invalid').siblings('p')
                                .removeClass(
                                    'invalid-feedback').html(errors['status']);

                        } else {
                            let errors = response['errors'];
                            if (errors['name']) {
                                $("#name").addClass('is-invalid').siblings('p').addClass(
                                        'invalid-feedback')
                                    .html(errors['name']);
                            } else {
                                $("#name").removeClass('is-invalid').siblings('p').removeClass(
                                    'invalid-feedback').html(errors['name']);
                            }
                            if (errors['slug']) {
                                $("#slug").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback').html(errors['slug']);
                            } else {
                                $("#slug").removeClass('is-invalid').siblings('p').removeClass(
                                    'invalid-feedback').html(errors['slug']);
                            }
                            if (errors['status']) {
                                $("#stauts").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback').html(errors['status']);
                            } else {
                                $("#stauts").removeClass('is-invalid').siblings('p')
                                    .removeClass(
                                        'invalid-feedback').html(errors['status']);
                            }
                        }
                    },
                    errors: function(jqXHR, exception) {
                        console.log('something went wrong');
                    }
                });
            });

        });
    </script>
@endsection
