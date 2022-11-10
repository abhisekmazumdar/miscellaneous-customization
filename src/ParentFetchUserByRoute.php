<?php

namespace Drupal\miscellaneous_customization;

use Drupal\Core\Routing\RouteMatchInterface;

/**
 * Service description.
 */
class ParentFetchUserByRoute {

  /**
   * The current route match.
   *
   * @var \Drupal\Core\Routing\RouteMatchInterface
   */
  protected $routeMatch;

  /**
   * Constructs a ParentFetchUserByRoute object.
   *
   * @param \Drupal\Core\Routing\RouteMatchInterface $route_match
   *   The current route match.
   */
  public function __construct(RouteMatchInterface $route_match) {
    $this->routeMatch = $route_match;
  }

  /**
   * Get user from route and return the label else NULL.
   */
  public function fetchUserByRoute() {
    /** @var \Drupal\user\Entity\User $user */
    $user = $this->routeMatch->getParameter('user');
    return $user?->label();
  }

}
