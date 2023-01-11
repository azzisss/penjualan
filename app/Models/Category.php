<?php

namespace App\Models;

use App\Models\Makanan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded=['id'];

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where(function($query) use ($search) {
                   $query->where('nama_category', 'like', '%' . $search . '%');
             });
         });
         end($query);

    }

    public function makanan(){
        return $this->hasMany(Makanan::class);
    }
    
}
