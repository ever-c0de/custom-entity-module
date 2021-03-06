<?php

namespace Drupal\ever\Entity;

use Drupal\Core\Entity\Annotation\ContentEntityType;
use Drupal\ever\Controller\EverController;
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
   *
   * @throws \Drupal\Core\Entity\Exception\UnsupportedEntityTypeDefinitionException|
   * @throws \Drupal\Core\Entity\EntityStorageException
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    $fields = parent::baseFieldDefinitions($entity_type);

    // Add the published field.
    $fields += static::publishedBaseFieldDefinitions($entity_type);


    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->addConstraint('NameConstraint')
      ->setDescription(t('The name of the Ever entity entity.'))
      ->setSettings([
        'max_length' => 100,
        'min_length' => 2,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);
    $fields['email'] = BaseFieldDefinition::create('email')
      ->setLabel(t('Email'))
      ->addConstraint('EmailConstraint')
      ->setDescription(t('The email of the Ever entity entity.'))
      ->setSettings([
        'max_length' => 50,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => 1,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => 1,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['telephone'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Phone number'))
      ->addConstraint('PhoneConstraint')
      ->setDescription(t('Phone number must accord this format: +38(XXX)XXX-XX-XX.'))
      ->setSettings([
        'max_length' => 17,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'type' => 'string',
        'weight' => 2,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => 2,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['comment'] = BaseFieldDefinition::create('string_long')
      ->setLabel(t('Comment'))
      ->setDescription(t('Your comment needs to be not longer than 500 characters.'))
      ->setSettings([
        'max_length' => 500,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
        'weight' => 3,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => 3,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);


    $fields['image_avatar'] = BaseFieldDefinition::create('image')
      ->setLabel(t('Avatar'))
      ->setDescription(t('Allowed extensions: png jpg jpeg'))
      ->setSettings([
        'file_directory' => 'ever/avatars',
        'file_extensions' => 'png jpg jpeg',
        'alt_field' => 0,
        'alt_field_required' => 0,
        'default_image' => [
          'uuid' => EverController::getDefaultImage(),
          'alt' => 'Default image',
          'title' => 'Default image',
          'width' => NULL,
          'height' => NULL,
        ],
      ])
      ->setDefaultValue('default_image')
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'image',
        'weight' => 4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'image_image',
        'weight' => 4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(FALSE);

    $fields['image_photo'] = BaseFieldDefinition::create('image')
      ->setLabel(t('Photo'))
      ->setDescription(t('Allowed extensions: png jpg jpeg'))
      ->setSettings([
        'file_directory' => 'ever/photos',
        'file_extensions' => 'png jpg jpeg',
        'alt_field' => 0,
        'alt_field_required' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'image',
        'weight' => 5,
      ])
      ->setDisplayOptions('form', [
        'type' => 'image_image',
        'weight' => 5,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(FALSE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Posted on'))
      ->setDescription(t('The time when the post was created.'))
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'timestamp',
        'settings' => [
          'date_format' => 'custom',
          'custom_date_format' => 'F/d/Y H:i:s',
        ],
        'weight' => 6,
      ])
      ->setDisplayOptions('form', [
        'type' => 'datetime_timestamp',
        'weight' => 6,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
