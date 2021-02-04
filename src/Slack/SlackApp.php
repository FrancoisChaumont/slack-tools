<?php

namespace FC\Slack;

class SlackApp
{
    /** @var string POST_MESSAGE_URL URL where to send message to */
    private const SLACK_API_URL = 'https://slack.com/api';
    private const POST_MESSAGE_URL = self::SLACK_API_URL . '/chat.postMessage';
    private const DELETE_MESSAGE_URL = self::SLACK_API_URL . '/chat.delete';

    /** @var string $appToken Token of the interacting app */
    private string $appToken;

    /**
     * Constructor
     *
     * @param string $appToken Token of the interacting app
     */
    public function __construct(string $appToken)
    {
        $this->appToken = $appToken;
    }

    /**
     * Post a message to a channel
     *
     * @param \GuzzleHttp\Client $client Guzzle client to handle HTTP requests
     * @param string $channelId ID of the channel to post the message to
     * @param string $text Message to be posted
     * @return bool|string true on success, HTTP response code + reason on failure
     */
    public function postMessage(\GuzzleHttp\Client $client, string $channelId, string $text)
    {
        $message = <<< EOS
        {
            "channel": "$channelId",
            "text": "$text"
        }
        EOS;

        $headers = [
            'Authorization' => 'Bearer ' . $this->appToken,
            'Content-type' => 'application/json'
        ];

        $response = $client->request(
            'POST',
            self::POST_MESSAGE_URL, [
                'headers' => $headers,
                'json' => json_decode($message, true)
            ]
        );

        $code = $response->getStatusCode(); // 200
        $reason = $response->getReasonPhrase(); // OK

        if ($code == 200) { return true; }
        else { return $code . " - " . $reason; }
    }

    /**
     * Delete a message from a channel
     *
     * @param \GuzzleHttp\Client $client Guzzle client to handle HTTP requests
     * @param string $channelId ID of the channel to delete the message from
     * @param string $timestamp Timestamp of the message to delete from the channel
     * @return bool|string true on success, HTTP response code + reason on failure
     */
    public function deleteMessage(\GuzzleHttp\Client $client, string $channelId, string $messageTimestamp)
    {
        $message = <<< EOS
        {
            "channel": "$channelId",
            "ts": "$messageTimestamp"
        }
        EOS;

        $headers = [
            'Authorization' => 'Bearer ' . $this->appToken,
            'Content-type' => 'application/json'
        ];

        $response = $client->request(
            'POST',
            self::DELETE_MESSAGE_URL, [
                'headers' => $headers,
                'json' => json_decode($message, true)
            ]
        );

        $code = $response->getStatusCode(); // 200
        $reason = $response->getReasonPhrase(); // OK

        if ($code == 200) { return true; }
        else { return $code . " - " . $reason; }
    }
}

