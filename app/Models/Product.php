<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function images()
    {
        if (!$this->image_path) return [];
        $result = json_decode($this->image_path, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return [$this->image_path];
        }

        return $result;
    }
}
