<?php

namespace Drupal\views_personalizer;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Messenger\MessengerTrait;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\Entity\EntityTypeManagerInterface;


class PresetManager {
  
  use StringTranslationTrait;
  use MessengerTrait;

  /**
   * The Preset Manager config.
   *
   * @var \Drupal\Core\Config\ImmutableConfig
   */
  protected $config;

  /**
   * The current account.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $account;

  /**
   * The Preset Storage.
   * 
   * 
   */
  protected $storage;

  /**
   * Constructs a PresetManager object.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory service.
   * @param \Drupal\Core\Session\AccountProxyInterface $account
   *   The current account.
   * @param \Drupal\devel\EntityTypeManagerInterface $entityTypeManager
   *   The entity type manager.
   */
  public function __construct(ConfigFactoryInterface $config_factory, AccountProxyInterface $account, EntityTypeManagerInterface $entityTypeManager) {
    $this->config = $config_factory->get('views_personalizer.settings');
    $this->account = $account;
    $this->storage = $entityTypeManager->getStorage('views_preset');
  }

  /**
   * Return the available presets for a view.
   * 
   * @var string $view_id - The machine id for a view.
   * @var string $display_id - The machine id for a view's display.
   */
  public function getPresets($view, $display) {
    return $this->storage->loadByProperties([
      'view' => $view,
      'display' => $display
    ]);
  }

  /**
   * Returns the default preset for a view.
   */
  public function getDefaultPreset($view, $display) {
    return $this->storage->loadByProperties([
      'view' => $view,
      'display' => $display,
      'type' => 'default'
    ]);
  }

  /**
   * Creates or Updates a default display for a view.
   */
  public function saveDefault($view, $display, $settings) {
    $defaultPreset = $this->getDefaultPreset($view, $display);

    if ($defaultPreset) {
      // Update the settings.
      $defaultPreset->set('settings', $settings);
    } else {
      $defaultPreset = ViewsPreset::create([
        'view' => $view,
        'display' => $display,
        'settings' => $settings,
        'type' => 'default'
      ]);
    }
    $defaultPreset->save();
  }

}