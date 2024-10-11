<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RangeType extends Model
{
    use HasFactory;

    protected $table = 'range_types';

    protected $primaryKey = 'range_id';

    protected $fillable = ['name'];

    /**
     * One-to-Many: A region can have many ranges.
     */
    public function champions()
    {
        return $this->belongsToMany(Champion::class, 'champion_range', 'champion_id', 'range_id');
    }
}
