<!DOCTYPE html>
<html>
<head>
    <title>Weather Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1E555C;
            padding: 20px;
        }
        .weather-data {
            background-color: #EDB183;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }
        .weather-data h2 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <h1>Current Weather Data</h1>
    <?php
    $file = '/var/www/html/log.txt';

    // read the last line from the file
    $line = '';
    $f = fopen($file, 'r');
    $cursor = -1;

    fseek($f, $cursor, SEEK_END);
    $char = fgetc($f);

    while ($char === "\n" || $char === "\r") {
        fseek($f, $cursor--, SEEK_END);
        $char = fgetc($f);
    }

    while ($char !== false && $char !== "\n" && $char !== "\r") {
        $line = $char . $line;
        fseek($f, $cursor--, SEEK_END);
        $char = fgetc($f);
    }

    // decode the JSON data
    $data = json_decode($line, true);

    // convert temperature from F to C
    $tempF = $data['tempf'];
    $tempC = ($tempF - 32) * (5/9);

        // hourly rain
        $hourlyrainin = $data['hourlyrainin'];

    // get humidity and UV index
    $humidity = $data['humidity'];
    $uv = $data['uv'];
    // convert pressure from inHg to hPa
    $pressureInHg = $data['baromrelin'];
    $pressureHPa = $pressureInHg * 33.86389;

    // convert wind speed from mph to km/h
    $windSpeedMph = $data['windspeedmph'];
    $windSpeedKmph = $windSpeedMph * 1.60934;

    // determine wind direction
    $windDir = $data['winddir'];
    $directions = ["N", "NE", "E", "SE", "S", "SW", "W", "NW", "N"];
    $windDirection = $directions[round($windDir / 45)];

    // display the data
    ?>
    <div class="weather-data">
        <h2>Temperature</h2>
        <p><?php echo round($tempC, 2) . "°C"; ?></p>
    </div>
    <div class="weather-data">
        <h2>Humidity</h2>
        <p><?php echo $humidity . "%"; ?></p>
    </div>
    <div class="weather-data">
        <h2>UV Index</h2>
        <p><?php echo $uv; ?></p>
        </div>
    <div class="weather-data">
        <h2>Wind Speed</h2>
        <p><?php echo round($windSpeedKmph, 2) . " km/h"; ?></p>
    </div>
    <div class="weather-data">
        <h2>Wind Direction</h2>
        <p><?php echo $windDirection; ?></p>
    </div>
        <div class="weather-data">
        <h2>Hourly Rain</h2>
        <p><?php echo $hourlyrainin; ?></p>
    </div>
      <p><?php echo date('Y-m-d H:i:s'); ?></p>
</body>
</html>
