<?php
/**
 * CRUD application using an object-oriented approach and following the MVC pattern.
 * Need to sanitization our properties so we will require the Sanitizer class.
 */
require '../utilities/Sanitizer.php';

class Villain {
    private $name;
    private $alias;
    private $introduction;
    private $image;
    private $image_files = [
        'the_joker.jpg',
        'harley_quinn.jpg',
        'the_riddler.jpg',
        'penguin.jpg',
        'mad_hatter.jpg',
        'killer_croc.jpg',
        'bane.jpg',
        'calendar_man.jpg',
        'mr_freeze.jpg',
        'deathstroke.jpg',
        'deadshot.jpg',
        'black_mask.jpg',
        'copperhead.jpg',
        'electrocutioner.jpg',
        'firefly.jpg',
        'shiva.jpg',
        'bird.jpg',
        'anarky.jpg',
        'scarecrow.jpg',
        'scarface.jpg',
        'poison_ivy.jpg',
        'victor_zsasz.jpg',
        'clayface.jpg',
        'hugo_strange.jpg',
        'two_face.jpg',
        'ras_al_ghul.jpg',
        'hush.jpg',
        'azrael.jpg',
        'solomon_grundy.jpg',
        'talia_al_ghul.jpg',
        'professor_pyg.jpg',
        'deacon_blackfire.jpg',
        'man_bat.jpg'
    ];

    // In order to keep our properties encapsulated we will want to use private or protected properties with getters and setters.
    public function __construct(array $input_values) {
        $this->set_name($input_values['name']);
        $this->set_alias($input_values['alias']);
        $this->set_introduction($input_values['introduction']);
        $this->set_image($input_values['image']);
    }

    /**
     * The __get() magic method is used as a universal getter method which gets the value of any private or protected property.
     * 
     * Like the __construct() method it is not necessary to call the __get() method so you can use private and protected properties as if they are public.
     */
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    /**
     * There is also a __set() magic method but we won't use that as we want to do unique sanization and validation for each of our properties using setter methods.
     */
    public function set_name(string $value) {
        $this->name = Sanitizer::format_name($value);
    }

    public function set_alias($value) {
        $this->alias = Sanitizer::format_name($value);
    }

    public function set_introduction($value) {
        $this->introduction = Sanitizer::escape_html($value);
    }

    public function set_image(string $value) {
        $this->image = Sanitizer::filter_file($value, $this->image_files);
        if (empty($this->image)) {
            $this->image = $this->image_files[0];
        }
    }
}