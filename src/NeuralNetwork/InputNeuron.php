<?php

declare(strict_types = 1);

namespace NeuralNetwork;

class InputNeuron extends Neuron
{
    private float $value = 0;

    public function getValue(): float
    {
        return $this->value;
    }

    public function setValue(float $value): void
    {
        $this->value = $value;
    }
}