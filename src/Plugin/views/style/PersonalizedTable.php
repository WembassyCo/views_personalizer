<?php

namespace Drupal\views_personalizer\Plugin\views\style;

use Drupal\views\Plugin\views\style\Table;
use Drupal\Component\Utility\Html;
use Drupal\Core\Cache\Cache;
use Drupal\Core\Cache\CacheableDependencyInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Views;
use Drupal\views\Plugin\views\wizard\WizardInterface;

/**
 * Style plugin that extends the base table style, to allow personalization.
 * 
 * @ingroup views_style_plugins
 * 
 * @ViewsStyle(
 *   id = "personalized_table",
 *   title = @Translation("Personalized Table"),
 *   help = @Translation("Extends the standard Table to allow users to personalize the view."),
 *   theme = "views_view_personalized_table",
 *   display_types = {"normal"}
 * )
 */
class PersonalizedTable extends Table implements CacheableDependencyInterface {

  /**
   * Allows users to share presets globally.
   * @var bool
   */
  public $sharable_presets;

  /**
   * Allows users to toggle field display.
   * @var bool
   */
  public $toggle_columns;

  /**
   * Allows users to reorder field display.
   * @var bool
   */
  public $reorder_columns;

  /**
   * Allows views to inherit presets from other views..
   * @var array
   */
  public $inheritable_presets;

  protected function defineOptions() {
    $options = parent::defineOptions();

    $options['sharable_presets'] = ['default' => TRUE];
    $options['toggle_columns'] = ['default' => TRUE];
    $options['reorder_columns'] = ['default' => TRUE];
    $options['inheritable_presets'] = [ 'default' => [] ];

    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);
    
    $form['presets'] = [
      '#type' => 'fieldset',
      '#title' => t('Presets')
    ];

    $form['presets']['sharable_presets'] = [
      '#title' => $this->t('Support Sharable Prests'),
      '#type' => 'checkbox',
      '#default_value' => $this->options['sharable_presets'],
      '#description' => t('This table allows definition and sharing of presets created by users.')
    ];

    $form['presets']['toggle_columns'] = [
      '#title' => $this->t('Toggable Columns'),
      '#type' => 'checkbox',
      '#default_value' => $this->options['toggle_columns'],
      '#description' => $this->t('Allow users to show or hide fields.')
    ];

    $form['presets']['reorder_columns'] = [
      '#title' => $this->t('Reorder Columns'),
      '#type' => 'checkbox',
      '#default_value' => $this->options['reorder_columns'],
      '#description' => $this->t('Allow users to reorder fields in the table.')
    ];

    $available_displays = [];
    $views = Views::getAllViews();
    
    foreach($views as $view) {
      foreach($view->get('display') as $key => $display) {
        $available_displays[$view->id() . "_" . $key] = 
          $view->label() . " / " . $key;
      }
    }

    // Get all views and render then as options.
    $form['presets']['inheritable_presets'] = [
      '#title' => $this->t('Inherit Presets'),
      '#type' => 'select',
      '#size' => 10,
      '#options' => $available_displays,
      '#default_value' => $this->options['inheritable_presets'],
      '#description' => $this->t('Select other views this view should inherit it\'s preset from.')
    ];

  }

  /**
   * {@inheritdoc}
   */
  public function buildSort() {
    return parent::buildSort();
  }

  /**
   * {@inheritdoc}
   */
  public function buildSortPost() {
    return parent::buildSortPost();
  }

  /**
   * {@inheritdoc}
   */
  public function sanitizeColumns($columns, $fields = NULL) {
    return parent::sanitizeColumns($columns, $fields);
  }
}