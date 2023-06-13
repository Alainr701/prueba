<?php
require 'vendor/autoload.php';
// require '../servicios/db.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;

function setCellStyles($sheet, $range, $styles)
{
    $sheet->getStyle($range)->applyFromArray($styles);
}

function mergeCells($sheet, $range,$rowdim)
{
    $sheet->mergeCells($range);
    $sheet->getStyle($range)->getAlignment()->setWrapText(true);
    $sheet->getStyle($range)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle($range)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    $sheet->getRowDimension($rowdim)->setRowHeight(-1);
}

function crear_excel($datos_estudiantes){
    // Crear una instancia de la hoja de cálculo
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Datos tabla
    $data = [
        ['N°', 'APELLIDOS Y NOMBRES', 'CI', 'ASISTENCIA'],
    ];
    // Establecer los datos en la hoja de cálculo
    $sheet->fromArray($data, null, 'A8');
    // Ajustar el tamaño de las columnas al contenido
    foreach (range('A', 'D') as $column) {
        $sheet->getColumnDimension($column)->setAutoSize(true);
    }
    foreach (range('W', 'Y') as $column) {
        $sheet->getColumnDimension($column)->setAutoSize(true);
    }
    $rowdim=1;
    mergeCells($sheet, 'A1:AS2',$rowdim);
    $text= "REGISTRO TÉCNICO PEDAGÓGICO\nI.T. ESCUELA INDUSTRIAL SUPERIOR" . '"' . "PEDRO DOMINGO MURILLO" . '"';
    $sheet->setCellValue('A1', $text);
    $rowdim=3;
    mergeCells($sheet, 'A3:T6',$rowdim);
    $text= "NIVEL: TÉCNICO SUPERIOR\nCARRERA: INFORMÁTICA INDUSTRIAL\nDOCENTE: \nASIGNATURA: TECNOLOGÍAS WEB II CODIGO:TEW-500 \"B\"";
    $sheet->setCellValue('A3', $text);
    mergeCells($sheet, 'U3:AS6',$rowdim);
    $text= "GESTIÓN ACADÉMICA: 2022\n PERIODO ACADÉMICO: SEGUNDO\nFECHA DE INICIO: TECNOLOGÍAS WEB II CODIGO:TEW-500 \"B\"";
    $sheet->setCellValue('U3', $text);


    $columnStyles = [
        'alignment' => [
            'wrapText' => true,
            'horizontal' => Alignment::HORIZONTAL_LEFT,
            'vertical' => Alignment::VERTICAL_CENTER,
        ],
    ];
    $columnRange = 'A3:T6';
    setCellStyles($sheet, $columnRange, $columnStyles);
    $sheet->mergeCells($columnRange);
    $columnRange = 'U3:AS6';
    setCellStyles($sheet, $columnRange, $columnStyles);
    $sheet->mergeCells($columnRange);

    // Establecer estilos y fusionar celdas para la columna de números
    $columnStyles = [
        'alignment' => [
            'wrapText' => true,
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
        ],
    ];
    $numberColumnRange = 'A8:A11';
    setCellStyles($sheet, $numberColumnRange, $columnStyles);
    $sheet->mergeCells($numberColumnRange);
    // Establecer estilos y fusionar celdas para la columna de apellidos y nombres
    $nameColumnRange = 'B8:B11';
    setCellStyles($sheet, $nameColumnRange, $columnStyles);
    $sheet->mergeCells($nameColumnRange);
    // Establecer estilos y fusionar celdas para la columna de CI
    $ciColumnRange = 'C8:C11';
    setCellStyles($sheet, $ciColumnRange, $columnStyles);
    $sheet->mergeCells($ciColumnRange);
    // Establecer estilos y fusionar celdas para la columna de asistencia
    $attendanceColumnRange = 'D8:V8';
    setCellStyles($sheet, $attendanceColumnRange, $columnStyles);
    $sheet->mergeCells( $attendanceColumnRange);

    $t = 'Tema Avanzado';
    $data = [
        ['TEMA', $t, $t, $t, $t, $t, $t, $t, $t, $t, $t, $t, $t, $t, $t, $t, $t, $t],
        ['MES', 8, 8, 8, 8, 8, 9, 9, 9, 9, 10, 10, 10, 11, 11, 11, 11, 11],
        ['DÍA', 2, 9, 16, 23, 30, 6, 13, 20, 27, 4, 8, 25, 1, 8, 15, 22, 29],
    ];

    // Establecer los datos en la hoja de cálculo
    $dataRangeStart = 'D9';
    $sheet->fromArray($data, null, $dataRangeStart);

    $rowdim=1;
    mergeCells($sheet, 'V9:V11',$rowdim);
    $text= "#";
    $sheet->setCellValue('V9', $text);

    // Definir los estilos para las celdas del rango
    $numberColumnDataStyles = [
        'alignment' => [
            'wrapText' => true,
            'horizontal' => Alignment::HORIZONTAL_LEFT,
            'textRotation' => 90, // Rotación del texto a 90 grados a la izquierda
            'vertical' => Alignment::VERTICAL_CENTER,
        ],
    ];

    $numberColumnDataRange = 'D9:U9';
    // Aplicar los estilos al rango de celdas
    $sheet->getStyle($numberColumnDataRange)->applyFromArray($numberColumnDataStyles);
    // Ajustar el tamaño de las columnas al contenido
    $sheet->getRowDimension(9)->setRowHeight(120);
    // Ajustar el tamaño de las columnas al contenido
    foreach (range('E', 'V') as $column) {
        $sheet->getColumnDimension($column)->setWidth(3); 
    }

    $rowdim=1;
    mergeCells($sheet, 'W8:X9',$rowdim);
    $text= "EVAL\nPARCIAL";
    $sheet->setCellValue('W8', $text);

    $sheet->setCellValue('W10', "1°P");
    $sheet->setCellValue('X10', "2°P");
    $sheet->setCellValue('W11', "10%");
    $sheet->setCellValue('X11', "15%");

    mergeCells($sheet, 'Y8:Y11',$rowdim);
    $text= "25%";
    $sheet->setCellValue('Y8', $text);

    $sheet->setCellValue('Z8', "TRABAJOS-LABORATORIOS");
    // Establecer estilos y fusionar celdas 
    $attendanceColumnRange = 'Z8:AM8';
    setCellStyles($sheet, $attendanceColumnRange, $columnStyles);
    $sheet->mergeCells($attendanceColumnRange);

    $t = 'Práctica Realizada';
    $data = [
        ['TEMA', $t, $t, $t, $t, $t, $t, $t, $t, $t, $t, $t, $t, $t],
        ['N°', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10,11,12,13],
        ['%', '5%', '5%','5%','3%','2%','3%','3%','3%','3%','3%','5%','5%','5%'],
    ];

    // Establecer los datos en la hoja de cálculo
    $dataRangeStart = 'Z9';
    $sheet->fromArray($data, null, $dataRangeStart);
    $numberColumnDataRange = 'Z9:AM9';
    // Aplicar los estilos al rango de celdas
    $sheet->getStyle($numberColumnDataRange)->applyFromArray($numberColumnDataStyles);
    // Ajustar el tamaño de las columnas al contenido
    $sheet->getRowDimension(9)->setRowHeight(100);

    // Ajustar el tamaño de las columnas al contenido
    $columnas=["Z","AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM"];
    foreach ($columnas as $column) {
        $sheet->getColumnDimension($column)->setWidth(3); 
    }

    $rowdim=1;
    mergeCells($sheet, 'AN8:AN11',$rowdim);
    $text= "50%";
    $sheet->setCellValue('AN8', $text);

    $rowdim=1;
    mergeCells($sheet, 'AO8:AO10',$rowdim);
    $text= "PROMEDIO GRAL";
    $sheet->setCellValue('AO8', $text);

    $rowdim=1;
    mergeCells($sheet, 'AP8:AP10',$rowdim);
    $text= "EVAL FINAL";
    $sheet->setCellValue('AP8', $text);

    $rowdim=1;
    mergeCells($sheet, 'AQ8:AQ10',$rowdim);
    $text= "PROM FINAL";
    $sheet->setCellValue('AQ8', $text);

    $rowdim=1;
    mergeCells($sheet, 'AR8:AR10',$rowdim);
    $text= "2° TURNO";
    $sheet->setCellValue('AR8', $text);

    $rowdim=1;
    mergeCells($sheet, 'AS8:AS11',$rowdim);
    $text= "OBSERVACION";
    $sheet->setCellValue('AS8', $text);

    $sheet->setCellValue('AO11', "80%");
    $sheet->setCellValue('AP11', "###");
    $sheet->setCellValue('AQ11', "100%");
    $sheet->setCellValue('AR11', "61%");

    $numberColumnDataRange = 'AO8:AR8';

    // Aplicar los estilos al rango de celdas
    $sheet->getStyle($numberColumnDataRange)->applyFromArray($numberColumnDataStyles);
    // Ajustar el tamaño de las columnas al contenido
    $sheet->getRowDimension(9)->setRowHeight(100);

    // Ajustar el tamaño de las columnas al contenido
    $columnas=["AN","AO","AP","AQ","AR","AS"];
    foreach ($columnas as $column) {
        $sheet->getColumnDimension($column)->setAutoSize(true);
    }

    $titleRange = 'A7:AS7';
    $sheet->mergeCells($titleRange);

    //Colores

    $sheet->getStyle('A8:X8')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('B2EBF2');
    $sheet->getStyle('Z8:AM8')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('B2EBF2');
    $sheet->getStyle('AO8:AS8')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('B2EBF2');
    $sheet->getStyle('D9')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('B2EBF2');
    $sheet->getStyle('Z9')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('B2EBF2');
    $sheet->getStyle('Y8')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('488FEF');
    $sheet->getStyle('AN8')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('488FEF');
    $sheet->getStyle('V9')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('488FEF');
    $sheet->getStyle('E9:U9')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('B5FF6F');
    $sheet->getStyle('AA9:AM9')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('B5FF6F');

    //Borde
    $startCell = 'A8';
    $endCell = 'AS11';

    // Aplicar bordes a todas las celdas
    $styleArray = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN, // Estilo de borde medio
                'color' => ['rgb' => '000000'], // Color de línea negro
            ],
        ],
    ];

    $sheet->getStyle($startCell . ':' . $endCell)->applyFromArray($styleArray);

    $sheet->fromArray($datos_estudiantes, null, 'A12');
    $startCell = 'A12';
    $endCell = 'AS'.(11+count($datos_estudiantes));
    $sheet->getStyle($startCell . ':' . $endCell)->applyFromArray($styleArray);


    // Establecer encabezados de respuesta
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="reporte.xlsx"');

    // Enviar el archivo al navegador
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $writer->save('php://output');
}
$data=[];
// if (isset( $_POST['codigo'])) {
//     //Consultar a la base de datos------------------
//         //Datos de muetra
//     $data = [
//         [1,"PEREZ PEREZ JUAN","12sdsdsd345"," ","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","5","10","11","21"," ",2,2,3,3,2,3,4,3,4,5,3,2,4,39,65,"#",75," ","APROBADO"],
//         [2,"PEREZ PEREZ JUAN",12345," ","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","5","10","11","21"," ",2,2,3,3,2,3,4,3,4,5,3,2,4,39,65,"#",75," ","APROBADO"],
//         [3,"PEREZ PEREZ JUAN",12345," ","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","5","10","11","21"," ",2,2,3,3,2,3,4,3,4,5,3,2,4,39,65,"#",75," ","APROBADO"],
//         [4,"PEREZ PEREZ JUAN",12345," ","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","5","10","11","21"," ",2,2,3,3,2,3,4,3,4,5,3,2,4,39,65,"#",75," ","APROBADO"],
//         [5,"PEREZ PEREZ JUAN",12345," ","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","5","10","11","21"," ",2,2,3,3,2,3,4,3,4,5,3,2,4,39,65,"#",75," ","APROBADO"],
//         [6,"PEREZ PEREZ JUAN",12345," ","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","5","10","11","21"," ",2,2,3,3,2,3,4,3,4,5,3,2,4,39,65,"#",43," ","REPROBADO"],
//     ];
//     crear_excel($data);
// }else{
//     if ( isset( $_GET['data'])) {
//         //Consultar a la base de datos------------------
//         //Datos de muetra
//         $id_estudiante = 1;
//         $apellido_paterno = "PEREZ";
//         $apellido_materno = "PEREZ";
//         $nombres = "JUAN";
//         $ci = "12345";
//         $asistencia_valor = "A";
//         $data[] = array(
//             $id_estudiante,
//             $apellido_materno . " " . $apellido_paterno . " " . $nombres,
//             $ci,
//             " ",
//             // $id_asistencia,
//             // $id_materia,
//             // $fecha,
//             $asistencia_valor
//         );
//         // $data = [
//         //     [1,"asdasd",123],
//         //     [2,"PEREZ PEREZ JUAN",12345," ","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","5","10","11","21"," ",2,2,3,3,2,3,4,3,4,5,3,2,4,39,65,"#",75," ","APROBADO"],
//         //     [3,"PEREZ PEREZ JUAN",12345," ","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","5","10","11","21"," ",2,2,3,3,2,3,4,3,4,5,3,2,4,39,65,"#",75," ","APROBADO"],
//         //     [4,"PEREZ PEREZ JUAN",12345," ","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","5","10","11","21"," ",2,2,3,3,2,3,4,3,4,5,3,2,4,39,65,"#",75," ","APROBADO"],
//         //     [5,"PEREZ PEREZ JUAN",12345," ","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","5","10","11","21"," ",2,2,3,3,2,3,4,3,4,5,3,2,4,39,65,"#",75," ","APROBADO"],
//         //     [6,"PEREZ PEREZ JUAN",12345," ","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","5","10","11","21"," ",2,2,3,3,2,3,4,3,4,5,3,2,4,39,65,"#",43," ","REPROBADO"],
//         // ];
//         crear_excel($data);
        
//     }else {
//         echo "no existe código";
//     }
// }

?>
