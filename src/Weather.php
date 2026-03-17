<?php

namespace HKO;

class Weather
{
    private string $url = "https://data.weather.gov.hk/weatherAPI/opendata/weather.php?dataType=fnd&lang={lang}";

    public function fetch(string $lang = "en"): array
    {
        $url = str_replace("{lang}", $lang, $this->url);
        $data = json_decode(file_get_contents($url), true);

        return array_map(function ($d) {
            return [
                "date"            => substr($d["forecastDate"], 0, 4) . "-" . substr($d["forecastDate"], 4, 2) . "-" . substr($d["forecastDate"], 6, 2),
                "low"             => $d["forecastMintemp"]["value"],
                "high"            => $d["forecastMaxtemp"]["value"],
                "unit"            => $d["forecastMaxtemp"]["unit"],
                "forecastWind"    => $d["forecastWind"],
                "forecastWeather" => $d["forecastWeather"],
                "forecastIcon"    => $d["ForecastIcon"],
            ];
        }, $data["weatherForecast"]);
    }
}
