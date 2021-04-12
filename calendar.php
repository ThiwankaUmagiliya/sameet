<?php
require __DIR__ . '/vendor/autoload.php';

                
$gClient = getClient();
$gService = new Google_Service_Calendar($gClient);
$gEvent = new Google_Service_Calendar_Event(array(
          'summary' => $summary ,
          'description' => $description ,
          'start' => array(
            'dateTime' => $start ,
            'timeZone' => 'Asia/Colombo',
          ),
          'end' => array(
            'dateTime' => $end ,
            'timeZone' => 'Asia/Colombo',
          ),
         
          
          'reminders' => array(
            'useDefault' => FALSE,
            'overrides' => array(
              array('method' => 'email', 'minutes' => 24 * 60),
              array('method' => 'popup', 'minutes' => 15),
            ),
          ),
));

        $gCalendarId = 'primary';
        $gEvent = $gService->events->insert($gCalendarId, $gEvent);
        echo '<script type="text/javascript">';
        echo ' alert("The meeting is successfully appended to your Google calendar!");'; 
        echo 'window.location.href = "https://sameet.heroku.com";';
        echo '</script>';

?>        
      