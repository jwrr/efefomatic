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

function efefomatic($file_path = ".")
{
  $efef_hash['html'] = '';

  $efef_hash['page_url'] = "//$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $efef_hash['file_path'] = $file_path;
  $efef_hash['efef_path'] = dirname(__FILE__);
  $efef_hash['blog_path'] = dirname($efef_hash['efef_path']);
  $slash = DIRECTORY_SEPARATOR;
  $efef_hash['themes_path']  = $efef_hash['efef_path'] . $slash . "themes";

  $efef_hash['plugins_path'] = $efef_hash['efef_path'] . $slash . "plugins";
  $plugins_list = glob($efef_hash['plugins_path'] . $slash . "*efef_*.php");

  foreach ($plugins_list as $plugin) {
    include($plugin);
  }
  
  return $efef_hash['html'];
}
