# Change Log

## [3.2.1.0 - 7/14/2017}
- Refactor get_post_types, add new class byob_get_post_types, all methods now use this class 
- Added more post type exclusions - for WP, WC, WCS, CF7, Photo Gallery & Types.
- Change single query so it returns at most 50 posts.  This allows Agility to scale for large sites.
- Fixed bug in Call to Action backgrounds that prevented the #content_area selector from being used when checked in the options.
- Added link to documentation
