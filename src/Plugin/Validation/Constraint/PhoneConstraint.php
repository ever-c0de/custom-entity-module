<?php

namespace Drupal\ever\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Checks that the submitted value is a unique integer.
 *
 * @Constraint(
 *   id = "UniqueInteger",
 *   label = @Translation("Unique Integer", context = "Validation"),
 *   type = "string"
 * )
 */
class PhoneConstraint extends Constraint {

  // The message that will be shown if the value is not an integer.
  public $notInteger = '%value is not an integer';

  // The message that will be shown if the value is not unique.
  public $notUnique = '%value is not unique';

}
