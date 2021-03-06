<?php
/*
Copyright (c) 2019 JWRR.COM (jwrr.com at gmail.com)

This work is licensed under the terms of the MIT license.
For a copy, see <https://opensource.org/licenses/MIT>.
*/

function efef_replacer_str($template_text, $efef_hash)
{
  $num_matches = preg_match_all('/{{\s*(.*?)\s*}}/' , $template_text , $matches,  PREG_SET_ORDER);
  $uniq = array();
  for ($i=0; $i<$num_matches; $i++) {
    $uniq[$matches[$i][1]]++;
  }
  $embedded_variables = array_keys($uniq);
  foreach ($embedded_variables as $var) {
    // echo "var = '$var'<br>\n";
    $template_text = preg_replace('/{{\s*' . $var . '\s*}}/' , $efef_hash[$var] , $template_text);
  }
  return $template_text;
}

// ============================================================================

function efef_template($efef_hash)
{
  if (!array_key_exists('theme', $efef_hash)) {
    $template_path = $efef_hash['themes_path'] . DIRECTORY_SEPARATOR . 'a';
  } elseif (strstr($efef_hash['theme'], DIRECTORY_SEPARATOR)) {
     $template_path = $efef_hash['theme'];
  } else {
     $template_path = $efef_hash['themes_path'] . DIRECTORY_SEPARATOR . $efef_hash['theme'];
  }
  $template_name = basename($template_path);
  $template_file = $template_path . DIRECTORY_SEPARATOR  . $template_name . '.html';
  $template_text = file_get_contents($template_file);

  if (!array_key_exists('css',$efef_hash)) {
    $efef_hash['css'] = $template_path . DIRECTORY_SEPARATOR . $template_name . '.css';
  }

  $final_text = efef_replacer_str($template_text, $efef_hash);
  return $final_text;
}

// expand embedded fields such as {{toc}}. $efef_hash has from/to definitions
$efef_hash['content'] = efef_replacer_str($efef_hash['content'], $efef_hash);

// apply content to template (template path stored in $efef_hash
$efef_hash['html'] = efef_template($efef_hash);

