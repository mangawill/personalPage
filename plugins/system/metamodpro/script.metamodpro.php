<?php


class plgSystemMetamodproInstallerScript {
	function postflight($type, $parent) {
		define('_MMP_HACK', 1);
		require_once('install.metamodpro.php');
	}
}