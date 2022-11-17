<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'categories_id',
        'tags',
    ];

    public function galleries()
    {
        return $this->hasMany(ProductGallery::class, 'product_id', 'id');
    // membuat relasi one to many menggunakan "hashMany" dengan class (related/berada di folder model) ProductGallery dan pemanggilan table yg berelasi yaitu foreignkey "Product_id" dan localkey "id" 
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'categories_id', 'id');
    // membuat relasi one to one or many relations menggunakan "hashMany" dengan class (related/berada di folder model) ProductCategory dan pemanggilan table yg berelasi yaitu foreignkey "categories_id" dan localkey "id" 
    } 


}
