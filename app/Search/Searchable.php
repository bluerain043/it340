<?php

namespace App\Search;

interface Searchable{
    public function searchable_fields();
    public function query();
    public function get();
}