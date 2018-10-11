<?php
require 'classes/PHPExcel.php';
class ImportExportWithExcel
{
   // 一 导入数据（将Excel文件中数据导入到表中）
    public function import($path){		// $path就是要导入的Excel文件所在路径
        $objPHPExcel = \PHPExcel_IOFactory::load($path);        // 1 加载Excel文件
        $objWorksheet = $objPHPExcel->getSheet(1);              // 2 获取工作表sheet1（工作簿中最左侧第一张工作表）
        $highestRow    = $objWorksheet->getHighestRow();       // 3 取得总行数（2）
        $highestColumn = $objWorksheet->getHighestColumn();   // 4 取得总列数，返回值是字母（H)
       
		// 5 循环行（遍历行、列获取数据）
        for($i=2;$i<=$highestRow;$i++){
			// 循环列
            for($j='A';$j<=$highestColumn;$j++){
                $data[$i-2][]=$objWorksheet->getCell($j.$i)->getValue();     // 读取工作表中数据到PHP数组
            }
        }

        // 返回$data，在返回后的程序中进行入库操作
        return $data;
    }

    /*
    二 导出数据
        title:表的标题
        tableHeader：列标题
        tableName：表文件名
        data:数据
    */
    public function export($title,$tableHeader,$tableName,$data){
        $objPHPExcel=new \PHPExcel();       // 实例化PHPExcel类，操作工作表
        $objRichText=new \PHPExcel_RichText();      // 实例化一个富文本格式化类
        
        // 设置表格数据的标题
        $objPayable = $objRichText->createTextRun($title);      // 创建标题文本
        $objPayable->getFont()->setBold(true);      // 加粗
        $objPayable->getFont()->setSize(16);        // 16号字
        // 1 在当前工作表的A1单元格设置表格标题文本
        $objPHPExcel->getActiveSheet()->setCellValue('a1', $objRichText);   // 将格式化文本写在A1单元格（做为数据列表的标题）
        
        // 2 写入表头（列标题）
        foreach($tableHeader as $key=>$value){
            // $objPHPExcel->setActiveSheetIndex(0)->setCellValue($key,$value);                 // 使用A1引用方式设置单元格数据
            // $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(列号,行号,值);    // 使用R1C1引用方式设置单元格数据
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($key,2,$value);    // 使用R1C1引用方式设置单元格数据
        }

        // 3 写入主体数据（将数组中的数据填充到单元格中）
        foreach($data as $k1=>$v1){
            foreach($v1 as $k2=>$v2){
                // 语法 setCellValueByColumnAndRow(列号，行号，值)
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($k2,$k1+3,$v2);
            }
        }

        // 4 设置当前工作表表名称（工作表标签）
        $objPHPExcel->getActiveSheet()->setTitle($tableName);
        
        // 5 弹出保存文件对话框，保存文件（保存工作簿）
        header('Content-Disposition:attachment;filename="'.$tableName.'.xls"');     
        $write = new \PHPExcel_Writer_Excel5($objPHPExcel);
        $write->save('php://output');   // 保存
    }    
}