# Supportamic

<!-- statamic:hide -->

![Statamic 4.0+](https://img.shields.io/badge/Statamic-4.0+-FF269E?style=for-the-badge&link=https://statamic.com)
[![Supportamic on Packagist](https://img.shields.io/packagist/v/mitydigital/supportamic?style=for-the-badge)](https://packagist.org/packages/mitydigital/supportamic/stats)

---

<!-- /statamic:hide -->

> Supportamic is an very opinionated support add-on for Statamic 4 including HubSpot chat support and a Dashboard Widget.

## Configuration

You will need to have some `.env` variables added to take full advantage of what the addon can do.

Make sure you have these set and ready to go:

```dotenv
SUPPORTAMIC_CHAT=hubspot
SUPPORTAMIC_CHAT_ENDPOINT=
SUPPORTAMIC_EMAIL=
SUPPORTAMIC_WEBSITE=
SUPPORTAMIC_WIDGET_SHOW_GUIDE=true
```

### Advanced configuration

The Chat component of this add-on uses identification based on the logged in Statamic user. If you need to make changes
beyond what the default configuration is doing, don't forget to publish the config file:

```shell
php artisan vendor:publish --tag=supportamic-config
```

For most sites, this won't be necessary.

## Chat

Supportamic is configured to work with one chat engine, HubSpot's chat (conversations) widget.

`SUPPORTAMIC_CHAT` should be "hubspot" - anything else will throw a wobbly.

`SUPPORTAMIC_CHAT_ENDPOINT` is the endpoint URL provided by HubSpot for embedding your chat widget to your page.

### Chat Identification

By default, Supportamic will try to get the logged in user's Name and Email Address and pass these to the chat widget
for a smoother UX for users.

These are set to look for the `email` and `name` fields of the User, and most likely won't need to change.

If you have a custom User Blueprint, you can override these in the `config/supportamic.php` config file.

## Widget

The Dashboard Widget can be added to your site by adding `supportamic` to your `config/statamic/cp.php` widgets configuration:

```php 
'widgets' => [

    // ...
    
    'supportamic',
    
    // ...
    
],
```

There are two key sections - Admin Guide and Support.

### Admin Guide
The Admin Guide allows you to have a link to your site's support documentation. This is pulled from Statamic's 
`STATAMIC_SUPPORT_URL` environment variable (`statamic.cp.support_url`).

Setting `SUPPORTAMIC_WIDGET_SHOW_GUIDE` to `false` will always hide the Admin Guide section, even when the URL is set.

Keeping `SUPPORTAMIC_WIDGET_SHOW_GUIDE` as `true` will show the Admin Guide section when the Support URL is not 
Statamic's URL.

### Support: Start a conversation

If you have Chat correctly configured, the "Start a Conversation" button will appear.

When loaded, this will be disabled, but will be enabled when the Chat widget is ready.

### Support: Email support

Set `SUPPORTAMIC_EMAIL` to a valid email address to enable the "Email Support" option.

This will create a button with a `mailto:` link.

### Support: Visit support website

Set `SUPPORTAMIC_WEBSITE` to a valid website to enable the "Visit support website" option.

This will open in a new window.

## Add-on Support

We've made this for our projects really... some may find it useful, but it's not something we're looking to support
beyond what is useful for our projects too. 

But hey, you could always ask - you may have a brilliant idea that we'd love to implement and use too. Say hello.

## Credits

- [Marty Friedel](https://github.com/martyf)

## License

This addon is licensed under the MIT license.
