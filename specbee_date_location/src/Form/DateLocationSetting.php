<?php

/**
 * @file
 * Contains Drupal\specbee_date_location\Form\DateLocationSetting.
 */

namespace Drupal\specbee_date_location\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class DateLocationSetting.
 *
 * @package Drupal\specbee_date_location\Form
 */
class DateLocationSetting extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'specbee_date_location.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'date_location_setting';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('specbee_date_location.settings');
    $zones = [
      'America/Chicago' => 'America/Chicago',
      'America/New_York' => 'America/New_York',
      'Asia/Tokyo' => 'Asia/Tokyo',
      'Asia/Dubai' => 'Asia/Dubai',
      'Asia/Kolkata'=> 'Asia/Kolkata',
      'Europe/Amsterdam' => 'Europe/Amsterdam',
      'Europe/Oslo' => 'Europe/Oslo',
      'Europe/London' => 'Europe/London'
    ];
    $form['country'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#default_value' => $config->get('country'),
    );
    $form['city'] = array(
      '#type' => 'textfield', 
      '#title' => $this->t('City'),
      '#default_value' => $config->get('city'),
    );
    $form['timezone'] = array(
      '#type' => 'select', 
      '#title' => $this->t('timezone'),
      '#options' => $zones,
      '#empty_option' => 'none',
      '#default_value' => $config->get('timezone'),
    );
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    $this->config('specbee_date_location.settings')
      ->set('country', $form_state->getValue('country'))
      ->set('city', $form_state->getValue('city'))
      ->set('timezone', $form_state->getValue('timezone'))
      ->save();
  }

}