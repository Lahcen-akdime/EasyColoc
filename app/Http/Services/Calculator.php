<?php
class Calculator{
    public function calculateAmount($price,$usersNb):float{
    $amount = $price / $usersNb ;
    return $amount ;
    }
} 