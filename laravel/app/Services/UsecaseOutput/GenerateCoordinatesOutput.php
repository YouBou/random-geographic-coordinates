<?php

namespace App\Services\UsecaseOutput;

interface GenerateCoordinatesOutput
{
    public function getLatitude(): float;

    public function getLongitude(): float;
}