<?php


namespace Drupal\ever\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Provides validate() method for "email" field .
 *
 * @package Drupal\ever\Plugin\Validation\Constraint
 */
class EmailConstraintValidator extends ConstraintValidator {

  /**
   * {@inheritdoc}
   */
  public function validate($items, Constraint $constraint) {
    foreach ($items as $item) {
      $match = preg_match("/^(?!.*@.*@.*$)(?!.*@.*\-\-.*\..*$)(?!.*@.*\-\..*$)(?!.*@.*\-$)(.*@.+(\..{1,11})?)$/", ($item->value));
      if ($match === 0) {
        $this->context->addViolation($constraint->invalidEmail, ['%value' => $item->value]);
      }
    }
  }

}
