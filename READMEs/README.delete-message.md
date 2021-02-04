# Delete a message from a Slack channel

## Introduction

**Deleting a message**       
See [chat.delete](https://api.slack.com/methods/chat.delete) documentation.

**Find channel ID**     
In the `Slack desktop app`, right-click on the channel and select copy link. The last part of the URL is the ID.

In the `browser version`, navigate to the channel and check the URL. The last part of the URL is the ID.

**Find message timestamp**      
In the `Slack desktop app`, right-click on the message timestamp and select copy link.        
The last part of the URL is the timestamp and the last 6 numbers must be preceeded by a [ `.` ].        
e.g.: `1612392726003500` -> `1612392726.003500`
