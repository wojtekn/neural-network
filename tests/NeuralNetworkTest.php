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
        $nn = new NeuralNetwork();

        $i1 = $nn->createNewInput();
        $i2 = $nn->createNewInput();
        $i3 = $nn->createNewInput();
        $i4 = $nn->createNewInput();

        $i1->setValue(1);
        $i2->setValue(2);
        $i3->setValue(3);
        $i4->setValue(4);

        $o1 = $nn->createNewOutput(new Identity());
        $nn->setWeights(0, 0, 0, 0);

        $this->assertEquals(0, $o1->getValue());
    }

    public function testBinaryActivationFunction()
    {
        $nn = new NeuralNetwork();

        $i1 = $nn->createNewInput();
        $i1->setValue(1);

        $i2 = $nn->createNewInput();
        $i2->setValue(2);

        $o1 = $nn->createNewOutput(new Binary());
        $nn->setWeights(0, 0);

        $this->assertEquals(1, $o1->getValue());
    }

    public function testSigmoidActivationFunction()
    {
        $nn = new NeuralNetwork();

        $i1 = $nn->createNewInput();
        $i1->setValue(1);

        $i2 = $nn->createNewInput();
        $i2->setValue(2);

        $o1 = $nn->createNewOutput(new Sigmoid());
        $nn->setWeights(0, 0);

        $this->assertEquals(.5, $o1->getValue());
    }

    public function testHyperbolicTangentActivationFunction()
    {
        $nn = new NeuralNetwork();

        $i1 = $nn->createNewInput();
        $i1->setValue(1);

        $i2 = $nn->createNewInput();
        $i2->setValue(2);

        $o1 = $nn->createNewOutput(new HyperbolicTangent());
        $nn->setWeights(0, 0);

        $this->assertEquals(0, $o1->getValue());
    }

    public function testReLuActivationFunction()
    {
        $nn = new NeuralNetwork();

        $i1 = $nn->createNewInput();
        $i1->setValue(1);

        $i2 = $nn->createNewInput();
        $i2->setValue(2);

        $o1 = $nn->createNewOutput(new ReLu());
        $nn->setWeights(0, 0);

        $this->assertEquals(0, $o1->getValue());
    }

    public function testSingleLayerPerceptronException()
    {
        $nn = new NeuralNetwork();

	    $this->expectException(\RuntimeException::class);

        $nn->setWeights(0, 0, 0, 0);
    }
}