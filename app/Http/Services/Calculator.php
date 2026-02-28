<?php
namespace App\Http\Services ;

class Calculator{
    public static function calculateAmount($price,$usersNb):float{
    $amount = $price / $usersNb ;
    return $amount ;
    }
} 