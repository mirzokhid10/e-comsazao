@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Brand</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Brands</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.brand.create') }}" class="btn btn-primary"><i
                                        class="fas fa-plus"></i> Create New</a>
                            </div>
                        </div>
                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $('body').on('click', '.change-status', function() {
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('admin.brand.change-status') }}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: id
                    },
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: data.message || 'Status changed successfully.',
                            confirmButtonText: 'OK'
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })

            })
        })

        // $('body').on('click', '.delete-brand', function() {
        //     let id = $(this).data('id');

        //     Swal.fire({
        //         icon: 'warning',
        //         title: 'Are you sure?',
        //         text: "This brand will be permanently deleted!",
        //         showCancelButton: true,
        //         confirmButtonText: 'Yes, delete it!',
        //         cancelButtonText: 'Cancel',
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             $.ajax({
        //                 url: '/admin/brand/' + id,
        //                 method: 'DELETE',
        //                 success: function(data) {
        //                     Swal.fire('Deleted!', 'Brand deleted successfully.', 'success');
        //                     $('.dataTable').DataTable().ajax.reload(null, false);
        //                 },
        //                 error: function(xhr) {
        //                     Swal.fire('Error!', 'Failed to delete brand.', 'error');
        //                 }
        //             });
        //         }
        //     });
        // });
    </script>
@endpush
