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
            
**But it also needs a valid `token` and `token secret`**, these must be obtained via a hand shake. You can use the built-in handshake, or do it yourself. Once tokens are retrieved they must be set into the session using the `setSessionTokens($token, $tokenSecret)` method.

The client will then use these to sign future requests.

## OAuth Handshake

This bundle also has a built-in controller for performing the OAuth 1.0a handshake with the Meetup.com API. It will request the proper tokens, and store the access tokens in the session for use during that session.

Once the handshake is done it will look for a route named `meetup_redirect_url` if this is defined it will redirect to that page, otherwise to the index page.

To start the process redirect the user to the `meetup-oauth-authorize` route. It will get request tokens, redirect the user to the authorization url and then get proper access tokens if authorized.

## Injecting into other services

In order to inject the API clients (Key and OAuth) into other services there are two services defined that make use of Symfony's factory method options in the service definitions. These use the available factory methods to define new services easily usable in other services, they are:

* `dms_meetup_api.key_client`
* `dms_meetup_api.oauth_client`