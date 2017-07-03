<?php

function byob_agility_nude_defaults() {
	return array (
  'css' => '/************** Begin Skin CSS **************************
 *
 * Table of Contents:
 *
 * 1.0 - Reset \\"like\\" - General
 * 2.0 - Typography
 * 3.0 - Structural Grid
 * 4.0 - Menus
 * 5.0 - Post Box Styles
 * 6.0 - Query Box Styles
 * 7.0 - Widget Styles
 * 8.0 - Form Fields
 * 9.0 - Call to Action Areas
 * 10.0 - Comments
 * 11.0 - Area Styles
 * 12.0 - Template Specific Styles
 * 13.0 - Icon Styles
 * 14.0 - Social Sharing Styles
 * 15.0 - Post Navigation Styles
 * 16.0 - Misc Styles
 * 17.0 - Misc
 * 18.0 - Media Queries
 * -----------------------------------------------------------------------------
 */


 /**
 * 1.0 Reset \\"like\\" - General
 * -----------------------------------------------------------------------------
 */
body {
	font-size: $f_primary_67;
	font-family:$font;
	color: $c_primary;
	background-color:$c_bg_site;
}

img{
	max-width:100%;
	height:auto;
	display:inline-block;
}

img.alignleft,
img.alignright,
img.aligncenter,
img.alignnone {
	display:block;
}

.alignleft{	margin-right:$x_padding_single;}

.alignright{margin-left:$x_padding_single;}

.clearfix{$z_clearfix}

/** Typical links **/
a {
	color: $c_links;
	text-decoration: none;
}

a:hover {
	color: $c_link_hover;
	text-decoration: underline;
}

 /**
 * 2.0 Typography
 * -----------------------------------------------------------------------------
 */
h1, h2, h3, h4, h5, h6{font-family:$heading_font;}

.full p{$f_default_100}

.three-quarters p{$f_default_75}

.two-thirds p{$f_default_67}

.half p{$f_default_50}

.one-third p{$f_default_33}

.one-quarter p{$f_default_25}

.full .headline{$h_default_100}

.three-quarters .headline{$h_default_75}

.two-thirds .headline{$h_default_67}

.half .headline{$h_default_50}

.one-third .headline{$h_default_33}

.one-quarter .headline{$h_default_25}

/*  2/3 Column Width   */
p, .post_box p{
	font-size: $f_primary_67;
	font-family:$font;
	color: $c_primary;
	line-height:$h_primary_67;
}

/*  Full Column Width   */
.full p, 
.full .post_box p{
	font-size: $f_primary_100;
	line-height:$h_primary_100;
}

/*  1/3 Column Width   */
.one-third p{
	$sidebar
}

 /**
 * 3.0 Structural Grid- Version 2.1.11
 * -----------------------------------------------------------------------------
 */
.page_wrapper {
	width: $page_width;
	max-width:100%;
	margin-right: auto;
	margin-left: auto;
}

.columns_1,
.columns_2,
.columns_3,
.columns_4,
.columns_321,
.columns_312,
.columns_431,
.columns_413,
.columns_4112,
.columns_4121,
.columns_4211,
.sub_columns,
.sub_columns_2,
.sub_columns_3,
.sub_columns_4{
	clear:both;
	padding:$x_padding_single 0;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}

.area_wrapper:after,
.page_wrapper:after, 
.reverse_wrapper:after, 
.inner_reverse:after,
.columns_1:after,
.columns_2:after,
.columns_3:after,
.columns_4:after,
.columns_321:after,
.columns_312:after,
.columns_431:after,
.columns_413:after,
.columns_4112:after,
.columns_4121:after,
.columns_4211:after,
.sub_columns_2:after,
.sub_columns_3:after,
.sub_columns_4:after{$z_clearfix}

.full,
.half,
.one-quarter,
.one-third,
.two-thirds,
.three-quarters{
	float:left;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}

.reverse_wrapper,
.inner_reverse{
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	float:left;
}

.full{
	width:100%;
	float:none;
	padding:0 $x_padding_single;
}
.three-quarters,
.columns_4121 .reverse_wrapper{width:75%;}

.two-thirds,
.columns_4121 .reverse_wrapper .half {width:66.5%;}

.columns_4112 .reverse_wrapper .half{width:50%;}

.inner_reverse,
.half{width:50%;}

.one-third,
.columns_4121 .reverse_wrapper .one-quarter{
	width:33.3%;
	min-width:200px;
}
.columns_4112 .reverse_wrapper .one-quarter{
	width:50%;
	min-width:200px;
}

.columns_321 .one-third,
.columns_312 .one-third{width:33.5%;}
.related_post_thumbnails .one-third{width:33.3%;}

.one-quarter{width:25%;}

.inner_reverse .one-quarter{width:50%;}

.one-quarter,
.one-third,
.half,
.columns_4112 .reverse_wrapper,
.columns_4121 .reverse_wrapper .one-quarter,
.columns_4112 .reverse_wrapper .one-quarter{
	padding:0 $x_padding_half;
}

.two-thirds,
.columns_312 .reverse_wrapper .two-thirds,
.columns_4121 .reverse_wrapper .half,
.columns_431 .three-quarters,
.columns_413 .reverse_wrapper .three-quarters{
	padding:0 $x_padding_single 0 $x_padding_half;
}

.columns_312 .two-thirds,
.columns_413 .three-quarters{
	padding:0 $x_padding_half 0 $x_padding_single;
}

.frameless .full,
.frameless .half,
.frameless .one-quarter,
.frameless .one-third,
.frameless .two-thirds,
.frameless .three-quarters,
.frameless .reverse_wrapper
.frameless .reverse_wrapper .one-quarter,
.frameless .reverse_wrapper .half,
.frameless .reverse_wrapper .one-third,
.frameless .reverse_wrapper .two-thirds{padding:0;}

.columns_312 .two-thirds,
.columns_413 .three-quarters,
.columns_431 .one-quarter,
.columns_4112 .half,
.columns_4112 .inner_wrapper,
.columns_4112 .reverse_wrapper .half,
.columns_4121 .reverse_wrapper .half{float:right;}

.columns_4112 .reverse_wrapper .one-quarter{float:left;}

/************** Isotope ***************************/
.isotope{margin-bottom:$x_67_3over2;}
.isotope .headline{margin-top:0px;}
.fluid_grid{
	padding:15px 10px;
	box-sizing:border-box;
}
.fluid_grid.two_columns{
	width:50%;
	min-width:300px;
}
.fluid_grid.three_columns{
	width:33%;
	min-width:240px;
}
.fluid_grid.four_columns{
	width:25%;
	min-width:200px;
}
.fluid_grid.five_columns{
	width:20%;
	min-width:180px;
}

 /**
 * 4.0 Menus
 * -----------------------------------------------------------------------------
 */
/*  Typical Menu   */
.menu { position: relative; list-style: none; z-index: 50; }
.menu li { position: relative; float: left; }
.menu ul { position: absolute; visibility: hidden; list-style: none; z-index: 110; }
.menu ul li { clear: both; }
.menu a { display: block; }
.menu ul ul { position: absolute; top: 0; }
.menu li:hover ul,
.menu a:hover ul,
.menu :hover ul :hover ul,
.menu :hover ul :hover ul :hover ul { visibility: visible; }
.menu :hover ul ul,
.menu :hover ul :hover ul ul { visibility: hidden; }
.menu_control {	display: none;}

/*  Main Menu   */
.main.menu ul,
.main.menu ul li { width: $main_submenu_width }

.main.menu ul ul,
.main.menu :hover ul :hover ul { left: $main_submenu_width }

.main.menu a,
.menu_control { $main_menu }

.main.menu ul a { width: auto; margin:0;}

.main.menu a,
.main.menu a i.fa,
.menu_control,
.main.menu .current-menu-item ul a,
.main.menu .current-menu-item ul a i.fa,
.menu_control i.fa { $main_menu_link }

.main.menu a:hover i.fa,
.main.menu .current-menu-item ul a:hover i.fa,
.main.menu .current-menu-ancestor a:hover i.fa,
.main.menu a:hover,
.main.menu .current-menu-item ul a:hover,
.main.menu .current-menu-ancestor a:hover { text-decoration:none; $main_menu_hover }

.main.menu .current-menu-item a,
.main.menu .current-menu-item a:hover,
.main.menu .current-menu-item a i.fa,
.main.menu .current-menu-item a:hover i.fa { $main_menu_current }

.main.menu > li{$main_menu_item_width}

/*  Main Submenu   */
.main.menu .sub-menu a{border-radius:0;$main_submenu}

.main.menu .sub-menu a,
.main.menu .current ul.sub-menu a,
.main.menu .current-menu-item ul.sub-menu a,
.main.menu .sub-menu a i.fa,
.main.menu .current ul.sub-menu a i.fa,
.main.menu .current-menu-item ul.sub-menu a i.fa { $main_submenu_link }

.main.menu .sub-menu a:hover,
.main.menu .current ul.sub-menu a:hover,
.main.menu .current-parent .sub-menu a:hover,
.main.menu .current-menu-item ul.sub-menu a:hover,
.main.menu .current-menu-ancestor .sub-menu a:hover,
.main.menu .sub-menu a:hover i.fa,
.main.menu .current ul.sub-menu a:hover i.fa,
.main.menu .current-parent .sub-menu a:hover i.fa,
.main.menu .current-menu-item ul.sub-menu a:hover i.fa,
.main.menu .current-menu-ancestor .sub-menu a:hover i.fa { text-decoration:none; $main_submenu_hover }

.main.menu .sub-menu .current a,
.main.menu .sub-menu .current a:hover,
.main.menu .sub-menu .current-menu-item a,
.main.menu .sub-menu .current-menu-item a:hover,
.main.menu .sub-menu .current a i.fa,
.main.menu .sub-menu .current a:hover i.fa,
.main.menu .sub-menu .current-menu-item a i.fa,
.main.menu .sub-menu .current-menu-item a:hover i.fa { $main_submenu_current }

/*  Header Menu   */
#header_columns .menu{display:inline-block;}
#header_columns .menu a,
#header_columns .menu_control{$header_menu }

#header_columns .menu ul,
#header_columns .menu ul li { width: $header_submenu_width }

#header_columns .menu ul ul,
#header_columns .menu :hover ul :hover ul { left: $header_submenu_width }

#header_columns .menu a,
#header_columns .menu .current ul a,
#header_columns .menu .current-menu-item ul a,
#header_columns .menu a i.fa,
#header_columns .menu .current ul a i.fa,
#header_columns .menu .current-menu-item ul a i.fa,
#header_columns .menu_control i.fa { $header_menu_link }

#header_columns .menu a:hover,
#header_columns .menu .current ul a:hover,
#header_columns .menu .current-parent a:hover,
#header_columns .menu .current-menu-item ul a:hover,
#header_columns .menu .current-menu-ancestor a:hover,
#header_columns .menu a:hover i.fa,
#header_columns .menu .current ul a:hover i.fa,
#header_columns .menu .current-parent a:hover i.fa,
#header_columns .menu .current-menu-item ul a:hover i.fa,
#header_columns .menu .current-menu-ancestor a:hover i.fa { $header_menu_hover }

#header_columns .menu .current a,
#header_columns .menu .current a:hover,
#header_columns .menu .current-menu-item a,
#header_columns .menu .current-menu-item a:hover,
#header_columns .menu .current a i.fa,
#header_columns .menu .current a:hover i.fa,
#header_columns .menu .current-menu-item a i.fa,
#header_columns .menu .current-menu-item a:hover i.fa { $header_menu_current }

#header_columns .menu > li{$header_menu_item_width}

/*  Header Submenu   */
#header_columns .menu .sub-menu a{border-radius:0;$header_submenu}

#header_columns .menu .sub-menu a,
#header_columns .menu .current ul.sub-menu a,
#header_columns .menu .current-menu-item ul.sub-menu a,
#header_columns .menu .sub-menu a i.fa,
#header_columns .menu .current ul.sub-menu a i.fa,
#header_columns .menu .current-menu-item ul.sub-menu a i.fa { $header_submenu_link }

#header_columns .menu .sub-menu a:hover,
#header_columns .menu .current ul.sub-menu a:hover,
#header_columns .menu .current-parent .sub-menu a:hover,
#header_columns .menu .current-menu-item ul.sub-menu a:hover,
#header_columns .menu .current-menu-ancestor .sub-menu a:hover,
#header_columns .menu .sub-menu a:hover i.fa,
#header_columns .menu .current ul.sub-menu a:hover i.fa,
#header_columns .menu .current-parent .sub-menu a:hover i.fa,
#header_columns .menu .current-menu-item ul.sub-menu a:hover i.fa,
#header_columns .menu .current-menu-ancestor .sub-menu a:hover i.fa { text-decoration:none; $header_submenu_hover }

#header_columns .menu .sub-menu .current a,
#header_columns .menu .sub-menu .current a:hover,
#header_columns .menu .sub-menu .current-menu-item a,
#header_columns .menu .sub-menu .current-menu-item a:hover,
#header_columns .menu .sub-menu .current a i.fa,
#header_columns .menu .sub-menu .current a:hover i.fa,
#header_columns .menu .sub-menu .current-menu-item a i.fa,
#header_columns .menu .sub-menu .current-menu-item a:hover i.fa { $header_submenu_current }

/*  Footer Menu   */
#footer_area_bottom .menu a,
#footer_area_bottom .menu_control{$footer_menu }

#footer_area_bottom .menu ul,
#footer_area_bottom .menu ul li { width: $footer_submenu_width }

#footer_area_bottom .menu ul ul,
#footer_area_bottom .menu :hover ul :hover ul { left: $footer_submenu_width }

#footer_area_bottom .menu a,
#footer_area_bottom .menu .current ul a,
#footer_area_bottom .menu .current-menu-item ul a,
#footer_area_bottom .menu_control,
#footer_area_bottom .menu a i.fa,
#footer_area_bottom .menu .current ul a i.fa,
#footer_area_bottom .menu .current-menu-item ul a i.fa,
#footer_area_bottom .menu_control i.fa { $footer_menu_link }

#footer_area_bottom .menu a:hover,
#footer_area_bottom .menu .current ul a:hover,
#footer_area_bottom .menu .current-parent a:hover,
#footer_area_bottom .menu .current-menu-item ul a:hover,
#footer_area_bottom .menu .current-menu-ancestor a:hover,
#footer_area_bottom .menu a:hover i.fa,
#footer_area_bottom .menu .current ul a:hover i.fa,
#footer_area_bottom .menu .current-parent a:hover i.fa,
#footer_area_bottom .menu .current-menu-item ul a:hover i.fa,
#footer_area_bottom .menu .current-menu-ancestor a:hover i.fa{ $footer_menu_hover }

#footer_area_bottom .menu .current a,
#footer_area_bottom .menu .current a:hover,
#footer_area_bottom .menu .current-menu-item a,
#footer_area_bottom .menu .current-menu-item a:hover,
#footer_area_bottom .menu .current a i.fa,
#footer_area_bottom .menu .current a:hover i.fa,
#footer_area_bottom .menu .current-menu-item a i.fa,
#footer_area_bottom .menu .current-menu-item a:hover i.fa { $footer_menu_current }

/*  Secondary Menu   */
.secondary.menu a{$secondary_menu }

.secondary.menu ul,
.secondary.menu ul li { width: $secondary_submenu_width }

.secondary.menu ul ul,
.secondary.menu :hover ul :hover ul { left: $secondary_submenu_width }

.secondary.menu a,
.secondary.menu .current ul a,
.secondary.menu .current-menu-item ul a,
.secondary.menu_control,
.secondary.menu a i.fa,
.secondary.menu .current ul a i.fa,
.secondary.menu .current-cat ul a i.fa,
.secondary.menu .current-menu-item ul a i.fa,
.secondary.menu_control i.fa{ $secondary_menu_link }

.secondary.menu a:hover,
.secondary.menu .current ul a:hover,
.secondary.menu .current-parent a:hover,
.secondary.menu .current-menu-item ul a:hover,
.secondary.menu .current-menu-ancestor a:hover,
.secondary.menu a:hover i.fa,
.secondary.menu .current ul a:hover i.fa,
.secondary.menu .current-parent a:hover i.fa,
.secondary.menu .current-menu-item ul a:hover i.fa,
.secondary.menu .current-menu-ancestor a:hover i.fa { $secondary_menu_hover }

.secondary.menu .current a i.fa,
.secondary.menu .current a:hover i.fa,
.secondary.menu .current-menu-item a i.fa,
.secondary.menu .current-menu-item a:hover i.fa,
.secondary.menu .current a,
.secondary.menu .current a:hover,
.secondary.menu .current-menu-item a,
.secondary.menu .current-menu-item a:hover { $secondary_menu_current }

.secondary.menu > li{$secondary_menu_item_width}

/*  Secondary Submenu   */
.secondary.menu .sub-menu a{border-radius:0;$secondary_submenu}

.secondary.menu .sub-menu a,
.secondary.menu .current ul.sub-menu a,
.secondary.menu .current-menu-item ul.sub-menu a,
.secondary.menu .sub-menu a i.fa,
.secondary.menu .current ul.sub-menu a i.fa,
.secondary.menu .current-menu-item ul.sub-menu a i.fa { $secondary_submenu_link }

.secondary.menu .sub-menu a:hover,
.secondary.menu .current ul.sub-menu a:hover,
.secondary.menu .current-parent .sub-menu a:hover,
.secondary.menu .current-menu-item ul.sub-menu a:hover,
.secondary.menu .current-menu-ancestor .sub-menu a:hover,
.secondary.menu .sub-menu a:hover i.fa,
.secondary.menu .current ul.sub-menu a:hover i.fa,
.secondary.menu .current-parent .sub-menu a:hover i.fa,
.secondary.menu .current-menu-item ul.sub-menu a:hover i.fa,
.secondary.menu .current-menu-ancestor .sub-menu a:hover i.fa { text-decoration:none; $secondary_submenu_hover }

.secondary.menu .sub-menu .current a,
.secondary.menu .sub-menu .current a:hover,
.secondary.menu .sub-menu .current-menu-item a,
.secondary.menu .sub-menu .current-menu-item a:hover,
.secondary.menu .sub-menu .current a i.fa,
.secondary.menu .sub-menu .current a:hover i.fa,
.secondary.menu .sub-menu .current-menu-item a i.fa,
.secondary.menu .sub-menu .current-menu-item a:hover i.fa{ $secondary_submenu_current }


 /**
 * 5.0 Post Box Styles
 * -----------------------------------------------------------------------------
 */
/*  Typical Post Box   */
.post_box .headline, 
.post_content h1 { $headline }

.post_box .headline{margin-bottom:$x_67_half;}

.post_box .headline_area .headline{margin-bottom:0px;}

.headline_area{	margin-bottom:$x_67_half; $secondary_font }

.post_content{line-height:$h_primary_67;}

.post_box h2{
	margin-top: $x_67_3over2;
	margin-bottom: $x_67_half;
	$subhead
}
.post_box h3, 
.post_box h4 {
	margin-top: $x_67_3over2; 
	margin-bottom: $x_67_half; 
	$subsubhead 
}

.post_box h5, 
.post_box .small { $secondary_font }

.post_box .drop_cap { 
	font-size: $x_67_double; 
	line-height: 1em; 
	margin-right: 9px; 
	float: left; 
}

.post_box p, 
.post_box ul, 
.post_box ol, 
.post_box blockquote, 
.post_box pre, 
.post_box dl, 
.post_box dd { margin-bottom: $x_67_single; }

.post_box ul { list-style-type: square; }

.post_box ul, 
.post_box ol { margin-left: $x_67_single; }

.post_box ul ul, 
.post_box ul ol, 
.post_box ol ul, 
.post_box ol ol { margin-left: $x_67_single; }

.post_box ul ul, 
.post_box ul ol, 
.post_box ol ul, 
.post_box ol ol, 
.wp-caption p { margin-bottom: 0; }

.post_box .left, 
.post_box .alignleft, 
.post_box .ad_left {
	margin-bottom: $x_67_single;
	margin-right: $x_67_single;
}

.post_box .right, 
.post_box .alignright, 
.post_box .ad {
	margin-bottom: $x_67_single;
	margin-left: $x_67_single;
}

.post_box .center, 
.post_box .aligncenter { margin-bottom: $x_67_single; }

.post_box .block, 
.post_box .alignnone { margin-bottom: $x_67_single; }

.post_box .stack { margin-left: $x_67_single; }

blockquote {
  font-weight: bold;
  font-style: italic;
  margin-left: $x_67_double;
}

blockquote p:last-of-type{
  margin-bottom: 0px;
}

blockquote.right, blockquote.left {
	margin-bottom: $x_67_half;
	$blockquote
	width: 45%;
}

blockquote.right, blockquote.left {
	padding-left: 0;
	border: 0;
}

.fluid_grid.two_columns .post_content p{$f_default_50;}

.fluid_grid.two_columns .headline{$h_default_50;}

.fluid_grid.three_columns .post_content p{$f_default_33;}

.fluid_grid.three_columns .headline{$h_default_33;}

.fluid_grid.four_columns .post_content p,
.fluid_grid.five_columns .post_content p{$f_default_25;}

.fluid_grid.four_columns .headline,
.fluid_grid.five_columns .headline{$h_default_25;}

	
/*  Home Archive Post Box   */
.home_archive.post_box h2.headline{$headline margin-bottom:0;}

.home_archive.post_box.top h2.headline{margin-top:0;}

.home_archive.post_box p.post_cats{margin-bottom:$x_67_half;}

.home_archive.post_box .headline_area{margin-bottom:$x_67_half;}

.home_archive.post_box .post_footer{margin-top:$x_67_single; text-align:right;}

.home_archive.post_box{margin-bottom:$x_67_3over2;}

/*  Full Width Column Post Box   */
.full .post_box .headline { $headline_100 }

.full .post_content,
.full .post_content p{
	line-height:$h_primary_100;
	font-size:$f_primary_100;
}

.full .post_box .post_content h2{
	$subhead_100
	margin-top: $x_100_3over2;
	margin-bottom: $x_100_half;
}

.full .post_box h3, .full .post_box h4 {
	$subsubhead_100
	margin-top: $x_100_3over2;
	margin-bottom: $x_100_half;
}

.full .post_box h5, .full .post_box .small { $secondary_font_100 }

.full .post_box .drop_cap {
	font-size: $x_100_double;
	line-height: 1em;
	margin-right: 9px;
	float: left;
}

.full .post_box p, 
.full .post_box ul, 
.full .post_box ol, 
.full .post_box blockquote, 
.full .post_box pre, 
.full .post_box dl, 
.full .post_box dd { margin-bottom: $x_100_single; }

.full .post_box ul ul, 
.full .post_box ul ol, 
.full .post_box ol ul, 
.full .post_box ol ol { margin-left: $x_100_single; }

.full .post_box .left, .full .post_box .alignleft, .full .post_box .ad_left {
	margin-bottom: $x_100_single;
	margin-right: $x_100_single;
}
.full .post_box .right, .full .post_box .alignright, .full .post_box .ad {
	margin-bottom: $x_100_single;
	margin-left: $x_100_single;
}

.full .post_box .center, 
.full .post_box .aligncenter { margin-bottom: $x_100_single; }

.full .post_box .block, 
.full .post_box .alignnone { margin-bottom: $x_100_single; }

.full .post_box .stack { margin-left: $x_100_single; }

 /**
 * 6.0 Query Box Styles
 * -----------------------------------------------------------------------------
 */

/*  Typical Query Box   */
.query_box{margin-bottom:$x_33_3over2;}

.query_box, 
.query_list{ $sidebar}

.query_box .headline, 
.query_list .headline { 
	$sidebar_heading 
	margin-bottom:$x_33_half;
}

.query_box .post_content h2,
.query_box h3,
.query_box h4,
.query_list .post_content h2,
.query_list h3,
.query_list h4 { 
	margin-top: $x_67_single; 
	margin-bottom: $x_67_half; 
	$subsubhead 
}

.query_box h5, 
.query_box .small, 
.query_list h5, 
.query_list .small  { $secondary_font }

.query_box p, 
.query_box ul, 
.query_box ol, 
.query_box blockquote, 
.query_box pre, 
.query_box dl, 
.query_box dd, 
.query_list p, 
.query_list ul, 
.query_list ol, 
.query_list blockquote, 
.query_list pre, 
.query_list dl, 
.query_list dd { margin-bottom: $x_67_single; }

.query_box ul,  
ul.query_list, 
ul.query_list ul { 
	list-style-type: none; 
	list-style-position: inside; 
}

.query_box ul, 
.query_box ol, 
.query_list ul, 
.query_list ol,
.query_box ul ul, 
.query_box ul ol, 
.query_box ol ul, 
.query_box ol ol,
.query_list ul ul, 
.query_list ul ol, 
.query_list ol ul, 
.query_list ol ol{ margin-left: $x_67_half; }

.query_box ul ul, 
.query_box ul ol, 
.query_box ol ul, 
.query_box ol ol, 
.query_box .wp-caption p,
.query_list ul ul, 
.query_list ul ol, 
.query_list ol ul, 
.query_list ol ol, 
.query_list .wp-caption p { margin-bottom: 0; }

.query_list .left, 
.query_list .alignleft, 
.query_list .ad_left { 
	margin-top: 7px; 
	margin-bottom: $x_67_half; 
	margin-right: $x_67_half; 
}

.query_box .left, 
.query_box .alignleft, 
.query_box .ad_left { 
	margin-top: 7px; 
	margin-bottom: $x_67_half; 
	margin-right: $x_67_half; 
}

.query_box .right, 
.query_box .alignright, 
.query_box .ad, 
.query_list .right, 
.query_list .alignright, 
.query_list .ad {  
	margin-top: 7px; 
	margin-bottom: $x_67_half; 
	margin-left: $x_67_half; 
}

.query_box .center, 
.query_box .aligncenter, 
.query_list .center, 
.query_list .aligncenter  { margin-bottom: $x_67_half; }

.query_box .block, 
.query_box .alignnone, 
.query_list .block, 
.query_list .alignnone  { margin-bottom: $x_67_half; }

.query_box .stack, 
.query_list .stack  { margin-left: $x_67_half; }

.query_box .featured_image_wrap .alignnone{margin-bottom:$x_67_single;}

.query_list .featured_image_wrap .alignnone{margin-bottom:$x_67_single;}

.query_box.image_grid {
  float: left;
  margin: 0 10px 10px 0;
}

.query_box.image_grid img {margin: 0;}

.related_post_thumbnails .small_headline{$sidebar}

.related_post_thumbnails .one-quarter, 
.related_post_thumbnails .one-third, 
.related_post_thumbnails .half{min-width:150px;}

.icon_box{
	padding:$x_33_single;
	background-color:$cg_ligtest;
	border:1px solid $cg_ligtest;
	text-align:center;
}

.icon_box:hover{
	background-color:$cg_white;
}

.icon_box i{
	margin-bottom: $x_33_half;
}

.icon_box .post_excerpt p,
.attention_box .post_excerpt p{$f_default_67}

 /**
 * 7.0 Widget Styles
 * -----------------------------------------------------------------------------
 */
.widget {box-sizing:border-box;}
.widget p, 
.widget {$sidebar}

.widget p{margin-bottom:$x_33_single;}

.widget{margin-bottom:$x_33_double;}

.widget_title, 
p.widget_title { 
	margin-bottom: $x_33_half; 
	$sidebar_heading 
}
.widget ul { margin-bottom:$x_33_single; }

.widget li ul { margin-bottom: 0; }

.widget ul { 
	list-style-type: none; 
	list-style-position: inside; 
}
.widget ul ul{ 
	margin-left:$x_33_half;  
}
.widget a{$sidebar_widget_link}

.widget a:hover{$sidebar_widget_hover}

 /**
 * 8.0 Form Fields
 * -----------------------------------------------------------------------------
 */

/************** Submit Buttons ***************************/
.submit a, 
a.submit, 
input#searchsubmit, 
input#submit, 
a.read-more, 
.submit a.num_comments_link,
.wpcf7-submit,
button,
#post_nav span{
	color: $cg_white;
	background-color: $c_cont_bg_med;
	border:none;
	text-decoration: none;
	padding: 10px 20px;
}

.submit a:hover,  
a.submit:hover, 
input:hover#searchsubmit, 
input:hover#submit, 
a.read-more:hover, 
.submit a.num_comments_link:hover,
.wpcf7-submit:hover,
button:hover,
#post_nav span:hover{
	color: $cg_white;
	background-color: $c_bg_dark;
	cursor:pointer;
}

