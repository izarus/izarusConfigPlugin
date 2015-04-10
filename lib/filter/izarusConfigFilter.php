<?php

class izarusConfigFilter extends sfFilter
{
  public function execute($filterChain)
  {
    // Get config values from database
    $config_values = Doctrine_Core::getTable('ConfigValue')->createQuery('cv')->execute();

    foreach ($config_values as $cv) {
      if ($cv->getApp() && ($cv->getApp() == sfConfig::get('sf_app'))) {
        sfConfig::set($this->getParameter('prefix','conf_').$cv->getName(), $cv->getValue());
      } elseif (!$cv->getApp()) {
        sfConfig::set($this->getParameter('prefix','conf_').$cv->getName(), $cv->getValue());
      }
    }

    // Continues with next filter
    $filterChain->execute();
  }
}