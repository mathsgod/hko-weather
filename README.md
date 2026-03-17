![PHP Composer](https://github.com/mathsgod/hko-weather/workflows/PHP%20Composer/badge.svg)

# hko-weather

A PHP library for fetching Hong Kong weather forecast data from the [Hong Kong Observatory Open Data API](https://data.weather.gov.hk/weatherAPI/doc/HKO_Open_Data_API_Documentation.pdf).

## Requirements

- PHP >= 8.0
- Composer

## Installation

```bash
composer require mathsgod/hko-weather
```

## Usage

```php
use HKO\Weather;

$w = new Weather();

// English (default)
$data = $w->fetch();

// Traditional Chinese
$data = $w->fetch('tc');

// Simplified Chinese
$data = $w->fetch('sc');

print_r($data);
```

### Return format

Each entry in the returned array contains:

| Key | Description |
|-----|-------------|
| `date` | Date in `YYYY-MM-DD` format |
| `low` | Minimum temperature |
| `high` | Maximum temperature |
| `unit` | Temperature unit (e.g. `C`) |
| `forecastWind` | Wind description |
| `forecastWeather` | Weather description |
| `forecastIcon` | Weather icon code |
| `forecastIconUrl` | Weather icon image URL (PNG) |

Returns 9 days of forecast data.

### Example output

```
Array
(
    [0] => Array
        (
            [date] => 2026-03-18
            [low] => 21
            [high] => 26
            [unit] => C
            [forecastWind] => East force 2 to 3.
            [forecastWeather] => Mainly cloudy. One or two light rain patches at first. Warm with sunny periods during the day.
            [forecastIcon] => 51
        )

    [1] => Array
        (
            [date] => 2026-03-19
            [low] => 21
            [high] => 27
            [unit] => C
            [forecastWind] => Light winds force 2.
            [forecastWeather] => Sunny periods. Coastal fog in the morning. Rather warm during the day.
            [forecastIcon] => 83
        )

    ...
)
```

## Testing

```bash
composer test
```

## License

MIT
