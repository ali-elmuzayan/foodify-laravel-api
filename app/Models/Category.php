<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'description', 'image', 'status'])]
class Category extends Model
{
    //
    use HasFactory, HasUuids, Notifiable;



    /**
     * Relations
     */
    public function meals(): HasMany
    {
        return $this->hasMany(Meal::class);
    }
}
