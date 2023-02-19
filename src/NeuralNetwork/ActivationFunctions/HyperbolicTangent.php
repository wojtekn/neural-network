<?php

declare(strict_types = 1);

namespace NeuralNetwork\ActivationFunctions;

class HyperbolicTangent implements ActivationFunction
{
    /**
     * Returns the hyperbolic tangent of input, a value between -1 and 1
     */
    public function activation(float $input): float
    {
        return tanh($input);
    }
}