# Gravitate WP Starter Theme

## Getting Started

(steps for first time setup only)

1. Perform a text search/replace across all files within the theme replacing `ClientNamespace` with the name of the project or client.
2. Rename the `inc/ClientNamespace` path to `inc/project_name` (`project_name` is the name selected in step #1).
3. Run `composer update` so that the autoload files are regenerated to reflect the new client include path.

(steps for setting up the site in a new development environment)

1. Run `npm install` to install the necessary NPM packages for the build process.
2. Run `npm run build` to build the JS and CSS assets for the theme.
3. Create a `local_config.json` file for your local hosting configuration using `local_config_example.json` as a template.
4. Run `npm run watch` and view the site at `https://localhost:3000`.

## Features

### CSS / SCSS

#### BEM-enabled

This starter theme is using the BEM methodology for CSS which improves modularity and helps with common specificity issues. To learn more about BEM, visit [getbem.com](http://getbem.com/) and [BEM By Example](https://seesparkbox.com/foundry/bem_by_example).

### PHP

#### Composer

3rd party PHP packages for this theme are managed using Composer. If you do not have Composer installed you can do so by using [Homebrew](https://brew.sh/) `brew install composer` or by going to [https://getcomposer.org/](https://getcomposer.org/).

#### WP-Util Package

The WP-Util package (repo: [https://github.com/dougfrei/wp-util](https://github.com/dougfrei/wp-util) | packagist: [https://packagist.org/packages/dfrei/wp-util](https://packagist.org/packages/dfrei/wp-util)) contains many theme-independent utility methods for WordPress and common 3rd party integrations.

### JavaScript

#### ESLint

ESLint is a tool that will compare the JavaScript in the theme to a defined set of rules. While it is not a part of the build process, it's highly recommended to run ESLint regularly in order to maintain consistency and prevent errors. The included `.eslintrc.json` file should be usable by linting plugins in editors such as Visual Studio Code and Atom in order to lint JS as you're editing it. To run ESLint manually, use the following command at the theme root: `npm run eslint`.

ESLint will hurt your feelings -- and that's a good thing.

#### Build System based on Gulp, dart-sass, and Webpack

Gulp is being used as the build system for this theme and the currently configured tasks can be found in `gulpfile.js`. Dart-sass is being used to parse the SCSS source files and it is configured within `gulpfile.js`. Webpack in combination with Babel is being used to transpile and minify the JavaScript source files.

With the combination of Webpack and Babel, it is possible to use [ES6+](https://babeljs.io/learn-es2015/) features in your code without worrying about browser compatibility. Additionally, both the [CommonJS](https://nodejs.org/docs/latest/api/modules.html) and [ES6 Module](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/import) (_preferred_) formats can be used to modularize your code.

#### Included Libraries

##### Embla Carousel

[Embla Carousel](https://www.embla-carousel.com/) can be included via the `loadEmblaCarousel` method in `js/util/load-dependencies.js`. This method will include the library dynamically and return a promise with the Embla instance after a successful load.

### How To Build

The following NPM script aliases have been include and can be run with `npm run <script-name>`:

-   `eslint` - Run ESLint against your JavaScript to check for any issues or errors
-   `build-css` - Run the Gulp build task for your SCSS files
-   `build-js` - Run the Gulp build task for your JavaScript files
-   `build` - Run both the CSS and JS build tasks together
-   `watch` - Start a BrowserSync proxy instance and put both build tasks into a watch state where they will trigger on any changes to the source files
