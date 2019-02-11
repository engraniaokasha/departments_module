<?php

namespace Modules\Departments\Entities;

use Illuminate\Database\Eloquent\Model;

class DepartmentsTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'departments__departments_translations';
}
