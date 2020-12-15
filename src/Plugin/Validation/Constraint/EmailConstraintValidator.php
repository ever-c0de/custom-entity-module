<?php


namespace Drupal\ever\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class EmailConstraintValidator extends ConstraintValidator {
  /**
   * {@inheritdoc}
   */
  public function validate($items, Constraint $constraint) {
    foreach ($items as $item) {
      $match = preg_match("/^([a-z0-9_\.-]+\@[\da-z\.-]+\.[a-z\.]{2,6})$/", ($item->value));
      if ($match === 0) {
        $this->context->addViolation($constraint->invalidEmail, ['%value' => $item->value]);
      }
    }
  }

}
