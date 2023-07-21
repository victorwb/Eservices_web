<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Models\Item;

class Hotel extends Model
{
    use HasFactory;
    protected $fillable = ['name','rating','description','image','location'];
    public function items(): MorphMany
    {
        return $this->morphMany(Item::class, 'itemable');
    }
}
