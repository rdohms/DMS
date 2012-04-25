# DMS Launcher Bundle

This bundle provides a Launcher placeholder for future websites.

## Install

### 1. Import libraries

Option A) Use the vendors script.

Add this to the `deps` file.

	[DMSLauncherBundle]
	    git=https://github.com/rdohms/DMSLauncherBundle.git
	    target=/bundles/DMS/Bundle/LauncherBundle

Option B) Use submodules

	git submodule add https://github.com/rdohms/DMSLauncherBundle.git /bundles/DMS/Bundle/LauncherBundle
    git submodule update --init

### 2. Prepare the autoloader

Add this to `autoload.php`

	'DMS' => __DIR__.'/../src',

### 3. Enable Bundle

Add this to your `AppKernel.php`

	new DMS\Bundle\LauncherBundle\DMSLauncherBundle(),

### 4. Configure

Edit configuration to specify your application's url and twitter account, or a custom css.

    dms_bundle:
        site_url: http://mywebsite/
        twitter_account: rdohms
        stylesheet: /my/custom/stylesheet.css

Limit access to `/admin` urls in your application' firewall.

## Usage

Once you enable the Bundle it will highjack you root url and display a lauch page. This page will have basic information
you chosse to display about your website. It will also provide a form where the user will be able to reserve their
username or register an email to get newsletter updates.

Once registered the user will be awarded a token and will have the option of sharing a link to the website with his
token, which will then count referrals for him.

Once you are ready to "flip the switch" the dms_launcher.export Service will provide a list of all registered users so
you can import them to the new system. You can also follow registrations on the Admin page

## ToDo

- Better customization possibilities
- Count visitation stats
- Better reports
- Partial imports and dual function for closed beta (keep launch but import some users)
- Allow registered user to view his "done" page with details again
- Provide Newsletter functions