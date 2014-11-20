#!/usr/bin/php
<?php

$infile = $argv[1];
$outfile = $argv[2];

echo "Prepare to process $infile into $outfile \n";
$fin = fopen($infile, 'r');
$fout = fopen($outfile, 'w');

while ($line = fgetcsv($fin, 4096)){
  if ((count($line) == 2) && ($line[0] != $line[1])){
    fputcsv($fout, $line, ',', '"');
  } elseif ((count($line) == 1) && $line[0]) {
    $gtranslate = shell_exec("trs {en=vi} '$line[0]'");
    $line[1] = "FIXME: " . $gtranslate;
    fputcsv($fout, $line, ',', '"');
  }
}
fclose($fout);
fclose($fin);


