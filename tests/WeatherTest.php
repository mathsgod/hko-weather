<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use HKO\Weather;

final class WeatherTest extends TestCase
{
    public function test_fetch_returns_9_days(): void
    {
        $w = new Weather();
        $this->assertCount(9, $w->fetch());
    }

    public function test_fetch_entry_has_required_keys(): void
    {
        $w = new Weather();
        $entry = $w->fetch()[0];

        $this->assertArrayHasKey('date', $entry);
        $this->assertArrayHasKey('low', $entry);
        $this->assertArrayHasKey('high', $entry);
        $this->assertArrayHasKey('unit', $entry);
        $this->assertArrayHasKey('forecastWind', $entry);
        $this->assertArrayHasKey('forecastWeather', $entry);
        $this->assertArrayHasKey('forecastIcon', $entry);
        $this->assertArrayHasKey('forecastIconUrl', $entry);
    }

    public function test_fetch_icon_url_format(): void
    {
        $w = new Weather();
        $entry = $w->fetch()[0];

        $this->assertMatchesRegularExpression(
            '#^https://www\.hko\.gov\.hk/images/HKOWxIconOutline/pic\d+\.png$#',
            $entry['forecastIconUrl']
        );
    }

    public function test_fetch_date_format(): void
    {
        $w = new Weather();
        $date = $w->fetch()[0]['date'];

        $this->assertMatchesRegularExpression('/^\d{4}-\d{2}-\d{2}$/', $date);
    }

    public function test_fetch_traditional_chinese(): void
    {
        $w = new Weather();
        $this->assertCount(9, $w->fetch('tc'));
    }
}
