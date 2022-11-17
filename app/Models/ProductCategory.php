<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use HasFactory, SoftDeletes;

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'categories_id', 'id');
    // membuat relasi one to many menggunakan "hashMany" dengan class (related/berada di folder model) Product dan pemanggilan table yg berelasi yaitu foreignkey "categories_id" dan localkey "id" 
    }
}
