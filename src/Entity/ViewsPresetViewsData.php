<?php

namespace Drupal\views_personalizer\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Preset entities.
 */
class ViewsPresetViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.
    return $data;
  }

}
