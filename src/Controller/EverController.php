<?php

namespace Drupal\ever\Controller;

use Drupal\file\Entity\File;
use Drupal\views\Views;
/**
 * Class EverController.
 *
 * Implement methods getDefaultImage() and fullView.
 *
 * @package Drupal\ever\Controller
 */
class EverController {

  /**
   * Method that load default image for user and return uuid of image.
   *
   * @return string|null
   *   Returns uuid of image
   *
   * @throws \Drupal\Core\Entity\EntityStorageException
   *   Throw exception if file does not exist.
   */
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

  /**
   * Method gets ever_entity form and ever_entity_view for rendering ready page.
   *
   * @return array
   *   Returns the array form & posts(view).
   *
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public function fullView() {
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
