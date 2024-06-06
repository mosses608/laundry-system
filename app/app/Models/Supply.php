<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters){
        if($filters['search'] ?? false){
            $query->where('date', 'like' , '%' . request('search') . '%')
            ->orwhere('supply_name' , 'like' , '%' . request('search') . '%')
            ->orwhere('type' , '%' , 'like' . request('search') . '%');
        }
    }
    protected $fillable = [
        'date',
        'supply_name',
        'quantity',
        'type',
    ];
}
