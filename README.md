# neural-network
[![Build Status](https://travis-ci.org/patrickschur/neural-network.svg?branch=master)](https://travis-ci.org/patrickschur/neural-network)
[![codecov](https://codecov.io/gh/patrickschur/neural-network/branch/master/graph/badge.svg)](https://codecov.io/gh/patrickschur/neural-network)
[![Version](https://img.shields.io/packagist/v/patrickschur/neural-network.svg?style=flat-plastic)](https://packagist.org/packages/patrickschur/neural-network)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.0-ee4499.svg?style=flat-plastic)](http://php.net/)
[![License](https://img.shields.io/packagist/l/patrickschur/neural-network.svg?style=flat-plastic)](https://opensource.org/licenses/MIT)

A dead simple neural network. For educational purposes only. Ported from Java into PHP.
Originally written in Java from [Brotcrunsher](https://youtube.com/brotcrunsher) a German youtuber who makes tutorials about computer science.

It's forked from [patrickschur/neural-network](https://github.com/patrickschur/neural-network), slightly refactored, and added sample training based on [How to build a simple neural network in 9 lines of Python code](https://medium.com/technology-invention-and-more/how-to-build-a-simple-neural-network-in-9-lines-of-python-code-cc8f23647ca1) article.

> **Note**: The project is still under construction and can change at any time

## Installation
```bash
$ composer require patrickschur/neural-network
```

## Examples
Creating a simple single-layer perceptron network with four inputs and one output neuron.
```php
// Creates the neural network with four input neurons
$nn = new NeuralNetwork(4);

// Sets the input for each input neuron
$nn->setInputValue(0, 1);
$nn->setInputValue(1, 2);
$nn->setInputValue(2, 3);
$nn->setInputValue(3, 4);

// Creates the output neuron
$o1 = $nn->createNewOutput(new Identity());
 
// Sets the weights and connect each input to the output neuron
$nn->connectWeights(0, 0, 0, 0);
 
echo $o1->getValue(); // Output 0
```
![Screenshot](screenshots/singlelayer.png)

## Run examples

```php
php examples/ExampleLogicalOperations.php
```

## Contribute
Feel free to contribute. Any help is welcome.

## License
This project is licensed under the terms of the MIT license.