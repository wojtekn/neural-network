<?php

declare(strict_types = 1);

namespace NeuralNetwork\ActivationFunctions;

class Sigmoid implements ActivationFunction
{
    /**
     * Returns a value between 0 and 1
     */
    public function activation(float $input): float
    {
        return 1 / (1 + M_E ** -$input);
    }
}