<?php

namespace Drupal\ever\Entity;

use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityPublishedTrait;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Defines the Ever entity entity.
 *
 * @ingroup ever
 *
 * @ContentEntityType(
 *   id = "ever_entity",
 *   label = @Translation("Ever entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\ever\EverEntityListBuilder",
 *     "views_data" = "Drupal\ever\Entity\EverEntityViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\ever\Form\EverEntityForm",
 *       "add" = "Drupal\ever\Form\EverEntityForm",
 *       "edit" = "Drupal\ever\Form\EverEntityForm",
 *       "delete" = "Drupal\ever\Form\EverEntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\ever\EverEntityHtmlRouteProvider",
 *     },
 *     "access" = "Drupal\ever\EverEntityAccessControlHandler",
 *   },
 *   base_table = "ever_entity",
 *   translatable = FALSE,
 *   admin_permission = "administer ever entity entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "langcode" = "langcode",
 *     "published" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/ever_entity/{ever_entity}",
 *     "add-form" = "/admin/structure/ever_entity/add",
 *     "edit-form" = "/admin/structure/ever_entity/{ever_entity}/edit",
 *     "delete-form" = "/admin/structure/ever_entity/{ever_entity}/delete",
 *     "collection" = "/admin/structure/ever_entity",
 *   },
 *   field_ui_base_route = "ever_entity.settings"
 * )
 */
class EverEntity extends ContentEntityBase implements EverEntityInterface {

  use EntityChangedTrait;
  use EntityPublishedTrait;

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    // Add the published field.
    $fields += static::publishedBaseFieldDefinitions($entity_type);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Ever entity entity.'))
      ->setSettings([
        'max_length' => 100,
        'min_length' => 2,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);
    $fields['email'] = BaseFieldDefinition::create('email')
      ->setLabel(t('Email'))
      ->setDescription(t('The email of the Ever entity entity.'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);


    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
