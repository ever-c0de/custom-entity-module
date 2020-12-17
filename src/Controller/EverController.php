<?php

namespace Drupal\ever\Controller;

use Drupal\file\Entity\File;
use Drupal\views\Views;

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
    public function ever_view() {
    $page = [];
    $entity_form = \Drupal::entityTypeManager()->getStorage('ever_entity')->create();
    $page['form'] = \Drupal::service('entity.form_builder')->getForm($entity_form);
    $view = Views::getView('ever_entity_view');
    $view->setDisplay('default');
    $view->preExecute();
    $view->execute();
      if (count($view->result)) {
        $page['posts'] = $view->buildRenderable();
      }
      return $page;
    }

}
