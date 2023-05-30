<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Get the current timestamp
$timestamp = time();

// Format the timestamp
$date = date('H:i:s_d:m:Y', $timestamp);

// Output the formatted date
echo $date;
?>