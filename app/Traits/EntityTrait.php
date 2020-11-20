<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Factories\EntityFactory;

trait EntityTrait
{

    // WEB METHODS
    static function webIndex($request)
    {
        $class = (new self)->getWebEntityClass();
        return EntityFactory::build($class, self::class)->index($request);
    }


    static function webCreate()
    {
        $class = (new self)->getWebEntityClass();
        return EntityFactory::build($class, self::class)->create();
    }


    static function webStore($request)
    {
        $class = (new self)->getWebEntityClass();
        return EntityFactory::build($class, self::class)->store($request);
    }


    public function webEdit()
    {
        return EntityFactory::build($this->webEntity, $this)->edit();
    }


    public function webUpdate($request)
    {
        return EntityFactory::build($this->webEntity, $this)->update($request);
    }


    public function webDestroy()
    {
        return EntityFactory::build($this->webEntity, $this)->destroy();
    }


    // API METHODS
    static function apiIndex($request)
    {
        $class = (new self)->getApiEntityClass();
        return EntityFactory::build($class, self::class)->index($request);
    }


    static function apiStore($request)
    {
        $class = (new self)->getApiEntityClass();
        return EntityFactory::build($class, self::class)->store($request);
    }


    public function apiShow()
    {
        return EntityFactory::build($this->apiEntity, $this)->show();
    }


    public function apiUpdate($request)
    {
        return EntityFactory::build($this->apiEntity, $this)->update($request);
    }


    public function apiDestroy()
    {
        return EntityFactory::build($this->apiEntity, $this)->destroy();
    }


    // OTHER METHODS
    public function getWebEntityClass()
    {
        return $this->webEntity;
    }

    public function getApiEntityClass()
    {
        return $this->apiEntity;
    }
}
