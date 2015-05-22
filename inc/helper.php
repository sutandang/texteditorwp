<?php

function file_upload_max_size() {
  static $max_size = -1;

  if ($max_size < 0) {
    $max_size = parse_size(ini_get('post_max_size'));

    $upload_max = parse_size(ini_get('upload_max_filesize'));
    if ($upload_max > 0 && $upload_max < $max_size) {
      $max_size = $upload_max;
    }
  }
  return $max_size;
}
function parse_size($size) 
{
  $unit = preg_replace('/[^bkmgtpezy]/i', '', $size); 
  $size = preg_replace('/[^0-9\.]/', '', $size); 
  if ($unit) {
    return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
  } else {
    return round($size);
  }
}

function tjencode_shortcode($str)
{
	return base64_encode($str);
}
function tjdecode_shortcode($str)
{
	return base64_decode($str);
}
