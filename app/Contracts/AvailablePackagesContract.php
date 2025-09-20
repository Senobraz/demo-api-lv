<?php

namespace App\Contracts;

interface AvailablePackagesContract
{
    static public function getPackageCodes(): array;
}
