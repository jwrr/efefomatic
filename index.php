<?php
$script = 'efefomatic.php';
if (!@include_once($script)) {
  $script = 'efefomatic' . DIRECTORY_SEPARATOR . $script;
  for ($i=0; $i<5; $i++) {
    if (@include_once($script)) break;
    $script = '..' . DIRECTORY_SEPARATOR  . $script; 
  }
}
print efefomatic();
