# BoostCake

[![Build Status](https://travis-ci.org/slywalker/cakephp-plugin-boost_cake.png)](https://travis-ci.org/slywalker/cakephp-plugin-boost_cake)
[![Total Downloads](https://poser.pugx.org/slywalker/boost_cake/d/total.png)](https://packagist.org/packages/slywalker/boost_cake)
[![Latest Stable Version](https://poser.pugx.org/slywalker/boost_cake/v/stable.png)](https://packagist.org/packages/slywalker/boost_cake)

BoostCake is a plugin for CakePHP using Bootstrap

* [Bootstrap(2.3.2)](https://github.com/twitter/bootstrap)
* [Bootstrap(3.0.0-wip)](https://github.com/twitter/bootstrap/tree/3.0.0-wip)

## Requirements

* CakePHP >= 2.3
* Bootstrap >= 2.3 (3.0 support)

## Installation

Ensure require is present in composer.json. This will install the plugin into Plugin/BoostCake:

	{
		"require": {
			"slywalker/boost_cake": "*"
		}
	}

## Documentation

[BoostCake - Bootstrap Plugin for CakePHP](http://slywalker.github.io/cakephp-plugin-boost_cake/)

## Development Policy

More Simple! Simple! Simple!

* Develop only those that method's $options in FormHelper unable to solve.
* Don't develop ajax/js helper

If you want to simplify the options, you can develop WrapBoostCake plugin.

### What is solve in this plugin

* Replace checkbox's and radio's `label`
* Add `div` wrapping input
* Add content before and after `input`
* Add error class in outer `div`
* Change pagination tags
* Change SessionHelper::flash()`s template
