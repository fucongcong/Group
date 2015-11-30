<?php

namespace src\Services\{{name}}\Rely;

use Service;

abstract class {{name}}BaseService extends Service
{
    public function get{{name}}Dao()
    {
        return $this->createDao("{{name}}:{{name}}");
    }
}