# CHANGELOG

## Version 3.0.3

### Fix

-   Incompatibility issue with extending class BaseController 

## Version 3.0.2

### Chore

-   Replaced Composer plugin dependency check with runtime check

## Version 3.0.1

### Chore

-   Update dependencies + reference pdc-base plugin from BitBucket to GitHub

## Version 3.0.0

### Feat

- Internal items need authorization
- Additional parameter allows excluding external items

## Version 2.0.4

### Fixes

-   Uncaught TypeError in InternalItemsController

### Refactor

-   WP_Error message in api

## Version 2.0.3

### Feat

-   Support items by slug
-   Fix test
-   Format with php-cs-fixer
-   Remove unused files

## Version 2.0.2

### Feat

-   Add connected items to api

## Version 2.0.1

### Fix

-   Fix incorrect use statement in InternalItemsController

## Version 2.0.0

### Changed

-   Architecture change in the pdc-base plug-in, used as dependency, affects namespaces used

## Version 1.2.2

### Fix:

-   (fix): check if required file for `is_plugin_active` is already loaded, otherwise load it. Props @Jasper Heidebrink

## Version 1.2.1

### Fix:

-   Add enters to output for internal data in API.

## Version 1.1.0

### Features:

-   Add documentation
-   Add integration with PDC Base plugin
-   Add tests

## Version 1.0.0

### Features:

-   Initial release
