<?php
/**
 * Created by PhpStorm.
 * User: claudioumanavalverde
 * Date: 12/1/18
 * Time: 3:18 PM
 */

return [
    'number_of_elevators' => 3,
    'number_of_floors' => 4,
    'start_floor' => 0,
    'start_time' => env('START_TIME', '9:00'),
    'end_time' => env('END_TIME', '20:00'),
    'minutes_in_one_hour' => 60,
    'report_header' => '<br />' . '***Time***| Elevator | Current Floor | Total Floors' . '<br />',
    'no_elevator_available_text' => 'No elevator available at : '
];