<?php
require_once(sfConfig::get('sf_lib_dir').'/markdown.php');
echo trim(Markdown($content));