<?php header("Content-type: text/css"); ?>
<?php
$template_path = dirname( dirname( $_SERVER['SCRIPT_NAME'] ) );
?>
/** IE6 is a hunk of crap!!! due to limitations in the CSS capabilities of IE, these hacks are required **/

#showcase a, #showcase img { position: relative;}

/* font tweaking for optima/lucida font */
#ff-optima h1,#ff-optima h2,#ff-optima h3,#ff-optima h4,#ff-optima h5,#ff-optima h6,
#ff-lucida h1,#ff-lucida h2,#ff-lucida h3,#ff-lucida h4,#ff-lucida h5,#ff-lucida h6 {
	letter-spacing: -0.07em;
}

body#ff-optima ,
body#ff-lucida {
	letter-spacing: -0.03em;
}

body#ff-georgia,
body#ff-georgia.f-default {
	font-size: 12px;
}

#page-bg {
	position: relative;
}

#mod_search_searchword {
	position: relative;
	z-index: 500;
}

#featured-bottom3 {
	zoom: 1;
	height: 9px;
	border-bottom: 1px solid #333;
}

/* menu fixes */

#horiz-menu {
	position: relative;
}

#horiznav li,
.menutop li {
	z-index: 100;
}

#bottom-menu {
	position: static;
	zoom: 1;
}

#logo-bottom {
	margin-left: 10px;
}

/** end **/


#showcase {
	filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $template_path; ?>/images/dark/showcase-bg.png', sizingMethod='scale');
   	background-image: none;
	zoom: 1;
}

body.style2 #showcase, body.style4 #showcase, body.style12 #showcase {
	filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $template_path; ?>/images/light/showcase-bg.png', sizingMethod='scale');
}


#searchmod {
	filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $template_path; ?>/images/search-bg.png', sizingMethod='crop');
   	background-image: none;
	zoom: 1;
}

.rok-content-rotator .arrow {
	filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $template_path; ?>/images/dark/rotator-arrow.png', sizingMethod='crop');
   	background-image: none;
	zoom: 1;
}

body.style2 .rok-content-rotator .arrow,
body.style4 .rok-content-rotator .arrow,
body.style12 .rok-content-rotator .arrow {
	filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $template_path; ?>/images/light/rotator-arrow.png', sizingMethod='crop');
}

#bottom {
	zoom: 1;
}

#logo {
	zoom: 1;
}

.rok-content-rotator,
.rok-content-rotator .rotator-2,
.rok-content-rotator .rotator-3,
.rok-content-rotator .rotator-4 {
	zoom: 1;
}

.rok-content-rotator div.clr {
	display: none;
}

.rok-content-rotator div.content {
	width: 440px;
	padding-bottom: 0;
	margin-left: 0;
	margin-top: 0;
}

.rok-content-rotator .arrow {
	right: 230px;
}

.rok-content-rotator h2 {
	text-indent: 5px;
}

span.pathway {
	display: block;
	float: left;
	line-height: 27px;
}

span.pathway a {
	display: block;
	float: left;
}

span.pathway img {
	vertical-align: middle;
	display: block;
	float: left;
}

#inset,
#content-area,
.rok-content-rotator,
#logo,
#horiz-menu,
#horiz-menu2,
#featured,
#featured2,
#featured .module,
.module-scroller,
#showcase,
#showcase2,
#showcase3,
.scroller-bottom,
.scroller-bottom1,
.scroller-bottom2,
.scroller-top,
.scroller-top1,
.scroller-top2,
#rokintroscroller-container,
#rokintroscroller-wrapper,
#rokintroscroller-leftarrow,
#rokintroscroller-rightarrow,
#rokintroscroller,
#rokintroscroller div,
#rokintroscroller div.first,
#rokintroscroller div.last,
#bottommodules,
#bottom,
#bottom-menu ul,
#bottommodules .module,
#footer {
	zoom: 1;
}

.scroller-top,
.scroller-top1,
.scroller-top2,
.scroller-bottom,
.scroller-bottom1,
.scroller-bottom2 {
	height: 1%;
}

/* RokIntroScroller */

.scroller-top2 {
	position: relative;
}

.rokintroscroller-leftarrow {
	left: -30px;
	z-index: 400;
}

.scroller-bottom {
	padding-top: 16px;
}

.module-scroller h3 {
	margin: 26px 0pt 0pt 12px;
	z-index: 500;
}

.rokintroscroller-leftarrow {
	height: 81px;
}

.rokintroscroller-rightarrow {
	height: 81px;
}

/* end RokIntroScroller */

/* login fixes */

#sl_horiz .button {
	right: 0;
}

#sl_horiz #sl_rememberme {
	width: 30%;
}

/* ie6 warning */

#iewarn {
	background: #C6D3DA url(../images/error.png) 10px 20px no-repeat;
	position: relative;
	z-index: 1;
	opacity: 0;
	margin: -150px auto 0;
	font-size: 110%;
	color: #001D29;
	z-index: 8000;
}

#iewarn div {
	position: relative;
	border-top: 5px solid #95B8C9;
	border-bottom: 5px solid #95B8C9;
	padding: 10px 80px 10px 220px;	
}

#iewarn h4 {
	color: #900;
	font-weight: bold;
	line-height: 120%;
}

#iewarn a {
	color: #296AC6;
	font-weight: bold;
}

#iewarn_close {
	background: url(../images/close.png) 50% 50% no-repeat;
	display: block;
	cursor: pointer;
	position: absolute;
	width: 61px;
	height: 21px;
	top: 25px;
	right: 12px;
}

#iewarn_close.cHover {
	background: url(../images/close_hover.png) 50% 50% no-repeat;
}

/* end ie6 warning */


/*
   NEW PURE CSS PNG FIX SOLUTION  
   use class="png" to implement 
*/

html .png,
div .png {
	azimuth: expression(
		this.pngSet?this.pngSet=true:(this.nodeName == "IMG" && this.src.toLowerCase().indexOf('.png')>-1?(this.runtimeStyle.backgroundImage = "none",
		this.runtimeStyle.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + this.src + "', sizingMethod='image')",
		this.src = "<?php echo $template_path; ?>/images/blank.gif"):(this.origBg = this.origBg? this.origBg :this.currentStyle.backgroundImage.toString().replace('url("','').replace('")',''),
		this.runtimeStyle.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + this.origBg + "', sizingMethod='crop')",
		this.runtimeStyle.backgroundImage = "none")),this.pngSet=true
	);
}

/* page peel overrides for demo site */
a.fliptip {
	display: block;
	z-index: 100000;
	position: relative;
}


