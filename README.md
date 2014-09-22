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
