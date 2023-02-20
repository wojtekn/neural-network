<?php

declare(strict_types = 1);

namespace NeuralNetwork\Tests;

use NeuralNetwork\ActivationFunctions\Binary;
use NeuralNetwork\ActivationFunctions\HyperbolicTangent;
use NeuralNetwork\ActivationFunctions\Identity;
use NeuralNetwork\ActivationFunctions\ReLu;
use NeuralNetwork\ActivationFunctions\Sigmoid;
use NeuralNetwork\NeuralNetwork;
use PHPUnit\Framework\TestCase;

class NeuralNetworkTest extends TestCase
{
    public function testIdentityActivationFunction()
    {
        $nn = new NeuralNetwork(4);

	    $nn->setInputValue(0, 1);
	    $nn->setInputValue(1, 2);
	    $nn->setInputValue(2, 3);
	    $nn->setInputValue(3, 4);

        $o1 = $nn->createNewOutput(new Identity());
        $nn->connectWeights(0, 0, 0, 0);

        $this->assertEquals(0, $o1->getValue());
    }

    public function testBinaryActivationFunction()
    {
        $nn = new NeuralNetwork(2);

        $nn->setInputValue(0, 1);
        $nn->setInputValue(1, 2);

        $o1 = $nn->createNewOutput(new Binary());
        $nn->connectWeights(0, 0);

        $this->assertEquals(1, $o1->getValue());
    }

    public function testSigmoidActivationFunction()
    {
        $nn = new NeuralNetwork(2);

        $nn->setInputValue(0, 1);
        $nn->setInputValue(1, 2);

        $o1 = $nn->createNewOutput(new Sigmoid());
        $nn->connectWeights(0, 0);

        $this->assertEquals(.5, $o1->getValue());
    }

    public function testHyperbolicTangentActivationFunction()
    {
        $nn = new NeuralNetwork(2);

        $nn->setInputValue(0, 1);
        $nn->setInputValue(1, 2);

        $o1 = $nn->createNewOutput(new HyperbolicTangent());
        $nn->connectWeights(0, 0);

        $this->assertEquals(0, $o1->getValue());
    }

    public function testReLuActivationFunction()
    {
        $nn = new NeuralNetwork(2);

        $nn->setInputValue(0, 1);
        $nn->setInputValue(0, 2);

        $o1 = $nn->createNewOutput(new ReLu());
        $nn->connectWeights(0, 0);

        $this->assertEquals(0, $o1->getValue());
    }

    public function testSingleLayerPerceptronException()
    {
        $nn = new NeuralNetwork(0);

	    $this->expectException(\RuntimeException::class);

        $nn->connectWeights(0, 0, 0, 0);
    }
}