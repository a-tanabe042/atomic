<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment as Align;
use App\Models\Resume_Details;

class ExportController extends Controller
{
    //Resume_Detailsを初期化
    public function __construct(private Resume_Details $resume_Details,private Spreadsheet $spreadsheet){}

    /**
     * レジュメ詳細をエクセル出力
     * @param string $user_id
     * @return RedirectResponse
     */
    public function export(string $user_id):RedirectResponse
    {
        $queryBasicInfo = $this->resume_Details->getBasicInfo($user_id);
        $queryBasicInfocInfoLicense = $this->resume_Details->getBasicInfoLicense($user_id);

        $queryBasicInfoSkill = $this->resume_Details->getBasicInfoSkill($user_id);
        $querySummary = $this->resume_Details->getSummary($user_id);
        $queryCareerList = $this->resume_Details->getCareerList($user_id);
        $queryCareerSkill = $this->resume_Details->getCareerSkill($user_id);


        // スプレッドシート作成
        $sheet = $this->spreadsheet->getActiveSheet();

        $this->spreadsheet->getDefaultStyle()->getFont()->setName('メイリオ');

        // ページの余白設定
        $objPageMargins = $sheet->getPageMargins();
        $objPageMargins->setTop(0);
        $objPageMargins->setRight(0);
        $objPageMargins->setLeft(0);
        $objPageMargins->setBottom(0);

        //デフォルトの枠線を非表示
        $sheet->setShowGridlines(false);


        //列幅を3に指定
        for ($col = 'A'; $col != 'AD'; $col++) {
            $sheet->getColumnDimension($col)->setWidth(3.6);
        }

        // デフォルトスタイルオブジェクト取得
        $objDefaultStyle = $this->spreadsheet->getDefaultStyle();
        // フォントオブジェクト取得
        $objFont = $objDefaultStyle->getFont();

        // タイトル
        $objFont->setSize(14);
        $sheet->getStyle('A2:AC2')
            ->getFill()
            ->setFillType('solid')
            ->getStartColor()
            ->setARGB('C5E0B3');

        $line = $sheet->getStyle('A2:AC2');
        $arrStyle = array(
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        );
        $line->applyFromArray($arrStyle);

        $sheet->mergeCells("A2:AC2");
        $sheet->setCellValue('A2', '職務経歴書');
        $sheet->getStyle("A2")->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);

        // 氏名
        $objFont->setSize(12);
        $sheet->getStyle('A4:C5')
            ->getFill()
            ->setFillType('solid')
            ->getStartColor()
            ->setARGB('C5E0B3');

        $sheet->mergeCells("A4:C5");
        $sheet->setCellValue('A4', '氏名');
        $sheet->getStyle("A4")->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
        $sheet->getStyle('A4')->getFont()->setBold(true);

