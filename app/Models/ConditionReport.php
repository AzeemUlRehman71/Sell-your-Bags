<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConditionReport extends Model
{
    use HasFactory;

    protected $table = 'condition_report';

    protected $fillable = [
        'product_id','inspection_type','eb_cb_color', 'exterior_body_color',
        'eb_cb_sign_of_use', 'exterior_body_sign_of_use', 'eb_cb_scratches', 'exterior_body_scratches',
        'eb_cb_peeling', 'peeling', 'eb_cb_color_transfer', 'color_transfer',
        'eb_cb_body_rubbing_marks', 'body_rubbing_marks', 'eb_cb_loose_threads', 'loose_threads',
        'eb_cb_wear_on_corners_edges', 'wear_on_corners_edges', 'eb_cb_bag_out_of_shapes', 'bag_out_of_shapes',
        'eb_cb_signs_on_handles_straps', 'signs_on_handles_straps', 'eb_cb_cracking', 'cracking',
        'eb_cb_repainted', 'repainted', 'hw_cb_color', 'haraware_color',
        'hw_cb_excellent', 'hardware_excellent', 'hw_cb_discoloration', 'discoloration',
        'hw_cb_scrateches', 'hardware_scrateches', 'hw_cb_sign_of_use', 'hardware_sign_of_use',
        'in_cb_smell', 'smell', 'in_cb_clean_excellent', 'inside_clean_excellent',
        'in_cb_stains', 'stains', 'in_cb_tears', 'tears',
        'in_cb_no_make_in', 'no_make_in', 'in_cb_date_code', 'date_code',
        'measurement_w', 'measurement_d', 'measurement_h', 'accessories',
        'notes'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
