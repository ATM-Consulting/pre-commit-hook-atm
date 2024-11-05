#!/usr/bin/php
<?php

function checkArrayStartWithT($filePath) {
	$content = file_get_contents($filePath);
	$arrays = array_filter(explode(';', $content), function($line) {
		return strpos($line, '[')!== false && strpos($line, ']')!== false;
	});
	foreach ($arrays as $array) {
		$array = trim(str_replace(array('[', ']'), '', $array));
		if ($array &&!strpos($array, 'T') === 0) {
			echo "File $filePath contains an array that does not start with 'T': $array\n";
			exit(1);
		}
	}
}

if ($argc > 1) {
	foreach (array_slice($argv, 1) as $file) {
		checkArrayStartWithT($file);
	}
}
