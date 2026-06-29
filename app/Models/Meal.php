<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Contracts\GlobalSearchable;

#[Fillable(['name', 'description', 'image', 'price', 'carb', 'protein', 'fat', 'calories', 'ingredients', 'kcal', 'status', 'category_id'])]
class Meal extends Model implements GlobalSearchable
{
    //
    use HasFactory, HasUuids, Notifiable;

    /**
     * Relations
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


    /**
     * Global Search
     */
    public static function globalSearchColumns(): array
    {
        return [
            'name',
            'description',
            'ingredients',
        ];
    }

    public static function globalSearchRelations(): array
    {
        return [
            'category:id,name,description',

        ];
    }
    
    public static function globalSearchType(): string
    {
        return 'meal';
    }
}
