@php
    if (!function_exists('isValue1Checked')) {
        function isValue1Checked($data, $fieldName, $option) {
            if (isset($data) && $data->{$fieldName}) {
                $item = json_decode($data->{$fieldName});

                return (isset($item->value1) && $item->value1 == $option) ? 'selected' : '';

            }
            return '';
        }
    }

    if (!function_exists('getValue2')) {
        function getValue2($data, $fieldName) {
            if (isset($data) && $data->{$fieldName}) {
                $item = json_decode($data->{$fieldName});

                return (isset($item->value2) && $item->value2) ? $item->value2 : '';

            }
            return '';
        }
    }

    if (!function_exists('value2Visibility')) {
        function value2Visibility($data, $fieldName) {
            if (isset($data) && $data->{$fieldName}) {
                $item = json_decode($data->{$fieldName});

                return isset($item->value2) ? '' : 'display: none;';

            }
            return 'display: none;';
        }
    }

    if (!function_exists('isChecked')) {
        function isChecked($data, $fieldName, $option) {
            if (isset($data) && $data->{$fieldName}) {
                return (isset($data->{$fieldName}) && $data->{$fieldName} == $option) ? 'selected' : '';
            }
            return '';
        }
    }

@endphp

<form action="#" method="POST" id="{{$formId}}-form">

    <input type="hidden" name="product_id" class="po-product-id" value="{{ $productId }}">
    <input type="hidden" name="inspection_type" value="{{ $inspectionType }}">
    <h4 class="text-center" id="{{$formId}}-condition-report-title">{{ $title }}</h4>
    
    <div class="row">
        <h4 class="fw-bold" style="color: black; padding-left: 0px;">Exterior Body</h4>
    </div>

    <div class="mb-2 row">
        <label for="staticEmail" class="col-sm-3 col-form-label fw-bold fs-5">Color</label>
        <div class="col-sm-4">
            <select class="form-select" name="exterior_body_color[value1]" onchange="showInput(this, 'Other', '{{ $formId }}_exterior_body_color')">
                <option></option>
                <option value="Blue" {{ isValue1Checked($data, 'exterior_body_color', 'Blue') }}>Blue</option>
                <option value="Red" {{ isValue1Checked($data, 'exterior_body_color', 'Red') }}>Red</option>
                <option value="Green" {{ isValue1Checked($data, 'exterior_body_color', 'Green') }}>Green</option>
                <option value="Pink" {{ isValue1Checked($data, 'exterior_body_color', 'Pink') }}>Pink</option>
                <option value="Yellow" {{ isValue1Checked($data, 'exterior_body_color', 'Yellow') }}>Yellow</option>
                <option value="Black" {{ isValue1Checked($data, 'exterior_body_color', 'Black') }}>Black</option>
                <option value="Brown" {{ isValue1Checked($data, 'exterior_body_color', 'Brown') }}>Brown</option>
                <option value="Gray" {{ isValue1Checked($data, 'exterior_body_color', 'Gray') }}>Gray</option>
                <option value="White" {{ isValue1Checked($data, 'exterior_body_color', 'White') }}>White</option>
                <option value="Other" {{ isValue1Checked($data, 'exterior_body_color', 'Other') }}>Other</option>
            </select>
        </div>
        <div class="col-sm-5">
            <input type="text"  name="exterior_body_color[value2]" class="form-control" style="{{ value2Visibility($data, 'exterior_body_color') }}" id="{{ $formId }}_exterior_body_color" value="{{ getValue2($data, 'exterior_body_color') }}">
        </div>
    </div>

    <div class="mb-2 row">
        <label for="staticEmail" class="col-sm-3 col-form-label fw-bold fs-5">Signs of use</label>
        <div class="col-sm-4">
            <select class="form-select" name="exterior_body_sign_of_use[value1]">
                <option></option>
                <option value="No" {{ isValue1Checked($data, 'exterior_body_sign_of_use', 'No') }}>No</option>
                <option value="Minor" {{ isValue1Checked($data, 'exterior_body_sign_of_use', 'Minor') }}>Minor</option>
                <option value="Moderate" {{ isValue1Checked($data, 'exterior_body_sign_of_use', 'Moderate') }}>Moderate</option>
                <option value="Major" {{ isValue1Checked($data, 'exterior_body_sign_of_use', 'Major') }}>Major</option>
            </select>
        </div>
        <div class="col-sm-5">
        </div>
    </div>

    <div class="mb-2 row">
        <label for="staticEmail" class="col-sm-3 col-form-label fw-bold fs-5">Scratches</label>
        <div class="col-sm-4">
            <select class="form-select" name="exterior_body_scratches[value1]" onchange="showInput(this, 'Yes', '{{ $formId }}_exterior_body_scratches')">
                <option></option>
                <option value="Yes" {{ isValue1Checked($data, 'exterior_body_scratches', 'Yes') }}>Yes</option>
                <option value="No" {{ isValue1Checked($data, 'exterior_body_scratches', 'No') }}>No</option>
            </select>
        </div>
        <div class="col-sm-5">
            <input type="text" name="exterior_body_scratches[value2]" class="form-control" style="{{ value2Visibility($data, 'exterior_body_scratches') }}" id="{{ $formId }}_exterior_body_scratches" value="{{ getValue2($data, 'exterior_body_scratches') }}">
        </div>
    </div>

    <div class="mb-2 row">
        <label for="staticEmail" class="col-sm-3 col-form-label fw-bold fs-5">Peeling</label>
        <div class="col-sm-4">
            <select class="form-select" name="peeling[value1]" onchange="showInput(this, 'Yes', '{{ $formId }}_peeling')">
                <option></option>
                <option value="Yes" {{ isValue1Checked($data, 'peeling', 'Yes') }}>Yes</option>
                <option value="No" {{ isValue1Checked($data, 'peeling', 'No') }}>No</option>
            </select>
        </div>
        <div class="col-sm-5">
            <input type="text" name="peeling[value2]" class="form-control" style="{{ value2Visibility($data, 'peeling') }}" id="{{ $formId }}_peeling" value="{{ getValue2($data, 'peeling') }}">
        </div>
    </div>

    <div class="mb-2 row">
        <label for="staticEmail" class="col-sm-3 col-form-label fw-bold fs-5">Color transfer</label>
        <div class="col-sm-4">
            <select class="form-select" name="color_transfer[value1]" onchange="showInput(this, 'Yes', '{{ $formId }}_color_transfer')">
                <option></option>
                <option value="Yes" {{ isValue1Checked($data, 'color_transfer', 'Yes') }}>Yes</option>
                <option value="No" {{ isValue1Checked($data, 'color_transfer', 'No') }}>No</option>
            </select>
        </div>
        <div class="col-sm-5">
            <input type="text" name="color_transfer[value2]" class="form-control" style="{{ value2Visibility($data, 'color_transfer') }}" id="{{ $formId }}_color_transfer" value="{{ getValue2($data, 'color_transfer') }}">
        </div>
    </div>

    <div class="mb-2 row">
        <label for="staticEmail" class="col-sm-3 col-form-label fw-bold fs-5">Body rubbing/Permanent marks</label>
        <div class="col-sm-4">
            <select class="form-select" name="body_rubbing_marks[value1]" onchange="showInput(this, 'Yes', '{{ $formId }}_body_rubbing_marks')">
                <option></option>
                <option value="Yes" {{ isValue1Checked($data, 'body_rubbing_marks', 'Yes') }}>Yes</option>
                <option value="No" {{ isValue1Checked($data, 'body_rubbing_marks', 'No') }}>No</option>
            </select>
        </div>
        <div class="col-sm-5">
            <input type="text" name="body_rubbing_marks[value2]" class="form-control" style="{{ value2Visibility($data, 'body_rubbing_marks') }}" id="{{ $formId }}_body_rubbing_marks" value="{{ getValue2($data, 'body_rubbing_marks') }}">
        </div>
    </div>

    <div class="mb-2 row">
        <label for="staticEmail" class="col-sm-3 col-form-label fw-bold fs-5">Loose threads</label>
        <div class="col-sm-4">
            <select class="form-select" name="loose_threads[value1]" onchange="showInput(this, 'Yes', '{{ $formId }}_loose_threads')">
                <option></option>
                <option value="Yes" {{ isValue1Checked($data, 'loose_threads', 'Yes') }}>Yes</option>
                <option value="No" {{ isValue1Checked($data, 'loose_threads', 'No') }}>No</option>
            </select>
        </div>
        <div class="col-sm-5">
            <input type="text" name="loose_threads[value2]" class="form-control" style="{{ value2Visibility($data, 'loose_threads') }}" id="{{ $formId }}_loose_threads" value="{{ getValue2($data, 'loose_threads') }}">
        </div>
    </div>

    <div class="mb-2 row">
        <label for="staticEmail" class="col-sm-3 col-form-label fw-bold fs-5">Wear on Corners/Edges</label>
        <div class="col-sm-4">
            <select class="form-select" name="wear_on_corners_edges[value1]">
                <option></option>
                <option value="No" {{ isValue1Checked($data, 'wear_on_corners_edges', 'No') }}>No</option>
                <option value="Minor" {{ isValue1Checked($data, 'wear_on_corners_edges', 'Minor') }}>Minor</option>
                <option value="Major" {{ isValue1Checked($data, 'wear_on_corners_edges', 'Major') }}>Major</option>
            </select>
        </div>
        <div class="col-sm-5">
        </div>
    </div>

    <div class="mb-2 row">
        <label for="staticEmail" class="col-sm-3 col-form-label fw-bold fs-5">Bag out of shape</label>
        <div class="col-sm-4">
            <select class="form-select" name="bag_out_of_shapes[value1]">
                <option></option>
                <option value="Yes" {{ isValue1Checked($data, 'bag_out_of_shapes', 'Yes') }}>Yes</option>
                <option value="No" {{ isValue1Checked($data, 'bag_out_of_shapes', 'No') }}>No</option>
                <option value="Minor" {{ isValue1Checked($data, 'bag_out_of_shapes', 'Minor') }}>Minor</option>
                <option value="Major" {{ isValue1Checked($data, 'bag_out_of_shapes', 'Major') }}>Major</option>
            </select>
        </div>
        <div class="col-sm-5">
        </div>
    </div>

    <div class="mb-2 row">
        <label for="staticEmail" class="col-sm-3 col-form-label fw-bold fs-5">Tanned/Signs on Handles Straps</label>
        <div class="col-sm-4">
            <select class="form-select" name="signs_on_handles_straps[value1]">
                <option></option>
                <option value="Yes Light" {{ isValue1Checked($data, 'signs_on_handles_straps', 'Yes Light') }}>Yes Light</option>
                <option value="Yes Medium" {{ isValue1Checked($data, 'signs_on_handles_straps', 'Yes Medium') }}>Yes Medium</option>
                <option value="Yes Major" {{ isValue1Checked($data, 'signs_on_handles_straps', 'Yes Major') }}>Yes Major</option>
                <option value="No Tanning" {{ isValue1Checked($data, 'signs_on_handles_straps', 'No Tanning') }}>No Tanning</option>
            </select>
        </div>
        <div class="col-sm-5">
        </div>
    </div>

    <div class="mb-2 row">
        <label for="staticEmail" class="col-sm-3 col-form-label fw-bold fs-5">Cracking</label>
        <div class="col-sm-4">
            <select class="form-select" name="cracking[value1]" onchange="showInput(this, 'Yes', '{{ $formId }}_cracking')">
                <option></option>
                <option value="Yes" {{ isValue1Checked($data, 'cracking', 'Yes') }}>Yes</option>
                <option value="No" {{ isValue1Checked($data, 'cracking', 'No') }}>No</option>
            </select>
        </div>
        <div class="col-sm-5">
            <input type="text" name="cracking" class="form-control" style="{{ value2Visibility($data, 'cracking') }}" id="{{ $formId }}_cracking" value="{{ getValue2($data, 'cracking') }}">
        </div>
    </div>

    <div class="mb-2 row pb-3" style=" border-bottom: 1px lightgray dashed;">
        <label for="staticEmail" class="col-sm-3 col-form-label fw-bold fs-5">Repainted</label>
        <div class="col-sm-4">
            <select class="form-select" name="repainted[value1]" onchange="showInput(this, 'Yes', '{{ $formId }}_repainted')">
                <option></option>
                <option value="Yes" {{ isValue1Checked($data, 'repainted', 'Yes') }}>Yes</option>
                <option value="No" {{ isValue1Checked($data, 'repainted', 'No') }}>No</option>
            </select>
        </div>
        <div class="col-sm-5">
            <input type="text" name="repainted" class="form-control" style="{{ value2Visibility($data, 'repainted') }}" id="{{ $formId }}_repainted" value="{{ getValue2($data, 'repainted') }}">
        </div>
    </div>

    <div class="row mt-3">
        <h4 class="fw-bold" style="color: black; padding-left: 0px;">Hardware</h4>
    </div>

    <div class="mb-2 row">
        <label for="staticEmail" class="col-sm-3 col-form-label fw-bold fs-5">Color</label>
        <div class="col-sm-4">
            <select class="form-select" name="haraware_color[value1]" onchange="showInput(this, 'Other', '{{ $formId }}_haraware_color')">
                <option></option>
                <option value="Gold" {{ isValue1Checked($data, 'haraware_color', 'Gold') }}>Gold</option>
                <option value="Silver" {{ isValue1Checked($data, 'haraware_color', 'Silver') }}>Silver</option>
                <option value="Copper" {{ isValue1Checked($data, 'haraware_color', 'Copper') }}>Copper</option>
                <option value="Bronze" {{ isValue1Checked($data, 'haraware_color', 'Bronze') }}>Bronze</option>
                <option value="Black" {{ isValue1Checked($data, 'haraware_color', 'Black') }}>Black</option>
                <option value="Other" {{ isValue1Checked($data, 'haraware_color', 'Other') }}>Other</option>
            </select>
        </div>
        <div class="col-sm-5">
        <input type="text" name="haraware_color[value2]" class="form-control" style="{{ value2Visibility($data, 'haraware_color') }}" id="{{ $formId }}_haraware_color" value="{{ getValue2($data, 'haraware_color') }}">
        </div>
    </div>

    <div class="mb-2 row">
        <label for="staticEmail" class="col-sm-3 col-form-label fw-bold fs-5">Condition</label>
        <div class="col-sm-4">
            <select class="form-select" name="hardware_excellent[value1]">
                <option></option>
                <option value="Excellent" {{ isValue1Checked($data, 'hardware_excellent', 'Excellent') }}>Excellent</option>
                <option value="Very Good" {{ isValue1Checked($data, 'hardware_excellent', 'Very Good') }}>Very Good</option>
                <option value="Good" {{ isValue1Checked($data, 'hardware_excellent', 'Gold') }}>Good</option>
                <option value="Used" {{ isValue1Checked($data, 'hardware_excellent', 'Used') }}>Used</option>
                <option value="Well Used" {{ isValue1Checked($data, 'hardware_excellent', 'Well Used') }}>Well Used</option>
            </select>
        </div>
        <div class="col-sm-5">
        </div>
    </div>

    <div class="mb-2 row">
        <label for="staticEmail" class="col-sm-3 col-form-label fw-bold fs-5">Discoloration</label>
        <div class="col-sm-4">
            <select class="form-select" name="discoloration[value1]" onchange="showInput(this, 'Yes', '{{ $formId }}_discoloration')">
                <option></option>
                <option value="Yes" {{ isValue1Checked($data, 'discoloration', 'Yes') }}>Yes</option>
                <option value="No" {{ isValue1Checked($data, 'discoloration', 'No') }}>No</option>
            </select>
        </div>
        <div class="col-sm-5">
            <input type="text" name="discoloration[value2]" class="form-control" style="{{ value2Visibility($data, 'discoloration') }}" id="{{ $formId }}_discoloration" value="{{ getValue2($data, 'discoloration') }}">
        </div>
    </div>

    <div class="mb-2 row">
        <label for="staticEmail" class="col-sm-3 col-form-label fw-bold fs-5">Scratches</label>
        <div class="col-sm-4">
            <select class="form-select" name="hardware_scrateches[value1]" onchange="showInput(this, 'Yes', '{{ $formId }}_hardware_scrateches')">
                <option></option>
                <option value="Yes" {{ isValue1Checked($data, 'hardware_scrateches', 'Yes') }}>Yes</option>
                <option value="No" {{ isValue1Checked($data, 'hardware_scrateches', 'No') }}>No</option>
            </select>
        </div>
        <div class="col-sm-5">
            <input type="text" name="hardware_scrateches[value2]" class="form-control" style="{{ value2Visibility($data, 'hardware_scrateches') }}" id="{{ $formId }}_hardware_scrateches" value="{{ getValue2($data, 'hardware_scrateches') }}">
        </div>
    </div>

    <div class="mb-2 row pb-3" style=" border-bottom: 1px lightgray dashed;">
        <label for="staticEmail" class="col-sm-3 col-form-label fw-bold fs-5">Sign of use</label>
        <div class="col-sm-4">
            <select class="form-select" name="hardware_sign_of_use[value1]">
                <option></option>
                <option value="No" {{ isValue1Checked($data, 'hardware_sign_of_use', 'No') }}>No</option>
                <option value="Minor" {{ isValue1Checked($data, 'hardware_sign_of_use', 'Minor') }}>Minor</option>
                <option value="Moderate" {{ isValue1Checked($data, 'hardware_sign_of_use', 'Moderate') }}>Moderate</option>
                <option value="Major" {{ isValue1Checked($data, 'hardware_sign_of_use', 'Major') }}>Major</option>
            </select>
        </div>
        <div class="col-sm-5">
        </div>
    </div>

    <div class="row mt-3">
        <h4 class="fw-bold" style="color: black; padding-left: 0px;">Inside</h4>
    </div>

    <div class="mb-2 row">
        <label for="staticEmail" class="col-sm-3 col-form-label fw-bold fs-5">Smell</label>
        <div class="col-sm-4">
            <select class="form-select" name="smell[value1]" onchange="showInput(this, 'Yes', '{{ $formId }}_smell')">
                <option></option>
                <option value="Yes" {{ isValue1Checked($data, 'smell', 'Yes') }}>Yes</option>
                <option value="No" {{ isValue1Checked($data, 'smell', 'No') }}>No</option>
            </select>
        </div>
        <div class="col-sm-5">
            <input type="text" name="smell[value2]" class="form-control" style="{{ value2Visibility($data, 'smell') }}" id="{{ $formId }}_smell" value="{{ getValue2($data, 'smell') }}">
        </div>
    </div>

    <div class="mb-2 row">
        <label for="staticEmail" class="col-sm-3 col-form-label fw-bold fs-5">Condition</label>
        <div class="col-sm-4">
            <select class="form-select" name="inside_clean_excellent[value1]">
                <option></option>
                <option value="Excellent/Clean" {{ isValue1Checked($data, 'inside_clean_excellent', 'Excellent/Clean') }}>Excellent/Clean</option>
                <option value="Very Good" {{ isValue1Checked($data, 'inside_clean_excellent', 'Very Good') }}>Very Good</option>
                <option value="Good" {{ isValue1Checked($data, 'inside_clean_excellent', 'Good') }}>Good</option>
                <option value="Used" {{ isValue1Checked($data, 'inside_clean_excellent', 'Used') }}>Used</option>
                <option value="Well Used" {{ isValue1Checked($data, 'inside_clean_excellent', 'Well Used') }}>Well Used</option>
            </select>
        </div>
        <div class="col-sm-5">
        </div>
    </div>

    <div class="mb-2 row">
        <label for="staticEmail" class="col-sm-3 col-form-label fw-bold fs-5">Stains</label>
        <div class="col-sm-4">
            <select class="form-select" name="stains[value1]" onchange="showInput(this, 'Yes', '{{ $formId }}_stains')">
                <option></option>
                <option value="Yes" {{ isValue1Checked($data, 'stains', 'Yes') }}>Yes</option>
                <option value="No" {{ isValue1Checked($data, 'stains', 'No') }}>No</option>
            </select>
        </div>
        <div class="col-sm-5">
            <input type="text" name="stains[value2]" class="form-control" style="{{ value2Visibility($data, 'stains') }}" id="{{ $formId }}_stains" value="{{ getValue2($data, 'stains') }}">
        </div>
    </div>

    <div class="mb-2 row">
        <label for="staticEmail" class="col-sm-3 col-form-label fw-bold fs-5">Tears</label>
        <div class="col-sm-4">
            <select class="form-select" name="tears[value1]" onchange="showInput(this, 'Yes', '{{ $formId }}_tears')">
                <option></option>
                <option value="Yes" {{ isValue1Checked($data, 'tears', 'Yes') }}>Yes</option>
                <option value="No" {{ isValue1Checked($data, 'tears', 'No') }}>No</option>
            </select>
        </div>
        <div class="col-sm-5">
            <input type="text" name="tears[value2]" class="form-control" style="{{ value2Visibility($data, 'tears') }}" id="{{ $formId }}_tears" value="{{ getValue2($data, 'tears') }}">
        </div>
    </div>

    <div class="mb-2 row">
        <label for="staticEmail" class="col-sm-3 col-form-label fw-bold fs-5">No "Made in ****" on bag</label>
        <div class="col-sm-9">
        <input type="text" name="no_make_in" class="form-control" id="" value="{{ isset($data) ? $data->no_make_in : '' }}">
        </div>
    </div>

    <div class="mb-2 row">
        <label for="staticEmail" class="col-sm-3 col-form-label fw-bold fs-5">Date Code:</label>
        <div class="col-sm-9">
        <input type="text" name="date_code" class="form-control" id="" value="{{ isset($data) ? $data->date_code : '' }}">
        </div>
    </div>

    <div class="mb-2 row">
        <label for="staticEmail" class="col-sm-3 col-form-label fw-bold fs-5">Bag Measurements</label>
        <div class="col-sm-9">
        <table class="table table-bordered">
            <tr>
                <th class="text-center">W</th>
                <th class="text-center">H</th>
                <th class="text-center">D</th>
            </tr>
            <tr>
                <td>
                    <select class="form-select" name="measurement_w" onchange="showInput(this, 'Yes', '{{ $formId }}_tears')">
                        <option></option>
                        <?php
                            for ($i = 3; $i <= 36; $i++) {
                        ?>
                                <option value="{{ $i }}" {{ isChecked($data, 'measurement_w', $i) }}>{{ $i }}</option>
                        <?php
                            }
                        ?>
                    </select>

