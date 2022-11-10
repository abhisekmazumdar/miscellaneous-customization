<?php

namespace Drupal\miscellaneous_customization\Access;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Routing\Access\AccessInterface;
use Drupal\Core\Routing\RouteMatch;
use Drupal\Core\Session\AccountInterface;

/**
 * Access check based on field_restriction value.
 */
class UserRestrictionAccessChecker implements AccessInterface {

  /**
   * {@inheritdoc}
   */
  public function access(RouteMatch $route_match, AccountInterface $account) {
    /** @var \Drupal\user\Entity\User $user */
    $user = $route_match->getParameter('user');
    return AccessResult::allowedIf(($account->id() == 1) || ($user->get('field_restriction')->getString() === 'No restriction'));
  }

}
