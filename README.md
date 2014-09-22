# Boring stuff instruction

## 1. Install development tools and configure an autoloader via `composer.json`:

```json
{
    "require": {
        "php": "~5.5.0"
    },
    "require-dev": {
        "behat/behat": "~3.0.13",
        "phpspec/phpspec": "~2.1.0-RC1",
        "phpunit/phpunit": "~4.2.6"
    },
    "autoload": {
        "psr-0": {
            "SymfonyLive": "src/"
        }
    }
}
```

## 2. Bring in Symfony2 standard distribution into the project:

Download Symfony2 standard edition to the framework folder up one folder (say `N` to "Acme demo
bundle"):

```bash
composer create-project symfony/framework-standard-edition ../framework/ "~2.5.3"
```

Copy the `app` and `web` folders from the standard edition to the project:

```bash
cp -r ../framework/app . && cp -r ../framework/web
```

Replace your `composer.json` with the next block and then run `composer update`:

```json
{
    "require": {
        "php": "~5.5.0",
        "symfony/symfony": "~2.5.4",
        "doctrine/orm": "~2.2.3",
        "doctrine/doctrine-bundle": "~1.2",
        "twig/extensions": "~1.0",
        "symfony/assetic-bundle": "~2.3",
        "symfony/swiftmailer-bundle": "~2.3",
        "symfony/monolog-bundle": "~2.4",
        "sensio/distribution-bundle": "~3.0",
        "sensio/framework-extra-bundle": "~3.0",
        "incenteev/composer-parameter-handler": "~2.0"
    },
    "require-dev": {
        "behat/behat": "~3.0.13",
        "behat/mink": "~1.5.0",
        "behat/mink-extension": "~2.0.0",
        "behat/symfony2-extension": "~2.0.0",
        "behat/mink-browserkit-driver": "~1.1.0",
        "phpspec/phpspec": "~2.1.0-RC1",
        "phpunit/phpunit": "~4.2.0",
        "sensio/generator-bundle": "~2.3"
    },
    "autoload": {
        "psr-0": {
            "SymfonyLive": "src/"
        }
    },
    "scripts": {
        "post-root-package-install": [
            "SymfonyStandard\\Composer::hookRootPackageInstall"
        ],
        "post-install-cmd": [
            "Incenteev\\ParameterHandler\\ScriptHandler::buildParameters",
            "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::buildBootstrap",
            "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::clearCache",
            "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::installAssets",
            "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::installRequirementsFile",
            "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::removeSymfonyStandardFiles"
        ],
        "post-update-cmd": [
            "Incenteev\\ParameterHandler\\ScriptHandler::buildParameters",
            "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::buildBootstrap",
            "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::clearCache",
            "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::installAssets",
            "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::installRequirementsFile",
            "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::removeSymfonyStandardFiles"
        ]
    },
    "extra": {
        "symfony-app-dir": "app",
        "symfony-web-dir": "web",
        "incenteev-parameters": {
            "file": "app/config/parameters.yml"
        }
    }
}
```

## 3. Configure online attendee behat suite by replacing `behat.yml` and running `behat --init`

```yml
default:
    suites:
        attendee:
            contexts: [ AttendeeContext ]
            filters:  { role: conference attendee }
        online_attendee:
            contexts: [ OnlineAttendeeContext ]
            filters:  { role: conference attendee, tags: critical }
    extensions:
        Behat\Symfony2Extension: ~
        Behat\MinkExtension:
            default_session: 'symfony2'
            sessions:
                symfony2: { symfony2: ~ }
```

## 4. Generate Symfony2 bundle

```bash
app/console generate:bundle \
    --namespace=SymfonyLive/Framework/PersonalScheduleBundle \
    --dir=src \
    --bundle-name=PersonalScheduleBundle \
    --no-interaction
```
