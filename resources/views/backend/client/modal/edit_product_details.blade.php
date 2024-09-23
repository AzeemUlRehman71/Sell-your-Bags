<!-- Modal -->
<div class="modal fade" id="edit_product_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{ route('client.edit_product_details') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Product Details</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" id="edit_product_id_value" name="edit_product_id_value">
                                <input type="hidden" id="total_amount_value" name="total_amount_value">
                                <input type="hidden" id="client_id_value" name="client_id_value">
                                <input type="hidden" id="product_image_value" name="product_image_value">
                                <label class="form-label">Overall Condition</label>
                                <select class="form-select shadow-none" aria-label="Default select example"
                                        name="productCondition" id="productCondition_value">
                                    <option value="">Please Select</option>
                                    <option value="A(Mint)">A(Mint)</option>
                                    <option value="AB(Excellent)">AB(Excellent)</option>
                                    <option value="B(Gently Used)">B(Gently Used)</option>
                                    <option value="BC(Used)">BC(Used)</option>
                                    <option value="C(Well Used)">C(Well Used)</option>
                                    <option value="D(Need Repair)">D(Need Repair)</option>

                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Smell</label>
                                <select class="form-select shadow-none" aria-label="Default select example"
                                        name="productConditionTwo" id="productConditionTwo_value">
                                    <option value="">Please Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Corners Rubbing</label>
                                <select class="form-select shadow-none" aria-label="Default select example"
                                        name="productConditionThree" id="productConditionThree_value">
                                    <option value="No">No</option>
                                    <option value="Minor">Minor</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Major">Major</option>

                                </select>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-md-12">
                                <label class="form-label">Item Name</label>
                                <input type="text" class="form-control" name="productName" id="productName_value">
                            </div>

                        </div>

                        <div class="row mt-1">
                            <div class="col-md-12">
                                <label class="form-label" for="productPrice_value">Price <b
                                        class="text-danger">*</b></label>
                                <input type="number" class="form-control"
                                       name="productPrice_value" id="productPrice_value" required>
                            </div>

                        </div>
                        <div class="row mt-1">
                            <div class="col-md-12" id="edit__product-images">
                            </div>

                        </div>
                        <div class="row mt-1">
                            <div class="col-md-12">
                                <!-- <img src="{{ asset('idcard/' . $clientDetails->id_card_image) }}" height="150" width="150" /> -->
                                <label class="form-label">Product Image</label>
                                <!-- <input type="file" class="form-control" name="productImage_value[]"
                                                                    id="productImage_value" multiple /> -->
                                <input type="file" name="images[]" id="productImage" class="form-control filepond"/>
                            </div>

                        </div>
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

<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js">
</script>
<script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js">
</script>
<script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>


<script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        FilePond.registerPlugin(FilePondPluginFileValidateType);
        FilePond.registerPlugin(FilePondPluginImageExifOrientation);
        FilePond.registerPlugin(FilePondPluginImageResize);
        FilePond.registerPlugin(FilePondPluginImageCrop);
        FilePond.registerPlugin(FilePondPluginImageTransform);
        FilePond.registerPlugin(FilePondPluginImagePreview);
        console.log("layout called ===>")
        console.log("layout filepond loaded ===>")
        // Get a reference to the file input element
        //basically We have used .filepond class in every file field
        //so getting all inputs here via querySelectorAll
        const inputElements = document.querySelectorAll('input.filepond');

        FilePond.setOptions({
            credits: false,
            server: {
                process: '/filepond-upload',
                revert: '/filepond-delete',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            }
        });

        Array.from(inputElements).forEach(inputElement => {
            // create a FilePond instance at the input element location
            const pond = FilePond.create((inputElement), {
                acceptedFileTypes: ['image/*'],
                labelFileTypeNotAllowed: 'Please select a valid Image type PNG/JPG.',
                allowImageCrop: true,
                allowImageExifOrientation: true,
                allowImagePreview: true,
                imagePreviewMinWidth: 100,
                imagePreviewWidth: 100,
                imagePreviewMinHeight: 80,
                imagePreviewHeight: 80,
                imagePreviewTransparencyIndicator: 'flex',
                imagePreviewMarkupShow: false,
                allowImageResize: true,
                imageResizeTargetWidth: 500,
                imageResizeTargetHeight: 350,
                imageCropAspectRatio: '16:10',
                allowImageTransform: true,
                imageTransformOutputQuality: 60,
                allowMultiple: true,
                maxFiles: 3

            });

            $('#productImage').on('FilePond:processfile', function (e) {
                console.log('file added event', e.detail);
                // document.getElementById('productPrice1').required = true;
            });

        });
        document.addEventListener('FilePond:loaded', (e) => {
            console.log("layout filepond loaded ===>")
            // Get a reference to the file input element
            //basically We have used .filepond class in every file field
            //so getting all inputs here via querySelectorAll
            const inputElements = document.querySelectorAll('input.productImageEdit');

            FilePond.setOptions({
                credits: false,
                server: {
                    process: './filepond-upload',
                    revert: './filepond-delete',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                }
            });

            Array.from(inputElements).forEach(inputElement => {
                // create a FilePond instance at the input element location
                const pond = FilePond.create((inputElement), {
                    acceptedFileTypes: ['image/*'],
                    labelFileTypeNotAllowed: 'Please select a valid Image type PNG/JPG.',
                    allowImageCrop: true,
                    allowImageExifOrientation: true,
                    allowImagePreview: true,
                    imagePreviewMinWidth: 100,
                    imagePreviewWidth: 100,
                    imagePreviewMinHeight: 80,
                    imagePreviewHeight: 80,
                    imagePreviewTransparencyIndicator: 'flex',
                    imagePreviewMarkupShow: false,
                    allowImageResize: true,
                    imageResizeTargetWidth: 500,
                    imageResizeTargetHeight: 350,
                    imageCropAspectRatio: '16:10',
                    allowImageTransform: true,
                    imageTransformOutputQuality: 60,
                    allowMultiple: true,
                    maxFiles: 3

                });

                $('#productImage').on('FilePond:processfile', function (e) {
                    console.log('file added event', e.detail);
                    // document.getElementById('productPrice1').required = true;
                });

            });
        });
    });
</script>
