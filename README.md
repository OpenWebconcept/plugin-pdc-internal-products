# README #

The Internal Products plugin splits items of the PDC into two types: internal and external.

PDC items will need to be coupled to either one of the two types in order for them to show up in the endpoint. This is to prevent accidental mixing of internal and external items.

An additional data field for Internal Data is added in the admin for all PDC items.

## Rest API ##

This plugin chages the behaviour of the existing `owc/pdc/v1/items` endpoint in that it returns *external* items only.

All *internal* items can be accessed on the `owc/pdc/v1/items/internal` endpoint.

Individual *internal* items can be accessed either on the `owc/pdc/v1/items/{slug}/internal` or `owc/pdc/v1/items/{id}/internal` endpoint. This endpoint will return the content of the Internal Data field under the key `[internal-data]`.

### Authorization ###

In order to make a request to one of the endpoints provided by this plugin user credentials need to be passed along to REST API requests served over https:// using Basic Auth / RFC 7617.

See this wordpress [documentation](https://make.wordpress.org/core/2020/11/05/application-passwords-integration-guide/) on Application Passwords for a detailed instruction on how to set this up.

## How do I get set up? ##

* Unzip and/or move all files to the /wp-content/plugins/pdc-internal-products directory
* Log into WordPress admin and activate the ‘PDC Internal Products’ plugin through the ‘Plugins’ menu

## Filters & Actions ##

There are various [hooks](https://codex.wordpress.org/Plugin_API/Hooks), which allows for changing the output.

### Action for changing main Plugin object ###

```php
'owc/pdc/internal-products/plugin'
```

## Translations ##

If you want to use your own set of labels/names/descriptions and so on you can do so. 
All text output in this plugin is controlled via the gettext methods.

Please use your preferred way to make your own translations from the /wp-content/plugins/pdc-internal-products/languages/pdc-internal-products.pot file

Be careful not to put the translation files in a location which can be overwritten by a subsequent update of the plugin, theme or WordPress core.

## Running tests ##

To run the the following commands from the root of this project

```bash
composer install
composer test
```

### Contribution guidelines ###

#### Writing tests ####

Have a look at the code coverage reports to see where more coverage can be obtained. 
Write tests.
Create a Pull request to the OWC repository.

#### Who do I talk to? ####

If you have questions about or suggestions for this plugin, please contact [Holger Peters](mailto:hpeters@Buren.nl) from Gemeente Buren.
