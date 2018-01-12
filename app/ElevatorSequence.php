<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\ElevatorSequence
 *
 * @property int $id
 * @property float $interval
 * @property string $start_time
 * @property string $end_time
 * @property int $floor_start
 * @property int $floor_end
 * @property \Carbon\Carbon|null $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static bool|null forceDelete()
 * @method static ElevatorSequence onlyTrashed()
 * @method static bool|null restore()
 * @method static ElevatorSequence whereCreatedAt($value)
 * @method static ElevatorSequence whereDeletedAt($value)
 * @method static ElevatorSequence whereEndTime($value)
 * @method static ElevatorSequence whereFloorEnd($value)
 * @method static ElevatorSequence whereFloorStart($value)
 * @method static ElevatorSequence whereId($value)
 * @method static ElevatorSequence whereInterval($value)
 * @method static ElevatorSequence whereStartTime($value)
 * @method static ElevatorSequence whereUpdatedAt($value)
 * @method static ElevatorSequence withTrashed()
 * @method static ElevatorSequence withoutTrashed()
 * @mixin \Eloquent
 */
class ElevatorSequence extends Model
{
    protected $table = 'elevator_sequence';

    use SoftDeletes;
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];
}
