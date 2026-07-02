<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Scope;

#[Fillable(['user_id', 'quantity', 'price', 'total', 'status'])]
class Cart extends Model
{
    use HasFactory, HasUuids;



    /**
     * Relationships 
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function meals(): BelongsToMany
    {
        return $this->belongsToMany(Meal::class, 'cart_meals')->withPivot('quantity');
    }



    /**
     * Scopes
     */
    #[Scope]
    public function scopeGetAuthenticatedUserCart(Builder $query) 
    {
        return $query->where('user_id', Auth::id());
    }
}
