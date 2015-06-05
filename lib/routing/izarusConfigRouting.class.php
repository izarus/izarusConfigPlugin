<?php

class izarusConfigRouting
{
  /**
   * Listens to the routing.load_configuration event.
   *
   * @param sfEvent An sfEvent instance
   * @static
   */
  static public function listenToRoutingLoadConfigurationEvent(sfEvent $event)
  {
  }

  static public function addRouteForconfig(sfEvent $event)
  {
    $event->getSubject()->prependRoute('config_value', new sfDoctrineRouteCollection(array(
      'name'                => 'config_value',
      'model'               => 'ConfigValue',
      'module'              => 'config',
      'prefix_path'         => 'config',
      'with_wildcard_routes' => true,
      'collection_actions'  => array('filter' => 'post', 'batch' => 'post'),
      'requirements'        => array(),
    )));
  }
}
