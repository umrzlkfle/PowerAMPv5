<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cable extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'circ_id',
        'status',
        'phasing',
        'voltage',
        'class',
        'owner_type',
        'owner_name',
        'from_info',
        'to_info',
        'label',
        'op_area',
        'SubstationLabel',
        'FromToName',
        'FromLabel',
        'ToLabel',
    ];

    protected $casts = [
        // Add any specific casts if needed
    ];

    /**
     * Get the substation that this cable originates from.
     */
    public function fromSubstation()
    {
        // A Cable belongs to a Substation based on its 'FromLabel' matching the Substation's 'label'.
        // 'FromLabel' is the foreign key on the Cable model.
        // 'label' is the local key on the Substation model.
        return $this->belongsTo(Substation::class, 'FromLabel', 'label');
    }

    // You might also want to add a relationship for 'ToLabel' if it also links to a substation
    public function toSubstation()
    {
        return $this->belongsTo(Substation::class, 'ToLabel', 'label');
    }
}