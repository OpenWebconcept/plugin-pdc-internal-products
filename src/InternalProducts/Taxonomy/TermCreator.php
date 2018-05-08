<?php

namespace OWC\PDC\InternalProducts\Taxonomy;

class TermCreator
{

    /**
     * @var string
     */
    private $taxonomy;

    public function __construct($taxonomy)
    {
        $this->taxonomy = $taxonomy;
    }

    public function createIfNotExists($term)
    {
        if (is_null(term_exists($term, $this->taxonomy))) {
            wp_insert_term($term, $this->taxonomy);
        }
    }

}