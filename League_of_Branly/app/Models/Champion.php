<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Champion extends Model
{
    use HasFactory;

    // Table name if different from default (optional)
    protected $table = 'champions';

    // Primary key if not 'id'
    protected $primaryKey = 'champion_id';

    // Specify which fields can be mass assigned
    protected $fillable = [
        'name',
        'title',
        'lore',
        'year_id',
        'gender_id',
        'resource_id'
    ];

    ///////////////////
    // RELATIONSHIPS //
    ///////////////////

    /**
     * Many-to-Many: A Champion can have multiple roles.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'champion_role', 'champion_id', 'role_id');
    }

    /**
     * Many-to-Many: A Champion belongs to one or more region.
     * The relationship is stored in the champion_region table and has 2 columns: champion_id and region_id
     */
    public function regions()
    {
        return $this->belongsToMany(Region::class, 'champion_region', 'champion_id', 'region_id');
    }

    /**
     * Many-to-One: A Champion belongs to a gender.
     */
    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    /**
     * Many-to-Many: A Champion can have multiple positions.
     */
    public function positions()
    {
        return $this->belongsToMany(Position::class);
    }

    /**
     * Many-to-Many: A Champion can have multiple species.
     */
    public function species()
    {
        return $this->belongsToMany(Species::class);
    }

    /**
     * Many-to-One: A Champion has one resource.
     */
    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }

    /**
     * Many-to-Many: A Champion can have multiple ranges.
     */
    public function rangeTypes()
    {
        return $this->belongsTo(RangeTypes::class);
    }
}
