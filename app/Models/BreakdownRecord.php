<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BreakdownRecord extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'breakdown_records';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tripping_document_id',
        'tripping_no',
        'source',
        'scada_non_scada',
        'ap_name',
        'tripping_point',
        'voltage',
        'load_loss',
        'dispatch_date_time',
        'arrival_date_time',
        'ap_response_time',
        'state',
        'station',
        'tripping_date_time',
        'restoration_date_time',
        'remarks',
        'failure_mode',
        'description_damage_area',
        'substation_name',
        'label'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'dispatch_date_time' => 'datetime',
        'arrival_date_time' => 'datetime',
        'tripping_date_time' => 'datetime',
        'restoration_date_time' => 'datetime',
    ];

    public function substation()
    {
        // A BreakdownRecord belongs to a Substation based on its 'substation_name' matching the Substation's 'label'.
        // 'substation_name' is the foreign key on the BreakdownRecord model.
        // 'label' is the local key on the Substation model.
        return $this->belongsTo(Substation::class, 'substation_name', 'label');
    }
}

