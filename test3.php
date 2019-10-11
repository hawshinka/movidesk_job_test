<?php
function transformAndCleanSets($set)
{
	return array_map('trim', explode(',', $set));
}

function union($set1, $set2)
{
	return implode(', ', array_unique(array_merge($set1, $set2)));
}

function intersect($set1, $set2)
{
	return implode(', ', array_intersect($set1, $set2));
}

$set1 = transformAndCleanSets('1, 2, 3, 4');
$set2 = transformAndCleanSets('3, 4, 5, 6');

echo union($set1, $set2);
echo "\n";
echo intersect($set1, $set2);