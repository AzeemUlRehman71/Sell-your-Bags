<!-- Modal -->
<div class="modal fade" id="edit_unit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{ route('client.edit_unit') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Pos Status</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" id="edit_product_id" name="edit_product_id">
                                <label class="form-label">Status</label>
                                {{-- <input type="text" class="form-control" name="unit_name" id="unit_names"
                                    value="unit_names" required placeholder="Enter Unit Name..."> --}}

                                <select class="form-select shadow-none" aria-label="Default select example"
                                    name="client_status" id="client_status" value="client_status">
                                    {{-- <option selected>Select Condition</option> --}}
                                    {{--<option value="Pending">Pending</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Rejected">Rejected</option>
                                    <option value="Fake">Fake</option>
                                    <option value="Return to sender">Return to sender</option>
                                    <option value="Under discussion">Under discussion</option>
                                    <option value="Authentication pending">Authentication pending</option>
                                    <option value="Ready for authentication">Ready for authentication</option>
                                    <option value="Authentication completed">Authentication completed</option>
                                    <option value="Payment Completed">Payment Completed</option>
                                    <option value="Label Sent">Label Sent</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="Incoming Sent">Incoming Sent</option>--}}

                                    <option value="1.Label Sent">1.Label Sent</option>
                                    <option value="2.Under Discussion">2.Under Discussion</option>
                                    <option value="3.Approved">3.Approved</option>
                                    <option value="4.Returned to Sender">4.Returned to Sender</option>
                                    <option value="5.Payment Completed">5.Payment Completed</option>

{{--                                    <option value="2.Item Received/Delivered">2.Item Received/Delivered</option>--}}
{{--                                    <option value="4.Authentication in Progress">4.Authentication in Progress</option>--}}
{{--                                    <option value="5.Authentication Completed">5.Authentication Completed</option>--}}
{{--                                    <option value="7.Rejected">7.Rejected</option>--}}
{{--                                    <option value="8.Fake">8.Fake</option>--}}


                                </select>
                            </div>
                        </div>

                        <div class="row mt-1">
                            {{-- <div class="col-md-12">
                                <label class="form-label">Value <b class="text-danger">*</b></label>
                                <input type="text" class="form-control" name="value" id="unit_value"
                                    placeholder="Enter Unit Value..." onkeyup="edit_cal_sub_unit_price()" required>
                            </div> --}}

                        </div>

                        {{-- <div class="col-md-12">
                            <select class="form-select shadow-none" aria-label="Default select example"
                                name="productCondition" id="productCondition" value="">
                                <option selected>Select Condition</option>
                                <option value="Pending">Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div> --}}

                        {{-- <div class="row mt-1">
                            <div class="col-md-12">
                                <label class="form-label" for="edit_product_price">Price <b
                                        class="text-danger">*</b></label>
                                <input type="number" class="form-control" name="price" id="edit_product_price"
                                    data-price="" onchange="edit_cal_sub_unit_price()" required
                                    placeholder="Enter Price...">
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-success" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
