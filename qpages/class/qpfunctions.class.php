<?php
// $Id$
// --------------------------------------------------------------
// Quick Pages
// Create simple pages easily and quickly
// Author: Eduardo Cortés <i.bitcero@gmail.com>
// Email: i.bitcero@gmail.com
// License: GPL 2.0
// --------------------------------------------------------------

class QPFunctions
{
	/**
	 * Send json response for AJAX purposes
	 * @param string Message to send
	 * @param int This is an error or no (1 or 0)
	 * @param array extra data to send
	 */
	static function jsonResponse($msg, $error = 0, $token = 0, $data = array()){
		global $xoopsSecurity;

		$ret = array();
		$ret['message'] = $msg;
		$ret['error']   = $error;
		$ret['token']   = $token==1 ? $xoopsSecurity->createToken() : '';
		$ret['data']    = $data;

		echo json_encode($ret);
		die();

	}

	/**
	 * Get template information
	 */
	static function templateInfo($path, $file){

		if(!is_file($path . '/' . $file)) return null;

        $content = file_get_contents( $path . '/' . $file );

        if ( substr( $file, -4 ) == '.php' ){

            $info = array();
            preg_match( "/\/\*(.*)\*\//s", $content, $info );

        } elseif ( substr( $file, -4 ) == '.tpl' ){

            $info = array();
            preg_match( "/^<{\*(.*)\*\}>/sm", $content, $info );

        }

        if( !isset($info[1]))
            return false;

		$data = parse_ini_string($info[1]);
        unset($content, $info);

		return (object) array_merge(array('File' => str_replace(XOOPS_ROOT_PATH, '', $path) . '/' . $file), $data);

	}

	static function getTemplates($paths){

		$tpls = array();

        $tpls[] = (object) array(
            'Name'    => __('No template', 'qpages'),
            'File'          => ''
        );

		$lists = new XoopsLists();

		foreach($paths as $path){

			if(!is_dir($path)) continue;
			$dirs = $lists->getDirListAsArray( $path );

			foreach($dirs as $dir ){
                if ( !file_exists( $path . '/' . $dir . '/tpl-' . $dir . '.php' ) ) continue;

				$info = QPFunctions::templateInfo($path . '/' . $dir, 'tpl-' . $dir . '.php');
                if (false !== $info)
                    $tpls[] = $info;

			}

            $files = $lists->getFileListAsArray( $path );
            foreach( $files as $file ){
                if ( substr( $file, 0, 4 ) == 'tpl-' &&  substr( $file, -4 ) == '.tpl' ){

                    $info = QPFunctions::templateInfo( $path, $file );
                    if (false !== $info)
                        $tpls[] = $info;

                }
            }

		}

		return $tpls;

	}

    /**
     * Gets the template form to show in pages creator
     * @param QPPage $page QPPAge object
     * @return string
     */
    public static function template_form( QPPage $page ){

        if ( !is_a( $page, 'QPPage' ) )
            return false;

        $form = new RMForm('','','');

        self::load_tpl_locale( $page->template );


        $file_data = pathinfo( $page->template );
        $path = XOOPS_ROOT_PATH . $file_data[ 'dirname' ];
        $form_file = $path . '/form-' . str_replace( "tpl-", '', $file_data['filename'] ) . '.php';

        if ( !file_exists( $form_file ) )
            return false;

        $tplSettings = (object) $page->tpl_option();
        $tplSettings->url = XOOPS_URL . $file_data['dirname'];
        $tplSettings->path = $path;

        ob_start();
        include $form_file;
        $form = ob_get_clean();

        return $form;

    }

	/**
	 * Función para obtener las categorías en un array
	 */
	static function categoriesTree(&$ret,$jumps=0,$parent=0, $exclude=null){

		$db = XoopsDatabaseFactory::getDatabaseConnection();

		$result = $db->query("SELECT * FROM ".$db->prefix("mod_qpages_categos")." WHERE parent='$parent' ORDER BY `id_cat`");

		while ($row = $db->fetchArray($result)){
			if (is_array($exclude) && (in_array($row['parent'], $exclude) || in_array($row['id_cat'], $exclude))){
				$exclude[] = $row['id_cat'];
			} else {
				$rtn = array();
				$rtn = $row;
				$rtn['jumps'] = $jumps;
				$ret[] = $rtn;
			}
			QPFunctions::categoriesTree($ret, $jumps + 1, $row['id_cat'], $exclude);
		}

		return true;

	}

	static function verboseType($type){

		switch($type){
			case 'redir':
				return __('Redirection Page','qpages');
				break;
			case 'sales':
				return __('Sales Page','qpages');
				break;
			case 'squeeze':
				return __('Squeeze Page','qpages');
				break;
			default:
				return __('Normal Page','qpages');
			break;
		}

	}

    static function toolbar( $category, $page = '' ){
        global $rmTpl;

        $rmTpl->add_tool(__('Add Page','qpages'), 'pages.php?action=new&category='.$category.'&page='.$page, 'svg-rmcommon-plus-circle text-success', 'pages-new');
        $rmTpl->add_tool(__('Published','qpages'), 'pages.php?public=1&category='.$category, 'svg-rmcommon-send text-blue-grey', 'pages-public');
        $rmTpl->add_tool(__('Drafts','qpages'), 'pages.php?public=0&category='.$category, 'svg-rmcommon-document text-danger', 'pages-draft');
        $rmTpl->add_tool(__('General','qpages'), 'pages.php?type=normal&category=' . $category, 'svg-rmcommon-docs text-teal', 'pages-list' );
        $rmTpl->add_tool(__('Redirection','qpages'), 'pages.php?type=redir&category=' . $category, 'svg-rmcommon-link text-midnight', 'pages-redir' );

    }

    static function error_404(){

        header("HTTP/1.0 404 Not Found");
        if (substr(php_sapi_name(), 0, 3) == 'cgi')
            header('Status: 404 Not Found', TRUE);
        else
            header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');

        echo "<h1>ERROR 404. Document not Found</h1>";
        die();

    }

    /**
     * Makes the URL to include dynamic styles
     * @param QPPage $page
     * @param string $tpl Template name
     * @param string $file Relative path from css to include
     * @return string
     */
    static function dynamic_style( QPPage $page, $tpl, $file ){

        return XOOPS_URL . '/modules/qpages/css/styles.php?page=' . $page->id() . '&amp;tpl=' . $tpl . '&amp;css=' . urlencode( $file );

    }

    /**
     * Load default settings for a specific template. Based on defaults values, when a key is not found in
     * current settings, then the value is assigned based in defaults setting provided.
     * @param stdClass $settings Array with current settings
     * @param array $defaults Array with default settings
     * @return bool The value is assigned by reference to current settings
     */
    static function load_defaults ( &$settings, $defaults ){

        if ( !$settings || empty( $defaults ) ) return false;

        foreach( $defaults as $name => $value ){

            if ( !isset( $settings->{$name} ) || $settings->{$name} == '' )
                $settings->{$name} = $value;

        }

        return true;

    }

    /**
     * Loads a language for specified template
     * @param string $tpl Template relative path
     * @param $prefix Prefix for language file
     */
    static function load_tpl_locale( $tpl, $prefix = '' ){
        $exm_locale = get_locale();

        if ($tpl=='') return;

        $tpl_info = pathinfo( $tpl );
        $path = $tpl_info['dirname'];

        $path .= '/lang/'.$prefix.$exm_locale.'.mo';

        load_locale_file(str_replace("tpl-", '', $tpl_info['filename']), XOOPS_ROOT_PATH  . $path);
    }

}
