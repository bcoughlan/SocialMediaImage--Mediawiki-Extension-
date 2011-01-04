<?php
/*
 * SocialMediaImage extension - sets an image and title based on the logo and page title, that
 * shows up on social media sites such as facebook
 *
 * For more info see http://mediawiki.org/wiki/Extension:SocialMediaImage
 *
 * @package MediaWiki
 * @subpackage Extensions
 * @author Barry Coughlan
 * @copyright © 2010 Barry Coughlan
 * @licence GNU General Public Licence 2.0 or later
 */

$wgExtensionCredits['other'][] = array(
	'path' => __FILE__,
	'name' => 'SocialMediaImage', 
	'author' => 'Barry Coughlan', 
	'url' => '',
	'description' => 'Sets your site logo and for when people link to your site on facebook/digg etc.',
);

$wgHooks['OutputPageBeforeHTML'][] = 'wfSocialMediaImageHook';

function wfSocialMediaImageHook( &$out, &$text ) {
	global $wgTitle, $wgServer, $wgSitename, $wgLogo, $smi_defaultdescription;
	$title = $wgTitle->getFullText();

	// Don't insert "Main Page" title because it's ugly
	if ($title === "Main Page") {
		$out->addMeta ( "title", $wgSitename );
	} else {
		$out->addMeta ( "title", $title . " - " . $wgSitename );
	}

	//Set image to site logo
	$link = array("rel" => "image_src",
				  "href" => $wgServer.$wgLogo
	);
	$out->addLink ( $link );

	return true;
}

