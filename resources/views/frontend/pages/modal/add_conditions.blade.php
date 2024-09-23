<!-- Modal -->
<div class="modal fade" id="edit_unit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="#">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Conditions</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Overall Condition</label>
                                <select class="form-select shadow-none" aria-label="Default select example" id="productConditionOne">
                                    <option value="">Please Select</option>
                                    <option value="A(Mint)">A(Mint)</option>
                                    <option value="AB(Excellent)">AB(Excellent)</option>
                                    <option value="B(Gently Used)">B(Gently Used)</option>
                                    <option value="BC(Used)">BC(Used)</option>
                                    <option value="C(Well Used)">C(Well Used)</option>
                                    <option value="D(Need Repair)">D(Need Repair)</option>

                                </select>
                                <span style="color:red" id="condition_one_error"></span>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Smell</label>
                                <select class="form-select shadow-none" aria-label="Default select example" id="productConditionTwo">
                                    <option value="">Please Select</option>
                                    <option value="No">No</option>
                                    <option value="Minor">Minor</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Major">Major</option>

                                </select>
                                <span style="color:red" id="condition_two_error"></span>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Corners Rubbing</label>
                                <select class="form-select shadow-none" aria-label="Default select example" id="productConditionThree">
                                    <option value="">Please Select</option>
                                    <option value="No">No</option>
                                    <option value="Minor">Minor</option>
                                    <option value="Major">Major</option>

                                </select>
                                <span style="color:red" id="condition_three_error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-success save_condition" id="save_condition_index" type="button">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
