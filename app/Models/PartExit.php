<?php

namespace Selvah\Models;

use Eloquence\Behaviours\CountCache\Countable;
use Eloquence\Behaviours\SumCache\Summable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PartExit extends Model
{
    use Countable;
    use HasFactory;
    use Summable;

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
     * Return the count cache configuration.
     *
     * @return array
     */
    public function countCaches(): array
    {
        return [
            [
                'model'      => Part::class,
                'field'      => 'part_exit_count',
                'foreignKey' => 'part_id',
                'key'        => 'id'
            ],
            [
                'model'      => User::class,
                'field'      => 'part_exit_count',
                'foreignKey' => 'user_id',
                'key'        => 'id'
            ]
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
     * @return BelongsTo
     */
    public function part(): BelongsTo
    {
        return $this->belongsTo(Part::class);
    }

    /**
     * Get the user that created the part_exit.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    /**
     * Get the maintenance that owns the part_exit.
     *
     * @return BelongsTo
     */
    public function maintenance(): BelongsTo
    {
        return $this->belongsTo(Maintenance::class)->withTrashed();
    }
}
