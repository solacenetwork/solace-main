## SOLACE Network

An application built on Laravel / Jetstream / Blade / Tailwind CSS. It provides tools for users and communities to work together, track things, keep in touch, and manage things in their own houses. Logged in users have access to these tools:

- SOLACE Home - manage your house with these tools
- SOLACE Garden - manage your gardens and plants.
- SOLACE Directory - a public directory of businesses
- SOLACE Library - manage and access documents locally, in the cloud and remotely.
- SOLACE Neighborhood - a private social network for local groups (geofenced)
- SOLACE Education - learning courses, videos, books, and K-12 homeschool resources

## Long Term Goals 

- In addition to the server, build clients for different platforms (e.g. Garden app on Android or Home management on laptop). Everything can be done via web browser but, there may be more specialized apps connecting to the server via API in the future. 

- Build a custom OS (based on Linux Mint Debian Edition) which would come preinstalled with it's own Laravel server and function as a client (or node) on the network. It would come preinstalled with Laravel, PHP, MySQL, etc. 

- Allow these nodes to connect to each other directly via P2P. If the Internet is available, it can use the SOLACE Network server to connect. Otherwise it defaults to local and forms a mesh network via customized WiFi routers. 

- Eventually it could be autonomous and not need the SOLACE Network server. The goal is to have the online server as a backup but be able to function without it. To bootstrap the network we need a way to connect users first.

## Environment

- Windows 10
- Visual Studio Code
- GitHub (online) and GitHub Desktop
- Powershell (no Linux/Unix commands)
- Laravel 12.15.0, Jetstream (Livewire, Teams)
- Flowbite and Flowbite icons 
- Blade UI Kit (using icons as blade components with <x-svg>)
- Herd 1.20.2 (free version) - for main Laravel app
- UniServer Zero XV (15.0.2) - for phpMyAdmin
- MySQL 8.2.0 (served by Apache and managed by phpMyAdmin)
- phpMyAdmin (served on Apache via UniServerZ). 

The free version of Herd doesn't support database management. So, I use phpMyAdmin to view and modify the MySQL database. I use Herd to host the Laravel app only. No db integration with Herd.

**Development URLS:**

- Main site: https://solace.test (port 443 served by Nginx and Herd)
- phpMyAdmin: http://localhost/us_opt1/index.php (port 80 served by Apache)
- MySQL: runs on default port 3306. For development on localhost, username/password are set to 'root'. 

## Developer Profile

I come from a web development background (PHP, HTML, CSS, JS) and am new to learning Laravel. This is my first big Laravel project. I use Bootstrap 5 for layout - that's why I went with Flowbite as the components align with what I am used to. I do not know Tailwind CSS or Flowbite. I'm am learning as I go. Since I'm on Windows, I can't run Linux commands. All cmd prompt recommendations should be for Windows powershell. I'm am developing locally on my laptop and occasionally checking code into my private GitHub repo to back it up. I also use GitHub desktop and mobile. 

## Goals
- Use default Livewire / Jetstream / Laravel methods, templates and functions. We want scaffold our app from this but don't want to break core functionality
- Try to follow best practices and Laravel guidelines when creating things (do it the Laravel way)
- Not break our currently functioning Laravel app. (This is the 3rd iteration)
- To be able to register users in the Laravel / Jetstream app so we can build out the site
- Keep existing Jetstream / Fortify / Sanctum policies and use existing code for login, forgot password, etc.

I have included code for these 2 default files as a reference. register.blade.php is not currently used in my project. The /register and /join routes both load my new Livewire component (JoinForm.php) instead:

'resources\views\auth\login.blade.php',
'resources\views\auth\register.blade.php'

## What we have done so far

- installed Laravel and Jetstream
- installed Flowbite and configured via tailwind config
- customized the routes (web.php)
- created a /test-flowbite route and page to see if Flowbite CSS is working
- customized the database tables 
- created a Livewire component (JoinForm.php)
- created logic to manage a multipart form
- stored data in sessions to handle page reloads
- created a middleware to handle session length. (60 min for non-logged in users and 24 hours for logged in users)
- used Livewire to validate client side instead of Javascript.
- save all values user submits to array $form. on the last step we will write this to the db using Laravel / Jetstream method. For now we are just collecting and displaying it.
- Fixed the form so that user can advance through all 6 steps. 
- Fixed bugs and got step 7 (display data) working properly. 
- generate API key on Google Cloud site
- set up Laravel/Jetstream to use Google Maps API (.env and config/services.php)
- Started working on Google Maps API app for step4 and step5
- in JoinForm.php we added a var named $showFormData. If true, it displays output of resources\views\partials\form-data.blade.php otherwise, it shows resources\views\partials\success.blade.php. 
- step 4 map uses address info from step 3 to geolocate the address and get latitude/longitude
- step 5 form updated to include "Label" field (nlabel) using <x-input> tags
- On step 7, we have the output of $form showing the array like this:

Form Data Preview

Array
(
    [email] => hahanospam@gmail.com
    [password] => testtest
    [password_confirmation] => testtest
    [account_type] => single
    [first_name] => Joe
    [last_name] => Tester
    [address1] => 123 Main St.
    [address2] => Apt. 4
    [city] => Anywhere
    [state] => CA
    [zip] => 12345
    [phone] => 1232123456
    [dob] => 1985-02-12
    [newsletter] => 
    [is_minor] => 
    [hid] => 
    [nid] => 
    [nlabel] => SOLACE One
    [geometry] => POLYGON((0 0, 1 1, 1 0, 0 0))
    [nickname] => Joe Tester
    [avatar] => 
    [terms] => 1
    [lat] => 37.7749
    [lng] => -122.4194
)

We are using resources\views\partials\form-data.blade.php for Dev Use. We'll remove this later and just have it display success.blade.php after the user successfully submits the form. I'll keep the form output code for debugging purposes in the future. We'll set value to false so it always shows success.blade.php instead.

## What we are currently working on
 
- Getting Google Map component working in steps 4 and 5.
- Map component should accept lat/lng and full address as inputs to display
- We should be smart about Google API lookups and only do once and store in $form to avoid Google Cloud overage fees (e.g. doing hundreds of lookups and not saving it)

## What we need to do next
- Troubleshoot errors and styling issues on our Livewire component registration form (steps 4 and 5)


## Known issues

On steps 4 and 5 (step4.blade.php and step5.blade.php) I am having an issue with the loading of the Google Map. The expected behavior is that the loading spinner shows until the map is loaded. Then, it hides the spinner and shows the map. Currently nothing is displayed.

Step 4 gets the address from step 3 (address1, address2, city, state, zip) and does a lookup on the Google Maps API. It then gets longitude/latitude from Google, saves them to $form, and shows them on the 



Last updated: 5/31/25 at 8:45 PM.