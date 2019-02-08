<?php
/*
Copyright (c) 2019 JWRR.COM (jwrr.com at gmail.com)

This work is licensed under the terms of the MIT license.
For a copy, see <https://opensource.org/licenses/MIT>.
*/

function efef_read_files($file_glob)
{

  $file_names = glob($file_glob);

  $text = "";
  foreach ($file_names as $file_name) {
    $text .= file_get_contents($file_name);
  }
  return $text;
}

$efef_hash['txt'] = efef_read_files($efef_hash['file_path'] . DIRECTORY_SEPARATOR . "*.md");

