<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
	
.button {
  display: inline-block;
  border-radius: 8px;
  background-color: #008CBA;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 22px;
  padding: 5px 12px;
  width: 175px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}

</style>
<?php
require __DIR__ . '/vendor/autoload.php';

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient()
{
    $gClient = new Google_Client();
    $gClient->setApplicationName('Student Association Meetings');
    $gClient->setScopes(Google_Service_Calendar::CALENDAR);
    $gClient->setAuthConfig('client_secret.json');
    $gClient->setAccessType('offline');
    $gClient->setPrompt('select_account consent');

    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    $userTokenPath = 'token.json';
    if (file_exists($userTokenPath)) {
        $appToken = json_decode(file_get_contents($userTokenPath), true);
        $gClient->setAccessToken($appToken);
    }

    // If there is no previous token or it's expired.
    if ($gClient->isAccessTokenExpired()) {
        // Refresh the token if possible, else fetch a new one.
        if ($gClient->getRefreshToken()) {
            $gClient->fetchAccessTokenWithRefreshToken($gClient->getRefreshToken());
        } else {
            // Request authorization from the user.
            if(!browserCredentials()) {
                $authUrl = $gClient->createAuthUrl();
                return "<p style='color:white;'><b>Sign In with Google to use this service!</b></p><a href='$authUrl'><button class='button' style='vertical-align:middle'><i class='fa fa-google' style='padding:0px 20px 5px 5px'></i><span> Sign In </span></button></a>";
            }
            $authCode = $_GET['code'];
            
            // Exchange authorization code for an access token.
            $appToken = $gClient->fetchAccessTokenWithAuthCode($authCode);
            $gClient->setAccessToken($appToken);
            
            // Check to see if there was an error.
            if (array_key_exists('error', $appToken)) {
                throw new Exception(join(', ', $appToken));
            }
        }
        // Save the token to a file.
        if (!file_exists(dirname($userTokenPath))) {
            mkdir(dirname($userTokenPath), 0700, true);
        }
        file_put_contents($userTokenPath, json_encode($gClient->getAccessToken()));
    }
    return $gClient;
}

//check browser url has the auth code
function browserCredentials() {
    if(isset($_GET['code'])) return true;

    return false;
}

//get authorized API client
$gClient = getClient();

if(! is_a ($gClient, "Google_Client")) {
        echo $gClient;
}
else { 
            //dispaly the content of the page
           include 'content.php'   ; 
            
    
    }

?>

