# FOSSwitt
Very Basic and low resource webpage for receiving Ecowitt POST's and formatting into a webpage.

Set your Ecowitt device to send to your server using the ecowitt protocol on port 80 to [DOMAIN].com/post.php

Use nginx or apache to host the php files in /var/www/html/

post.php handles the HTTP POST's in JSON format and saved to log.txt. weather.php reads and displays the data.


Check out a sample at: https://weather.rat.blue
