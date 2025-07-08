@extends('vendor.layouts.master')

@section('title')
    {{ $settings->site_name }} || Product Variant Item
@endsection

@section('content')
    {{-- <!--=============================
        DASHBOARD START
    ==============================--> --}}
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <a href="{{ route('vendor.products-variant.index', ['product' => $product->id]) }}"
                        class="btn btn-warning mb-4"><i class="fas fa-long-arrow-left"></i> Back</a>
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Product Variant Item</h3>
                        <h6>Variant: {{ $productVariant->name }}</h6>
                        <div class="card-header-action d-flex justify-content-end">
                            <a href="{{ route('vendor.products-variant-item.create', ['productId' => $product->id, 'productVariantId' => $productVariant->id]) }}"
                                class="btn btn-primary my-3"><i class="fas fa-plus"></i> Create New</a>
                        </div>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                {{ $dataTable->table() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <!--=============================
        DASHBOARD START
    ==============================--> --}}
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
                    url: "{{ route('vendor.products-variant-item.change-status') }}",
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
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'swal-custom-confirm'
                            },
                            buttonsStyling: false // this disables the default SweetAlert styles

                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })

            })
        })
    </script>
@endpush
