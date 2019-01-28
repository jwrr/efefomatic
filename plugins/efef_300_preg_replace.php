<?php
/*
Copyright (c) 2019 JWRR.COM (jwrr.com at gmail.com)

This work is licensed under the terms of the MIT license.
For a copy, see <https://opensource.org/licenses/MIT>.
*/


$efef_rex[] = array( 'name' => 'esc-ast',   'from' => '/[\\\\][*]/s' , 'to' => "&ast;");
$efef_rex[] = array( 'name' => 'esc-num',   'from' => '/[\\\\][#]/s' , 'to' => "&num;");
$efef_rex[] = array( 'name' => 'esc-hat',   'from' => '/[\\\\]\^/s'  , 'to' => "&Hat;");
$efef_rex[] = array( 'name' => 'esc-tilde', 'from' => '/[\\\\][~]/s' , 'to' => "&tilde;");

// Converts `k'keystroke'modifier+keystroke to <kbd>modifier</kbd>+<kbd>keystroke</kbd>
$efef_rex[] = array( 'name' => 'kbd1', 'from' => "/`k'([^']+?)\+(.+?)\s/s" , 'to' => "<kbd>$1</kbd>+<kbd>$2</kbd>");

// Converts `k'keystroke'   to  <kbd>keystroke</kbd>
$efef_rex[] = array( 'name' => 'kbd2', 'from' => "/`k'(\S+?)\s/s" , 'to' => "<kbd>$1</kbd>");

// Converts `generic-tag'stuff' to <generic-tag>stuff</generic-tag>
//$efef_rex[] = array( 'tag'  => 'kbd2', 'from' => "/`(.+)'(.+?)('|\n)/s" , 'to' => "<$1>$1</$1>");


$efef_rex[] = array( 'name' => 'hr1', 'from' => '/\n([-_*])\\1\\1+\n/s' , 'to' => "\n<hr>\n");
// $efef_rex[] = array( 'name' => 'br1', 'from' => '/  \n/s' , 'to' => " <br>\n");

$efef_rex[] = array( 'name' => 'h2b', 'from' => '/\n\n([^\n]+?)\n---+\n/s' , 'to' => "\n\n<h2>$1</h2>\n");
$efef_rex[] = array( 'name' => 'h1b', 'from' => '/\n\n([^\n]+?)\n===+\n/s' , 'to' => "\n\n<h1>$1</h1>\n");

// Convert trailing '\' into '<br>'
$efef_rex[] = array( 'name' => 'br2', 'from' => "/([^\\\\])[\\\\]\n/s" , 'to' => "<br>\n");

// Convert trailing '\.' into '\' - This prevents <br>
#### $efef_rex[] = array( 'name' => 'br3', 'from' => '/\\\\\n/s' , 'to' => "\\\n");
$efef_rex[] = array( 'name' => 'p1',  'from' => '/\n\n+(?=[^- <>*#`0-9+])/s' , 'to' => "\n\n<p>\n");

// remove char if line just has one '.'. This prevents <p>
$efef_rex[] = array( 'name' => 'p2',  'from' => '/\n[.]\n/s' , 'to' => "\n\n");


$efef_rex[] = array( 'name' => 'h6',  'from' => '/\n######(.*?)(?=\n)/s' , 'to' => "\n<h6>$1</h6>\n");
$efef_rex[] = array( 'name' => 'h5',  'from' => '/\n#####(.*?)(?=\n)/s' , 'to' => "\n<h5>$1</h5>\n");
$efef_rex[] = array( 'name' => 'h4',  'from' => '/\n####(.*?)(?=\n)/s' , 'to' => "\n<h4>$1</h4>\n");
$efef_rex[] = array( 'name' => 'h3',  'from' => '/\n###(.*?)(?=\n)/s' , 'to' => "\n<h3>$1</h3>\n");
$efef_rex[] = array( 'name' => 'h2',  'from' => '/##(.*?)(?=\n)/s' , 'to' => "\n<h2>$1</h2>\n");
$efef_rex[] = array( 'name' => 'h1',  'from' => '/\n#(.*?)\n/s' , 'to' => "\n<h1>$1</h1>\n");

$efef_rex[] = array( 'name' => 'ul',  'from' => '/\n\n[-+*](.*?)(?=\n)/s' , 'to' => "\n<ul><li>$1\n");
$efef_rex[] = array( 'name' => 'eul', 'from' => '/\n[-+*](.*?)\n(?=\n)/s' , 'to' => "\n<li>$1</ul>\n\n");
$efef_rex[] = array( 'name' => 'uli', 'from' => '/\n[-+*](.*?)(?=\n)/s' , 'to' => "\n<li>$1\n");

