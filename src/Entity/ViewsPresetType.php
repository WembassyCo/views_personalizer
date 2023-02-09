<?php

namespace Drupal\views_personalizer\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Preset type entity.
 *
 * @ConfigEntityType(
 *   id = "views_preset_type",
 *   label = @Translation("Preset type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\views_personalizer\ViewsPresetTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\views_personalizer\Form\ViewsPresetTypeForm",
 *       "edit" = "Drupal\views_personalizer\Form\ViewsPresetTypeForm",
 *       "delete" = "Drupal\views_personalizer\Form\ViewsPresetTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\views_personalizer\ViewsPresetTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "views_preset_type",
 *   config_export = {
 *     "id",
 *     "label"
 *   },
 *   admin_permission = "administer site configuration",
 *   bundle_of = "views_preset",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/views_preset_type/{views_preset_type}",
 *     "add-form" = "/admin/structure/views_preset_type/add",
 *     "edit-form" = "/admin/structure/views_preset_type/{views_preset_type}/edit",
 *     "delete-form" = "/admin/structure/views_preset_type/{views_preset_type}/delete",
 *     "collection" = "/admin/structure/views_preset_type"
 *   }
 * )
 */
class ViewsPresetType extends ConfigEntityBundleBase implements ViewsPresetTypeInterface {

  /**
   * The Preset type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Preset type label.
   *
   * @var string
   */
  protected $label;

}
