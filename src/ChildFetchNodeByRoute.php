<?php

namespace Drupal\miscellaneous_customization;

use Drupal\Core\Routing\RouteMatchInterface;

/**
 * Service description.
 */
class ChildFetchNodeByRoute extends ParentFetchUserByRoute {

  /**
   * The current route match.
   *
   * @var \Drupal\Core\Routing\RouteMatchInterface
   */
  protected $routeMatch;

  /**
   * Constructs a ChildFetchNodeByRoute object.
   *
   * @param \Drupal\Core\Routing\RouteMatchInterface $route_match
   *   The current route match.
   */
  public function __construct(RouteMatchInterface $route_match) {
    $this->routeMatch = $route_match;
  }

  /**
   * Get the Node from route and return the label else NULL.
   */
  public function fetchNodeByRoute() {
    /** @var \Drupal\node\Entity\Node $node */
    $node = $this->routeMatch->getParameter('node');
    return $node?->label();
  }

}
