<?php

namespace Drupal\specbee_date_location;

use Drupal\Core\Config\ConfigFactoryInterface;

/**
 * Custom service fetch date from custom config form.
 */

 class DataService {

  /**
   * The config factory.
   * 
   * @var \Druapl\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * Constructs a custom data service.
   * 
   * @param \Druapl\Core\Config\ConfigFactoryInterface $config_factory
   */

  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->configFactory = $config_factory;
  }

  /**
   * Fetch config data from custom configuration setting.
   * 
   * @return array
   *   Configuration data from DateLocationSetting configuration.
   */

  public function getDateLocationData() {
    return $this->configFactory->get('specbee_date_location.settings') ?: [];
  }

 }