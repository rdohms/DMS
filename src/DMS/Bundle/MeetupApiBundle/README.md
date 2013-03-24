# DMSMeetupApiBundle

This bundle leverages Meetup API Client distributed in [rdohms/meetup-api-client](https://github.com/rdohms/meetup-api-client). It provides instances of clients to manipulate the Meetup.com API.

This bundle is part of the DMS Library, and distributed as a sub-directory split, issues should be reported at the [DMS Repository](https://github.com/rdohms/DMS).

## Installing

Add extension to your composer file:

    {
        "require": {
            "dms/meetup-api-bundle": "~1.*"
        }
    }

or use composer's require command

    composer require dms/meetup-api-bundle:~1.*
    
Load the bundle in your AppKernel

    <?php
    // app/AppKernel.php

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new DMS\Bundle\MeetupApiBundle\DMSMeetupApiBundle(),
        );
    }
    
## Usage

Each version of the client needs different configuration, but they can be used side-by-side

### Key Auth Client

This client uses a simple signing based on a API key, configuring it is just a matter for defining the key.

    dms_meetup_api:
        client:
            key:                  <api-key>
        
### OAuth Client

The OAuth client requires a bit more information to run. It has two parts, the consumer key and secret which can be set via config:

    dms_meetup_api:
        client:
            consumer_key:         <key>
            consumer_secret:      <secret>
            
**But it also needs a valid `token` and `token secret`**, these must be obtained via a hand shake not implemented here. After this is done the token data must be set into the session as `meetup_token` and `meetup_token_secret`.

The client will then have all of this injected when its instantiated.