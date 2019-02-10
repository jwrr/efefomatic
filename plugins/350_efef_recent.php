<?php
/*
Copyright (c) 2019 JWRR.COM (jwrr.com at gmail.com)

This work is licensed under the terms of the MIT license.
For a copy, see <https://opensource.org/licenses/MIT>.

requires efef_unix.php

*/

function efef_recent($efef_hash, $filter='*', $maxposts=8)
{
  $blog_path = $efef_hash['blog_path'];
  exec ( stripos ( PHP_OS, 'WIN' ) === 0 ? "dir /B /O-D $blog_path" : "ls -td $blog_path/*" , $filearray );

//var_dump($filearray);
  $glob = glob($filter, GLOB_ONLYDIR);
  $html = "<section class=\"recent\">\n<h2>Recent Posts</h2>\n<ul>\n";
//  foreach ($glob as $dir) {
  $count = 0;
  foreach ($filearray as $post) {
    $post_name = basename($post);
    if (strstr($post_name, '.')) continue;
    
    $post_url = "/blog/$post_name";
    
    $post_text = "";
    $title_array = array();
    if (function_exists('efef_grep')) {
      $title_array = efef_grep( $post . '/*.md', "'^\s*title:'");
    }
    if (empty($title_array)) continue;

    $title = $title_array[0];
    $title = preg_replace('/title:\s*/', '', $title);
    $post_text = $title;
    $html .= "<li><a href=\"$post_url\">$post_text</a>\n";

    $count++;
    if ($count > $maxposts) break;
  }
  $html .= "</ul>\n</section>\n";
  return $html;
}

$efef_hash['recent'] = efef_recent($efef_hash, '*', 8);
// echo $efef_hash['recent'];

