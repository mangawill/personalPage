<?php
/**
 * @module		mod_articles_popular_hits
 * @copyright	Copyright (C) 2005 - 2012 Joomdev Corporation. All rights reserved.
 * @Website		http://www.jm-experts.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */


// no direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

$list = modArticlesPopularHitsHelper::getList($params);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_articles_popular_hits', $params->get('layout', 'default'));
