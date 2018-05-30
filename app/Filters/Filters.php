<?php
/**
 * Created by PhpStorm.
 * User: deemantha
 * Date: 30/5/18
 * Time: 1:09 PM
 */

namespace App\Filters;


use Illuminate\Http\Request;
use function method_exists;

abstract class Filters
{
    /**
     * @var Request
     */
    protected $request;
    protected $builder;

    protected $filters = [];


    /**
     * ThreadsFilter constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder)
    {
        $this->builder = $builder;
        foreach ($this->getFilters() as $filter => $value) {
            if(method_exists($this, $filter)){
                $this->$filter($value);
            }
        }
        return $this->builder;
    }

    public function getFilters(){
        return $this->request->only($this->filters);
    }

}