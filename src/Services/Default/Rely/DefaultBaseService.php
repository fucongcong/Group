<?php
namespace src\Services\Default\Rely;

use Service;

abstract class DefaultBaseService extends Service
{
    public function getDefaultDao()
    {
        return $this->createDao("Default:Default");
    }
}