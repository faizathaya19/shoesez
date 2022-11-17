<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'users_id',
        'address',
        'payment',
        'total_price',
        'shipping_price',
        'status',
    ]; 

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
        // membuat relasi one to one or many relations menggunakan "hashMany" dengan class (related/berada di folder model) User dan pemanggilan table yg berelasi yaitu foreignkey "users_id" dan localkey "id" 
    }

    public function items()
    {
        return $this->hasMany(TransactionItem::class, 'Transaction_id', 'id');    
        // membuat relasi one to one or many relations menggunakan "hashMany" dengan class (related/berada di folder model) TransactionItem dan pemanggilan table yg berelasi yaitu foreignkey "Transaction_id" dan localkey "id" 
    }

}
