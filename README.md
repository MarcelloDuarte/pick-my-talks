# What is it?

This is a demonstration of the simple project built using the BDD process we call **Modelling by Example**. You can learn more on the process by reading the [MbE introduction post](http://everzet.com/post/99045129766/introducing-modelling-by-example) by @everzet (the process author) or viewing his [presentation from BDDX14](https://skillsmatter.com/skillscasts/5899-modelling-by-example).

## How to use this repository?

This repository is an outcome of step-by-step development process where each commit represent small step towards the working solution. This way we can show you the complete representation of MbE process without losing important heuristic. The right way to use this repo is to follow its [commit history](https://github.com/MarcelloDuarte/pick-my-talks/commits/master?page=2).

## How to run tests on this project?

0. Clone the repo
1. Install [composer](https://getcomposer.org/doc/00-intro.md#installation-nix)
2. Install dependencies by running `php composer.phar install`
3. Run unit tests via `vendor/bin/phpspec run`
4. Run acceptance tests via `vendor/bin/behat` 

## How to run this project?

0. Follow steps in previous section
1. Run an application with `php app/console server:run`
