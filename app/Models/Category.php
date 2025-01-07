<?php

namespace App\Models;

use App\Observers\CategoryObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


// #[ObservedBy([CategoryObserver::class])]
class Category extends Model
{
    //
    use HasFactory;

    protected $fillables=[
        'name',
        'category',

    ];

    public function user()
{
    return $this->belongsTo(User::class);  // Each category belongs to one user
}
}
