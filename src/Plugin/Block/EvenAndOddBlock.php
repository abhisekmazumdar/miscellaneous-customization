<?php

namespace Drupal\miscellaneous_customization\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides an even and odd block.
 *
 * @Block(
 *   id = "miscellaneous_customization_even_and_odd",
 *   admin_label = @Translation("Even And Odd"),
 *   category = @Translation("Custom")
 * )
 */
class EvenAndOddBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build['content'] = [
      '#type' => 'html_tag',
      '#tag' => 'div',
      '#attached' => [
        'library' => [
          'miscellaneous_customization/miscellaneous_customization',
        ],
      ],
      '#attributes' => [
        'id' => 'even-or-odd',
      ],
    ];
    return $build;
  }

}
