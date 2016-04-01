# WordPress Starter Theme v1

## Author:
James Alexandre - james@jamesalexandre.com

## Install Instructions

- Clone this theme into your WordPress install, under wp-content > themes.
- Rename folder name to the theme name you wish to have.
- Change the `style.css` block to your info/theme info.
- Head to `gulpfile.js`, and change `proxy : 'site.local'` to either your local sites domain name, or to `server : {}`.
- In terminal again, run `npm install` which will install of the dependencies.
- Once finished, run `gulp` which will start the watch task, as well as concat the vendor scripts into a single js file called `all.js`.

### What's done when `gulp` is run
- Gulp starts a server using [browser-sync](https://browsersync.io/), which will then open a tab in your browser.
- Gulp then concatenates all your script files inside assets/js/vendor into a single JS file called `app.js`. This will only concat files that exist in that location.
- Gulp will now watch all your files for changes, and injects `CSS` changes into the browser, or reloads the page when a `.php` or `.js` file is changed.

## Suggested Plugins
- [ACF - Advanced Custom Fields](http://www.advancedcustomfields.com)
- [Gravity Forms](http://www.gravityforms.com/)
- [Yoast SEO](https://wordpress.org/plugins/wordpress-seo/)
- [Yoast Google Analytics](https://wordpress.org/plugins/google-analytics-for-wordpress/)

## Contributing
Please do! Everyone is more than welcome to contribute.