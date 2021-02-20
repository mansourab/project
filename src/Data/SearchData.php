<?php

namespace App\Data;

use App\Entity\Category;

class SearchData
{

    /**
     * @var string|null
     */
    public $q = '';


    /**
     * @var Category[]
     */
    public $categories = [];

}