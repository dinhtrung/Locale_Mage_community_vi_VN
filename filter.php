#!/usr/bin/php
<?php

$outfile = $infile = $argv[1];

echo "Prepare to process $infile into $outfile \n";
$fin = fopen($infile, 'r');
$lines = $translation = [];

while ($line = fgetcsv($fin, 4096)){
  if (count($line) == 2) {
    if ($line[0] != $line[1]){
	$translation[$line[0]] = $line[1];
    } elseif (! array_key_exists($line[0], $translation)){
        $translation[$line[0]] = null;
    }
  } elseif ((count($line) == 1) && $line[0]) {
    $translation[$line[0]] = null;
  }
  if (count($line)){
     $lines[] = $line;
  }
}
fclose($fin);
foreach ($translation as $source => $trans){
	if (is_null($trans)){
		@exec("trans -b {en=vi} '$source'", $trans, $res);
		if (! $res){
			$translation[$source] = "@FIXME: " . $trans[0];
		} else {
			$translation[$source] = "@TODO";
		}
	}
}
$fout = fopen($outfile, 'w');
foreach ($lines as $k => $line){
	$line[1] = $translation[$line[0]];
	fputcsv($fout, [$line[0], $line[1]]);
}
fclose($fout);


