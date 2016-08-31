<?php

namespace Api\Controllers;

use App\Helpers\ExcelParser;
use Api\Requests\ExcelRequest;

/**
 * @Resource('Excel', uri='/excel')
 */
class ExcelController extends BaseController
{

    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    /**
     * Import excel
     *
     * @param  \App\Helpers\ExcelParser $excel
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ExcelParser $excelParser)
    {
        try {
            $data = $excelParser->getData();
        } catch (\Exception $e) {

            return response('something goes wrong', 400);
        }
        return response()->json($data);
    }

    /**
     * Store excel
     *
     * @param  \App\Helpers\ExcelParser $excel
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ExcelParser $excelParser, ExcelRequest $request)
    {
        $base64EncodedFile = $request->get('file');
        try {
            $excelParser->createFile($base64EncodedFile);
        } catch (\Exception $e) {

            return response('something goes wrong', 409);
        }

        return response('successful upload', 201);
    }
}
