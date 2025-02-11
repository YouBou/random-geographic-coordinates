<?php

namespace App\Services\UsecaseOutput\Impls;

use App\Services\UsecaseOutput\GenerateCoordinatesOutput;

class GenerateCoordinatesOutputImpl implements GenerateCoordinatesOutput
{
    public function __construct(
        private readonly float $latitude,
        private readonly float $longitude,
    ) {
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }
}