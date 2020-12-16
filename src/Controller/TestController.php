<?php


namespace Drupal\ever\Controller;


class TestController
{
  /**
   * {@inheritdoc}
   */
  public function page() {
    return [
      '#theme' => 'ever',
    ];
  }
  public function getForm() {
    $a =  \Drupal::entityTypeManager()->getStorage('ever_entity');
    return var_dump($a);
  }

  public function getPosts() {
    return \Drupal::entityTypeManager()->getStorage('ever_entity')->loadMultiple();
  }

}
