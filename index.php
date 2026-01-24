<?php

// Increase timeout for heavy FIRST loads (e.g. thumb generation)
ini_set('max_execution_time', 300);

require 'kirby/bootstrap.php';

echo (new Kirby)->render();
