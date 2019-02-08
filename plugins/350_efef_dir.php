<?php
/*
Copyright (c) 2019 JWRR.COM (jwrr.com at gmail.com)

This work is licensed under the terms of the MIT license.
For a copy, see <https://opensource.org/licenses/MIT>.
*/

function efef_dir($filter='*')
{
  $glob = glob($filter, GLOB_ONLYDIR);
  $html = "\n<ul>";
  foreach ($glob as $dir) {
    $dir_text = preg_replace("/[-_]/", " ", $dir);
    $html .= "<li><a href=\"$dir\">$dir_text</a>\n";
  }
  $html .= "</ul>\n";
  return $html;
}

$efef_hash['dir'] = efef_dir();

