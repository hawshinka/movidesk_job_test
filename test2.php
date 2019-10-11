<?php
function decToRoman($number) {
	$list = [
		1000 => 'M',
		900  => 'CM',
		500  => 'D',
		400  => 'CD',
		100  => 'C',
		90   => 'XC',
		50   => 'L',
		40   => 'XL',
		10   => 'X',
		9    => 'IX',
		5    => 'V',
		4    => 'IV',
		1    => 'I',
	];

	$output = [];
	foreach ($list as $dec => $roman) {
		while ($number / $dec >= 1) {
			$output[] = $roman;
			$number  -= $dec;
		}
	}

	return implode('', $output);
}

echo decToRoman(888);