<?php

namespace Drupal\miscellaneous_customization\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the miscellaneous reference entity edit forms.
 */
class MiscellaneousReferenceEntityForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $result = parent::save($form, $form_state);

    $entity = $this->getEntity();

    $message_arguments = ['%label' => $entity->toLink()->toString()];
    $logger_arguments = [
      '%label' => $entity->label(),
      'link' => $entity->toLink($this->t('View'))->toString(),
    ];

    switch ($result) {
      case SAVED_NEW:
        $this->messenger()->addStatus($this->t('New miscellaneous reference entity %label has been created.', $message_arguments));
        $this->logger('miscellaneous_customization')->notice('Created new miscellaneous reference entity %label', $logger_arguments);
        break;

      case SAVED_UPDATED:
        $this->messenger()->addStatus($this->t('The miscellaneous reference entity %label has been updated.', $message_arguments));
        $this->logger('miscellaneous_customization')->notice('Updated miscellaneous reference entity %label.', $logger_arguments);
        break;
    }

    $form_state->setRedirect('entity.miscellaneous_reference_entity.collection');

    return $result;
  }

}
