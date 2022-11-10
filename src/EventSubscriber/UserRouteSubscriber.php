<?php

namespace Drupal\miscellaneous_customization\EventSubscriber;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Route subscriber.
 */
class UserRouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    if ($route = $collection->get('entity.user.canonical')) {
      $route->setRequirement('_user_restriction_access', '\Drupal\miscellaneous_customization\Access\UserRestrictionAccessChecker::access');
    }
  }

}
