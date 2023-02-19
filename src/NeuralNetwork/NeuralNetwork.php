<?php

declare(strict_types = 1);

namespace NeuralNetwork;

use NeuralNetwork\ActivationFunctions\ActivationFunction;

class NeuralNetwork
{
    private array $inputNeurons = [];

    private array $outputNeurons = [];

    public function createNewOutput(ActivationFunction $activationFunction): WorkingNeuron
    {
        return $this->outputNeurons[] = new WorkingNeuron($activationFunction);
    }

    public function createNewInput(): InputNeuron
    {
        return $this->inputNeurons[] = new InputNeuron();
    }

    public function createFullMesh(float ...$weights): void
    {
        if (count($weights) != (count($this->inputNeurons) * count($this->outputNeurons)))
        {
            throw new \RuntimeException();
        }

        $index = 0;

        /** @var WorkingNeuron $wn */
        foreach ($this->outputNeurons as $wn)
        {
            /** @var InputNeuron $in */
            foreach ($this->inputNeurons as $in)
            {
                $wn->addConnection(new Connection($in, $weights[$index++]));
            }
        }
    }
}