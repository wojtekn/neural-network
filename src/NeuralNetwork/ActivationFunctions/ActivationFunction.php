<?php

declare(strict_types = 1);

namespace NeuralNetwork\ActivationFunctions;

interface ActivationFunction
{
    public function activation(float $input): float;
}