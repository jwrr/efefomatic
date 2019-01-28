<?php
/*
Copyright (c) 2019 JWRR.COM (jwrr.com at gmail.com)

This work is licensed under the terms of the MIT license.
For a copy, see <https://opensource.org/licenses/MIT>.
*/

/*
  Capture all named anchors (<a name="">") and the following line which
  should be a header.
*/

function efef_350_toc($efef_hash)
{
  $rex = "/<a\s+name\s*=\s*\"(.*?)\".*?\n\s*<h.>(.*?)<.h.>/s";
  $html = "\n<div class=\"toc\">\n<h2>Table of Contents</h2>\n";
  $html .= "\n<div class=\"embed\">embedded</div>\n<ul>\n";
  $cnt = preg_match_all($rex, $efef_hash['content'], $matches, PREG_SET_ORDER);
  for ($i=0; $i<$cnt; $i++) {
    $toc_url = trim($matches[$i][1]);
    $toc_txt = trim($matches[$i][2]);
    $html .= "<li><a href=\"#$toc_url\">$toc_txt</a>\n";
  }
  $html .= "</ul>\n</div>\n";
  return $html;
}

$efef_hash['toc'] = efef_350_toc($efef_hash);

