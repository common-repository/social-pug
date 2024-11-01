=== Hubbub Lite - Fast, Reliable Social Sharing Buttons ===
Contributors: eatingrules, cdevroe, nerdpressteam, iova.mihai
Tags: social share, social sharing, social media, social network, social buttons
Requires at least: 5.3
Tested up to: 6.7
Requires PHP: 7.2.24
Stable tag: 1.34.7
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add Pinterest, Facebook, Twitter/X social network sharing buttons with a Floating Sidebar, Sticky Bar, Inline Buttons, Shortcodes, and more.

== Description ==

New: [NerdPress](https://www.nerdpress.net/) has acquired Grow Social from Mediavine. [Read our blog post](https://www.nerdpress.net/announcing-hubbub/)

**What can Hubbub Lite do for you?**

Hubbub Lite, formerly Grow Social by Mediavine, is one of the easiest to use social sharing button plugins available that adds personalized sharing buttons to your website for a wide variety of social networking platforms. It is simple to add sharing buttons to multiple locations on your webpages using Hubbub Lite's Floating Sidebar and Inline Content Bar tools. Hubbub Lite comes with four of the biggest social media platforms: Facebook, Twitter / X, Pinterest and LinkedIn. [Hubbub Pro](https://morehubbub.com/) adds an additional 17+ social networks and many additional features including additional toolbars, a ton of options for sharing to Pinterest, and more.

= Lite Features =
* **Share Buttons Above or Below Your Content** - Place the share buttons above or below your content (or both!)
* **Floating Sidebar Share Buttons** - Place the share buttons on the left or right and have them follow the user as they scroll up and down your webpage
* **Social Share Counts and Total Share Counts** - Display share counts for all four included social media networks
* **Editable Button Labels** - Edit the labels that appear in the share buttons to maximize your engagement
* **Retina Ready Share Icons** - Hubbub uses SVGs to display the sharpest social media icons on any screen size

= Pro Features =
* **17+ Additional Social Media Networks (including Threads)** - Reach more people by adding any of the following social share networks Flipboard, Threads, Reddit, Yummly, VK, Tumblr, WhatsApp, Buffer, Telegram, Pocket, and Email
* **Social Media Open Graph Tags** - Customize the social media preview title, description and images that your users share on social media using industry standard Open Graph tags which work across all social networks and chat services.
* **Social Share Counts** - Display the posts social share count **( including Twitter )** to provide social media proof and increase your website's credibility.
* **Mobile Sticky Footer Share Buttons** - Place the share buttons in a sticky bar that stays at the bottom of a user's mobile device
* **Pop-Up Share Buttons** - Trigger a pop-up with the sharing buttons when a user triggers an action
* **Custom Button Colors and Hover Colors** - Personalize the color of your share buttons to match your website's design
* **Shortcode for Share Buttons** - Place the buttons anywhere in your template files or the body of your content with the [hubbub_share] shortcode
* **Link Shortening through Bitly** - Hide long URL's behind their shorter version with Bitly integration
* **Google Analytics UTM tracking** - Track the source of your incoming traffic with the help of the Google Analytics UTM parameters
* **Follow Buttons Widget** - Place follow buttons anywhere on your website to allow users to follow your social media profiles on: Facebook, Twitter, Pinterest, LinkedIn, Flipboard, Threads, Reddit, Instagram, YouTube, Vimeo, SoundCloud, Twitch, Yummly and Behance. Use the [hubbub_follow] shortcode
* **Sharable Quotes ( Click to Tweet ) Feature** - Let your readers easily share a custom tweet with just one click
* **Top Shared Posts Widget** - Want to showcase your most social shared articles? No problem. You can use this widget in any widget area to add your top shared posts
* **Import / Export Settings** - Move all the settings from one website to another with just a few clicks

= Website and Documentation =

* [Visit morehubbub.com/](https://morehubbub.com/)
* [Hubbub Support docs](https://morehubbub.com/docs/)

== Installation ==

1. Upload the social-pug folder to the '/wp-content/plugins/' directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Choose Hubbub in your WordPress Admin menu and turn on each location where you wish the buttons to appear
1. Under each tool (e.g. Floating Sidebar) you can choose individual settings
1. Need help? We have [support docs](https://morehubbub.com/docs/) to help you


== Frequently Asked Questions ==

= What social sharing buttons are supported? =

We currently support Facebook, Twitter, Pinterest and LinkedIn as social sharing buttons in Hubbub Lite. Hubbub Pro adds many more social media networks.

= Can I customize the social information that is being shared on social media? =

Hubbub Lite will use the post's title and featured image to populate what is being shared on social platforms. Hubbub Pro gives publishers full control of the exact text and images that are shared. Please [visit our website](https://morehubbub.com/) and check out Hubbub Pro.

= Will your social sharing plugin slow down my website? =

No. Both Hubbub Lite and Pro are lightweight and built with efficiency in mind. And we will continue to work hard at making Hubbub speedy and reliable.

= Can I place the social share buttons on custom post types? =

Yes! You can place social share buttons on any custom post type that your WordPress installation has registered.

= Can I import my data from other social sharing plugins? =

Hubbub Pro has additional add-ons for migrating data from a few popular alternative plugins. Please see our website for the latest plugins we support.


== Screenshots ==
1. Inline-Content social sharing buttons output
2. Floating Sidebar social share buttons output
3. Floating Sidebar social share buttons configuration page
4. Before and After Content social sharing buttons configuration page


== Changelog ==
This changelog is for Hubbub Lite. Here is [the changelog for Hubbub Pro](https://morehubbub.com/changelog/).

= 1.34.7 =
* October 7, 2024
* Fix: An issue with displaying individual share counts when setting a minumum.

= 1.34.6 = 
* October 2, 2024
* Fix: An issue with total share counts.

= 1.34.4 =
* October 2, 2024
* Fix: Possible XSS vulnerability in custom network labels. Thanks to Artykom K. for responsible disclosure.
* Removed third-party plugin updater.

= 1.34.3 =
* July 16, 2024
* Improvement: Better compatibility with the Feast plugin.
* New Admin Notice: [Save This](https://morehubbub.com/save-this/) launches! A brand-new website growth tool has been added to Hubbub Pro. Learn more at [https://morehubbub.com/save-this/](https://morehubbub.com/save-this/)

= 1.34.2 =
* May 28, 2024
* Fix: Several links to support docs in the header of each Hubbub settings page.
* Other updates and improvements.

= 1.34.1 = 
* May 14, 2024
* Fix: Fixed an issue with some sharing buttons not working properly.

= 1.34.0 =
* May 14, 2024
* New: An option to show/hide button labels on desktop and mobile on the Inline Content Tool. Also available as an argument via the [hubbub_share] shortcode.
* Improvement: Better compatibility with WP Rocket.
* Improvement: Better compatibility with Cloudflare's Rocket Loader.
* Fix: Clearing WP Rocket's cache clearing sometimes caused an error on hosts with PHP Warnings turned on.
* Fix: Better compatibility with PHP 8.x.
* Fix: Hubbub no longer includes a SPAN if the sharing tools are inactive or not enabled for the current post type.
* Fix: Fixed an issue with share counts saving properly. Thanks Daniela!

= 1.33.2 =
* March 27, 2024
* Improvement: Modernized how we store metadata which removed a potential third-party POP Chain vulnerability. Thanks to Wordfence for working with us.

= 1.33.1 =
* March 6, 2024
* Fix: Fixed an issue where Open Graph tags would be included on password protected posts prior to viewer authentication as reported by WPScan.
* Removed Google Fonts.

= 1.33.0 =
* January 31, 2024
* New: Hubbub is quieter than ever. Admin Notices no longer appear on all WordPress Admin pages.
* New: Hubbub menu badge. The Hubbub menu badge will let you know if you have any notifications that need attention.
* Removed "formerly Grow Social" from the plugin's name and title bar. Shoutout to our friends at Mediavine!
* Minor improvements to user interface and messaging.

= 1.32.0 =
* January 4, 2024
* New: Twitter renamed to X and added X branding.  (Want to keep the old-school Twitter Icons? [Upgrade to Hubbub Pro](https://morehubbub.com/)!)
* Fix: Fixed a potential XSS vulnerability as first reported to WPScan.
* New: Hubbub version information now included in a meta tag to help with customer support.

= 1.31.1 =
* December 20, 2023
* New: Hello Hubbub Lite blue! Hubbub Lite now has its own distinct style, to help distinguish it from Hubbub Pro.
* Fix: Sharing by email now puts the page's title as the Subject line and the page's URL as the body of the message.
* Fix: Share count options label is now more clear.
* Fix: Filenames for JavaScript and CSS files within the plugin are now more cache-friendly. More updates for cache reliability coming soon!

Important: If you have odd issues after updating, please clear all caches for your site and in your personal web browser. If you use WP Rocket's "Remove Unused CSS" feature, go to WP Rocket > Clear Unused CSS and then wait a few minutes while it rebuilds your files. If you aren't sure what caching you use, please contact your web host or post in [the support forums](https://wordpress.org/support/plugin/social-pug/).

= 1.30.3 =
* December 14, 2023
* Fix: Share counts will now display by network as well as total numbers
* Fix: Individual share counts increment properly again

= 1.30.2 =
* December 12, 2023
* Fix: Share count settings restored for floating sidebar and inline content tools.

= 1.30.1 =
* December 11, 2023
* Fix: Fixed a security vulnerability. Thanks to Abdi Pranata for reporting it.
* New: Technical requirements have increased to at least WordPress 5.3.

= 1.30.0 =
* New: Rebranded from Grow Social to Hubbub (for more information [read our blog post](https://www.nerdpress.net/announcing-hubbub/))

= 1.20.3 =
* MISC: Update the tooltip content for the Grow button in the Floating Sidebar page's Select Networks settings.
* MISC: Update the Grow sidebar button logo SVG paths.
* COSMETIC: Update the default color of the Grow sidebar buttons.

= 1.20.0 =
* Add Inline Critical CSS to Inline Content Tool to reduce Layout Shift when CSS loading deferred
* Add Facebook share tooltip to explain why shares do not appear when under 100
* Add post and category IDs to Grow data
* Add status REST API endpoint
* Add the Grow saved class to the Trellis critical CSS bypass
* Fix inline content buttons showing up in WooCommerce product pages
* Fix outdated doc links in dashboard
* Fix inline content buttons not showing up before WPRM Jump to Recipe
* Fix Grow bookmark button not saving state
* Fix checking requirements on older WordPress versions causing fatal error
* Remove share counts (added back in Hubbub Lite 1.30.2)

= 1.19.2 =
* FEATURE: Add notice of Share Count Removal
* FIX: Images prevented from being pinned
* FEATURE: Add more details to upgrade Call to Action

= 1.19.1 =
* FIX: Error when old networks present in tools

= 1.19.0 =
* FEATURE: New setting to allow a second render to fix issues with missing inline content buttons on theme conflicts
* FEATURE: Added new hook to allow plugin authors to exclude their custom post-types from being scraped by Facebook's API
* FEATURE: Add setting to hide Floating Sidebar when it reaches a certain element, configurable in the settings.
* FEATURE: Switches all users to optimized javascript with ability to roll back to jQuery until July 2021
* FEATURE: Add feature flag capabilities for beta program.
* FEATURE: Update Facebook Graph API Version
* FEATURE: Add Settings API
* FEATURE: Grow.me now available as a network for sharing
* FIX: Added wprm_recipe to post-type exclusion array to prevent calls to Facebook's API
* FIX: Fixes issue where missing Facebook token would cause 400 errors when updating share counts
* FIX: Fixes issue with broken Inline Content buttons on WooCommerce products
* FIX: Fixed an issue where individual share-counts were not displaying when the Minimum Share Count field was filled out.
* FIX: Trigger attributes for Floating Sidebar
* FIX: Hide Grow sharing elements from printers
* FIX: Resolved an issue where share count numbers were overflowing buttons on certain style variations.
* FIX: Resolve issue on some Trellis sites where mobile users needed to click twice on links to go to the target page.
* FIX: Resolves an issue where old networks could cause fatal errors during share count retrieval.
* COSMETIC: Remove Icon Font and use inline SVG for admin Icons
* COSMETIC: Fix Floating Sidebar Icon alignment issue
* COSMETIC: Fix gap between outline and icon on some button styles.
* ENHANCE: Add a notification for new users to check out setup documentation.

= 1.18.2 =
* FIX: Fixes issue where Pinterest shares were not being calculated
* FIX: Grow Social now checks if Facebook access token is invalid when used and marks it as expired
* FIX: Prevents PHP notices on unique server configurations
* FIX: Remove unneeded settings meta blocks

= 1.18.1 =
* FIX: Issues were some tools would not be active after upgrading.
* FIX: Prevent unnecessary calls to `wp_remote_get()` that were causing timeouts and high CPU spikes

= 1.8.0 =
* FEATURE: Recommended PHP and WordPress versions have been updated to PHP 7.4 and WordPress 5.2
* FEATURE: Add button styles and custom colors to share buttons
* FEATURE: Rewrite button markup to be more accessible
* FEATURE: Stronger indication of visual focus on buttons
* FEATURE: New lighter weight icon animation
* FEATURE: Add ability to set minimum global and individual share counts
* FEATURE: Switch to non-jQuery javascript to improve site performance
* FEATURE: Use inline SVG for icons instead of icon font, will improve load times and page speed scores
* FEATURE: Add integration with the Mediavine Trellis Theme framework
* FEATURE: Switched the Facebook App transient to use an option instead for better compatibility with some hosts.
* FEATURE: Add a body class to indicate to themes that the sidebar will show up on Mobile
* FEATURE: Don't load styles if Grow elements don't exist on page
* FIX: Better spacing for the inline links
* FIX: Twitter character count should be correct and accommodate for url and username
* FIX: Twitter links should open in new window
* FIX: Added title attribute to share and follow links for accessibility 
* FIX: Fixed an error in share count rounding that would cause too many numbers after the decimal point
* FIX: Sanitize Open Graph and Twitter tags on titles and descriptions
* FIX: Resolved an alignment issue with some themes when single column buttons are used
* FIX: When labels are not shown, ensure that the icons with and without counts line up with each other on 1, 2, and 3 column layouts
* FIX: Add async and noptimize to JavaScript assets to prevent compatibility issues with WP Rocket, Autopmize and other optimization plugins.
* FIX: Ensure Yoast OG Tags get removed if Grow tags are being used
* FIX: Ensure optimization plugins don't interfere with front end data

= 1.7.0 =
* FEATURE: Change name and branding to Grow Social by Mediavine
* FEATURE: Optimize Javascript
* FEATURE: Better accessibility for share buttons
* FIX: Ensure text remains visible during icon webfont load
* FIX: Better spacing for the inline links
* FIX: Total Shares won't wrap lines

= 1.6.2 =
* Fixed: Issue with Facebook social share counts not being pulled properly

= 1.6.1 =
* New: Added Facebook authentication to be able to pull Facebook social share counts
* New: Added sixth column for Inline Content buttons
* Fixed: Issue with ampersand breaking the email button

= 1.6.0 =
* New: Added Email and Print social sharing buttons
* New: Redesigned the admin interface
* New: Added button labels to the floating sidebar social sharing tool
* Misc: Removed Google+ social sharing button

= 1.5.3 =
* Fixed: Bullet point list item issues for social share buttons with certain themes

= 1.5.2 =
* Misc: Code clean-up and compatibility with latest WordPress

= 1.5.1 =
* New: Removed support for OpenShareCount and added support for TwitCount

= 1.5.0 =
* New: Add a Twitter handle to the tweet generated when clicking on the Twitter social sharing button.
* Fixed: Issue with inline social share button labels being added to Yoast meta descriptions.

= 1.4.9 =
* New: Removed support for NewShareCounts in favor of support for OpenShareCount to retrieve Twitter social share counts.

= 1.4.8 =
* Misc: Small admin user interface improvements to make the plugin more user friendly.

= 1.4.7 =
* New: Added social sharing buttons icon animation.

= 1.4.6 =
* New: Added support for the 5th column in the Inline Content Social Sharing tool.
* New: Added feedback form on plugin deactivation.

= 1.4.5 =
* New: Added social media share count statistics meta-box in admin post edit screen.
* Fixed: Issue with Facebook API not pulling social share counts.

= 1.4.4 =
* Misc: Modified the way social share counts are being pulled to improve performance.
* Misc: Added feedback form for admin users.
* Misc: Updated Facebook API version used by the plugin.

= 1.4.3 =
* Fixed: Issue with Twitter opening two pop-up share windows when Twitter's script is added to the page.

= 1.4.2 =
* Misc: Added translation support for strings that were missing it.

= 1.4.1 =
* Misc: Removed Google+ social share count support, due to Google removing it also.

= 1.4.0 =
* Misc: New design for social media buttons labels fields in admin panel to make them more visible

= 1.3.9 =
* New: Added LinkedIn button as a social sharing option
* Misc: Stylised the total social sharing counts for the inline content buttons

= 1.3.8 =
* Fixed: Display issues of the social sharing buttons on different themes
* Misc: Improved accessibility of the admin interface

= 1.3.7 =
* Misc: Code clean-up and small usability improvements in the admin area

= 1.3.6 =
* Misc: Added support for Twitter summary card with large image

= 1.3.5 =
* New: Added option to set a custom value for the mobile device screen width in order to display or hide the social media share buttons
* Misc: Updated the social media icon font

= 1.3.4 =
* New: Added Facebook App Secret field in the settings page in order to unlock Facebook's default limitations when trying to grab the share counts for a post

= 1.3.3 =
* New: Added Facebook App ID field in the settings page in order for posts to pass Facebook's App ID validation

= 1.3.2 =
* Fixed: Performed a security audit and fixed security issues

= 1.3.1 =
* Fixed: Fatal error on some websites.

= 1.3.0 =
* New: Social media share count values are pulled asynchronous for each post after the post loads
* Misc: Refactored social media share system

= 1.2.6 =
* Fixed: XSS vulnerability in plugin settings pages

= 1.2.5 =
* Misc: Small admin interface changes for improved user experience

= 1.2.4 =
* Misc: Added rel="nofollow" to all share buttons

= 1.2.3 =
* Misc: Updated the Facebook social share counts grabber, due to Facebook's recent changes

= 1.2.2 =
* Fixed: Mozilla Firefox users can now change the text labels of the social media buttons for the Inline Content share tool

= 1.2.1 =
* New: Added WooCommerce support for Inline Content buttons before and after the product's short description

= 1.2.0 =
* Misc: Code clean-up

= 1.1.9 =
* New: Share Text option for the Inline Content share buttons
* Misc: Under the hood improvements and refactoring

= 1.1.8 =
* New: Added Twitter tweet counts with the help of http://newsharecounts.com/

= 1.1.7 =
* Fixed: Bug that caused issues in the WordPress admin page in Safari browser
* Fixed: Issues with the Pinterest button on webpages served through HTTPS

= 1.1.6 =
* Misc: New optimised icon font for the icons, that is smaller in size

= 1.1.5 =
* New: Settings page with option to disable the Open Graph tags printed by Grow Social by Mediavine

= 1.1.4 =
* Misc: Code clean up and minor performance improvements

= 1.1.3 =
* New: New bigger Google+ icon

= 1.1.2 =
* Fixed: Needed minor CSS fixes

= 1.1.1 =
* Fixed: PHP notice when outputting the meta tags

= 1.1.0 =
* New: Redesigned the plugin's admin dashboard
* Misc: Minor performance improvements

= 1.0.4 =
* Fixed: Fetching Google+ share counts resulted in PHP warnings and counts were not fetched

= 1.0.3 =
* Fixed: CSS issue where buttons without labels and rounded corners did not get displayed correctly

= 1.0.2 =
* Fixed: Removed un-dismissable admin notification
* Misc: Changed textdomain from "socialpug" to "social-pug" to match the one on WordPress.org

= 1.0.1 =
* Fixed: Share window now opens in pop-up
* Fixed: Small bug that showed the buttons on posts when no post types where selected

= 1.0.0 =

* Initial release.

== Upgrade Notice ==

= 1.33.1 =
Versions of Hubbub Lite greater than 1.30.0 include important bug fixes. Please keep Hubbub Lite up-to-date.
