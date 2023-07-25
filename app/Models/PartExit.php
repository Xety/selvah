<?php

namespace Selvah\Models;

use Eloquence\Behaviours\CountCache\Countable;
use Eloquence\Behaviours\SumCache\Summable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PartExit extends Model
{
    use Countable;
    use Summable;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'maintenance_id',
        'part_id',
        'user_id',
        'number'
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // Set the user id to the new material before saving it.
        static::creating(function ($model) {
            $model->user_id = Auth::id();
        });
    }

    /**
     * Return the count cache configuration.
     *
     * @return array
     */
    public function countCaches(): array
    {
        return [
            'part_exit_count' => [Part::class, 'part_id', 'id'],
            'part_exit_count' => [User::class, 'user_id', 'id']
        ];
    }

    /**
     * Return the count cache configuration.
     *
     * @return array
     */
    public function sumCaches(): array
    {
        return [
            'part_exit_total' => [Part::class, 'number', 'part_id', 'id']
        ];
    }

    /**
     * Get the part that owns the part_exit.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function part()
    {
        return $this->belongsTo(Part::class);
    }

    /**
     * Get the user that created the part_exit.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the maintenance that owns the part_exit.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function maintenance()
    {
        return $this->belongsTo(Maintenance::class);
    }
}
