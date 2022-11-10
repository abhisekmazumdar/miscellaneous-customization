<?php

namespace Drupal\miscellaneous_customization\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\Cache;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a node list block.
 *
 * @Block(
 *   id = "miscellaneous_customization_node_list",
 *   admin_label = @Translation("Node Listing"),
 *   category = @Translation("Custom")
 * )
 */
class NodeListBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Constructs a new NodeListBlock instance.
   *
   * @param array $configuration
   *   The plugin configuration, i.e. an array with configuration values keyed
   *   by configuration option name. The special key 'context' may be used to
   *   initialize the defined contexts by setting it to an array of context
   *   values keyed by context names.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityTypeManagerInterface $entity_type_manager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheTags() {
    return Cache::mergeTags(parent::getCacheTags(), ['node_list']);
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $nodeStorage = $this->entityTypeManager->getStorage('node');
    $article = array_values($nodeStorage->loadMultiple($nodeStorage->getQuery()->condition('type', 'article')->execute()));
    $page = array_values($nodeStorage->loadMultiple($nodeStorage->getQuery()->condition('type', 'page')->execute()));

    $header = [
      'Article',
      'Basic Page',
    ];

    $rows = [];
    $key = 0;
    for ($row = 1; $row <= count($article); $row++) {
      $rows[$row][1] = $article[$key++]->label();
      $rows[$row][2] = empty($rows[$row][2]) ? '' : $rows[$row][2];
    }

    $key = 0;
    for ($row = 1; $row <= count($page); $row++) {
      $rows[$row][1] = empty($rows[$row][1]) ? '' : $rows[$row][1];
      $rows[$row][2] = $page[$key++]->label();
    }

    return [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    ];
  }

}
