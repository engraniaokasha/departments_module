<?php

namespace Modules\Departments\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Departments extends Model
{
    use Translatable;
    use NodeTrait;
    protected $table = 'departments__departments';
    public $translatedAttributes = [];
    protected $fillable = [];
    
}
