<?php

namespace App\Data;

class SearchData
{

    /**
     * @var int
     */
    public $page = 1;

    /**
     * @var string
     */
    public $q = '';

    /**
     * @var string
     */
    public $contrat;


    /**
     * @var null|integer
     */
    public $max;

    /**
     * @var null|date
     */
    public $date;

    /**
     * @var null|integer
     */
    public $min;

    /**
     * @var boolean
     */
    public $eligible = false;

    /**
     * @var boolean
     */
    public $disponible = false;

}
