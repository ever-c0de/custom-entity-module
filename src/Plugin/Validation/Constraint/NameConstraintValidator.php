<?php


namespace Drupal\ever\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
/**
 * Provides validate() method for "name" field .
 *
 * @package Drupal\ever\Plugin\Validation\Constraint
 */
class NameConstraintValidator extends ConstraintValidator {

  /**
   * {@inheritdoc}
   */
  public function validate($items, Constraint $constraint) {
    foreach ($items as $item) {

      $match = preg_match("/^[\w'\-,.][^0-9_!¡?÷?¿\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$/", ($item->value));

      if (!$match) {
        $this->context->addViolation($constraint->notValid, ['%value' => $item->value]);
      }
    }
  }

}
