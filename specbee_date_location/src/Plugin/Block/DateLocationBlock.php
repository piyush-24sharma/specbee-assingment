<?php

namespace Drupal\specbee_date_location\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\specbee_date_location\DataService;
use Drupal\Component\Datetime\Time;
use Drupal\Core\Datetime\DateFormatter;
use Drupal\Core\Cache\Cache;

/**
 * Provides a 'Date-time Location' block.
 * 
 * @Block(
 *   id = "specbee_date_time_location_block",
 *   admin_label = @Translation("DateTimeLocationBlock"),
 *   category = @Translation("Custom"),
 * )
 */

 class DateLocationBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The custom service to fetch configuration data.
   * 
   * @var \Drupal\specbee_date_location\DataService
   *  the data_service
   */
  protected $specbeeDateTimeLocation;

  /**
   * The Time.
   *
   * @var Drupal\Component\Datetime\Time
   */
  protected $time;

  /**
   * The Date Formatter.
   *
   * @var Drupal\Core\Datetime\DateFormatter
   */
  protected $dateFormatter;
  
  /**
   * @param array $configuration 
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param \Drupal\specbee_date_location\DataService
   *   Custom service to fetch date-time location configuration data protected $specbeeDateTimeLocation.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, $specbeeDateTimeLocation, Time $time, DateFormatter $dateFormatter) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->specbeeDateTimeLocation = $specbeeDateTimeLocation;
    $this->time = $time;
    $this->dateFormatter = $dateFormatter;
  }

  /** 
   * {@inheritdoc}
   */
  
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('specbee_date_location.data_service'),
      $container->get('datetime.time'),
      $container->get('date.formatter'),
    );
  }

  /**
   * {@inheritdoc}
  */
  public function build() {
    $dateTimeLocationData = $this->getFormatedDateTimeData();
    return [
      '#theme' => 'specbee_date_location__datetimelocation_block',
      '#cache' => [
        'tags' => ['config:specbee_date_location.settings'],
        'max-age' => 0,        
      ],
      '#country' =>isset($dateTimeLocationData['country']) ? $dateTimeLocationData['country'] : '',
      '#city' =>isset($dateTimeLocationData['city']) ? $dateTimeLocationData['city'] : '',
      '#date' =>isset($dateTimeLocationData['date']) ? $dateTimeLocationData['date'] : '',
      '#time' =>isset($dateTimeLocationData['time']) ? $dateTimeLocationData['time'] : '',
    ];
  }

  /**
   * fetch date time date from custom service and
   * format according to selected timezone.
   * 
   * @return array data fetched and formated from custom service.
   */
  public function getFormatedDateTimeData() {
    //fetching custom config data from custom service.
    $datetimeServiceData = $this->specbeeDateTimeLocation->getDateLocationData();
    if (!empty($datetimeServiceData)) {
      $country = $datetimeServiceData->get('country');
      $city = $datetimeServiceData->get('city');
      $timezone = $datetimeServiceData->get('timezone');
      $currentTimestamp = $this->time->getCurrentTime();
      $time = $this->dateFormatter->format($currentTimestamp, 'custom', 'h:i a', $timezone);
      $date = $this->dateFormatter->format($currentTimestamp, 'custom', 'l, d F Y', $timezone);
      return ['time' => $time, 'date' => $date, 'country' => $country, 'city' => $city];
    }
  }

}