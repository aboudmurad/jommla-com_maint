<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelitem library
jimport('joomla.application.component.modelitem');

/**
 * HelloWorld Model
 */
class MaintModelMaint extends JModelItem
{
  /**
   * @var string msg
   */
  protected $order;

  /**
   * Get the message
   * @return string The message to be displayed to the user
   */
  public function getOrder()
  {
        $id    = JRequest::getInt('id');
        $phone = JRequest::getString('phone');
    if (!isset($this->order))
    {
            $client = $order = NULL;
            $db = $this->getDbo();

            $db->setQuery(
                    'SELECT *' .
                    ' FROM #__maint_orders AS o' .
                    ' LEFT JOIN #__maint_clients AS c '.
                          'ON c.id = o.client_id'.
                    ' WHERE c.phone = "'. $phone .'"'.
                       ' AND o.id = '.$id
            );

            $this->order = $db->loadObject();

    }
    return $this->order;
  }
}
