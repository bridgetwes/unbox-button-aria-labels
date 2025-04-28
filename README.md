# Unbox Button ARIA Labels

A WordPress plugin that extends the core button block to add ARIA label support and screen reader visibility control.

## Features

- Add custom ARIA labels to button blocks
- Toggle button visibility for screen readers
- Simple integration with the WordPress block editor

## Installation

1. Download the plugin files
2. Upload the plugin folder to the `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Run `npm install` to install dependencies
5. Run `npm run build` to build the JavaScript files

## Usage

1. Add a button block to your page or post
2. In the block settings sidebar, you'll find a new "Accessibility Settings" panel
3. Add an ARIA label to provide a descriptive text for screen readers (note, this will be read by screen readers in place of your link text.)
4. Toggle the "Hide from Screen Readers" option to control screen reader visibility

## Development

- `npm run start` - Start the development build process
- `npm run build` - Build the production files
- `npm run lint:js` - Lint JavaScript files
- `npm run format` - Format code according to WordPress standards

## Requirements

- WordPress 6.7 or higher
- Node.js 14.0 or higher
- npm 6.0 or higher

## License

This plugin is licensed under the GPL v2 or later. 