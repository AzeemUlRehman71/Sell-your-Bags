<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\UpdateLog;


class Client extends Model
{
    use HasFactory;

    
    protected $guarded = [];
    

    public function product() {

        return $this->hasMany(Product::class);

    }
    //Defined this function to shorten the text of address in view
    public function getShortAddressAttribute()
    {
        return Str::words($this->address, 10, '...');
    }
    
     //Return clients with products then call this in controller
    public function getAllClientsWithProducts(): Collection
    {

        return Client::with('product')
        ->withCount('updateLog')
        ->orderBy('po_number','desc')
        ->get(); 


    }

    public function getClientDetailsById($id)
    {
        return Client::with('product')->find($id);


    }

    public function updateLog() 
    {
        return $this->hasMany(UpdateLog::class, 'model_id');
    }

    // Get Client by ID
    // public function getById($id)
    // {
    //     return $this->model->where('id', $id)->first();
    // }
}
