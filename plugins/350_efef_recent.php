<?php
/*
Copyright (c) 2019 JWRR.COM (jwrr.com at gmail.com)

This work is licensed under the terms of the MIT license.
For a copy, see <https://opensource.org/licenses/MIT>.
*/

function efef_recent($efef_hash, $filter='*', $maxfiles=8)
{
  $blog_path = $efef_hash['blog_path'];
  exec ( stripos ( PHP_OS, 'WIN' ) === 0 ? "dir /B /O-D $blog_path" : "ls -td $blog_path/*" , $filearray );

//var_dump($filearray);
  $glob = glob($filter, GLOB_ONLYDIR);
  $html = "<h2>Recent Posts</h2>\n<ul>\n";
//  foreach ($glob as $dir) {
  $count = 0;
  foreach ($filearray as $post) {
    $post_name = basename($post);
    if (strstr($post_name, '.')) continue;
    if (strstr($post_name, 'efefomatic')) continue;
    if (strstr($post_name, 'img')) continue;
    if (strstr($post_name, 'error_log')) continue;
    
    if ($count >= $maxfiles) break;
    $count++;
    $post_url = "/blog/$post_name";
    
    $post_text = preg_replace("/[-_]/", " ", $post_name);
    $html .= "<li><a href=\"$post_url\">$post_text</a>\n";
  }
  $html .= "</ul>\n";
  return $html;
}

$efef_hash['recent'] = efef_recent($efef_hash, '*', 8);
// echo $efef_hash['recent'];

