<?php
// $Id: modinfo.php 565 2010-11-24 03:31:27Z i.bitcero $
// --------------------------------------------------------------
// Quick Pages
// Create simple pages easily and quickly
// Author: Eduardo Cortés <i.bitcero@gmail.com>
// Email: i.bitcero@gmail.com
// License: GPL 2.0
// --------------------------------------------------------------

# INFORMACIóN DEL MóDULO
define('_MI_QP_DESC', __('Module for publishing and management of single pages.', 'qpages'));

# Manejo de Links
define('_MI_QP_CNFLINKS', __('Links Management Method.', 'qpages'));
define('_MI_QP_CNFLINKS_DESC', __('The method based on names requires the Apache Server.', 'qpages'));
define('_MI_QP_CNFLINKS1', __('PHP Default', 'qpages'));
define('_MI_QP_CNFLINKS2', __('Based on Names', 'qpages'));

# Texto parala p?gina inicial
define('_MI_QP_CNFHOMETEXT', __('Home page text', 'qpages'));
define('_MI_QP_CNFHOMETEXT_DESC', __('This text will show in the module home page to inform the user.', 'qpages'));

define('_MI_QP_SHOWRELATED', __('Show related pages', 'qpages'));
define('_MI_QP_SHOWRELATED_DESC', __('Enable the "Related Pages" square when a page is viewed.', 'qpages'));
define('_MI_QP_RELATEDNUM', __('Number of related pages', 'qpages'));

// Base path
define('_MI_QP_BASEPATH', __('Base path for url', 'qpages'));
define('_MI_QP_BASEPATHD', __('The urls formed by module will be generated from this base path.', 'qpages'));

/**
 * Bloques
 */
define('_MI_QP_BKCATS', __('Sections', 'qpages'));
define('_MI_QP_BKPAGES', __('Pages', 'qpages'));

// Subpáginas
define('_MI_QP_SUBINDEX', __('Home Page', 'qpages'));
define('_MI_QP_SUBCATS', __('Categories', 'qpages'));
define('_MI_QP_SUBPAGE', __('Page', 'qpages'));
