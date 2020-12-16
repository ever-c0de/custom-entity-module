<?php

namespace Drupal\ever\Controller;

use Drupal\file\Entity\File;

class EverController {

  public static function getDefaultImage() {
    $filesystem = \Drupal::service('file_system');
    $image = File::create();
    $destination = "modules/custom/ever/default_image/default_user.png";
    $image->setFileUri($destination);
    $image->setOwnerId(\Drupal::currentUser()->id());
    $image->setMimeType('image/' . pathinfo($destination, PATHINFO_EXTENSION));
    $image->setFileName($filesystem->basename($destination));
    $image->setPermanent();
    $image->save();
    \Drupal::service('file.usage')
      ->add($image, 'ever', 'entity', $image->id());
    return $image->uuid();
}
  public function getForm() {
    return \Drupal::formBuilder()->getForm('ever_entity');
  }

  public function getPosts() {
    return \Drupal::entityTypeManager()->getStorage('ever_entity')->loadMultiple();
  }

}