input#searchsubmit, input#submit{
	border:none;
}

#searchform input[type=\\"submit\\"]{
	padding:8px 10px;
}
.button-group button{margin:0 5px 5px 0}

/************** Input Fields ***************************/
input[type=\\"text\\"], input[type=\\"email\\"], input[type=\\"tel\\"], input[type=\\"password\\"], input[type=\\"url\\"],textarea {
	font-size: inherit;
	line-height: inherit;
	font-family: inherit;
	padding: 5px;
	background-color:$c_bg_input;
}

input[type=\\"text\\"]:focus, input[type=\\"email\\"]:focus, input[type=\\"tel\\"]:focus, input[type=\\"password\\"]:focus, input[type=\\"url\\"]:focus{
	border-style: solid;
	background-color:#fff;
}
.search_form input[type=\\"text\\"]{
	width:200px;
}

#searchform input[type=\\"text\\"]{
	width:150px;
}

#searchform input#searchsubmit{padding:12px;}


 /**
 * 9.0 Call to Action Areas
 * -----------------------------------------------------------------------------
 */

.call-to-action{
	text-align:center; 
	padding:$x_67_single;
}

#content_area .call-to-action{
	background-color:$cg_light;
	margin-bottom:$x_67_3over2;
}

.post_box .call-to-action{
	background-color:$cg_light;
	margin-bottom:$x_67_3over2;
}

.call-to-action .heading{
	$headline 
	margin-bottom:$x_67_single;
}

.call-to-action.cta_tall .heading{
	$headline_100 
	margin-bottom:$x_100_single;
}

.call-to-action .message{
	font-size:$f_primary_100;
	line-height:$h_primary_67;
	margin-bottom:$x_67_single;
}

.call-to-action.cta_tall .message{
	$subsubhead
	margin-bottom:$x_100_single;
}

.call-to-action.cta_short .message{
	$sidebar_heading
	margin-bottom:0;
}

.overlay .call-to-action .heading,
.overlay .call-to-action .message{color:$cg_white;}

.call-to-action a{
	color: $cg_white;
	background-color: $c_cont_bg_med_dark;
	text-decoration: none;
	padding: 10px 20px;
}
.call-to-action a:hover{
	color: $cg_white;
	background-color: $cg_med;
	cursor:pointer;
}

/************** Thesis Email Signup Box ***************************/

.thesis_email_form{margin-bottom:$x_33_double;}

.post_box .thesis_email_form{margin-bottom:0px;}

.one-third .email_form_title, 
.one-quarter .email_form_title  {
	margin-bottom: $x_33_half;
	$sidebar_heading
}

.two-thirds .email_form_title, 
.one-half .email_form_title, 
.three-quarters .email_form_title   {
	$headline
}

.full .email_form_title   {
	$headline_100
	margin-bottom: $x_100_half;
}

.one-third .email_form_intro, 
.one-quarter .email_form_intro{
	margin-bottom: $x_33_half;
	$sidebar
}

.two-thirds .email_form_intro, 
.one-half .email_form_intro, 
.three-quarters .email_form_intro{
	margin-bottom: $x_67_half;
}

.full .email_form_intro{margin-bottom: $x_100_half;}

.thesis_email_form_submit {
	color: $cg_white;
	background-color: $c_bg_med;
	text-decoration: none;
	padding: 10px 20px;
	font-size:18px;
	border:none;
	margin-top:$x_33_half;
}

.thesis_email_form_submit:hover {
	color: $cg_white;
	background-color: $c_bg_dark;
	cursor:pointer;
}

.two-thirds .thesis_email_form_submit, 
.three-quarters .thesis_email_form_submit, 
.full .thesis_email_form_submit {
	font-size:20px;
	padding:15px;
}

.one-third .thesis_email_form label, 
.one-quarter .thesis_email_form label{
	display:block;
}

.one-third .thesis_email_form .input_text, 
.one-quarter .thesis_email_form .input_text{
	width:100%;
	-moz-box-sizing:border-box;
	box-sizing:border-box;
	margin-bottom:$x_33_half;
}

.cta_short .thesis_email_form{
	margin-bottom:0;
	font-size:20px;
}
.cta_short .thesis_email_form label{
	font-size:28px;
	vertical-align:middle;
}
.cta_short .thesis_email_form input{
	margin-right:20px;
}
.cta_short .thesis_email_form_submit{
	padding: 10px 20px;
	margin-top:0;
}

 /**
 * 10.0 Comments
 * -----------------------------------------------------------------------------
 */

/************** Comments & Comment Form ***************************/
.comment {
	border-width: 1px 0 0 5px;
	border-style: solid;
	border-color: $c_bg_dark;
	margin-top: $x_67_single;
	padding-top: 3px;
	padding-left: 3px;
}

.comment .comment_author { $subsubhead }

.comment .comment_aux { $secondary_font }

.children .comment {
	list-style-type: none;
	border-style: none;
	padding-left: $x_67_half;
}

.comment .comment_text ul { list-style-type: square; list-style-position: inside; }

.comment .comment_text ul, 
.comment .comment_text ol { margin-left: $x_67_single; }

.comment p,
.comment .comment_text ul, 
.comment .comment_text ol, 
.comment .comment_text pre { margin-bottom: $x_67_single; }

.comment .comment_text li ul, .comment .comment_text li ol {
	margin-left: $x_67_single;
	margin-bottom: 0;
}

.comment .comment_text .left, 
.comment .comment_text .alignleft {
	margin-bottom: $x_67_single;
	margin-right: $x_67_single;
}

.comment .comment_text .right, 
.comment .comment_text .alignright {
	margin-bottom: $x_67_single;
	margin-left: $x_67_single;
}
.comment .comment_text .center, 
.comment .comment_text .aligncenter { margin: 0 auto $x_67_single auto; }

.comment .comment_text .block, 
.comment .comment_text .alignnone { margin: 0 auto $x_67_single 0; }

.comment{clear:both;}

.comment .avatar{
	float:left;
	margin:0 $x_67_half $x_67_half 0;
}

p.comments_intro, 
p#comment_form_title{
	$headline
	padding-bottom:$x_67_single;
	border-top:$c_primary 1px solid;
}

#commentform label{
	display:block;
	padding-bottom:5px;
}

#commentform input[type=\\"text\\"]{
	padding:5px;
	width:90%;
	margin-bottom:$x_67_half;
}

#commentform textarea{
	padding:5px;
	width:100%;
	box-sizing:border-box;
	-moz-box-sizing:border-box;
	margin-bottom:$x_67_half;
}

#commentform .columns_2{padding-top:0;}

 /**
 * 11.0 Area Styles
 * -----------------------------------------------------------------------------
 */
#top_header_area{
	padding:0;
	background-color:$cg_black;
	color:$c_bg_very_light;
}

#top_header_columns{padding:0;}

#top_header_area i.fa{
	color:$c_bg_very_light;
	padding:5px;
}

#top_header_area .widget, 
#top_header_area .widget p{
  margin:0px;
}

#top_header_area .search-form,
#top_header_area .widget.widget_search{padding:7px 0;}

#top_header_area .widget.widget_search label{color:$cg_white;}

#top_header_area input#searchsubmit{padding:5px 20px;}

#top_header_area input[type=\\"text\\"]{
  $secondary_font;
  padding: 2px;
}

#top_header_area .phone_number{
	margin-top:5px;
}
#top_header_area .social_icons{
	text-align:right;
	margin-top:5px;
}

#header_columns{
	padding:0;
	text-align:center;
}
#top_menu_area {
	background-color: $c_bg_med;
}
#top_menu_columns{
	padding:0;
}

#feature_box_area .columns_1, 
#feature_box_area .columns_1 .full{
	padding-bottom:0;
}

#attention_area .page_wrapper{margin-bottom:$x_67_double;}

#notice_bar_area{background-color:$c_bg_light;}

#front_sharing_area{text-align:center;}

#footer_area_top {background-color: $c_bg_med;}

#footer_area_top a{	color: $cg_white;}

#footer_area_top a:hover{color: $c_cont_bg_med_dark;}

#footer_area_bottom {
	color: $c_link_hover;
	background-color: $c_bg_dark;
	overflow:hidden;
}


 /**
 * 12.0 Template Specific Styles
 * -----------------------------------------------------------------------------
 */
#archive_intro {
	border-width: 0 0 1px 0;
	border-style: solid;
	border-color: $c_primary;
	margin-bottom: $x_67_3over2;
}
h1.archive_title{margin-bottom:$x_67_single;}


 /**
 * 13.0 Icon Styles
 * -----------------------------------------------------------------------------
 */
.query_box .content_wrapper i.fa {
	float: left;
	margin-right: 10px;
}

i.fa{color:inherit;}

i.fa-fw{padding:4% 1.5%;}

i.fa-fw.positive{padding:6% 3%;}

i.circle{border-radius:100%}

i.fa.positive{
	border:3px solid $c_bg_dark;
	color:$c_bg_dark;
}

i.fa.negative{
	background-color:$c_cont_bg_dark;
	color:$cg_white;
}

i.rounded_square{border-radius:10%}

.widget.social_icons i{
	font-size:24px;
	color:$cg_white;
	background-color:$c_bg_dark;
	padding:3% 1.8%;
	border-radius:5px;
	margin-bottom:5px;
}


 /**
 * 14.0 Social Sharing Styles
 * -----------------------------------------------------------------------------
 */
.social_links a{
	color:$cg_white;
	display:inline-block;
	padding:5px 15px 5px 10px;
	margin:0 5px 10px 0;
	background-color:#306199;
}

.social_links a i.fa{
	color:$cg_white;
	padding:5px;
}

.social_links a:hover{	
	background-color:#3c7ac0;
	text-decoration:none;
}

