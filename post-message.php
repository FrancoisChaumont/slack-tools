<?php

namespace FC\Slack;

ini_set("display_errors", true);
ini_set("error_reporting", E_ALL);

require 'vendor/autoload.php';
require 'usage/post-message.usage.php';

try {
    // init options
    if (!isset($options[OPTION_TOKEN])) { throw new \Exception("Missing option <token>!"); }
    else { $appToken = $options[OPTION_TOKEN]; }
    if (!isset($options[OPTION_CHANNEL])) { throw new \Exception("Missing option <channel>!"); }
    else { $channel = $options[OPTION_CHANNEL]; }
    if (!isset($options[OPTION_MESSAGE])) { throw new \Exception("Missing option <message>!"); }
    else { $message = $options[OPTION_MESSAGE]; }

    // init Guzzle client
    $client = new \GuzzleHttp\Client();

    // init Slack App
    $slackApp = new \FC\Slack\SlackApp($appToken);

    // post message
    $r = $slackApp->postMessage($client, $channel, $message);
    if ($r === true) {
        exit(0);
    } else {
        throw new \Exception("Failed to post message: $r");
    }

} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
    exit(1);
}
