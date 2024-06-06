<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laundry extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters){
        if($filters['search'] ?? false){
            $query->where('address', 'like', '%' . request('search') . '%')
            ->orwhere('customer_name', 'like','%' . request('search') . '%')
            ->orwhere('phone_number' , 'like' , '%' . request('search') . '%')
            ->orwhere('date', 'like' , '%' . request('search') . '%')
            ->orwhere('category', 'like' ,'%' . request('search') . '%')
            ->orwhere('status' , 'like' , '%' . request('search') . '%');
        }
    }

    protected $fillable = [
        'date',
        'customer_name',
        'phone_number',
        'address',
        'category',
        'weight',
        'que_number',
        'status',
        'price',
    ];

    public static function find($id){
        $laundries = self::all();

        foreach($laundries as $laundry){
            if($laundry['id'] == $id){
                return $laundry;
            }
        }
    }
}
