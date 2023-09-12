<?php

use Maatwebsite\Excel\Classes\LaravelExcelWorksheet;
use Maatwebsite\Excel\CellObject;
use Maatwebsite\Excel\CellFormat;


class BaseController extends Controller
{
    /**
     * BaseController constructor.
     */
    public $connection;
    public $connectionLMS;
    public $connectionHR;
    public $connectionATT = null;
    public $isPhone;
    public $suffitATT = "_ATT";

    public function __construct($create = 1)
    {
        try {
            $this->createConnect();

        } catch (Exception $ex) {
        }

    }

    public function createConnect()
    {
        if (Session::get('CONDEFAULT')) {
            $this->connection = DB::connection("CONDEFAULT");
        } else {
            $this->connection = DB::connection("sqlsrv");
        }
        $this->connectionLMS = DB::connection("sqlsrvLMS");
        $this->connectionHR = DB::connection("sqlsrvHR");

        View::share("connection", $this->connection);
        View::share("connectionLMS", $this->connectionLMS);
        View::share("connectionHR", $this->connectionHR);
    }

    function attConnectionSelect($sql)
    {
        $server = Helpers::decrypt_userpass(Config::get('database.connections.sqlsrv.host', ''));
        $userver = Helpers::decrypt_userpass(Config::get('database.connections.sqlsrv.username', ''));
        $password = Helpers::decrypt_userpass(Config::get('database.connections.sqlsrv.password', ''));
        $db = Helpers::decrypt_userpass(Config::get('database.connections.sqlsrv.database', '')) . $this->suffitATT;
        $connectionInfo = array("Database" => "$db", "UID" => "$userver", "PWD" => "$password");
        //$conn = sqlsrv_connect($server, $connectionInfo);

        if (strncasecmp(PHP_OS, 'WIN', 3) == 0) {
            $conn = sqlsrv_connect($server, $connectionInfo);
        } else {
            $conn = new PDO("dblib:host=$server;dbname=$db", "$userver", "$password");
        }


        if ($conn) {
            $server = Helpers::encrypt_userpass($server);
            $userver = Helpers::encrypt_userpass($userver);
            $password = Helpers::encrypt_userpass($password);
            $db = Helpers::encrypt_userpass($db);
            Config::set('database.connections.sqlsrvATT.driver', "sqlsrv");
            Config::set('database.connections.sqlsrvATT.host', "$server");
            Config::set('database.connections.sqlsrvATT.username', "$userver");
            Config::set('database.connections.sqlsrvATT.password', "$password");
            Config::set('database.connections.sqlsrvATT.database', "$db");
            try {
                $this->connectionATT = DB::connection("sqlsrvATT");
                return $this->connectionATT->select($sql);
            } catch (Exception $ex) {
                return [];
            }
        } else {
            return [];
        }
    }

    function attConnectionStatement($sql)
    {
        $server = Helpers::decrypt_userpass(Config::get('database.connections.sqlsrv.host', ''));
        $userver = Helpers::decrypt_userpass(Config::get('database.connections.sqlsrv.username', ''));
        $password = Helpers::decrypt_userpass(Config::get('database.connections.sqlsrv.password', ''));
        $db = Helpers::decrypt_userpass(Config::get('database.connections.sqlsrv.database', '')) . $this->suffitATT;
        $connectionInfo = array("Database" => "$db", "UID" => "$userver", "PWD" => "$password");
        //$conn = sqlsrv_connect($server, $connectionInfo);
        if (strncasecmp(PHP_OS, 'WIN', 3) == 0) {
            $conn = sqlsrv_connect($server, $connectionInfo);
        } else {
            $conn = new PDO("dblib:host=$server;dbname=$db", "$userver", "$password");
        }
        if ($conn) {
            $server = Helpers::encrypt_userpass($server);
            $userver = Helpers::encrypt_userpass($userver);
            $password = Helpers::encrypt_userpass($password);
            $db = Helpers::encrypt_userpass($db);
            Config::set('database.connections.sqlsrvATT.driver', "sqlsrv");
            Config::set('database.connections.sqlsrvATT.host', "$server");
            Config::set('database.connections.sqlsrvATT.username', "$userver");
            Config::set('database.connections.sqlsrvATT.password', "$password");
            Config::set('database.connections.sqlsrvATT.database', "$db");
            try {
                $this->connectionATT = DB::connection("sqlsrvATT");
                return $this->connectionATT->statement($sql);
            } catch (Exception $ex) {
                return false;
            }

        } else {
            return false;
        }
    }

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */

    protected function setupLayout()
    {
        if (!is_null($this->layout)) {

            $this->layout = View::make($this->layout . Helpers);
        }
    }

    public function getModalTitle($pForm)
    {
        $mrow = $this->connectionLMS->select("Select Desc" . Session::get('Lang') . " as FormDesc From D00T0500 Where SKey = '$pForm' And DataID='FormID'");
        if (count($mrow) == 0) return "&nbsp;";
        return $mrow[0]['FormDesc'];
    }

