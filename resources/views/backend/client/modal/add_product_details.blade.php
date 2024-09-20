<!-- Modal -->
<div class="modal fade" id="add_product_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelAdd"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{ route('pos.add_product_details') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ADD NEW PRODUCT</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">

                                <input type="hidden" id="client_id_value_add" name="client_id_value_add">

                                {{-- <input type="hidden" id="newTotal" name="newTotal"> --}}
                                <label class="form-label">Proudct Condition</label>
                                <select class="form-select shadow-none" aria-label="Default select example"
                                    name="productConditionAdd" id="productConditionAdd">
                                    <option value="">Conditon Rank</option>
                                    <option value="A(Mint)">A(Mint)</option>
                                    <option value="AB(Ecellent)">AB(Ecellent)</option>
                                    <option value="B(Gently Used)">B(Gently Used)</option>
                                    <option value="BC(Used)">BC(Used)</option>
                                    <option value="C(Well Used)">C(Well Used)</option>
                                    <option value="D(Need Prayers)">D(Need Prayers)</option>

                                </select>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-md-12">
                                <label class="form-label">Item Name</label>
                                <input type="text" class="form-control" name="productNameAdd" id="productNameAdd">
                            </div>

                        </div>

                        <div class="row mt-1">
                            <div class="col-md-12">
                                <label class="form-label" for="productPriceAdd">Price <b
                                        class="text-danger">*</b></label>
                                <input type="number" class="form-control" name="productPriceAdd" id="productPriceAdd"
                                    required>
                            </div>

                        </div>
                        <div class="row mt-1">
                            <div class="col-md-12">

                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="productImageAdd" id="productImageAdd">
                            </div>

                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-success" type="submit">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
