<?php

namespace App\Queries;

use App\Software;
use App\Specifications;
use App\Students;
use App\Search\Searchable;

class SoftwareListQuery implements Searchable{

    protected $scope;
    protected $request;
    protected $resource;

    public function __construct($request, $scope= null )
    {
        $this->scope = $scope ?: new Software();
        $this->request = $request;
    }

    public function searchable_fields()
    {
        return ['name'];
    }

    public function query()
    {
        $search_string = $this->request->fields;
        $searchable_fields = $this->searchable_fields();
        $count = count($searchable_fields);
        $_query = $this->scope->where( function($query) use ($searchable_fields, $search_string, $count) {
            $query->where('room', '=', $this->request->room);
            foreach($search_string as $key=>$val){
                $query = $query->where($key, 'LIKE', "%{$val}%");

            }
        });
        return $_query;
    }

    public function get()
    {
        return $this->query()->get();
    }
}