<?php

namespace App\Queries;

use App\Students;
use App\Search\Searchable;

class StudentListQuery implements Searchable{

    protected $scope;
    protected $request;
    protected $resource;

    public function __construct($request, $scope= null )
    {
        $this->scope = $scope ?: new Students();
        $this->request = $request;
    }

    public function searchable_fields()
    {
        return ['student_name', 'department', 'course', 'year'];
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
            /*$query->where($searchable_fields[0], 'LIKE', "%{$search_string}%");*
            for ($i = 0; $i < $count; $i++)
            {
                $query = $query->orWhere($searchable_fields[$i], 'LIKE', "%{$search_string[$searchable_fields[$i]]}%");

            }*/
        });
        return $_query;
    }

    public function get()
    {
        return $this->query()->get();
    }
}