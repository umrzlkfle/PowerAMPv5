<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Substation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'substation_id',
        'status',
        'name',
        'owner_type',
        'owner_name',
        'design',
        'voltage',
        'label',
        'functional_location',
        'operational_area',
        'category',
        'status_act',
        'latitude',
        'longitude'
    ];

    protected $casts = [
        'voltage' => 'float',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

        /**
     * Get the cables associated with the substation (where this substation is the 'FromLabel').
     */
    public function outgoingCables()
    {
        // A Substation has many Cables where its 'label' matches the Cable's 'FromLabel'.
        // 'label' is the local key on the Substation model.
        // 'FromLabel' is the foreign key on the Cable model.
        return $this->hasMany(Cable::class, 'FromLabel', 'label');
    }

    /**
     * Get the breakdown records for the substation.
     */
    public function breakdownRecords()
    {
        // A Substation has many BreakdownRecords where its 'label' matches the BreakdownRecord's 'substation_name'.
        // 'label' is the local key on the Substation model.
        // 'substation_name' is the foreign key on the BreakdownRecord model.
        return $this->hasMany(BreakdownRecord::class, 'substation_label', 'label');
    }

}