<?php

namespace AppMain\Statistic\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = 'sites';

    protected $fillable = ['sites_name','date','jobs_all','jobs_public','jobs_duplicated'];
    use HasFactory;
}
