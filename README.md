## SOLACE Network

An application built on Laravel / Jetstream / Blade / Tailwind. It provides tools for users and communities to work together, track things, keep in touch, and manage things in their own houses. Logged in users have access to these tools:

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
- Powershell (no Linux/Unix commands)
- Laravel 12.15.0, Jetstream (Livewire, Teams)
- Flowbite and Flowbite icons 
- Blade UI Kit (use icons as blade components)
- Herd 1.20.0 (free version) 
- UniServer Zero XV (15.0.2)
- MySQL 8.2.0 (served by UniServerZ)
- phpMyAdmin (served on apache via UniServerZ). The free version of Herd doesn't support database management. So, I use phpMyAdmin to view and modify MySQL.

Development URLS:
- Main site: https://solace.test (port 443 from Herd)
- phpMyAdmin: http://localhost/us_opt1/index.php (port 80 from Apache)

## Developer Profile

I come from a web development background (PHP, HTML, CSS, JS) and am new to learning Laravel. This is my first big Laravel project. I use Bootstrap 5 for layout - that's why I went with Flowbite as the components align with what I am used to. I do not know Tailwind CSS or Flowbite. I'm am learning as I go. Since I'm on Windows, I can't run Linux commands. All cmd prompt recommendations should be for Windows powershell. I'm am developing locally on my laptop and occasionally checking code into my private GitHub repo to back it up. I also use GitHub desktop and mobile. 

## Goals
- Use default Livewire / Jetstream / Laravel methods, templates and functions. We want scaffold our app from this but don't want to break core functionality
- Try to follow best practices and Laravel guidelines when creating things (do it the Laravel way)
- Not break our currently functioning Laravel app. (This is the 3rd iteration)
- To be able to register users in the Laravel / Jetstream app so we can build out the site
- Keep existing Jetstream / Fortify / Sanctum policies and use existing code for login, forgot password, etc.

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

## What we are currently working on
- We created a middleware way to handle session length () but, we haven't tested it yet. 
- We are at the point where we can add users to the db via tinker by doing this:

<pre>
User::create(['first_name' => 'Test', 'last_name' => 'User', 'email' => 'test@example.com', 'password' => bcrypt('password123'), 'account_type' => 'individual', 'terms' => true, 'newsletter' => false, 'is_minor' => false]);
</pre>

- Trying to get steps 1 - 3 of the registration form working. Then, continue with steps 4-7. 
- Primary focus is getting new Livewire component for registration finished.
- Currently focused on getting the styling right on the individual steps.

## What we need to do next
- Test the middleware we created at: app\Http\Responses\CustomLoginResponse.php
- Users who are not logged in should have a secure session which lasts 60 minutes.
- Users who are logged in should have a secure session which lasts 24 hours.
- Work on steps 1 - 3 to make sure layout, content, and functionality is there.

## Known issues

None.

Last updated: 5/26/25