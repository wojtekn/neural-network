<?php

declare(strict_types = 1);

namespace NeuralNetwork\ActivationFunctions;

class Binary implements ActivationFunction
{
    /**
     * Returns the value 0 if the input is less than 0, otherwise 1
     */
    public function activation(float $input): float
    {
        return $input < 0 ? 0 : 1;
    }
}