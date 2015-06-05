<?php

class izarusConfigPluginConfiguration extends sfPluginConfiguration
{
  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    if ( sfConfig::get('app_izarus_config_plugin_routes_register', true) )
    {
      $this->dispatcher->connect('routing.load_configuration', array('izarusConfigRouting', 'listenToRoutingLoadConfigurationEvent'));
    }

    foreach (array('config') as $module)
    {
      if (in_array($module, sfConfig::get('sf_enabled_modules', array())))
      {
        $this->dispatcher->connect('routing.load_configuration', array('izarusConfigRouting', 'addRouteFor'.$module));
      }
    }
  }
}
