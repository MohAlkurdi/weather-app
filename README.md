# Weather App

## Features:

-   Get current weather information for a given city
-   Get current weather information for multiple cities
-   Get weather statistics
-   Display live weather stats
-   Display a live weather map

## installation

### prerequisite

-   PHP 8.2 or higher
-   composer
-   MYSQL

### install

1. Clone the repository

```bash
git clone https://github.com/MohAlkurdi/weather-app.git && cd weather-app
```

2. Configure Environment Variables:

```bash
cp .env.example .env
```

**Don't forget to add your credentials for [weatherAPI](https://www.weatherapi.com/) and [windy](https://api.windy.com/)**

```bash
WEATHER_API_KEY=<WEATHER_API_KEY>
WINDY_API_KEY=<WINDY_API_KEY>
```

3. Install Composer Dependencies:

```bash
composer install
```

4. Generate Application Key:

```bash
php artisan key:generate
```

5. Start the Development Server:

```bash
php artisan serve
```

-   Laravel application should now be accessible at http://localhost:8000

## API Reference

### Get Weather Information By City Name

```http
GET /api/weather/:city
```

| Parameter | Type     | Description             |
| :-------- | :------- | :---------------------- |
| `city`    | `string` | **Required**. City Name |

-   The app will check the cache first, if not found, it will call the API

<details>
      <summary>Response</summary>

```json
{
    "location": {
        "name": "Jeddah",
        "region": "Makkah",
        "country": "Saudi Arabia",
        "lat": 21.52,
        "lon": 39.22,
        "tz_id": "Asia/Riyadh",
        "localtime_epoch": 1710282423,
        "localtime": "2024-03-13 1:27"
    },
    "current": {
        "last_updated_epoch": 1710281700,
        "last_updated": "2024-03-13 01:15",
        "temp_c": 28,
        "temp_f": 82.4,
        "is_day": 0,
        "condition": {
            "text": "Clear",
            "icon": "//cdn.weatherapi.com/weather/64x64/night/113.png",
            "code": 1000
        },
        "wind_mph": 3.8,
        "wind_kph": 6.1,
        "wind_degree": 340,
        "wind_dir": "NNW",
        "pressure_mb": 1012,
        "pressure_in": 29.88,
        "precip_mm": 0,
        "precip_in": 0,
        "humidity": 48,
        "cloud": 0,
        "feelslike_c": 30,
        "feelslike_f": 86.1,
        "vis_km": 10,
        "vis_miles": 6,
        "uv": 1,
        "gust_mph": 8.3,
        "gust_kph": 13.3
    }
}
```

</details>

---

### Get Weather Information For Multiple Cities

```http
POST /api/weather/bulk
```

-   **Request Body**

```json
{
    "cities": ["Makkah", "Riyadh", "Jeddah"]
}
```

<details>
  <summary>Response</summary>

```json
[
    {
        "location": {
            "name": "Makkah",
            "region": "Makkah",
            "country": "Saudi Arabia",
            "lat": 21.43,
            "lon": 39.83,
            "tz_id": "Asia/Riyadh",
            "localtime_epoch": 1710283965,
            "localtime": "2024-03-13 1:52"
        },
        "current": {
            "last_updated_epoch": 1710283500,
            "last_updated": "2024-03-13 01:45",
            "temp_c": 28,
            "temp_f": 82.4,
            "is_day": 0,
            "condition": {
                "text": "Clear",
                "icon": "//cdn.weatherapi.com/weather/64x64/night/113.png",
                "code": 1000
            },
            "wind_mph": 3.8,
            "wind_kph": 6.1,
            "wind_degree": 340,
            "wind_dir": "NNW",
            "pressure_mb": 1012,
            "pressure_in": 29.88,
            "precip_mm": 0,
            "precip_in": 0,
            "humidity": 48,
            "cloud": 0,
            "feelslike_c": 29.7,
            "feelslike_f": 85.5,
            "vis_km": 10,
            "vis_miles": 6,
            "uv": 1,
            "gust_mph": 8.3,
            "gust_kph": 13.3
        }
    },
    {
        "location": {
            "name": "Riyadh",
            "region": "Ar Riyad",
            "country": "Saudi Arabia",
            "lat": 24.64,
            "lon": 46.77,
            "tz_id": "Asia/Riyadh",
            "localtime_epoch": 1710283879,
            "localtime": "2024-03-13 1:51"
        },
        "current": {
            "last_updated_epoch": 1710283500,
            "last_updated": "2024-03-13 01:45",
            "temp_c": 15,
            "temp_f": 59,
            "is_day": 0,
            "condition": {
                "text": "Clear",
                "icon": "//cdn.weatherapi.com/weather/64x64/night/113.png",
                "code": 1000
            },
            "wind_mph": 2.2,
            "wind_kph": 3.6,
            "wind_degree": 10,
            "wind_dir": "N",
            "pressure_mb": 1022,
            "pressure_in": 30.18,
            "precip_mm": 0,
            "precip_in": 0,
            "humidity": 33,
            "cloud": 0,
            "feelslike_c": 14.8,
            "feelslike_f": 58.6,
            "vis_km": 10,
            "vis_miles": 6,
            "uv": 1,
            "gust_mph": 9.4,
            "gust_kph": 15
        }
    },
    {
        "location": {
            "name": "Jeddah",
            "region": "Makkah",
            "country": "Saudi Arabia",
            "lat": 21.52,
            "lon": 39.22,
            "tz_id": "Asia/Riyadh",
            "localtime_epoch": 1710283893,
            "localtime": "2024-03-13 1:51"
        },
        "current": {
            "last_updated_epoch": 1710283500,
            "last_updated": "2024-03-13 01:45",
            "temp_c": 28,
            "temp_f": 82.4,
            "is_day": 0,
            "condition": {
                "text": "Clear",
                "icon": "//cdn.weatherapi.com/weather/64x64/night/113.png",
                "code": 1000
            },
            "wind_mph": 3.8,
            "wind_kph": 6.1,
            "wind_degree": 340,
            "wind_dir": "NNW",
            "pressure_mb": 1012,
            "pressure_in": 29.88,
            "precip_mm": 0,
            "precip_in": 0,
            "humidity": 48,
            "cloud": 0,
            "feelslike_c": 30,
            "feelslike_f": 86.1,
            "vis_km": 10,
            "vis_miles": 6,
            "uv": 1,
            "gust_mph": 8.3,
            "gust_kph": 13.3
        }
    }
]
```

</details>

---

### Get Weather Stats

```http
GET /api/weather/statistics/:city
```

| Parameter | Type     | Description             |
| :-------- | :------- | :---------------------- |
| `city`    | `string` | **Required**. City Name |

  <details>
    <summary>Response</summary>

```json
{
    "max_temp": 31.4,
    "min_temp": 26.6,
    "avg_temp": 28.5,
    "condition": "Sunny"
}
```

</details>

## Live Weather stats & map

### Live Weather Stats

visit `http://localhost:8000/live?city=Makkah`

![screenshot-20240313-005500](https://github.com/MohAlkurdi/Authficate-API/assets/64875290/06ebb301-e035-4a65-95a5-007e5729c87d)

---

### Live Radar Weather Map

visit `http://localhost:8000/live-radar`

![screenshot](https://github.com/MohAlkurdi/Authficate-API/assets/64875290/c153e538-bed7-48ac-b1ed-876fcb817bb5)

## Testing

```bash
php artisan test
```
