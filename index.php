<?php
/*

1. Представим трассу от 0 до 1000 км на которой пять машин такси и один пассажир

2. Создаем переменную пассажира $passenger = rand (0, 1000)

3. Создаем массив $cars с пятью машинами такси, с со случайным расположением на трессе от 0 до 1000 км и случайной загрузкой (занят/свободен). 

4. Посчитать какая из пяти машин ближайщая к пассажиру и свободна и едет к нему

5. Пример результата
Такси 1, стоит на 635км, до пассажира 253км (свободен)
Такси 2, стоит на 185км, до пассажира 197км (свободен)
Такси 3, стоит на 897км, до пассажира 515км (свободен)
Такси 4, стоит на 508км, до пассажира 126км (свободен) - едет это такси
Такси 5, стоит на 695км, до пассажира 313км (занят)

*/

$passenger = rand(0, 1000);
echo 'Пассажир стоит на ' . $passenger . 'км';

echo '<hr>';

$cars = [
    ['name' => 'Такси 1', 'position' => rand(0, 1000), 'isFree' => (bool) rand(0, 1)],
    ['name' => 'Такси 2', 'position' => rand(0, 1000), 'isFree' => (bool) rand(0, 1)],
    ['name' => 'Такси 3', 'position' => rand(0, 1000), 'isFree' => (bool) rand(0, 1)],
    ['name' => 'Такси 4', 'position' => rand(0, 1000), 'isFree' => (bool) rand(0, 1)],
    ['name' => 'Такси 5', 'position' => rand(0, 1000), 'isFree' => (bool) rand(0, 1)],
];

foreach ($cars as $key=>$val) {

	if ($cars[$key]['isFree']) $busy = 'свободен';
	else $busy = 'занят';

	$position = $cars[$key]['position'];

	if ( $passenger >= $position ) $distance = $passenger - $position;
	else $distance =  $position - $passenger;

	if ($cars[$key]['isFree']) $nearest[$key] = $distance;

	$result[] = $cars[$key]['name'].', стоит на '.$cars[$key]['position'].'км, до пассажира '.$distance.'км ('.$busy.')';

	$i++;
}

if ($nearest) {
    $min = min($nearest);
    foreach ($nearest as $key => $val) {
        if ($val == $min) $car_near = $key;
        }
}

foreach ($result as $key=>$val) {
	if ( (isset($nearest)) and ($car_near == $key)) echo $val.' - едет это такси'.'<br>';
	else echo $val.'<br>';	
}


?>
