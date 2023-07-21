<?php

namespace App\Models;
use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;


class Item extends Model
{
    use HasFactory;
    protected $fillable = ['name','price','description','itemable_type','itemable_id','image','rating','no'];
    // protected $foreign_key='type_id';
    public function itemable(): MorphTo
    { 
        return $this->morphTo();
    }
}
