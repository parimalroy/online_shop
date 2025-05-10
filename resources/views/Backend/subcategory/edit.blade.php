@extends('Backend.layout.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Sub Category</h1>
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
            <form id="subCategoryForm">
                @csrf
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Category</label>
                                    <select class="form-control" id="status" name="categorie_id">
                                        @if ($categorieList->isNotEmpty())
                                            @foreach ($categorieList as $cateList)
                                                <option
                                                    {{ $subcategory->categorie_id === $cateList->category->id ? 'selected' : '' }}
                                                    value="{{ $cateList->category->id }}">
                                                    {{ $cateList->category->name }}</option>
                                            @endforeach
                                        @endif

                                    </select>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="hidden" name="id" value="{{ $subcategory->id }}">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" class="form-control" placeholder="Name"
                                        name="name" value="{{ $subcategory->name }}">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email">Slug</label>
                                    <input type="text" id="slug" class="form-control" placeholder="Slug"
                                        name="slug" value="{{ $subcategory->slug }}">
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
                                        <option {{ $subcategory->status === 'active' ? 'selected' : '' }} value="active">
                                            Active
                                        </option>
                                        <option {{ $subcategory->status === 'inactive' ? 'selected' : '' }}
                                            value="inactive">
                                            Inactive</option>
                                    </select>
                                    <p></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="pb-5 pt-3">
                    <button id="submitBtn" class="btn btn-primary">Update</button>
                    <a href="{{ route('subcategory.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
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
            $("#subCategoryForm").submit(function(e) {
                e.preventDefault();
                let form = $("#subCategoryForm")[0];
                let data = new FormData(form);
                $("#submitBtn").prop('disabled', true);

                $.ajax({
                    url: "{{ route('subcategory.update') }}",
                    type: 'post',
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response['status'] === true) {
                            $("#message").addClass('text text-success').html(response[
                                'message']);
                            // if (errors['name']) {
                            $("#name").siblings('p').remove();
                            $("#slug").siblings('p').remove();
                            // }
                        } else {
                            $("#submitBtn").prop('disabled', false);

                            let errors = response['errors'];
                            if (errors['name']) {
                                $("#name").siblings('p').addClass(
                                    ' text-danger').html(errors['name']);
                            } else {
                                $("#name").siblings('p').remove();
                            }
                            if (errors['slug']) {
                                $("#slug").siblings('p').addClass(
                                    ' text-danger').html(errors['slug']);

                            } else {
                                $("#slug").siblings('p').remove();
                            }
                            if (errors['status']) {
                                $("#name").siblings('p').addClass(
                                    ' text-danger').html(errors['status']);
                            } else {
                                $("#status").siblings('p').remove();

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
