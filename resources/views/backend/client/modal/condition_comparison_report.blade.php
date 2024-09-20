@php
    function findAccessoriesList($items) {
        $accessories = [
            'dust_b' => 'Dust B',
            'box' => 'Box',
            'strap' => 'Strap',
            'chain' => 'Chain',
            'padlock' => 'Padlock',
            'keys' => 'Keys',
            'clochette' => 'Clochette',
            'coa' => 'COA',
            'tag' => 'Tag',
            'wristlet' => 'Wristlet',
        ];

        $output = [];
        foreach ($items as $item) {
            if (isset($accessories[$item])) {
                $output[] = $accessories[$item];
            }
        }

        return $output;
    }

    if (!function_exists('getValue1')) {
        function getValue1($data, $fieldName) {
            if (isset($data) && $data->{$fieldName}) {
                $item = json_decode($data->{$fieldName});

                return (isset($item->value1) && $item->value1) ? $item->value1 : '';

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
@endphp

<table class="table">
    <thead>
        <tr>
            <th style="width: 15%;"></th>
            <th>Customer Inspection</th>
            <th>Incoming Inspection</th>
            <th>Listing Inspection</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="4"><b>Exterior Body</b></td>
        </tr>
        <tr>
            <td>Color</td>
            <td>
                {{ getValue1($firstInspection, 'exterior_body_color') }} {!! (getValue1($firstInspection, 'exterior_body_color') == 'Other') ? '<br>' : '' !!}
                {{ getValue2($firstInspection, 'exterior_body_color') }}
            </td>
            <td>
                {{ getValue1($secondInspection, 'exterior_body_color') }} {!! (getValue1($secondInspection, 'exterior_body_color') == 'Other') ? '<br>' : '' !!}
                {{ getValue2($secondInspection, 'exterior_body_color') }}
            </td>
            <td>
                {{ getValue1($thirdInspection, 'exterior_body_color') }} {!! (getValue1($thirdInspection, 'exterior_body_color') == 'Other') ? '<br>' : '' !!}
                {{ getValue2($thirdInspection, 'exterior_body_color') }}
            </td>
        </tr>
        <tr>
            <td>Signs of use</td>
            <td>
                {{ getValue1($firstInspection, 'exterior_body_sign_of_use') }}
            </td>
            <td>
                {{ getValue1($secondInspection, 'exterior_body_sign_of_use') }}
            </td>
            <td>
                {{ getValue1($thirdInspection, 'exterior_body_sign_of_use') }}
            </td>
        </tr>
        <tr>
            <td>Scratches</td>
            <td>
                {{ getValue1($firstInspection, 'exterior_body_scratches') }} {!! getValue1($firstInspection, 'exterior_body_scratches') ? '<br>' : '' !!}
                {{ getValue2($firstInspection, 'exterior_body_scratches') }}
            </td>
            <td>
                {{ getValue1($secondInspection, 'exterior_body_scratches') }} {!! getValue1($secondInspection, 'exterior_body_scratches') ? '<br>' : '' !!}
                {{ getValue2($secondInspection, 'exterior_body_scratches') }}
            </td>
            <td>
                {{ getValue1($thirdInspection, 'exterior_body_scratches') }} {!! getValue1($thirdInspection, 'exterior_body_scratches') ? '<br>' : '' !!}
                {{ getValue2($thirdInspection, 'exterior_body_scratches') }}
            </td>
        </tr>
        <tr>
            <td>Peeling</td>
            <td>
                {{ getValue1($firstInspection, 'peeling') }} {!! getValue1($firstInspection, 'peeling') ? '<br>' : '' !!}
                {{ getValue2($firstInspection, 'peeling') }}
            </td>
            <td>
                {{ getValue1($secondInspection, 'peeling') }} {!! getValue1($secondInspection, 'peeling') ? '<br>' : '' !!}
                {{ getValue2($secondInspection, 'peeling') }}
            </td>
            <td>
                {{ getValue1($thirdInspection, 'peeling') }} {!! getValue1($thirdInspection, 'peeling') ? '<br>' : '' !!}
                {{ getValue2($thirdInspection, 'peeling') }}
            </td>
        </tr>
        <tr>
            <td>Color transfer</td>
            <td>
                {{ getValue1($firstInspection, 'color_transfer') }} {!! getValue1($firstInspection, 'color_transfer') ? '<br>' : '' !!}
                {{ getValue2($firstInspection, 'color_transfer') }}
            </td>
            <td>
                {{ getValue1($secondInspection, 'color_transfer') }} {!! getValue1($secondInspection, 'color_transfer') ? '<br>' : '' !!}
                {{ getValue2($secondInspection, 'color_transfer') }}
            </td>
            <td>
                {{ getValue1($thirdInspection, 'color_transfer') }} {!! getValue1($thirdInspection, 'color_transfer') ? '<br>' : '' !!}
                {{ getValue2($thirdInspection, 'color_transfer') }}
            </td>
        </tr>
        <tr>
            <td>Body rubbing/Permanent marks</td>
            <td>
                {{ getValue1($firstInspection, 'body_rubbing_marks') }} {!! getValue1($firstInspection, 'body_rubbing_marks') ? '<br>' : '' !!}
                {{ getValue2($firstInspection, 'body_rubbing_marks') }}
            </td>
            <td>
                {{ getValue1($secondInspection, 'body_rubbing_marks') }} {!! getValue1($secondInspection, 'body_rubbing_marks') ? '<br>' : '' !!}
                {{ getValue2($secondInspection, 'body_rubbing_marks') }}
            </td>
            <td>
                {{ getValue1($thirdInspection, 'body_rubbing_marks') }} {!! getValue1($thirdInspection, 'body_rubbing_marks') ? '<br>' : '' !!}
                {{ getValue2($thirdInspection, 'body_rubbing_marks') }}
            </td>
        </tr>
        <tr>
            <td>Loose threads</td>
            <td>
                {{ getValue1($firstInspection, 'loose_threads') }} {!! getValue1($firstInspection, 'loose_threads') ? '<br>' : '' !!}
                {{ getValue2($firstInspection, 'loose_threads') }}
            </td>
            <td>
                {{ getValue1($secondInspection, 'loose_threads') }} {!! getValue1($secondInspection, 'loose_threads') ? '<br>' : '' !!}
                {{ getValue2($secondInspection, 'loose_threads') }}
            </td>
            <td>
                {{ getValue1($thirdInspection, 'loose_threads') }} {!! getValue1($thirdInspection, 'loose_threads') ? '<br>' : '' !!}
                {{ getValue2($thirdInspection, 'loose_threads') }}
            </td>
        </tr>
        <tr>
            <td>Wear on Corners/Edges</td>
            <td>
                {{ getValue1($firstInspection, 'wear_on_corners_edges') }}
            </td>
            <td>
                {{ getValue1($secondInspection, 'wear_on_corners_edges') }}
            </td>
            <td>
                {{ getValue1($thirdInspection, 'wear_on_corners_edges') }}
            </td>
        </tr>
        <tr>
            <td>Bag out of shape</td>
            <td>
                {{ getValue1($firstInspection, 'bag_out_of_shapes') }}
            </td>
            <td>
                {{ getValue1($secondInspection, 'bag_out_of_shapes') }}
            </td>
            <td>
                {{ getValue1($thirdInspection, 'bag_out_of_shapes') }}
            </td>
        </tr>
        <tr>
            <td>Tanned/Signs on Handles Straps</td>
            <td>
                {{ getValue1($firstInspection, 'signs_on_handles_straps') }}
            </td>
            <td>
                {{ getValue1($secondInspection, 'signs_on_handles_straps') }}
            </td>
            <td>
                {{ getValue1($thirdInspection, 'signs_on_handles_straps') }}
            </td>
        </tr>
        <tr>
            <td>Cracking</td>
            <td>
                {{ getValue1($firstInspection, 'cracking') }} {!! getValue1($firstInspection, 'cracking') ? '<br>' : '' !!}
                {{ getValue2($firstInspection, 'cracking') }}
            </td>
            <td>
                {{ getValue1($secondInspection, 'cracking') }} {!! getValue1($secondInspection, 'cracking') ? '<br>' : '' !!}
                {{ getValue2($secondInspection, 'cracking') }}
            </td>
            <td>
                {{ getValue1($thirdInspection, 'cracking') }} {!! getValue1($thirdInspection, 'cracking') ? '<br>' : '' !!}
                {{ getValue2($thirdInspection, 'cracking') }}
            </td>
        </tr>
        <tr>
            <td>Repainted</td>
            <td>
                {{ getValue1($firstInspection, 'repainted') }} {!! getValue1($firstInspection, 'repainted') ? '<br>' : '' !!}
                {{ getValue2($firstInspection, 'repainted') }}
            </td>
            <td>
                {{ getValue1($secondInspection, 'repainted') }} {!! getValue1($secondInspection, 'repainted') ? '<br>' : '' !!}
                {{ getValue2($secondInspection, 'repainted') }}
            </td>
            <td>
                {{ getValue1($thirdInspection, 'repainted') }} {!! getValue1($thirdInspection, 'repainted') ? '<br>' : '' !!}
                {{ getValue2($thirdInspection, 'repainted') }}
            </td>
        </tr>


        <tr>
            <td colspan="4"><b>Hardware</b></td>
        </tr>
        <tr>
            <td>Color</td>
            <td>
                {{ getValue1($firstInspection, 'haraware_color') }} {!! (getValue1($firstInspection, 'haraware_color') == 'Other') ? '<br>' : '' !!}
                {{ getValue2($firstInspection, 'haraware_color') }}
            </td>
            <td>
                {{ getValue1($secondInspection, 'haraware_color') }} {!! (getValue1($secondInspection, 'haraware_color') == 'Other') ? '<br>' : '' !!}
                {{ getValue2($secondInspection, 'haraware_color') }}
            </td>
            <td>
                {{ getValue1($thirdInspection, 'haraware_color') }} {!! (getValue1($thirdInspection, 'haraware_color') == 'Other') ? '<br>' : '' !!}
                {{ getValue2($thirdInspection, 'haraware_color') }}
            </td>
        </tr>
        <tr>
            <td>Condition</td>
            <td>
                {{ getValue1($firstInspection, 'hardware_excellent') }}
            </td>
            <td>
                {{ getValue1($secondInspection, 'hardware_excellent') }}
            </td>
            <td>
                {{ getValue1($thirdInspection, 'hardware_excellent') }}
            </td>
        </tr>
        <tr>
            <td>Discoloration</td>
            <td>
                {{ getValue1($firstInspection, 'discoloration') }} {!! getValue1($firstInspection, 'discoloration') ? '<br>' : '' !!}
                {{ getValue2($firstInspection, 'discoloration') }}
            </td>
            <td>
                {{ getValue1($secondInspection, 'discoloration') }} {!! getValue1($secondInspection, 'discoloration') ? '<br>' : '' !!}
                {{ getValue2($secondInspection, 'discoloration') }}
            </td>
            <td>
                {{ getValue1($thirdInspection, 'discoloration') }} {!! getValue1($thirdInspection, 'discoloration') ? '<br>' : '' !!}
                {{ getValue2($thirdInspection, 'discoloration') }}
            </td>
        </tr>
        <tr>
            <td>Scratches</td>
            <td>
                {{ getValue1($firstInspection, 'hardware_scrateches') }} {!! getValue1($firstInspection, 'hardware_scrateches') ? '<br>' : '' !!}
                {{ getValue2($firstInspection, 'hardware_scrateches') }}
            </td>
            <td>
                {{ getValue1($secondInspection, 'hardware_scrateches') }} {!! getValue1($secondInspection, 'hardware_scrateches') ? '<br>' : '' !!}
                {{ getValue2($secondInspection, 'hardware_scrateches') }}
            </td>
            <td>
                {{ getValue1($thirdInspection, 'hardware_scrateches') }} {!! getValue1($thirdInspection, 'hardware_scrateches') ? '<br>' : '' !!}
                {{ getValue2($thirdInspection, 'hardware_scrateches') }}
            </td>
        </tr>
        <tr>
            <td>Sign of use</td>
            <td>
                {{ getValue1($firstInspection, 'hardware_sign_of_use') }}
            </td>
            <td>
                {{ getValue1($secondInspection, 'hardware_sign_of_use') }}
            </td>
            <td>
                {{ getValue1($thirdInspection, 'hardware_sign_of_use') }}
            </td>
        </tr>


        <tr>
            <td colspan="4"><b>Inside</b></td>
        </tr>
        <tr>
            <td>Smell</td>
            <td>
                {{ getValue1($firstInspection, 'smell') }} {!! getValue1($firstInspection, 'smell') ? '<br>' : '' !!}
                {{ getValue2($firstInspection, 'smell') }}
            </td>
            <td>
                {{ getValue1($secondInspection, 'smell') }} {!! getValue1($secondInspection, 'smell') ? '<br>' : '' !!}
                {{ getValue2($secondInspection, 'smell') }}
            </td>
            <td>
                {{ getValue1($thirdInspection, 'smell') }} {!! getValue1($thirdInspection, 'smell') ? '<br>' : '' !!}
                {{ getValue2($thirdInspection, 'smell') }}
            </td>
        </tr>
        <tr>
            <td>Condition</td>
            <td>
                {{ getValue1($firstInspection, 'inside_clean_excellent') }}
            </td>
            <td>
                {{ getValue1($secondInspection, 'inside_clean_excellent') }}
            </td>
            <td>
                {{ getValue1($thirdInspection, 'inside_clean_excellent') }}
            </td>
        </tr>
        <tr>
            <td>Stains</td>
            <td>
                {{ getValue1($firstInspection, 'stains') }} {!! getValue1($firstInspection, 'stains') ? '<br>' : '' !!}
                {{ getValue2($firstInspection, 'stains') }}
            </td>
            <td>
                {{ getValue1($secondInspection, 'stains') }} {!! getValue1($secondInspection, 'stains') ? '<br>' : '' !!}
                {{ getValue2($secondInspection, 'stains') }}
            </td>
            <td>
                {{ getValue1($thirdInspection, 'stains') }} {!! getValue1($thirdInspection, 'stains') ? '<br>' : '' !!}
                {{ getValue2($thirdInspection, 'stains') }}
            </td>
        </tr>
        <tr>
            <td>Tears</td>
            <td>
                {{ getValue1($firstInspection, 'tears') }} {!! getValue1($firstInspection, 'tears') ? '<br>' : '' !!}
                {{ getValue2($firstInspection, 'tears') }}
            </td>
            <td>
                {{ getValue1($secondInspection, 'tears') }} {!! getValue1($secondInspection, 'tears') ? '<br>' : '' !!}
                {{ getValue2($secondInspection, 'tears') }}
            </td>
            <td>
                {{ getValue1($thirdInspection, 'tears') }} {!! getValue1($thirdInspection, 'tears') ? '<br>' : '' !!}
                {{ getValue2($thirdInspection, 'tears') }}
            </td>
        </tr>
        <tr>
            <td>No "Made in ****" on bag</td>
            <td>{{ isset($firstInspection) ? $firstInspection->no_make_in : '' }}</td>
            <td>{{ isset($secondInspection) ? $secondInspection->no_make_in : '' }}</td>
            <td>{{ isset($thirdInspection) ? $thirdInspection->no_make_in : '' }}</td>
        </tr>
        <tr>
            <td>Date Code</td>
            <td>{{ isset($firstInspection) ? $firstInspection->date_code : '' }}</td>
            <td>{{ isset($secondInspection) ? $secondInspection->date_code : '' }}</td>
            <td>{{ isset($thirdInspection) ? $thirdInspection->date_code : '' }}</td>
        </tr>
        <tr>
            <td>Bag Measurements</td>
            <td>
                <b>W: </b>{{ isset($firstInspection) ? $firstInspection->measurement_w : '' }}<br>
                <b>D: </b>{{ isset($firstInspection) ? $firstInspection->measurement_d : '' }}<br>
                <b>H: </b>{{ isset($firstInspection) ? $firstInspection->measurement_h : '' }}
            </td>
            <td>
                <b>W: </b>{{ isset($secondInspection) ? $secondInspection->measurement_w : '' }}<br>
                <b>D: </b>{{ isset($secondInspection) ? $secondInspection->measurement_d : '' }}<br>
                <b>H: </b>{{ isset($secondInspection) ? $secondInspection->measurement_h : '' }}
            </td>
            <td>
                <b>W: </b>{{ isset($thirdInspection) ? $thirdInspection->measurement_w : '' }}<br>
                <b>D: </b>{{ isset($thirdInspection) ? $thirdInspection->measurement_d : '' }}<br>
                <b>H: </b>{{ isset($thirdInspection) ? $thirdInspection->measurement_h : '' }}
            </td>
        </tr>
        @php
            if (isset($firstInspection)) {
                $firstAccessories = json_decode($firstInspection->accessories);
            }
            if (isset($secondInspection)) {
                $secondAccessories = json_decode($secondInspection->accessories);
            }
            if (isset($thirdInspection)) {
                $thirdAccessories = json_decode($thirdInspection->accessories);
            }
        @endphp
        <tr>
            <td>Accessories</td>
            <td>{{ isset($firstAccessories) ? implode(', ', findAccessoriesList($firstAccessories)) : '' }}</td>
            <td>{{ isset($secondAccessories) ? implode(', ', findAccessoriesList($secondAccessories)) : '' }}</td>
            <td>{{ isset($thirdAccessories) ? implode(', ', findAccessoriesList($thirdAccessories)) : '' }}</td>
        </tr>
        <tr>
            <td>Notes</td>
            <td>{{ isset($firstInspection) ? $firstInspection->notes : '' }}</td>
            <td>{{ isset($secondInspection) ? $secondInspection->notes : '' }}</td>
            <td>{{ isset($thirdInspection) ? $thirdInspection->notes : '' }}</td>
        </tr>
    </tbody>
</table>