        $objFont->setSize(11);
        $sheet->mergeCells("D4:J5");
        $sheet->setCellValue('D4', $queryBasicInfo[0]->initial);
        $sheet->getStyle("D4")->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);

        // 年齢
        $objFont->setSize(12);
        $sheet->getStyle('K4:N4')
            ->getFill()
            ->setFillType('solid')
            ->getStartColor()
            ->setARGB('C5E0B3');

        $sheet->mergeCells("K4:N4");
        $sheet->setCellValue('K4', '年齢');
        $sheet->getStyle("K4")->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
        $sheet->getStyle('K4')->getFont()->setBold(true);

        $objFont->setSize(11);
        $sheet->mergeCells("K5:N5");
        $sheet->setCellValue('K5', $queryBasicInfo[0]->age);
        $sheet->getStyle("K5")->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);

        // 性別
        $objFont->setSize(12);
        $sheet->getStyle('O4:R4')
            ->getFill()
            ->setFillType('solid')
            ->getStartColor()
            ->setARGB('C5E0B3');

        $sheet->mergeCells("O4:R4");
        $sheet->setCellValue('O4', '性別');
        $sheet->getStyle("O4")->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
        $sheet->getStyle('O4')->getFont()->setBold(true);

        $sheet->mergeCells("O5:R5");
        if ($queryBasicInfo[0]->gender == 0) {
            $gender = '男';
        } else {
            $gender = '女';
        }
        $objFont->setSize(11);
        $sheet->setCellValue('O5', $gender);
        $sheet->getStyle("O5")->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);

        // 最寄駅
        $objFont->setSize(12);
        $sheet->getStyle('S4:AC4')
            ->getFill()
            ->setFillType('solid')
            ->getStartColor()
            ->setARGB('C5E0B3');

        $sheet->mergeCells("S4:AC4");
        $sheet->setCellValue('S4', '最寄駅');
        $sheet->getStyle("S4")->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
        $sheet->getStyle('S4')->getFont()->setBold(true);

        $objFont->setSize(11);
        $sheet->mergeCells("S5:AC5");
        $sheet->setCellValue('S5', $queryBasicInfo[0]->station);
        $sheet->getStyle("S5")->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);

        // 実務年数
        $objFont->setSize(12);
        $sheet->getStyle('A6:R6')
            ->getFill()
            ->setFillType('solid')
            ->getStartColor()
            ->setARGB('C5E0B3');

        $sheet->mergeCells("A6:R6");
        $sheet->setCellValue('A6', '実務年数');
        $sheet->getStyle("A6")->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
        $sheet->getStyle('A6')->getFont()->setBold(true);

        $objFont->setSize(11);
        $sheet->mergeCells("A7:R7");
        $sheet->setCellValue('A7', $queryBasicInfo[0]->real_years . '年' . $queryBasicInfo[0]->real_month . 'ヶ月');
        $sheet->getStyle("A7")->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);

        // 稼働開始可能
        $objFont->setSize(12);
        $sheet->getStyle('S6:AC6')
            ->getFill()
            ->setFillType('solid')
            ->getStartColor()
            ->setARGB('C5E0B3');

        $sheet->mergeCells("S6:AC6");
        $sheet->setCellValue('S6', '稼働開始可能');
        $sheet->getStyle("S6")->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
        $sheet->getStyle('S6')->getFont()->setBold(true);

        $objFont->setSize(11);
        $sheet->mergeCells("S7:AC7");
        $sheet->setCellValue('S7', $queryBasicInfo[0]->start_year . '年' . $queryBasicInfo[0]->start_month . '月');
        $sheet->getStyle("S7")->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);

        /* 枠線 */
        $line = $sheet->getStyle('A4:AC7');
        $arrStyle = array(
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        );
        $line->applyFromArray($arrStyle);
        $lastrow = 8;

        /* スキル系 */
        $count = count($queryBasicInfoSkill);
        $skillArray = array(); //初期化
        $langCount = 0;
        $dbCount = 0;
        $osCount = 0;
        $middlCount = 0;
        $platCount = 0;
        $frameCount = 0;
        $othersCount = 0;

        /* スキル系多次元配列に生成 */
        for ($i = 0; $i < $count; $i++) {
            if ($queryBasicInfoSkill[$i]->class_id === 1) {
                $langCount++;
                $skillArray['Language'][$langCount] = ['class_id' => $queryBasicInfoSkill[$i]->class_id, 'skill_name' => $queryBasicInfoSkill[$i]->skill_name, 'evaluation' => $queryBasicInfoSkill[$i]->evaluation];
            } else if ($queryBasicInfoSkill[$i]->class_id === 2) {
                $dbCount++;
                $skillArray['Db'][$dbCount] = ['class_id' => $queryBasicInfoSkill[$i]->class_id, 'skill_name' => $queryBasicInfoSkill[$i]->skill_name, 'evaluation' => $queryBasicInfoSkill[$i]->evaluation];
            } else if ($queryBasicInfoSkill[$i]->class_id === 3) {
                $osCount++;
                $skillArray['Os'][$osCount] = ['class_id' => $queryBasicInfoSkill[$i]->class_id, 'skill_name' => $queryBasicInfoSkill[$i]->skill_name, 'evaluation' => $queryBasicInfoSkill[$i]->evaluation];
            } else if ($queryBasicInfoSkill[$i]->class_id === 4) {
                $middlCount++;
                $skillArray['Middleware'][$middlCount] = ['class_id' => $queryBasicInfoSkill[$i]->class_id, 'skill_name' => $queryBasicInfoSkill[$i]->skill_name, 'evaluation' => $queryBasicInfoSkill[$i]->evaluation];
            } else if ($queryBasicInfoSkill[$i]->class_id === 5) {
                $platCount++;
                $skillArray['Platform'][$platCount] = ['class_id' => $queryBasicInfoSkill[$i]->class_id, 'skill_name' => $queryBasicInfoSkill[$i]->skill_name, 'evaluation' => $queryBasicInfoSkill[$i]->evaluation];
            } else if ($queryBasicInfoSkill[$i]->class_id === 6) {
                $frameCount++;
                $skillArray['FrameWork'][$frameCount] = ['class_id' => $queryBasicInfoSkill[$i]->class_id, 'skill_name' => $queryBasicInfoSkill[$i]->skill_name, 'evaluation' => $queryBasicInfoSkill[$i]->evaluation];
            } else if ($queryBasicInfoSkill[$i]->class_id === 7) {
                $othersCount++;
                $skillArray['Others'][$othersCount] = ['class_id' => $queryBasicInfoSkill[$i]->class_id, 'skill_name' => $queryBasicInfoSkill[$i]->skill_name, 'evaluation' => $queryBasicInfoSkill[$i]->evaluation];
            }
        }

        /* 各スキル出力 */
        foreach ($skillArray as $array) {

            $arrayCount = count($array);
            $column = 'F';
            $row = $lastrow + 1;
            $firstrow = $lastrow + 1;
            $num = 0;

            foreach ($array as $key => $value) {
                if ($value['class_id'] == 1) {

                    if ($value['evaluation'] === 3) {
                        $evaluation = '◎';
                    } else if ($value['evaluation'] === 2) {
                        $evaluation = '○';
                    } else if ($value['evaluation'] === 1) {
                        $evaluation = '△';
                    }

                    $length = strlen($value['skill_name']);
                    if ($length > 14) {
                        $objFont->setSize(7);
                    } else if ($length > 12) {
                        $objFont->setSize(8);
                    } else if ($length <= 12) {
                        $objFont->setSize(9);
                    }

                    $column1 = $column;
                    $column1 = ++$column1;
                    $column1 = ++$column1;
                    $column1 = ++$column1;
                    $sheet->mergeCells($column . $row . ":" . $column1 . $row);
                    $sheet->setCellValue($column . $row, $value['skill_name']);
                    $sheet->getStyle($column . $row)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);

                    $line = $sheet->getStyle($column . $row . ":" . $column1 . $row);
                    $lines = $line->getBorders();
                    $lines->getRight()->setBorderStyle(Border::BORDER_THIN);

                    $eva_column = $column1;
                    $eva_column = ++$eva_column;
                    $last_eva_column = $eva_column;
                    $last_eva_column = ++$last_eva_column;

                    $objFont->setSize(9);
                    $sheet->mergeCells($eva_column . $row . ":" . $last_eva_column . $row);
                    $sheet->setCellValue($eva_column . $row, $evaluation);
                    $sheet->getStyle($eva_column . $row)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);

                    $line = $sheet->getStyle($eva_column . $row . ":" . $last_eva_column . $row);
                    $lines = $line->getBorders();
                    $lines->getRight()->setBorderStyle(Border::BORDER_THIN);

                    $column = ++$last_eva_column;

                    ++$num;
                    if ($num % 4 == 0) {
                        $objStyle = $sheet->getStyle('F' . $row . ':AC' . $row);
                        $line = $objStyle->getBorders();
                        $line->getBottom()->setBorderStyle(Border::BORDER_THIN);
                        $column = 'F';
                        $row++;
                    }

                    if ($key == $arrayCount) {
                        if ($arrayCount % 4 == 0) {
                            $row--;
                        }
                        if ($num != 0) {
                            $sheet->mergeCells('A9:E' . $row);
                            $sheet->setCellValue('A9', '言語');
                            $sheet->getStyle("A9")->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
                            $sheet->getStyle('A9')->getFont()->setBold(true);

                            /* 枠線 */
                            $objStyle = $sheet->getStyle('F9:AC' . $row);
                            $line = $objStyle->getBorders();
                            $line->getBottom()->setBorderStyle(Border::BORDER_THIN);

                            $lastrow = $row;
                        } else if ($num == 0) {
                            $lastrow = 8;
                        }
                    }
                }
                if ($value['class_id'] == 2) {

                    if ($value['evaluation'] === 3) {
                        $evaluation = '◎';
                    } else if ($value['evaluation'] === 2) {
                        $evaluation = '○';
                    } else if ($value['evaluation'] === 1) {
                        $evaluation = '△';
                    }

                    $length = strlen($value['skill_name']);
                    if ($length > 14) {
                        $objFont->setSize(7);
                    } else if ($length > 12) {
                        $objFont->setSize(8);
                    } else if ($length <= 12) {
                        $objFont->setSize(9);
                    }

                    $column1 = $column;
                    $column1 = ++$column1;
                    $column1 = ++$column1;
                    $column1 = ++$column1;
                    $sheet->mergeCells($column . $row . ":" . $column1 . $row);
                    $sheet->setCellValue($column . $row, $value['skill_name']);
                    $sheet->getStyle($column . $row)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);

                    $line = $sheet->getStyle($column . $row . ":" . $column1 . $row);
                    $lines = $line->getBorders();
                    $lines->getRight()->setBorderStyle(Border::BORDER_THIN);

                    $eva_column = $column1;
                    $eva_column = ++$eva_column;
                    $last_eva_column = $eva_column;
                    $last_eva_column = ++$last_eva_column;

                    $objFont->setSize(9);
                    $sheet->mergeCells($eva_column . $row . ":" . $last_eva_column . $row);
                    $sheet->setCellValue($eva_column . $row, $evaluation);
                    $sheet->getStyle($eva_column . $row)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);

                    $line = $sheet->getStyle($eva_column . $row . ":" . $last_eva_column . $row);
                    $lines = $line->getBorders();
                    $lines->getRight()->setBorderStyle(Border::BORDER_THIN);

                    $column = ++$last_eva_column;

                    ++$num;
                    if ($num % 4 == 0) {
                        $objStyle = $sheet->getStyle('F' . $row . ':AC' . $row);
                        $line = $objStyle->getBorders();
                        $line->getBottom()->setBorderStyle(Border::BORDER_THIN);
                        $column = 'F';
                        $row++;
                    }

                    if ($key == $arrayCount) {

                        if ($arrayCount % 4 == 0) {
                            $row--;
                        }
                        if ($num != 0) {

                            $sheet->mergeCells('A' . $firstrow . ':E' . $row);
                            $sheet->setCellValue('A' . $firstrow, 'DB');
                            $sheet->getStyle('A' . $firstrow)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
                            $sheet->getStyle('A' . $firstrow)->getFont()->setBold(true);

                            /* 枠線 */
                            $objStyle = $sheet->getStyle('F9:AC' . $row);
                            $line = $objStyle->getBorders();
                            $line->getBottom()->setBorderStyle(Border::BORDER_THIN);

                            $lastrow = $row;
                        }
                    }
                }
                if ($value['class_id'] == 3) {

                    if ($value['evaluation'] === 3) {
                        $evaluation = '◎';
                    } else if ($value['evaluation'] === 2) {
                        $evaluation = '○';
                    } else if ($value['evaluation'] === 1) {
                        $evaluation = '△';
                    }

                    $length = strlen($value['skill_name']);
                    if ($length > 14) {
                        $objFont->setSize(7);
                    } else if ($length > 12) {
                        $objFont->setSize(8);
                    } else if ($length <= 12) {
                        $objFont->setSize(9);
                    }

                    $column1 = $column;
                    $column1 = ++$column1;
                    $column1 = ++$column1;
                    $column1 = ++$column1;
                    $sheet->mergeCells($column . $row . ":" . $column1 . $row);
                    $sheet->setCellValue($column . $row, $value['skill_name']);
                    $sheet->getStyle($column . $row)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);

                    $line = $sheet->getStyle($column . $row . ":" . $column1 . $row);
                    $lines = $line->getBorders();
                    $lines->getRight()->setBorderStyle(Border::BORDER_THIN);

                    $eva_column = $column1;
                    $eva_column = ++$eva_column;
                    $last_eva_column = $eva_column;
                    $last_eva_column = ++$last_eva_column;

                    $objFont->setSize(9);
                    $sheet->mergeCells($eva_column . $row . ":" . $last_eva_column . $row);
                    $sheet->setCellValue($eva_column . $row, $evaluation);
                    $sheet->getStyle($eva_column . $row)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);

                    $line = $sheet->getStyle($eva_column . $row . ":" . $last_eva_column . $row);
                    $lines = $line->getBorders();
                    $lines->getRight()->setBorderStyle(Border::BORDER_THIN);

                    $column = ++$last_eva_column;

                    ++$num;
                    if ($num % 4 == 0) {
                        $objStyle = $sheet->getStyle('F' . $row . ':AC' . $row);
                        $line = $objStyle->getBorders();
                        $line->getBottom()->setBorderStyle(Border::BORDER_THIN);
                        $column = 'F';
                        $row++;
                    }

                    if ($key == $arrayCount) {

                        if ($arrayCount % 4 == 0) {
                            $row--;
                        }
                        if ($num != 0) {

                            $sheet->mergeCells('A' . $firstrow . ':E' . $row);
                            $sheet->setCellValue('A' . $firstrow, 'OS');
                            $sheet->getStyle('A' . $firstrow)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
                            $sheet->getStyle('A' . $firstrow)->getFont()->setBold(true);

                            /* 枠線 */
                            $objStyle = $sheet->getStyle('F9:AC' . $row);
                            $line = $objStyle->getBorders();
                            $line->getBottom()->setBorderStyle(Border::BORDER_THIN);

                            $lastrow = $row;
                        }
                    }
                }
                if ($value['class_id'] == 4) {

                    if ($value['evaluation'] === 3) {
                        $evaluation = '◎';
                    } else if ($value['evaluation'] === 2) {
                        $evaluation = '○';
                    } else if ($value['evaluation'] === 1) {
                        $evaluation = '△';
                    }

                    $length = strlen($value['skill_name']);
                    if ($length > 14) {
                        $objFont->setSize(7);
                    } else if ($length > 12) {
                        $objFont->setSize(8);
                    } else if ($length <= 12) {
                        $objFont->setSize(9);
                    }

                    $column1 = $column;
                    $column1 = ++$column1;
                    $column1 = ++$column1;
                    $column1 = ++$column1;
                    $sheet->mergeCells($column . $row . ":" . $column1 . $row);
                    $sheet->setCellValue($column . $row, $value['skill_name']);
                    $sheet->getStyle($column . $row)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);

                    $line = $sheet->getStyle($column . $row . ":" . $column1 . $row);
                    $lines = $line->getBorders();
                    $lines->getRight()->setBorderStyle(Border::BORDER_THIN);

                    $eva_column = $column1;
                    $eva_column = ++$eva_column;
                    $last_eva_column = $eva_column;
                    $last_eva_column = ++$last_eva_column;

                    $objFont->setSize(9);
                    $sheet->mergeCells($eva_column . $row . ":" . $last_eva_column . $row);
                    $sheet->setCellValue($eva_column . $row, $evaluation);
                    $sheet->getStyle($eva_column . $row)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);

                    $line = $sheet->getStyle($eva_column . $row . ":" . $last_eva_column . $row);
                    $lines = $line->getBorders();
                    $lines->getRight()->setBorderStyle(Border::BORDER_THIN);
                    $column = ++$last_eva_column;

                    ++$num;
                    if ($num % 4 == 0) {
                        $objStyle = $sheet->getStyle('F' . $row . ':AC' . $row);
                        $line = $objStyle->getBorders();
                        $line->getBottom()->setBorderStyle(Border::BORDER_THIN);
                        $column = 'F';
                        $row++;
                    }

                    if ($key == $arrayCount) {

                        if ($arrayCount % 4 == 0) {
                            $row--;
                        }
                        if ($num != 0) {

                            $sheet->mergeCells('A' . $firstrow . ':E' . $row);
                            $sheet->setCellValue('A' . $firstrow, 'ミドルウェア');
                            $sheet->getStyle('A' . $firstrow)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
                            $sheet->getStyle('A' . $firstrow)->getFont()->setBold(true);

                            /* 枠線 */

                            $objStyle = $sheet->getStyle('F' . $firstrow . ':AC' . $row);
                            $line = $objStyle->getBorders();
                            $line->getBottom()->setBorderStyle(Border::BORDER_THIN);
                            $lastrow = $row;
                        }
                    }
                }
                if ($value['class_id'] == 5) {

                    if ($value['evaluation'] === 3) {
                        $evaluation = '◎';
                    } else if ($value['evaluation'] === 2) {
                        $evaluation = '○';
                    } else if ($value['evaluation'] === 1) {
                        $evaluation = '△';
                    }

                    $length = strlen($value['skill_name']);
                    if ($length > 14) {
                        $objFont->setSize(7);
                    } else if ($length > 12) {
                        $objFont->setSize(8);
                    } else if ($length <= 12) {
                        $objFont->setSize(9);
                    }

                    $column1 = $column;
                    $column1 = ++$column1;
                    $column1 = ++$column1;
                    $column1 = ++$column1;
                    $sheet->mergeCells($column . $row . ":" . $column1 . $row);
                    $sheet->setCellValue($column . $row, $value['skill_name']);
                    $sheet->getStyle($column . $row)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);

                    $line = $sheet->getStyle($column . $row . ":" . $column1 . $row);
                    $lines = $line->getBorders();
                    $lines->getRight()->setBorderStyle(Border::BORDER_THIN);

                    $eva_column = $column1;
                    $eva_column = ++$eva_column;
                    $last_eva_column = $eva_column;
                    $last_eva_column = ++$last_eva_column;

                    $objFont->setSize(9);
                    $sheet->mergeCells($eva_column . $row . ":" . $last_eva_column . $row);
                    $sheet->setCellValue($eva_column . $row, $evaluation);
                    $sheet->getStyle($eva_column . $row)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);

                    $line = $sheet->getStyle($eva_column . $row . ":" . $last_eva_column . $row);
                    $lines = $line->getBorders();
                    $lines->getRight()->setBorderStyle(Border::BORDER_THIN);

                    $column = ++$last_eva_column;

                    ++$num; //1
                    if ($num % 4 == 0) {
                        $objStyle = $sheet->getStyle('F' . $row . ':AC' . $row);
                        $line = $objStyle->getBorders();
                        $line->getBottom()->setBorderStyle(Border::BORDER_THIN);
                        $column = 'F';
                        $row++;
                    }
                    if ($key == $arrayCount) {
                        if ($arrayCount % 4 == 0) {
                            $row--;
                        }
                        if ($num != 0) {

                            $sheet->mergeCells('A' . $firstrow . ':E' . $row);
                            $sheet->setCellValue('A' . $firstrow, 'プラットフォーム');
                            $sheet->getStyle('A' . $firstrow)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
                            $sheet->getStyle('A' . $firstrow)->getFont()->setBold(true);

                            /* 枠線 */
                            $objStyle = $sheet->getStyle('F' . $firstrow . ':AC' . $row);
                            $line = $objStyle->getBorders();
                            $line->getBottom()->setBorderStyle(Border::BORDER_THIN);
                            $lastrow = $row;
                        }
                    }
                }
                if ($value['class_id'] == 6) {

                    if ($value['evaluation'] === 3) {
                        $evaluation = '◎';
                    } else if ($value['evaluation'] === 2) {
                        $evaluation = '○';
                    } else if ($value['evaluation'] === 1) {
                        $evaluation = '△';
                    }

                    $length = strlen($value['skill_name']);
                    if ($length > 14) {
                        $objFont->setSize(7);
                    } else if ($length > 12) {
                        $objFont->setSize(8);
                    } else if ($length <= 12) {
                        $objFont->setSize(9);
                    }

                    $column1 = $column;
                    $column1 = ++$column1;
                    $column1 = ++$column1;
                    $column1 = ++$column1;
                    $sheet->mergeCells($column . $row . ":" . $column1 . $row);
                    $sheet->setCellValue($column . $row, $value['skill_name']);
                    $sheet->getStyle($column . $row)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);

                    $line = $sheet->getStyle($column . $row . ":" . $column1 . $row);
                    $lines = $line->getBorders();
                    $lines->getRight()->setBorderStyle(Border::BORDER_THIN);

                    $eva_column = $column1;
                    $eva_column = ++$eva_column;
                    $last_eva_column = $eva_column;
                    $last_eva_column = ++$last_eva_column;

                    $objFont->setSize(9);
                    $sheet->mergeCells($eva_column . $row . ":" . $last_eva_column . $row);
                    $sheet->setCellValue($eva_column . $row, $evaluation);
                    $sheet->getStyle($eva_column . $row)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);

                    $line = $sheet->getStyle($eva_column . $row . ":" . $last_eva_column . $row);
                    $lines = $line->getBorders();
                    $lines->getRight()->setBorderStyle(Border::BORDER_THIN);

                    $column = ++$last_eva_column;

                    ++$num;
                    if ($num % 4 == 0) {
                        $objStyle = $sheet->getStyle('F' . $row . ':AC' . $row);
                        $line = $objStyle->getBorders();
                        $line->getBottom()->setBorderStyle(Border::BORDER_THIN);
                        $column = 'F';
                        $row++;
                    }

                    if ($key == $arrayCount) {
                        if ($arrayCount % 4 == 0) {
                            $row--;
                        }
                        if ($num != 0) {

                            $sheet->mergeCells('A' . $firstrow . ':E' . $row);
                            $sheet->setCellValue('A' . $firstrow, 'Framework');
                            $sheet->getStyle('A' . $firstrow)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
                            $sheet->getStyle('A' . $firstrow)->getFont()->setBold(true);

                            /* 枠線 */

                            $objStyle = $sheet->getStyle('F' . $firstrow . ':AC' . $row);
                            $line = $objStyle->getBorders();
                            $line->getBottom()->setBorderStyle(Border::BORDER_THIN);
                            $lastrow = $row;
                        }
                    }
                }
                if ($value['class_id'] == 7) {

                    if ($value['evaluation'] === 3) {
                        $evaluation = '◎';
                    } else if ($value['evaluation'] === 2) {
                        $evaluation = '○';
                    } else if ($value['evaluation'] === 1) {
                        $evaluation = '△';
                    }

                    $length = strlen($value['skill_name']);
                    if ($length > 14) {
                        $objFont->setSize(7);
                    } else if ($length > 12) {
                        $objFont->setSize(8);
                    } else if ($length <= 12) {
                        $objFont->setSize(9);
                    }

                    $column1 = $column;
                    $column1 = ++$column1;
                    $column1 = ++$column1;
                    $column1 = ++$column1;
                    $sheet->mergeCells($column . $row . ":" . $column1 . $row);
                    $sheet->setCellValue($column . $row, $value['skill_name']);
                    $sheet->getStyle($column . $row)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);

                    $line = $sheet->getStyle($column . $row . ":" . $column1 . $row);
                    $lines = $line->getBorders();
                    $lines->getRight()->setBorderStyle(Border::BORDER_THIN);

                    $eva_column = $column1;
                    $eva_column = ++$eva_column;
                    $last_eva_column = $eva_column;
                    $last_eva_column = ++$last_eva_column;

                    $objFont->setSize(9);
                    $sheet->mergeCells($eva_column . $row . ":" . $last_eva_column . $row);
                    $sheet->setCellValue($eva_column . $row, $evaluation);
                    $sheet->getStyle($eva_column . $row)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
                    $line = $sheet->getStyle($eva_column . $row . ":" . $last_eva_column . $row);
                    $lines = $line->getBorders();
                    $lines->getRight()->setBorderStyle(Border::BORDER_THIN);

                    $column = ++$last_eva_column;

                    ++$num;
                    if ($num % 4 == 0) {
                        $objStyle = $sheet->getStyle('F' . $row . ':AC' . $row);
                        $line = $objStyle->getBorders();
                        $line->getBottom()->setBorderStyle(Border::BORDER_THIN);
                        $column = 'F';
                        $row++;
                    }

                    if ($key == $arrayCount) {
                        if ($arrayCount % 4 == 0) {
                            $row--;
                        }

                        if ($num != 0) {

                            $sheet->mergeCells('A' . $firstrow . ':E' . $row);
                            $sheet->setCellValue('A' . $firstrow, 'その他');
                            $sheet->getStyle('A' . $firstrow)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
                            $sheet->getStyle('A' . $firstrow)->getFont()->setBold(true);

                            /* 枠線 */

                            $objStyle = $sheet->getStyle('F' . $firstrow . ':AC' . $row);
                            $line = $objStyle->getBorders();
                            $line->getBottom()->setBorderStyle(Border::BORDER_THIN);
                            $lastrow = $row;
                        }
                    }
                }
            }
        }

        //自己PR

        log::debug(strlen($queryBasicInfo[0]->my_pr));
        if ($queryBasicInfo[0]->my_pr != null) {
            $firstrow = $lastrow + 1;
            if (strlen($queryBasicInfo[0]->my_pr) > 2600) {
                $lastrow = $firstrow + 27;
            } else if (strlen($queryBasicInfo[0]->my_pr) > 2400) {
                $lastrow = $firstrow + 25;
            } else if (strlen($queryBasicInfo[0]->my_pr) > 2200) {
                $lastrow = $firstrow + 23;
            } else if (strlen($queryBasicInfo[0]->my_pr) > 2000) {
                $lastrow = $firstrow + 21;
            } else if (strlen($queryBasicInfo[0]->my_pr) > 1800) {
                $lastrow = $firstrow + 19;
            } else if (strlen($queryBasicInfo[0]->my_pr) > 1600) {
                $lastrow = $firstrow + 17;
            } else if (strlen($queryBasicInfo[0]->my_pr) > 1400) {
                $lastrow = $firstrow + 15;
            } else if (strlen($queryBasicInfo[0]->my_pr) > 1200) {
                $lastrow = $firstrow + 13;
            } else if (strlen($queryBasicInfo[0]->my_pr) > 1000) {
                $lastrow = $firstrow + 11;
            } else if (strlen($queryBasicInfo[0]->my_pr) > 800) {
                $lastrow = $firstrow + 9;
            } else if (strlen($queryBasicInfo[0]->my_pr) > 700) {
                $lastrow = $firstrow + 7;
            } else if (strlen($queryBasicInfo[0]->my_pr) > 600) {
                $lastrow = $firstrow + 5;
            } else if (strlen($queryBasicInfo[0]->my_pr) <= 600) {
                $lastrow = $firstrow + 3;
            }

            $objFont->setSize(9);
            $sheet->getStyle('F' . $firstrow)->getAlignment()->setWrapText(true);
            $sheet->mergeCells('F' . $firstrow . ":AC" . $lastrow); //F9:I9
            $sheet->setCellValue('F' . $firstrow, $queryBasicInfo[0]->my_pr);
            $sheet->getStyle('F' . $firstrow)->getAlignment()->setVertical(Align::VERTICAL_TOP);

            $objFont->setSize(11);
            $sheet->mergeCells('A' . $firstrow . ':E' . $lastrow);
            $sheet->setCellValue('A' . $firstrow, '自己PR');
            $sheet->getStyle('A' . $firstrow)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
            $sheet->getStyle('A' . $firstrow)->getFont()->setBold(true);

            $objStyle = $sheet->getStyle('F' . $firstrow . ':AC' . $lastrow);
            $line = $objStyle->getBorders();
            $line->getBottom()->setBorderStyle(Border::BORDER_THIN);
        }

        //資格
        if ($queryBasicInfocInfoLicense != null) {

            $count = count($queryBasicInfocInfoLicense);
            $license = '';
            $num = 0;

            for ($i = 0; $i < $count; $i++) {
                if ($queryBasicInfocInfoLicense[$i]->output === 1) {
                    if ($num === 0) {
                        $license = $queryBasicInfocInfoLicense[$i]->license_name;
                    } else {
                        $license = $license . "\n" . $queryBasicInfocInfoLicense[$i]->license_name;
                    }
                    $num++;
                }
            }
            if ($num > 0) {

                $firstrow = $lastrow + 1;
                $lastrow = $firstrow + $num - 1;
                $sheet->mergeCells('F' . $firstrow . ":AC" . $lastrow);

                $objFont->setSize(9);
                $sheet->getStyle('F' . $firstrow)->getAlignment()->setWrapText(true);
                $sheet->getStyle('F' . $firstrow)->getAlignment()->setVertical(Align::VERTICAL_TOP);
                $sheet->setCellValue('F' . $firstrow, $license);

                $objFont->setSize(11);
                $sheet->mergeCells('A' . $firstrow . ':E' . $lastrow);
                $sheet->setCellValue('A' . $firstrow, '資格');
                $sheet->getStyle('A' . $firstrow)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
                $sheet->getStyle('A' . $firstrow)->getFont()->setBold(true);
            }
        }

        //スキル～資格の枠と背景色
        if ($queryBasicInfoSkill != null || $queryBasicInfo[0]->my_pr != null || $queryBasicInfocInfoLicense != null) {

            $sheet->getStyle('A9:E' . $lastrow)
                ->getFill()
                ->setFillType('solid')
                ->getStartColor()
                ->setARGB('C5E0B3');
            $line = $sheet->getStyle('A9:E' . $lastrow);
            $arrStyle = array(
                'borders' => array(
                    'allBorders' => array(
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => array('rgb' => '000000')
                    )
                )
            );
            $line->applyFromArray($arrStyle);

            $line = $sheet->getStyle('A9:AC' . $lastrow);
            $lines = $line->getBorders();
            $lines->getTop()->setBorderStyle(Border::BORDER_THIN);
            $lines->getBottom()->setBorderStyle(Border::BORDER_THIN);
            $lines->getLeft()->setBorderStyle(Border::BORDER_THIN);
            $lines->getRight()->setBorderStyle(Border::BORDER_THIN);
        }


        //summary
        if ($querySummary != null) {

            $row = $lastrow + 2; //28
            $objFont->setSize(11);
            $sheet->mergeCells('A' . $row . ':F' . $row);
            $sheet->setCellValue('A' . $row, 'プロジェクト数');
            $sheet->getStyle('A' . $row)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
            $sheet->getStyle('A' . $row)->getFont()->setBold(true);

            $sheet->mergeCells('G' . $row . ':R' . $row);
            $sheet->setCellValue('G' . $row, '作業経験');
            $sheet->getStyle('G' . $row)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
            $sheet->getStyle('G' . $row)->getFont()->setBold(true);

            $sheet->mergeCells('S' . $row . ':AC' . $row);
            $sheet->setCellValue('S' . $row, '管理経験');
            $sheet->getStyle('S' . $row)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
            $sheet->getStyle('S' . $row)->getFont()->setBold(true);


            //背景色
            $sheet->getStyle('A' . $row . ':AC' . $row)
                ->getFill()
                ->setFillType('solid')
                ->getStartColor()
                ->setARGB('C5E0B3');

            //プロジェクト数
            $firstrow = $row + 1;
            $lastrow = $firstrow + 5;
            $line = $sheet->getStyle('A' . $row . ':AC' . $lastrow);
            $arrStyle = array(
                'borders' => array(
                    'allBorders' => array(
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => array('rgb' => '000000')
                    )
                )
            );
            $line->applyFromArray($arrStyle);

            $sheet->mergeCells('A' . $firstrow . ':F' . $lastrow);
            $sheet->setCellValue('A' . $firstrow, $querySummary[0]->pj_sum . "件");
            $sheet->getStyle('A' . $firstrow)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);

            /* 枠線 */
            $line = $sheet->getStyle('A' . $firstrow . ':AC' . $lastrow);
            $arrStyle = array(
                'borders' => array(
                    'allBorders' => array(
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => array('rgb' => '000000')
                    )
                )
            );
            $line->applyFromArray($arrStyle);



            //作業経験
            $lastrow = $lastrow - 1;
            $title = array('要件定義', '基本設計', '詳細設計', '開発', '単体試験', '結合試験', '総合試験', '運用試験', '環境構築', '運用保守', '調査', '教育');
            $j = 0;
            for ($i = "G"; $i != "S"; $i++) {
                $sheet->mergeCells($i . $firstrow . ':' . $i . $lastrow);
                $sheet->setCellValue($i . $firstrow, $title[$j]);
                $sheet->getStyle($i . $firstrow)->getAlignment()->setTextRotation(-165);
                $sheet->getStyle($i . $firstrow)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
                $sheet->getStyle($i . $firstrow)->getFont()->setSize(8);

                ++$j;
            }



            //要件定義
            if ($querySummary[0]->requirement > 0) {
                $summary[] = "〇";
            } else {
                $summary[] = "";
            }
            //基本設計
            if ($querySummary[0]->basic_design > 0) {
                $summary[] = "〇";
            } else {
                $summary[] = "";
            }
            //詳細設計
            if ($querySummary[0]->detail_design > 0) {
                $summary[] = "〇";
            } else {
                $summary[] = "";
            }
            //開発
            if ($querySummary[0]->development > 0) {
                $summary[] = "〇";
            } else {
                $summary[] = "";
            }
            //単体試験
            if ($querySummary[0]->unit_test > 0) {
                $summary[] = "〇";
            } else {
                $summary[] = "";
            }
            //結合試験
            if ($querySummary[0]->integration_test > 0) {
                $summary[] = "〇";
            } else {
                $summary[] = "";
            }
            //総合試験
            if ($querySummary[0]->comprehensive_test > 0) {
                $summary[] = "〇";
            } else {
                $summary[] = "";
            }
            //運用試験
            if ($querySummary[0]->operation_test > 0) {
                $summary[] = "〇";
            } else {
                $summary[] = "";
            }
            //環境構築
            if ($querySummary[0]->environment > 0) {
                $summary[] = "〇";
            } else {
                $summary[] = "";
            }
            //運用保守
            if ($querySummary[0]->operation_maintenance > 0) {
                $summary[] = "〇";
            } else {
                $summary[] = "";
            }
            //調査
            if ($querySummary[0]->survey > 0) {
                $summary[] = "〇";
            } else {
                $summary[] = "";
            }
            //教育
            if ($querySummary[0]->education > 0) {
                $summary[] = "〇";
            } else {
                $summary[] = "";
            }

            $row = $lastrow + 1;
            $j = 0;
            for ($i = 'G'; $i != 'S'; $i++) {
                $sheet->setCellValue($i . $row, $summary[$j]);
                ++$j;
                $sheet->getStyle($i . $row)->getFont()->setSize(9);
                $sheet->getStyle($i . $row)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
            }

            //管理経験
            $lastrow = $firstrow + 1;
            $sheet->mergeCells('S' . $firstrow . ':AC' . $lastrow);
            if ($queryBasicInfo[0]->experience === 0) {
                $experience = "5人未満";
            } else if ($queryBasicInfo[0]->experience === 1) {
                $experience = "5人以上10人未満";
            } else if ($queryBasicInfo[0]->experience === 2) {
                $experience = "10人以上15人未満";
            } else if ($queryBasicInfo[0]->experience === 3) {
                $experience = "15人以上";
            } else if ($queryBasicInfo[0]->experience === 4) {
                $experience = "なし";
            } else {
                $experience = "";
            }
            $sheet->setCellValue('S' . $firstrow, $experience);
            $sheet->getStyle('S' . $firstrow)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);

            //役割
            $firstrow = $lastrow + 1;
            $objFont->setSize(12);
            $sheet->mergeCells('S' . $firstrow . ':AC' . $firstrow);
            $sheet->setCellValue('S' . $firstrow, "役割");
            $sheet->getStyle('S' . $firstrow)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER);
            $sheet->getStyle('S' . $firstrow)->getFont()->setBold(true);

            $sheet->getStyle('S' . $firstrow . ':AC' . $firstrow)
                ->getFill()
                ->setFillType('solid')
                ->getStartColor()
                ->setARGB('C5E0B3');


            $firstrow = $firstrow + 1;
            $lastrow = $firstrow + 1;
            $title = array();
            $title = array('PM', 'PMO', 'PL', 'SL', 'SE', 'PG', 'TS', 'PS', 'OM', 'HD', 'その他');
            $j = 0;
            for ($i = 'S'; $i != 'AD'; $i++) {
                $sheet->mergeCells($i . $firstrow . ':' . $i . $lastrow);
                $sheet->setCellValue($i . $firstrow, $title[$j]);
                $sheet->getStyle($i . $firstrow)->getAlignment()->setTextRotation(-165);
                $sheet->getStyle($i . $firstrow)->getFont()->setSize(8);
                ++$j;
            }
            $sheet->getStyle('T' . $firstrow)->getFont()->setSize(6);
            $sheet->getStyle('AC' . $firstrow)->getFont()->setSize(6);


            $summary = array();
            //PM
            if ($querySummary[0]->pm > 0) {
                $summary[] = "〇";
            } else {
                $summary[] = "";
            }
            //PMO
            if ($querySummary[0]->pmo > 0) {
                $summary[] = "〇";
            } else {
                $summary[] = "";
            }
            //PL
            if ($querySummary[0]->pl > 0) {
                $summary[] = "〇";
            } else {
                $summary[] = "";
            }
            //SL
            if ($querySummary[0]->sl > 0) {
                $summary[] = "〇";
            } else {
                $summary[] = "";
            }
            //SE
            if ($querySummary[0]->se > 0) {
                $summary[] = "〇";
            } else {
                $summary[] = "";
            }
            //PG
            if ($querySummary[0]->pg > 0) {
                $summary[] = "〇";
            } else {
                $summary[] = "";
            }
            //TS
            if ($querySummary[0]->ts > 0) {
                $summary[] = "〇";
            } else {
                $summary[] = "";
            }
            //PS
            if ($querySummary[0]->ps > 0) {
                $summary[] = "〇";
            } else {
                $summary[] = "";
            }
            //OM
            if ($querySummary[0]->om > 0) {
                $summary[] = "〇";
            } else {
                $summary[] = "";
            }
            //HD
            if ($querySummary[0]->hd > 0) {
                $summary[] = "〇";
            } else {
                $summary[] = "";
            }
            //その他
            if ($querySummary[0]->other > 0) {
                $summary[] = "〇";
            } else {
                $summary[] = "";
            }

            $row = $lastrow + 1;
            $j = 0;
            for ($i = 'S'; $i != 'AC'; $i++) {

                $objFont->setSize(8);
                $sheet->setCellValue($i . $row, $summary[$j]);
                ++$j;
                $sheet->getStyle($i . $row)->getFont()->setSize(9);
                $sheet->getStyle($i . $row)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
            }
        }

        if ($queryCareerList != null) {

            //経歴
            $firstrow = $row + 2;
            $lastrow = $firstrow + 4;

            //背景色と枠線
            $sheet->getStyle('A' . $firstrow . ':AC' . $lastrow)
                ->getFill()
                ->setFillType('solid')
                ->getStartColor()
                ->setARGB('C5E0B3');
            $line = $sheet->getStyle('A' . $firstrow . ':AC' . $lastrow);
            $arrStyle = array(
                'borders' => array(
                    'allBorders' => array(
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => array('rgb' => '000000')
                    )
                )
            );
            $line->applyFromArray($arrStyle);

            $sheet->getStyle('A' . $firstrow)->getFont()->setSize(9);
            $sheet->mergeCells('A' . $firstrow . ':A' . $lastrow);
            $sheet->setCellValue('A' . $firstrow, 'No.');
            $sheet->getStyle('A' . $firstrow)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
            $sheet->getStyle('A' . $firstrow)->getFont()->setBold(true);

            $sheet->getStyle('B' . $firstrow)->getFont()->setSize(9);
            $sheet->mergeCells('B' . $firstrow . ':D' . $lastrow);
            $sheet->setCellValue('B' . $firstrow, '期間');
            $sheet->getStyle('B' . $firstrow)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
            $sheet->getStyle('B' . $firstrow)->getFont()->setBold(true);

            $sheet->getStyle('E' . $firstrow)->getFont()->setSize(9);
            $sheet->mergeCells('E' . $firstrow . ':P' . $lastrow);
            $text = "開発概要\n本人担当内容・役割概要";
            $sheet->getStyle('E' . $firstrow)->getAlignment()->setWrapText(true);
            $sheet->setCellValue('E' . $firstrow, $text);
            $sheet->getStyle('E' . $firstrow)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
            $sheet->getStyle('E' . $firstrow)->getFont()->setBold(true);

            $sheet->getStyle('Q' . $firstrow)->getFont()->setSize(9);
            $sheet->mergeCells('Q' . $firstrow . ':AC' . $firstrow);
            $sheet->setCellValue('Q' . $firstrow, '作業範囲');
            $sheet->getStyle('Q' . $firstrow)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
            $sheet->getStyle('Q' . $firstrow)->getFont()->setBold(true);

            $firstrow = $firstrow + 1;
            $lastrow = $firstrow + 1;
            $sheet->getStyle('Q' . $firstrow)->getFont()->setSize(9);
            $sheet->mergeCells('Q' . $firstrow . ':Q' . $lastrow);
            $sheet->setCellValue('Q' . $firstrow, '担当');
            $sheet->getStyle('Q' . $firstrow)->getAlignment()->setTextRotation(-165);
            $sheet->getStyle('Q' . $firstrow)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
            $sheet->getStyle('Q' . $firstrow)->getFont()->setBold(true);

            $firstrow = $lastrow + 1;
            $lastrow = $firstrow + 1;
            $sheet->getStyle('Q' . $firstrow)->getFont()->setSize(9);
            $sheet->mergeCells('Q' . $firstrow . ':Q' . $lastrow);
            $sheet->setCellValue('Q' . $firstrow, '人数');
            $sheet->getStyle('Q' . $firstrow)->getAlignment()->setTextRotation(-165);
            $sheet->getStyle('Q' . $firstrow)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
            $sheet->getStyle('Q' . $firstrow)->getFont()->setBold(true);

            $firstrow = $lastrow - 3;
            $text = "プラットフォーム\nOS\nミドルウェア";
            $sheet->getStyle('R' . $firstrow)->getFont()->setSize(9);
            $sheet->getStyle('R' . $firstrow)->getAlignment()->setWrapText(true);
            $sheet->mergeCells('R' . $firstrow . ':U' . $lastrow);
            $sheet->setCellValue('R' . $firstrow, $text);
            $sheet->getStyle('R' . $firstrow)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
            $sheet->getStyle('R' . $firstrow)->getFont()->setBold(true);

            $sheet->getStyle('V' . $firstrow)->getFont()->setSize(9);
            $sheet->mergeCells('V' . $firstrow . ':X' . $lastrow);
            $sheet->setCellValue('V' . $firstrow, '言語/DB');
            $sheet->getStyle('V' . $firstrow)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
            $sheet->getStyle('V' . $firstrow)->getFont()->setBold(true);

            $text = "Framework\nIDE/ツール";
            $sheet->getStyle('Y' . $firstrow)->getFont()->setSize(9);
            $sheet->getStyle('Y' . $firstrow)->getAlignment()->setWrapText(true);
            $sheet->mergeCells('Y' . $firstrow . ':AC' . $lastrow);
            $sheet->setCellValue('Y' . $firstrow, $text);
            $sheet->getStyle('Y' . $firstrow)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
            $sheet->getStyle('Y' . $firstrow)->getFont()->setBold(true);

            $resume_first = $lastrow + 1;

            /* 経歴 */
            foreach ($queryCareerList as $queryCareerList) {

                $resume_count = 1;
                $firstrow = $lastrow + 1;
                $first_row = $firstrow;
                if (strlen($queryCareerList->pj_contents) > 600) {
                    $last_row = $firstrow + 27;
                    $row = 13;
                } else if (strlen($queryCareerList->pj_contents) > 400) {
                    $last_row = $firstrow + 23;
                    $row = 11;
                } else if (strlen($queryCareerList->pj_contents) > 200) {
                    $last_row = $firstrow + 19;
                    $row = 9;
                } else {
                    $last_row = $firstrow + 15;
                    $row = 7;
                }

                $sheet->mergeCells('A' . $firstrow . ':A' . $last_row);
                $sheet->setCellValue('A' . $firstrow, $queryCareerList->no_num);
                $sheet->getStyle('A' . $firstrow)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);

                if ($queryCareerList->current_period_flg == 1) {
                    $text = substr($queryCareerList->start_period, 0, 4) . "年" . substr($queryCareerList->start_period, 4, 2) . "月\n～\n現在";
                } else {
                    $text = substr($queryCareerList->start_period, 0, 4) . "年" . substr($queryCareerList->start_period, 4, 2) . "月\n～\n" . substr($queryCareerList->finish_period, 0, 4) . "年" . substr($queryCareerList->finish_period, 4, 2) . "月";
                }

                $objFont->setSize(9);
                $sheet->getStyle('B' . $firstrow)->getAlignment()->setWrapText(true);
                $sheet->mergeCells('B' . $firstrow . ':D' . $last_row);
                $sheet->setCellValue('B' . $firstrow, $text);
                $sheet->getStyle('B' . $firstrow)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);

                $text = "\nプロジェクト概要\n" . $queryCareerList->pj_overview . "\n\n" . $queryCareerList->pj_contents;
                $sheet->getStyle('E' . $firstrow)->getAlignment()->setWrapText(true);
                $sheet->getStyle('E' . $firstrow)->getAlignment()->setVertical(Align::VERTICAL_TOP);
                $sheet->mergeCells('E' . $firstrow . ':P' . $last_row);
                $sheet->setCellValue('E' . $firstrow, $text);

                $text = array();
                if ($queryCareerList->role_pm) {
                    $text = "PM";
                } else if ($queryCareerList->role_pmo) {
                    $text = "PMO";
                } else if ($queryCareerList->role_pl) {
                    $text = "PL";
                } else if ($queryCareerList->role_sl) {
                    $text = "SL";
                } else if ($queryCareerList->role_se) {
                    $text = "SE";
                } else if ($queryCareerList->role_pg) {
                    $text = "PG";
                } else if ($queryCareerList->role_ts) {
                    $text = "TS";
                } else if ($queryCareerList->role_ps) {
                    $text = "PS";
                } else if ($queryCareerList->role_om) {
                    $text = "OM";
                } else if ($queryCareerList->role_hd) {
                    $text = "HD";
                } else if ($queryCareerList->role_other) {
                    $text = "その他";
                } else {
                    $text = " ";
                }


                $lastrow = $firstrow + $row;
                $sheet->mergeCells('Q' . $firstrow . ':Q' . $lastrow);
                $sheet->setCellValue('Q' . $firstrow, $text);
                $sheet->getStyle('Q' . $firstrow)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);

                $firstrow = $lastrow + 1;
                $lastrow = $firstrow + $row;
                $sheet->mergeCells('Q' . $firstrow . ':Q' . $lastrow);
                $sheet->setCellValue('Q' . $firstrow, $queryCareerList->project_num);
                $sheet->getStyle('Q' . $firstrow)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);

                $firstrow = $first_row;
                $lastrow = $firstrow + 3;
                $title = array('要件定義', '基本設計', '詳細設計', '開発', '単体試験', '結合試験', '総合試験', '運用試験', '環境構築', '運用保守', '調査', '教育');
                $j = 0;
                $objFont->setSize(9);
                for ($i = "R"; $i != "AD"; $i++) {
                    $sheet->mergeCells($i . $firstrow . ':' . $i . $lastrow);
                    $sheet->setCellValue($i . $firstrow, $title[$j]);
                    $sheet->getStyle($i . $firstrow)->getAlignment()->setTextRotation(-165);
                    $sheet->getStyle($i . $firstrow)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
                    ++$j;
                }

                $process = array();
                //要件定義
                if ($queryCareerList->requirement === 1) {
                    $process[] = "〇";
                } else {
                    $process[] = "";
                }
                //基本設計
                if ($queryCareerList->basic_design === 1) {
                    $process[] = "〇";
                } else {
                    $process[] = "";
                }
                //詳細設計
                if ($queryCareerList->detail_design === 1) {
                    $process[] = "〇";
                } else {
                    $process[] = "";
                }
                //製造
                if ($queryCareerList->development === 1) {
                    $process[] = "〇";
                } else {
                    $process[] = "";
                }
                //単体試験
                if ($queryCareerList->unit_test === 1) {
                    $process[] = "〇";
                } else {
                    $process[] = "";
                }
                //結合試験
                if ($queryCareerList->integration_test === 1) {
                    $process[] = "〇";
                } else {
                    $process[] = "";
                }
                //総合試験
                if ($queryCareerList->comprehensive_test === 1) {
                    $process[] = "〇";
                } else {
                    $process[] = "";
                }
                //運用試験
                if ($queryCareerList->operation_test === 1) {
                    $process[] = "〇";
                } else {
                    $process[] = "";
                }
                //環境構築
                if ($queryCareerList->environment === 1) {
                    $process[] = "〇";
                } else {
                    $process[] = "";
                }
                //運用保守
                if ($queryCareerList->operation_maintenance === 1) {
                    $process[] = "〇";
                } else {
                    $process[] = "";
                }
                //調査
                if ($queryCareerList->survey === 1) {
                    $process[] = "〇";
                } else {
                    $process[] = "";
                }
                //教育
                if ($queryCareerList->education === 1) {
                    $process[] = "〇";
                } else {
                    $process[] = "";
                }

                $firstrow = $lastrow + 1;
                $lastrow = $firstrow;
                $j = 0;
                for ($i = "R"; $i != "AD"; $i++) {
                    $sheet->mergeCells($i . $firstrow . ':' . $i . $lastrow); //G29:G33
                    $sheet->setCellValue($i . $firstrow, $process[$j]);
                    $sheet->getStyle($i . $firstrow)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
                    ++$j;
                }



                //プラットフォーム～ミドルウェア
                $firstrow = $lastrow + 1;
                $lastrow = $last_row;

                $skill1 = "";
                $skill2 = "";
                $skill3 = "";

                foreach ($queryCareerSkill as $queryCareerSkills) {

                    if ($queryCareerList->career_id === $queryCareerSkills->career_id) {
                        if ($queryCareerSkills->class_id === 1) {
                            $skill1 = $skill1 . "\n" . $queryCareerSkills->skill_name;
                        } else if ($queryCareerSkills->class_id === 2) {
                            $skill1 = $skill1 . "\n" . $queryCareerSkills->skill_name;
                        } else if ($queryCareerSkills->class_id === 3) {
                            $skill2 = $skill2 . "\n" . $queryCareerSkills->skill_name;
                        } else if ($queryCareerSkills->class_id === 4) {
                            $skill2 = $skill2 . "\n" . $queryCareerSkills->skill_name;
                        } else if ($queryCareerSkills->class_id === 5) {
                            $skill2 = $skill2 . "\n" . $queryCareerSkills->skill_name;
                        } else if ($queryCareerSkills->class_id === 6) {
                            $skill3 = $skill3 . "\n" . $queryCareerSkills->skill_name;
                        } else if ($queryCareerSkills->class_id === 7) {
                            $skill3 = $skill3 . "\n" . $queryCareerSkills->skill_name;
                        }
                    }
                }


                $sheet->mergeCells("R" . $firstrow . ':U' . $lastrow); //G29:G33
                $sheet->setCellValue("R" . $firstrow, $skill2);
                $sheet->getStyle("R" . $firstrow)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
                $sheet->getStyle('R' . $firstrow)->getAlignment()->setWrapText(true);

                //言語/DB
                $sheet->mergeCells("V" . $firstrow . ':X' . $lastrow); //G29:G33
                $sheet->setCellValue("V" . $firstrow, $skill1);
                $sheet->getStyle("V" . $firstrow)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
                $sheet->getStyle('V' . $firstrow)->getAlignment()->setWrapText(true);

                //Framework～ツール
                $sheet->mergeCells("Y" . $firstrow . ':AC' . $lastrow); //G29:G33
                $sheet->setCellValue("Y" . $firstrow, $skill3);
                $sheet->getStyle("Y" . $firstrow)->getAlignment()->setHorizontal(Align::HORIZONTAL_CENTER)->setVertical(Align::VERTICAL_CENTER);
                $sheet->getStyle('Y' . $firstrow)->getAlignment()->setWrapText(true);

                ++$resume_count;
            }

            $line = $sheet->getStyle('A' . $resume_first . ':AC' . $last_row);
            $arrStyle = array(
                'borders' => array(
                    'allBorders' => array(
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => array('rgb' => '000000')
                    )
                )
            );
            $line->applyFromArray($arrStyle);

            $row =  $last_row + 1;
            for ($col = 1; $col != $row; $col++) {
                $sheet->getRowDimension($col)->setRowHeight(15.75);
            }
        }

        // 出力ファイル名 修正
        $fileName = "レジュメ" . $queryBasicInfo[0]->initial . "_" . $queryBasicInfo[0]->station . "駅" . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;');
        header("Content-Disposition: attachment; filename=\"{$fileName}\"");
        header('Cache-Control: max-age=0');

        // Excelファイル書き出し
        $writer = IOFactory::createWriter($this->spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
        return back();
    }
}
