<?php
/*
Copyright (c) 2019 JWRR.COM (jwrr.com at gmail.com)

This work is licensed under the terms of the MIT license.
For a copy, see <https://opensource.org/licenses/MIT>.
*/

// ============================================================================
/*
  function get_yaml
  Capture all Yaml blocks and concatenate them into a single string.  Yaml
  blocks start with '---' and end with either '---' or '...'.

  Arguments:
  $text - string containing yaml.

  Return:
  $yaml_hash - key-value associated array.
*/

function efef_get_yaml($efef_hash)
{
  $yaml_regex = "/---\n(.*?)(\.\.\.|---)\n/s";
  $yaml_item_regex = "/(.*?)\n(?=(\S|\z))/s";
  $yaml_comment_regex = "/\s*#.*/";


  $yaml_hash = $efef_hash;
  /*
    Capture all Yaml blocks and concatenate them into a single string.  Yaml
    blocks start with '---' and end with either '---' or '...'.
  */
  $yaml_text = "";
  $num_matches = preg_match_all($yaml_regex, $efef_hash['txt'], $matches, PREG_SET_ORDER);
  for ($i=0; $i<$num_matches; $i++) {
    $yaml_text .= $matches[$i][1];
  }

  // Remove comments from Yaml text.
  $yaml_text = preg_replace($yaml_comment_regex, "", $yaml_text);

  /*
    Store each Yaml entry in a key-value hash.  An entry ends with an '\n' that
    is not followed by an indented line.  Indented lines are considered part of
    preceding line's value.
  */
  $num_matches = preg_match_all($yaml_item_regex, $yaml_text, $matches, PREG_SET_ORDER);
  for ($i=0; $i<$num_matches; $i++) {
    $yaml_item = $matches[$i][1];
    if (preg_match("/:/", $yaml_item)) {
      list($yaml_key, $yaml_val) = explode(":", $yaml_item, 2);
      $yaml_key = trim($yaml_key);
      $yaml_val = trim($yaml_val);
      $yaml_hash[$yaml_key] = $yaml_val;
     }
  }
  return $yaml_hash;
}


// ============================================================================

function efef_remove_yaml($text)
{
  $yaml_regex = "/---\n(.*?)(\.\.\.|---)\n/s";
  $text = preg_replace($yaml_regex, "", $text);
  return $text;
}


// ============================================================================

function efef_yaml($efef_hash)
{
  // parse yaml from text file. yaml fields stored in $efef_hash.
  $efef_hash = efef_get_yaml($efef_hash);

  // remove yaml from text file
  $efef_hash['content'] = efef_remove_yaml($efef_hash['txt']);

  return $efef_hash;
}


// Extract front matter fields
$efef_hash = efef_yaml($efef_hash);


