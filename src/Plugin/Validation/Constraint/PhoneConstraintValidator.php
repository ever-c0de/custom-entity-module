<?php


namespace Drupal\ever\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PhoneConstraintValidator extends ConstraintValidator {
  /**
   * {@inheritdoc}
   */

  public function validate($items, Constraint $constraint) {
    foreach ($items as $item) {
      $match = preg_match('/(^(?!\+.*\(.*\).*\-\-.*$)(?!\+.*\(.*\).*\-$)(\+[0-9]{1,3}\([0-9]{1,3}\)[0-9]{1}([-0-9]{0,8})?([0-9]{0,1})?)$)|(^[0-9]{1,4}$)/', ($item->value));
      if ($match === 0) {
        $this->context->addViolation($constraint->notValid, ['%value' => $item->value]);
      }
    }
  }

}
