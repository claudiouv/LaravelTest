<?php
/**
 * Created by PhpStorm.
 * User: claudioumanavalverde
 * Date: 12/1/18
 * Time: 3:14 PM
 */

namespace App\Repositories;


use App\ElevatorReport;
use App\ElevatorSequence;

class ElevatorRepository
{
    /**
     *
     */
    public function generateReport()
    {
        $elevatorSequences = ElevatorSequence::all();
        ElevatorReport::truncate();
        $this->executeElevatorSequence($elevatorSequences);

        $starTime = strtotime('9:00');
        $endTime = strtotime('20:00');

        $diffTimeMinutes = floor(($endTime - $starTime) / 60);

        echo  '<br />' . '***Time***| Elevator | Current Floor | Total Floors' . '<br />';
        for ($i = 0; $i <= $diffTimeMinutes; $i++) {
            for ($elevatorNumber = 1; $elevatorNumber <= config('building.number_of_elevators'); $elevatorNumber++)
            {
                $currentTime = $i * 60 + $starTime;
                $floorAtTime = $this->getElevatorFloorsAtTime($elevatorNumber, $currentTime);
                $sumOfFloorsAtTime = $this->getElevatorSumOfFloorsAtTime($elevatorNumber, $currentTime);
                echo date('H:i',$currentTime) . ' _______ ' . $elevatorNumber . ' ______ ' . $floorAtTime . ' ___________ ' . $sumOfFloorsAtTime . '<br />';
            }
        }
    }

    /**
     * @param $time
     * @return int|null
     */
    private function checkAvailableElevator($time)
    {
        for ($i = 1; $i <= config('building.number_of_elevators'); $i++) {
            $elevatorBusy = ElevatorReport::where('elevator_number', $i)->where('time', date('H:i',$time))->first();
            if (is_null($elevatorBusy)) {
                return $i;
            }
        }

        return null;
    }

    /**
     * @param $elevatorNumber
     * @return mixed
     */
    private function checkElevatorCurrentFloor($elevatorNumber)
    {
        $lastElevator = ElevatorReport::where('elevator_number', $elevatorNumber)->orderBy('time', 'DESC')->first();
        if (is_null($lastElevator)) {
            return config('building.start_floor');
        } else {
            return $lastElevator->end_floor;
        }
    }

    /**
     * @param $availableElevatorNumber
     * @param $currentTime
     * @param $elevatorFloor
     * @param $elevatorSequence
     * @param $elevatorFloorMoves
     */
    private function saveElevatorMoveInReport($availableElevatorNumber, $currentTime, $elevatorFloor, $elevatorSequence, $elevatorFloorMoves)
    {
        $elevatorReport = new ElevatorReport();
        $elevatorReport->elevator_number = $availableElevatorNumber;
        $elevatorReport->time = date('H:i', $currentTime);
        $elevatorReport->start_floor = $elevatorFloor;
        $elevatorReport->end_floor = $elevatorSequence->floor_end;
        $elevatorReport->floor_moves = $elevatorFloorMoves;
        $elevatorReport->save();
    }

    /**
     * @param ElevatorSequence $elevatorSequence
     * @param $elevatorFloor
     * @return float|int
     */
    private function getElevatorFloorMoves(ElevatorSequence $elevatorSequence, $elevatorFloor)
    {
        return ($elevatorSequence->floor_end + $elevatorSequence->floor_start) +
            abs($elevatorSequence->floor_start - $elevatorFloor);
    }

    /**
     * @param $elevatorSequences
     */
    private function executeElevatorSequence($elevatorSequences)
    {
        /** @var ElevatorSequence $elevatorSequence */
        foreach ($elevatorSequences as $elevatorSequence) {
            $starTime = strtotime($elevatorSequence->start_time);
            $endTime = strtotime($elevatorSequence->end_time);

            $diffTimeMinutes = floor(($endTime - $starTime) / 60);
            $elevatorRepetitions = ceil($diffTimeMinutes / $elevatorSequence->interval);

            for ($i = 0; $i <= $elevatorRepetitions; $i++) {
                $currentTime = $i * $elevatorSequence->interval * 60 + $starTime;
                $availableElevatorNumber = $this->checkAvailableElevator($currentTime);
                if (is_null($availableElevatorNumber)) {
                    echo 'No elevator available at : ' . date('H:i', $currentTime) . '<br />';
                    //dd(date('H:i',$currentTime),$elevatorSequence->toArray());
                } else {
                    $elevatorFloor = $this->checkElevatorCurrentFloor($availableElevatorNumber);
                    $elevatorFloorMoves = $this->getElevatorFloorMoves($elevatorSequence, $elevatorFloor);
                    $this->saveElevatorMoveInReport(
                        $availableElevatorNumber,
                        $currentTime,
                        $elevatorFloor,
                        $elevatorSequence,
                        $elevatorFloorMoves
                    );
                }
            }
        }
    }

    /**
     * @param $elevatorNumber
     * @param $currentTime
     * @return int|mixed
     */
    private function getElevatorFloorsAtTime($elevatorNumber, $currentTime)
    {
        $elevatorAtTime = ElevatorReport::where('elevator_number', $elevatorNumber)->where('time', '<=', date('H:i', $currentTime))->orderBy('time', 'DESC')->first();

        if (is_null($elevatorAtTime)) {
            return config('building.start_floor');
        } else {
            return $elevatorAtTime->end_floor;
        }
    }

    /**
     * @param $elevatorNumber
     * @param $currentTime
     * @return mixed
     */
    private function getElevatorSumOfFloorsAtTime($elevatorNumber, $currentTime)
    {
        return ElevatorReport::where('elevator_number', $elevatorNumber)->where('time', '<=', date('H:i', $currentTime))->get()->sum('floor_moves');
    }
}