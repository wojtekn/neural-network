<?php
require __DIR__ . '/../vendor/autoload.php';

use NeuralNetwork\ActivationFunctions\Sigmoid;
use NeuralNetwork\NeuralNetwork;
use NeuralNetwork\ActivationFunctions\Identity;

class ExampleLogicalOperations
{
	/**
	 * Training data: input
	 */
	private array $trainingSetInputs = [
		[0, 0, 1], 
		[1, 1, 1],
		[1, 0, 1],
		[0, 1, 1],
	];

	/**
	 * Training data: output
	 */
	private $exampleOutputs = [
		0,
		1,
		1,
		0
	];

	public function __construct() {
		echo "Run with preset weights:\n";
		$this->runWithPresetWeights();

		echo "Run with training:\n";
		$this->runWithTraining();
	}

	public function runWithPresetWeights()
	{
		$presetWeights = [1, 0, 0];

		echo 'Preset Weights:';
		var_export($presetWeights);
		echo "\n";

		// Creates the neural network with three input neurons
		$nn = new NeuralNetwork(3);
		$output = $nn->createNewOutput(new Identity());
		$nn->connectWeights(...$presetWeights);

		// Test for our example sets
		foreach ($this->trainingSetInputs as $setNumber => $trainingSetInput) {
			foreach ($trainingSetInput as $key => $input) {
				$nn->setInputValue($key, $input);
			}

			echo 'Set ' . $setNumber . ' Output: ' . $output->getValue() . "\n";
		}
	}

	/**
	 * Create neural network and train it based on sample datasets.
	 *
	 * @return void
	 */
	public function runWithTraining()
	{
		// Creates the neural network with three input neurons
		$nn = new NeuralNetwork(3);
		$output = $nn->createNewOutput(new Sigmoid());

		// Initialize weights with random values
		$nn->initializeWeights($this->trainingSetInputs);

		echo 'Initial Weights:';
		var_export($nn->getWeights());
		echo "\n";

		// Train the network
		$nn->train($this->trainingSetInputs, $this->exampleOutputs, 10000);

		echo 'Trained Weights: ';
		var_export($nn->getWeights());
		echo "\n";

		// Test for our example sets
		foreach ($this->trainingSetInputs as $setNumber => $trainingSetInput) {
			foreach ($trainingSetInput as $inputKey => $input) {
				$nn->setInputValue($inputKey, $input);
			}

			echo 'Set ' . $setNumber . ' Output: ' . $output->getValue() . "\n";
		}

	}
}

$network = new ExampleLogicalOperations();