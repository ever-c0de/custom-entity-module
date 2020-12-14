<?php

namespace Drupal\ever\Plugin\Constraint;

use Drupal;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class EmailValidator extends ConstraintValidator {

  public function validate($value, Constraint $constraint) {
    Drupal::messenger()->deleteByType('error');
    foreach ($value as $item) {


      }
    }
  }

}
