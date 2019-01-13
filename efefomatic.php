<?php

/*
MIT License

Copyright (c) 2019 JWRR.COM (jwrr.com at gmail.com)

git clone https://github.com/jwrr/lued.git
Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
*/


/* 
  functions:
  function efef_convert2html($efef_md_text) - converts markdown to html
  function efef_make_toc($text) - converts embedded named anchors to table of contents
  function efef_get_yaml($text) - extracts yaml from md and returns key-value hash
  function efef_remove_yaml($text) - removes yaml from md
  function efef_replacer_file($hash) - hash defines template file, content...
  function efefomatic($path) - converts all md in path to single html output
*/

// EXTEND MARKDOWN

// Converts `k'keystroke'modifier+keystroke to <kbd>modifier</kbd>+<kbd>keystroke</kbd>
$efef_md[] = array( 'name' => 'kbd1', 'from' => "/`k'([^']+?)\+(.+?)\s/s" , 'to' => "<kbd>$1</kbd>+<kbd>$2</kbd>");

// Converts `k'keystroke'   to  <kbd>keystroke</kbd>
$efef_md[] = array( 'name' => 'kbd2', 'from' => "/`k'(\S+?)\s/s" , 'to' => "<kbd>$1</kbd>");

// Converts `generic-tag'stuff' to <generic-tag>stuff</generic-tag>
//$efef_md[] = array( 'tag'  => 'kbd2', 'from' => "/`(.+)'(.+?)('|\n)/s" , 'to' => "<$1>$1</$1>"); 

$efef_md[] = array( 'name' => 'hr1', 'from' => '/\n___+/s' , 'to' => "\n<hr>");
$efef_md[] = array( 'name' => 'hr2', 'from' => '/\n---+/s' , 'to' => "\n<hr>");
$efef_md[] = array( 'name' => 'hr3', 'from' => '/\n\*\*\*+/s' , 'to' => "\n<hr>");
$efef_md[] = array( 'name' => 'br1', 'from' => '/  \n/s' , 'to' => " <br>\n");
$efef_md[] = array( 'name' => 'br2', 'from' => '/\\\s*\n/s' , 'to' => " <br>\n");
$efef_md[] = array( 'name' => 'p',  'from' => '/\n\n+(?=\s*[^<*#`\n])/s' , 'to' => "\n\n<p>\n");
$efef_md[] = array( 'name' => 'p',  'from' => '/\n\n+(?=\s*[^<*#`\n])/s' , 'to' => "\n\n<p>\n");
$efef_md[] = array( 'name' => 'h6', 'from' => '/\n######(.*?)(?=\n)/s' , 'to' => "\n<h6>$1</h6>\n");
$efef_md[] = array( 'name' => 'h5', 'from' => '/\n#####(.*?)(?=\n)/s' , 'to' => "\n<h5>$1</h5>\n");
$efef_md[] = array( 'name' => 'h4', 'from' => '/\n####(.*?)(?=\n)/s' , 'to' => "\n<h4>$1</h4>\n");
$efef_md[] = array( 'name' => 'h3', 'from' => '/\n###(.*?)(?=\n)/s' , 'to' => "\n<h3>$1</h3>\n");
$efef_md[] = array( 'name' => 'h2', 'from' => '/##(.*?)(?=\n)/s' , 'to' => "\n<h2>$1</h2>\n");
$efef_md[] = array( 'name' => 'h1', 'from' => '/\n#(.*?)\n/s' , 'to' => "\n<h1>$1</h1>\n");
$efef_md[] = array( 'name' => 'ul', 'from' => '/\n\n\*(.*?)(?=\n)/s' , 'to' => "\n<ul><li>$1\n");
$efef_md[] = array( 'name' => 'eul', 'from' => '/\n\*(.*?)\n(?=\n)/s' , 'to' => "\n<li>$1</ul>\n\n");
$efef_md[] = array( 'name' => 'li', 'from' => '/\n\*(.*?)(?=\n)/s' , 'to' => "\n<li>$1\n");
$efef_md[] = array( 'name' => 'bold', 'from' => '/\*\*(.*?)\*\*/s' , 'to' => "<strong>$1</strong>");
$efef_md[] = array( 'name' => 'italics', 'from' => '/\*(.*?)\*/s' , 'to' => "<em>$1</em>");
$efef_md[] = array( 'name' => 'precode', 'from' => '/\n```(.*?)```/s' , 'to' => "\n<pre><code>$1</code></pre>\n");
$efef_md[] = array( 'name' => 'link', 'from' => '/\[([^\n]+?)\]\((\S+?)\)/s' , 'to' => '<a href="$2">$1</a>');