{{--                <input type="text" name="measurement_w" class="form-control" value="{{ isset($data) ? $data->measurement_w : '' }}">--}}
                </td>
                <td>
                    <select class="form-select" name="measurement_h" onchange="showInput(this, 'Yes', '{{ $formId }}_tears')">
                        <option></option>
                        <?php
                            for ($i = 3; $i <= 16; $i++) {
                        ?>
                                <option value="{{ $i }}" {{ isChecked($data, 'measurement_h', $i) }}>{{ $i }}</option>
                        <?php
                            }
                        ?>
                    </select>

{{--                    <input type="text" name="measurement_h" class="form-control" value="{{ isset($data) ? $data->measurement_h : '' }}">--}}
                </td>
                <td>
                    <select class="form-select" name="measurement_d" onchange="showInput(this, 'Yes', '{{ $formId }}_tears')">
                        <option></option>
                        <?php
                            for ($i = 1; $i <= 10; $i++) {
                        ?>
                                <option value="{{ $i }}" {{ isChecked($data, 'measurement_d', $i) }}>{{ $i }}</option>
                        <?php
                            }
                        ?>
                    </select>

{{--                    <input type="text" name="measurement_d" class="form-control" value="{{ isset($data) ? $data->measurement_d : '' }}">--}}
                </td>
            </tr>
        </table>
        </div>
    </div>


    @php
        if (isset($data)) {
            $accessories = json_decode($data->accessories);
        }
    @endphp

    <div class="mb-2 row">
        <label for="staticEmail" class="col-sm-3 col-form-label fw-bold fs-5">Accessories</label>
        <div class="col-sm-9">
        <table class="table table-bordered">
            <tr>
                <td>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="accessories[]" value="dust_b" {{ (isset($accessories) && in_array('dust_b', $accessories)) ? 'checked' : ''}} id="{{ $formId }}_dust_b">
                    <label class="form-check-label" for="{{ $formId }}_dust_b">
                        Dust B
                    </label>
                    </div>
                </td>
                <td>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="accessories[]" value="box" {{ (isset($accessories) && in_array('box', $accessories)) ? 'checked' : ''}} id="{{ $formId }}_box">
                    <label class="form-check-label" for="{{ $formId }}_box">
                        Box
                    </label>
                    </div>
                </td>
                <td>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="accessories[]" value="strap" {{ (isset($accessories) && in_array('strap', $accessories)) ? 'checked' : ''}} id="{{ $formId }}_strap">
                    <label class="form-check-label" for="{{ $formId }}_strap">
                        Strap
                    </label>
                    </div>
                </td>
                <td>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="accessories[]" value="chain" {{ (isset($accessories) && in_array('chain', $accessories)) ? 'checked' : ''}} id="{{ $formId }}_flexCheckChecked">
                    <label class="form-check-label" for="{{ $formId }}_flexCheckChecked">
                        Chain
                    </label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="accessories[]" value="padlock" {{ (isset($accessories) && in_array('padlock', $accessories)) ? 'checked' : ''}} id="{{ $formId }}_padlock">
                    <label class="form-check-label" for="{{ $formId }}_padlock">
                        Padlock
                    </label>
                    </div>
                </td>
                <td>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="accessories[]" value="keys" {{ (isset($accessories) && in_array('keys', $accessories)) ? 'checked' : ''}} id="{{ $formId }}_keys">
                    <label class="form-check-label" for="{{ $formId }}_keys">
                        Keys
                    </label>
                    </div>
                </td>
                <td>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="accessories[]" value="clochette" {{ (isset($accessories) && in_array('clochette', $accessories)) ? 'checked' : ''}} id="{{ $formId }}_clochette">
                    <label class="form-check-label" for="{{ $formId }}_clochette">
                        Clochette
                    </label>
                    </div>
                </td>
                <td>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="accessories[]" value="coa" {{ (isset($accessories) && in_array('coa', $accessories)) ? 'checked' : ''}} id="{{ $formId }}_coa">
                    <label class="form-check-label" for="{{ $formId }}_coa">
                        COA
                    </label>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="accessories[]" value="tag" {{ (isset($accessories) && in_array('tag', $accessories)) ? 'checked' : ''}} id="{{ $formId }}_tag">
                    <label class="form-check-label" for="{{ $formId }}_tag">
                        Tag
                    </label>
                    </div>
                </td>
                <td>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="accessories[]" value="wristlet" {{ (isset($accessories) && in_array('wristlet', $accessories)) ? 'checked' : ''}} id="{{ $formId }}_wristlet">
                    <label class="form-check-label" for="{{ $formId }}_wristlet">
                        Wristlet
                    </label>
                    </div>
                </td>
            </tr>
        </table>
        </div>
    </div>

    <div class="mb-2 row">
        <label for="staticEmail" class="col-sm-3 col-form-label fw-bold fs-5">Notes:</label>
        <div class="col-sm-9">
        <input type="text" name="notes" class="form-control" id="" value="{{ isset($data) ? $data->notes : '' }}">
        </div>
    </div>
</form>