    public function getModalTitleG4($pForm)
    {
        $userID = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
        $sql = "--Lấy caption cho màn hình thuộc ESS va MSS" . PHP_EOL;
        $sql .= "EXEC W00P1011 '" . \Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]) . "','" . $userID . "','%','" . Session::get('Lang') . "','" . \Helpers::decrypt_userpass(\Config::get('database.connections.sqlsrvHR.database')) . "'";
        $temList = $this->connectionLMS->select($sql);
        //\Debugbar::info($temList);
        $result = array_filter($temList, function ($row) use ($pForm) {
            //return $row["FormActive"] == str_replace('D','W', $pForm) ; //PHan quyeen theo form active
            return $row["FormID"] == str_replace('W', 'D', $pForm);
        });
        $captionRow = array();
        foreach ($result as $row) {
            $captionRow = $row;
        }

        return count($captionRow) > 0 ? $captionRow["FormDesc"] : "";
    }

    public function getPermission($formid)
    {
        if (Session::has($formid)) {
            return Session::get($formid);
        } else {
            $database = Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
            $sql = "SELECT Permission FROM Lemonsys..D00V0001 WHERE UserID = '" . Auth::user()->user()->UserID . "'";
            $sql .= " AND CompanyID='$database' AND ScreenID='$formid'";
            $mrow = $this->connectionLMS->selectOne($sql);
            \Debugbar::info($mrow);
            if ($mrow == null)
                return "";
            else
                return $mrow["Permission"];
        }
    }

    /**
     * @return int|string
     */
    /*   public function ExportFile() {
           if(Request::isMethod('post'))
           {
              $Header= Input::get('title');
              $dataIndx= Input::get('dataIndx');
              $dataExport= Input::get('data');
               $result[]=$Header;
               foreach($dataExport as $r) {
                   $row=[];
                   foreach($dataIndx as $key=>$value) {
                       $row[]=isset($r[$value]) ? $r[$value]: "";
                   }
                   $result[]= $row;
               }
               try {

                   return  Helpers::ExportFile($result);

               }catch (Exception $e) {
                   return 0;
               }
           }
       }*/
    public function ExportExcel($Header, $dataExport, $format, $dataIndx, $algin, $filename = 'Data')
    {
        $headerEncode = array();
        foreach ($Header as $hd) {
            array_push($headerEncode, htmlspecialchars($hd, ENT_QUOTES));
        }
        $result = array();
        array_push($result, $headerEncode);
        $i = 0;
        foreach ($dataExport as $r) {
            //if ($i < 615){
            $row = [];
            foreach ($dataIndx as $key => $value) {
                $row[] = isset($r[$value]) ? htmlspecialchars(($r[$value]), ENT_QUOTES) : "";
            }
            array_push($result, $row);

            $i = $i + 1;
        }
        $myValueBinder = new MyValueBinder;
        try {
            $filename .= "_" . time();
            Excel::create($filename, function ($excel) use ($result, $algin) {
                $excel->sheet('Sheet_01', function ($sheet) use ($result) {
                    \Debugbar::info($result);
                    $sheet->fromArray($result);
                    $colCount = count($result[0]) - 1;
                    //get range to merge title
                    $mergeTitle = PHPExcel_Cell::stringFromColumnIndex(0) . '2:' .
                        PHPExcel_Cell::stringFromColumnIndex($colCount) . '2';
                    $sheet->cells($mergeTitle, function ($cells) {
                        $cells->setBackground('#cfcfcf');
                    });

                    //set background title
                    $sheet->getStyle($mergeTitle)
                        ->getAlignment()
                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $lastrow = $sheet->getHighestRow();
                    $mergeBody = PHPExcel_Cell::stringFromColumnIndex(0) . '0:' .
                        PHPExcel_Cell::stringFromColumnIndex($colCount) . $lastrow;
                    $sheet->setBorder($mergeBody, 'thin');

                    $arrColums = [];
                    for ($i = 0; $i <= $colCount; $i++) {
                        $colChar = PHPExcel_Cell::stringFromColumnIndex($i);
                        array_push($arrColums, $colChar);
                    }
                });

                //hide the first rows
                $excel->getActiveSheet()->getRowDimension(1)->setVisible(FALSE);
                //align for conlumns
                for ($i = 0; $i < count($algin); $i++) {
                    $col = PHPExcel_Cell::stringFromColumnIndex($i);
                    $lastrow = $excel->getActiveSheet()->getHighestRow();
                    if ($algin[$i] == 'center') {
                        $excel->getActiveSheet()
                            ->getStyle($col . '3:' . $col . $lastrow)
                            ->getAlignment()
                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    }
                    if ($algin[$i] == 'left') {
                        $excel->getActiveSheet()
                            ->getStyle($col . '3:' . $col . $lastrow)
                            ->getAlignment()
                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                    }
                    if ($algin[$i] == 'right') {
                        $excel->getActiveSheet()
                            ->getStyle($col . '3:' . $col . $lastrow)
                            ->getAlignment()
                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                    }
                }
            })->store('xls', Config::get('app.path_export'));
            if (count($format) > 0) {
                //format data
                $objPHPExcel = PHPExcel_IOFactory::load(Config::get('app.path_export') . "/" . $filename . ".xls");
                foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                    for ($row = 3; $row < count($dataExport) + 3; $row++) {
                        for ($col = 0; $col < $highestColumnIndex; $col++) {
                            $cell = $worksheet->getCellByColumnAndRow($col, $row);
                            //\Debugbar::info($cell);
                            $value = $cell->getValue();

                            $cell = $worksheet->setCellValueByColumnAndRow($col, $row, trim($value), true);
                            if ($format[$col] != "") {
                                $cell->setDataType(PHPExcel_Cell_DataType::TYPE_NUMERIC);
                                $cell->getStyle()->getNumberFormat()->setFormatCode($format[$col]);
                            }

                        }
                    }
                }

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                $objWriter->setPreCalculateFormulas(true);
                $objWriter->save(Config::get('app.path_export') . "/" . $filename . ".xls");
            }
            return url(Config::get('app.path_export') . "/" . $filename . ".xls");
        } catch (Exception $e) {
            Debugbar::info($e->getTrace());
            return 0;
        }
    }

    //Khanh bổ sung test excel
    public function ExportFile()
    {
        if (Request::isMethod('post')) {
            ini_set('memory_limit', '2048M');
            ini_set('max_execution_time', '600');
            ini_set('max_input_time', '600');
            ini_set('post_max_size', '1024M');

            $Header = Input::get('title', []);
            $dataIndx = Input::get('dataIndx', []);
            $dataExport = json_decode(Input::get('data', "{}"), true);
            $format = Input::get('format', []);
            $algin = Input::get('align', []);

            $sql = Input::get('queryString', '');

            $g = Input::get('g', '0');
            if ($sql != '') {
                if (intval($g) == 4) {
                    $dataExport = $this->connectionHR->select(Helpers::decryptData($sql));
                } else {
                    $dataExport = $this->connection->select(Helpers::decryptData($sql));
                }
            }
            return $this->ExportExcel($Header, $dataExport, $format, $dataIndx, $algin);
        }
    }

    public function sqlstring($str)
    {
        $str = str_replace("'", "''", $str);
        return $str;
    }

    public function SendMail()
    {
        ob_end_clean();
        ob_start();
        if (Request::isMethod('post')) {
            $input = Input::all();
            $content = $input['txtEmailContent'] != null ? $input['txtEmailContent'] : "";
            try {
                Mail::send('mail.default', ['content' => $content], function ($message) use ($input) {
                    /*if ($input['hdFrom'] == '')
                        $sender = Helpers::decrypt_userpass(Config::get('mail.username'));
                    else
                        $sender = $input['hdFrom'];*/

                    //Nhãn là lấy từ EmailSenderAddress, nếu nó rỗng thì lấy của hệ thống.
                    //Còn Sender thì luôn luôn lấy của hệ thống
                    //Sender và mail chứng thực thì luôn giống nhau.
                    //Email reply là email của hệ thống
                    //Khanh modify theo nhóm PWEB 2017/05/26

                    $sender = Helpers::decrypt_userpass(Config::get('mail.username'));
                    $userLabel = $input['hdFrom'] == "" ? $sender : $input['hdFrom'];
                    $message->from($sender, $userLabel);

                    // Mail không reply
                    //$reply = $sender;
                    //$message->replyTo($reply, '');

                    //Code cũ
                    //$message->from($input['hdFrom'], $input['hdFrom']);

                    $arrTo = explode(";", trim($input['txtEmailReceivedAddress']));
                    foreach ($arrTo as $to) {
                        if (trim($to) != null && trim($to) != '')
                            $message->to(trim($to))->subject($input['txtEmailTitle']);
                    }
                    //Thêm địa chỉ CC
                    $arrCC = explode(";", trim($input['txtEmailCCAddress']));

                    foreach ($arrCC as $cc) {
                        if (trim($cc) != null && trim($cc) != '')
                            $message->cc(trim($cc));
                    }
                    //Thêm địa chỉ BCC
                    $arrBCC = explode(";", trim($input['txtEmailBCCAddress']));
                    foreach ($arrBCC as $bcc) {
                        if (trim($bcc) != null && trim($bcc) != '')
                            $message->bcc(trim($bcc));
                    }
                });
            } catch (Exception $ex) {
                $content = Lang::get('message.Co_loi_xay_ra_khi_gui_mail') . '. ' . $ex->getMessage();
                return View::make('layout.message', compact("content"));
            }
            if (count(Mail::failures()) > 0) {
                $content = Lang::get('message.Co_loi_xay_ra_khi_gui_mail') . '. ' . var_dump(Mail::failures());
                return View::make('layout.message', compact("content"));
            } else {
                return 1;
            }
        }
    }

    public function SendMailAuto($content, $rData)
    {
        try {
            Mail::send('mail.default', ['content' => $content], function ($message) use ($rData) {

                //Hiện tại mình đang dùng người gửi và người chứng thực là giống nhau.
                //Nếu psad không trả ra sender thì mình sẽ lấy trong file cấu hình
                /*if ($rData['EmailSenderAddress'] == '')
                    $sender = Helpers::decrypt_userpass(Config::get('mail.username'));
                else
                    $sender = $rData['EmailSenderAddress'];*/
                //$sender = Helpers::decrypt_userpass(Config::get('mail.username'));
                //$message->from($sender, $sender);

                //Nhãn là lấy từ EmailSenderAddress, nếu nó rỗng thì lấy của hệ thống.
                //Còn Sender thì luôn luôn lấy của hệ thống
                //Sender và mail chứng thực thì luôn giống nhau.
                //Email reply là email của hệ thống
                //Khanh modify theo nhóm PWEB 2017/05/26

                $sender = Helpers::decrypt_userpass(Config::get('mail.username'));
                $userLabel = $rData['EmailSenderAddress'] == "" ? $sender : $rData['EmailSenderAddress'];
                $message->from($sender, $userLabel);

                // Mail không reply
//                $reply = $sender;
//                $message->replyTo($reply, '');

                //$message->from($rData['EmailSenderAddress'], $rData['EmailSenderAddress']);
                $arrTo = explode(";", trim($rData['EmailReceivedAddress']));
                foreach ($arrTo as $to) {
                    if (trim($to) != null && trim($to) != '')
                        $message->to(trim($to))->subject($rData['Subject']);
                }
                //Thêm địa chỉ CC
                $arrCC = explode(";", trim($rData['EmailCCAddress']));
                foreach ($arrCC as $cc) {
                    if (trim($cc) != null && trim($cc) != '')
                        $message->cc(trim($cc));
                }
                //Thêm địa chỉ BCC
                $arrBCC = explode(";", trim($rData['EmailBCCAddress']));
                foreach ($arrBCC as $bcc) {
                    if (trim($bcc) != null && trim($bcc) != '')
                        $message->bcc(trim($bcc));
                }
            });
        } catch (Exception $ex) {
            return Lang::get('message.Co_loi_xay_ra_khi_gui_mail') . '<br>' . $ex->getMessage();
        }
        if (count(Mail::failures()) > 0) {
            return Lang::get('message.Co_loi_xay_ra_khi_gui_mail');
        }
        return "";
    }


    public function getAttachFile()
    {
        $attid = Input::get("attid");
        $tablename = Input::get("tabname");
        $g = Input::get("g");
        $mod = Input::get("mod");

        if ($g == 4) {
            $query = "EXEC W91P1014 '" . Session::get("W91P0000")['DivisionID'] . "', '$mod', '$tablename', '" . Helpers::decrypt_userpass(Config::get('database.connections.sqlsrvHR.database')) . "', '$attid', '', '', '', ''";
            $rs = $this->connectionHR->select($query);
        } else {
            $query = "EXEC W91P1014 '" . Session::get("W91P0000")['DivisionID'] . "', '$mod', '$tablename', '" . Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]) . "', '$attid', '', '', '', ''";
            $rs = $this->connection->select($query);
        }

        if ($rs[0]['Content'] != '') {
            $content = pack('H' . strlen($rs[0]['Content']), $rs[0]['Content']);
            $arrFileName = explode(".", $rs[0]['FileName']);
            $filename = Helpers::utf8_to_ascii($arrFileName[0]) . "_" . date("Ymdhis", time()) . "." . $rs[0]['FileExt'];
            $filePath = public_path() . "\\Temp\\" . $filename;
            $handle = fopen($filePath, "a+");
            fwrite($handle, $content);
            return "Temp/$filename";
        }
    }

    // đổ nguồn combo
    public function LoadFixData($dataID, $g = 4, $isArray = false)
    {
        $sql = "EXEC W91P0500 '$dataID', '" . Session::get('Lang') . "'";
        $rs = [];
        $dataset = $g == 4 ? $this->connectionHR->select($sql) : $this->connection->select($sql);

        if ($isArray) {
            $rs = $dataset;
        } else {
            foreach ($dataset as $row) {
                $rs[$row['ID']] = $row['Name'];
            };
        }
        return $rs;
    }

    public function LoadDivisionID($mod, $g = 4, $bAll = false, $isArray = false)
    {
        $sql = "--Do nguon Don vi" . PHP_EOL;
        $sql .= " set nocount on" . PHP_EOL;
        $sql .= "Select Distinct T99.DivisionID as DivisionID, T16.DivisionNameU as DivisionName, 1 AS DisplayOrder" . PHP_EOL;
        $sql .= "From " . $mod . "T9999 T99 Inner Join D91T0016 T16 On T99.DivisionID = T16.DivisionID" . PHP_EOL;
        $sql .= "Inner Join " . ($g == 4 ? "D91T0061" : "D91T0060") . " T60 On T99.DivisionID = T60.DivisionID " . PHP_EOL;
        $sql .= "Where T16.Disabled = 0 And T60.UserID = '" . Auth::user()->user()->UserID . "'" . PHP_EOL;
        if ($bAll)
            $sql .= "Union All Select '%' as DivisionID,N'" . Helpers::getRS($g, "Tat_ca1") . "' as DivisionName, 0 AS DisplayOrder" . PHP_EOL;
        $sql .= "Order By DisplayOrder, T99.DivisionID";
        $rs = [];
        $dataset = $g == 4 ? $this->connectionHR->select($sql) : $this->connection->select($sql);

        if ($isArray) {
            $rs = $dataset;
        } else {
            foreach ($dataset as $row) {
                $rs[$row['DivisionID']] = $row['DivisionName'];
            };
        }

        return $rs;
    }

    //Đổ nguồn dữ liệu Kỳ
    public function LoadPeriodData($modid, $division)
    {
        $sql = "--Do nguon Ky" . PHP_EOL;
        $sql .= " Select REPLACE(STR(TranMonth, 2), ' ', '0') + '/' + STR(TranYear, 4) AS Period, REPLACE(STR(TranMonth, 2), ' ', '0') as TranMonth, STR(TranYear, 4) as TranYear " . PHP_EOL;
        $sql .= " From " . $modid . "T9999 WITH(NOLOCK) " . PHP_EOL;
        $sql .= " Where DivisionID = '$division'" . PHP_EOL;
        $sql .= " Order By TranYear DESC, TranMonth DESC";
        return $this->connection->select($sql);
    }

    public function LoadComboPeriod($mod, $division)
    {
        $period = $this->LoadPeriodData($mod, $division);
        $str = "";
        foreach ($period as $row) {
            $str .= "<option value='" . $row["TranYear"] . $row["TranMonth"] . "'>" . $row["Period"] . "</option>";
        }
        return $str;
    }

    //Load combo Year
    public function LoadComboYear($mod, $division, $isReload = false)
    {

        $sql = "SELECT 	DISTINCT TranYear AS TranYear " . PHP_EOL;
        $sql .= " FROM 	" . $mod . "T9999 WITH (NOLOCK) " . PHP_EOL;
        $sql .= " WHERE DivisionID =  '$division'" . PHP_EOL;
        $sql .= " ORDER BY 	TranYear Desc" . PHP_EOL;
        $rs = $this->connection->select($sql);
        $str = "";
        if ($isReload) {
            foreach ($rs as $row) {
                $str .= "<option value='" . $row["TranYear"] . "'>" . $row["TranYear"] . "</option>";
            }
            return $str;
        } else {
            return $rs;
        }
    }

    //Đổ nguồn dữ liệu Loại đối tượng
    public function LoadObjectTypeIDData($hasPercent)
    {
        $sql = "--Do nguon Loai doi tuong" . PHP_EOL;
        $sql .= "Select ObjectTypeID, " . (Session::get('Lang') == "84" ? "ObjectTypeNameU" : "ObjectTypeName01U") . " as ObjectTypeName, 1 as DisplayOrder  " . PHP_EOL;
        $sql .= "From D91T0005 WITH(NOLOCK) " . PHP_EOL;
        if ($hasPercent) {
            $sql .= "Union All" . PHP_EOL;
            $sql .= "Select '%' as ObjectTypeID, N'" . Lang::get("message.Tat_ca_Web") . "' as ObjectTypeName, 0 as DisplayOrder " . PHP_EOL;
        }
        $sql .= "Order By DisplayOrder, ObjectTypeID";
        return $this->connection->select($sql);
    }

    //Đổ nguồn Đối tượng theo ObjectTypeID
    public function LoadObjectIDData($obtypeid, $bdisable = true, $addnew = false, $hasPercent = false)
    {
        $sql = "--Do nguon Doi tuong" . PHP_EOL;
        $sql .= "SELECT ObjectID, ObjectNameU as ObjectName, 1 AS DisplayOrder" . PHP_EOL;
        $sql .= "FROM Object WITH(NOLOCK)" . PHP_EOL;
        if ($addnew) {
            $sql .= "Union All" . PHP_EOL;
            $sql .= "Select '+' as ObjectID, N'" . Lang::get("message.Them_moi_U") . "' as ObjectName, 0 as DisplayOrder " . PHP_EOL;
        }
        if ($hasPercent) {
            $sql .= "Union All" . PHP_EOL;
            $sql .= "Select '%' as ObjectID, N'" . Lang::get("message.Tat_ca_Web") . "' as ObjectName, 0 as DisplayOrder " . PHP_EOL;
        }
        $sql .= "WHERE ObjectTypeID='$obtypeid' and ((ISNULL(StrDivisionID,'')= '' OR CHARINDEX(';'+" . Session::get("W91P0000")['DivisionID'] . "+';' , ';' +ISNULL(StrDivisionID,'') +';') <> 0)" . PHP_EOL;
        $sql .= "And (DAG = '' Or DAG In (Select DAGroupID From LemonSys.dbo.D00V0080" . PHP_EOL;
        $sql .= "Where UserID = '" . Auth::user()->user()->UserID . "' ) Or 'LEMONADMIN' = '" . Auth::user()->user()->UserID . "')" . PHP_EOL;
        if ($bdisable)
            $sql .= "And Disabled = 0" . PHP_EOL;
        $sql .= "ORDER BY DisplayOrder, ObjectID";
        return $this->connection->select($sql);
    }

    //Đổ nguồn combo người lập
    public function LoadCreateByData()
    {
        $sql = "--Do nguon combo Nguoi lap" . PHP_EOL;
        $sql .= " SELECT Object.ObjectID as EmployeeID, Object.ObjectNameU as EmployeeName" . PHP_EOL;
        $sql .= " FROM 	Object  WITH(NOLOCK) " . PHP_EOL;
        $sql .= " WHERE Disabled = 0 And  Object.ObjectTypeID = 'NV'" . PHP_EOL;
        $sql .= " And (	DAG ='' Or DAG In (Select DAGroupID From LemonSys.dbo.D00V0080 " . PHP_EOL;
        $sql .= " Where UserID= '" . Auth::user()->user()->UserID . "' ) Or 'LEMONADMIN' = '" . Auth::user()->user()->UserID . "') " . PHP_EOL;
        $sql .= " ORDER BY ObjectID";
        $dataset = $this->connection->select($sql);
        foreach ($dataset as $row) {
            $rs[$row['EmployeeID']] = $row['EmployeeName'];
        };
        return $rs;
    }

    //Đổ nguồn combo Loại tiền
    public function LoadCurrencyIDData($hasPercent = false)
    {
        $sql = "--Do nguon cho loai tien" . PHP_EOL;
        $sql .= "Select CurrencyID, CurrencyNameU As CurrencyName, ExchangeRate, Operator, MethodID, OriginalDecimal, ExchangeRateDecimal,UnitPriceDecimals ";
        $sql .= ", 1 AS DisplayOrder ";
        $sql .= "From D91V0010 Where Disabled =0 " . PHP_EOL;
        if ($hasPercent) {
            $sql .= "Union All" . PHP_EOL;
            $sql .= "Select '%' as CurrencyID, N'" . Lang::get("message.Tat_ca_Web") . "' As CurrencyName, 1 as ExchangeRate, 0 as Operator, '' as MethodID, 0 as OriginalDecimal, 0 as  ExchangeRateDecimal, 0 as UnitPriceDecimals" . PHP_EOL;
            $sql .= ", 0 AS DisplayOrder ";
        }
        $sql .= "Order By DisplayOrder, CurrencyID ";
        return $this->connection->select($sql);
    }

    // đổ nguồn combo
    public function LoadSearchFieldName($formID, $mod, $g)
    {
        $rs = [];
        $sql = "-- Do nguon combo tim kiem" . PHP_EOL;
        if ($g == 4) {
            $sql .= "EXEC W91P1015 '$mod', '" . Session::get("W91P0000")['HRDivisionID'] . "', '" . Auth::user()->user()->UserID . "', '$formID'";
            $rsFilter = $this->connectionHR->select($sql);
        } else {
            $sql .= "EXEC W91P1015 '$mod', '" . Session::get("W91P0000")['DivisionID'] . "', '" . Auth::user()->user()->UserID . "', '$formID'";
            $rsFilter = $this->connection->select($sql);
        }
        foreach ($rsFilter as $row) {
            $rs[$row['SearchFieldID']] = $row['SearchFieldName'];
        };
        return $rs;
    }

    //Lấy tỷ giá theo ngày
    public function GetExchangeRate($currency, $date, $module = "", $formid = "", $bankid = "")
    {
        $sql = "--Lay ty gia theo ngay" . PHP_EOL;
        $sql .= "EXEC D91P0010 '$currency','$date','$module','$formid','$bankid','" . Session::get("W91P0000")['DivisionID'] . "','" . Auth::user()->user()->UserID . "','WEB'";
        $rs = $this->connection->select($sql);
        if (isset($rs[0]["ExchangeRate"]))
            return number_format($rs[0]["ExchangeRate"], Session::get("W91P0000")['ExchangeRateDecimals']);
        return 0;
    }

    //Load combo Nhóm truy cập dữ liệu
    public function LoadDAGroupID($mode = 0)
    {
        //$mode = 0: ko bắt buộc nhập, 1: Bắt buộc nhập
        $sql = "--Do nguon combo nhom truy cap du lieu" . PHP_EOL;
        $sql .= "SELECT DAGroupID, DAGroupNameU AS DAGroupName" . PHP_EOL;
        $sql .= "FROM LEMONSYS.dbo.D00T0080 WITH(NOLOCK)" . PHP_EOL;
        $sql .= "WHERE DISABLED = 0 AND (DAGroupID IN (SELECT DAGroupID" . PHP_EOL;
        $sql .= "FROM   lemonsys.dbo.D00V0080" . PHP_EOL;
        $sql .= "WHERE  UserID = '" . Auth::user()->user()->UserID . "')" . PHP_EOL;
        $sql .= "OR 'LEMONADMIN' = '" . Auth::user()->user()->UserID . "')" . PHP_EOL;
        $sql .= "ORDER BY    DAGroupID" . PHP_EOL;
        $rs = [];
        $dataset = $this->connection->select($sql);
        if ($mode == 0)
            $rs[""] = "";
        foreach ($dataset as $row) {
            $rs[$row['DAGroupID']] = $row['DAGroupName'];
        };
        return $rs;
    }

    //Load nguon combo Tài khoản trong bảng
    public function LoadAccountID($hasPercent = false, $where = "")
    {
        $sql = "--Do nguon Tai khoan" . PHP_EOL;
        $sql .= "Select AccountID, AccountName" . (Session::get('Lang') == "84" ? "" : "01") . "U as AccountName, 1 AS DisplayOrder" . PHP_EOL;
        $sql .= "From D90T0001 WITH(NOLOCK)" . PHP_EOL;
        $sql .= "Where Disabled =0 And OffAccount =0 " . PHP_EOL;
        $sql .= "AND (StrDivisionID = '' OR CHARINDEX('" . Session::get("W91P0000")['DivisionID'] . "',strDivisionID) > 0)" . PHP_EOL;
        if ($where != "")
            $sql .= "AND $where" . PHP_EOL;
        if ($hasPercent) {
            $sql .= "Union All" . PHP_EOL;
            $sql .= "Select '%' as AccountID, N'" . Lang::get("message.Tat_ca_Web") . "' As AccountName, 0 AS DisplayOrder" . PHP_EOL;
        }
        $sql .= "Order By DisplayOrder, AccountID ";
        return $this->connection->select($sql);
    }

    // <editor-fold defaultstate="collapsed" desc="Functions of Load data G4">
    //Load combo Phòng ban
    public function LoadDepartmentByG4($formID, $divisionid, $blockid, $isAll = 0, $isArray = false, $strSearch = '')
    {
        $sql = "--Do nguon Phong ban" . PHP_EOL;
        $sql .= "EXEC W09P9001 '$divisionid', '$blockid', '" . Auth::user()->user()->UserID . "', '$formID', $isAll, N'$strSearch'";
        $rs = $this->connectionHR->select($sql);
        $rsData = [];
        if ($isArray == false) {
            foreach ($rs as $row) {
                $rsData[$row['DepartmentID']] = $row['DepartmentName'];
            };
        } else {
            $rsData = $rs;
        }


        return $rsData;
    }

    //Load combo Tổ nhóm
    public function LoadTeamByG4($formID, $divisionid, $departmentid, $isAll)
    {
        $sql = "--Do nguon To nhom" . PHP_EOL;
        $sql .= "EXEC W09P9002 '$divisionid', '$departmentid', '" . Auth::user()->user()->UserID . "', '$formID', $isAll";
        $rs = $this->connectionHR->select($sql);
        return $rs;
    }

    //Load combo Khối
    public function LoadBlockByG4($divisionid, $userID, $formID, $isAll)
    {
        $sql = "--Do nguon khoi" . PHP_EOL;
        $sql .= "EXEC W09P9004 '$divisionid', '$userID', '$formID', $isAll";
        $rs = $this->connectionHR->select($sql);
        return $rs;
    }

    //người QLTT
    public function LoadDirectManagerbyG4($divisionid, $userID, $hostID, $lang, $formID)
    {
        $sql = "-- Do nguon nguoi quan ly truc tiep moi" . PHP_EOL;
        $sql .= "EXEC W09P1508 '$divisionid', '$userID' , '$hostID', 1, '$formID'";

        $rs = $this->connectionHR->select($sql);
        return $rs;
    }

    //người QLTT
    public function LoadWorkbyG4($isAll = false)
    {
        $sql = "--  Do nguon combo cong viec" . PHP_EOL;
        $sql .= " set nocount on" . PHP_EOL;
        if ($isAll == true) {

            $sql .= " SELECT '%' As WorkID, N'" . Helpers::getRS(4, "Tat_ca_Web") . "' As WorkName";
            $sql .= " UNION";
        }


        $sql .= " SELECT WorkID, WorkNameU as WorkName" . PHP_EOL;
        $sql .= " FROM D09T0224  WITH(NOLOCK)" . PHP_EOL;
        $sql .= " WHERE Disabled = 0" . PHP_EOL;
        $sql .= " ORDER BY WorkName" . PHP_EOL;

        $rs = $this->connectionHR->select($sql);
        return $rs;
    }






    //Load combo nhan vien