$efef_rex[] = array( 'name' => 'ol',  'from' => '/\n\n\d+[.)]\s*(.*?)(?=\n)/s' , 'to' => "\n<ol><li>$1\n");
$efef_rex[] = array( 'name' => 'eol', 'from' => '/\n\d+[.)]\s*(.*?)\n(?=\n)/s' , 'to' => "\n<li>$1</ol>\n\n");
$efef_rex[] = array( 'name' => 'oli', 'from' => '/\n\d+[.)]\s*(.*?)(?=\n)/s' , 'to' => "\n<li>$1\n");

$efef_rex[] = array( 'name' => 'bold1',   'from' => '/\s\*\*(.*?)\*\*/s' , 'to' => " <strong>$1</strong>");
$efef_rex[] = array( 'name' => 'bold2',   'from' => '/\s__([^_].+?)__/s' , 'to' => " <strong>$1</strong>");
$efef_rex[] = array( 'name' => 'em1',     'from' => '/\s\*(.*?)\*/s' , 'to' => " <em>$1</em>");
$efef_rex[] = array( 'name' => 'em2',     'from' => '/\s_([^_].*?)_/s' , 'to' => " <em>$1</em>");
$efef_rex[] = array( 'name' => 'precode1','from' => '/\n```(.*?)```/s' , 'to' => "\n<pre><code>$1</code></pre>\n");
$efef_rex[] = array( 'name' => 'precode2','from' => '/\n\n    (.*?)\n\n/s' , 'to' => "\n<pre><code>\n    $1\n</code></pre>\n\n");

$efef_rex[] = array( 'name' => 'blockquote1','from' => '/\n\n>(.*?)\n\n/s' , 'to' => "\n<blockquote>\n$1\n</blockquote>\n\n");
$efef_rex[] = array( 'name' => 'blockquote2','from' => '/\n>/s' , 'to' => "\n");


$efef_rex[] = array( 'name' => 'img1',    'from' => '/!\[([^\n]+?)\]\((\S+?)\)/s' , 'to' => '<img src="$2" alt="$1">');
$efef_rex[] = array( 'name' => 'img2',    'from' => "/!<(\S+?)>/si" , 'to' => '<img src="$1" alt="$1">');

$efef_rex[] = array( 'name' => 'link1',   'from' => '/\[([^\n]+?)\]\((\S+?)\)/s' , 'to' => '<a href="$2">$1</a>');
$efef_rex[] = array( 'name' => 'link2',   'from' => "/<(http\S+?)>/si" , 'to' => '<a href="$1">$1</a>');
$efef_rex[] = array( 'name' => 'code',    'from' => "/`([^\n]+?)`/s" , 'to' => '<code>$1</code>');

// ADD NEW MARKDOWN SHORTCUTS HERE

$efef_rex[] = array( 'name' => 'tab',    'from' => "/\t/s" , 'to' => '&Tab;');
$efef_rex[] = array( 'name' => 's',      'from' => "/\s~~([^~]*?)~~(?=[\p{P}\s])/s"   , 'to' => ' <s>$1</s>');
$efef_rex[] = array( 'name' => 'mark',   'from' => "/\s==([^=]*?)==(?=[\p{P}\s])/s"   , 'to' => ' <mark>$1</mark>');
$efef_rex[] = array( 'name' => 'u',      'from' => "/\s___([^_]*?)___(?=[\p{P}\s])/s" , 'to' => ' <u>$1</u>');

$efef_rex[] = array( 'name' => 'sup1',   'from' => "/(\S)\^(\S)(\s)/s" , 'to' => '$1<sup>$2</sup>$3');
$efef_rex[] = array( 'name' => 'sup2',   'from' => "/(\S)\^(.+?)\^/s"  , 'to' => '$1<sup>$2</sup>');

$efef_rex[] = array( 'name' => 'quote',  'from' => "/([^'])''([^'])/s"  , 'to' => '$1&apos;$2');

$efef_rex[] = array( 'name' => 'video',  'from' => "/<iframe\s*wid.*?height.*?(src.*?iframe.)/s"  ,
'to' => '<div style="position:relative; width:100%; max-width:560px; height:0px; padding-bottom:56.25%;"><iframe style="position:absolute; left:0; top:0; width:100%; height:100%" $1</div>');

$efef_rex[] = array( 'name' => 'anchor', 'from' => "/(<h.>)@\s*([^<\s]+)(.*?<.h.>)/s"  , 'to' => "\n" . '<a name="$2"></a>' . "\n" . '$1$2$3');

// ============================================================================

function efef_300_preg_replace($efef_md_text, $efef_rex)
{
  $html_text = $efef_md_text;
  foreach ($efef_rex as $replace) {
    $name = $replace['name'];
    $from = $replace['from'];
    $to   = $replace['to'];

    ### print "RRR: $name $from $to <br>\n";
    $html_text = preg_replace($from, $to, $html_text);
    ### print "SSS: $name $from $to <br>\n";
  }
  return $html_text;
}

$efef_hash['content'] = efef_300_preg_replace($efef_hash['content'], $efef_rex);

