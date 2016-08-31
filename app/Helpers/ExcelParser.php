<?php

namespace App\Helpers;

use \Excel;

class ExcelParser implements ExcelInterface
{
    const EXCEL_FILE_PATH = "../database/excel_%d.xlsx";
    private $excelFilePath;

    public function __construct($userId)
    {
        $this->excelFilePath = sprintf(self::EXCEL_FILE_PATH, $userId);
    }

    public function setExcelFilePath($excelFilePath)
    {
        $this->excelFilePath = $excelFilePath;
    }

    public function createFile($data)
    {
        if (strpos($data, ',') !== false) {
            list(, $data) = explode(',', $data);
        }
        $data = base64_decode($data);
        file_put_contents($this->excelFilePath, $data);
    }

    public
    function getData()
    {
        $fileData = \Excel::load($this->excelFilePath, function ($reader) {

        });
        if (!$this->checkIfFileFormatExcel($fileData->format)) {
            throw new \Exception('File is not excel');
        }
        $excelData['data'] = $fileData->ignoreEmpty()->get()->toArray();

        return $excelData;
    }

    public function checkIfFileFormatExcel($format)
    {
        $excelFormats = [
            'Excel2007',
        ];
        if (in_array((string)$format, $excelFormats)) {

            return true;
        }

        return false;
    }

}