//@IsType: ‘Role’ (=‘Role’: Theo phân quyền vai trò,
//=‘RoleEmp’: Theo phân quyền vai trò +User
//= ‘DirectManager’: Theo người QLTT ,
//= ‘DirectManagerEmp’: Theo NQLTT+User
//= ‘ALL’ Đổ nguồn tất cả Hồ sơ nhân viên)

    public function LoadEmployeeByG4($formID, $divisionid, $departmentid, $teamid, $isAll, $strSearch = '', $blockid = '%', $IsType = "ALL")
    {
        $sql = "--Do nguon Nhan Vien" . PHP_EOL;
        $sql .= "EXEC W09P9003 '$divisionid', '$departmentid','$teamid', '" . Auth::user()->user()->UserID . "', '$formID', $isAll, N'$strSearch', '$blockid', '$IsType' ";
        $rs = $this->connectionHR->select($sql);
        return $rs;
    }

    //Load combo nhan vien W75F4100
    /*    public function LoadEmployeeW75F4100($formID, $divisionid, $departmentid, $teamid, $isAll, $strSearch = '', $blockID)
        {
            $sql = "--Do nguon Nhan Vien" . PHP_EOL;
            $sql .= "EXEC W09P9003 '$divisionid', '$departmentid','$teamid', '" . Auth::user()->user()->UserID . "', '$formID', $isAll, N'$strSearch', '$blockID'";
            $rs = $this->connectionHR->select($sql);
            return $rs;
        }*/

    //Load combo hinh thuc lam viec
    public function LoadtdbcWorkingStatusID($isAll)
    {
        $sql = "--Do nguon Hinh thuc lam viec" . PHP_EOL;
        if ($isAll == true) {

            $sql .= " SELECT '%' As WorkingStatusID, N'" . Helpers::getRS(4, "Tat_ca_Web") . "' As WorkingStatusName,0 as DisplayOrder";
            $sql .= " UNION";
        }
        $sql .= " SELECT WorkingStatusID,WorkingStatusNameU as WorkingStatusName,1 as DisplayOrder";
        $sql .= " FROM D09T0070 ";
        $sql .= " WHERE	Disabled = 0 ";
        $sql .= " ORDER BY DisplayOrder,WorkingStatusName";

        $rs = $this->connectionHR->select($sql);
        $rsData = [];
        foreach ($rs as $row) {
            $rsData[$row['WorkingStatusID']] = $row['WorkingStatusName'];
        };
        return $rsData;
    }

    //Load combo ApprovalFlow (Bảo bổ sung)

    public function LoadtdbcApprovalFlow($divisionID, $userID, $hostID, $pForm)
    {
        $sql = "--Do nguon combo quy trinh duyet" . PHP_EOL;
        $sql .= "EXEC W38P2030 '$divisionID', '$userID', '$hostID', '$pForm', 'T0002'";
        \Debugbar::info($sql);
        $rs = $this->connectionHR->select($sql);
        return $rs;
    }

    //Load combo ApprovalFlow (Bảo bổ sung)

    public function LoadtdbcTransID($divisionID, $userID, $hostID, $pForm, $tranMonth, $tranYear)
    {
        $sql = "--Do nguon combo ke hoach tong the" . PHP_EOL;
        $sql .= "EXEC W38P2025 '$divisionID', '$userID', '$hostID', '$pForm', $tranMonth, $tranYear";
        \Debugbar::info($sql);
        $rs = $this->connectionHR->select($sql);
        return $rs;
    }

    //Load combo training field

    public function LoadtdbcTrainingField()
    {
        $sql = "--Do nguon combo linh vuc dao tao" . PHP_EOL;
        $sql .= $this->SQLStoreW38P2005New("TrainingField", '%', '%', '');
        $rs = $this->connectionHR->select($sql);
        return $rs;
    }

    //Load cbo TrainingCourse
    public function LoadtdbcTrainingCourse($training_field, $tranID)
    {
        $sql = "--Do nguon combo khoa dao tao" . PHP_EOL;
        $sql .= $this->SQLStoreW38P2005New("TrainingCourse", $training_field, "%", $tranID);
        $rs = $this->connectionHR->select($sql);
        return $rs;
    }

    public function SQLStoreW38P2005($trantype, $fieldid = '%', $courseid = '%', $transID)
    {
        $sql = " EXEC W38P2005	'" . Session::get("W91P0000")['HRDivisionID'] . "','";
        $sql .= $this->sqlstring(Auth::user()->user()->UserID) . "', '$trantype', '$fieldid', '$courseid',$transID";
        return $sql;
    }

    public function SQLStoreW38P2005New($trantype, $fieldid = '%', $courseid = '%', $transID)
    {
        $sql = " EXEC W38P2005	'" . Session::get("W91P0000")['HRDivisionID'] . "','";
        $sql .= $this->sqlstring(Auth::user()->user()->UserID) . "', '$trantype', '$fieldid', '$courseid', '$transID'";
        return $sql;
    }

    //Load Nguoi de xuat
    public function LoadtdbcProposerID($formid)
    {
        $sql = "--Do nguon combo nguoi de xuat" . PHP_EOL;
        $sql .= " EXEC W91P6969	'" . Session::get('companyID') . "',";
        $sql .= "'" . Session::get("W91P0000")['HRDivisionID'] . "',";
        $sql .= "'" . Auth::user()->user()->UserID . "',";
        $sql .= "'" . $formid . "',";
        $sql .= "'CreateByHR',";
        $sql .= "'" . Session::get('Lang') . "'";

        $rs = $this->connectionHR->select($sql);
        return $rs;
    }
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Functions of create IGE">
    public function IGEKeyPrimary($g, $tabname, $key01, $key02)
    {
        try {
            $sql = "--Sinh IGE" . PHP_EOL;
            $sql .= "SET NOCOUNT ON " . PHP_EOL;
            $sql .= "DECLARE @KeyString AS VARCHAR(20), " . PHP_EOL;
            $sql .= "@KeyFrom AS INT, " . PHP_EOL;
            $sql .= "@KeyTo AS INT" . PHP_EOL;
            $sql .= "EXEC D91P9119 '" . Auth::user()->user()->UserID . "','$key01$key02','$tabname','1',@KeyString  OUTPUT, @KeyFrom  OUTPUT, @KeyTo OUTPUT,''" . PHP_EOL;
            $sql .= "SELECT @KeyString AS KeyString, @KeyFrom AS KeyFrom ";
            if ($g == 4) {
                $rs = $this->connectionHR->selectOne($sql);
            } else {
                $rs = $this->connection->selectOne($sql);
            }
            $ret = "";
            if (isset($rs["KeyString"])) {
                $keystring = $rs["KeyString"];
                Session::set("KeyString03", substr($keystring, strlen($key01) + strlen($key02)));
                $keyfrom = $rs["KeyFrom"];
                $ret = $keystring . str_pad($keyfrom, 15 - strlen($keystring), "0", 0);
            }
            if ($ret == "" || strlen($ret) > 15) {
                throw new Exception("Lỗi sinh mã tự động cho khóa chính của $tabname");
            } else {
                return $ret;
            }

        } catch (Exception $e) {
            throw new Exception('Caught exception: ' . $e->getMessage() . "\n");
        }
    }

    /**
     * @param $g
     * @param $tabname
     * @param $key01 : ModuleID (XX:05)
     * @param $key02 : PSAD quy định
     * @return string
     * @throws Exception
     */
    public function CreateIGE($g, $tabname, $key01, $key02)
    {
        $ret = $this->IGEKeyPrimary($g, $tabname, $key01, $key02);
        return $ret;
    }

    public function CreateIGENewS($g, $tabname, $key01, $key02, $oldIGE, $count, $firsttran)
    {
        if ($oldIGE == "") {
            $ret = $this->IGEKeyPrimary($g, $tabname, $key01, $key02);
        } else {
            $keystring = $key01 . $key02;
            $ilen = strlen($keystring);
            $iNo = intval(substr($oldIGE, $ilen)) + 1;
            if ($iNo > $firsttran + $count - 1) {
                throw new Exception("Lỗi sinh mã tự động cho khóa chính của $tabname");
            }
            // $ret = $keystring & str_pad($iNo, 15, "0");
            $ret = $keystring . str_pad($iNo, 15 - strlen($keystring), "0", 0);
            if (strlen($ret) > 15) {
                throw new Exception("Lỗi sinh mã tự động cho khóa chính của $tabname. Chiều dài vượt quá giới hạn.");
            }
        }
        return $ret;
    }
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Functions of create VoucherNo">
    /**
     * Đổ nguồn combo loại phiếu
     *
     * $module string  $Module truyền vào, VD D05
     * @return array (Form:Select)
     */
    public function LoadVoucherTypeIDData($module, $all = false, $whereUseMod = true)
    {
        $sql = "--Do nguon cho combo loai phieu" . PHP_EOL;
        $sql .= "Select VoucherTypeID, VoucherTypeNameU as VoucherTypeName" . PHP_EOL;
        $sql .= "From D91T0001 WITH(NOLOCK) Where ";
        if ($whereUseMod)
            $sql .= " Use$module  = 1 And ";
        $sql .= "Disabled = 0 " . PHP_EOL;
        $sql .= "AND( VoucherDivisionID='' Or VoucherDivisionID = '" . Session::get("W91P0000")['DivisionID'] . "') " . PHP_EOL;
        $sql .= "Order By VoucherTypeID" . PHP_EOL;
        $dataset = $this->connection->select($sql);
        $rs = [];
        if ($all)
            $rs["%"] = Helpers::getRS(0, "Tat_ca_Web");
        foreach ($dataset as $row) {
            $rs[$row['VoucherTypeID']] = $row['VoucherTypeName'];
        };
        return $rs;
    }

    public function InsertVoucherNoD91T9111($voucherno, $tablename, $fieldname = "", $voucherIGE = "")
    {
        $sql = "--Insert so phieu khong tao tu dong vao bang D91T9111" . PHP_EOL;
        $sql .= "EXEC D91P9113 '$tablename','$voucherno','" . Session::get("W91P0000")['DivisionID'] . "'," . Session::get("W91P0000")['TranYear'] . ",'$fieldname','1','$voucherIGE'";
        try {
            $this->connection->statement($sql);
        } catch (Exception $e) {
            throw new Exception("Lỗi insert số phiếu của $tablename." . $e->getMessage());
        }
    }

    //Xóa số phiếu dành cho form truy vấn
    public function DeleteVoucherNoD91T9111($voucherno, $tablename, $fieldname)
    {
        $sql = "--Xoa so phieu bang D91T9111" . PHP_EOL;
        $sql .= "EXEC D91P9113 '$tablename','$voucherno','" . Session::get("W91P0000")['DivisionID'] . "'," . Session::get("W91P0000")['TranYear'] . ",'$fieldname','0',''";
        try {
            $this->connection->statement($sql);
        } catch (Exception $e) {
            throw new Exception("Lỗi xóa số phiếu của $tablename." . $e->getMessage());
        }
    }

    //Xóa số phiếu dành cho form nghiệp vụ khi lưu không thành công
    public function DeleteVoucherNoD91T9111_Transaction($voucherno, $tablename, $fieldname, $voucherid)
    {
        try {
            //Xóa số phiếu
            $this->DeleteVoucherNoD91T9111($voucherno, $tablename, $fieldname);
            $rVouchertypeid = $this->getrowVouchertype($voucherid);

            //Tạm thời chỉ cho tăng tự động
            $s1 = "";
            $s2 = "";
            $s3 = "";
            $keystring = "";
            if ($rVouchertypeid["S1Type"] != "0") {
                $s1 = $this->FindSxType($rVouchertypeid["S1Type"], $rVouchertypeid["S1"]);
            }
            if ($rVouchertypeid["S2Type"] != "0") {
                $s2 = $this->FindSxType($rVouchertypeid["S2Type"], $rVouchertypeid["S2"]);
            }
            if ($rVouchertypeid["S3Type"] != "0") {
                $s3 = $this->FindSxType($rVouchertypeid["S3Type"], $rVouchertypeid["S3"]);
            }
            switch (intval($rVouchertypeid["OutputOrder"])) {
                case 0:
                    $keystring = $this->ConcatenateKeys($s1, $s2, $s3, "");
                    break;
                case 1:
                    $keystring = $this->ConcatenateKeys($s1, $s2, "", $s3);
                    break;
                case 2:
                    $keystring = $this->ConcatenateKeys($s1, "", $s2, $s3);
                    break;
                case 3:
                    $keystring = $this->ConcatenateKeys("", $s1, $s2, $s3);
                    break;
            }
            $oldkey = $this->GetLastKey($keystring) - 2;
            if ($oldkey < 0) $oldkey = 0;
            $this->SaveLastKey($tablename, $keystring, $oldkey, 1);
        } catch (Exception $ex) {
            throw new Exception("Lỗi xóa số phiếu nghiệp vụ của $tablename." . $ex->getMessage());
        }
    }


    protected function getrowVouchertype($vou)
    {
        $sql = "--Do nguon cho combo loai phieu" . PHP_EOL;
        $sql .= "Select Auto, S1Type, S1, S2Type, S2, S3, S3Type, OutputOrder, OutputLength, Separator" . PHP_EOL;
        $sql .= "From D91T0001 WITH(NOLOCK) " . PHP_EOL;
        $sql .= "Where VoucherTypeID='$vou' " . PHP_EOL;
        return $this->connection->selectOne($sql);
    }

    protected function FindSxType($type, $s)
    {
        $month = Session::get("W91P0000")['TranMonth'];
        $year = Session::get("W91P0000")['TranYear'];
        switch (intval($type)) {
            case 1:
                return str_pad($month, 2, "0", 0);
                break;
            case 2:
                return $year;
                break;
            case 3:
            case 5:
                return $s;
                break;
            case 4:
                return Session::get("W91P0000")['DivisionID'];
                break;
            case 6:
                return substr($year, 2, 2);
                break;
            case 7:
                return str_pad($month, 2, "0", 0) . substr($year, 2, 2);
                break;
            case 8:
                return substr($year, 2, 2) . str_pad($month, 2, "0", 0);
                break;
            case 9:
                return date("ymd");
                break;
        }
    }

    protected function ConcatenateKeys($key1, $key2, $key3, $key4, $char = "")
    {
        if ($char != "") {
            if ($key1 != "") $key1 .= $char;
            if ($key2 != "") $key2 .= $char;
            if ($key3 != "") $key3 .= $char;
            if ($key4 != "") $key4 .= $char;
        }
        $str = $key1 . $key2 . $key3 . $key4;
        return substr($str, 0, strlen($str) - strlen($char));
    }

    protected function GetLastKey($keystring = "", $tabname = "D91T0001")
    {
        $sql = "--Get Last Key cho So phieu tu dong, neu chua co du lieu thi tra ve 0";
        $sql .= $this->SQLStoreD91P9111("", "", "", "", "", 1, 1, "", $keystring, 1, 0, 0, 0, $tabname);
        $rs = $this->connection->selectOne($sql);
        if (isset($rs["LastKey"])) {
            return intval($rs["LastKey"]) + 1;
        }
        return 1;
    }

    protected function SQLStoreD91P9111($voucherIGE, $voutablename, $s1, $s2, $s3, $outlength, $outorder, $separator, $keystring = '', $isgetlastkey = 0, $issavekey = 0, $lastkeynew = 0, $isrefresh = 0, $tablename = 'D91T0001')
    {
        $sql = "SET NOCOUNT ON" . PHP_EOL;
        $sql .= "DECLARE @VoucherNo AS VARCHAR(20) " . PHP_EOL;
        $sql .= "DECLARE @Lastkey AS VARCHAR(20) " . PHP_EOL;
        $sql .= "EXEC D91P9111 '$tablename','$s1','$s2','$s3','$outlength','$outorder',";
        $sql .= "'" . intval($separator != "") . "','$separator','','','','$voucherIGE','$voutablename',";
        $sql .= "@VoucherNo  OUTPUT ,@Lastkey  OUTPUT, 0,'" . Session::get("W91P0000")['DivisionID'] . "'," . Session::get("W91P0000")['TranYear'] . ",";
        $sql .= "'$keystring',$isgetlastkey,$issavekey,$lastkeynew,$isrefresh";
        return $sql;
    }

    protected function SaveLastKey($tablename, $keystring, $lastkey, $isrefresh)
    {
        $sql = "--Luu Last Key cho So phieu tu dong";
        $sql .= $this->SQLStoreD91P9111("", "", "", "", "", 1, 1, "", $keystring, 0, 1, $lastkey, $isrefresh, $tablename);
        $rs = $this->connection->statement($sql);
    }

    public function CreateIGEVoucherNo($voucherIGE, $voutablename, $vouchertypeid, $issave = 0)
    {
        if ($voucherIGE == "" && $issave == 1) {
            throw new Exception("Do vấn đề về kỹ thuật (Khóa chính chưa được tạo) nên việc tạo phiếu bị lỗi.");
            error_log("Loi Sinh so phieu (tao phieu) cua table TableName $voutablename");
        }
        $rVouchertypeid = $this->getrowVouchertype($vouchertypeid);

        //Tạm thời chỉ cho tăng tự động
        $s1 = "";
        $s2 = "";
        $s3 = "";
        $keystring = "";
        if ($rVouchertypeid["S1Type"] != "0") {
            $s1 = $this->FindSxType($rVouchertypeid["S1Type"], $rVouchertypeid["S1"]);
        }
        if ($rVouchertypeid["S2Type"] != "0") {
            $s2 = $this->FindSxType($rVouchertypeid["S2Type"], $rVouchertypeid["S2"]);
        }
        if ($rVouchertypeid["S3Type"] != "0") {
            $s3 = $this->FindSxType($rVouchertypeid["S3Type"], $rVouchertypeid["S3"]);
        }
        if ($issave == 0) //Dùng khi thay đổi combo VoucherTypeID
        {
            $keystring = $s1 . $s2 . $s3;
            $lastkey = $this->GetLastKey($keystring);
            $lkeystring = $this->CheckLengthKey($lastkey, $s1, $s2, $s3, $rVouchertypeid["Separator"], $rVouchertypeid["OutputLength"]);
            if ($lkeystring == "") return "";
            //$IGEvoucherno = $this->Generate($s1, $s2, $s3, $rVouchertypeid, $lastkey);
            $IGEvoucherno = $this->Generate($s1, $s2, $s3, $rVouchertypeid, $lkeystring);
            if ($IGEvoucherno == "") {
                throw new Exception("Lỗi sinh số phiếu tự động ($voutablename)");
                error_log("Loi sinh so phieu cua table ($voutablename)");
            }
            return $IGEvoucherno;
        } else //Dùng cho khi lưu
        {
            $sql = $this->SQLStoreD91P9111($voucherIGE, $voutablename, $s1, $s2, $s3, $rVouchertypeid["OutputLength"], $rVouchertypeid["OutputOrder"], $rVouchertypeid["Separator"]);
            try {
                $rs = $this->connection->selectOne($sql);
                return $rs["VoucherNo"];
            } catch (Exception $ex) {
                throw new Exception("Do vấn đề về kỹ thuật (Khóa chính chưa được tạo) nên việc tạo phiếu bị lỗi.");
                error_log("Loi Sinh so phieu (tao phieu) cua table TableName $voutablename");
            }
        }
    }

    //Kiểm tra trùng số phiếu
    public function CheckDuplicateVoucherNo($module, $tablename, $voucherid, $voucherno)
    {
        $mod = substr($module, 0, 2);
        $sql = "--Kiem tra trung phieu" . PHP_EOL;
        $sql .= "EXEC D91P9114 '" . Session::get("W91P0000")['DivisionID'] . "','$mod','$tablename','$voucherid','$voucherno','" . Session::get('Lang') . "'," . Session::get("W91P0000")['TranYear'] . "";
        $rs = $this->connection->select($sql);
        if (isset($rs[0]["Status"])) {
            return $rs;
        }
        return false;
    }

    //Kiểm tra chiều dài hợp lệ
    protected function CheckLengthKey($lastkey, $s1, $s2, $s3, $separator, $outlength)
    {
        $keylenght = 0;
        if ($s1 != "")
            $keylenght = $keylenght + strlen($s1) + strlen($separator);
        if ($s2 != "")
            $keylenght = $keylenght + strlen($s2) + strlen($separator);
        if ($s3 != "")
            $keylenght = $keylenght + strlen($s3) + strlen($separator);

        if ($keylenght + strlen($lastkey) > $outlength) {
            throw new Exception("Chiều dài thiết lập vượt quá giới hạn cho phép. Bạn phải thiết lập lại.");
        }
        $length = intval($outlength) - $keylenght - strlen($lastkey);
        return str_pad("", $length, "0") . $lastkey;
    }

    protected function Generate($s1, $s2, $s3, $rData, $lastkey)
    {
        $keystring = "";
        $sep = $rData["Separator"];
        switch (intval($rData["OutputOrder"])) {
            case 0:
                $keystring = $this->ConcatenateKeys($s1, $s2, $s3, $lastkey, $sep);
                break;
            case 1:
                $keystring = $this->ConcatenateKeys($s1, $s2, $lastkey, $s3, $sep);
                break;
            case 2:
                $keystring = $this->ConcatenateKeys($s1, $lastkey, $s2, $s3, $sep);
                break;
            case 3:
                $keystring = $this->ConcatenateKeys($lastkey, $s1, $s2, $s3, $sep);
                break;
        }
        return $keystring;
    }

    // </editor-fold>

    public function LoadDataF12($module, $formid)
    {
        $sql = "--Do nguon F12" . PHP_EOL;
        $sql .= "Select FieldNameU From D91T2022";
        $sql .= " Where ModuleID='$module' and UserID='" . Auth::user()->user()->UserID . "' and FormID='$formid'";
        $result = $this->connection->select($sql);
        $arrColHide = [];
        foreach ($result as $colHide) {
            $arrColHide[] = $colHide['FieldNameU'];
        }
        return $arrColHide;
    }

    //Hàm lưu các cột ẩn tại F12
    public function SaveF12($arr, $module, $formid)
    {
        $sql = "--Xoa du lieu cu" . PHP_EOL;
        $sql .= "Delete From D91T2022";
        $sql .= " Where ModuleID='$module' and UserID='" . Auth::user()->User()->UserID . "' and FormID='$formid'" . PHP_EOL;
        $this->connection->statement($sql);
        try {
            $sql = "--Luu du lieu F12" . PHP_EOL;
            foreach ($arr as $key => $col) {
                $sql .= "Insert Into D91T2022(ModuleID,FormID,FieldNameU,UserID";
                $sql .= ") Values('$module','$formid','$col','" . Auth::user()->User()->UserID . "'";
                $sql .= ")" . PHP_EOL;
            }
            $this->connection->statement($sql);
            return 1;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function arrayFilter($array, $id)
    {
        foreach ($array as $row) {
            if ($row["MReportID"] == $id)
                return $row["MReportName"];
        }
    }

    //Khanh bổ sung test excel
    public function TemplateExcel()
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', '720');
        ini_set('max_input_time', '720');
        ini_set('post_max_size', '2G');
        //$test = "<#Detail(ItemName)#>";
        try {
            //Clone excel template file
            $filename = "D05R0016Web";
            $filePath = Config::get('app.path_export') . "/" . $filename . ".xls";
            $contents = File::get($filePath);
            $filename = $filename . "_" . time();
            $filePath = Config::get('app.path_export') . "/" . $filename . ".xls";
            File::put($filePath, $contents);
            $rowCount = 0;
            $colCount = 0;
            $arr = array();
            $rows = array();
            $master = json_decode(Input::get('master'));
            $detail = json_decode(Input::get('detail'));
            $format = json_decode(Input::get('formats'));

            $objPHPExcel = PHPExcel_IOFactory::load($filePath);
            foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                $worksheetTitle = $worksheet->getTitle();
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                $nrColumns = ord($highestColumn) - 64;

                //Replace values for master
                for ($row = 1; $row <= $highestRow; ++$row) {
                    for ($col = 0; $col < $highestColumnIndex; ++$col) {
                        $cell = $worksheet->getCellByColumnAndRow($col, $row);
                        $val = $cell->getValue();
                        $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
                        if ($val == "<#VoucherDate#>") {
                            $cell = $worksheet->setCellValueByColumnAndRow($col, $row, ($this->replaceCusMaster($master, $val)));
                        } else {
                            $cell = $worksheet->setCellValueByColumnAndRow($col, $row, $this->replaceCusMaster($master, $val));
                        }
                    }
                }

                //Get row index, and all fields
                for ($row = 1; $row <= $highestRow; ++$row) {
                    for ($col = 0; $col < $highestColumnIndex; ++$col) {
                        $cell = $worksheet->getCellByColumnAndRow($col, $row);
                        $value = $cell->getValue();
                        if (strpos($value, "<#Detail") !== false) {
                            $cell = new CellObject($row, $col, $value);
                            array_push($arr, $cell);
                        }
                    }
                }
                if (count($detail) - 1 > 0) {
                    $worksheet->insertNewRowBefore($arr[0]->iRow + 1, count($detail) - 1);
                }

                //Filt datafields
                for ($k = 0; $k < count($detail); $k++) {
                    for ($l = 0; $l < count($arr); $l++) {
                        $worksheet->setCellValueByColumnAndRow($arr[$l]->iCol, intval($arr[$l]->iRow + $k), $arr[$l]->sValue);
                    }
                }
            }
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save($filePath);

            //------------------

            $objPHPExcel = PHPExcel_IOFactory::load($filePath);
            foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                $worksheetTitle = $worksheet->getTitle();
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                $nrColumns = ord($highestColumn) - 64;
                $f = 0;
                for ($row = $arr[0]->iRow; $row < $arr[0]->iRow + count($detail); $row++) {

                    for ($col = $arr[0]->iCol; $col < $arr[0]->iCol + count($arr); $col++) {

                        $cell = $worksheet->getCellByColumnAndRow($col, $row);
                        $value = $cell->getValue();
                        $cell_format = $worksheet->getCellByColumnAndRow($col, 1);
                        $value_format = $cell_format->getValue();
                        $colChar = PHPExcel_Cell::stringFromColumnIndex($col);
                        if ($this->CheckValue($format, $value)) {
                            $stringFormat = $this->GetStringFormat($format, $value);
                            $cell = $worksheet->setCellValueByColumnAndRow($col, $row, $this->replaceCus($detail[$f], $value, $arr), true);
                            $cell->setDataType(PHPExcel_Cell_DataType::TYPE_NUMERIC);
                            $cell->getStyle()->getNumberFormat()->setFormatCode($stringFormat);
                        } else {
                            $worksheet->setCellValueExplicit($colChar . $row, $this->replaceCus($detail[$f], $value, $arr), PHPExcel_Cell_DataType::TYPE_STRING);
                            $cell->setDataType(PHPExcel_Cell_DataType::TYPE_STRING2);
                            $cell->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                        }
                    }
                    $f = $f + 1;
                }
            }
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->setPreCalculateFormulas(true);
            $objWriter->save($filePath);


            return $filePath;
        } catch (Exception $e) {
            return 0;
        }
    }

    private function replaceCusMaster($master, $val)
    {
        $val = str_replace("<#VoucherDate#>", PHPExcel_Shared_Date::stringToExcel(date('d-m-Y', strtotime($master->VoucherDate))), $val);
        $val = str_replace("<#VoucherNum#>", $master->VoucherNum, $val);
        $val = str_replace("<#ObjectName#>", $master->ObjectName, $val);
        $val = str_replace("<#ODetailDueDate#>", 7, $val);
        return $val;
    }

    private function replaceCus($row, $value, $arr)
    {
        for ($l = 0; $l < count($arr); $l++) {
            foreach ($row as $key => $val) {
                if (strpos($value, "<#Detail(" . $key . ")#>") !== false) {
                    $value = str_replace("<#Detail(" . $key . ")#>", $val, $value);
                }
            }
        }
        return str_replace(",", "", $value);
    }

    private function GetDecimalPlaces($n)
    {
        switch ($n) {
            case 0:
                return '#,##0';
            case 1:
                return '#,##0.0';
            case 2:
                return '#,##0.00';
            case 3:
                return '#,##0.000';
            case 4:
                return '#,##0.0000';
            case 5:
                return '#,##0.00000';
            case 6:
                return '#,##0.000000';
            case 7:
                return '#,##0.0000000';
            case 8:
                return '#,##0.00000000';
            default:
                return '#,##0';
        }
    }

    private function CheckValue($format, $value)
    {
        $flag = false;
        foreach ($format as $col) {
            if ($value == "<#Detail(" . $col->FieldName . ")#>" && $col->DataType == "N") {
                $flag = true;
            }
        }
        return $flag ? true : false;
    }

    private function GetStringFormat($format, $value)
    {
        foreach ($format as $col) {
            if ($value == "<#Detail(" . $col->FieldName . ")#>" && $col->DataType == "N") {
                return $this->GetDecimalPlaces($col->DecimalPlaces);
            }
        }
        return "";
    }

    function viewAttachment($mod, $g, $tablename, $attid)
    {
        $attid = Helpers::decryptData($attid);
        if ($g == 4) {
            $query = "EXEC W91P1014 '" . Session::get("W91P0000")['DivisionID'] . "', '$mod', '$tablename', '" . Helpers::decrypt_userpass(Config::get('database.connections.sqlsrvHR.database')) . "', '$attid', '', '', '', ''";
            $rs = DB::connection("sqlsrvHR")->selectOne($query);
        } else {
            $query = "EXEC W91P1014 '" . Session::get("W91P0000")['DivisionID'] . "', '$mod', '$tablename', '" . Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]) . "', '$attid', '', '', '', ''";
            \Debugbar::info($query);
            $rs = DB::connection("CONDEFAULT")->selectOne($query);
        }

        if ($rs['Content'] == '') return '';
        $filename = $rs['FileName'];
        $content = pack('H' . strlen($rs['Content']), $rs['Content']);
        header("Cache-Control: no-cache private");
        header("Content-Description: File Transfer");
        header('Content-disposition: attachment; filename=' . $filename);
        header("Content-Type: " . Helpers::get_content_type($filename));
        header("Content-Transfer-Encoding: binary");
        header('Content-Length: ' . strlen($content));
        ///echo $content;
        //exit;
        return $content;
    }

    function unzip($mod, $g, $tablename, $attid)
    {
        $attid = Helpers::decryptData($attid);
        if ($g == 4) {
            $query = "EXEC W91P1014 '" . Session::get("W91P0000")['DivisionID'] . "', '$mod', '$tablename', '" . Helpers::decrypt_userpass(Config::get('database.connections.sqlsrvHR.database')) . "', '$attid', '', '', '', ''";
            $rs = DB::connection("sqlsrvHR")->selectOne($query);
        } else {
            $query = "EXEC W91P1014 '" . Session::get("W91P0000")['DivisionID'] . "', '$mod', '$tablename', '" . Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]) . "', '$attid', '', '', '', ''";
            $rs = DB::connection("CONDEFAULT")->selectOne($query);
        }
        if ($rs['ContentArchive'] == '') return 'NOCONTENT'; //Chưa có nội dung đính kèm
        $filename = $rs['FileName'];

        if (Helpers::detectVietnamese($filename)) return 'UNICODE';

        $d = new DateTime();
        $nameTemp = $d->getTimestamp();// $rs['AttachmentID'];//
        //$ext = Helpers::get_content_type($filename);
        $ext = "zip";
        if (!file_exists(storage_path() . "\zipfiles\\")) {
            mkdir(storage_path() . "\zipfiles\\");
            //\Storage::makeDirectory("zipfiles");
        }
        $pathFile = storage_path() . "\zipfiles\\" . $nameTemp . "." . $ext;
        $folderPath = storage_path() . "\zipfiles\\" . $nameTemp;

        $contentArchive = pack('H' . strlen($rs['ContentArchive']), $rs['ContentArchive']);

        //Write file zip
        $fp = fopen($pathFile, 'w');
        fwrite($fp, $contentArchive);
        fclose($fp);


        \Debugbar::info(Helpers::detectVietnamese("Hoa hồng"));

        //Unzup
        $dirName = "";
        //system('unzip -d '.$folderPath.' ' .$pathFile);
        $zip = new ZipArchive;
        if ($zip->open($pathFile) === TRUE) {
            $zip->extractTo($folderPath);
            $zip->close();

            foreach (new DirectoryIterator($folderPath) as $dir) {
                if ($dir->isDir()) {
                    $dirName = $dir->getFilename();
                }
            }

            $retrivePath = $folderPath . DIRECTORY_SEPARATOR . $dirName;
            $openDir = scandir($retrivePath);

            $result = "";
            foreach ($openDir as $key => $value) {
                if (!in_array($value, array(".", ".."))) {
                    //$cpFileName = str_replace(".xlsx", "", $rs['FileName']);
                    //$cpFileName = str_replace(".xls", "", $cpFileName);
                    /*if (is_dir($retrivePath . DIRECTORY_SEPARATOR . $value)) {
                        rename($retrivePath . DIRECTORY_SEPARATOR . $value, $retrivePath . DIRECTORY_SEPARATOR . utf8_decode($cpFileName . '_files'));
                    }*/
                    if (is_file($retrivePath . DIRECTORY_SEPARATOR . $value)) {
                        //rename($retrivePath . DIRECTORY_SEPARATOR . $value, $retrivePath . DIRECTORY_SEPARATOR . utf8_decode($cpFileName . '.html'));
                        //$name = $cpFileName . ".html";
                        //\Debugbar::info($value);
                        $result = url("/app/storage/zipfiles/$nameTemp/$dirName/$value");
                        return $result;
                    }
                }
            }
            return $result;

        } else {
            return 'ERROR'; //khong the giai nen
        }

    }


    function audit()
    {
        //delete files in zipfiles folder
        if (!file_exists(storage_path() . "\zipfiles\\")) {
            mkdir(storage_path() . "\zipfiles\\");
            //Storage::makeDirectory("zipfiles");
        }
        $path = storage_path() . "\zipfiles\\";
        $arr = array();
        foreach (new DirectoryIterator($path) as $file) {
            $createdTime = $file->getCTime();
            $currentTime = (new DateTime())->getTimestamp();
            array_push($arr, $currentTime - $createdTime);
            if ($currentTime - $createdTime > 3600) { //Tinh theo giây
                //if ($currentTime - $createdTime > 20) { //Tinh theo giây
                if ($file->isDir()) {
                    $dirName = $file->getFilename();
                    if ($file->getFilename() != "." && $file->getFilename() != "..") {
                        Helpers::delete_folder($file->getLinkTarget());
                    }
                }
                if ($file->isFile()) {
                    $dirName = $file->getFilename();
                    if ($file->getFilename() != "." && $file->getFilename() != "..") {
                        unlink($file->getLinkTarget());
                    }
                }
            }
        }


        //delete files in downloads folder
        if (!file_exists(storage_path() . "\downloads\\")) {
            mkdir(storage_path() . "\downloads\\");
        }
        //delete files in zipfiles folder
        $path = storage_path() . "\downloads\\";
        $arr = array();
        foreach (new DirectoryIterator($path) as $file) {
            $createdTime = $file->getCTime();
            $currentTime = (new DateTime())->getTimestamp();
            array_push($arr, $currentTime - $createdTime);
            if ($currentTime - $createdTime > 3600) { //Tinh theo giây
                if ($file->isFile()) {
                    $dirName = $file->getFilename();
                    if ($file->getFilename() != "." && $file->getFilename() != "..") {
                        unlink($file->getLinkTarget());
                    }
                }
            }
        }
        return $arr;
    }


    //Lay thiet lap goi man hinh duyet W09F3030
    //IsDetailAppLevel == 1 thì gọi form W09F3030
    //
    function isCallW09F3030($pForm, $g)
    {
        $sql = "--Lay thiet lap goi man hinh lich su duyet" . PHP_EOL;
        $sql .= "set nocount on SELECT IsDetailAppLevel FROM D84V2020 WHERE FormID = '$pForm'";
        //\Debugbar::info($sql);
        if (intval($g) == 4)
            $rs = $this->connectionHR->select($sql);
        else
            $rs = $this->connection->select($sql);
        return count($rs) > 0 ? $rs[0]["IsDetailAppLevel"] : 0;
    }

    function LoadContractCategoryG4($isAll = 'false')
    {
        $lang = Session::get('Lang');
        $sql = "--Loai hop dong" . PHP_EOL;
        if ($isAll) {
            $sql .= "Select '%' As ContractTypeID , N'" . Helpers::getRS(4, "Tat_ca_Web") . "' As ContractTypeName" . PHP_EOL;
            $sql .= "UNION" . PHP_EOL;
        }
        $sql .= "Select ContractCategoryID As ContractTypeID , ContractCategoryName" . $lang . "U As ContractTypeName" . PHP_EOL;
        $sql .= "From D09V2223" . PHP_EOL;
        $sql .= "Order by ContractTypeID";
        $contractType = $this->connectionHR->select($sql);
        return $contractType;
    }


}

class MyValueBinder extends PHPExcel_Cell_DefaultValueBinder implements PHPExcel_Cell_IValueBinder
{
    public function bindValue(PHPExcel_Cell $cell, $value = null)
    {
        if (is_numeric($value)) {
            $cell->setValueExplicit($value, PHPExcel_Cell_DataType::TYPE_NUMERIC);
            return true;
        }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }
}
