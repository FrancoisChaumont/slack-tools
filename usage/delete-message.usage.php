<?php

// retrieve the name of the file that includes this usage file
define('INCLUDED_FILE', basename(get_included_files()[0]));

// modify the description here below
$whatItDoes = <<<EOS
Delete message from channel

Exit code:
    0 - message deleted successfully to channel
    1 - message deletion failed
EOS;

$usageIntro = "What it does:\n\n    %s\n\nUsage: php %s %s\n";

define('USAGE', sprintf($usageIntro, $whatItDoes, INCLUDED_FILE, sprintf(<<<EOS
[options]

Options:
    -h/--help                               Show this help message and exit

    -t/--token                              [REQUIRED] Slack app token
    -c/--channel                            [REQUIRED] Slack channel ID
    -d/--timestamp                          [REQUIRED] Timestamp of the message posted on the channel

    php %1\$s 

Example:
    php %1\$s \
        -t xoxb-123456 \
        -c ABC123DEF45 \
        -d 1405894322.002768
EOS, INCLUDED_FILE)));

$shortOpts = 't:c:d:h';
$longOpts = [
    'token:',
    'channel:',
    'timestamp:',
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
define('OPTION_TIMESTAMP', isset($options['d']) ? 'd' : 'timestamp');
