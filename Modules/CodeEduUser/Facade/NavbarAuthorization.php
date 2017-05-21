<?php

namespace CodeEduUser\Facade;

use Illuminate\Support\Facades\Facade;
use CodeEduUser\Menu\Navbar;

class NavbarAuthorization extends Facade {
    protected static function getFacadeAccessor(){
        return Navbar::class;
    }
}
