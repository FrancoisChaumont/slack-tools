<?php

// retrieve the name of the file that includes this usage file
define('INCLUDED_FILE', basename(get_included_files()[0]));

// modify the description here below
$whatItDoes = <<<EOS
Post message to channel

Exit code:
    0 - message posted successfully to channel
    1 - message posting failed
EOS;

$usageIntro = "What it does:\n\n    %s\n\nUsage: php %s %s\n";

define('USAGE', sprintf($usageIntro, $whatItDoes, INCLUDED_FILE, sprintf(<<<EOS
[options]

Options:
    -h/--help                               Show this help message and exit

    -t/--token                              [REQUIRED] Slack app token
    -c/--channel                            [REQUIRED] Slack channel ID
    -m/--message                            [REQUIRED] Message to post to channel

    php %1\$s 

Example:
    php %1\$s \
        -t xoxb-123456 \
        -c ABC123DEF45 \
        -m "Message to be posted to channel"
EOS, INCLUDED_FILE)));

$shortOpts = 't:c:m:h';
$longOpts = [
    'token:',
    'channel:',
    'message:',
    'help'
];

// set options
$options = getopt($shortOpts, $longOpts);
if (sizeof($options) == 0 || isset($options['h']) || isset($options['help'])) {
    print USAGE;
    exit;
}

define('OPTION_TOKEN', isset($options['t']) ? 't' : 'token');
define('OPTION_CHANNEL', isset($options['c']) ? 'c' : 'channel');
define('OPTION_MESSAGE', isset($options['m']) ? 'm' : 'message');
