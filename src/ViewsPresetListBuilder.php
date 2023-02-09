<?php

namespace Drupal\views_personalizer;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Preset entities.
 *
 * @ingroup views_personalizer
 */
class ViewsPresetListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Preset ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var \Drupal\views_personalizer\Entity\ViewsPreset $entity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.views_preset.edit_form',
      ['views_preset' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
