<?php

namespace Drupal\views_personalizer\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Preset entities.
 *
 * @ingroup views_personalizer
 */
interface ViewsPresetInterface extends ContentEntityInterface, EntityChangedInterface, EntityPublishedInterface, EntityOwnerInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Preset name.
   *
   * @return string
   *   Name of the Preset.
   */
  public function getName();

  /**
   * Sets the Preset name.
   *
   * @param string $name
   *   The Preset name.
   *
   * @return \Drupal\views_personalizer\Entity\ViewsPresetInterface
   *   The called Preset entity.
   */
  public function setName($name);

  /**
   * Gets the Preset creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Preset.
   */
  public function getCreatedTime();

  /**
   * Sets the Preset creation timestamp.
   *
   * @param int $timestamp
   *   The Preset creation timestamp.
   *
   * @return \Drupal\views_personalizer\Entity\ViewsPresetInterface
   *   The called Preset entity.
   */
  public function setCreatedTime($timestamp);

}
