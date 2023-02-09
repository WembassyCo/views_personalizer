<?php

namespace Drupal\views_personalizer\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ViewsPresetTypeForm.
 */
class ViewsPresetTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $views_preset_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $views_preset_type->label(),
      '#description' => $this->t("Label for the Preset type."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $views_preset_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\views_personalizer\Entity\ViewsPresetType::load',
      ],
      '#disabled' => !$views_preset_type->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $views_preset_type = $this->entity;
    $status = $views_preset_type->save();

    switch ($status) {
      case SAVED_NEW:
        $this->messenger()->addMessage($this->t('Created the %label Preset type.', [
          '%label' => $views_preset_type->label(),
        ]));
        break;

      default:
        $this->messenger()->addMessage($this->t('Saved the %label Preset type.', [
          '%label' => $views_preset_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($views_preset_type->toUrl('collection'));
  }

}
