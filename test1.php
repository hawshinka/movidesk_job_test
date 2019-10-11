<?php

$peasant = [
	'side' => 'E',
];

$objects = [
	0 => [
		'name' => 'leao',
		'side' => 'E',
		'restrictions' => ['cabra'],
	],
	1 => [
		'name' => 'cabra',
		'side' => 'E',
		'restrictions' => ['leao', 'feno'],
	],
	2 => [
		'name' => 'feno',
		'side' => 'E',
		'restrictions' => ['cabra'],
	],
];

function switchSide($side) 
{
	return ($side == 'E') ? 'D' : 'E';
}

function checkFinalCondition($peasant, $objects)
{
	$result = true;

	foreach ($objects as $object) {
		if ($object['side'] == 'E') {
			$result = false;
			break;
		}
	}

	return $result && ($peasant['side'] == 'D');
}

function checkRestrictions($side, $objects) 
{
	$canDo = true;

	foreach ($objects as $object) {
		foreach ($objects as $object2) {
			if ($object['side'] == $object2['side'] && $object['side'] == $side && in_array($object['name'], $object2['restrictions'])) {
				$canDo = false;
				break 2;
			}
		}
	}

	return $canDo;
}

$countObjects = count($objects);
$finished	  = false;
do {
	for ($i = 0; $i < $countObjects; $i++) {
		// verifica se esta do mesmo lado do campones
		if ($objects[$i]['side'] == $peasant['side']) {
			// muda o objeto de lado "virtualmente"
			$objects[$i]['side'] = switchSide($objects[$i]['side']);
			// verifica restricoes do lado que estão saindo
			if (!checkRestrictions($peasant['side'], $objects)) {
				// destroca o lado
				$objects[$i]['side'] = switchSide($objects[$i]['side']);
			} else {
				// se tudo estiver ok, muda o camponês de lado
				$peasant['side'] = switchSide($peasant['side']);
				echo "campones e {$objects[$i]['name']} para a margem {$peasant['side']}";
				echo "\n";
			}
		}
	}

	$finished = checkFinalCondition($peasant, $objects);
	if (!$finished) {
		// muda o camponês de lado sozinho porque ainda não acabou
		$peasant['side'] = switchSide($peasant['side']);
		echo "campones para a margem {$peasant['side']}";
		echo "\n";
	}
} while (!$finished);