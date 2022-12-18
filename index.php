<?php

class Taxi
{
    private int $taxiInPark;
    private int $passenger;
    private array $cars;
    private array $freeCars;
    
    public function __construct()
    {
        $this->taxiInPark = rand(5,10);
        $this->passenger = rand (0, 1000);    
        $this->cars = $this->getCars($this->taxiInPark);
    }
    
    public function findCar()
    {
        $this->checkCars();
        
        echo 'The passenger is ' . $this->passenger . 'km' . "\n\n";

        foreach($this->cars as $car) {
            echo 'Taxi ' . $car['id'] . ' on ' . $car['position'] . 'km,';
            echo ' distance to the passenger ' . $car['distance'] . 'km ';
            echo ($car['isFree']) ? '(free)' : '(busy)';
            echo ($car['tookOrder']) ? ' - this taxi is going' : '';
            echo "\n";  
        }
    }
    
    private function checkCars(): void
    {
		$freeCars = [];
		foreach($this->cars as $carId => &$car) {
		    
    	    if($this->passenger < $car['position']) {
    		        $car['distance'] = $car['position'] - $this->passenger;    
    	    } elseif ($this->passenger >= $car['position']) {
                    $car['distance'] = $this->passenger - $car['position'];
    	    }
    	    
    	    if($car['isFree']) {
    	        $freeCars[$carId] = $car['distance'];    
	        }
		}
		
		$minDistance = min($freeCars);
		
		foreach($freeCars as $carId => $distance) {
		   if($minDistance === $distance) {
		       if( $this->cars[$carId]['isFree'] === true) {
		         $this->cars[$carId]['tookOrder'] = true;
		       } 
		   }
		}
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
}

$taxi = new Taxi();

$taxi->findCar();