.social_links a.twitter{background-color:#26c4f1;}

.social_links a.twitter:hover{background-color:#56d1f4;}

.social_links a.linkedin{background-color:#007bb6 ;}

.social_links a.linkedin:hover{background-color:#009de9;}

.social_links a.stumbleupon{background-color:#EB4924;}

.social_links a.stumbleupon:hover{background-color:#ef7053;}

.social_links a.googleplus{background-color:#e93f2e ;}

.social_links a.googleplus:hover{background-color:#ee695c;}

.social_links a.pinterest{background-color:#BD2126;}

.social_links a.pinterest:hover{background-color:#dc353b;}

.social_links a.reddit{background-color:#8bbbe3 ;}

.social_links a.reddit:hover{background-color:#b4d3ed;}

.social_links a.tumblr{background-color:#32506d ;}

.social_links a.tumblr:hover{background-color:#426a90;}

.social_links.monochrome a{background-color:$c_cont_bg_dark;}

.social_links.monochrome a:hover{background-color:$c_cont_bg_med;}

 /**
 * 15.0 Post Navigation Styles
 * -----------------------------------------------------------------------------
 */
#post_nav .right{text-align:right;}

#post_nav .half{padding:0 15px 0 0;}

#post_nav .half.right{padding:0 0 0 15px;}

#post_nav{margin-bottom:$x_33_3over2;}

#post_nav span{display:block;}

#post_nav i.fa,
#post_nav span a{color: $cg_white;}

#post_nav i.fa:hover,
#post_nav span:hover{color: $cg_white;}

 /**
 * 16.0 Misc
 * -----------------------------------------------------------------------------
 */

#site_title{$title}

#site_title a { $title_link }

#site_title a:hover { $title_hover }

#site_tagline {	$tagline }

.copyright, .one-third .copyright{padding-top:10px;color:$c_cont_bg_very_light;}

.overlay{background-color:rgba(000, 000, 000, 0.5);}

.overlay-1 .overlay,
.overlay-2 .overlay,
.overlay-3 .overlay{background-color:transparent;}

.social_wrapper{
	border-top: 1px solid $c_secondary;
	border-bottom: 1px solid $c_secondary;
	padding-top: 10px;
	padding-left: $x_67_single;
}

.social_wrapper iframe, .social_wrapper #___plusone_0, .social_wrapper .IN-widget{
	display:inline-block;
	width:110px !important;
	height:24px !important;
}

.section_title{
	$headline_100
	text-align:center;
	margin-bottom:$x_100_single;
	padding-top:$x_100_single ;
	border-top: 1px solid $c_bg_med;
}


/* Clearfix */
#header_area:after, 
#top_menu_area:after,
#feature_box_area:after, 
#content_area:after, 
#footer_area_top:after, 
#footer_area_bottom:after,
#post_nav:after,
.related_post_thumbnails:after, 
.textwidget:after, 
.menu:after, 
.post_box:after, 
.post_box .post_content:after, 
.comment .comment_text:after, 
ul.menu>li.menu-item>:after{ $z_clearfix }',
  'boxes' => 
  array (
    'thesis_previous_posts_link' => 
    array (
      'thesis_previous_posts_link' => 
      array (
        'text' => '<< Previous Posts',
      ),
    ),
    'thesis_next_posts_link' => 
    array (
      'thesis_next_posts_link' => 
      array (
        'text' => 'Next Posts >>',
      ),
    ),
    'thesis_archive_content' => 
    array (
      'thesis_archive_content' => 
      array (
        'class' => 'post_box',
      ),
    ),
    'thesis_comments_intro' => 
    array (
      'thesis_comments_intro' => 
      array (
        'singular' => 'Comment',
        'plural' => 'Comments',
      ),
    ),
    'byobagn_easy_header' => 
    array (
      'byobagn_easy_header_1430603940' => 
      array (
        'layout' => 'columns_2',
        'column_content_1' => 'phone_number',
        'column_content_2' => 'social_icons',
        'column_content_3' => 'social_icons',
        'id' => 'top_header_area',
        'columns_id' => 'top_header_columns',
        '_id' => 'top_header_bar',
        '_name' => '1a - Top Header Bar',
      ),
      'byobagn_easy_header_1432390067' => 
      array (
        'layout' => 'columns_1',
        'column_content_1' => 'nav_menu',
        'column_content_2' => 'nav_menu',
        'id' => 'top_menu_area',
        'columns_id' => 'top_menu_columns',
        '_id' => 'top_menu_area',
        '_name' => '1c - Top Menu Area',
      ),
      'byobagn_easy_header_1430343836' => 
      array (
        'layout' => 'columns_312',
        'column_content_1' => 'header_image',
        'column_content_2' => 'title',
        'id' => 'header_area',
        '_name' => '1b - Main Header',
      ),
    ),
    'byobagn_easy_responsive_columns' => 
    array (
      'byobagn_easy_responsive_columns_1430400569' => 
      array (
        'layout' => 'columns_1',
        'use_area' => 
        array (
          'use' => true,
        ),
        'area_id' => 'content_area',
        '_name' => 'Typical 1 Column Content',
      ),
      'byobagn_easy_responsive_columns_1430344266' => 
      array (
        'layout' => 'columns_321',
        'use_area' => 
        array (
          'use' => true,
        ),
        'area_id' => 'content_area',
        '_name' => 'Typical 2 Column Content Area',
      ),
      'byobagn_easy_responsive_columns_1430690224' => 
      array (
        'layout' => 'columns_1',
        'use_area' => 
        array (
          'use' => true,
        ),
        'area_id' => 'front_sharing_area',
        'page_wrapper' => 
        array (
          'remove' => true,
        ),
        'remove_padding' => 
        array (
          'remove' => true,
        ),
        '_id' => 'front_sharing',
        '_name' => '4 - Full Width Social Sharing Area',
      ),
    ),
    'thesis_wp_nav_menu' => 
    array (
      'thesis_wp_nav_menu_1432414620' => 
      array (
        'menu' => '3',
        '_name' => '2b - Bottom Footer - Column 1 - WP Nav Menu',
      ),
      'thesis_wp_nav_menu_1432390068' => 
      array (
        'menu' => '2',
        'menu_class' => 'main menu',
        'control' => 
        array (
          'yes' => true,
        ),
        '_name' => '1c - Top Menu Area - Column 1 - WP Nav Menu',
      ),
    ),
    'byobagn_content_grid' => 
    array (
      'byobagn_content_grid_1430344053' => 
      array (
        'layout' => 'columns_4',
        'column_content_1' => 'widget_area',
        'column_content_3' => 'widget_area',
        'column_content_4' => 'widget_area',
        'id' => 'footer_area_top',
        '_id' => 'top_footer',
        '_name' => '2a - Footer',
      ),
      'byobagn_content_grid_1430400687' => 
      array (
        'layout' => 'columns_1',
        'column_content_1' => 'call_to_action',
        'overlay' => 
        array (
          'add' => true,
        ),
        'id' => 'feature_box_area',
        '_id' => 'feature_box',
        '_name' => '3a Feature Box',
      ),
      'byobagn_content_grid_1430400755' => 
      array (
        'layout' => 'columns_3',
        'column_content_1' => 'icon_content',
        'column_content_2' => 'icon_content',
        'column_content_3' => 'icon_content',
        'include_heading' => 
        array (
          'add' => true,
        ),
        'section_heading' => 'A huge collection of professional tools',
        'id' => 'attention_area',
        '_id' => 'attention_area',
        '_name' => '3b Attention Box Area',
      ),
      'byobagn_content_grid_1430400845' => 
      array (
        'layout' => 'columns_3',
        'column_content_1' => 'featured_content',
        'column_content_2' => 'featured_content',
        'column_content_3' => 'featured_content',
        'column_content_4' => 'featured_content',
        'include_heading' => 
        array (
          'add' => true,
        ),
        'section_heading' => 'Extremely easy to use customization tools',
        'id' => 'featured_content_area',
        '_id' => 'featured_content',
        '_name' => '3c Featured Content Area',
      ),
      'byobagn_content_grid_1431281911' => 
      array (
        'layout' => 'columns_1',
        'column_content_1' => 'call_to_action',
        'id' => 'notice_bar_area',
        'remove_padding' => 
        array (
          'remove' => true,
        ),
        'v_padding' => 
        array (
          'padding-top' => true,
          'padding-bottom' => true,
        ),
        '_id' => 'notice_bar',
        '_name' => '4 - Notice Bar',
      ),
      'byobagn_content_grid_1432414619' => 
      array (
        'layout' => 'columns_2',
        'column_content_1' => 'nav_menu',
        'column_content_2' => 'copyright',
        'id' => 'footer_area_bottom',
        '_id' => 'bottom_footer',
        '_name' => '2b - Bottom Footer',
      ),
    ),
    'byobagn_copyright_date' => 
    array (
      'byobagn_copyright_date_1432414621' => 
      array (
        'company_name' => 'BYOBWebsite.com',
        'start_date' => '2009',
        '_name' => '2b - Bottom Footer - Column 2 - Copyright',
      ),
    ),
    'thesis_wp_widgets' => 
    array (
      'thesis_wp_widgets_1430344054' => 
      array (
        'div' => 'div',
        '_name' => '2a - Footer - Column 1 - Widget Area',
      ),
      'thesis_wp_widgets_1430344056' => 
      array (
        'div' => 'div',
        '_name' => '2a - Footer - Column 3 - Widget Area',
      ),
      'thesis_wp_widgets_1430344057' => 
      array (
        'div' => 'div',
        '_name' => '2a - Footer - Column 4 - Widget Area',
      ),
      'thesis_wp_widgets_1430344421' => 
      array (
        'class' => 'equalize',
        'div' => 'div',
        '_name' => 'Main Sidebar Widgets',
      ),
    ),
    'byobagn_social_profile_links' => 
    array (
      'byobagn_social_profile_links_1430348701' => 
      array (
        'add_heading' => 
        array (
          'add' => true,
        ),
        'heading_text' => 'Connect With Us',
        'class' => 'equalize widget',
        '_name' => '8 - Sidebar Social Icons',
      ),
      'byobagn_social_profile_links_1430603942' => 
      array (
        'style' => 'style_1',
        '_name' => '1a - Top Header Bar - Column 2 - Social Profile Links',
      ),
    ),
    'byobagn_call_to_action' => 
    array (
      'byobagn_call_to_action_1430400688' => 
      array (
        'configuration' => 'cta_tall',
        'heading' => 'Easy Layout, Easy Customization, Easy Mobile Responsive',
        'message' => 'Agility 3 makes creating a cutting edge, mobile responsive, custom site easier than ever before.',
        'link_text' => 'Get your copy of Agility Today!',
        'link_url' => 'http://www.byobwebsite.com/',
        '_name' => '3a Feature Box - Column 1 - Call to Action',
      ),
      'byobagn_call_to_action_1431281912' => 
      array (
        'configuration' => 'cta_short',
        'message' => 'Get the most powerful Thesis skin on the planet!',
        'link_text' => 'Give me a copy now!',
        '_name' => '4 - Notice Bar - Column 1 - Call to Action',
      ),
    ),
    'byobagn_icon_query_box' => 
    array (
      'byobagn_icon_query_box_1430400757' => 
      array (
        'icon_style' => 'rounded_square negative',
        'post_type' => 'page',
        'page_page' => '13',
        'message' => 'Learn More',
        '_name' => '3b Attention Box Area - Column 2 - Icon Content',
      ),
      'byobagn_icon_query_box_1430400758' => 
      array (
        'icon_style' => 'rounded_square negative',
        'post_type' => 'page',
        'page_page' => '11',
        'message' => 'Learn More',
        '_name' => '3b Attention Box Area - Column 3 - Icon Content',
      ),
      'byobagn_icon_query_box_1430400756' => 
      array (
        'icon_style' => 'rounded_square negative',
        'post_type' => 'page',
        'page_page' => '12',
        'message' => 'Learn More',
        '_name' => '3b Attention Box Area - Column 1 - Icon Content',
      ),
    ),
    'byobagn_featured_content_query_box' => 
    array (
      'byobagn_featured_content_query_box_1430400847' => 
      array (
        'post_type' => 'page',
        'page_page' => '8',
        '_name' => '3c Featured Content Area - Column 2 - Featured Content',
      ),
      'byobagn_featured_content_query_box_1430400848' => 
      array (
        'post_type' => 'page',
        'page_page' => '10',
        '_name' => '3c Featured Content Area - Column 3 - Featured Content',
      ),
      'byobagn_featured_content_query_box_1430400846' => 
      array (
        'post_type' => 'page',
        'page_page' => '9',
        '_name' => '3c Featured Content Area - Column 1 - Featured Content',
      ),
    ),
    'byobagn_page_post_box' => 
    array (
      'byobagn_page_post_box_1430689835' => 
      array (
        '_name' => 'Page Post Box',
      ),
    ),
    'byobagn_social_sharing_links' => 
    array (
      'byobagn_social_sharing_links_1430690299' => 
      array (
        '_name' => 'Front Social Sharing Links',
      ),
    ),
    'thesis_aweber_form' => 
    array (
      'thesis_aweber_form_1430840195' => 
      array (
        'title' => 'Use a Strong Benefit Driven Headline',
        'intro' => 'Give a brief explanation of how they will benefit you signing up with you',
        'require_name' => 
        array (
          'name' => true,
        ),
        '_name' => '8 - Sidebar Email Signup Form',
      ),
      'thesis_aweber_form_1430918200' => 
      array (
        'title' => 'Use a Strong Benefit Driven Headline',
        'intro' => 'Give a brief explanation of how they will benefit you signing up with you',
        '_name' => '8 - Content Email Signup Form',
      ),
    ),
    'thesis_mailchimp_form' => 
    array (
      'thesis_mailchimp_form_1430840421' => 
      array (
        'title' => 'Use a Strong Benefit Driven Headline',
        'intro' => 'Give a brief explanation of how they will benefit you signing up with you',
        '_name' => '8 - Sidebar Email Signup Form',
      ),
      'thesis_mailchimp_form_1430918219' => 
      array (
        'title' => 'Use a Strong Benefit Driven Headline',
        'intro' => 'Give a brief explanation of how they will benefit you signing up with you',
        '_name' => '8 - Content Email Signup Form ',
      ),
    ),
    'byobagn_single_post_box' => 
    array (
      'byobagn_single_post_box_1430780537' => 
      array (
        'wp' => 
        array (
          'auto' => true,
        ),
        '_name' => '5 - Single Post Box',
      ),
    ),
    'byobagn_thesis_email_signup_call_to_action' => 
    array (
      'byobagn_thesis_email_signup_call_to_action_1430917553' => 
      array (
        'configuration' => 'cta_stacked',
        '_id' => 'sidebar',
        '_name' => '8 - Sidebar -  Email Box Helper',
      ),
      'byobagn_thesis_email_signup_call_to_action_1430918094' => 
      array (
        'configuration' => 'cta_tall',
        '_id' => 'content',
        '_name' => '8 - Content - Email Box Helper',
      ),
    ),
    'byobagn_related_posts_thumbnails' => 
    array (
      'byobagn_related_posts_thumbnails_1430918730' => 
      array (
        'columns' => 'one-quarter',
        'use_title' => 
        array (
          'use_title' => true,
        ),
        'title_text' => 'Related Posts',
        'post_type' => 'post',
        'post_tax' => 'category',
        'num' => '4',
        '_id' => 'post',
        '_name' => '5 - Related Posts',
      ),
    ),
    'byobagn_comment_block' => 
    array (
      'byobagn_comment_block_1430918824' => 
      array (
        '_id' => 'post',
        '_name' => 'Comments',
      ),
    ),
    'byobagn_large_featured_image' => 
    array (
      'byobagn_page_post_box_1430689835_byobagn_large_featured_image' => 
      array (
        '_id' => 'page',
        '_parent' => 'byobagn_page_post_box_1430689835',
      ),
      'byobagn_single_post_box_1430780537_byobagn_large_featured_image' => 
      array (
        '_id' => 'post',
        '_parent' => 'byobagn_single_post_box_1430780537',
      ),
    ),
    'byobagn_column_1' => 
    array (
      'byobagn_easy_responsive_columns_1430344266_byobagn_column_1' => 
      array (
        'class' => 'main',
        '_parent' => 'byobagn_easy_responsive_columns_1430344266',
      ),
    ),
    'byobagn_column_2' => 
    array (
      'byobagn_easy_responsive_columns_1430344266_byobagn_column_2' => 
      array (
        'class' => 'sidebar',
        '_parent' => 'byobagn_easy_responsive_columns_1430344266',
      ),
      'byobagn_sub_columns_1430949087_byobagn_column_2' => 
      array (
        'class' => 'right',
        '_parent' => 'byobagn_sub_columns_1430949087',
      ),
    ),
    'byobagn_bottom_social_media_extender' => 
    array (
      'byobagn_page_post_box_1430689835_byobagn_bottom_social_media_extender' => 
      array (
        '_id' => 'page',
        '_parent' => 'byobagn_page_post_box_1430689835',
      ),
      'byobagn_single_post_box_1430780537_byobagn_bottom_social_media_extender' => 
      array (
        '_id' => 'post',
        '_parent' => 'byobagn_single_post_box_1430780537',
      ),
    ),
    'byobagn_top_social_media_extender' => 
    array (
      'byobagn_single_post_box_1430780537_byobagn_top_social_media_extender' => 
      array (
        '_id' => 'post',
        '_parent' => 'byobagn_single_post_box_1430780537',
      ),
    ),
    'byobagn_author_link' => 
    array (
      'byobagn_single_post_box_1430780537_byobagn_post_heading_wrapper_byobagn_author_link' => 
      array (
        '_id' => 'post',
        '_parent' => 'byobagn_single_post_box_1430780537_byobagn_post_heading_wrapper',
      ),
      'byobagn_archive_post_box_1430950404_byobagn_archive_post_heading_wrapper_byobagn_author_link' => 
      array (
        '_id' => 'home',
        '_parent' => 'byobagn_archive_post_box_1430950404_byobagn_archive_post_heading_wrapper',
      ),
      'byobagn_archive_post_box_1431285041_byobagn_archive_post_heading_wrapper_byobagn_author_link' => 
      array (
        '_id' => 'archive',
        '_parent' => 'byobagn_archive_post_box_1431285041_byobagn_archive_post_heading_wrapper',
      ),
    ),
    'thesis_post_date' => 
    array (
      'byobagn_single_post_box_1430780537_byobagn_post_heading_wrapper_thesis_post_date' => 
      array (
        '_id' => 'post',
        '_parent' => 'byobagn_single_post_box_1430780537_byobagn_post_heading_wrapper',
      ),
      'byobagn_archive_post_box_1430950404_byobagn_archive_post_heading_wrapper_thesis_post_date' => 
      array (
        '_id' => 'home',
        '_parent' => 'byobagn_archive_post_box_1430950404_byobagn_archive_post_heading_wrapper',
      ),
      'byobagn_archive_post_box_1431285041_byobagn_archive_post_heading_wrapper_thesis_post_date' => 
      array (
        '_id' => 'archive',
        '_parent' => 'byobagn_archive_post_box_1431285041_byobagn_archive_post_heading_wrapper',
      ),
    ),
    'byobagn_category_link' => 
    array (
      'byobagn_single_post_box_1430780537_byobagn_post_heading_wrapper_byobagn_category_link' => 
      array (
        '_id' => 'post',
        '_parent' => 'byobagn_single_post_box_1430780537_byobagn_post_heading_wrapper',
      ),
      'byobagn_archive_post_box_1430950404_byobagn_archive_post_heading_wrapper_byobagn_category_link' => 
      array (
        '_id' => 'home',
        '_parent' => 'byobagn_archive_post_box_1430950404_byobagn_archive_post_heading_wrapper',
      ),
      'byobagn_archive_post_box_1431285041_byobagn_archive_post_heading_wrapper_byobagn_category_link' => 
      array (
        '_id' => 'archive',
        '_parent' => 'byobagn_archive_post_box_1431285041_byobagn_archive_post_heading_wrapper',
      ),
    ),
    'byobagn_sub_columns' => 
    array (
      'byobagn_sub_columns_1436985717' => 
      array (
      ),
      'byobagn_sub_columns_1430949087' => 
      array (
        'id' => 'post_nav',
        'layout' => 'sub_columns_2',
        '_id' => 'post_nav',
        '_name' => 'Post Navigation',
      ),
    ),
    'byobagn_archive_post_box' => 
    array (
      'byobagn_archive_post_box_1430950404' => 
      array (
        '_name' => '6 - Home Post Box',
      ),
      'byobagn_archive_post_box_1431285041' => 
      array (
        '_name' => '7 - Archive Post Box',
      ),
    ),
    'byobagn_thumbnail_featured_image' => 
    array (
      'byobagn_archive_post_box_1430950404_byobagn_thumbnail_featured_image' => 
      array (
        '_id' => 'home',
        '_parent' => 'byobagn_archive_post_box_1430950404',
      ),
      'byobagn_archive_post_box_1431285041_byobagn_thumbnail_featured_image' => 
      array (
        '_id' => 'archive',
        '_parent' => 'byobagn_archive_post_box_1431285041',
      ),
    ),
    'thesis_post_num_comments' => 
    array (
      'byobagn_archive_post_box_1430950404_byobagn_postfooter_wrapper_thesis_post_num_comments' => 
      array (
        '_id' => 'home',
        '_parent' => 'byobagn_archive_post_box_1430950404_byobagn_postfooter_wrapper',
      ),
      'byobagn_archive_post_box_1431285041_byobagn_postfooter_wrapper_thesis_post_num_comments' => 
      array (
        '_id' => 'archive',
        '_parent' => 'byobagn_archive_post_box_1431285041_byobagn_postfooter_wrapper',
      ),
    ),
    'thesis_aweber_name' => 
    array (
      'thesis_aweber_form_1430918200_thesis_aweber_name' => 
      array (
        'placeholder' => 'Name',
        '_parent' => 'thesis_aweber_form_1430918200',
      ),
      'thesis_aweber_form_1430840195_thesis_aweber_name' => 
      array (
        'placeholder' => 'Name',
        '_parent' => 'thesis_aweber_form_1430840195',
      ),
    ),
    'thesis_aweber_email' => 
    array (
      'thesis_aweber_form_1430918200_thesis_aweber_email' => 
      array (
        'placeholder' => 'Email',
        '_parent' => 'thesis_aweber_form_1430918200',
      ),
      'thesis_aweber_form_1430840195_thesis_aweber_email' => 
      array (
        'placeholder' => 'Email',
        '_parent' => 'thesis_aweber_form_1430840195',
      ),
    ),
    'thesis_mailchimp_name' => 
    array (
      'thesis_mailchimp_form_1430918219_thesis_mailchimp_name' => 
      array (
        'placeholder' => 'Name',
        '_parent' => 'thesis_mailchimp_form_1430918219',
      ),
    ),
    'thesis_mailchimp_email' => 
    array (
      'thesis_mailchimp_form_1430918219_thesis_mailchimp_email' => 
      array (
        'placeholder' => 'Email',
        '_parent' => 'thesis_mailchimp_form_1430918219',
      ),
    ),
    'thesis_comment_avatar' => 
    array (
      'byobagn_comment_block_1430918824_byobagn_comment_list_thesis_comment_avatar' => 
      array (
        '_id' => 'post',
        '_parent' => 'byobagn_comment_block_1430918824_byobagn_comment_list',
      ),
    ),
    'thesis_comment_date' => 
    array (
      'byobagn_comment_block_1430918824_byobagn_comment_list_thesis_comment_date' => 
      array (
        '_id' => 'post',
        '_parent' => 'byobagn_comment_block_1430918824_byobagn_comment_list',
      ),
    ),
    'byobagn_custom_post_nav' => 
    array (
      'byobagn_custom_post_nav_1431115269' => 
      array (
        'class' => 'equalize',
        'link-type' => 'previous',
        'previous-intro' => '<i class="fa fa-hand-o-left"></i>',
        '_name' => 'Previous Post Nav',
      ),
      'byobagn_custom_post_nav_1431115376' => 
      array (
        'class' => 'equalize',
        'next-intro' => '<i class="fa fa-hand-o-right"></i>',
        '_name' => 'Next Post Nav',
      ),
    ),
    'byobagn_typical_short_excerpt' => 
    array (
      'byobagn_icon_query_box_1430400757_byobagn_typical_short_excerpt' => 
      array (
        'length' => '25',
        '_parent' => 'byobagn_icon_query_box_1430400757',
      ),
      'byobagn_icon_query_box_1430400758_byobagn_typical_short_excerpt' => 
      array (
        'length' => '25',
        '_parent' => 'byobagn_icon_query_box_1430400758',
      ),
      'byobagn_icon_query_box_1430400756_byobagn_typical_short_excerpt' => 
      array (
        'length' => '25',
        '_parent' => 'byobagn_icon_query_box_1430400756',
      ),
    ),
    'byobagn_header_image' => 
    array (
      'byobagn_header_image_1430343837' => 
      array (
        '_name' => '1b - Main Header - Column 1 - Thesis Header Image',
      ),
    ),
    'byobagn_title_and_tagline' => 
    array (
      'byobagn_title_and_tagline_1430343838' => 
      array (
        '_name' => '1b - Main Header - Column 2 - Site Title & Tagline',
      ),
    ),
    'byobagn_phone_number' => 
    array (
      'byobagn_phone_number_1430603941' => 
      array (
        '_name' => '1a - Top Header Bar - Column 1 - Phone Number',
      ),
    ),
    'byobagn_fluid_grid_wrapper' => 
    array (
      'byobagn_fluid_grid_wrapper_1431292325' => 
      array (
        '_name' => 'Fluid Grid Wrapper',
      ),
    ),
    'byobagn_fluid_grid_post_box' => 
    array (
      'byobagn_fluid_grid_post_box_1431292345' => 
      array (
        'columns' => 'three_columns',
        '_name' => '7 - Full Width Fluid Grid Post Box',
      ),
      'byobagn_fluid_grid_post_box_1431293063' => 
      array (
        'columns' => 'two_columns',
        '_name' => '7 - 2 Column Fluid Grid Post Box',
      ),
    ),
    'thesis_html_body' => 
    array (
      'thesis_html_body' => 
      array (
        'wp' => 
        array (
          'auto' => true,
        ),
      ),
    ),
    'byobagn_typical_excerpt' => 
    array (
      'byobagn_featured_content_query_box_1430400847_byobagn_typical_excerpt' => 
      array (
        'length' => '50',
        '_parent' => 'byobagn_featured_content_query_box_1430400847',
      ),
      'byobagn_featured_content_query_box_1430400848_byobagn_typical_excerpt' => 
      array (
        'length' => '50',
        '_parent' => 'byobagn_featured_content_query_box_1430400848',
      ),
      'byobagn_featured_content_query_box_1430400846_byobagn_typical_excerpt' => 
      array (
        'length' => '50',
        '_parent' => 'byobagn_featured_content_query_box_1430400846',
      ),
    ),
    'byobagn_enhanced_query_box' => 
    array (
      'byobagn_enhanced_query_box_1433346455' => 
      array (
        'use_title' => 
        array (
          'use_title' => true,
        ),
        'title_text' => 'New to the Menu',
        'post_type' => 'post',
        'post_tax' => 'category',
        'post_category_term' => '4',
        'num' => '9',
        'class' => 'image_grid',
        'title_html' => 'h4',
        '_name' => '2a - Footer - Column 2 - New to the Menu',
      ),
    ),
    'byobagn_featured_content_featured_image' => 
    array (
      'byobagn_enhanced_query_box_1433346455_byobagn_featured_content_featured_image' => 
      array (
        'size' => 'agility-tiny-thumbnail',
        '_parent' => 'byobagn_enhanced_query_box_1433346455',
      ),
    ),
  ),
  'vars' => 
  array (
    'var_1374427375' => 
    array (
      'name' => 'Primary Font',
      'ref' => 'font',
      'css' => 'Georgia, "Times New Roman", Times, serif',
    ),
    'var_1374427393' => 
    array (
      'name' => 'Primary Font Size',
      'ref' => 'f_primary_67',
      'css' => '17px',
    ),
    'var_1374427478' => 
    array (
      'name' => 'Primary Font Color',
      'ref' => 'c_primary',
      'css' => '#555555',
    ),
    'var_1374427547' => 
    array (
      'name' => 'Primary Font Line Height',
      'ref' => 'h_primary_67',
      'css' => '27px',
    ),
    'var_1374427602' => 
    array (
      'name' => 'Primary Link Color',
      'ref' => 'c_links',
      'css' => '#5485ab',
    ),
    'var_1374427637' => 
    array (
      'name' => 'Primary Link Hover Color',
      'ref' => 'c_link_hover',
      'css' => '#b2a026',
    ),
    'var_1374427685' => 
    array (
      'name' => 'Secondary Font Color',
      'ref' => 'c_secondary',
      'css' => '#8A8A8A',
    ),
    'var_1374427716' => 
    array (
      'name' => 'Primary Color - Dark',
      'ref' => 'c_bg_dark',
      'css' => '#745b27',
    ),
    'var_1374428081' => 
    array (
      'name' => 'Primary Color - Medium',
      'ref' => 'c_bg_med',
      'css' => '#ccab68',
    ),
    'var_1374428112' => 
    array (
      'name' => 'Primary Color - Light',
      'ref' => 'c_bg_light',
      'css' => '#e6d5b4',
    ),
    'var_1374428138' => 
    array (
      'name' => 'Background Color - Input Fields',
      'ref' => 'c_bg_input',
      'css' => '#FFFFFF',
    ),
    'var_1374428167' => 
    array (
      'name' => 'Background Color - Site',
      'ref' => 'c_bg_site',
      'css' => '#FFFFFF',
    ),
    'var_1374428756' => 
    array (
      'name' => 'Site Title',
      'ref' => 'title',
      'css' => 'font-family: Georgia, "Times New Roman", Times, serif;
	font-size: 39px;
	line-height: 52px;',
    ),
    'var_1374428774' => 
    array (
      'name' => 'Tagline',
      'ref' => 'tagline',
      'css' => 'font-size: 22px;
	line-height: 34px;
	color: #9a7834;',
    ),
    'var_1374428883' => 
    array (
      'name' => 'Sub Headlines (h2)',
      'ref' => 'subhead',
      'css' => 'font-family: Georgia, "Times New Roman", Times, serif;
	font-size: 35px;
	line-height: 48px;
	color: #363636;',
    ),
    'var_1374428936' => 
    array (
      'name' => 'Sub Sub Headlines (h3 & h4)',
      'ref' => 'subsubhead',
      'css' => 'font-family: Georgia, "Times New Roman", Times, serif;
	font-size: 31px;
	line-height: 43px;
	color: #363636;',
    ),
    'var_1374428980' => 
    array (
      'name' => 'Code',
      'ref' => 'code',
      'css' => 'font-family: Consolas, Menlo, Monaco, Courier, Verdana, sans-serif;',
    ),
    'var_1374428995' => 
    array (
      'name' => 'Preformatted Text',
      'ref' => 'pre',
      'css' => 'font-family: Consolas, Menlo, Monaco, Courier, Verdana, sans-serif;',
    ),
    'var_1374429034' => 
    array (
      'name' => 'Secondary Font',
      'ref' => 'secondary_font',
      'css' => 'font-size: 13px;
	line-height: 19px;
	color: #A9A9A9;',
    ),
    'var_1374429068' => 
    array (
      'name' => 'Sidebar Font',
      'ref' => 'sidebar',
      'css' => 'font-size: 15px;
	line-height: 22px;
	color: #555555;',
    ),
    'var_1374429088' => 
    array (
      'name' => 'Sidebar Headline',
      'ref' => 'sidebar_heading',
      'css' => 'font-family: Georgia, "Times New Roman", Times, serif;
	font-size: 27px;
	line-height: 35px;
	color: #363636;',
    ),
    'var_1374430023' => 
    array (
      'name' => 'Clear Fix',
      'ref' => 'z_clearfix',
      'css' => 'content: \\".\\"; display: block; height: 0; clear: both; visibility: hidden;',
    ),
    'var_1374430987' => 
    array (
      'name' => 'Typical Padding - Single',
      'ref' => 'x_padding_single',
      'css' => '27px',
    ),
    'var_1374431015' => 
    array (
      'name' => 'Typical Padding - Half',
      'ref' => 'x_padding_half',
      'css' => '14px',
    ),
    'var_1374431033' => 
    array (
      'name' => 'Typical Padding 3 over 2',
      'ref' => 'x_padding_3over2',
      'css' => '41px',
    ),
    'var_1374431064' => 
    array (
      'name' => 'Typical Padding - Double',
      'ref' => 'x_padding_double',
      'css' => '54px',
    ),
    'var_1374446379' => 
    array (
      'name' => 'Main Menu',
      'ref' => 'main_menu',
      'css' => 'font-size: 18px;
	padding-top: 10px;
	padding-right: 20px;
	padding-bottom: 10px;
	padding-left: 20px;',
    ),
    'var_1374446402' => 
    array (
      'name' => 'Main Menu Hover',
      'ref' => 'main_menu_hover',
      'css' => 'color: #FFFFFF;
	background-color: #b2a026;',
    ),
    'var_1374446419' => 
    array (
      'name' => 'Main Menu Current',
      'ref' => 'main_menu_current',
      'css' => 'color: #FFFFFF;
	background-color: #9a7834;',
    ),
    'var_1374446435' => 
    array (
      'name' => 'Footer Menu',
      'ref' => 'footer_menu',
      'css' => 'font-size: 16px;
	padding-top: 10px;
	padding-right: 20px;
	padding-bottom: 10px;
	padding-left: 20px;',
    ),
    'var_1374446456' => 
    array (
      'name' => 'Footer Menu Hover',
      'ref' => 'footer_menu_hover',
      'css' => 'color: #aabce6;
	background-color: transparent;',
    ),
    'var_1374446472' => 
    array (
      'name' => 'Footer Menu Current',
      'ref' => 'footer_menu_current',
      'css' => 'color: #e6d5b4;
	background-color: transparent;',
    ),
    'var_1374448313' => 
    array (
      'name' => 'Main Menu Link',
      'ref' => 'main_menu_link',
      'css' => 'color: #FFFFFF;
	background-color: #ccab68;',
    ),
    'var_1374448341' => 
    array (
      'name' => 'Footer Menu Link',
      'ref' => 'footer_menu_link',
      'css' => 'color: #e6d5b4;
	background-color: transparent;',
    ),
    'var_1374455793' => 
    array (
      'name' => 'Headline - Typical',
      'ref' => 'headline',
      'css' => 'font-family: Georgia, "Times New Roman", Times, serif;
	font-size: 37px;
	line-height: 49px;
	color: #171717;',
    ),
    'var_1374455845' => 
    array (
      'name' => 'Headline - Full Width',
      'ref' => 'headline_100',
      'css' => 'font-family: Georgia, "Times New Roman", Times, serif;
	font-size: 48px;
	line-height: 61px;',
    ),
    'var_1374502079' => 
    array (
      'name' => 'Footer Menu - Submenu Width',
      'ref' => 'footer_submenu_width',
      'css' => '150px;',
    ),
    'var_1374502113' => 
    array (
      'name' => 'Main Menu - Submenu Width',
      'ref' => 'main_submenu_width',
      'css' => '250px;',
    ),
    'var_1374505490' => 
    array (
      'name' => 'Spacing - Typical, Single',
      'ref' => 'x_67_single',
      'css' => '27px',
    ),
    'var_1374505541' => 
    array (
      'name' => 'Spacing - Typical, Half',
      'ref' => 'x_67_half',
      'css' => '14px',
    ),
    'var_1374505564' => 
    array (
      'name' => 'Spacing - Typical - 3 over 2',
      'ref' => 'x_67_3over2',
      'css' => '41px',
    ),
    'var_1374505613' => 
    array (
      'name' => 'Spacing - Typical - Double',
      'ref' => 'x_67_double',
      'css' => '54px',
    ),
    'var_1374506501' => 
    array (
      'name' => 'Full Width Primary Font Size',
      'ref' => 'f_primary_100',
      'css' => '22px',
    ),
    'var_1374506598' => 
    array (
      'name' => 'Full Width Primary Font Line Height',
      'ref' => 'h_primary_100',
      'css' => '34px',
    ),
    'var_1374506660' => 
    array (
      'name' => 'Full Width Secondary Font',
      'ref' => 'secondary_font_100',
      'css' => 'font-size: 17px;
	line-height: 24px;',
    ),
    'var_1374506731' => 
    array (
      'name' => 'Full Width Sub Headlines (h2)',
      'ref' => 'subhead_100',
      'css' => 'font-family: Georgia, "Times New Roman", Times, serif;
	font-size: 45px;
	line-height: 58px;',
    ),
    'var_1374506779' => 
    array (
      'name' => 'Full Width Sub Sub Headlines (h3 & h4)',
      'ref' => 'subsubhead_100',
      'css' => 'font-family: Georgia, "Times New Roman", Times, serif;
	font-size: 40px;
	line-height: 56px;',
    ),
    'var_1374507141' => 
    array (
      'name' => 'Spacing - Full Width, Single',
      'ref' => 'x_100_single',
      'css' => '36px',
    ),
    'var_1374507182' => 
    array (
      'name' => 'Spacing - Full Width, Half',
      'ref' => 'x_100_half',
      'css' => '18px',
    ),
    'var_1374507207' => 
    array (
      'name' => 'Spacing - Full Width, 3 over 2',
      'ref' => 'x_100_3over2',
      'css' => '54px',
    ),
    'var_1374507237' => 
    array (
      'name' => 'Spacing - Full Width, Double',
      'ref' => 'x_100_double',
      'css' => '72px',
    ),
    'var_1374508027' => 
    array (
      'name' => 'Spacing -Widget, Single',
      'ref' => 'x_33_single',
      'css' => '27px',
    ),
    'var_1374508286' => 
    array (
      'name' => 'Spacing -Widget, Half',
      'ref' => 'x_33_half',
      'css' => '14px',
    ),
    'var_1374508315' => 
    array (
      'name' => 'Spacing -Widget, 3 over 2',
      'ref' => 'x_33_3over2',
      'css' => '41px',
    ),
    'var_1374508356' => 
    array (
      'name' => 'Spacing -Widget, Double',
      'ref' => 'x_33_double',
      'css' => '54px',
    ),
    'var_1374514907' => 
    array (
      'name' => 'Title Hover Color',
      'ref' => 'title_hover',
      'css' => '',
    ),
    'var_1374517840' => 
    array (
      'name' => 'Media Query - Tablet, Landscape',
      'ref' => 'mq_tablet_lanscape',
      'css' => '',
    ),
    'var_1374517873' => 
    array (
      'name' => 'Media Query - Tablet, Portrait',
      'ref' => 'mq_tablet_portrait',
      'css' => '',
    ),
    'var_1374517895' => 
    array (
      'name' => 'Media Query - Smart Phone, Landscape',
      'ref' => 'mq_phone_lanscape',
      'css' => '',
    ),
    'var_1374517925' => 
    array (
      'name' => 'Media Query - Smart Phone, Landscape',
      'ref' => 'mq_phone_portrait',
      'css' => '',
    ),
    'var_1374688711' => 
    array (
      'name' => 'Page Width',
      'ref' => 'page_width',
      'css' => '1140px',
    ),
    'var_1374959423' => 
    array (
      'name' => 'Sidebar Link',
      'ref' => 'sidebar_widget_link',
      'css' => '
	color: #b2a026;',
    ),
    'var_1374959448' => 
    array (
      'name' => 'Sidebar Hover',
      'ref' => 'sidebar_widget_hover',
      'css' => '
	color: #555555;',
    ),
    'var_1380651232' => 
    array (
      'name' => 'Header Menu',
      'ref' => 'header_menu',
      'css' => 'font-size: 16px;
	padding-top: 10px;
	padding-right: 20px;
	padding-bottom: 10px;
	padding-left: 20px;',
    ),
    'var_1380651251' => 
    array (
      'name' => 'Header Menu Current',
      'ref' => 'header_menu_current',
      'css' => 'color: #ccab68;
	background-color: transparent;',
    ),
    'var_1380651280' => 
    array (
      'name' => 'Header Menu Hover',
      'ref' => 'header_menu_hover',
      'css' => 'color: #b2a026;
	background-color: transparent;',
    ),
    'var_1380651307' => 
    array (
      'name' => 'Header Menu Link',
      'ref' => 'header_menu_link',
      'css' => 'color: #745b27;
	background-color: transparent;',
    ),
    'var_1380651325' => 
    array (
      'name' => 'Header Submenu Widt',
      'ref' => 'header_submenu_width',
      'css' => '150px;',
    ),
    'var_1380651357' => 
    array (
      'name' => 'Main Submenu',
      'ref' => 'main_submenu',
      'css' => 'font-size: 16px;',
    ),
    'var_1380651389' => 
    array (
      'name' => 'Main Submenu Current',
      'ref' => 'main_submenu_current',
      'css' => '',
    ),
    'var_1380651412' => 
    array (
      'name' => 'Main Submenu Hover',
      'ref' => 'main_submenu_hover',
      'css' => '',
    ),
    'var_1380651441' => 
    array (
      'name' => 'Main Submenu Link',
      'ref' => 'main_submenu_link',
      'css' => '',
    ),
    'var_1380651471' => 
    array (
      'name' => 'Menu Item Width',
      'ref' => 'main_menu_item_width',
      'css' => '',
    ),
    'var_1380651578' => 
    array (
      'name' => 'Secondary Menu',
      'ref' => 'secondary_menu',
      'css' => 'font-size: 16px;
	padding-top: 10px;
	padding-right: 20px;
	padding-bottom: 10px;
	padding-left: 20px;',
    ),
    'var_1380651595' => 
    array (
      'name' => 'Secondary Menu Current',
      'ref' => 'secondary_menu_current',
      'css' => 'color: #ccab68;
	background-color: transparent;',
    ),
    'var_1380651624' => 
    array (
      'name' => 'Secondary Menu Hover',
      'ref' => 'secondary_menu_hover',
      'css' => 'color: #b2a026;
	background-color: transparent;',
    ),
    'var_1380651646' => 
    array (
      'name' => 'Secondary Menu Link',
      'ref' => 'secondary_menu_link',
      'css' => 'color: #745b27;
	background-color: transparent;',
    ),
    'var_1380651690' => 
    array (
      'name' => 'Secondary Menu - Submenu Width',
      'ref' => 'secondary_submenu_width',
      'css' => '150px;',
    ),
    'var_1400713489' => 
    array (
      'name' => 'Site Title Link Color',
      'ref' => 'title_link',
      'css' => '',
    ),
    'var_1425830520' => 
    array (
      'name' => 'Primary Color - Medium Dark',
      'ref' => 'c_bg_med_dark',
      'css' => '#9a7834',
    ),
    'var_1425830610' => 
    array (
      'name' => 'Primary Color - Very Light',
      'ref' => 'c_bg_very_light',
      'css' => '#ffffff',
    ),
    'var_1425830648' => 
    array (
      'name' => 'Contrast Color - Dark',
      'ref' => 'c_cont_bg_dark',
      'css' => '#2d7685',
    ),
    'var_1425830681' => 
    array (
      'name' => 'Contrast Color - Medium Dark',
      'ref' => 'c_cont_bg_med_dark',
      'css' => '#b2a026',
    ),
    'var_1425830712' => 
    array (
      'name' => 'Contrast Color - Medium',
      'ref' => 'c_cont_bg_med',
      'css' => '#5485ab',
    ),
    'var_1425830733' => 
    array (
      'name' => 'Contrast Color - Light',
      'ref' => 'c_cont_bg_light',
      'css' => '#aabce6',
    ),
    'var_1425830754' => 
    array (
      'name' => 'Contrast Color - Very Light',
      'ref' => 'c_cont_bg_very_light',
      'css' => '#dedaf3',
    ),
    'var_1425830773' => 
    array (
      'name' => 'Grayscale - Black',
      'ref' => 'cg_black',
      'css' => '#000000',
    ),
    'var_1425830845' => 
    array (
      'name' => 'Grayscale - Darkest',
      'ref' => 'cg_darkest',
      'css' => '#171717',
    ),
    'var_1425830880' => 
    array (
      'name' => 'Grayscale - Very Dark',
      'ref' => 'cg_very_dark',
      'css' => '#363636',
    ),
    'var_1425830914' => 
    array (
      'name' => 'Grayscale - Dark',
      'ref' => 'cg_dark',
      'css' => '#555555',
    ),
    'var_1425830933' => 
    array (
      'name' => 'Grayscale - Medium Dark',
      'ref' => 'cg_med_dark',
      'css' => '#707070',
    ),
    'var_1425830956' => 
    array (
      'name' => 'Grayscale - Medium',
      'ref' => 'cg_med',
      'css' => '#8A8A8A',
    ),
    'var_1425830979' => 
    array (
      'name' => 'Grayscale - Medium Light',
      'ref' => 'cg_med_light',
      'css' => '#A9A9A9',
    ),
    'var_1425830999' => 
    array (
      'name' => 'Grayscale - Light',
      'ref' => 'cg_light',
      'css' => '#C0C0C0',
    ),
    'var_1425831020' => 
    array (
      'name' => 'Grayscale - Very Light',
      'ref' => 'cg_very_light',
      'css' => '#D3D3D3',
    ),
    'var_1425831058' => 
    array (
      'name' => 'Grayscale - Lightest',
      'ref' => 'cg_ligtest',
      'css' => '#FAFAFA',
    ),
    'var_1425831087' => 
    array (
      'name' => 'Grayscale - White',
      'ref' => 'cg_white',
      'css' => '#FFFFFF',
    ),
    'var_1426945677' => 
    array (
      'name' => 'Header Menu Item Width',
      'ref' => 'header_menu_item_width',
      'css' => '',
    ),
    'var_1426945711' => 
    array (
      'name' => 'Header Submenu Link',
      'ref' => 'header_submenu_link',
      'css' => '',
    ),
    'var_1426945802' => 
    array (
      'name' => 'Header Submenu Hover',
      'ref' => 'header_submenu_hover',
      'css' => '',
    ),
    'var_1426945843' => 
    array (
      'name' => 'Header Submenu Current',
      'ref' => 'header_submenu_current',
      'css' => '',
    ),
    'var_1426945975' => 
    array (
      'name' => 'Header Submenu',
      'ref' => 'header_submenu',
      'css' => 'font-size: 16px;',
    ),
    'var_1426946159' => 
    array (
      'name' => 'Secondary Menu Item Width',
      'ref' => 'secondary_menu_item_width',
      'css' => '',
    ),
    'var_1426946203' => 
    array (
      'name' => 'Secondary Submenu',
      'ref' => 'secondary_submenu',
      'css' => 'font-size: 16px;',
    ),
    'var_1426946226' => 
    array (
      'name' => 'Secondary Submenu Link',
      'ref' => 'secondary_submenu_link',
      'css' => '',
    ),
    'var_1426946258' => 
    array (
      'name' => 'Secondary Submenu Hover',
      'ref' => 'secondary_submenu_hover',
      'css' => '',
    ),
    'var_1426946292' => 
    array (
      'name' => 'Secondary Submenu Current',
      'ref' => 'secondary_submenu_current',
      'css' => '',
    ),
    'var_1426946538' => 
    array (
      'name' => 'Blockquote',
      'ref' => 'blockquote',
      'css' => 'color: #A9A9A9;',
    ),
    'var_1427410487' => 
    array (
      'name' => 'Heading Font',
      'ref' => 'heading_font',
      'css' => 'Georgia, "Times New Roman", Times, serif',
    ),
    'var_1431873823' => 
    array (
      'name' => 'Default Font 3/4',
      'ref' => 'f_default_75',
      'css' => 'font-size: 22px;
	line-height: 34px;',
    ),
    'var_1431873840' => 
    array (
      'name' => 'Default Font 1/2',
      'ref' => 'f_default_50',
      'css' => 'font-size: 16px;
	line-height: 25px;',
    ),
    'var_1431873859' => 
    array (
      'name' => 'Default Font 1/4',
      'ref' => 'f_default_25',
      'css' => 'font-size: 15px;
	line-height: 21px;',
    ),
    'var_1431877040' => 
    array (
      'name' => 'Default Font 100',
      'ref' => 'f_default_100',
      'css' => 'font-size: 19px;
	line-height: 30px;',
    ),
    'var_1431877061' => 
    array (
      'name' => 'Default Heading 100',
      'ref' => 'h_default_100',
      'css' => 'font-size: 48px;
	line-height: 61px;',
    ),
    'var_1431877103' => 
    array (
      'name' => 'Default Heading 3/4',
      'ref' => 'h_default_75',
      'css' => 'font-size: 41px;
	line-height: 55px;',
    ),
    'var_1431877127' => 
    array (
      'name' => 'Default Font 2/3',
      'ref' => 'f_default_67',
      'css' => 'font-size: 17px;
	line-height: 27px;',
    ),
    'var_1431877142' => 
    array (
      'name' => 'Default Heading 2/3',
      'ref' => 'h_default_67',
      'css' => 'font-size: 37px;
	line-height: 49px;',
    ),
    'var_1431877163' => 
    array (
      'name' => 'Default Heading 1/2',
      'ref' => 'h_default_50',
      'css' => 'font-size: 35px;
	line-height: 46px;',
    ),
    'var_1431877181' => 
    array (
      'name' => 'Default Font 1/3',
      'ref' => 'f_default_33',
      'css' => 'font-size: 15px;
	line-height: 22px;',
    ),
    'var_1431877197' => 
    array (
      'name' => 'Default Heading 1/3',
      'ref' => 'h_default_33',
      'css' => 'font-size: 27px;
	line-height: 35px;',
    ),
    'var_1431877216' => 
    array (
      'name' => 'Default Heading 1/4',
      'ref' => 'h_default_25',
      'css' => 'font-size: 27px;
	line-height: 34px;',
    ),
  ),
  'templates' => 
  array (
    'page' => 
    array (
      'options' => 
      array (
        'byobagn_match_height' => 
        array (
          'use_matchheight' => 
          array (
            'use' => true,
          ),
        ),
      ),
      'boxes' => 
      array (
        'thesis_html_body' => 
        array (
          0 => 'byobagn_easy_header_1430603940',
          1 => 'byobagn_easy_header_1430343836',
          2 => 'byobagn_easy_header_1432390067',
          3 => 'byobagn_easy_responsive_columns_1430344266',
          4 => 'byobagn_content_grid_1430344053',
          5 => 'byobagn_content_grid_1432414619',
        ),
        'byobagn_easy_responsive_columns_1430344266' => 
        array (
          0 => 'byobagn_easy_responsive_columns_1430344266_byobagn_column_1',
          1 => 'byobagn_easy_responsive_columns_1430344266_byobagn_column_2',
        ),
        'byobagn_easy_responsive_columns_1430344266_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_loop',
          1 => 'byobagn_thesis_email_signup_call_to_action_1430918094',
        ),
        'thesis_wp_loop' => 
        array (
          0 => 'byobagn_page_post_box_1430689835',
        ),
        'byobagn_page_post_box_1430689835' => 
        array (
          0 => 'byobagn_page_post_box_1430689835_byobagn_large_featured_image',
          1 => 'byobagn_page_post_box_1430689835_thesis_post_headline',
          2 => 'byobagn_page_post_box_1430689835_thesis_post_content',
          3 => 'byobagn_page_post_box_1430689835_byobagn_bottom_social_media_extender',
        ),
        'byobagn_page_post_box_1430689835_byobagn_bottom_social_media_extender' => 
        array (
          0 => 'byobagn_page_post_box_1430689835_byobagn_bottom_social_media_extender_byobagn_twitter_sharing_link',
          1 => 'byobagn_page_post_box_1430689835_byobagn_bottom_social_media_extender_byobagn_facebook_sharing_link',
          2 => 'byobagn_page_post_box_1430689835_byobagn_bottom_social_media_extender_byobagn_linkedin_sharing_link',
          3 => 'byobagn_page_post_box_1430689835_byobagn_bottom_social_media_extender_byobagn_stumbleupon_sharing_link',
          4 => 'byobagn_page_post_box_1430689835_byobagn_bottom_social_media_extender_byobagn_googleplus_sharing_link',
          5 => 'byobagn_page_post_box_1430689835_byobagn_bottom_social_media_extender_byobagn_pinterest_sharing_link',
          6 => 'byobagn_page_post_box_1430689835_byobagn_bottom_social_media_extender_byobagn_reddit_sharing_link',
          7 => 'byobagn_page_post_box_1430689835_byobagn_bottom_social_media_extender_byobagn_tumblr_sharing_link',
        ),
        'byobagn_thesis_email_signup_call_to_action_1430918094' => 
        array (
          0 => 'thesis_aweber_form_1430918200',
        ),
        'thesis_aweber_form_1430918200' => 
        array (
          0 => 'thesis_aweber_form_1430918200_thesis_aweber_name',
          1 => 'thesis_aweber_form_1430918200_thesis_aweber_email',
          2 => 'thesis_aweber_form_1430918200_thesis_aweber_submit',
        ),
        'byobagn_easy_responsive_columns_1430344266_byobagn_column_2' => 
        array (
          0 => 'byobagn_thesis_email_signup_call_to_action_1430917553',
          1 => 'byobagn_social_profile_links_1430348701',
          2 => 'thesis_wp_widgets_1430344421',
        ),
        'byobagn_thesis_email_signup_call_to_action_1430917553' => 
        array (
          0 => 'thesis_aweber_form_1430840195',
        ),
        'thesis_aweber_form_1430840195' => 
        array (
          0 => 'thesis_aweber_form_1430840195_thesis_aweber_name',
          1 => 'thesis_aweber_form_1430840195_thesis_aweber_email',
          2 => 'thesis_aweber_form_1430840195_thesis_aweber_submit',
        ),
        'byobagn_social_profile_links_1430348701' => 
        array (
          0 => 'byobagn_social_profile_links_1430348701_byobagn_twitter_link',
          1 => 'byobagn_social_profile_links_1430348701_byobagn_facebook_link',
          2 => 'byobagn_social_profile_links_1430348701_byobagn_linkedin_link',
          3 => 'byobagn_social_profile_links_1430348701_byobagn_stumbleupon_link',
          4 => 'byobagn_social_profile_links_1430348701_byobagn_googleplus_link',
          5 => 'byobagn_social_profile_links_1430348701_byobagn_pinterest_link',
          6 => 'byobagn_social_profile_links_1430348701_byobagn_instagram_link',
          7 => 'byobagn_social_profile_links_1430348701_byobagn_youtube_link',
          8 => 'byobagn_social_profile_links_1430348701_byobagn_vimeo_link',
          9 => 'byobagn_social_profile_links_1430348701_byobagn_vine_link',
          10 => 'byobagn_social_profile_links_1430348701_byobagn_flickr_link',
          11 => 'byobagn_social_profile_links_1430348701_byobagn_reddit_link',
          12 => 'byobagn_social_profile_links_1430348701_byobagn_tumblr_link',
          13 => 'byobagn_social_profile_links_1430348701_byobagn_custom1_link',
          14 => 'byobagn_social_profile_links_1430348701_byobagn_custom2_link',
        ),
        'byobagn_content_grid_1430344053' => 
        array (
          0 => 'byobagn_content_grid_1430344053_byobagn_column_1',
          1 => 'byobagn_content_grid_1430344053_byobagn_column_2',
          2 => 'byobagn_content_grid_1430344053_byobagn_column_3',
          3 => 'byobagn_content_grid_1430344053_byobagn_column_4',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_widgets_1430344054',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_2' => 
        array (
          0 => 'byobagn_enhanced_query_box_1433346455',
        ),
        'byobagn_enhanced_query_box_1433346455' => 
        array (
          0 => 'byobagn_enhanced_query_box_1433346455_byobagn_featured_content_featured_image',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_3' => 
        array (
          0 => 'thesis_wp_widgets_1430344056',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_4' => 
        array (
          0 => 'thesis_wp_widgets_1430344057',
        ),
        'byobagn_content_grid_1432414619' => 
        array (
          0 => 'byobagn_content_grid_1432414619_byobagn_column_1',
          1 => 'byobagn_content_grid_1432414619_byobagn_column_2',
        ),
        'byobagn_content_grid_1432414619_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_nav_menu_1432414620',
        ),
        'byobagn_content_grid_1432414619_byobagn_column_2' => 
        array (
          0 => 'byobagn_copyright_date_1432414621',
        ),
        'byobagn_easy_header_1430603940' => 
        array (
          0 => 'byobagn_easy_header_1430603940_byobagn_column_1',
          1 => 'byobagn_easy_header_1430603940_byobagn_column_2',
        ),
        'byobagn_easy_header_1430603940_byobagn_column_1' => 
        array (
          0 => 'byobagn_phone_number_1430603941',
        ),
        'byobagn_easy_header_1430603940_byobagn_column_2' => 
        array (
          0 => 'byobagn_social_profile_links_1430603942',
        ),
        'byobagn_social_profile_links_1430603942' => 
        array (
          0 => 'byobagn_social_profile_links_1430603942_byobagn_twitter_link',
          1 => 'byobagn_social_profile_links_1430603942_byobagn_linkedin_link',
          2 => 'byobagn_social_profile_links_1430603942_byobagn_facebook_link',
          3 => 'byobagn_social_profile_links_1430603942_byobagn_stumbleupon_link',
          4 => 'byobagn_social_profile_links_1430603942_byobagn_googleplus_link',
          5 => 'byobagn_social_profile_links_1430603942_byobagn_pinterest_link',
          6 => 'byobagn_social_profile_links_1430603942_byobagn_instagram_link',
          7 => 'byobagn_social_profile_links_1430603942_byobagn_vimeo_link',
          8 => 'byobagn_social_profile_links_1430603942_byobagn_vine_link',
          9 => 'byobagn_social_profile_links_1430603942_byobagn_youtube_link',
          10 => 'byobagn_social_profile_links_1430603942_byobagn_flickr_link',
          11 => 'byobagn_social_profile_links_1430603942_byobagn_reddit_link',
          12 => 'byobagn_social_profile_links_1430603942_byobagn_tumblr_link',
          13 => 'byobagn_social_profile_links_1430603942_byobagn_slideshare_link',
          14 => 'byobagn_social_profile_links_1430603942_byobagn_custom1_link',
          15 => 'byobagn_social_profile_links_1430603942_byobagn_custom2_link',
        ),
        'byobagn_easy_header_1430343836' => 
        array (
          0 => 'byobagn_easy_header_1430343836_byobagn_column_1',
          1 => 'byobagn_easy_header_1430343836_byobagn_column_2',
        ),
        'byobagn_easy_header_1430343836_byobagn_column_1' => 
        array (
          0 => 'byobagn_header_image_1430343837',
        ),
        'byobagn_easy_header_1430343836_byobagn_column_2' => 
        array (
          0 => 'byobagn_title_and_tagline_1430343838',
        ),
        'byobagn_title_and_tagline_1430343838' => 
        array (
          0 => 'byobagn_title_and_tagline_1430343838_thesis_site_title',
          1 => 'byobagn_title_and_tagline_1430343838_thesis_site_tagline',
        ),
        'byobagn_easy_header_1432390067' => 
        array (
          0 => 'byobagn_easy_header_1432390067_byobagn_column_1',
        ),
        'byobagn_easy_header_1432390067_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_nav_menu_1432390068',
        ),
      ),
    ),
    'archive' => 
    array (
      'options' => 
      array (
        'byobagn_match_height' => 
        array (
          'use_matchheight' => 
          array (
            'use' => true,
          ),
        ),
      ),
      'boxes' => 
      array (
        'thesis_html_body' => 
        array (
          0 => 'byobagn_easy_header_1430603940',
          1 => 'byobagn_easy_header_1430343836',
          2 => 'byobagn_easy_header_1432390067',
          3 => 'byobagn_easy_responsive_columns_1430344266',
          4 => 'byobagn_content_grid_1431281911',
          5 => 'byobagn_easy_responsive_columns_1430690224',
          6 => 'byobagn_content_grid_1430344053',
          7 => 'byobagn_content_grid_1432414619',
        ),
        'byobagn_easy_responsive_columns_1430344266' => 
        array (
          0 => 'byobagn_easy_responsive_columns_1430344266_byobagn_column_1',
          1 => 'byobagn_easy_responsive_columns_1430344266_byobagn_column_2',
        ),
        'byobagn_easy_responsive_columns_1430344266_byobagn_column_1' => 
        array (
          0 => 'thesis_archive_title',
          1 => 'thesis_archive_content',
          2 => 'thesis_wp_loop',
          3 => 'byobagn_thesis_email_signup_call_to_action_1430918094',
          4 => 'byobagn_sub_columns_1430949087',
        ),
        'thesis_wp_loop' => 
        array (
          0 => 'byobagn_archive_post_box_1431285041',
        ),
        'byobagn_archive_post_box_1431285041' => 
        array (
          0 => 'byobagn_archive_post_box_1431285041_byobagn_archive_post_heading_wrapper',
          1 => 'byobagn_archive_post_box_1431285041_byobagn_thumbnail_featured_image',
          2 => 'byobagn_archive_post_box_1431285041_byobagn_typical_excerpt',
          3 => 'byobagn_archive_post_box_1431285041_byobagn_postfooter_wrapper',
        ),
        'byobagn_archive_post_box_1431285041_byobagn_archive_post_heading_wrapper' => 
        array (
          0 => 'byobagn_archive_post_box_1431285041_byobagn_archive_post_heading_wrapper_byobagn_featured_content_post_title',
          1 => 'byobagn_archive_post_box_1431285041_byobagn_archive_post_heading_wrapper_byobagn_author_link',
          2 => 'byobagn_archive_post_box_1431285041_byobagn_archive_post_heading_wrapper_thesis_post_date',
          3 => 'byobagn_archive_post_box_1431285041_byobagn_archive_post_heading_wrapper_byobagn_category_link',
        ),
        'byobagn_archive_post_box_1431285041_byobagn_postfooter_wrapper' => 
        array (
          0 => 'byobagn_archive_post_box_1431285041_byobagn_postfooter_wrapper_byobagn_dependent_read_more',
          1 => 'byobagn_archive_post_box_1431285041_byobagn_postfooter_wrapper_thesis_post_num_comments',
        ),
        'byobagn_thesis_email_signup_call_to_action_1430918094' => 
        array (
          0 => 'thesis_aweber_form_1430918200',
        ),
        'thesis_aweber_form_1430918200' => 
        array (
          0 => 'thesis_aweber_form_1430918200_thesis_aweber_name',
          1 => 'thesis_aweber_form_1430918200_thesis_aweber_email',
          2 => 'thesis_aweber_form_1430918200_thesis_aweber_submit',
        ),
        'byobagn_sub_columns_1430949087' => 
        array (
          0 => 'byobagn_sub_columns_1430949087_byobagn_column_1',
          1 => 'byobagn_sub_columns_1430949087_byobagn_column_2',
        ),
        'byobagn_sub_columns_1430949087_byobagn_column_1' => 
        array (
          0 => 'thesis_previous_posts_link',
        ),
        'byobagn_sub_columns_1430949087_byobagn_column_2' => 
        array (
          0 => 'thesis_next_posts_link',
        ),
        'byobagn_easy_responsive_columns_1430344266_byobagn_column_2' => 
        array (
          0 => 'byobagn_thesis_email_signup_call_to_action_1430917553',
          1 => 'byobagn_social_profile_links_1430348701',
          2 => 'thesis_wp_widgets_1430344421',
        ),
        'byobagn_thesis_email_signup_call_to_action_1430917553' => 
        array (
          0 => 'thesis_aweber_form_1430840195',
        ),
        'thesis_aweber_form_1430840195' => 
        array (
          0 => 'thesis_aweber_form_1430840195_thesis_aweber_name',
          1 => 'thesis_aweber_form_1430840195_thesis_aweber_email',
          2 => 'thesis_aweber_form_1430840195_thesis_aweber_submit',
        ),
        'byobagn_social_profile_links_1430348701' => 
        array (
          0 => 'byobagn_social_profile_links_1430348701_byobagn_twitter_link',
          1 => 'byobagn_social_profile_links_1430348701_byobagn_facebook_link',
          2 => 'byobagn_social_profile_links_1430348701_byobagn_linkedin_link',
          3 => 'byobagn_social_profile_links_1430348701_byobagn_stumbleupon_link',
          4 => 'byobagn_social_profile_links_1430348701_byobagn_googleplus_link',
          5 => 'byobagn_social_profile_links_1430348701_byobagn_pinterest_link',
          6 => 'byobagn_social_profile_links_1430348701_byobagn_instagram_link',
          7 => 'byobagn_social_profile_links_1430348701_byobagn_youtube_link',
          8 => 'byobagn_social_profile_links_1430348701_byobagn_vimeo_link',
          9 => 'byobagn_social_profile_links_1430348701_byobagn_vine_link',
          10 => 'byobagn_social_profile_links_1430348701_byobagn_flickr_link',
          11 => 'byobagn_social_profile_links_1430348701_byobagn_reddit_link',
          12 => 'byobagn_social_profile_links_1430348701_byobagn_tumblr_link',
          13 => 'byobagn_social_profile_links_1430348701_byobagn_slideshare_link',
          14 => 'byobagn_social_profile_links_1430348701_byobagn_custom1_link',
          15 => 'byobagn_social_profile_links_1430348701_byobagn_custom2_link',
        ),
        'byobagn_content_grid_1431281911' => 
        array (
          0 => 'byobagn_content_grid_1431281911_byobagn_column_1',
        ),
        'byobagn_content_grid_1431281911_byobagn_column_1' => 
        array (
          0 => 'byobagn_call_to_action_1431281912',
        ),
        'byobagn_easy_responsive_columns_1430690224' => 
        array (
          0 => 'byobagn_easy_responsive_columns_1430690224_byobagn_column_1',
        ),
        'byobagn_easy_responsive_columns_1430690224_byobagn_column_1' => 
        array (
          0 => 'byobagn_social_sharing_links_1430690299',
        ),
        'byobagn_social_sharing_links_1430690299' => 
        array (
          0 => 'byobagn_social_sharing_links_1430690299_byobagn_twitter_sharing_link',
          1 => 'byobagn_social_sharing_links_1430690299_byobagn_facebook_sharing_link',
          2 => 'byobagn_social_sharing_links_1430690299_byobagn_linkedin_sharing_link',
          3 => 'byobagn_social_sharing_links_1430690299_byobagn_stumbleupon_sharing_link',
          4 => 'byobagn_social_sharing_links_1430690299_byobagn_googleplus_sharing_link',
          5 => 'byobagn_social_sharing_links_1430690299_byobagn_pinterest_sharing_link',
          6 => 'byobagn_social_sharing_links_1430690299_byobagn_reddit_sharing_link',
          7 => 'byobagn_social_sharing_links_1430690299_byobagn_tumblr_sharing_link',
        ),
        'byobagn_content_grid_1430344053' => 
        array (
          0 => 'byobagn_content_grid_1430344053_byobagn_column_1',
          1 => 'byobagn_content_grid_1430344053_byobagn_column_2',
          2 => 'byobagn_content_grid_1430344053_byobagn_column_3',
          3 => 'byobagn_content_grid_1430344053_byobagn_column_4',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_widgets_1430344054',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_2' => 
        array (
          0 => 'byobagn_enhanced_query_box_1433346455',
        ),
        'byobagn_enhanced_query_box_1433346455' => 
        array (
          0 => 'byobagn_enhanced_query_box_1433346455_byobagn_featured_content_featured_image',
        ),
        'byobagn_enhanced_query_box_1433346455_byobagn_enhanced_query_box_content_wrapper' => 
        array (
          0 => 'byobagn_enhanced_query_box_1433346455_byobagn_enhanced_query_box_content_wrapper_byobagn_typical_excerpt',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_3' => 
        array (
          0 => 'thesis_wp_widgets_1430344056',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_4' => 
        array (
          0 => 'thesis_wp_widgets_1430344057',
        ),
        'byobagn_content_grid_1432414619' => 
        array (
          0 => 'byobagn_content_grid_1432414619_byobagn_column_1',
          1 => 'byobagn_content_grid_1432414619_byobagn_column_2',
        ),
        'byobagn_content_grid_1432414619_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_nav_menu_1432414620',
        ),
        'byobagn_content_grid_1432414619_byobagn_column_2' => 
        array (
          0 => 'byobagn_copyright_date_1432414621',
        ),
        'byobagn_title_and_tagline_1432390068' => 
        array (
          0 => 'byobagn_title_and_tagline_1432390068_thesis_site_title',
          1 => 'byobagn_title_and_tagline_1432390068_thesis_site_tagline',
        ),
        'byobagn_easy_header_1430603940' => 
        array (
          0 => 'byobagn_easy_header_1430603940_byobagn_column_1',
          1 => 'byobagn_easy_header_1430603940_byobagn_column_2',
        ),
        'byobagn_easy_header_1430603940_byobagn_column_1' => 
        array (
          0 => 'byobagn_phone_number_1430603941',
        ),
        'byobagn_easy_header_1430603940_byobagn_column_2' => 
        array (
          0 => 'byobagn_social_profile_links_1430603942',
        ),
        'byobagn_social_profile_links_1430603942' => 
        array (
          0 => 'byobagn_social_profile_links_1430603942_byobagn_twitter_link',
          1 => 'byobagn_social_profile_links_1430603942_byobagn_linkedin_link',
          2 => 'byobagn_social_profile_links_1430603942_byobagn_facebook_link',
          3 => 'byobagn_social_profile_links_1430603942_byobagn_stumbleupon_link',
          4 => 'byobagn_social_profile_links_1430603942_byobagn_googleplus_link',
          5 => 'byobagn_social_profile_links_1430603942_byobagn_pinterest_link',
          6 => 'byobagn_social_profile_links_1430603942_byobagn_instagram_link',
          7 => 'byobagn_social_profile_links_1430603942_byobagn_vimeo_link',
          8 => 'byobagn_social_profile_links_1430603942_byobagn_vine_link',
          9 => 'byobagn_social_profile_links_1430603942_byobagn_youtube_link',
          10 => 'byobagn_social_profile_links_1430603942_byobagn_flickr_link',
          11 => 'byobagn_social_profile_links_1430603942_byobagn_reddit_link',
          12 => 'byobagn_social_profile_links_1430603942_byobagn_tumblr_link',
          13 => 'byobagn_social_profile_links_1430603942_byobagn_slideshare_link',
          14 => 'byobagn_social_profile_links_1430603942_byobagn_custom1_link',
          15 => 'byobagn_social_profile_links_1430603942_byobagn_custom2_link',
        ),
        'byobagn_easy_header_1430343836' => 
        array (
          0 => 'byobagn_easy_header_1430343836_byobagn_column_1',
          1 => 'byobagn_easy_header_1430343836_byobagn_column_2',
        ),
        'byobagn_easy_header_1430343836_byobagn_column_1' => 
        array (
          0 => 'byobagn_header_image_1430343837',
        ),
        'byobagn_easy_header_1430343836_byobagn_column_2' => 
        array (
          0 => 'byobagn_title_and_tagline_1430343838',
        ),
        'byobagn_title_and_tagline_1430343838' => 
        array (
          0 => 'byobagn_title_and_tagline_1430343838_thesis_site_title',
          1 => 'byobagn_title_and_tagline_1430343838_thesis_site_tagline',
        ),
        'byobagn_easy_header_1432390067' => 
        array (
          0 => 'byobagn_easy_header_1432390067_byobagn_column_1',
        ),
        'byobagn_easy_header_1432390067_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_nav_menu_1432390068',
        ),
      ),
    ),
    'front' => 
    array (
      'options' => 
      array (
        'byobagn_match_height' => 
        array (
          'use_matchheight' => 
          array (
            'use' => true,
          ),
          'selector' => '.headline, .post_excerpt p',
        ),
      ),
      'boxes' => 
      array (
        'thesis_html_body' => 
        array (
          0 => 'byobagn_easy_header_1430603940',
          1 => 'byobagn_easy_header_1430343836',
          2 => 'byobagn_easy_header_1432390067',
          3 => 'byobagn_content_grid_1430400687',
          4 => 'byobagn_easy_responsive_columns_1430400569',
          5 => 'byobagn_content_grid_1430400755',
          6 => 'byobagn_content_grid_1430400845',
          7 => 'byobagn_content_grid_1431281911',
          8 => 'byobagn_easy_responsive_columns_1430690224',
          9 => 'byobagn_content_grid_1430344053',
          10 => 'byobagn_content_grid_1432414619',
        ),
        'byobagn_easy_header_1430603940' => 
        array (
          0 => 'byobagn_easy_header_1430603940_byobagn_column_1',
          1 => 'byobagn_easy_header_1430603940_byobagn_column_2',
        ),
        'byobagn_easy_header_1430603940_byobagn_column_1' => 
        array (
          0 => 'byobagn_phone_number_1430603941',
        ),
        'byobagn_easy_header_1430603940_byobagn_column_2' => 
        array (
          0 => 'byobagn_social_profile_links_1430603942',
        ),
        'byobagn_social_profile_links_1430603942' => 
        array (
          0 => 'byobagn_social_profile_links_1430603942_byobagn_twitter_link',
          1 => 'byobagn_social_profile_links_1430603942_byobagn_linkedin_link',
          2 => 'byobagn_social_profile_links_1430603942_byobagn_facebook_link',
          3 => 'byobagn_social_profile_links_1430603942_byobagn_stumbleupon_link',
          4 => 'byobagn_social_profile_links_1430603942_byobagn_googleplus_link',
          5 => 'byobagn_social_profile_links_1430603942_byobagn_pinterest_link',
          6 => 'byobagn_social_profile_links_1430603942_byobagn_instagram_link',
          7 => 'byobagn_social_profile_links_1430603942_byobagn_vimeo_link',
          8 => 'byobagn_social_profile_links_1430603942_byobagn_vine_link',
          9 => 'byobagn_social_profile_links_1430603942_byobagn_youtube_link',
          10 => 'byobagn_social_profile_links_1430603942_byobagn_flickr_link',
          11 => 'byobagn_social_profile_links_1430603942_byobagn_reddit_link',
          12 => 'byobagn_social_profile_links_1430603942_byobagn_tumblr_link',
          13 => 'byobagn_social_profile_links_1430603942_byobagn_slideshare_link',
          14 => 'byobagn_social_profile_links_1430603942_byobagn_custom1_link',
          15 => 'byobagn_social_profile_links_1430603942_byobagn_custom2_link',
        ),
        'byobagn_easy_header_1430343836' => 
        array (
          0 => 'byobagn_easy_header_1430343836_byobagn_column_1',
          1 => 'byobagn_easy_header_1430343836_byobagn_column_2',
        ),
        'byobagn_easy_header_1430343836_byobagn_column_1' => 
        array (
          0 => 'byobagn_header_image_1430343837',
        ),
        'byobagn_easy_header_1430343836_byobagn_column_2' => 
        array (
          0 => 'byobagn_title_and_tagline_1430343838',
        ),
        'byobagn_title_and_tagline_1430343838' => 
        array (
          0 => 'byobagn_title_and_tagline_1430343838_thesis_site_title',
          1 => 'byobagn_title_and_tagline_1430343838_thesis_site_tagline',
        ),
        'byobagn_easy_header_1432390067' => 
        array (
          0 => 'byobagn_easy_header_1432390067_byobagn_column_1',
        ),
        'byobagn_easy_header_1432390067_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_nav_menu_1432390068',
        ),
        'byobagn_content_grid_1430400687' => 
        array (
          0 => 'byobagn_content_grid_1430400687_byobagn_column_1',
        ),
        'byobagn_content_grid_1430400687_byobagn_column_1' => 
        array (
          0 => 'byobagn_call_to_action_1430400688',
        ),
        'byobagn_easy_responsive_columns_1430400569' => 
        array (
          0 => 'byobagn_easy_responsive_columns_1430400569_byobagn_column_1',
        ),
        'byobagn_easy_responsive_columns_1430400569_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_loop',
        ),
        'thesis_wp_loop' => 
        array (
          0 => 'byobagn_page_post_box_1430689835',
        ),
        'byobagn_page_post_box_1430689835' => 
        array (
          0 => 'byobagn_page_post_box_1430689835_byobagn_large_featured_image',
          1 => 'byobagn_page_post_box_1430689835_thesis_post_headline',
          2 => 'byobagn_page_post_box_1430689835_thesis_post_content',
        ),
        'byobagn_content_grid_1430400755' => 
        array (
          0 => 'byobagn_content_grid_1430400755_byobagn_column_1',
          1 => 'byobagn_content_grid_1430400755_byobagn_column_2',
          2 => 'byobagn_content_grid_1430400755_byobagn_column_3',
        ),
        'byobagn_content_grid_1430400755_byobagn_column_1' => 
        array (
          0 => 'byobagn_icon_query_box_1430400756',
        ),
        'byobagn_icon_query_box_1430400756' => 
        array (
          0 => 'byobagn_icon_query_box_1430400756_byobagn_dependent_icon_box',
          1 => 'byobagn_icon_query_box_1430400756_byobagn_featured_content_post_title',
          2 => 'byobagn_icon_query_box_1430400756_byobagn_typical_short_excerpt',
          3 => 'byobagn_icon_query_box_1430400756_byobagn_featured_content_read_more',
        ),
        'byobagn_content_grid_1430400755_byobagn_column_2' => 
        array (
          0 => 'byobagn_icon_query_box_1430400757',
        ),
        'byobagn_icon_query_box_1430400757' => 
        array (
          0 => 'byobagn_icon_query_box_1430400757_byobagn_dependent_icon_box',
          1 => 'byobagn_icon_query_box_1430400757_byobagn_featured_content_post_title',
          2 => 'byobagn_icon_query_box_1430400757_byobagn_typical_short_excerpt',
          3 => 'byobagn_icon_query_box_1430400757_byobagn_featured_content_read_more',
        ),
        'byobagn_content_grid_1430400755_byobagn_column_3' => 
        array (
          0 => 'byobagn_icon_query_box_1430400758',
        ),
        'byobagn_icon_query_box_1430400758' => 
        array (
          0 => 'byobagn_icon_query_box_1430400758_byobagn_dependent_icon_box',
          1 => 'byobagn_icon_query_box_1430400758_byobagn_featured_content_post_title',
          2 => 'byobagn_icon_query_box_1430400758_byobagn_typical_short_excerpt',
          3 => 'byobagn_icon_query_box_1430400758_byobagn_featured_content_read_more',
        ),
        'byobagn_content_grid_1430400845' => 
        array (
          0 => 'byobagn_content_grid_1430400845_byobagn_column_1',
          1 => 'byobagn_content_grid_1430400845_byobagn_column_2',
          2 => 'byobagn_content_grid_1430400845_byobagn_column_3',
        ),
        'byobagn_content_grid_1430400845_byobagn_column_1' => 
        array (
          0 => 'byobagn_featured_content_query_box_1430400846',
        ),
        'byobagn_featured_content_query_box_1430400846' => 
        array (
          0 => 'byobagn_featured_content_query_box_1430400846_byobagn_featured_content_featured_image',
          1 => 'byobagn_featured_content_query_box_1430400846_byobagn_featured_content_post_title',
          2 => 'byobagn_featured_content_query_box_1430400846_byobagn_typical_excerpt',
          3 => 'byobagn_featured_content_query_box_1430400846_byobagn_featured_content_read_more',
        ),
        'byobagn_content_grid_1430400845_byobagn_column_2' => 
        array (
          0 => 'byobagn_featured_content_query_box_1430400847',
        ),
        'byobagn_featured_content_query_box_1430400847' => 
        array (
          0 => 'byobagn_featured_content_query_box_1430400847_byobagn_featured_content_featured_image',
          1 => 'byobagn_featured_content_query_box_1430400847_byobagn_featured_content_post_title',
          2 => 'byobagn_featured_content_query_box_1430400847_byobagn_typical_excerpt',
          3 => 'byobagn_featured_content_query_box_1430400847_byobagn_featured_content_read_more',
        ),
        'byobagn_content_grid_1430400845_byobagn_column_3' => 
        array (
          0 => 'byobagn_featured_content_query_box_1430400848',
        ),
        'byobagn_featured_content_query_box_1430400848' => 
        array (
          0 => 'byobagn_featured_content_query_box_1430400848_byobagn_featured_content_featured_image',
          1 => 'byobagn_featured_content_query_box_1430400848_byobagn_featured_content_post_title',
          2 => 'byobagn_featured_content_query_box_1430400848_byobagn_typical_excerpt',
          3 => 'byobagn_featured_content_query_box_1430400848_byobagn_featured_content_read_more',
        ),
        'byobagn_content_grid_1431281911' => 
        array (
          0 => 'byobagn_content_grid_1431281911_byobagn_column_1',
        ),
        'byobagn_content_grid_1431281911_byobagn_column_1' => 
        array (
          0 => 'byobagn_call_to_action_1431281912',
        ),
        'byobagn_easy_responsive_columns_1430690224' => 
        array (
          0 => 'byobagn_easy_responsive_columns_1430690224_byobagn_column_1',
        ),
        'byobagn_easy_responsive_columns_1430690224_byobagn_column_1' => 
        array (
          0 => 'byobagn_social_sharing_links_1430690299',
        ),
        'byobagn_social_sharing_links_1430690299' => 
        array (
          0 => 'byobagn_social_sharing_links_1430690299_byobagn_twitter_sharing_link',
          1 => 'byobagn_social_sharing_links_1430690299_byobagn_facebook_sharing_link',
          2 => 'byobagn_social_sharing_links_1430690299_byobagn_linkedin_sharing_link',
          3 => 'byobagn_social_sharing_links_1430690299_byobagn_stumbleupon_sharing_link',
          4 => 'byobagn_social_sharing_links_1430690299_byobagn_googleplus_sharing_link',
          5 => 'byobagn_social_sharing_links_1430690299_byobagn_pinterest_sharing_link',
          6 => 'byobagn_social_sharing_links_1430690299_byobagn_reddit_sharing_link',
          7 => 'byobagn_social_sharing_links_1430690299_byobagn_tumblr_sharing_link',
        ),
        'byobagn_content_grid_1430344053' => 
        array (
          0 => 'byobagn_content_grid_1430344053_byobagn_column_1',
          1 => 'byobagn_content_grid_1430344053_byobagn_column_2',
          2 => 'byobagn_content_grid_1430344053_byobagn_column_3',
          3 => 'byobagn_content_grid_1430344053_byobagn_column_4',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_widgets_1430344054',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_2' => 
        array (
          0 => 'byobagn_enhanced_query_box_1433346455',
        ),
        'byobagn_enhanced_query_box_1433346455' => 
        array (
          0 => 'byobagn_enhanced_query_box_1433346455_byobagn_featured_content_featured_image',
        ),
        'byobagn_enhanced_query_box_1433346455_byobagn_enhanced_query_box_content_wrapper' => 
        array (
          0 => 'byobagn_enhanced_query_box_1433346455_byobagn_enhanced_query_box_content_wrapper_byobagn_typical_excerpt',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_3' => 
        array (
          0 => 'thesis_wp_widgets_1430344056',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_4' => 
        array (
          0 => 'thesis_wp_widgets_1430344057',
        ),
        'byobagn_content_grid_1432414619' => 
        array (
          0 => 'byobagn_content_grid_1432414619_byobagn_column_1',
          1 => 'byobagn_content_grid_1432414619_byobagn_column_2',
        ),
        'byobagn_content_grid_1432414619_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_nav_menu_1432414620',
        ),
        'byobagn_content_grid_1432414619_byobagn_column_2' => 
        array (
          0 => 'byobagn_copyright_date_1432414621',
        ),
      ),
    ),
    'custom_1356744491' => 
    array (
      'title' => 'No Sidebars',
      'options' => 
      array (
        'byobagn_match_height' => 
        array (
          'use_matchheight' => 
          array (
            'use' => true,
          ),
          'selector' => '.headline',
        ),
      ),
      'boxes' => 
      array (
        'thesis_html_body' => 
        array (
          0 => 'byobagn_easy_header_1430603940',
          1 => 'byobagn_easy_header_1430343836',
          2 => 'byobagn_easy_header_1432390067',
          3 => 'byobagn_easy_responsive_columns_1430400569',
          4 => 'byobagn_content_grid_1430344053',
          5 => 'byobagn_content_grid_1432414619',
        ),
        'byobagn_easy_responsive_columns_1430400569' => 
        array (
          0 => 'byobagn_easy_responsive_columns_1430400569_byobagn_column_1',
        ),
        'byobagn_easy_responsive_columns_1430400569_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_loop',
        ),
        'thesis_wp_loop' => 
        array (
          0 => 'byobagn_page_post_box_1430689835',
        ),
        'byobagn_page_post_box_1430689835' => 
        array (
          0 => 'byobagn_page_post_box_1430689835_byobagn_large_featured_image',
          1 => 'byobagn_page_post_box_1430689835_thesis_post_headline',
          2 => 'byobagn_page_post_box_1430689835_thesis_post_content',
        ),
        'byobagn_enhanced_query_box_1433346455_byobagn_enhanced_query_box_content_wrapper' => 
        array (
          0 => 'byobagn_enhanced_query_box_1433346455_byobagn_enhanced_query_box_content_wrapper_byobagn_typical_excerpt',
        ),
        'byobagn_title_and_tagline_1432390068' => 
        array (
          0 => 'byobagn_title_and_tagline_1432390068_thesis_site_title',
          1 => 'byobagn_title_and_tagline_1432390068_thesis_site_tagline',
        ),
        'byobagn_content_grid_1430344053' => 
        array (
          0 => 'byobagn_content_grid_1430344053_byobagn_column_1',
          1 => 'byobagn_content_grid_1430344053_byobagn_column_2',
          2 => 'byobagn_content_grid_1430344053_byobagn_column_3',
          3 => 'byobagn_content_grid_1430344053_byobagn_column_4',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_widgets_1430344054',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_2' => 
        array (
          0 => 'byobagn_enhanced_query_box_1433346455',
        ),
        'byobagn_enhanced_query_box_1433346455' => 
        array (
          0 => 'byobagn_enhanced_query_box_1433346455_byobagn_featured_content_featured_image',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_3' => 
        array (
          0 => 'thesis_wp_widgets_1430344056',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_4' => 
        array (
          0 => 'thesis_wp_widgets_1430344057',
        ),
        'byobagn_content_grid_1432414619' => 
        array (
          0 => 'byobagn_content_grid_1432414619_byobagn_column_1',
          1 => 'byobagn_content_grid_1432414619_byobagn_column_2',
        ),
        'byobagn_content_grid_1432414619_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_nav_menu_1432414620',
        ),
        'byobagn_content_grid_1432414619_byobagn_column_2' => 
        array (
          0 => 'byobagn_copyright_date_1432414621',
        ),
        'byobagn_easy_header_1430603940' => 
        array (
          0 => 'byobagn_easy_header_1430603940_byobagn_column_1',
          1 => 'byobagn_easy_header_1430603940_byobagn_column_2',
        ),
        'byobagn_easy_header_1430603940_byobagn_column_1' => 
        array (
          0 => 'byobagn_phone_number_1430603941',
        ),
        'byobagn_easy_header_1430603940_byobagn_column_2' => 
        array (
          0 => 'byobagn_social_profile_links_1430603942',
        ),
        'byobagn_social_profile_links_1430603942' => 
        array (
          0 => 'byobagn_social_profile_links_1430603942_byobagn_twitter_link',
          1 => 'byobagn_social_profile_links_1430603942_byobagn_linkedin_link',
          2 => 'byobagn_social_profile_links_1430603942_byobagn_facebook_link',
          3 => 'byobagn_social_profile_links_1430603942_byobagn_stumbleupon_link',
          4 => 'byobagn_social_profile_links_1430603942_byobagn_googleplus_link',
          5 => 'byobagn_social_profile_links_1430603942_byobagn_pinterest_link',
          6 => 'byobagn_social_profile_links_1430603942_byobagn_instagram_link',
          7 => 'byobagn_social_profile_links_1430603942_byobagn_vimeo_link',
          8 => 'byobagn_social_profile_links_1430603942_byobagn_vine_link',
          9 => 'byobagn_social_profile_links_1430603942_byobagn_youtube_link',
          10 => 'byobagn_social_profile_links_1430603942_byobagn_flickr_link',
          11 => 'byobagn_social_profile_links_1430603942_byobagn_reddit_link',
          12 => 'byobagn_social_profile_links_1430603942_byobagn_tumblr_link',
          13 => 'byobagn_social_profile_links_1430603942_byobagn_slideshare_link',
          14 => 'byobagn_social_profile_links_1430603942_byobagn_custom1_link',
          15 => 'byobagn_social_profile_links_1430603942_byobagn_custom2_link',
        ),
        'byobagn_easy_header_1430343836' => 
        array (
          0 => 'byobagn_easy_header_1430343836_byobagn_column_1',
          1 => 'byobagn_easy_header_1430343836_byobagn_column_2',
        ),
        'byobagn_easy_header_1430343836_byobagn_column_1' => 
        array (
          0 => 'byobagn_header_image_1430343837',
        ),
        'byobagn_easy_header_1430343836_byobagn_column_2' => 
        array (
          0 => 'byobagn_title_and_tagline_1430343838',
        ),
        'byobagn_title_and_tagline_1430343838' => 
        array (
          0 => 'byobagn_title_and_tagline_1430343838_thesis_site_title',
          1 => 'byobagn_title_and_tagline_1430343838_thesis_site_tagline',
        ),
        'byobagn_easy_header_1432390067' => 
        array (
          0 => 'byobagn_easy_header_1432390067_byobagn_column_1',
        ),
        'byobagn_easy_header_1432390067_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_nav_menu_1432390068',
        ),
      ),
    ),
    'custom_1400769645' => 
    array (
      'title' => 'Page Without Social Media',
      'options' => 
      array (
        'byobagn_match_height' => 
        array (
          'use_matchheight' => 
          array (
            'use' => true,
          ),
        ),
      ),
      'boxes' => 
      array (
        'thesis_html_body' => 
        array (
          0 => 'byobagn_easy_header_1430603940',
          1 => 'byobagn_easy_header_1430343836',
          2 => 'byobagn_easy_header_1432390067',
          3 => 'byobagn_easy_responsive_columns_1430344266',
          4 => 'byobagn_content_grid_1430344053',
          5 => 'byobagn_content_grid_1432414619',
        ),
        'byobagn_easy_responsive_columns_1430344266' => 
        array (
          0 => 'byobagn_easy_responsive_columns_1430344266_byobagn_column_1',
          1 => 'byobagn_easy_responsive_columns_1430344266_byobagn_column_2',
        ),
        'byobagn_easy_responsive_columns_1430344266_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_loop',
        ),
        'thesis_wp_loop' => 
        array (
          0 => 'byobagn_page_post_box_1430689835',
        ),
        'byobagn_page_post_box_1430689835' => 
        array (
          0 => 'byobagn_page_post_box_1430689835_byobagn_large_featured_image',
          1 => 'byobagn_page_post_box_1430689835_thesis_post_headline',
          2 => 'byobagn_page_post_box_1430689835_thesis_post_content',
        ),
        'byobagn_easy_responsive_columns_1430344266_byobagn_column_2' => 
        array (
          0 => 'thesis_wp_widgets_1430344421',
        ),
        'byobagn_enhanced_query_box_1433346455_byobagn_enhanced_query_box_content_wrapper' => 
        array (
          0 => 'byobagn_enhanced_query_box_1433346455_byobagn_enhanced_query_box_content_wrapper_byobagn_typical_excerpt',
        ),
        'byobagn_title_and_tagline_1432390068' => 
        array (
          0 => 'byobagn_title_and_tagline_1432390068_thesis_site_title',
          1 => 'byobagn_title_and_tagline_1432390068_thesis_site_tagline',
        ),
        'byobagn_content_grid_1430344053' => 
        array (
          0 => 'byobagn_content_grid_1430344053_byobagn_column_1',
          1 => 'byobagn_content_grid_1430344053_byobagn_column_2',
          2 => 'byobagn_content_grid_1430344053_byobagn_column_3',
          3 => 'byobagn_content_grid_1430344053_byobagn_column_4',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_widgets_1430344054',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_2' => 
        array (
          0 => 'byobagn_enhanced_query_box_1433346455',
        ),
        'byobagn_enhanced_query_box_1433346455' => 
        array (
          0 => 'byobagn_enhanced_query_box_1433346455_byobagn_featured_content_featured_image',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_3' => 
        array (
          0 => 'thesis_wp_widgets_1430344056',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_4' => 
        array (
          0 => 'thesis_wp_widgets_1430344057',
        ),
        'byobagn_content_grid_1432414619' => 
        array (
          0 => 'byobagn_content_grid_1432414619_byobagn_column_1',
          1 => 'byobagn_content_grid_1432414619_byobagn_column_2',
        ),
        'byobagn_content_grid_1432414619_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_nav_menu_1432414620',
        ),
        'byobagn_content_grid_1432414619_byobagn_column_2' => 
        array (
          0 => 'byobagn_copyright_date_1432414621',
        ),
        'byobagn_easy_header_1430603940' => 
        array (
          0 => 'byobagn_easy_header_1430603940_byobagn_column_1',
          1 => 'byobagn_easy_header_1430603940_byobagn_column_2',
        ),
        'byobagn_easy_header_1430603940_byobagn_column_1' => 
        array (
          0 => 'byobagn_phone_number_1430603941',
        ),
        'byobagn_easy_header_1430603940_byobagn_column_2' => 
        array (
          0 => 'byobagn_social_profile_links_1430603942',
        ),
        'byobagn_social_profile_links_1430603942' => 
        array (
          0 => 'byobagn_social_profile_links_1430603942_byobagn_twitter_link',
          1 => 'byobagn_social_profile_links_1430603942_byobagn_linkedin_link',
          2 => 'byobagn_social_profile_links_1430603942_byobagn_facebook_link',
          3 => 'byobagn_social_profile_links_1430603942_byobagn_stumbleupon_link',
          4 => 'byobagn_social_profile_links_1430603942_byobagn_googleplus_link',
          5 => 'byobagn_social_profile_links_1430603942_byobagn_pinterest_link',
          6 => 'byobagn_social_profile_links_1430603942_byobagn_instagram_link',
          7 => 'byobagn_social_profile_links_1430603942_byobagn_vimeo_link',
          8 => 'byobagn_social_profile_links_1430603942_byobagn_vine_link',
          9 => 'byobagn_social_profile_links_1430603942_byobagn_youtube_link',
          10 => 'byobagn_social_profile_links_1430603942_byobagn_flickr_link',
          11 => 'byobagn_social_profile_links_1430603942_byobagn_reddit_link',
          12 => 'byobagn_social_profile_links_1430603942_byobagn_tumblr_link',
          13 => 'byobagn_social_profile_links_1430603942_byobagn_slideshare_link',
          14 => 'byobagn_social_profile_links_1430603942_byobagn_custom1_link',
          15 => 'byobagn_social_profile_links_1430603942_byobagn_custom2_link',
        ),
        'byobagn_easy_header_1430343836' => 
        array (
          0 => 'byobagn_easy_header_1430343836_byobagn_column_1',
          1 => 'byobagn_easy_header_1430343836_byobagn_column_2',
        ),
        'byobagn_easy_header_1430343836_byobagn_column_1' => 
        array (
          0 => 'byobagn_header_image_1430343837',
        ),
        'byobagn_easy_header_1430343836_byobagn_column_2' => 
        array (
          0 => 'byobagn_title_and_tagline_1430343838',
        ),
        'byobagn_title_and_tagline_1430343838' => 
        array (
          0 => 'byobagn_title_and_tagline_1430343838_thesis_site_title',
          1 => 'byobagn_title_and_tagline_1430343838_thesis_site_tagline',
        ),
        'byobagn_easy_header_1432390067' => 
        array (
          0 => 'byobagn_easy_header_1432390067_byobagn_column_1',
        ),
        'byobagn_easy_header_1432390067_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_nav_menu_1432390068',
        ),
      ),
    ),
    'custom_1425507363' => 
    array (
      'title' => 'Fluid Grid - Full Width',
      'options' => 
      array (
        'thesis_wp_loop' => 
        array (
          'posts_per_page' => '9',
        ),
        'byobagn_match_height' => 
        array (
          'use_matchheight' => 
          array (
            'use' => true,
          ),
        ),
      ),
      'boxes' => 
      array (
        'thesis_html_body' => 
        array (
          0 => 'byobagn_easy_header_1430603940',
          1 => 'byobagn_easy_header_1430343836',
          2 => 'byobagn_easy_header_1432390067',
          3 => 'byobagn_easy_responsive_columns_1430400569',
          4 => 'byobagn_easy_responsive_columns_1430690224',
          5 => 'byobagn_content_grid_1430344053',
          6 => 'byobagn_content_grid_1432414619',
        ),
        'byobagn_easy_responsive_columns_1430400569' => 
        array (
          0 => 'byobagn_easy_responsive_columns_1430400569_byobagn_column_1',
          1 => 'byobagn_fluid_grid_wrapper_1431292325',
          2 => 'byobagn_sub_columns_1430949087',
        ),
        'byobagn_easy_responsive_columns_1430400569_byobagn_column_1' => 
        array (
          0 => 'thesis_archive_title',
          1 => 'thesis_archive_content',
        ),
        'byobagn_fluid_grid_wrapper_1431292325' => 
        array (
          0 => 'thesis_wp_loop',
        ),
        'thesis_wp_loop' => 
        array (
          0 => 'byobagn_fluid_grid_post_box_1431292345',
        ),
        'byobagn_fluid_grid_post_box_1431292345' => 
        array (
          0 => 'byobagn_fluid_grid_post_box_1431292345_byobagn_featured_content_featured_image',
          1 => 'byobagn_fluid_grid_post_box_1431292345_byobagn_featured_content_post_title',
          2 => 'byobagn_fluid_grid_post_box_1431292345_byobagn_typical_excerpt',
          3 => 'byobagn_fluid_grid_post_box_1431292345_byobagn_featured_content_read_more',
        ),
        'byobagn_sub_columns_1430949087' => 
        array (
          0 => 'byobagn_sub_columns_1430949087_byobagn_column_1',
          1 => 'byobagn_sub_columns_1430949087_byobagn_column_2',
        ),
        'byobagn_sub_columns_1430949087_byobagn_column_1' => 
        array (
          0 => 'thesis_previous_posts_link',
        ),
        'byobagn_sub_columns_1430949087_byobagn_column_2' => 
        array (
          0 => 'thesis_next_posts_link',
        ),
        'byobagn_easy_responsive_columns_1430690224' => 
        array (
          0 => 'byobagn_easy_responsive_columns_1430690224_byobagn_column_1',
        ),
        'byobagn_easy_responsive_columns_1430690224_byobagn_column_1' => 
        array (
          0 => 'byobagn_social_sharing_links_1430690299',
        ),
        'byobagn_social_sharing_links_1430690299' => 
        array (
          0 => 'byobagn_social_sharing_links_1430690299_byobagn_twitter_sharing_link',
          1 => 'byobagn_social_sharing_links_1430690299_byobagn_facebook_sharing_link',
          2 => 'byobagn_social_sharing_links_1430690299_byobagn_linkedin_sharing_link',
          3 => 'byobagn_social_sharing_links_1430690299_byobagn_stumbleupon_sharing_link',
          4 => 'byobagn_social_sharing_links_1430690299_byobagn_googleplus_sharing_link',
          5 => 'byobagn_social_sharing_links_1430690299_byobagn_pinterest_sharing_link',
          6 => 'byobagn_social_sharing_links_1430690299_byobagn_reddit_sharing_link',
          7 => 'byobagn_social_sharing_links_1430690299_byobagn_tumblr_sharing_link',
        ),
        'byobagn_enhanced_query_box_1433346455_byobagn_enhanced_query_box_content_wrapper' => 
        array (
          0 => 'byobagn_enhanced_query_box_1433346455_byobagn_enhanced_query_box_content_wrapper_byobagn_typical_excerpt',
        ),
        'byobagn_title_and_tagline_1432390068' => 
        array (
          0 => 'byobagn_title_and_tagline_1432390068_thesis_site_title',
          1 => 'byobagn_title_and_tagline_1432390068_thesis_site_tagline',
        ),
        'byobagn_content_grid_1430344053' => 
        array (
          0 => 'byobagn_content_grid_1430344053_byobagn_column_1',
          1 => 'byobagn_content_grid_1430344053_byobagn_column_2',
          2 => 'byobagn_content_grid_1430344053_byobagn_column_3',
          3 => 'byobagn_content_grid_1430344053_byobagn_column_4',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_widgets_1430344054',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_2' => 
        array (
          0 => 'byobagn_enhanced_query_box_1433346455',
        ),
        'byobagn_enhanced_query_box_1433346455' => 
        array (
          0 => 'byobagn_enhanced_query_box_1433346455_byobagn_featured_content_featured_image',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_3' => 
        array (
          0 => 'thesis_wp_widgets_1430344056',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_4' => 
        array (
          0 => 'thesis_wp_widgets_1430344057',
        ),
        'byobagn_content_grid_1432414619' => 
        array (
          0 => 'byobagn_content_grid_1432414619_byobagn_column_1',
          1 => 'byobagn_content_grid_1432414619_byobagn_column_2',
        ),
        'byobagn_content_grid_1432414619_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_nav_menu_1432414620',
        ),
        'byobagn_content_grid_1432414619_byobagn_column_2' => 
        array (
          0 => 'byobagn_copyright_date_1432414621',
        ),
        'byobagn_easy_header_1430603940' => 
        array (
          0 => 'byobagn_easy_header_1430603940_byobagn_column_1',
          1 => 'byobagn_easy_header_1430603940_byobagn_column_2',
        ),
        'byobagn_easy_header_1430603940_byobagn_column_1' => 
        array (
          0 => 'byobagn_phone_number_1430603941',
        ),
        'byobagn_easy_header_1430603940_byobagn_column_2' => 
        array (
          0 => 'byobagn_social_profile_links_1430603942',
        ),
        'byobagn_social_profile_links_1430603942' => 
        array (
          0 => 'byobagn_social_profile_links_1430603942_byobagn_twitter_link',
          1 => 'byobagn_social_profile_links_1430603942_byobagn_linkedin_link',
          2 => 'byobagn_social_profile_links_1430603942_byobagn_facebook_link',
          3 => 'byobagn_social_profile_links_1430603942_byobagn_stumbleupon_link',
          4 => 'byobagn_social_profile_links_1430603942_byobagn_googleplus_link',
          5 => 'byobagn_social_profile_links_1430603942_byobagn_pinterest_link',
          6 => 'byobagn_social_profile_links_1430603942_byobagn_instagram_link',
          7 => 'byobagn_social_profile_links_1430603942_byobagn_vimeo_link',
          8 => 'byobagn_social_profile_links_1430603942_byobagn_vine_link',
          9 => 'byobagn_social_profile_links_1430603942_byobagn_youtube_link',
          10 => 'byobagn_social_profile_links_1430603942_byobagn_flickr_link',
          11 => 'byobagn_social_profile_links_1430603942_byobagn_reddit_link',
          12 => 'byobagn_social_profile_links_1430603942_byobagn_tumblr_link',
          13 => 'byobagn_social_profile_links_1430603942_byobagn_slideshare_link',
          14 => 'byobagn_social_profile_links_1430603942_byobagn_custom1_link',
          15 => 'byobagn_social_profile_links_1430603942_byobagn_custom2_link',
        ),
        'byobagn_easy_header_1430343836' => 
        array (
          0 => 'byobagn_easy_header_1430343836_byobagn_column_1',
          1 => 'byobagn_easy_header_1430343836_byobagn_column_2',
        ),
        'byobagn_easy_header_1430343836_byobagn_column_1' => 
        array (
          0 => 'byobagn_header_image_1430343837',
        ),
        'byobagn_easy_header_1430343836_byobagn_column_2' => 
        array (
          0 => 'byobagn_title_and_tagline_1430343838',
        ),
        'byobagn_title_and_tagline_1430343838' => 
        array (
          0 => 'byobagn_title_and_tagline_1430343838_thesis_site_title',
          1 => 'byobagn_title_and_tagline_1430343838_thesis_site_tagline',
        ),
        'byobagn_easy_header_1432390067' => 
        array (
          0 => 'byobagn_easy_header_1432390067_byobagn_column_1',
        ),
        'byobagn_easy_header_1432390067_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_nav_menu_1432390068',
        ),
      ),
    ),
    'custom_1425507510' => 
    array (
      'title' => 'Fluid Grid - 2 Column',
      'options' => 
      array (
        'byobagn_match_height' => 
        array (
          'use_matchheight' => 
          array (
            'use' => true,
          ),
        ),
      ),
      'boxes' => 
      array (
        'thesis_html_body' => 
        array (
          0 => 'byobagn_easy_header_1430603940',
          1 => 'byobagn_easy_header_1430343836',
          2 => 'byobagn_easy_header_1432390067',
          3 => 'byobagn_easy_responsive_columns_1430344266',
          4 => 'byobagn_easy_responsive_columns_1430690224',
          5 => 'byobagn_content_grid_1430344053',
          6 => 'byobagn_content_grid_1432414619',
        ),
        'byobagn_easy_responsive_columns_1430344266' => 
        array (
          0 => 'byobagn_easy_responsive_columns_1430344266_byobagn_column_1',
          1 => 'byobagn_easy_responsive_columns_1430344266_byobagn_column_2',
        ),
        'byobagn_easy_responsive_columns_1430344266_byobagn_column_1' => 
        array (
          0 => 'thesis_archive_title',
          1 => 'thesis_archive_content',
          2 => 'byobagn_fluid_grid_wrapper_1431292325',
          3 => 'byobagn_thesis_email_signup_call_to_action_1430918094',
          4 => 'byobagn_sub_columns_1430949087',
        ),
        'byobagn_fluid_grid_wrapper_1431292325' => 
        array (
          0 => 'thesis_wp_loop',
        ),
        'thesis_wp_loop' => 
        array (
          0 => 'byobagn_fluid_grid_post_box_1431293063',
        ),
        'byobagn_fluid_grid_post_box_1431293063' => 
        array (
          0 => 'byobagn_fluid_grid_post_box_1431293063_byobagn_featured_content_featured_image',
          1 => 'byobagn_fluid_grid_post_box_1431293063_byobagn_featured_content_post_title',
          2 => 'byobagn_fluid_grid_post_box_1431293063_byobagn_typical_excerpt',
          3 => 'byobagn_fluid_grid_post_box_1431293063_byobagn_featured_content_read_more',
        ),
        'byobagn_thesis_email_signup_call_to_action_1430918094' => 
        array (
          0 => 'thesis_aweber_form_1430918200',
        ),
        'thesis_aweber_form_1430918200' => 
        array (
          0 => 'thesis_aweber_form_1430918200_thesis_aweber_name',
          1 => 'thesis_aweber_form_1430918200_thesis_aweber_email',
          2 => 'thesis_aweber_form_1430918200_thesis_aweber_submit',
        ),
        'byobagn_sub_columns_1430949087' => 
        array (
          0 => 'byobagn_sub_columns_1430949087_byobagn_column_1',
          1 => 'byobagn_sub_columns_1430949087_byobagn_column_2',
        ),
        'byobagn_sub_columns_1430949087_byobagn_column_1' => 
        array (
          0 => 'thesis_previous_posts_link',
        ),
        'byobagn_sub_columns_1430949087_byobagn_column_2' => 
        array (
          0 => 'thesis_next_posts_link',
        ),
        'byobagn_easy_responsive_columns_1430344266_byobagn_column_2' => 
        array (
          0 => 'byobagn_thesis_email_signup_call_to_action_1430917553',
          1 => 'byobagn_social_profile_links_1430348701',
          2 => 'thesis_wp_widgets_1430344421',
        ),
        'byobagn_thesis_email_signup_call_to_action_1430917553' => 
        array (
          0 => 'thesis_aweber_form_1430840195',
        ),
        'thesis_aweber_form_1430840195' => 
        array (
          0 => 'thesis_aweber_form_1430840195_thesis_aweber_name',
          1 => 'thesis_aweber_form_1430840195_thesis_aweber_email',
          2 => 'thesis_aweber_form_1430840195_thesis_aweber_submit',
        ),
        'byobagn_social_profile_links_1430348701' => 
        array (
          0 => 'byobagn_social_profile_links_1430348701_byobagn_twitter_link',
          1 => 'byobagn_social_profile_links_1430348701_byobagn_facebook_link',
          2 => 'byobagn_social_profile_links_1430348701_byobagn_linkedin_link',
          3 => 'byobagn_social_profile_links_1430348701_byobagn_stumbleupon_link',
          4 => 'byobagn_social_profile_links_1430348701_byobagn_googleplus_link',
          5 => 'byobagn_social_profile_links_1430348701_byobagn_pinterest_link',
          6 => 'byobagn_social_profile_links_1430348701_byobagn_instagram_link',
          7 => 'byobagn_social_profile_links_1430348701_byobagn_youtube_link',
          8 => 'byobagn_social_profile_links_1430348701_byobagn_vimeo_link',
          9 => 'byobagn_social_profile_links_1430348701_byobagn_vine_link',
          10 => 'byobagn_social_profile_links_1430348701_byobagn_flickr_link',
          11 => 'byobagn_social_profile_links_1430348701_byobagn_reddit_link',
          12 => 'byobagn_social_profile_links_1430348701_byobagn_tumblr_link',
          13 => 'byobagn_social_profile_links_1430348701_byobagn_slideshare_link',
          14 => 'byobagn_social_profile_links_1430348701_byobagn_custom1_link',
          15 => 'byobagn_social_profile_links_1430348701_byobagn_custom2_link',
        ),
        'byobagn_easy_responsive_columns_1430690224' => 
        array (
          0 => 'byobagn_easy_responsive_columns_1430690224_byobagn_column_1',
        ),
        'byobagn_easy_responsive_columns_1430690224_byobagn_column_1' => 
        array (
          0 => 'byobagn_social_sharing_links_1430690299',
        ),
        'byobagn_social_sharing_links_1430690299' => 
        array (
          0 => 'byobagn_social_sharing_links_1430690299_byobagn_twitter_sharing_link',
          1 => 'byobagn_social_sharing_links_1430690299_byobagn_facebook_sharing_link',
          2 => 'byobagn_social_sharing_links_1430690299_byobagn_linkedin_sharing_link',
          3 => 'byobagn_social_sharing_links_1430690299_byobagn_stumbleupon_sharing_link',
          4 => 'byobagn_social_sharing_links_1430690299_byobagn_googleplus_sharing_link',
          5 => 'byobagn_social_sharing_links_1430690299_byobagn_pinterest_sharing_link',
          6 => 'byobagn_social_sharing_links_1430690299_byobagn_reddit_sharing_link',
          7 => 'byobagn_social_sharing_links_1430690299_byobagn_tumblr_sharing_link',
        ),
        'byobagn_enhanced_query_box_1433346455_byobagn_enhanced_query_box_content_wrapper' => 
        array (
          0 => 'byobagn_enhanced_query_box_1433346455_byobagn_enhanced_query_box_content_wrapper_byobagn_typical_excerpt',
        ),
        'byobagn_title_and_tagline_1432390068' => 
        array (
          0 => 'byobagn_title_and_tagline_1432390068_thesis_site_title',
          1 => 'byobagn_title_and_tagline_1432390068_thesis_site_tagline',
        ),
        'byobagn_content_grid_1430344053' => 
        array (
          0 => 'byobagn_content_grid_1430344053_byobagn_column_1',
          1 => 'byobagn_content_grid_1430344053_byobagn_column_2',
          2 => 'byobagn_content_grid_1430344053_byobagn_column_3',
          3 => 'byobagn_content_grid_1430344053_byobagn_column_4',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_widgets_1430344054',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_2' => 
        array (
          0 => 'byobagn_enhanced_query_box_1433346455',
        ),
        'byobagn_enhanced_query_box_1433346455' => 
        array (
          0 => 'byobagn_enhanced_query_box_1433346455_byobagn_featured_content_featured_image',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_3' => 
        array (
          0 => 'thesis_wp_widgets_1430344056',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_4' => 
        array (
          0 => 'thesis_wp_widgets_1430344057',
        ),
        'byobagn_content_grid_1432414619' => 
        array (
          0 => 'byobagn_content_grid_1432414619_byobagn_column_1',
          1 => 'byobagn_content_grid_1432414619_byobagn_column_2',
        ),
        'byobagn_content_grid_1432414619_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_nav_menu_1432414620',
        ),
        'byobagn_content_grid_1432414619_byobagn_column_2' => 
        array (
          0 => 'byobagn_copyright_date_1432414621',
        ),
        'byobagn_easy_header_1430603940' => 
        array (
          0 => 'byobagn_easy_header_1430603940_byobagn_column_1',
          1 => 'byobagn_easy_header_1430603940_byobagn_column_2',
        ),
        'byobagn_easy_header_1430603940_byobagn_column_1' => 
        array (
          0 => 'byobagn_phone_number_1430603941',
        ),
        'byobagn_easy_header_1430603940_byobagn_column_2' => 
        array (
          0 => 'byobagn_social_profile_links_1430603942',
        ),
        'byobagn_social_profile_links_1430603942' => 
        array (
          0 => 'byobagn_social_profile_links_1430603942_byobagn_twitter_link',
          1 => 'byobagn_social_profile_links_1430603942_byobagn_linkedin_link',
          2 => 'byobagn_social_profile_links_1430603942_byobagn_facebook_link',
          3 => 'byobagn_social_profile_links_1430603942_byobagn_stumbleupon_link',
          4 => 'byobagn_social_profile_links_1430603942_byobagn_googleplus_link',
          5 => 'byobagn_social_profile_links_1430603942_byobagn_pinterest_link',
          6 => 'byobagn_social_profile_links_1430603942_byobagn_instagram_link',
          7 => 'byobagn_social_profile_links_1430603942_byobagn_vimeo_link',
          8 => 'byobagn_social_profile_links_1430603942_byobagn_vine_link',
          9 => 'byobagn_social_profile_links_1430603942_byobagn_youtube_link',
          10 => 'byobagn_social_profile_links_1430603942_byobagn_flickr_link',
          11 => 'byobagn_social_profile_links_1430603942_byobagn_reddit_link',
          12 => 'byobagn_social_profile_links_1430603942_byobagn_tumblr_link',
          13 => 'byobagn_social_profile_links_1430603942_byobagn_slideshare_link',
          14 => 'byobagn_social_profile_links_1430603942_byobagn_custom1_link',
          15 => 'byobagn_social_profile_links_1430603942_byobagn_custom2_link',
        ),
        'byobagn_easy_header_1430343836' => 
        array (
          0 => 'byobagn_easy_header_1430343836_byobagn_column_1',
          1 => 'byobagn_easy_header_1430343836_byobagn_column_2',
        ),
        'byobagn_easy_header_1430343836_byobagn_column_1' => 
        array (
          0 => 'byobagn_header_image_1430343837',
        ),
        'byobagn_easy_header_1430343836_byobagn_column_2' => 
        array (
          0 => 'byobagn_title_and_tagline_1430343838',
        ),
        'byobagn_title_and_tagline_1430343838' => 
        array (
          0 => 'byobagn_title_and_tagline_1430343838_thesis_site_title',
          1 => 'byobagn_title_and_tagline_1430343838_thesis_site_tagline',
        ),
        'byobagn_easy_header_1432390067' => 
        array (
          0 => 'byobagn_easy_header_1432390067_byobagn_column_1',
        ),
        'byobagn_easy_header_1432390067_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_nav_menu_1432390068',
        ),
      ),
    ),
    'home' => 
    array (
      'options' => 
      array (
        'byobagn_match_height' => 
        array (
          'use_matchheight' => 
          array (
            'use' => true,
          ),
        ),
      ),
      'boxes' => 
      array (
        'thesis_html_body' => 
        array (
          0 => 'byobagn_easy_header_1430603940',
          1 => 'byobagn_easy_header_1430343836',
          2 => 'byobagn_easy_header_1432390067',
          3 => 'byobagn_easy_responsive_columns_1430344266',
          4 => 'byobagn_content_grid_1431281911',
          5 => 'byobagn_easy_responsive_columns_1430690224',
          6 => 'byobagn_content_grid_1430344053',
          7 => 'byobagn_content_grid_1432414619',
        ),
        'byobagn_easy_header_1430603940' => 
        array (
          0 => 'byobagn_easy_header_1430603940_byobagn_column_1',
          1 => 'byobagn_easy_header_1430603940_byobagn_column_2',
        ),
        'byobagn_easy_header_1430603940_byobagn_column_1' => 
        array (
          0 => 'byobagn_phone_number_1430603941',
        ),
        'byobagn_easy_header_1430603940_byobagn_column_2' => 
        array (
          0 => 'byobagn_social_profile_links_1430603942',
        ),
        'byobagn_social_profile_links_1430603942' => 
        array (
          0 => 'byobagn_social_profile_links_1430603942_byobagn_twitter_link',
          1 => 'byobagn_social_profile_links_1430603942_byobagn_linkedin_link',
          2 => 'byobagn_social_profile_links_1430603942_byobagn_facebook_link',
          3 => 'byobagn_social_profile_links_1430603942_byobagn_stumbleupon_link',
          4 => 'byobagn_social_profile_links_1430603942_byobagn_googleplus_link',
          5 => 'byobagn_social_profile_links_1430603942_byobagn_pinterest_link',
          6 => 'byobagn_social_profile_links_1430603942_byobagn_instagram_link',
          7 => 'byobagn_social_profile_links_1430603942_byobagn_vimeo_link',
          8 => 'byobagn_social_profile_links_1430603942_byobagn_vine_link',
          9 => 'byobagn_social_profile_links_1430603942_byobagn_youtube_link',
          10 => 'byobagn_social_profile_links_1430603942_byobagn_flickr_link',
          11 => 'byobagn_social_profile_links_1430603942_byobagn_reddit_link',
          12 => 'byobagn_social_profile_links_1430603942_byobagn_tumblr_link',
          13 => 'byobagn_social_profile_links_1430603942_byobagn_slideshare_link',
          14 => 'byobagn_social_profile_links_1430603942_byobagn_custom1_link',
          15 => 'byobagn_social_profile_links_1430603942_byobagn_custom2_link',
        ),
        'byobagn_easy_header_1430343836' => 
        array (
          0 => 'byobagn_easy_header_1430343836_byobagn_column_1',
          1 => 'byobagn_easy_header_1430343836_byobagn_column_2',
        ),
        'byobagn_easy_header_1430343836_byobagn_column_1' => 
        array (
          0 => 'byobagn_header_image_1430343837',
        ),
        'byobagn_easy_header_1430343836_byobagn_column_2' => 
        array (
          0 => 'byobagn_title_and_tagline_1430343838',
        ),
        'byobagn_title_and_tagline_1430343838' => 
        array (
          0 => 'byobagn_title_and_tagline_1430343838_thesis_site_title',
          1 => 'byobagn_title_and_tagline_1430343838_thesis_site_tagline',
        ),
        'byobagn_easy_header_1432390067' => 
        array (
          0 => 'byobagn_easy_header_1432390067_byobagn_column_1',
        ),
        'byobagn_easy_header_1432390067_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_nav_menu_1432390068',
        ),
        'byobagn_easy_responsive_columns_1430344266' => 
        array (
          0 => 'byobagn_easy_responsive_columns_1430344266_byobagn_column_1',
          1 => 'byobagn_easy_responsive_columns_1430344266_byobagn_column_2',
        ),
        'byobagn_easy_responsive_columns_1430344266_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_loop',
          1 => 'byobagn_thesis_email_signup_call_to_action_1430918094',
          2 => 'byobagn_sub_columns_1430949087',
        ),
        'thesis_wp_loop' => 
        array (
          0 => 'byobagn_archive_post_box_1430950404',
        ),
        'byobagn_archive_post_box_1430950404' => 
        array (
          0 => 'byobagn_archive_post_box_1430950404_byobagn_archive_post_heading_wrapper',
          1 => 'byobagn_archive_post_box_1430950404_byobagn_thumbnail_featured_image',
          2 => 'byobagn_archive_post_box_1430950404_byobagn_typical_excerpt',
          3 => 'byobagn_archive_post_box_1430950404_byobagn_postfooter_wrapper',
        ),
        'byobagn_archive_post_box_1430950404_byobagn_archive_post_heading_wrapper' => 
        array (
          0 => 'byobagn_archive_post_box_1430950404_byobagn_archive_post_heading_wrapper_byobagn_featured_content_post_title',
          1 => 'byobagn_archive_post_box_1430950404_byobagn_archive_post_heading_wrapper_byobagn_author_link',
          2 => 'byobagn_archive_post_box_1430950404_byobagn_archive_post_heading_wrapper_thesis_post_date',
          3 => 'byobagn_archive_post_box_1430950404_byobagn_archive_post_heading_wrapper_byobagn_category_link',
        ),
        'byobagn_archive_post_box_1430950404_byobagn_postfooter_wrapper' => 
        array (
          0 => 'byobagn_archive_post_box_1430950404_byobagn_postfooter_wrapper_byobagn_dependent_read_more',
          1 => 'byobagn_archive_post_box_1430950404_byobagn_postfooter_wrapper_thesis_post_num_comments',
        ),
        'byobagn_thesis_email_signup_call_to_action_1430918094' => 
        array (
          0 => 'thesis_aweber_form_1430918200',
        ),
        'thesis_aweber_form_1430918200' => 
        array (
          0 => 'thesis_aweber_form_1430918200_thesis_aweber_name',
          1 => 'thesis_aweber_form_1430918200_thesis_aweber_email',
          2 => 'thesis_aweber_form_1430918200_thesis_aweber_submit',
        ),
        'byobagn_sub_columns_1430949087' => 
        array (
          0 => 'byobagn_sub_columns_1430949087_byobagn_column_1',
          1 => 'byobagn_sub_columns_1430949087_byobagn_column_2',
        ),
        'byobagn_sub_columns_1430949087_byobagn_column_1' => 
        array (
          0 => 'thesis_previous_posts_link',
        ),
        'byobagn_sub_columns_1430949087_byobagn_column_2' => 
        array (
          0 => 'thesis_next_posts_link',
        ),
        'byobagn_easy_responsive_columns_1430344266_byobagn_column_2' => 
        array (
          0 => 'byobagn_thesis_email_signup_call_to_action_1430917553',
          1 => 'byobagn_social_profile_links_1430348701',
          2 => 'thesis_wp_widgets_1430344421',
        ),
        'byobagn_thesis_email_signup_call_to_action_1430917553' => 
        array (
          0 => 'thesis_aweber_form_1430840195',
        ),
        'thesis_aweber_form_1430840195' => 
        array (
          0 => 'thesis_aweber_form_1430840195_thesis_aweber_name',
          1 => 'thesis_aweber_form_1430840195_thesis_aweber_email',
          2 => 'thesis_aweber_form_1430840195_thesis_aweber_submit',
        ),
        'byobagn_social_profile_links_1430348701' => 
        array (
          0 => 'byobagn_social_profile_links_1430348701_byobagn_twitter_link',
          1 => 'byobagn_social_profile_links_1430348701_byobagn_facebook_link',
          2 => 'byobagn_social_profile_links_1430348701_byobagn_linkedin_link',
          3 => 'byobagn_social_profile_links_1430348701_byobagn_stumbleupon_link',
          4 => 'byobagn_social_profile_links_1430348701_byobagn_googleplus_link',
          5 => 'byobagn_social_profile_links_1430348701_byobagn_pinterest_link',
          6 => 'byobagn_social_profile_links_1430348701_byobagn_instagram_link',
          7 => 'byobagn_social_profile_links_1430348701_byobagn_youtube_link',
          8 => 'byobagn_social_profile_links_1430348701_byobagn_vimeo_link',
          9 => 'byobagn_social_profile_links_1430348701_byobagn_vine_link',
          10 => 'byobagn_social_profile_links_1430348701_byobagn_flickr_link',
          11 => 'byobagn_social_profile_links_1430348701_byobagn_reddit_link',
          12 => 'byobagn_social_profile_links_1430348701_byobagn_tumblr_link',
          13 => 'byobagn_social_profile_links_1430348701_byobagn_slideshare_link',
          14 => 'byobagn_social_profile_links_1430348701_byobagn_custom1_link',
          15 => 'byobagn_social_profile_links_1430348701_byobagn_custom2_link',
        ),
        'byobagn_content_grid_1431281911' => 
        array (
          0 => 'byobagn_content_grid_1431281911_byobagn_column_1',
        ),
        'byobagn_content_grid_1431281911_byobagn_column_1' => 
        array (
          0 => 'byobagn_call_to_action_1431281912',
        ),
        'byobagn_easy_responsive_columns_1430690224' => 
        array (
          0 => 'byobagn_easy_responsive_columns_1430690224_byobagn_column_1',
        ),
        'byobagn_easy_responsive_columns_1430690224_byobagn_column_1' => 
        array (
          0 => 'byobagn_social_sharing_links_1430690299',
        ),
        'byobagn_social_sharing_links_1430690299' => 
        array (
          0 => 'byobagn_social_sharing_links_1430690299_byobagn_twitter_sharing_link',
          1 => 'byobagn_social_sharing_links_1430690299_byobagn_facebook_sharing_link',
          2 => 'byobagn_social_sharing_links_1430690299_byobagn_linkedin_sharing_link',
          3 => 'byobagn_social_sharing_links_1430690299_byobagn_stumbleupon_sharing_link',
          4 => 'byobagn_social_sharing_links_1430690299_byobagn_googleplus_sharing_link',
          5 => 'byobagn_social_sharing_links_1430690299_byobagn_pinterest_sharing_link',
          6 => 'byobagn_social_sharing_links_1430690299_byobagn_reddit_sharing_link',
          7 => 'byobagn_social_sharing_links_1430690299_byobagn_tumblr_sharing_link',
        ),
        'byobagn_content_grid_1430344053' => 
        array (
          0 => 'byobagn_content_grid_1430344053_byobagn_column_1',
          1 => 'byobagn_content_grid_1430344053_byobagn_column_2',
          2 => 'byobagn_content_grid_1430344053_byobagn_column_3',
          3 => 'byobagn_content_grid_1430344053_byobagn_column_4',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_widgets_1430344054',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_2' => 
        array (
          0 => 'byobagn_enhanced_query_box_1433346455',
        ),
        'byobagn_enhanced_query_box_1433346455' => 
        array (
          0 => 'byobagn_enhanced_query_box_1433346455_byobagn_featured_content_featured_image',
        ),
        'byobagn_enhanced_query_box_1433346455_byobagn_enhanced_query_box_content_wrapper' => 
        array (
          0 => 'byobagn_enhanced_query_box_1433346455_byobagn_enhanced_query_box_content_wrapper_byobagn_typical_excerpt',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_3' => 
        array (
          0 => 'thesis_wp_widgets_1430344056',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_4' => 
        array (
          0 => 'thesis_wp_widgets_1430344057',
        ),
        'byobagn_content_grid_1432414619' => 
        array (
          0 => 'byobagn_content_grid_1432414619_byobagn_column_1',
          1 => 'byobagn_content_grid_1432414619_byobagn_column_2',
        ),
        'byobagn_content_grid_1432414619_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_nav_menu_1432414620',
        ),
        'byobagn_content_grid_1432414619_byobagn_column_2' => 
        array (
          0 => 'byobagn_copyright_date_1432414621',
        ),
      ),
    ),
    'single' => 
    array (
      'options' => 
      array (
        'byobagn_match_height' => 
        array (
          'use_matchheight' => 
          array (
            'use' => true,
          ),
        ),
      ),
      'boxes' => 
      array (
        'thesis_html_body' => 
        array (
          0 => 'byobagn_easy_header_1430603940',
          1 => 'byobagn_easy_header_1430343836',
          2 => 'byobagn_easy_header_1432390067',
          3 => 'byobagn_easy_responsive_columns_1430344266',
          4 => 'byobagn_content_grid_1430344053',
          5 => 'byobagn_content_grid_1432414619',
        ),
        'byobagn_easy_responsive_columns_1430344266' => 
        array (
          0 => 'byobagn_easy_responsive_columns_1430344266_byobagn_column_1',
          1 => 'byobagn_easy_responsive_columns_1430344266_byobagn_column_2',
        ),
        'byobagn_easy_responsive_columns_1430344266_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_loop',
          1 => 'byobagn_sub_columns_1430949087',
          2 => 'byobagn_related_posts_thumbnails_1430918730',
          3 => 'byobagn_comment_block_1430918824',
        ),
        'thesis_wp_loop' => 
        array (
          0 => 'byobagn_single_post_box_1430780537',
        ),
        'byobagn_single_post_box_1430780537' => 
        array (
          0 => 'byobagn_single_post_box_1430780537_byobagn_large_featured_image',
          1 => 'byobagn_single_post_box_1430780537_byobagn_post_heading_wrapper',
          2 => 'byobagn_single_post_box_1430780537_byobagn_top_social_media_extender',
          3 => 'byobagn_single_post_box_1430780537_thesis_post_content',
          4 => 'thesis_comments_intro',
          5 => 'byobagn_thesis_email_signup_call_to_action_1430918094',
          6 => 'byobagn_single_post_box_1430780537_byobagn_bottom_social_media_extender',
        ),
        'byobagn_single_post_box_1430780537_byobagn_post_heading_wrapper' => 
        array (
          0 => 'byobagn_single_post_box_1430780537_byobagn_post_heading_wrapper_thesis_post_headline',
          1 => 'byobagn_single_post_box_1430780537_byobagn_post_heading_wrapper_byobagn_author_link',
          2 => 'byobagn_single_post_box_1430780537_byobagn_post_heading_wrapper_thesis_post_date',
          3 => 'byobagn_single_post_box_1430780537_byobagn_post_heading_wrapper_byobagn_category_link',
        ),
        'byobagn_single_post_box_1430780537_byobagn_top_social_media_extender' => 
        array (
          0 => 'byobagn_single_post_box_1430780537_byobagn_top_social_media_extender_byobagn_twitter_sharing_link',
          1 => 'byobagn_single_post_box_1430780537_byobagn_top_social_media_extender_byobagn_facebook_sharing_link',
          2 => 'byobagn_single_post_box_1430780537_byobagn_top_social_media_extender_byobagn_linkedin_sharing_link',
          3 => 'byobagn_single_post_box_1430780537_byobagn_top_social_media_extender_byobagn_stumbleupon_sharing_link',
          4 => 'byobagn_single_post_box_1430780537_byobagn_top_social_media_extender_byobagn_googleplus_sharing_link',
          5 => 'byobagn_single_post_box_1430780537_byobagn_top_social_media_extender_byobagn_pinterest_sharing_link',
          6 => 'byobagn_single_post_box_1430780537_byobagn_top_social_media_extender_byobagn_reddit_sharing_link',
          7 => 'byobagn_single_post_box_1430780537_byobagn_top_social_media_extender_byobagn_tumblr_sharing_link',
        ),
        'byobagn_thesis_email_signup_call_to_action_1430918094' => 
        array (
          0 => 'thesis_aweber_form_1430918200',
        ),
        'thesis_aweber_form_1430918200' => 
        array (
          0 => 'thesis_aweber_form_1430918200_thesis_aweber_name',
          1 => 'thesis_aweber_form_1430918200_thesis_aweber_email',
          2 => 'thesis_aweber_form_1430918200_thesis_aweber_submit',
        ),
        'byobagn_single_post_box_1430780537_byobagn_bottom_social_media_extender' => 
        array (
          0 => 'byobagn_single_post_box_1430780537_byobagn_bottom_social_media_extender_byobagn_twitter_sharing_link',
          1 => 'byobagn_single_post_box_1430780537_byobagn_bottom_social_media_extender_byobagn_facebook_sharing_link',
          2 => 'byobagn_single_post_box_1430780537_byobagn_bottom_social_media_extender_byobagn_linkedin_sharing_link',
          3 => 'byobagn_single_post_box_1430780537_byobagn_bottom_social_media_extender_byobagn_stumbleupon_sharing_link',
          4 => 'byobagn_single_post_box_1430780537_byobagn_bottom_social_media_extender_byobagn_googleplus_sharing_link',
          5 => 'byobagn_single_post_box_1430780537_byobagn_bottom_social_media_extender_byobagn_pinterest_sharing_link',
          6 => 'byobagn_single_post_box_1430780537_byobagn_bottom_social_media_extender_byobagn_reddit_sharing_link',
          7 => 'byobagn_single_post_box_1430780537_byobagn_bottom_social_media_extender_byobagn_tumblr_sharing_link',
        ),
        'byobagn_sub_columns_1430949087' => 
        array (
          0 => 'byobagn_sub_columns_1430949087_byobagn_column_1',
          1 => 'byobagn_sub_columns_1430949087_byobagn_column_2',
        ),
        'byobagn_sub_columns_1430949087_byobagn_column_1' => 
        array (
          0 => 'byobagn_custom_post_nav_1431115269',
        ),
        'byobagn_sub_columns_1430949087_byobagn_column_2' => 
        array (
          0 => 'byobagn_custom_post_nav_1431115376',
        ),
        'byobagn_related_posts_thumbnails_1430918730' => 
        array (
          0 => 'byobagn_related_posts_thumbnails_1430918730_byobagn_thumbnail_featured_image',
          1 => 'byobagn_related_posts_thumbnails_1430918730_byobagn_small_headline_post_title',
        ),
        'byobagn_comment_block_1430918824' => 
        array (
          0 => 'byobagn_comment_block_1430918824_thesis_comments_intro',
          1 => 'byobagn_comment_block_1430918824_byobagn_comment_list',
          2 => 'byobagn_comment_block_1430918824_byobagn_comment_form',
        ),
        'byobagn_comment_block_1430918824_byobagn_comment_list' => 
        array (
          0 => 'byobagn_comment_block_1430918824_byobagn_comment_list_thesis_comment_author',
          1 => 'byobagn_comment_block_1430918824_byobagn_comment_list_thesis_comment_avatar',
          2 => 'byobagn_comment_block_1430918824_byobagn_comment_list_thesis_comment_date',
          3 => 'byobagn_comment_block_1430918824_byobagn_comment_list_byobagn_comment_action_wrapper',
          4 => 'byobagn_comment_block_1430918824_byobagn_comment_list_thesis_comment_text',
        ),
        'byobagn_comment_block_1430918824_byobagn_comment_list_byobagn_comment_action_wrapper' => 
        array (
          0 => 'byobagn_comment_block_1430918824_byobagn_comment_list_byobagn_comment_action_wrapper_thesis_comment_reply',
          1 => 'byobagn_comment_block_1430918824_byobagn_comment_list_byobagn_comment_action_wrapper_thesis_comment_edit',
        ),
        'byobagn_comment_block_1430918824_byobagn_comment_form' => 
        array (
          0 => 'byobagn_comment_block_1430918824_byobagn_comment_form_thesis_comment_form_title',
          1 => 'byobagn_comment_block_1430918824_byobagn_comment_form_byobagn_comment_form_left_column',
          2 => 'byobagn_comment_block_1430918824_byobagn_comment_form_byobagn_comment_form_right_column',
        ),
        'byobagn_comment_block_1430918824_byobagn_comment_form_byobagn_comment_form_left_column' => 
        array (
          0 => 'byobagn_comment_block_1430918824_byobagn_comment_form_byobagn_comment_form_left_column_thesis_comment_form_name',
          1 => 'byobagn_comment_block_1430918824_byobagn_comment_form_byobagn_comment_form_left_column_thesis_comment_form_email',
          2 => 'byobagn_comment_block_1430918824_byobagn_comment_form_byobagn_comment_form_left_column_thesis_comment_form_url',
        ),
        'byobagn_comment_block_1430918824_byobagn_comment_form_byobagn_comment_form_right_column' => 
        array (
          0 => 'byobagn_comment_block_1430918824_byobagn_comment_form_byobagn_comment_form_right_column_thesis_comment_form_comment',
          1 => 'byobagn_comment_block_1430918824_byobagn_comment_form_byobagn_comment_form_right_column_thesis_comment_form_submit',
          2 => 'byobagn_comment_block_1430918824_byobagn_comment_form_byobagn_comment_form_right_column_thesis_comment_form_cancel',
        ),
        'byobagn_easy_responsive_columns_1430344266_byobagn_column_2' => 
        array (
          0 => 'byobagn_thesis_email_signup_call_to_action_1430917553',
          1 => 'byobagn_social_profile_links_1430348701',
          2 => 'thesis_wp_widgets_1430344421',
        ),
        'byobagn_thesis_email_signup_call_to_action_1430917553' => 
        array (
          0 => 'thesis_aweber_form_1430840195',
        ),
        'thesis_aweber_form_1430840195' => 
        array (
          0 => 'thesis_aweber_form_1430840195_thesis_aweber_name',
          1 => 'thesis_aweber_form_1430840195_thesis_aweber_email',
          2 => 'thesis_aweber_form_1430840195_thesis_aweber_submit',
        ),
        'byobagn_social_profile_links_1430348701' => 
        array (
          0 => 'byobagn_social_profile_links_1430348701_byobagn_twitter_link',
          1 => 'byobagn_social_profile_links_1430348701_byobagn_facebook_link',
          2 => 'byobagn_social_profile_links_1430348701_byobagn_linkedin_link',
          3 => 'byobagn_social_profile_links_1430348701_byobagn_stumbleupon_link',
          4 => 'byobagn_social_profile_links_1430348701_byobagn_googleplus_link',
          5 => 'byobagn_social_profile_links_1430348701_byobagn_pinterest_link',
          6 => 'byobagn_social_profile_links_1430348701_byobagn_instagram_link',
          7 => 'byobagn_social_profile_links_1430348701_byobagn_youtube_link',
          8 => 'byobagn_social_profile_links_1430348701_byobagn_vimeo_link',
          9 => 'byobagn_social_profile_links_1430348701_byobagn_vine_link',
          10 => 'byobagn_social_profile_links_1430348701_byobagn_flickr_link',
          11 => 'byobagn_social_profile_links_1430348701_byobagn_reddit_link',
          12 => 'byobagn_social_profile_links_1430348701_byobagn_tumblr_link',
          13 => 'byobagn_social_profile_links_1430348701_byobagn_slideshare_link',
          14 => 'byobagn_social_profile_links_1430348701_byobagn_custom1_link',
          15 => 'byobagn_social_profile_links_1430348701_byobagn_custom2_link',
        ),
        'byobagn_content_grid_1430344053' => 
        array (
          0 => 'byobagn_content_grid_1430344053_byobagn_column_1',
          1 => 'byobagn_content_grid_1430344053_byobagn_column_2',
          2 => 'byobagn_content_grid_1430344053_byobagn_column_3',
          3 => 'byobagn_content_grid_1430344053_byobagn_column_4',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_widgets_1430344054',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_2' => 
        array (
          0 => 'byobagn_enhanced_query_box_1433346455',
        ),
        'byobagn_enhanced_query_box_1433346455' => 
        array (
          0 => 'byobagn_enhanced_query_box_1433346455_byobagn_featured_content_featured_image',
        ),
        'byobagn_enhanced_query_box_1433346455_byobagn_enhanced_query_box_content_wrapper' => 
        array (
          0 => 'byobagn_enhanced_query_box_1433346455_byobagn_enhanced_query_box_content_wrapper_byobagn_typical_excerpt',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_3' => 
        array (
          0 => 'thesis_wp_widgets_1430344056',
        ),
        'byobagn_content_grid_1430344053_byobagn_column_4' => 
        array (
          0 => 'thesis_wp_widgets_1430344057',
        ),
        'byobagn_content_grid_1432414619' => 
        array (
          0 => 'byobagn_content_grid_1432414619_byobagn_column_1',
          1 => 'byobagn_content_grid_1432414619_byobagn_column_2',
        ),
        'byobagn_content_grid_1432414619_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_nav_menu_1432414620',
        ),
        'byobagn_content_grid_1432414619_byobagn_column_2' => 
        array (
          0 => 'byobagn_copyright_date_1432414621',
        ),
        'byobagn_title_and_tagline_1432390068' => 
        array (
          0 => 'byobagn_title_and_tagline_1432390068_thesis_site_title',
          1 => 'byobagn_title_and_tagline_1432390068_thesis_site_tagline',
        ),
        'byobagn_easy_header_1430603940' => 
        array (
          0 => 'byobagn_easy_header_1430603940_byobagn_column_1',
          1 => 'byobagn_easy_header_1430603940_byobagn_column_2',
        ),
        'byobagn_easy_header_1430603940_byobagn_column_1' => 
        array (
          0 => 'byobagn_phone_number_1430603941',
        ),
        'byobagn_easy_header_1430603940_byobagn_column_2' => 
        array (
          0 => 'byobagn_social_profile_links_1430603942',
        ),
        'byobagn_social_profile_links_1430603942' => 
        array (
          0 => 'byobagn_social_profile_links_1430603942_byobagn_twitter_link',
          1 => 'byobagn_social_profile_links_1430603942_byobagn_linkedin_link',
          2 => 'byobagn_social_profile_links_1430603942_byobagn_facebook_link',
          3 => 'byobagn_social_profile_links_1430603942_byobagn_stumbleupon_link',
          4 => 'byobagn_social_profile_links_1430603942_byobagn_googleplus_link',
          5 => 'byobagn_social_profile_links_1430603942_byobagn_pinterest_link',
          6 => 'byobagn_social_profile_links_1430603942_byobagn_instagram_link',
          7 => 'byobagn_social_profile_links_1430603942_byobagn_vimeo_link',
          8 => 'byobagn_social_profile_links_1430603942_byobagn_vine_link',
          9 => 'byobagn_social_profile_links_1430603942_byobagn_youtube_link',
          10 => 'byobagn_social_profile_links_1430603942_byobagn_flickr_link',
          11 => 'byobagn_social_profile_links_1430603942_byobagn_reddit_link',
          12 => 'byobagn_social_profile_links_1430603942_byobagn_tumblr_link',
          13 => 'byobagn_social_profile_links_1430603942_byobagn_slideshare_link',
          14 => 'byobagn_social_profile_links_1430603942_byobagn_custom1_link',
          15 => 'byobagn_social_profile_links_1430603942_byobagn_custom2_link',
        ),
        'byobagn_easy_header_1430343836' => 
        array (
          0 => 'byobagn_easy_header_1430343836_byobagn_column_1',
          1 => 'byobagn_easy_header_1430343836_byobagn_column_2',
        ),
        'byobagn_easy_header_1430343836_byobagn_column_1' => 
        array (
          0 => 'byobagn_header_image_1430343837',
        ),
        'byobagn_easy_header_1430343836_byobagn_column_2' => 
        array (
          0 => 'byobagn_title_and_tagline_1430343838',
        ),
        'byobagn_title_and_tagline_1430343838' => 
        array (
          0 => 'byobagn_title_and_tagline_1430343838_thesis_site_title',
          1 => 'byobagn_title_and_tagline_1430343838_thesis_site_tagline',
        ),
        'byobagn_easy_header_1432390067' => 
        array (
          0 => 'byobagn_easy_header_1432390067_byobagn_column_1',
        ),
        'byobagn_easy_header_1432390067_byobagn_column_1' => 
        array (
          0 => 'thesis_wp_nav_menu_1432390068',
        ),
      ),
    ),
  ),
  '_design' => 
  array (
    'primary_font_family' => 
    array (
      'font_family' => 'georgia',
    ),
    'main_menu' => 
    array (
      'submenu_width' => '250',
      'font-size' => '18',
    ),
    'feature_box_area_background' => 
    array (
      'add_backgrpound_image' => 
      array (
        'show_image' => true,
      ),
      'skin_image' => 'https://www.agilityskin.com/wp-content/thesis/skins/byob_agility_nude/images/office-background-1.jpg',
      'background-position' => 'center center',
      'background-attachment' => 'fixed',
      'background-repeat' => 'no-repeat',
    ),
    'feature_box_area_page_background' => 
    array (
      'customize_padding' => 
      array (
        'show_padding' => true,
      ),
      'padding-bottom' => '26',
    ),
    'desktop_width' => 
    array (
      'width' => '1140',
    ),
    'c_base' => 'ccab68',
    'c_bg_dark' => '745b27',
    'c_bg_med_dark' => '9a7834',
    'c_bg_med' => 'ccab68',
    'c_bg_light' => 'e6d5b4',
    'c_bg_very_light' => 'ffffff',
    'c_cont_bg_dark' => '2d7685',
    'c_cont_bg_med_dark' => 'b2a026',
    'c_cont_bg_med' => '5485ab',
    'c_cont_bg_light' => 'aabce6',
    'c_cont_bg_very_light' => 'dedaf3',
    'cg_black' => '000000',
    'cg_darkest' => '171717',
    'cg_very_dark' => '363636',
    'cg_dark' => '555555',
    'cg_med_dark' => '707070',
    'cg_med' => '8A8A8A',
    'cg_med_light' => 'A9A9A9',
    'cg_light' => 'C0C0C0',
    'cg_very_light' => 'D3D3D3',
    'cg_ligtest' => 'FAFAFA',
    'cg_white' => 'FFFFFF',
    'content_width' => 
    array (
      'width' => 'two-thirds',
    ),
    'sidebar_width' => 
    array (
      'width' => 'one-third',
    ),
    'social_icon_style_1' => 
    array (
      'color' => 'red',
    ),
  ),
  '_display' => 
  array (
    'global' => 
    array (
      'display' => 
      array (
        'top_bar' => true,
        'top_menu' => true,
        'top_footer' => true,
        'bottom_footer' => true,
      ),
    ),
    'front' => 
    array (
      'display' => 
      array (
        'feature_box' => true,
        'attention_area' => true,
        'featured_content' => true,
        'notice_bar' => true,
        'front_sharing' => true,
      ),
    ),
    'page' => 
    array (
      'display' => 
      array (
        'large_featured_image' => true,
        'social_sharing' => true,
        'social_icons_sidebar' => true,
        'email_signup_form_sidebar' => true,
      ),
    ),
    'single' => 
    array (
      'display' => 
      array (
        'author' => true,
        'date' => true,
        'cats' => true,
        'large_featured_image' => true,
        'prev_next' => true,
        'comments_intro' => true,
        'comments' => true,
        'comment_date' => true,
        'comment_avatar' => true,
        'social_sharing_top' => true,
        'social_sharing_bottom' => true,
        'social_icons_sidebar' => true,
        'email_signup_form_sidebar' => true,
        'email_signup_form_content' => true,
        'related_posts' => true,
      ),
    ),
    'home' => 
    array (
      'display' => 
      array (
        'author' => true,
        'date' => true,
        'cats' => true,
        'thumbnail' => true,
        'num_comments' => true,
        'social_icons_sidebar' => true,
        'email_signup_form_sidebar' => true,
        'email_signup_form_content' => true,
        'notice_bar' => true,
        'front_sharing' => true,
      ),
    ),
    'archive' => 
    array (
      'display' => 
      array (
        'author' => true,
        'date' => true,
        'cats' => true,
        'thumbnail' => true,
        'num_comments' => true,
        'social_icons_sidebar' => true,
        'email_signup_form_sidebar' => true,
        'email_signup_form_content' => true,
        'front_sharing' => true,
      ),
    ),
  ),
);
}