// ADD NEW MARKDOWN SHORTCUTS HERE


// ============================================================================

function efef_md2html($efef_md_text)
{
  global $efef_md;

  $html_text = $efef_md_text;
  foreach ($efef_md as $replace) {
    $name = $replace['name'];
    $from = $replace['from'];
    $to   = $replace['to'];

    ### print "RRR: $name $from $to <br>\n";
    $html_text = preg_replace($from, $to, $html_text);
    ### print "SSS: $name $from $to <br>\n";
  }
  return $html_text;
}

// ============================================================================

/* 
  function efef_make_toc
  Capture all anchored anchors and create a table of contents.

  Arguments:
  $text - string containing markdown.

  Return:
  $toc_text- table of contents in markdown.
*/

$toc_aname_regex = "/<a\s+name\s*=\s*\"(.*?)\"\s*>.*?\n\s*##(.*?)\n/s";

function efef_make_toc($text)
{
  global $toc_aname_regex;

  /*
    Capture all named anchors (<a name="">") and the following line which
    should be a header.
  */
  $toc_text = "\n";
  $num_matches = preg_match_all($toc_aname_regex, $text, $matches, PREG_SET_ORDER);
  for ($i=0; $i<$num_matches; $i++) {
    $toc_anchor = trim($matches[$i][1]);
    $toc_title  = trim($matches[$i][2]);
    $toc_text .= "* [$toc_title](#$toc_anchor)\n";
  }
  $toc_text .= "\n\n\n";
  return $toc_text;
}

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

$yaml_regex = "/---\n(.*?)(\.\.\.|---)\n/s";
$yaml_item_regex = "/(.*?)\n(?=(\S|\z))/s";
$yaml_comment_regex = "/\s*#.*/";

function efef_get_yaml($text)
{
  global $yaml_regex;
  global $yaml_item_regex;
  global $yaml_comment_regex;

  /*
    Capture all Yaml blocks and concatenate them into a single string.  Yaml 
    blocks start with '---' and end with either '---' or '...'.
  */
  $yaml_text = "";
  $num_matches = preg_match_all($yaml_regex, $text, $matches, PREG_SET_ORDER);
  for ($i=0; $i<$num_matches; $i++) {
    $yaml_text .= $matches[$i][1];
  }

  /*
    Remove comments from Yaml text.
  */

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
  global $yaml_regex;
  $text = preg_replace($yaml_regex, "", $text);
  return $text;
}

// ============================================================================

function efef_replacer_str($template_text, $hash)
{
  $num_matches = preg_match_all('/{{\s*(.*?)\s*}}/' , $template_text , $matches,  PREG_SET_ORDER);
  for ($i=0; $i<$num_matches; $i++) {
    $uniq[$matches[$i][1]]++;
  }

  foreach ($uniq as $key => $value) {
    $template_text = preg_replace('/{{\s*' . $key . '\s*}}/' , $hash[$key] , $template_text);
  }
  return $template_text;
}

function efef_replacer_file($hash)
{
  $template_path = $hash['theme'];
  $template_name = basename($template_path);
  $template_file = $hash['theme'] . '/' . $template_name . '.html';
  $template_text = file_get_contents($template_file);
  $final_text = efef_replacer_str($template_text, $hash);
  return $final_text;
}

// ============================================================================

function efefomatic($file_path = ".")
{
  $final_html = '';

  // get all markdown files in alphabetical order
  $file_list = glob($file_path . DIRECTORY_SEPARATOR . "*.md");
  // loop through all markdown files in folder
  foreach ($file_list as $file_name) {
    $file_text =  file_get_contents($file_name);

    // get yaml front matter from md file
    $hash = efef_get_yaml($file_text);

    // remove yaml front matter from md file
    $efef_md_text = efef_remove_yaml($file_text);

    // make table of contains from named anchors embedded in markdown
    $hash['toc'] = efef_make_toc($efef_md_text);

    $glob = glob("*", GLOB_ONLYDIR);
    $efef_md_glob = "\n";
    foreach ($glob as $dir) {
      $dir_text = preg_replace("/[-_]/", " ", $dir);
      $efef_md_glob .= "* [$dir_text]($dir)\n"; 
    }
    $efef_md_glob .= "\n";
    $hash['globdir'] = $efef_md_glob;

    // expand embedded fields such as {{toc}}. $hash has from/to definitions
    $efef_md_text2 = efef_replacer_str($efef_md_text, $hash);

    // convert markdown to html
    $hash['content'] = efef_md2html($efef_md_text2);

    // apply content to template (template path stored in $hash
    $final_html .= efef_replacer_file($hash);
  }
  return $final_html;
}