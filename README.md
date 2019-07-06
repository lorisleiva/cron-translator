# CRON Translator
⏰️ Makes CRON expressions human-readable

## Installation

```sh
composer require lorisleiva/cron-translator
```

## Usage

```php
use Lorisleiva\CronTranslator\CronTranslator;

CronTranslator::translate('* * * * *');       // => Every minute
CronTranslator::translate('30 22 * * *');     // => Every day at 10:30pm
CronTranslator::translate('0 16 * * 1');      // => Every Monday at 4:00pm
CronTranslator::translate('0 0 1 1 *');       // => Every year on January the 1st at 12:00am
CronTranslator::translate('0 0 1 * *');       // => The 1st of every month at 12:00am
CronTranslator::translate('0 * * * 1');       // => Once an hour on Mondays
CronTranslator::translate('* 1-20 * * *');    // => Every minute 20 hours a day
CronTranslator::translate('0,30 * * * *');    // => Twice an hour
CronTranslator::translate('0 1-5 * * *');     // => 5 times a day
CronTranslator::translate('0 1 1-5 * *');     // => 5 days a month at 1:00am
CronTranslator::translate('*/2 * * * *');     // => Every 2 minutes
CronTranslator::translate('* 1/3 2 * *');     // => Every minute of every 3 hours on the 2nd of every month
CronTranslator::translate('1-3/5 * * * *');   // => 3 times every 5 minutes
CronTranslator::translate('1,2 0 */2 1,2 *'); // => Twice an hour every 2 days 2 months a year at 12am
```
