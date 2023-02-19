<?php

declare(strict_types = 1);

namespace NeuralNetwork;

class Connection
{
    public function __construct(
		private Neuron $neuron,
		private float $weight
    ) { }

    public function getValue(): float
    {
        return $this->neuron->getValue() * $this->weight;
    }
}