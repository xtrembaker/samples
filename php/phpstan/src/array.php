<?php

declare(strict_types=1);

class User {

}

$arr = [
    "key1" => new User(),
    "key2" => new User()
];


$result = parse($arr);


/**
 * @param array{key1: User, key2: User} $payload
 * @return array<mixed>
 */
function parse(array $payload): array
{
    $values = [];
    foreach($payload as $value) {
        $values[] = $value;
    }
    return $values;
//    foreach($payload as $key) {
//        if($key === 'field') {
//            $value = $key['value'];
//        }
//    }
//    return ["toto", "tii"];
}