<?php

/*
Find the nearest taxi

Imagine a track from 0 to 1000 km on which there are 1-10 taxi cars and one passenger

Create a passenger by variable $passenger = rand (0, 1000)

We create an array $cars with 5-10 taxi cars, with a random location on the highway from 0 to 1000 km and a random load (busy/free).

Calculate which of the five cars is closest to the passenger and is free and goes to him

Output example:
The passenger at 792km

Taxi 1 at 370km, distance to the passenger 422km (busy)
Taxi 2 at 87km, distance to the passenger 705km (busy)
Taxi 3 at 426km, distance to the passenger 366km (busy)
Taxi 4 at 628km, distance to the passenger 164km (free) - this taxi is going
Taxi 5 at 515km, distance to the passenger 277km (busy)
Taxi 6 at 240km, distance to the passenger 552km (busy)
*/

class Taxi
{
    private int $passenger;
    private int $taxiInPark;
    private array $cars;
    private array $freeCars;

    public function __construct()
    {
        $this->passenger = rand (0, 1000);
        $this->taxiInPark = rand(5, 10);
        $this->cars = $this->getCars($this->taxiInPark);
    }

    public function findCar()
    {
        $this->checkAvaliableCars();
        $this->printCarsResult();
    }

    private function checkAvaliableCars(): void
    {
        $this->setDistance();
        $this->setTookOrder();
    }

    private function getCars(int $taxiInPark): array
    {
        $cars = [];
        for ($carId = 1; $carId <= $taxiInPark; $carId++) {

            $cars[$carId] = [
                'id' => $carId,
                'position' => rand(0,1000),
                'isFree' => (bool)rand(0,1),
                'tookOrder' => false
            ];
        }

        return $cars;
    }

    private function setDistance()
    {
        foreach($this->cars as $carId => &$car) {

            if($this->passenger < $car['position']) {
                $car['distance'] = $car['position'] - $this->passenger;
            } elseif ($this->passenger >= $car['position']) {
                $car['distance'] = $this->passenger - $car['position'];
            }

            if($car['isFree']) {
                $this->freeCars[$carId] = $car['distance'];
            }
        }
    }

    private function setTookOrder(): void
    {
        $minDistance = min($this->freeCars);

        foreach($this->freeCars as $carId => $distance) {
            if($minDistance === $distance) {
                if( $this->cars[$carId]['isFree'] === true) {
                    $this->cars[$carId]['tookOrder'] = true;
                }
            }
        }
    }

    private function printCarsResult(): void
    {
        echo 'The passenger at ' . $this->passenger . 'km' . "\n\n";

        foreach($this->cars as $car) {
            echo 'Taxi ' . $car['id'] . ' at ' . $car['position'] . 'km,';
            echo ' distance to the passenger ' . $car['distance'] . 'km ';
            echo ($car['isFree']) ? '(free)' : '(busy)';
            echo ($car['tookOrder']) ? ' - this taxi is going' : '';
            echo "\n";
        }
    }
}

$taxi = new Taxi();
$taxi->findCar();
