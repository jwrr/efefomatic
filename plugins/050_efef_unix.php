<?php
/*
Copyright (c) 2019 JWRR.COM (jwrr.com at gmail.com)

This work is licensed under the terms of the MIT license.
For a copy, see <https://opensource.org/licenses/MIT>.
*/

function efef_grep($glob, $needle, $options='' )
{
  $blog_path = $efef_hash['blog_path'];
  $cmd = "grep $options $needle $glob";
  exec ($cmd, $results);
  return $results;
}

// $efef_hash['grep'] = efef_grep($efef_hash, '*', 'search_string');
// echo $efef_hash['grep'];

