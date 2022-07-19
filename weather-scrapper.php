<?php

  $weather = "";
  $error = "";
  
  if($_GET['city']){
    $urlContents = @file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".$_GET['city']."&appid=57bf516b2102c5e5c6b755a3cd2c1dd1");
    
      // var_dump($urlContents);
    $weatherArray = json_decode($urlContents,true); // true is for associative array
    // print_r($weatherArray);
    if ($weatherArray['cod'] == 200) {

    $weather = "The weather in ".$_GET['city']." is currently '".$weatherArray['weather'][0]['description']."'. ";
    $temperaturInCelcius = intval($weatherArray['main']['temp'] - 273);
    $windSpeed = $weatherArray['wind']['speed'];

    // $weather .= " The temperature is ".round($temperaturInCelcius)."&deg;c";
    $weather .= " The temperature is ".$temperaturInCelcius."&deg;c and the wind speed is ".$windSpeed.". ";
  } else {
    $error = "Cound not find teh city";
  }

}

    

    

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Weather Scrapper</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style type="text/css">
        html { 
            background: url(img/background.jpg) no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        body {
            background:none;
        }

        .container {
          text-align: center;
          margin-top:100px;
          width: 500px;
        }
        input {
          margin:20px;
        }

        #weather{
          margin-top: 15px;
        }
    </style>
  </head>
  <body>
    <div class="container">
        <h1>What's The Weather</h1>
        
        
        <form>
          <div class="form-group">
            <label for="city">Enter the name of a city.</label>
            <input type="text" name="city" class="form-control" id="city" placeholder="Eg. Berlin, London">
           </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <div id="weather">
          <?php
            if($weather){
              echo '<div class="alert alert-success" role="alert">
              '. $weather.
            '</div>';
            } else {
              echo '<div class="alert alert-danger" role="alert">
              '.$error.
              '</div>';
            }
          ?>
        </div>
  
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>