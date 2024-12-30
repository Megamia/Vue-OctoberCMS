<?php

use Dat\Data\Models\Vehicle;

Route::get('vehicle', function () {
    $vehicle = Vehicle::all();
    return $vehicle;
});
