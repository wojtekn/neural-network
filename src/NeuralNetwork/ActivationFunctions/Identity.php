<?php

declare(strict_types = 1);

namespace NeuralNetwork\ActivationFunctions;

class Identity implements ActivationFunction
{
    /**
     * Returns the input
     */
    public function activation(float $input): float
    {
        return $input;
    }
}