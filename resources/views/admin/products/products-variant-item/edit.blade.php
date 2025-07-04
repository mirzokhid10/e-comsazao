@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Product Variant Items</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Variant Item</h4>

                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.products-variant-item.update', $productVariantItem->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Variant Name</label>
                                    <input type="text" class="form-control" name="variant_name"
                                        value="{{ $productVariantItem->productVariant->name }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Item Name</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ $productVariantItem->name }}">
                                </div>

                                <div class="form-group">
                                    <label>Price <code>(Set 0 for make it free)</code></label>
                                    <input type="text" class="form-control" name="price"
                                        value="{{ $productVariantItem->price }}">
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Is Default</label>
                                    <select id="inputState" class="form-control" name="is_default">
                                        <option value="">Select</option>
                                        <option {{ $productVariantItem->is_default == 1 ? 'selected' : '' }} value="1">
                                            Yes
                                        </option>
                                        <option {{ $productVariantItem->is_default == 0 ? 'selected' : '' }} value="0">
                                            No
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{ $productVariantItem->status == 1 ? 'selected' : '' }} value="1">
                                            Active
                                        </option>
                                        <option {{ $productVariantItem->status == 0 ? 'selected' : '' }} value="0">
                                            Inactive
                                        </option>
                                    </select>
                                </div>
                                <button type="submmit" class="btn btn-primary">Update</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
