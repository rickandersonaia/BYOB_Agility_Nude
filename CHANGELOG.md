# Change Log

## [un published}
- Refactor get_post_types, add new class byob_get_post_types, all methods now use this class 
- Added more post type exclusions - for WP, WC, WCS, CF7, Photo Gallery & Types.
- Change single query so it returns at most 50 posts.  This allows Agility to scale for large sites.
