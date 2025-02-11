<?php

namespace App\Services\Usecase;

use App\Services\UsecaseOutput\GenerateCoordinatesOutput;
use App\Services\UsecaseOutput\Impls\GenerateCoordinatesOutputImpl;

class GenerateCoordinatesUsecase
{
    public function execute(): GenerateCoordinatesOutput
    {
        // 主要な大陸の大まかな範囲を定義
        $landMasses = [
            // 北米
            ['min_lat' => 25, 'max_lat' => 71, 'min_lng' => -165, 'max_lng' => -50],
            // 南米
            ['min_lat' => -55, 'max_lat' => 12, 'min_lng' => -81, 'max_lng' => -35],
            // ユーラシア
            ['min_lat' => 35, 'max_lat' => 70, 'min_lng' => -10, 'max_lng' => 180],
            // アフリカ
            ['min_lat' => -35, 'max_lat' => 37, 'min_lng' => -17, 'max_lng' => 51],
            // オーストラリア
            ['min_lat' => -43, 'max_lat' => -10, 'min_lng' => 113, 'max_lng' => 153],
        ];

        // ランダムに大陸を選択
        $landMass = $landMasses[array_rand($landMasses)];
        
        $latitude = rand(
            $landMass['min_lat'] * 10000,
            $landMass['max_lat'] * 10000
        ) / 10000;

        $longitude = rand(
            $landMass['min_lng'] * 10000,
            $landMass['max_lng'] * 10000
        ) / 10000;

        return new GenerateCoordinatesOutputImpl(
            latitude: $latitude,
            longitude: $longitude,
        );
    }
}