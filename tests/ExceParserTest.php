<?php

use App\Helpers\ExcelParser;

class ExcelParserTest extends TestCase
{

    /**
     * Test if file format is excel
     */
    public function testFileFormat()
    {
        $excelParser = new ExcelParser(2);
        $result = $excelParser->checkIfFileFormatExcel('edfwe');
        $this->assertFalse($result);
        $result = $excelParser->checkIfFileFormatExcel('Excel2007');
        $this->assertTrue($result);

    }

    /**
     * Test if file created
     */
    public function testFileCreated()
    {
        $excelParser = new ExcelParser(2);
        $excelParser->setExcelFilePath('/tmp/test_test');
        $excelParser->createFile(base64_encode('test_data'));
        $this->assertTrue(file_exists('/tmp/test_test'));
    }

}
