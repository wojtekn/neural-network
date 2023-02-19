<?php

declare(strict_types = 1);

namespace NeuralNetwork;

abstract class Neuron
{
    abstract public function getValue(): float;
}