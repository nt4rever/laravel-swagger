<?php

namespace App\Models;

use App\Services\Traits\HasUuid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class NoteContent
 *
 * @property int $id
 * @property string $uuid
 * @property int $note_id
 * @property string $content
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class NoteContent extends Model
{
    use HasFactory, SoftDeletes, HasUuid;

    protected $table = 'note_contents';

    protected $fillable = [
        'note_id',
        'content',
    ];

    protected $casts = [
        'note_id' => 'int',
    ];

    /**
     * A note content belongs to a Note
     *
     * @return BelongsTo
     */
    public function note(): BelongsTo
    {
        return $this->belongsTo(Note::class, 'note_id');
    }
}
