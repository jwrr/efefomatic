<?php
/*
Copyright (c) 2019 JWRR.COM (jwrr.com at gmail.com)

This work is licensed under the terms of the MIT license.
For a copy, see <https://opensource.org/licenses/MIT>.

requires efef_unix.php

*/

function efef_search_form($efef_hash)
{

$html =
<<<HEREDOC
<form method="get" class="search-form">
   <input type="search" placeholder="Site search &#x2315;" value="" name="search">
   <button type="submit">Search</button>
</form>
HEREDOC;

  return $html;
}

function efef_search_results($efef_hash, $filter='*', $maxposts=20)
{
  $maxposts_per_file = 5;
  if (!function_exists('efef_grep')) return $efef_hash['content'];

  $str = $_GET['search'];

  $blog_path = $efef_hash['blog_path'];
  exec ( stripos ( PHP_OS, 'WIN' ) === 0 ? "dir /B /O-D $blog_path" : "ls -td $blog_path/*" , $filearray );

//var_dump($filearray);
  $glob = glob($filter, GLOB_ONLYDIR);
  $html = "<section class=\"search\">\n<h2>Search Results</h2>\n<ul>\n";
//  foreach ($glob as $dir) {
  $count = 0;
  foreach ($filearray as $post) {
    $post_name = basename($post);
    if (strstr($post_name, '.')) continue;

    $post_url = "/blog/$post_name";

    $match_array = efef_grep( $post . '/*.md', "'^title:'" , '-i');
    $title_array = array();
    $title_array = efef_grep( $post . '/*.md', "'^\s*title:'");
    if (empty($title_array)) continue;
    $title = preg_replace('/title:\s*/', '', $title_array[0]);

    $match_array = efef_grep( $post . '/*.md', "'$str'" , '-i -C 1');
    if (empty($match_array)) continue;

    $file_count = 0;
    $html .= "<li><a href=\"$post_url\">$title</a><ul>\n";
    foreach ($match_array as $match) {
      if ($file_count >= $maxposts_per_file) break;
      $file_count++;
      $post_text = $match;
      $html .= "<li>$match</li>\n";
    }
    $html .= "</ul>\n";
    
    $count++;
    if ($count > $maxposts) break;
  }
  $html .= "</ul>\n</section>\n";
  return $html;
}

$efef_hash['search_form'] = efef_search_form($efef_hash, '*', 10);

if (isset($_GET['search'])) {
  $efef_hash['content'] = efef_search_results($efef_hash, '*', 10);
}



