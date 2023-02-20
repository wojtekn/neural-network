<?php

declare(strict_types = 1);

namespace NeuralNetwork;

use NeuralNetwork\ActivationFunctions\ActivationFunction;

class NeuralNetwork
{
    private array $inputNeurons = [];

    private array $outputNeurons = [];

	public function __construct($inputNumber)
	{
		for ($i = 0; $i < $inputNumber; $i++) {
			$this->createNewInput();
		}
	}

	public function setInputValue($number, $value)
	{
		$this->inputNeurons[$number]->setValue($value);
	}

    public function createNewOutput(ActivationFunction $activationFunction): WorkingNeuron
    {
        return $this->outputNeurons[] = new WorkingNeuron($activationFunction);
    }

    public function createNewInput(): InputNeuron
    {
        return $this->inputNeurons[] = new InputNeuron();
    }

    public function setWeights(float ...$weights): void
    {
        if (count($weights) != (count($this->inputNeurons) * count($this->outputNeurons)))
        {
            throw new \RuntimeException(
				sprintf(
					'Incorrect weights. Weights %d, Input neurons %d, Output neurons %d',
					count($weights),
					count($this->inputNeurons),
					count($this->outputNeurons)
				)
            );
        }

        $index = 0;

	    /** @var WorkingNeuron $wn */
        foreach ($this->outputNeurons as $wn)
        {
	        $wn->resetConnections();

            /** @var InputNeuron $in */
            foreach ($this->inputNeurons as $in)
            {
                $wn->addConnection(new Connection($in, $weights[$index++]));
            }
        }
    }

	public function train(
		$trainingSetInputs, $trainingSetOutputs, $times = 1000
	) {
		// Generate initial random weights
		$weights = [];
		for ($i = 1; $i <= count($trainingSetInputs[0]); $i++) {
			// random value between -1 and 1
			$weights[] = 2 * (mt_rand() / mt_getrandmax()) - 1;
		}

		echo 'Initial Weights:';
		var_export($weights);
		echo "\n";

		for ($i = 0; $i < $times; $i++) {
			$errors = [];

			// Pass the training set through our neural network (a single neuron).
			foreach ($trainingSetInputs as $setKey => $trainingSetInput) {
				$this->setWeights(...$weights);

				// Set inputs from given training set
				foreach ($trainingSetInput as $inputKey => $input) {
					$this->setInputValue($inputKey, $input);
				}

				// Get the output which is weighted sum of neurons inputs normalised by Sigmoid
				$outputValue = current($this->outputNeurons)->getValue();

				// Calculate the error for each single input
				// (The difference between the desired output and the predicted output).
				$error = $trainingSetOutputs[$setKey] - $outputValue;

				// Calculate error - we want to make adjustment proportional to the size of the error
				// This means less confident weights are adjusted more.
				// Do this by multiplying the error by gradient of Sigmoid curve (deritative).
				$errors[$setKey] = $error * $outputValue * (1 - $outputValue);
			}

			// Calculate adjustment for each weight - roughly, the error for given training set
			// adjusts each weight, but only if input is not zero.
			$adjustments = [0, 0, 0];
			foreach ($trainingSetInputs as $setKey => $trainingSetInput) {
				foreach ($trainingSetInput as $inputKey => $input) {
					// Multiply the error by the input
					// This means inputs, which are zero, do not cause changes to the weights.
					$adjustments[$inputKey] = $adjustments[$inputKey] + $input * $errors[$setKey];
				}
			}

			// Adjust the weights by adding each weight adjustment to each one.
			foreach (array_keys($adjustments + $weights) as $key) {
				$weights[$key] = $adjustments[$key] + $weights[$key];
			}
		}

		echo 'Trained Weights: ';
		var_export($weights);

		return $weights;
	}
}