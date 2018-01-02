# Change Log

## [3.2.2 - 12/30/2017]
### Changed
- Fixed bug in styles for call to action buttons.  
- Fixed comments boxes to be compatible with Thesis 2.6
### Added
- New test to check if Thrive Comments plugin is installed.  If it is then Thesis comments are turned off and a hook is placed for Thrive Comments.
- Added minor CSS updates for Thrive Comments 
### Special Update Instructions
Be sure to restore defaults of Skin CSS & CSS Variables.  Once you have done that, got to Skin Design and save any of the Skin Design Options.


## [3.2.1.4 - 11/16/2017]
### Changed
- Fixed image height calculation error in deprecated 1 Column Header.  
- Added Post Content to drawer of Featured Content Query Box
### Added
- New class byobagn_get_attachment_id class - currently gets attachment id from URL 


## [3.2.1.3 - 9/1/2017]
### Changed
- Fixed error that prevented video widgets from working properly.  
- Fixed typo in css that broke submit button styles
- Fixed Attention Box Area widget title css

## [3.2.1.2 - 7/31/2017]
### Changed
- Fixed default.php so that the CSS is properly escaped.  
- Run Fix.css
- Very small CSS optimizations

## [3.2.1.1 - 7/17/2017]
### Changed
- Fixed Pinterest share button so that it searches first for the featured image.  If there is no featured image then it 
looks for attachment images.  If it finds attachment images it uses the first one for the pin.  If there are no images 
then it doesn't create a sharing link.

## [3.2.1.0 - 7/14/2017]
### Changed
- Refactor get_post_types 
- Change single query so it returns at most 50 posts.  This allows Agility to scale for large sites.
- Fixed bug in Call to Action backgrounds that prevented the #content_area selector from being used when checked in the options.
### Added
- New class byob_get_post_types, all methods now use this class 
- Added more post type exclusions - for WP, WC, WCS, CF7, Photo Gallery & Types.
- Added link to documentation
