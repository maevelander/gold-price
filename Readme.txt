=== Gold Price ===
Contributors: EnigmaWeb
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=CEJ9HFWJ94BG4
Tags: Gold price, commodities, gold, silver, gold widget, gold price live, live gold price
Requires at least: 3.1
Tested up to: 4.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Gold Price - simple, nicely designed commodities price chart.

== Description ==

Use Gold Price plugin to display latest prices of Gold, Platinum, Silver and Palladium in various currencies. The prices are auto updated every 15 minutes Monday-Friday. It's easy to use, easy to customise, and stylish. Add to any page, post or widget using shortcode `[gold-price]`

= Key Features =

*	Show live price for Gold, Silver, Platinum, Palladium - or any combination of those.
*	Live prices updated every 2 mins
*	Choose currency
*	Can do grams or ounces 
*	Simple, light-weight, and looks good!
* Easy to customise with CSS
* Works in all major browsers - I9+, Opera, Safari, Firefox, Chrome

= Demo =

*	[Click here](http://demo.enigmaweb.com.au/gold-price/) for out-of-the-box demo

== Installation ==

1. Upload the `gold-price` folder to the `/wp-content/plugins/` directory
1. Activate the Gold Price plugin through the 'Plugins' menu in WordPress
1. Configure the plugin by going to the `Gold Price` tab that appears in your admin menu.
1. Add to any page using shortcode `[gold-price]`
 
== Frequently Asked Questions ==

= How can I use this in a widget? =
Just place the shortcode into a text widget. If that doesn't work (it just renders [gold-price] in text) then that means your theme isn't 'widgetized' which you can fix easily by adding 1 tiny piece of code to your theme functions.php:

`add_filter('widget_text', 'do_shortcode');`

Add this code above to fuctions.php between the <?php and ?> tags. A good place would be either at the very top or the very bottom of the file. Once you've done this you should be able to use shortcode in widgets now.

= Why does it not update the price over the weekend? =

The markets are closed on weekends and public holidays, so the prices will stay the same untill the market opens again and the feeds are updated.

= How accurate is the price data? Where is the data coming from? =

This plugin pulls XML data feeds from dgcsc.org  The price data is surprisingly accurate although obviously we offer no guarantee. Remember "live market prices" can be extremely volatile, meaning prices can change very rapidly over a short period of time. For example, the gold price may spike up 5 dollars, then return to where it was in a matter of seconds. Our feed is only updated every 15 mins, so if there's a sudden change in price or a spike then that move could be missed completely. Likewise the price may be fetched right at the top of the spike. So keep in mind that what you're seeing is a "snapshot" of the price at a particular instant in time.

= How can I customise the design? =

You can do some basic presentation adjustments via Gold Price > Settings. Beyond this, you can completely customise the design in the custom CSS box

= Where can I get support for this plugin? =

If you've tried all the obvious stuff and it's still not working please request support via the forum.

== Screenshots ==

1. An example of Gold Price plugin in action.
2. The settings screen in WP-Admin

== Changelog ==

= 1.3.1 =
* Updated feed URL filepaths to https

= 1.3 =
* Added support for more currencies

= 1.2 =
* Updated feed data source and schedule
* Minor aesthetic tweaks

= 1.1 =
* Bug fix - changed settings group name to avoid conflicts with other plugins

= 1.0 =
* Initial release

== Upgrade Notice ==

= 1.3.1 =
* Updated feed URL filepaths to https

= 1.3 =
* Added support for more currencies

= 1.2 =
* Updated feed data source and schedule
* Minor aesthetic tweaks

= 1.1 =
* Bug fix - changed settings group name to avoid conflicts with other plugins

= 1.0 =
* Initial release
