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
        return $this->belongsTo(User::class)->withTrashed();
    }

    /**
     * Get the maintenance that owns the part_exit.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function maintenance()
    {
        return $this->belongsTo(Maintenance::class)->withTrashed();
    }
}
