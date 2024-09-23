<?php
namespace App\Services;

use App\Strategies\Comparisons\TemperatureComparison;
use App\Strategies\Comparisons\HumidityComparison;
use App\Strategies\Comparisons\WindSpeedComparison;
use InvalidArgumentException;

class ComparisonService
{   
    // Estratégias que implementam a interface de comparações
    protected $strategies = [
        'temperature' => TemperatureComparison::class,
        'humidity' => HumidityComparison::class,
        'wind_speed' => WindSpeedComparison::class,
    ];

    public function getStrategy(string $comparisonType)
    {
        if (!array_key_exists($comparisonType, $this->strategies)) {
            throw new InvalidArgumentException('Tipo de comparação inválido');
        }
        return new $this->strategies[$comparisonType]();
    }
}
