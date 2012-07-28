<?php
/**
 * MDGetuserfield plugin for Joomla! 2.5
 * Version: 1.0
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v2.0.
 * @by Mardink Webdesign
 * @Copyright (C) 2012
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.plugin.plugin' );
class  plgContentMdgetuserfield extends JPlugin
{
public function __construct(& $subject, $config) {
		parent::__construct($subject, $config);
		$this->loadLanguage();
	}
	function plgContentMdgetuserfield (& $subject) {
		parent::__construct($subject);
	}

public function onContentPrepare($context, &$article, &$params, $page = 0) 
{

	//Get parameter
$field = $this->params->get('getfield', 'username');
//Get logged in userid
$user = &JFactory::getUser();
$userid = $user->id;
$db = &JFactory::getDBO();
$select = "SELECT $field FROM #__users where id=$userid;";
$db->setQuery($select);
$fieldname = $db->loadresult();
//Determine logged in or Guest
	if ($userid==0) $name=JText::_( 'PLG_CONTENT_MDGETUSERFIELD_GUEST' );
else $name=$fieldname;
$searchword = '/{mdgetuserfield}/i';
$article->text =preg_replace("$searchword",$name,$article->text);
	return true;
}
}
?>