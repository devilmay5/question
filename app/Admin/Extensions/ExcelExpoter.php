<?php
/**
 * Created by PhpStorm.
 * User: zhangshuwei
 * Date: 2019/4/4
 * Time: 9:56
 */
namespace App\Admin\Extensions;

use Encore\Admin\Grid\Exporters\AbstractExporter;
use Maatwebsite\Excel\Facades\Excel;

class ExcelExpoter extends AbstractExporter
{
    public function export()
    {
        Excel::create('wjjnb', function($excel) {

            $excel->sheet('wjjnb1', function($sheet) {

                // 这段逻辑是从表格数据中取出需要导出的字段
                $rows = collect($this->getData())->map(function ($item) {
                    return array_only($item, ['id', 'title',  'rate']);
                });

                $sheet->rows($rows);

            });

        })->export('xls');
    }
}