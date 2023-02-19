<?php

declare(strict_types = 1);

namespace NeuralNetwork;

use NeuralNetwork\ActivationFunctions\ActivationFunction;

class WorkingNeuron extends Neuron
{
    private $connections = [];

    public function __construct(
		private ActivationFunction $activationFunction
    )  { }

    public function getValue(): float
    {
        $sum = 0;

        /** @var Connection $connection */
        foreach ($this->connections as $c)
        {
            $sum += $c->getValue();
        }

        return $this->activationFunction->activation($sum);
    }

    public function addConnection(Connection $connection)
    {
        $this->connections[] = $connection;
    }
}