<?php

namespace App\Helpers;

Interface ExcelInterface
{

    public function getData();

    public function createFile($data);

}