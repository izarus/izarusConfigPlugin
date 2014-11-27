<?php

class izarusConfigFilter extends sfFilter
{
  public function execute($filerChain)
  {
    // Get config values from database
    $config_values = Doctrine_Core::getTable('ConfigValue')->createQuery('cv')->execute();

    foreach ($config_values as $cv) {
      if (!empty($cv->getApp()) && $cv->getApp() == $this->getContext()->getConfiguration()->getApplication()) {
        sfConfig::set($cv->getName(), $cv->getValue());
      } elseif (empty($cv->getApp())) {
        sfConfig::set($cv->getName(), $cv->getValue());
      }
    }

    // Continues with next filter
    $filterChain->execute();
  }
}