<?php
namespace W0X\W09;

use Auth;
use Config;
use DateTime;
use DB;
use Exception;
use Helpers;
use Illuminate\Support\Facades\Response;
use Input;
use Request;
use Session;
use View;
use W0X\W0XController;
use Debugbar;

class W09F4010Controller extends W0XController
{
    public function Index($pForm, $g, $task = "")
    {
        //\Debugbar::info(Input::all());

        //$formID = Input::get('tableName');
        $formID = $pForm; //danh cho truong hop phan quyen
        $formCall = Input::get("formCall", ""); //Form nay danh cho form khong phan quyen, viet custom
        $usePermission = Input::get("useParentPermission", 0); //danh cho truong hop phan quyen
        $permission = 0;
        if ($usePermission == 1){
            $permission = $this->getPermission($formID);
        }

        $tableName = Input::get('tableName');
        $companyID = Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
        if ($g == 4) {
            $HRDivisionID = Session::get("W91P0000")['HRDivisionID'];
        } else {
            $HRDivisionID = Session::get("W91P0000")['DivisionID'];
        }

        $lang = Session::get('Lang');

        switch ($task){
            case "":
                $keyID = Input::get('keyID', '');
                $keyIDTemp = explode(";", $keyID);
                $keyIDTemp = $keyIDTemp[0];
                $key2ID = Input::get('key2ID', '');
                $key3ID = Input::get('key3ID', '');
                $key4ID = Input::get('key4ID', '');
                $key5ID = Input::get('key5ID', '');

                $sql = "--do nguon luoi" .PHP_EOL;
                $sql .= "EXEC W09P4010 '$HRDivisionID', '$tableName', '$companyID', '$keyIDTemp' , '$key2ID', '$key3ID', '$key4ID', '$key5ID', 0" .PHP_EOL;
                //\Debugbar::info($sql);
                if ($g == 4){
                    $valueGrid = $this->connectionHR->select($sql);
                }else{
                    $valueGrid = $this->connection->select($sql);
                }

                //\Debugbar::info($valueGrid);
                if(count($valueGrid) > 0){
                    for ($i = 0; $i < count($valueGrid); $i++) {
                        //$valueGrid[$i]["IsUpdate"] = 0;
                        $valueGrid[$i]['FileSize'] = number_format($valueGrid[$i]['FileSize'], 2);
                    }
                }
                $valueGrid = json_encode($valueGrid);
                if ($usePermission == 1){ //phan quyen theo parent permission
                    $permission = $this->getPermission($formID);
                    return View::make("W0X.W09.W09F4010Permission", compact('permission','formCall','g', 'pForm', 'lang', 'valueGrid', 'keyID', 'key2ID','key3ID','key4ID','key5ID','tableName','formID', 'tableName'));
                }else{ // phan quyen dac thu theo form call
                    return View::make("W0X.W09.W09F4010", compact('formCall','g', 'pForm', 'lang', 'valueGrid', 'keyID', 'key2ID','key3ID','key4ID','key5ID','tableName','formID', 'tableName'));
                }

                break;

            case "reloadGridW09F4010":
                $keyID = Input::get('keyID', '');
                $keyIDTemp = explode(";", $keyID);
                $keyIDTemp = $keyIDTemp[0];
                $key2ID = Input::get('key2ID', '');
                $key3ID = Input::get('key3ID', '');
                $key4ID = Input::get('key4ID', '');
                $key5ID = Input::get('key5ID', '');

                $tableName = Input::get('tableName');
                $sql = "--do nguon luoi" .PHP_EOL;
                $sql .= "EXEC W09P4010 '$HRDivisionID', '$tableName', '$companyID', '$keyIDTemp' , '$key2ID', '$key3ID', '$key4ID', '$key5ID', 0" .PHP_EOL;
                if ($g == 4){
                    $valueGrid = $this->connectionHR->select($sql);
                }else{
                    $valueGrid = $this->connection->select($sql);
                }

                if(count($valueGrid) > 0){
                    for ($i = 0; $i < count($valueGrid); $i++) {
                        //$valueGrid[$i]["IsUpdate"] = 0;
                        $valueGrid[$i]['FileSize'] = number_format($valueGrid[$i]['FileSize'], 2);
                    }
                }
                //$valueGrid = json_encode($valueGrid);
                return $valueGrid;
                break;

            case "delete":
                $AttachmentID = Input::get('AttachmentID');
                $tableName = Input::get('tableName');

                $sql = "Delete From D91T1010". PHP_EOL;
                $sql .= "Where AttachmentID = '$AttachmentID'". PHP_EOL;

                $sql1 = "Delete From $tableName WHERE AttachmentID = '$AttachmentID'". PHP_EOL;


                try {
                    if ($g == 4){
                        $this->connectionHR->statement($sql);
                    }else{
                        $this->connection->statement($sql);
                    }

                    $this->attConnectionStatement($sql1);
                    return json_encode(['status' => 'SUCCESS']);
                } catch (Exception $ex) {
                    return json_encode(['status' => 'ERROR', 'name' =>'',"message"=> Helpers::getRS($g,"Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                }

                break;
        }


    }

    function viewAttachmentW09F4010($g,$tableName, $attID, $keyID = '')
    {

        ob_end_clean();
        ob_start();
        $HRDivisionID = Session::get("W91P0000")['HRDivisionID'];
        $companyID = Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
        if ($g == 4) {
            $query = "EXEC W09P4010 '$HRDivisionID', '$tableName', '$companyID', '$keyID' , '', '', '', '', 1, '$attID'";
            $rs = DB::connection("sqlsrvHR")->selectOne($query);
        } else {
            $query = "EXEC W09P4010 '$HRDivisionID', '$tableName', '$companyID', '$keyID' , '', '', '', '', 1, '$attID'";
            \Debugbar::info($query);
            $rs = DB::connection("CONDEFAULT")->selectOne($query);
        }
        if ($rs['Content'] == '') return '';
        $fileName = $rs['FileName'];
        $content = $rs['Content'];
        $len = strlen($content);
        $content = pack("H" . $len, $content);
        $d = new DateTime();
        $nameTemp = $d->getTimestamp();
        $fileName = $nameTemp."-".$fileName;


        if (!file_exists(storage_path() . "\downloads\\")) {
            mkdir(storage_path() . "\downloads\\");
        }

        $pathFile = storage_path() . "\downloads\\" . $fileName ;
        //Write file zip
        $fp = fopen($pathFile, 'w');
        fwrite($fp, $content);
        fclose($fp);

        /*header("Cache-Control: no-cache private");
        header("Content-Description: File Transfer");
        header('Content-disposition: attachment; filename='.$fileName);
        header("Content-Type: " . Helpers::get_content_type($fileName)). ";charset=UTF-8";
        header("Content-Transfer-Encoding: binary");
        header('Content-Length: '. $len);
        echo  $content;
        exit;*/
        return Response::download($pathFile);
    }

}
