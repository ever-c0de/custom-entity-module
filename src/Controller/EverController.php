<?php

namespace Drupal\ever\Controller;

use Drupal\file\Entity\File;

class EverController {
  public static function getDefaultImage() {
    $filesystem = \Drupal::service('file_system');
    $image = File::create();
    $destination = 'modules/custom/ever/default/default_user.png';
    $image->setFileUri($destination);
  $image->setOwnerId(\Drupal::currentUser()->id());
  $image->setPermanent();
  $image->save();
  return $image->uuid();
}
}