<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'brand_id', 
        'category_id', 
        'model_id', 
        'status_id', 
        'color_id', 
        'manufacture_year', 
        'weight'
    ];

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function model()
    {
        return $this->belongsTo(VehicleModel::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
