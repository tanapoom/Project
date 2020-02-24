<?php

$users = App\Attraction::where('provinces_id', 34)->get()->toArray();

foreach ($users as $user) {
    echo $user['attractions_name']."  ".$user['description'];
    echo "<br></br>";
}
