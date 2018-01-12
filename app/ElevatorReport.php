<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\ElevatorReport
 *
 * @property int $id
 * @property int $elevator_sequence_id
 * @property int $elevator_number
 * @property string $time
 * @property int $start_floor
 * @property int $end_floor
 * @property \Carbon\Carbon|null $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static bool|null forceDelete()
 * @method static ElevatorReport onlyTrashed()
 * @method static bool|null restore()
 * @method static ElevatorReport whereCreatedAt($value)
 * @method static ElevatorReport whereDeletedAt($value)
 * @method static ElevatorReport whereElevatorNumber($value)
 * @method static ElevatorReport whereElevatorSequenceId($value)
 * @method static ElevatorReport whereEndFloor($value)
 * @method static ElevatorReport whereId($value)
 * @method static ElevatorReport whereStartFloor($value)
 * @method static ElevatorReport whereTime($value)
 * @method static ElevatorReport whereUpdatedAt($value)
 * @method static ElevatorReport withTrashed()
 * @method static ElevatorReport withoutTrashed()
 * @mixin \Eloquent
 * @property int $floor_moves
 * @method static ElevatorReport whereFloorMoves($value)
 */
class ElevatorReport extends Model
{
    protected $table = 'elevator_report';

    use SoftDeletes;
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];
}
