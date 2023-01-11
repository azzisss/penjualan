<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Makanan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['category'];

    public function scopeFilter($query, array $filters)
    {

        $query->when(
            $filters['search'] ?? false,
            function ($query, $search) {
                return  $query->where(function ($query) use ($search) {
                    $query->where('nama_makanan', 'like', '%' . $search . '%')
                        ->orWhere('keterangan_makanan', 'like', '%' . $search . '%')
                        ->orWhere('harga_makanan', 'like', '%' . $search . '%');
                });
            }
        );
        end($query);
        $query->when(
            $filters['category'] ?? false,
            function ($query, $category) {
                return  $query->whereHas('category', function ($query) use ($category) {
                    $query->where('nama_category', $category);
                });
            }
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
}
