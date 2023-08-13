<?php

namespace App\Models;

use App\Services\Traits\EloquentBuilderMixin;
use App\Services\Traits\HasUuid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * Class Note
 *
 * @property int $id
 * @property string $uuid
 * @property int $user_id
 * @property string $title
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property User $user
 * @property Category $category
 *
 * @mixin EloquentBuilderMixin
 */
class Note extends Model
{
    use HasFactory, Notifiable, HasUuid, SoftDeletes;

    protected $table = 'notes';

    protected $casts = [
        'user_id' => 'int',
        'category_id' => 'int',
    ];

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'content',
    ];

    /**
     * A note belongs to an User
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * A note belongs to an Category
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
