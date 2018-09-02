<?php

$date = new \DateTime();
echo $date->format('H:i:s');

sleep(12);

echo $date->format('H:i:s');