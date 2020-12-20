<?php

namespace Drupal\ever\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;

/**
 * Provides an interface for defining Ever entity entities.
 *
 * @ingroup ever
 */
interface EverEntityInterface extends ContentEntityInterface, EntityChangedInterface, EntityPublishedInterface {

  /**
   * Gets the Ever entity name.
   *
   * @return string
   *   Name of the Ever entity.
   */
  public function getName();

  /**
   * Sets the Ever entity name.
   *
   * @param string $name
   *   The Ever entity name.
   *
   * @return \Drupal\ever\Entity\EverEntityInterface
   *   The called Ever entity entity.
   */
  public function setName($name);

  /**
   * Gets the Ever entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Ever entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Ever entity creation timestamp.
   *
   * @param int $timestamp
   *   The Ever entity creation timestamp.
   *
   * @return \Drupal\ever\Entity\EverEntityInterface
   *   The called Ever entity entity.
   */
  public function setCreatedTime($timestamp);

}
