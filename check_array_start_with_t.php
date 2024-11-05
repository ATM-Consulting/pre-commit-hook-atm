#!/usr/bin/php
<?php

function checkArrayStartWithT($filePath) {
	// Vérifier si le fichier est un fichier PHP
	if (!preg_match('/\.php$/', $filePath)) {
		return; // Si ce n'est pas un fichier PHP, ne rien faire
	}
	console.log('enter Rule checkArrayStartWithT');
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
