<?php

namespace Drupal\miscellaneous_customization;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceProviderBase;

/**
 * Defines a service provider for the Miscellaneous Customization module.
 */
class MiscellaneousCustomizationServiceProvider extends ServiceProviderBase {

  /**
   * {@inheritdoc}
   */
  public function alter(ContainerBuilder $container) {
    $container->getDefinition('miscellaneous_customization.parent_fetch_user_by_route')->setClass('Drupal\miscellaneous_customization\ChildFetchNodeByRoute');
  }

}
