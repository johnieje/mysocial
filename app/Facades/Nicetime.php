<?php
/**
 * Created by John Murungi.
 * User: johnieje
 * Date: 08/12/15
 * Time: 14:35 PM
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Nicetime extends Facade{
    protected static function getFacadeAccessor() { return 'niceTime'; }
}