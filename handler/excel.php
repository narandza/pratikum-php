<?php
    include "../config/connection.php";
    include "functions.php";
    $path= "C:\Users\dimitrije\Desktop\products1.xls";
    $products = fetchProductsGenderBrand();
    if(!file_exists($path)){
        $excel_app = new COM("Excel.application") or Die("Connection with Excel failed.");
        $workbook = $excel_app->Workbooks->Add();
        $worksheet = $workbook->Worksheets("Sheet1");

        $field=$worksheet->Range("A1");
        $field->activate;
        $field->Value = "Product Id";
        $field=$worksheet->Range("B1");
        $field->activate;
        $field->Value = "Brand";
        $field=$worksheet->Range("C1");
        $field->activate;
        $field->Value = "Model";
        $field=$worksheet->Range("D1");
        $field->activate;
        $field->Value = "Gender";
        $field=$worksheet->Range("E1");
        $field->activate;
        $field->Value = "Price";
        $i=2;
        foreach($products as $product){
            $field=$worksheet->Range("A".$i);
            $field->activate;
            $field->Value = $product->id;
            $field=$worksheet->Range("B".$i);
            $field->activate;
            $field->Value = $product->brand;
            $field=$worksheet->Range("C".$i);
            $field->activate;
            $field->Value = $product->model;
            $field=$worksheet->Range("D".$i);
            $field->activate;
            $field->Value = $product->gender;
            $field=$worksheet->Range("E".$i);
            $field->activate;
            $field->Value = $product->price;
            $i++;
        }
        $field=$worksheet->Range("F1");
        $field->activate;
        $field->Value = $i;

        $workbook->_SaveAs($path,-4143);
        $workbook->Save();
        $workbook->Close;

        unset($worksheet);
        unset($workbook);

        $excel_app->Workbooks->Close();
        $excel_app->Quit();
        unset($excel_app);
    }
    else{
        $excel_app = new COM("Excel.application") or Die("Connection with Excel failed.");
        $workbook = $excel_app->Workbooks->Open($path);
        $worksheet = $workbook->Worksheets("Sheet1");
        $worksheet->activate;
        $row_number=$worksheet->Range("F1");
        $row_number->activate;
        $i=$row_number->Value;
        $i+=1;
        foreach($products as $product){
            if($product->id >= $i){
                $field=$worksheet->Range("A".$i);
                $field->activate;
                $field->Value = $product->id;
                $field=$worksheet->Range("B".$i);
                $field->activate;
                $field->Value = $product->brand;
                $field=$worksheet->Range("C".$i);
                $field->activate;
                $field->Value = $product->model;
                $field=$worksheet->Range("D".$i);
                $field->activate;
                $field->Value = $product->gender;
                $field=$worksheet->Range("E".$i);
                $field->activate;
                $field->Value = $product->price;
                $i++;
            }
        }
        $field=$worksheet->Range("F1");
        $field->activate;
        $field->Value = $i;

        $workbook->_SaveAs($path,-4143);
        $workbook->Save();
        $workbook->Close;

        unset($worksheet);
        unset($workbook);

        $excel_app->Workbooks->Close();
        $excel_app->Quit();
        unset($excel_app);
    }
    header("location: index.php?page=admin-panel");
?>