<?php
function gen_one_to_three() {
    for ($i = 1; $i <= 3; $i++) {
        // Note that $i is preserved between yields.
        yield $i;
    }
}

$generator = gen_one_to_three();

//echo get_class($generator);
//exit();

echo $generator->current();
$generator->next();
echo $generator->current();
//echo $generator->

//echo $value;

//$value = gen_one_to_three();
//echo $value;