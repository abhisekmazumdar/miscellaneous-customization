<?php

namespace Drupal\miscellaneous_customization\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\miscellaneous_customization\MiscellaneousReferenceEntityInterface;

/**
 * Defines the miscellaneous reference entity class.
 *
 * @ContentEntityType(
 *   id = "miscellaneous_reference_entity",
 *   label = @Translation("Miscellaneous Reference Entity"),
 *   label_collection = @Translation("Miscellaneous Reference Entities"),
 *   label_singular = @Translation("miscellaneous reference entity"),
 *   label_plural = @Translation("miscellaneous reference entities"),
 *   label_count = @PluralTranslation(
 *     singular = "@count miscellaneous reference entities",
 *     plural = "@count miscellaneous reference entities",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\miscellaneous_customization\MiscellaneousReferenceEntityListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "form" = {
 *       "add" = "Drupal\miscellaneous_customization\Form\MiscellaneousReferenceEntityForm",
 *       "edit" = "Drupal\miscellaneous_customization\Form\MiscellaneousReferenceEntityForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\miscellaneous_customization\Routing\MiscellaneousReferenceEntityHtmlRouteProvider",
 *     }
 *   },
 *   base_table = "miscellaneous_reference_entity",
 *   admin_permission = "administer miscellaneous reference entity",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "collection" = "/admin/content/miscellaneous-reference-entity",
 *     "add-form" = "/miscellaneous-reference-entity/add",
 *     "canonical" = "/miscellaneous-reference-entity/{miscellaneous_reference_entity}",
 *     "edit-form" = "/miscellaneous-reference-entity/{miscellaneous_reference_entity}",
 *     "delete-form" = "/miscellaneous-reference-entity/{miscellaneous_reference_entity}/delete",
 *   },
 *   field_ui_base_route = "entity.miscellaneous_reference_entity.settings",
 * )
 */
class MiscellaneousReferenceEntity extends ContentEntityBase implements MiscellaneousReferenceEntityInterface {

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['label'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Label'))
      ->setRequired(TRUE)
      ->setSetting('max_length', 255)
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['page_reference'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Basic Page Reference'))
      ->setSetting('target_type', 'node')
      ->setSetting('handler', 'default')
      ->setSetting('handler_settings', ['target_bundles' => ['page' => 'page']])
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'label',
        'weight' => -3,
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'settings' => [
          'match_operator' => 'CONTAINS',
          'match_limit' => 10,
          'size' => 60,
        ],
        'weight' => -3,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Status'))
      ->setDefaultValue(TRUE)
      ->setSetting('on_label', 'Enabled')
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'settings' => [
          'display_label' => FALSE,
        ],
        'weight' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'type' => 'boolean',
        'label' => 'above',
        'weight' => 0,
        'settings' => [
          'format' => 'enabled-disabled',
        ],
      ])
      ->setDisplayConfigurable('view', TRUE);

    return $fields;
  }

}
