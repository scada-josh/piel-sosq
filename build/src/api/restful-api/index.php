<?php
session_start(); //start session.
?>

<?php

    date_default_timezone_set("Asia/Bangkok");
 
    require_once '../../../packages/autoload.php';
 

    // Create and configure Slim app

    /* ****************** */
    /* Slim framework 2.x */
    /* ****************** */
    $logWriter = new \Slim\LogWriter(fopen('./api-debug.log', 'a'));
    $app = new \Slim\Slim(array('log.enabled' => true,
                                'log.writer' => $logWriter,
                                'debug' => true));
    /* ********* */
    /* Using JWT */
    /* ********* */

    /* Secret Key */
    $key = "supersecretkeyyoushouldnotcommittogithub";
    use \Firebase\JWT\JWT;
    $app->add(new \Slim\Middleware\JwtAuthentication([
         "secure" => false,
        "relaxed" => ["localhost"],
        "secret" => $key,
        //"path"=> "/user",
        "callback" => function ($options) use ($app) {
            $app->jwt = $options["decoded"];
        },
        "rules" => [
            new \Slim\Middleware\JwtAuthentication\RequestPathRule([
                "path" => ["/permissionManager/checkJWT/"],
                "passthrough" => ["/user"]
            ]),
            new \Slim\Middleware\JwtAuthentication\RequestMethodRule([
                "passthrough" => ["OPTIONS"]
            ])
        ]
    ]));

    /* *************** */
    /* Using Memcached */
    /* *************** */
    $memcachedClient = new \Blablacar\Memcached\Client();
    $memcachedClient->addServer('127.0.0.1', 11211);
    


    /* Connect Database Manager Partial : Localhost */
        $dsn = "mysql:dbname=mis_web_db;host=localhost;charset=UTF8";
    $username = "root";
    $password = "";
    $pdo = new PDO($dsn, $username, $password);
    $db = new NotORM($pdo);


    


 

      /* NuSOAP */
    $client = new nusoap_client("http://58.137.5.126/epodws/service.asmx?wsdl", true);
    // $client->soap_defencoding = 'UTF-8';

    $client_mis = new nusoap_client("http://58.137.5.126/iTMS_MIS_Portal/Service.asmx?wsdl", true);
    // $client_mis->soap_defencoding = 'UTF-8';



    /* forceEndpoint Partial : Localhost (Internet) */
        $endpoint = "http://58.137.5.126/epodws/service.asmx?wsdl";
    $client->forceEndpoint = $endpoint;

    /* forceEndpoint Partial : Localhost (Internet) */
    $endpoint_mis = "http://58.137.5.126/iTMS_MIS_Portal/Service.asmx?wsdl";
    $client_mis->forceEndpoint = $endpoint_mis;


    $client->soap_defencoding = 'UTF-8';
    $client->decode_utf8 = false; // แก้ปัญหาตัวอักษรภาษาไทยแสดง ???????? (web service unicode characters dispaly as question marks)
    $client->encode_utf8 = true;


    $client_mis->soap_defencoding = 'UTF-8';
    $client_mis->decode_utf8 = false; // แก้ปัญหาตัวอักษรภาษาไทยแสดง ???????? (web service unicode characters dispaly as question marks)
    $client_mis->encode_utf8 = true;

    /* PHP Excel : Create new PHPExcel object : http://phpexcel.codeplex.com */
    $objPHPExcel = new \PHPExcel();



    /* PHP Function */
        function url(){

	    if(isset($_SERVER['HTTPS'])){
	        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
	    }
	    else{
	        $protocol = 'http';
	    }
    	//return $protocol . "://" . parse_url($_SERVER['REQUEST_URI'], PHP_URL_HOST);
    	return $protocol . "://" . $_SERVER['SERVER_NAME'];
	}
    function array_find_deep($array, $search){
    $i = 0;
    $j = 0;


    for ($i=0; $i < count($array); $i++) { 
        if ($search == $array[$i][0]) {
            return $i;
        }
    }
	
    return false;
}
    function createDateRangeArray($strDateFrom,$strDateTo)
{
    // takes two dates formatted as YYYY-MM-DD and creates an
    // inclusive array of the dates between the from and to dates.

    // could test validity of dates here but I'm already doing
    // that in the main script

    $aryRange=array();

    $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2), substr($strDateFrom,8,2), substr($strDateFrom,0,4));
    $iDateTo=mktime(1,0,0,substr($strDateTo,5,2), substr($strDateTo,8,2), substr($strDateTo,0,4));

    if ($iDateTo>=$iDateFrom)
    {
        array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
        while ($iDateFrom<$iDateTo)
        {
            $iDateFrom+=86400; // add 24 hours
            array_push($aryRange,date('Y-m-d',$iDateFrom));
        }
    }
    return $aryRange;
}
            function calculateShipoutTime($start_datetime, $fingerscan_datetime) {

        	if ($start_datetime && $fingerscan_datetime) {

        		$tmpStart = new DateTime($fingerscan_datetime);
        		$tmpEnd = new DateTime($start_datetime);

        		$tmpInterval = $tmpStart->diff($tmpEnd);

	            // $tmpStart  = strtotime($fingerscan_datetime);
	            // $tmpEnd = strtotime($start_datetime);

	            // $tmpInterval = $tmpEnd - $tmpStart;

	            $result_calculateShipoutTime = $tmpInterval->format('%h:%i:%s');;

	        } else {

	        	// $result_calculateShipoutTime = $start_datetime;
	        	$result_calculateShipoutTime = "";

	        }



	        return $result_calculateShipoutTime;
	    }
                function calculateFirstSentDatetime($delivery_datetime, $first_sent_datetime) {

	            // if ($delivery_datetime) {

	        			$new = strtotime($delivery_datetime);
	        			$old = strtotime($first_sent_datetime);


	        			if ($new < $old) {
	        				$result_first_sent = $delivery_datetime;
	        			} else {
	        				$result_first_sent = $first_sent_datetime;
	        			}

	            // } 
	            // else {
	            //     $result_first_sent = $first_sent_datetime;
	            // }

	        return $result_first_sent;
	    }
            function calculateTimeBetweenStartToFirstEntryPoint($start_datetime, $end_datetime) {

        	if ($start_datetime && $end_datetime) {

        		$tmpStart = new DateTime($start_datetime);
        		$tmpEnd   = new DateTime($end_datetime);

        		$tmpInterval = $tmpStart->diff($tmpEnd);

	            $result_calculateTimeBetweenStartToFirstEntryPoint = $tmpInterval->format('%H:%i:%s');

	        } else if(!$start_datetime && $end_datetime){
	        	$result_calculateTimeBetweenStartToFirstEntryPoint = "N/A";
	        } else {
	        	$result_calculateTimeBetweenStartToFirstEntryPoint = "N/A";
	        }

	        return $result_calculateTimeBetweenStartToFirstEntryPoint;
	    }
            function calculateMaximumDeliveryTime($current_delivery_datetime, $existing_maximum_datetime) {


        	$current_dt = strtotime($current_delivery_datetime);
        	$existing_dt = strtotime($existing_maximum_datetime);


        	if ($current_dt > $existing_dt) {
        		$result_calculateMaximumDeliveryTime = $current_delivery_datetime;
        	} else {
        		$result_calculateMaximumDeliveryTime = $existing_maximum_datetime;
        	}



        	// if ($current_delivery_datetime && $existing_maximum_datetime) {

        	// 	$tmpStart = new DateTime($start_datetime);
        	// 	$tmpEnd   = new DateTime($end_datetime);

        	// 	$tmpInterval = $tmpStart->diff($tmpEnd);

	        //     $result_calculateMaximumDeliveryTime = $tmpInterval->format('%H:%i:%s');

	        // } else if(!$current_delivery_datetime && $existing_maximum_datetime){
	        // 	$result_calculateMaximumDeliveryTime = "N/A";
	        // } else {
	        // 	$result_calculateMaximumDeliveryTime = "N/A";
	        // }

	        return $result_calculateMaximumDeliveryTime;
	    }
            function calculateTotalTimeDelivery($start_datetime, $maximum_delivery_datetime) {

        	if ($start_datetime && $maximum_delivery_datetime) {

        		$tmpStart = new DateTime($start_datetime);
        		$tmpMaximumDelivery   = new DateTime($maximum_delivery_datetime);

        		$tmpInterval = $tmpStart->diff($tmpMaximumDelivery);

	            $result_calculateTotalTimeDelivery = $tmpInterval->format('%H:%i:%s');

	        } else if(!$start_datetime && $maximum_delivery_datetime){
	        	$result_calculateTotalTimeDelivery = "N/A";
	        } else {
	        	$result_calculateTotalTimeDelivery = "N/A";
	        }

	        return $result_calculateTotalTimeDelivery;
	    }



    /* Test Manager */
        $app->get('/hello/:name', function ($name) use ($app) {
 
        // $return_m = array("msg" => "สวัสดี");
        $return_m = array("msg" => "สวัสดี, $name");
 
        $app->response()->header("Content-Type", "application/json");
        echo json_encode($return_m);
    });
    $app->get('/testManager/getApiTemplate/',function() use ($app) { getApiTemplate($app); });
    $app->post('/testManager/postApiTemplate/',function() use ($app) { postApiTemplate($app); });
    $app->post('/testManager/exportExcelTemplate/',function() use ($app, $objPHPExcel) { exportExcelTemplate($app, $objPHPExcel); });
    $app->get('/testManager/memcachedTemplate/',function() use ($app, $memcachedClient) { memcachedTemplate($app, $memcachedClient); });

    /* KPI manager - Original */
    $app->post('/kpiManager/getOperationKPI/',function() use ($app, $client) { getOperationKPI($app, $client); });
    $app->post('/kpiManager/exportOperationKPI/',function() use ($app, $client, $objPHPExcel) { exportOperationKPI($app, $client, $objPHPExcel); });
    $app->post('/kpiManager/boxOperationKPI/',function() use ($app, $client, $objPHPExcel) { boxOperationKPI($app, $client, $objPHPExcel); });
    $app->post('/kpiManager/getOperationKpiSummary/',function() use ($app, $client_mis) { getOperationKpiSummary($app, $client_mis); });
    $app->post('/kpiManager/getOperationKpiSummaryInfo/',function() use ($app, $client_mis) { getOperationKpiSummaryInfo($app, $client_mis); });
    $app->post('/kpiManager/getOperationKpiSummaryInfoByWeekly/',function() use ($app, $client_mis) { getOperationKpiSummaryInfoByWeekly($app, $client_mis); });

    /* Vehicle - KPI Manager Partial */
    $app->post('/kpiManager/getVehicleKpiByDaily/',function() use ($app, $client_mis) { getVehicleKpiByDaily($app, $client_mis); });
    $app->post('/kpiManager/getVehicleKpiByWeekly/',function() use ($app, $client_mis) { getVehicleKpiByWeekly($app, $client_mis); });
    $app->post('/kpiManager/getVehicleKpiByMonthly/',function() use ($app, $client_mis) { getVehicleKpiByMonthly($app, $client_mis); });
    $app->post('/kpiManager/getVehicleKpiByQuarterly/',function() use ($app, $client_mis) { getVehicleKpiByQuarterly($app, $client_mis); });
    $app->post('/kpiManager/getVehicleKpiByHalfYear/',function() use ($app, $client_mis) { getVehicleKpiByHalfYear($app, $client_mis); });

    /* Vehicle Leader - KPI Manager Partial */
    $app->post('/kpiManager/getVehicleLeaderKpiByDaily/',function() use ($app, $client_mis) { getVehicleLeaderKpiByDaily($app, $client_mis); });
    $app->post('/kpiManager/getVehicleLeaderKpiByWeekly/',function() use ($app, $client_mis) { getVehicleLeaderKpiByWeekly($app, $client_mis); });
    $app->post('/kpiManager/getVehicleLeaderKpiByMonthly/',function() use ($app, $client_mis) { getVehicleLeaderKpiByMonthly($app, $client_mis); });
    $app->post('/kpiManager/getVehicleLeaderKpiByQuarterly/',function() use ($app, $client_mis) { getVehicleLeaderKpiByQuarterly($app, $client_mis); });
    $app->post('/kpiManager/getVehicleLeaderKpiByHalfYear/',function() use ($app, $client_mis) { getVehicleLeaderKpiByHalfYear($app, $client_mis); });

    /* Menu Manager */
    $app->post('/menuManager/listMenu/',function() use ($app, $pdo, $db) { listMenu($app, $pdo, $db); });

    /* Permission manager */
    $app->post('/permissionManager/login/',function() use ($app, $client_mis, $key) { login($app, $client_mis, $key); });
    $app->post('/permissionManager/checkJWT/',function() use ($app, $key) { checkJWT($app, $key); });
    $app->get('/permissionManager/getJWT/',function() use ($app) { getJWT($app); });
    $app->post('/permissionManager/logout/',function() use ($app) { logout($app); });
 
    // Run app
    $app->run();

    /* Test Manager Partial */
        /**
     *
     * @apiName GetApiTemplate
     * @apiGroup Test Manager
     * @apiVersion 0.1.0
     *
     * @api {get} /testManager/getApiTemplate/ Get API template
     * @apiDescription คำอธิบาย : ในส่วนนี้เป็นเทมเพล็ตสำหรับการสร้าง GET - API Template
     *
     */

    function getApiTemplate($app) {


        /* ************************* */
        /* เริ่มกระบวนการส่งค่ากลับ */
        /* ************************* */
        $reportResult = array("msg" => "สวัสดี");
 
        $app->response()->header("Content-Type", "application/json");
        echo json_encode($reportResult);


    };
        /**
     *
     * @apiName PostApiTemplate
     * @apiGroup Test Manager
     * @apiVersion 0.1.0
     *
     * @api {post} /testManager/postApiTemplate/ Post API template
     * @apiDescription คำอธิบาย : ในส่วนนี้เป็นเทมเพล็ตสำหรับการสร้าง POST - API Template
     *
     */

    function postApiTemplate($app) {


        /* ************************* */
        /* เริ่มกระบวนการส่งค่ากลับ */
        /* ************************* */
        $reportResult = array("msg" => "สวัสดี");
 
        $app->response()->header("Content-Type", "application/json");
        echo json_encode($reportResult);


    };
        /**
     *
     * @apiName ExportExcelTemplate
     * @apiGroup Test Manager
     * @apiVersion 0.1.0
     *
     * @api {post} /testManager/exportExcelTemplate/ Export excel - template
     * @apiDescription คำอธิบาย : ในส่วนนี้เป็นเทมเพล็ตสำหรับการสร้าง Export Excel Template
     *
     */

    function exportExcelTemplate($app, $objPHPExcel) {


        /* ************************* */
        /* เริ่มกระบวนการสร้าง Excel file */
        /* ************************* */

        $sheetCount = $objPHPExcel->getSheetCount();

        /* Create Worksheet พร้อมกำหนดชื่อ */
        $objPHPExcel_ITEM_HIS_DF_Worksheet = new \PHPExcel_Worksheet($objPHPExcel, 'ITEM_HIS_DF');
        $objPHPExcel->addSheet($objPHPExcel_ITEM_HIS_DF_Worksheet, $sheetCount);
        $objPHPExcel_ITEM_HIS_DF_Worksheet->setTitle('ITEM_HIS_DF');

        /* กำหนดให้เป็น ActiveWorkSheet */
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex($sheetCount);

        $col = 0;
        $row = 1;
        $value = "Josh-00";
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);

        $col = 1;
        $row = 1;
        $value = "Josh-11";
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);

        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
                                     ->setLastModifiedBy("Maarten Balliauw")
                                     ->setTitle("Office 2007 XLSX Test Document")
                                     ->setSubject("Office 2007 XLSX Test Document")
                                     ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                                     ->setKeywords("office 2007 openxml php")
                                     ->setCategory("Test result file");


        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="01simple.xls"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $date = new DateTime();
        // $fileName = 'Quickload_for_MODBUS('.$paramFastToolsDestination.')'.'_'.date("Y-m-d").'_'.$date->getTimestamp().'.xls';
        $fileName = 'Test.xls';
        $filePath = '../../../files/'.$fileName;
        $objWriter->save($filePath);


        /* ************************* */
        /* เริ่มกระบวนการส่งค่ากลับ */
        /* ************************* */
        $resultText = "success";

        $reportResult = array("result" =>  $resultText,
                              "filename" => $fileName,
                              "path" => url()."/iel-mis/build/files/".$fileName);
        $app->response()->header("Content-Type", "application/json");
        echo json_encode($reportResult);


    };
        /**
     *
     * @apiName MemcachedTemplate
     * @apiGroup Test Manager
     * @apiVersion 0.1.0
     *
     * @api {get} /testManager/memcachedTemplate/ Memcached client template
     * @apiDescription คำอธิบาย : ในส่วนนี้เป็นเทมเพล็ตสำหรับการสร้าง GET - Memcached client Template
     *
     */

    function memcachedTemplate($app, $memcachedClient) {

        $resultSetMemcached = $memcachedClient->set('foobar', 42); // Return 1

        if ($resultSetMemcached) {
            $result = $memcachedClient->get('foobar');
        } else {
            $result = "Can not get value!!";
        }
        

        /* ************************* */
        /* เริ่มกระบวนการส่งค่ากลับ */
        /* ************************* */
        $reportResult = array("msg" => $result);
 
        $app->response()->header("Content-Type", "application/json");
        echo json_encode($reportResult);


    };

    /* KPI Manager Partial */
        /**
     *
     * @apiName GetOperationKPI
     * @apiGroup KPI Manager
     * @apiVersion 0.1.0
     *
     * @api {post} /kpiManager/getOperationKPI/  Get operation KPI
     * @apiDescription คำอธิบาย : ในส่วนนี้จะเรียก WebService getOperationKPI
     *
     */

    function getOperationKPI($app, $client) {

        /* ************************* */
        /* เริ่มกระบวนการรับค่าพารามิเตอร์จากส่วนของ Payload ซึ่งอยู่ในรูปแบบ JSON */
        /* ************************* */
        $headers = $app->request->headers;
        $ContetnType = $app->request->headers->get('Content-Type');

        /**
        * apidoc @apiSampleRequest, iOS RESTKit use content-type is "application/json"
        * Web Form, Advance REST Client App use content-type is "application/x-www-form-urlencoded"
        */

        if (($ContetnType == "application/json") || ($ContetnType == "application/json; charset=utf-8") ) {

            $request = $app->request();
            $result = json_decode($request->getBody());

            /* receive request */
            $postStartDate = $result->startDate;              /* รูปแบบ เดือน/วัน/ปี */
            $postEndDate = $result->endDate;               /* รูปแบบ เดือน/วัน/ปี */
            $postSiteName = $result->siteName;

            // $postStartDate = "05/30/2016";              /* รูปแบบ เดือน/วัน/ปี */
            // $postEndDate = "05/30/2016";                /* รูปแบบ เดือน/วัน/ปี */
            // $postSiteName = "bc";


        } else if (($ContetnType == "application/x-www-form-urlencoded") || ($ContetnType == "application/x-www-form-urlencoded; charset=UTF-8")){

            //$userID = $app->request()->params('userID_param');
            //$userID = $app->request()->post('userID_param');

            // $postStartDate = $app->request()->post('startDate');            /* รูปแบบ เดือน/วัน/ปี */
            // $postEndDate = $app->request()->post('endDate');               /* รูปแบบ เดือน/วัน/ปี */
            // $postEndDate = $app->request()->post('siteName'); 

        } 




        $error = $client->getError();
        if ($error) {
            echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
        }

        /* ************************* */
        /* เริ่มกระบวนการเชื่อมต่อ Web Service */
        /* ************************* */

        $result = $client->call('getOperationKPI', array("startDate" => $postStartDate,
                                                         "endDate" => $postEndDate,
                                                         "siteName" => $postSiteName));
        $mydata = json_decode($result["getOperationKPIResult"],true);

        $reports = array();
        $reports_details = array();

        /* initial variable Partial */
                /* initial variable Partial */
        $tmpJobDate = "";
        $tmpJobNo = "";

        $tmpSection = "";
        $tmpSupervisor = "";
        $tmpDriverName = "";

        $tmpVehicleType = "";
        $tmpVehicleLicence = "";
        $tmpDropAll = 0;
        $tmpDropSuccess = 0;

        $tmpBoxAmount = 0;
        $tmpBoxAll = 0;
        $tmpBoxSuccess = 0;

        $tmpBill = "";
        $tmpBillCount = 0;

        $tmpBillAndUserUpdate = "";
        $tmpBillClosedWithEPODCount = 0;

        $tmpBillClosedAfter6pmCount = 0;

        $tmpDestination = "";
        
        $j = 0;
        $k = 0;

        for ($i=0; $i < count($mydata["array"]); $i++) { 

            if (!$tmpJobNo) {
                $tmpJobDate = $mydata["array"][$i]['JobDate'];
                $tmpJobNo = $mydata["array"][$i]['JobNo'];

                $tmpSection = $mydata["array"][$i]['section'];
                $tmpSupervisor = $mydata["array"][$i]['Supervisor'];
                $tmpVehicleType = $mydata["array"][$i]['VehicleType'];
                $tmpVehicleLicence = $mydata["array"][$i]['VehicleLicence'];
                $tmpDriverName = $mydata["array"][$i]['DriverName'];
                // $tmpBill = $mydata["array"][$i]['DocNo'];
                $tmpDestination = $mydata["array"][$i]['destination'];
                $tmpDropAll = 1;
            }

                        if ($i == count($mydata["array"])-1) {

                $k++;

                /* summary data for current JobNo Partial */

                if ($tmpDestination != $mydata["array"][$i]['destination']) {
                    $tmpDropAll++;
                }

                if ($tmpDestination != $mydata["array"][$i]['destination']) {
                    if ($mydata["array"][$i]['DeliveryDateTime']) {
                        $tmpDropSuccess++;
                    }
                }

                $tmpBoxAmount = $mydata["array"][$i]['amount'];
                $tmpBoxAll = $tmpBoxAll + (int)str_replace(' ', '', $tmpBoxAmount);

                if ($mydata["array"][$i]['DeliveryDateTime']) {
                    $tmpBoxSuccess = $tmpBoxSuccess + (int)str_replace(' ', '', $tmpBoxAmount);
                }

                /* Count Bill or Doc No. which closed by EPOD */
                if ($tmpBill != $mydata["array"][$i]['DocNo']) {
                    if (strpos($mydata["array"][$i]['UserUpdate'], 'mb') !== false) {
                        $tmpBillClosedWithEPODCount++;
                    }

                    $tmpBillAndUserUpdate = ($mydata["array"][$i]['DocNo']."_".$mydata["array"][$i]['UserUpdate']);

                } else {

                    // $tmpBillAndUserUpdate = ($mydata["array"][$i]['DocNo']."_".$mydata["array"][$i]['UserUpdate']);

                    if ($tmpBillAndUserUpdate != ($mydata["array"][$i]['DocNo']."_".$mydata["array"][$i]['UserUpdate'])) {
                        if (strpos($mydata["array"][$i]['UserUpdate'], 'mb') !== false) {
                            $tmpBillClosedWithEPODCount++;
                        }
                    }
                }



                // if ($tmpBill == $mydata["array"][$i]['DocNo']) {
                //     // if ($tmpBillAndUserUpdate != ($mydata["array"][$i]['DocNo']."_".$mydata["array"][$i]['UserUpdate'])) {
                //         $tmpBillAndUserUpdate = ($mydata["array"][$i]['DocNo']."_".$mydata["array"][$i]['UserUpdate']);
                //     // }
                // } else {
                //     $tmpBillAndUserUpdate = "";
                // }


                /* Count Bill or Doc No. */
                if ($tmpBill != $mydata["array"][$i]['DocNo']) {
                    $tmpBillCount++;
                    $tmpBill = $mydata["array"][$i]['DocNo'];
                }
                // $tmpBill = $mydata["array"][$i]['DocNo'];





                /* prepare data for current JobNo : bill closed after 6pm Partial */
                                /* Count Bill is closed after 6 PM, EPOD only */
                $current_job_date_time_formattedDate = "";
                $current_job_date_time_unixTimestamp = "";
                $death_line_date_time_formattedDate = "";
                $death_line_date_time_unixTimestamp = "";
                $delivery_date_time_formattedDate = "";
                $delivery_date_time_unixTimestamp = "";
                if (strpos($mydata["array"][$i]['UserUpdate'], 'mb') !== false) {

                    if ($mydata["array"][$i]['JobDate']) {
                        $tz = 'Asia/Bangkok';
                        $d_jobDate = new DateTime($mydata["array"][$i]['JobDate'], new DateTimeZone($tz));
                        $current_job_date_time_formattedDate = $d_jobDate->format('Y-m-d H:i:s'); 
                        $current_job_date_time_unixTimestamp = $d_jobDate->getTimestamp() + 7*60*60;
                        $death_line_date_time_unixTimestamp = $d_jobDate->getTimestamp() + 7*60*60 + 18*60*60;
                        $dt_death_line = new DateTime("@$death_line_date_time_unixTimestamp");  // convert UNIX timestamp to PHP DateTime
                        $death_line_date_time_formattedDate = $dt_death_line->format('Y-m-d H:i:s');
                    } 

                    if ($mydata["array"][$i]['DeliveryDateTime']) {
                        $tz = 'Asia/Bangkok';
                        $d_deliveryDate = new DateTime($mydata["array"][$i]['DeliveryDateTime'], new DateTimeZone($tz));
                        $delivery_date_time_formattedDate = $d_deliveryDate->format('Y-m-d H:i:s'); 
                        $delivery_date_time_unixTimestamp = $d_deliveryDate->getTimestamp() + 7*60*60;
                    } 
                }


                $reports_details[] = array(
                    "id" => $k,
                    "job_date" => $tmpJobDate,
                    "job_no" => $tmpJobNo,
                    "job_remark" => $mydata["array"][$i]['JobRemark'],
                    "supervisor" => $mydata["array"][$i]['Supervisor'],
                    "vehicle_licence" => $tmpVehicleLicence,
                    "vehicle_type" => $mydata["array"][$i]['VehicleType'],
                    "driver_name" => $mydata["array"][$i]['DriverName'],
                    "delivery_date_time" => $mydata["array"][$i]['DeliveryDateTime'],
                    "amount" => $mydata["array"][$i]['amount'],
                    "doc_no" => $mydata["array"][$i]['DocNo'],
                    "user_update" => $mydata["array"][$i]['UserUpdate'],
                    "current_job_date_time_formatted" => $current_job_date_time_formattedDate,
                    "current_job_date_time_unix" => $current_job_date_time_unixTimestamp,
                    "death_line_date_time_formatted" => $death_line_date_time_formattedDate,
                    "death_line_date_time_unix" => $death_line_date_time_unixTimestamp,
                    "delivery_date_time_formatted" => $delivery_date_time_formattedDate,
                    "delivery_date_time_unix" => $delivery_date_time_unixTimestamp,
                    "destination" => $tmpDestination
                );




                // $tmpJobNo = "";
                $mydata["array"][$i]['JobNo'] = "";
            }

            if ($tmpJobNo != $mydata["array"][$i]['JobNo']) {

                $j++;

                // $reports[] = array(
                //         "id" => $j,
                //         "job_date" => $tmpJobDate,
                //         "job_no" => $tmpJobNo,
                //         "section" => $mydata["array"][$i]['section'],
                //         "supervisor" => $mydata["array"][$i]['Supervisor'],
                //         "vehicle_licence" => $tmpVehicleLicence,
                //         "vehicle_type" => $mydata["array"][$i]['VehicleType'],
                //         "driver_name" => $mydata["array"][$i]['DriverName'],
                //         "drop_all" => $tmpDropAll,
                //         "drop_success" => $tmpDropSuccess,
                //         "box_all" => $tmpBoxAll,
                //         "box_success" => $tmpBoxSuccess,
                //         "bill_count" => $tmpBillCount,
                //         "bill_closed_with_epod_count" => $tmpBillClosedWithEPODCount,
                //         "bill_closed_after_6pm_count" => $tmpBillClosedAfter6pmCount,
                //         "details" => $reports_details
                //     );

                $reports[] = array(
                        "id" => $j,
                        "job_date" => $tmpJobDate,
                        "job_no" => $tmpJobNo,
                        "section" => $tmpSection,
                        "supervisor" => $tmpSupervisor,
                        "vehicle_licence" => $tmpVehicleLicence,
                        "vehicle_type" => $tmpVehicleType,
                        "driver_name" => $tmpDriverName,
                        "drop_all" => $tmpDropAll,
                        "drop_success" => $tmpDropSuccess,
                        "box_all" => $tmpBoxAll,
                        "box_success" => $tmpBoxSuccess,
                        "bill_count" => $tmpBillCount,
                        "bill_closed_with_epod_count" => $tmpBillClosedWithEPODCount,
                        "bill_closed_after_6pm_count" => $tmpBillClosedAfter6pmCount,
                        "details" => $reports_details
                    );

                /* prepare data for new JobNo Partial */
                                /* prepare data for new JobNo Partial */
                $k = 1;

                $tmpJobDate = $mydata["array"][$i]['JobDate'];
                $tmpJobNo = $mydata["array"][$i]['JobNo'];
                $tmpVehicleLicence = $mydata["array"][$i]['VehicleLicence'];


                if ($tmpDestination != $mydata["array"][$i]['destination']) {
                    $tmpDropAll = 1;
                }

                $tmpDropSuccess = 0;
                if ($tmpDestination != $mydata["array"][$i]['destination']) {
                    if ($mydata["array"][$i]['DeliveryDateTime']) {
                        $tmpDropSuccess++;
                    }
                }

                $tmpDestination = $mydata["array"][$i]['destination'];
                                                        

                $tmpBoxAll = 0;
                $tmpBoxAmount = $mydata["array"][$i]['amount'];
                $tmpBoxAll = $tmpBoxAll + (int)str_replace(' ', '', $tmpBoxAmount);

                $tmpBoxSuccess = 0;
                if ($mydata["array"][$i]['DeliveryDateTime']) {
                    $tmpBoxSuccess = $tmpBoxSuccess + (int)str_replace(' ', '', $tmpBoxAmount);
                }


                /* prepare data for new JobNo : bill closed after 6pm Partial */
                                /* Count Bill is closed after 6 PM, EPOD only */
                $tmpBillClosedAfter6pmCount = 0;
                $current_job_date_time_formattedDate = "";
                $current_job_date_time_unixTimestamp = "";
                $death_line_date_time_formattedDate = "";
                $death_line_date_time_unixTimestamp = "";
                $delivery_date_time_formattedDate = "";
                $delivery_date_time_unixTimestamp = "";
                if (strpos($mydata["array"][$i]['UserUpdate'], 'mb') !== false) {

                    if ($mydata["array"][$i]['JobDate']) {
                        $tz = 'Asia/Bangkok';
                        $d_jobDate = new DateTime($mydata["array"][$i]['JobDate'], new DateTimeZone($tz));
                        $current_job_date_time_formattedDate = $d_jobDate->format('Y-m-d H:i:s'); 
                        $current_job_date_time_unixTimestamp = $d_jobDate->getTimestamp() + 7*60*60;
                        $death_line_date_time_unixTimestamp = $d_jobDate->getTimestamp() + 7*60*60 + 18*60*60;
                        $dt_death_line = new DateTime("@$death_line_date_time_unixTimestamp");  // convert UNIX timestamp to PHP DateTime
                        $death_line_date_time_formattedDate = $dt_death_line->format('Y-m-d H:i:s');
                    } 

                    if ($mydata["array"][$i]['DeliveryDateTime']) {
                        $tz = 'Asia/Bangkok';
                        $d_deliveryDate = new DateTime($mydata["array"][$i]['DeliveryDateTime'], new DateTimeZone($tz));
                        $delivery_date_time_formattedDate = $d_deliveryDate->format('Y-m-d H:i:s'); 
                        $delivery_date_time_unixTimestamp = $d_deliveryDate->getTimestamp() + 7*60*60;
                    } 

                    if ($delivery_date_time_unixTimestamp > $death_line_date_time_unixTimestamp) {

                        if ($tmpBill != $mydata["array"][$i]['DocNo']) {
                            if (strpos($mydata["array"][$i]['UserUpdate'], 'mb') !== false) {
                                $tmpBillClosedAfter6pmCount++;
                            }

                            // $tmpBillAndUserUpdate = ($mydata["array"][$i]['DocNo']."_".$mydata["array"][$i]['UserUpdate']);

                        } else {

                            if ($tmpBillAndUserUpdate != ($mydata["array"][$i]['DocNo']."_".$mydata["array"][$i]['UserUpdate'])) {
                                if (strpos($mydata["array"][$i]['UserUpdate'], 'mb') !== false) {
                                    $tmpBillClosedAfter6pmCount++;
                                }
                            }
                        }
                    }

                    
                }

                
                /* Count Bill or Doc No. which closed by EPOD */
                $tmpBillClosedWithEPODCount = 0;
                if ($tmpBill != $mydata["array"][$i]['DocNo']) {
                        if (strpos($mydata["array"][$i]['UserUpdate'], 'mb') !== false) {
                            $tmpBillClosedWithEPODCount++;
                        }

                        $tmpBillAndUserUpdate = ($mydata["array"][$i]['DocNo']."_".$mydata["array"][$i]['UserUpdate']);
                        
                } else {

                    if ($tmpBillAndUserUpdate != ($mydata["array"][$i]['DocNo']."_".$mydata["array"][$i]['UserUpdate'])) {
                        if (strpos($mydata["array"][$i]['UserUpdate'], 'mb') !== false) {
                            $tmpBillClosedWithEPODCount++;
                        }
                    }
                }

                /* Count Bill or Doc No. */
                $tmpBillCount = 0;
                if ($tmpBill != $mydata["array"][$i]['DocNo']) {
                    $tmpBillCount++;
                    $tmpBill = $mydata["array"][$i]['DocNo'];
                }




                $reports_details = array();
                $reports_details[] = array(
                    "id" => $k,
                    "job_date" => $tmpJobDate,
                    "job_no" => $tmpJobNo,
                    "job_remark" => $mydata["array"][$i]['JobRemark'],
                    "supervisor" => $mydata["array"][$i]['Supervisor'],
                    "vehicle_licence" => $tmpVehicleLicence,
                    "vehicle_type" => $mydata["array"][$i]['VehicleType'],
                    "driver_name" => $mydata["array"][$i]['DriverName'],
                    "delivery_date_time" => $mydata["array"][$i]['DeliveryDateTime'],
                    "amount" => $mydata["array"][$i]['amount'],
                    "doc_no" => $mydata["array"][$i]['DocNo'],
                    "user_update" => $mydata["array"][$i]['UserUpdate'],
                    "current_job_date_time_formatted" => $current_job_date_time_formattedDate,
                    "current_job_date_time_unix" => $current_job_date_time_unixTimestamp,
                    "death_line_date_time_formatted" => $death_line_date_time_formattedDate,
                    "death_line_date_time_unix" => $death_line_date_time_unixTimestamp,
                    "delivery_date_time_formatted" => $delivery_date_time_formattedDate,
                    "delivery_date_time_unix" => $delivery_date_time_unixTimestamp,
                    "destination" => $tmpDestination

                );
                


            } else {

                /* summary data for current JobNo Partial */
                
                $k++;

                /* summary data for current JobNo Partial */
                if ($tmpDestination != $mydata["array"][$i]['destination']) {
                    $tmpDropAll++;
                }

                if ($tmpDestination != $mydata["array"][$i]['destination']) {
                    if ($mydata["array"][$i]['DeliveryDateTime']) {
                        $tmpDropSuccess++;
                    }
                }

                $tmpBoxAmount = $mydata["array"][$i]['amount'];
                $tmpBoxAll = $tmpBoxAll + (int)str_replace(' ', '', $tmpBoxAmount);

                if ($mydata["array"][$i]['DeliveryDateTime']) {
                    $tmpBoxSuccess = $tmpBoxSuccess + (int)str_replace(' ', '', $tmpBoxAmount);
                }


                /* prepare data for current JobNo : bill closed after 6pm Partial */
                                /* Count Bill is closed after 6 PM, EPOD only */
                $current_job_date_time_formattedDate = "";
                $current_job_date_time_unixTimestamp = "";
                $death_line_date_time_formattedDate = "";
                $death_line_date_time_unixTimestamp = "";
                $delivery_date_time_formattedDate = "";
                $delivery_date_time_unixTimestamp = "";
                if (strpos($mydata["array"][$i]['UserUpdate'], 'mb') !== false) {

                    if ($mydata["array"][$i]['JobDate']) {
                        $tz = 'Asia/Bangkok';
                        $d_jobDate = new DateTime($mydata["array"][$i]['JobDate'], new DateTimeZone($tz));
                        $current_job_date_time_formattedDate = $d_jobDate->format('Y-m-d H:i:s'); 
                        $current_job_date_time_unixTimestamp = $d_jobDate->getTimestamp() + 7*60*60;
                        $death_line_date_time_unixTimestamp = $d_jobDate->getTimestamp() + 7*60*60 + 18*60*60;
                        $dt_death_line = new DateTime("@$death_line_date_time_unixTimestamp");  // convert UNIX timestamp to PHP DateTime
                        $death_line_date_time_formattedDate = $dt_death_line->format('Y-m-d H:i:s');
                    } 

                    if ($mydata["array"][$i]['DeliveryDateTime']) {
                        $tz = 'Asia/Bangkok';
                        $d_deliveryDate = new DateTime($mydata["array"][$i]['DeliveryDateTime'], new DateTimeZone($tz));
                        $delivery_date_time_formattedDate = $d_deliveryDate->format('Y-m-d H:i:s'); 
                        $delivery_date_time_unixTimestamp = $d_deliveryDate->getTimestamp() + 7*60*60;
                    } 

                    if ($delivery_date_time_unixTimestamp > $death_line_date_time_unixTimestamp) {

                        if ($tmpBill != $mydata["array"][$i]['DocNo']) {
                            if (strpos($mydata["array"][$i]['UserUpdate'], 'mb') !== false) {
                                $tmpBillClosedAfter6pmCount++;
                            }

                            // $tmpBillAndUserUpdate = ($mydata["array"][$i]['DocNo']."_".$mydata["array"][$i]['UserUpdate']);

                        } else {

                            if ($tmpBillAndUserUpdate != ($mydata["array"][$i]['DocNo']."_".$mydata["array"][$i]['UserUpdate'])) {
                                if (strpos($mydata["array"][$i]['UserUpdate'], 'mb') !== false) {
                                    $tmpBillClosedAfter6pmCount++;
                                }
                            }
                        }
                    }
                    
                }

                
                /* Count Bill or Doc No. which closed by EPOD */
                if ($tmpBill != $mydata["array"][$i]['DocNo']) {
                    if (strpos($mydata["array"][$i]['UserUpdate'], 'mb') !== false) {
                        $tmpBillClosedWithEPODCount++;
                    }

                    $tmpBillAndUserUpdate = ($mydata["array"][$i]['DocNo']."_".$mydata["array"][$i]['UserUpdate']);

                } else {

                    // $tmpBillAndUserUpdate = ($mydata["array"][$i]['DocNo']."_".$mydata["array"][$i]['UserUpdate']);

                    if ($tmpBillAndUserUpdate != ($mydata["array"][$i]['DocNo']."_".$mydata["array"][$i]['UserUpdate'])) {
                        if (strpos($mydata["array"][$i]['UserUpdate'], 'mb') !== false) {
                            $tmpBillClosedWithEPODCount++;
                        }
                    }
                }


                /* Count Bill or Doc No. */
                if ($tmpBill != $mydata["array"][$i]['DocNo']) {
                    $tmpBillCount++;
                    $tmpBill = $mydata["array"][$i]['DocNo'];
                }




                

                $reports_details[] = array(
                    "id" => $k,
                    "job_date" => $tmpJobDate,
                    "job_no" => $tmpJobNo,
                    "job_remark" => $mydata["array"][$i]['JobRemark'],
                    "supervisor" => $mydata["array"][$i]['Supervisor'],
                    "vehicle_licence" => $tmpVehicleLicence,
                    "vehicle_type" => $mydata["array"][$i]['VehicleType'],
                    "driver_name" => $mydata["array"][$i]['DriverName'],
                    "delivery_date_time" => $mydata["array"][$i]['DeliveryDateTime'],
                    "amount" => $mydata["array"][$i]['amount'],
                    "doc_no" => $mydata["array"][$i]['DocNo'],
                    "user_update" => $mydata["array"][$i]['UserUpdate'],
                    "current_job_date_time_formatted" => $current_job_date_time_formattedDate,
                    "current_job_date_time_unix" => $current_job_date_time_unixTimestamp,
                    "death_line_date_time_formatted" => $death_line_date_time_formattedDate,
                    "death_line_date_time_unix" => $death_line_date_time_unixTimestamp,
                    "delivery_date_time_formatted" => $delivery_date_time_formattedDate,
                    "delivery_date_time_unix" => $delivery_date_time_unixTimestamp,
                    "destination" => $tmpDestination
                );
                

            }

        }

        $rowCount = count($mydata["array"]);

        /* ************************* */
        /* เริ่มกระบวนการส่งค่ากลับ */
        /* ************************* */
        $resultText = "success";

        $reportResult = array("result" =>  $resultText, 
                              "start_date" => $postStartDate,
                              "end_date" => $postEndDate,
                              "site_name" => $postSiteName,
                              "ws_records_count" => $rowCount, 
                              "info_records_count" => $j, 
                              "rows" => $reports,
                              "content-type" => $ContetnType);
        $app->response()->header("Content-Type", "application/json");
        echo json_encode($reportResult);


    };
        /**
     *
     * @apiName ExportOperationKPI
     * @apiGroup KPI Manager
     * @apiVersion 0.1.0
     *
     * @api {post} /kpiManager/exportOperationKPI/ Export operation KPI
     * @apiDescription คำอธิบาย : ในส่วนนี้ทำหน้าที่ Export ข้อมูลที่ได้รับจาก Web Service - getOperationKPI ให้อยู่ในรูปแบบไฟล์ Excel
     *
     *
     *
     * @apiParam {String} startDate = "06/28/2016" คำอธิบาย วันเริ่มต้น รูปแบบคือ เดือน/วัน/ปี
     * @apiParam {String} endDate = "06/29/2016" คำอธิบาย วันสิ้นสุด รูปแบบคือ เดือน/วัน/ปี
     * @apiParam {String} siteName = "bc" คำอธิบาย รหัสศูนย์
     *
     * @apiParamExample {json} Request-Example (ตัวอย่าง Payload, Content-Type: application/json):
     *
     *  {
     *    "startDate": "06/28/2016",
     *    "endDate": "06/29/2016",
     *    "siteName": "bc"
     *  }
     *
     *
     * @apiSampleRequest /kpiManager/exportOperationKPI/
     *
     * @apiSuccess (คำอธิบายผลลัพธ์ (กรณีส่งค่ากลับสำเร็จ Success 200)) {String} id แสดงข้อความทักทายผู้ใช้งาน
     * @apiSuccess (คำอธิบายผลลัพธ์ (กรณีส่งค่ากลับสำเร็จ Success 200)) {String} job_no แสดงข้อความทักทายผู้ใช้งาน
     * @apiSuccess (คำอธิบายผลลัพธ์ (กรณีส่งค่ากลับสำเร็จ Success 200)) {String} section แสดงข้อความทักทายผู้ใช้งาน
     * @apiSuccess (คำอธิบายผลลัพธ์ (กรณีส่งค่ากลับสำเร็จ Success 200)) {String} supervisor แสดงข้อความทักทายผู้ใช้งาน
     * @apiSuccess (คำอธิบายผลลัพธ์ (กรณีส่งค่ากลับสำเร็จ Success 200)) {String} vehicle_licence แสดงข้อความทักทายผู้ใช้งาน
     * @apiSuccess (คำอธิบายผลลัพธ์ (กรณีส่งค่ากลับสำเร็จ Success 200)) {String} driver_name แสดงข้อความทักทายผู้ใช้งาน
     * @apiSuccess (คำอธิบายผลลัพธ์ (กรณีส่งค่ากลับสำเร็จ Success 200)) {String} route_code แสดงข้อความทักทายผู้ใช้งาน
     * @apiSuccess (คำอธิบายผลลัพธ์ (กรณีส่งค่ากลับสำเร็จ Success 200)) {String} fingerscan_datetime แสดงข้อความทักทายผู้ใช้งาน
     * @apiSuccess (คำอธิบายผลลัพธ์ (กรณีส่งค่ากลับสำเร็จ Success 200)) {String} start_datetime แสดงข้อความทักทายผู้ใช้งาน
     * @apiSuccess (คำอธิบายผลลัพธ์ (กรณีส่งค่ากลับสำเร็จ Success 200)) {String} shipout_time แสดงข้อความทักทายผู้ใช้งาน
     * @apiSuccess (คำอธิบายผลลัพธ์ (กรณีส่งค่ากลับสำเร็จ Success 200)) {String} first_sent_datetime แสดงข้อความทักทายผู้ใช้งาน
     * @apiSuccess (คำอธิบายผลลัพธ์ (กรณีส่งค่ากลับสำเร็จ Success 200)) {String} time_between_start_to_first_entry_point แสดงข้อความทักทายผู้ใช้งาน
     * @apiSuccess (คำอธิบายผลลัพธ์ (กรณีส่งค่ากลับสำเร็จ Success 200)) {String} maximum_delivery_time แสดงข้อความทักทายผู้ใช้งาน
     * @apiSuccess (คำอธิบายผลลัพธ์ (กรณีส่งค่ากลับสำเร็จ Success 200)) {String} total_time_delivery แสดงข้อความทักทายผู้ใช้งาน
     * @apiSuccess (คำอธิบายผลลัพธ์ (กรณีส่งค่ากลับสำเร็จ Success 200)) {String} job_cost ค่าจ้างพนักงานขับรถ (พขร)
     * @apiSuccess (คำอธิบายผลลัพธ์ (กรณีส่งค่ากลับสำเร็จ Success 200)) {String} drop_all เงื่อนไข : <br/>1. วนลูปนับจำนวนบิล "DocNo" หรือจำนวน Drop นั่นเอง
     * @apiSuccess (คำอธิบายผลลัพธ์ (กรณีส่งค่ากลับสำเร็จ Success 200)) {String} drop_success เงื่อนไข : <br/>1. วนลูปนับจำนวนบิล "DocNo" หรือจำนวน Drop นั่นเอง <br/>2. และมีค่าฟิลด์ “DeliveryDateTime” ไม่เป็น null
     * @apiSuccess (คำอธิบายผลลัพธ์ (กรณีส่งค่ากลับสำเร็จ Success 200)) {String} box_all เงื่อนไข : <br/>1.วนลูปนับจำนวนกล่อง จากฟิลด์ "amount" ที่มีบิล "DocNo" ไม่ซ้ำ
     * @apiSuccess (คำอธิบายผลลัพธ์ (กรณีส่งค่ากลับสำเร็จ Success 200)) {String} box_success เงื่อนไข : <br/>1.วนลูปนับจำนวนกล่อง จากฟิลด์ "amount" ที่มีบิล "DocNo" ไม่ซ้ำ <br/>2. และ่ค่าฟิลด์ “DeliveryDateTime” ไม่เป็น null
     * @apiSuccess (คำอธิบายผลลัพธ์ (กรณีส่งค่ากลับสำเร็จ Success 200)) {String} bill_count เงื่อนไข : <br/>1.วนลูปนับจำนวนบิล "DocNo" ที่ไม่ซ้ำ
     * @apiSuccess (คำอธิบายผลลัพธ์ (กรณีส่งค่ากลับสำเร็จ Success 200)) {String} bill_closed_with_epod_count เงื่อนไข : <br/>1.วนลูปนับจำนวนบิล "DocNo" ที่ไม่ซ้ำ <br/>2. ถ้าฟิลด์ "UserUpdate" มีคำว่า <i>mb</i> แสดงว่า ปิดด้วย EPOD <br/>หมายเหตุ :  % E-POD = จำนวน ปิดด้วย E-POD (บิล) / จำนวนบิล
     * @apiSuccess (คำอธิบายผลลัพธ์ (กรณีส่งค่ากลับสำเร็จ Success 200)) {String} bill_closed_after_6pm_count วนลูปนับจำนวนบิล "DocNo" ที่ไม่ซ้ำกัน และ่ตรวจสอบเวลา จากฟิลด์ “DeliveryDateTime” ที่มีค่ามากกว่า 18:00 น.
     *
     * @apiSuccessExample Example data on success:
     *  {
     *    "result": "success",
     *    "rows": [
     *      {
     *        "id": 1,
     *        "job_no": "JHO160628060",
     *        "section": "BC",
     *        "supervisor": "นายปรัชญา  ทองวิเศษ",
     *        "vehicle_licence": "ฒภ-1267",
     *        "vehicle_type": "Pick up",
     *        "driver_name": "นายจตุเมธ  โพธิ์งาม",
     *        "route_code": "B12",
     *        "fingerscan_datetime": "",
     *        "start_datetime": "2016-06-28T05:54:34.077",
     *        "shipout_time": "",
     *        "first_sent_datetime": "2016-06-28T08:36:00",
     *        "time_between_start_to_first_entry_point": "02:41:26",
     *        "maximum_delivery_time": "19:48:00",
     *        "total_time_delivery": "13:53:26",
     *        "job_cost": 1485,
     *        "drop_all": 0,
     *        "drop_success": 0,
     *        "box_all": 0,
     *        "box_success": 0,
     *        "bill_count": 0,
     *        "bill_closed_with_epod_count": 0,
     *        "bill_closed_after_6pm_count": 0
     *      }
     *    ]
     *  }
     *
     * @apiError (คำอธิบายผลลัพธ์ (กรณีเกิด Error 4xx)) UserNotFound The <code>id</code> of the User was not found.
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "error": "UserNotFound"
     *     }
     */

    function exportOperationKPI($app, $client, $objPHPExcel) {

        /* ************************* */
        /* เริ่มกระบวนการรับค่าพารามิเตอร์จากส่วนของ Payload ซึ่งอยู่ในรูปแบบ JSON */
        /* ************************* */
        $headers = $app->request->headers;
        $ContetnType = $app->request->headers->get('Content-Type');

        /**
        * apidoc @apiSampleRequest, iOS RESTKit use content-type is "application/json"
        * Web Form, Advance REST Client App use content-type is "application/x-www-form-urlencoded"
        */

        if (($ContetnType == "application/json") || ($ContetnType == "application/json; charset=utf-8") ) {

            $request = $app->request();
            $result = json_decode($request->getBody());

            /* receive request */
            $postStartDate = $result->startDate;              /* รูปแบบ เดือน/วัน/ปี */
            $postEndDate = $result->endDate;               /* รูปแบบ เดือน/วัน/ปี */
            $postSiteName = $result->siteName;

        } else if (($ContetnType == "application/x-www-form-urlencoded") || ($ContetnType == "application/x-www-form-urlencoded; charset=UTF-8")){


        } 


        $error = $client->getError();
        if ($error) {
            echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
        }

        /* ************************* */
        /* เริ่มกระบวนการเชื่อมต่อ Web Service */
        /* ************************* */

        $result = $client->call('getOperationKPI', array("startDate" => $postStartDate,
                                                         "endDate" => $postEndDate,
                                                         "siteName" => $postSiteName));
        $mydata = json_decode($result["getOperationKPIResult"],true);

        $reports = array();
        // $reports = $mydata;

        /* initial variable Partial */
        $tmpJobNo = "";
        $j = 1;             // id
        $row_excel = 1;
        $headers = array( "JobDate",
                          "JobNo",
                          "VehicleLicence",
                          "VehicleType",
                          "section",
                          "Supervisor",
                          "DriverName",
                          "StartTime",
                          "JobRemark",
                          "jobcost",
                          "cm_call",
                          "DocNo",
                          "DocSeq",
                          "destination",
                          "district",
                          "province",
                          "RouteCode",
                          "size",
                          "amount",
                          "DeliveryDateTime",
                          "SaveDateTime",
                          "UserUpdate",
                          "ReasonCode",
                          "podimage_path",
                          "DocRemark");
        $tmpFirstSentDatetime = "";
        $tmpTimeBetweenStartToFirstEntryPoint = "N/A";
        $tmpMaximumDeliveryDateTime = "";
        $tmpMaximumDeliveryTime = "";
        $tmpTotalTimeDelivery = "";
        $tmpJobCost = "";
        $tmpDropAll = 0;
        $tmpDropSuccess = 0;
        $tmpBillCount = 0;
        $tmpBoxAll = 0;
        $tmpBoxSuccess = 0;
        $tmpBillClosedWithEpodCount = 0;
        $tmpBillClosedAfter6pmCount = 0;
        $percentage_drop = "";
        $percentage_box = "";
        $percentage_epod = "";
        $target_result = "";


        /* ************************* */
        /* เริ่มกระบวนการสร้าง Excel file */
        /* ************************* */

        for ($i=0; $i < count($mydata["array"]); $i++) { 

          if (!$tmpJobNo) {

              $tmpJobNo = $mydata["array"][$i]['JobNo'];
              $tmpJobDate = $mydata["array"][$i]['JobDate'];
              $tmpSection = $mydata["array"][$i]['section'];
              $tmpSupervisor = $mydata["array"][$i]['Supervisor'];
              $tmpVehicleLicence = $mydata["array"][$i]['VehicleLicence'];
              $tmpVehicleType = $mydata["array"][$i]['VehicleType'];
              $tmpDriverName = $mydata["array"][$i]['DriverName'];
              $tmpRouteCode = $mydata["array"][$i]['RouteCode'];
              $tmpFingerScanDateTime = "";
              $tmpStartDateTime = $mydata["array"][$i]['StartTime'];
              $tmpShipoutTime = calculateShipoutTime($tmpStartDateTime, $tmpFingerScanDateTime);
              $tmpDeliveryDateTime = $mydata["array"][$i]['DeliveryDateTime'];
              $tmpFirstSentDatetime = $tmpDeliveryDateTime;
              $tmpMaximumDeliveryDateTime = $tmpDeliveryDateTime;
              $tmpJobCost = $mydata["array"][$i]['jobcost'];
              $tmpAmount = $mydata["array"][$i]['amount'];
              $tmpUserUpdate = $mydata["array"][$i]['UserUpdate'];

              $tmpDocNo = $mydata["array"][$i]['DocNo'];
              if ($tmpDocNo) {
                $tmpBillCount++;
                $tmpDropAll++;
                if ($tmpDeliveryDateTime) {
                    $tmpDropSuccess++;
                }
              }

              if ($tmpAmount) {
                $tmpBoxAll = $tmpBoxAll + $tmpAmount;
                if ($tmpDeliveryDateTime) {
                    $tmpBoxSuccess = $tmpBoxSuccess + $tmpAmount;
                }
              }

              if ($tmpUserUpdate) {
                if (strpos($tmpUserUpdate, 'mb') !== false) {
                  $tmpBillClosedWithEpodCount++;
                }
              }

                            $sheetCount = $objPHPExcel->getSheetCount();
              /* Create Worksheet พร้อมกำหนดชื่อ */
              $objPHPExcel_ITEM_HIS_DF_Worksheet = new \PHPExcel_Worksheet($objPHPExcel, $tmpJobNo);
              $objPHPExcel->addSheet($objPHPExcel_ITEM_HIS_DF_Worksheet, $sheetCount);
              $objPHPExcel_ITEM_HIS_DF_Worksheet->setTitle($tmpJobNo);

              /* กำหนดให้เป็น ActiveWorkSheet */
              // Set active sheet index to the first sheet, so Excel opens this as the first sheet
              $objPHPExcel->setActiveSheetIndex($sheetCount);
              
              for ($k=0; $k < count($headers); $k++) { 
                $col = $k;
                $row = 1;
                $value = $headers[$k];
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
              }
                            $reports[] = array(
                "id" => $j,
                "job_no" => $tmpJobNo,
                "section" => $tmpSection,
                "supervisor" => $tmpSupervisor,
              	"vehicle_licence" => $tmpVehicleLicence,
              	"vehicle_type" => $tmpVehicleType,
              	"driver_name" => $tmpDriverName,
              	"route_code" => $tmpRouteCode,
              	"fingerscan_datetime" => $tmpFingerScanDateTime,
              	"start_datetime" => $tmpStartDateTime,
              	"shipout_time" => $tmpShipoutTime,
              	"first_sent_datetime" => $tmpFirstSentDatetime,
              	"time_between_start_to_first_entry_point" => $tmpTimeBetweenStartToFirstEntryPoint,
                "maximum_delivery_time" => $tmpMaximumDeliveryTime,
                "total_time_delivery" => $tmpTotalTimeDelivery,
                "job_cost" => $tmpJobCost,
                "drop_all" => $tmpDropAll,
                "drop_success" => $tmpDropSuccess,
                "box_all" => $tmpBoxAll,
                "box_success" => $tmpBoxSuccess,
                "bill_count" => $tmpBillCount,
                "bill_closed_with_epod_count" => $tmpBillClosedWithEpodCount,
                "bill_closed_after_6pm_count" => $tmpBillClosedAfter6pmCount,
                "percentage_drop" => "",
                "percentage_box" => "",
                "percentage_epod" => "",
                "target_result" => ""
              );

          } else if ($tmpJobNo != $mydata["array"][$i]['JobNo']) {

              $tmpFirstSentDatetime = "";
              $tmpMaximumDeliveryDateTime = "";
              $tmpMaximumDeliveryTime = "";
              $tmpTotalTimeDelivery = "";
              $tmpJobCost = "";
              $tmpDropAll = 0;
              $tmpDropSuccess = 0;
              $tmpBillCount = 0;
              $tmpBoxAll = 0;
              $tmpBoxSuccess = 0;
              $tmpBillClosedWithEpodCount = 0;
              $tmpBillClosedAfter6pmCount = 0;
              $percentage_drop = "";
              $percentage_box = "";
              $percentage_epod = "";
              $target_result = "";

              $j++;
              $tmpJobNo = $mydata["array"][$i]['JobNo'];
              $tmpJobDate = $mydata["array"][$i]['JobDate'];
              $tmpSection = $mydata["array"][$i]['section'];
              $tmpSupervisor = $mydata["array"][$i]['Supervisor'];
              $tmpVehicleLicence = $mydata["array"][$i]['VehicleLicence'];
              $tmpVehicleType = $mydata["array"][$i]['VehicleType'];
              $tmpDriverName = $mydata["array"][$i]['DriverName'];
              $tmpRouteCode = $mydata["array"][$i]['RouteCode'];
              $tmpFingerScanDateTime = "";
              $tmpStartDateTime = $mydata["array"][$i]['StartTime'];
              $tmpShipoutTime = calculateShipoutTime($tmpStartDateTime, $tmpFingerScanDateTime);
              $tmpDeliveryDateTime = $mydata["array"][$i]['DeliveryDateTime'];
              $tmpFirstSentDatetime = $tmpDeliveryDateTime;
              $tmpMaximumDeliveryDateTime = $tmpDeliveryDateTime;
              $tmpJobCost = $mydata["array"][$i]['jobcost'];
              $tmpAmount = $mydata["array"][$i]['amount'];
              $tmpUserUpdate = $mydata["array"][$i]['UserUpdate'];

              $tmpDocNo = $mydata["array"][$i]['DocNo'];
              if ($tmpDocNo) {
                $tmpBillCount++;
                $tmpDropAll++;
                if ($tmpDeliveryDateTime) {
                    $tmpDropSuccess++;
                }
              }

              if ($tmpAmount) {
                $tmpBoxAll = $tmpBoxAll + $tmpAmount;
                if ($tmpDeliveryDateTime) {
                    $tmpBoxSuccess = $tmpBoxSuccess + $tmpAmount;
                }
              }

              if ($tmpUserUpdate) {
                if (strpos($tmpUserUpdate, 'mb') !== false) {
                  $tmpBillClosedWithEpodCount++;
                }
              }


                            $sheetCount = $objPHPExcel->getSheetCount();
              /* Create Worksheet พร้อมกำหนดชื่อ */
              $objPHPExcel_ITEM_HIS_DF_Worksheet = new \PHPExcel_Worksheet($objPHPExcel, $tmpJobNo);
              $objPHPExcel->addSheet($objPHPExcel_ITEM_HIS_DF_Worksheet, $sheetCount);
              $objPHPExcel_ITEM_HIS_DF_Worksheet->setTitle($tmpJobNo);

              /* กำหนดให้เป็น ActiveWorkSheet */
              // Set active sheet index to the first sheet, so Excel opens this as the first sheet
              $objPHPExcel->setActiveSheetIndex($sheetCount);
                            

              for ($k=0; $k < count($headers); $k++) { 
                $col = $k;
                $row = 1;
                $value = $headers[$k];
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
              }
                            $reports[] = array(
	                  "id" => $j,
	                  "job_no" => $tmpJobNo,
		              "section" => $tmpSection,
		              "supervisor" => $tmpSupervisor,
		              "vehicle_licence" => $tmpVehicleLicence,
		              "vehicle_type" => $tmpVehicleType,
	              	  "driver_name" => $tmpDriverName,
	              	  "route_code" => $tmpRouteCode,
		              "fingerscan_datetime" => $tmpFingerScanDateTime,
		              "start_datetime" => $tmpStartDateTime,
	          		  "shipout_time" => $tmpShipoutTime,
	          		  "first_sent_datetime" => $tmpFirstSentDatetime,
	          		  "time_between_start_to_first_entry_point" => $tmpTimeBetweenStartToFirstEntryPoint,
	          		  "maximum_delivery_time" => $tmpMaximumDeliveryTime,
	            	  "total_time_delivery" => $tmpTotalTimeDelivery,
	            	  "job_cost" => $tmpJobCost,
	            	  "drop_all" => $tmpDropAll,
	            	  "drop_success" => $tmpDropSuccess,
	                  "box_all" => $tmpBoxAll,
                	  "box_success" => $tmpBoxSuccess,
	                  "bill_count" => $tmpBillCount,
	                  "bill_closed_with_epod_count" => $tmpBillClosedWithEpodCount,
	                  "bill_closed_after_6pm_count" => $tmpBillClosedAfter6pmCount,
	                  "percentage_drop" => "",
	                  "percentage_box" => "",
	                  "percentage_epod" => "",
	                  "target_result" => ""
                  );
              $row_excel = 1;
          } else {

                            /* ****************************************** */
              /* เริ่มกระบวนการ คำนวณเวลาส่งจุดแรก (DateTime) */
              /* ****************************************** */
              /* แก้ปัญหากรณี record แรก มีค่า null ทำให้ตัวแปร $tmpFirstSentDatetime ไม่มีค่า */
              if (!$tmpFirstSentDatetime) {
                  $tmpFirstSentDatetime = $mydata["array"][$i]['DeliveryDateTime'];
              }
              $tmpDeliveryDateTime = $mydata["array"][$i]['DeliveryDateTime'];
              if ($tmpDeliveryDateTime) {
                  $tmpFirstSentDatetime = calculateFirstSentDatetime($tmpDeliveryDateTime, $tmpFirstSentDatetime);
                  /* Edit last record */
                  $reports[count($reports)-1]["first_sent_datetime"] = $tmpFirstSentDatetime;
              }
                            /* ********************************** */
              /* เวลาที่เข้าพื้นที่จุดแรก (ชั่วโมง นาที) */
              /* ********************************** */
              $tmpTimeBetweenStartToFirstEntryPoint = calculateTimeBetweenStartToFirstEntryPoint($tmpStartDateTime, $tmpFirstSentDatetime);
              /* Edit last record */
              $reports[count($reports)-1]["time_between_start_to_first_entry_point"] = $tmpTimeBetweenStartToFirstEntryPoint;
                            /* **************************************** */
              /* เวลาส่งจุดสุดท้าย (DateTime) แสดงเฉพาะเวลา */
              /* **************************************** */
              if (!$tmpMaximumDeliveryDateTime) {
                  $tmpMaximumDeliveryDateTime = $mydata["array"][$i]['DeliveryDateTime'];
              }
              $tmpDeliveryDateTime = $mydata["array"][$i]['DeliveryDateTime'];
              if ($tmpDeliveryDateTime) {
                  $tmpMaximumDeliveryDateTime = calculateMaximumDeliveryTime($tmpDeliveryDateTime, $tmpMaximumDeliveryDateTime);
                  $tmpMaximumDelivery = new DateTime($tmpMaximumDeliveryDateTime);
                  $tmpMaximumDeliveryTime = $tmpMaximumDelivery->format('H:i:s');
                  /* Edit last record */
                  $reports[count($reports)-1]["maximum_delivery_time"] = $tmpMaximumDeliveryTime;
              }
                            /* ****************************** */
              /* รวมเวลาที่ใช้จัดส่ง (ชั่วโมง นาที) */
              /* ****************************** */
              $tmpTotalTimeDelivery = calculateTotalTimeDelivery($tmpStartDateTime, $tmpMaximumDeliveryDateTime);
              /* Edit last record */
              $reports[count($reports)-1]["total_time_delivery"] = $tmpTotalTimeDelivery;
                            /* ******************************* */
              /* เริ่มกระบวนการ นับจำนวน Drop All */
              /* ******************************* */
              // if (!$tmpDocNo) {
              //     $tmpDocNo = $mydata["array"][$i]['DocNo'];
              // }

              $tmpDropAll++;
              if ($tmpDeliveryDateTime) {
                $tmpDropSuccess++;
              }

              if ($tmpDocNo != $mydata["array"][$i]['DocNo']) {
                  $tmpBillCount++;

                  $tmpUserUpdate = $mydata["array"][$i]['UserUpdate'];
                  if ($tmpUserUpdate) {
                    if (strpos($tmpUserUpdate, 'mb') !== false) {
                      $tmpBillClosedWithEpodCount++;
                    }
                  }

                $tmpDocNo = $mydata["array"][$i]['DocNo'];
              }
              /* Edit last record */
              $reports[count($reports)-1]["drop_all"] = $tmpDropAll;
              $reports[count($reports)-1]["drop_success"] = $tmpDropSuccess;
              $reports[count($reports)-1]["bill_count"] = $tmpBillCount;
              $reports[count($reports)-1]["bill_closed_with_epod_count"] = $tmpBillClosedWithEpodCount;
                            /* ************************** */
              /* เริ่มกระบวนการ นับจำนวน Box  */
              /* *************************** */
              if ($tmpAmount) {
                $tmpBoxAll = $tmpBoxAll + $tmpAmount;
                if ($tmpDeliveryDateTime) {
                    $tmpBoxSuccess = $tmpBoxSuccess + $tmpAmount;
                }
              }
              /* Edit last record */
              $reports[count($reports)-1]["box_all"] = $tmpBoxAll;
              $reports[count($reports)-1]["box_success"] = $tmpBoxSuccess;



          }

          $row_excel++;

                    for ($k=0; $k < count($headers); $k++) { 
            $col = $k;
            $row = $row_excel;
            $value = $mydata["array"][$i][$headers[$k]];
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
          }

          // $col = 0;
          // $row = $row_excel;
          // $value = $mydata["array"][$i]['JobDate'];
          // $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);

          // $col = 1;
          // $row = $row_excel;
          // $value = $tmpJobNo;
          // $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);

          // $col = 2;
          // $row = $row_excel;
          // $value = $mydata["array"][$i]['VehicleLicence'];
          // $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);

          // $col = 3;
          // $row = $row_excel;
          // $value = $mydata["array"][$i]['DocNo'];
          // $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
        }


        
        $headers_result = array(
            'job_date' => 'วันที่สั่งงาน',
            'job_no' => 'เลขที่ใบสั่งงาน',
            'section' => 'หน่วยงาน',
            'supervisor' => 'หัวหน้าสายงาน',
            'vehicle_licence' => 'ทะเบียนรถ',
            'vehicle_type' => 'ประเภทรถ',
            'driver_name' => 'พนักงานขับรถ',
            'route_code' => 'Route code',
            'fingerscan_datetime' => 'เวลาเข้างาน (DateTime)',
            'start_datetime' => 'เวลาออกศูนย์ (DateTime)',
            'shipout_time' => 'เวลาขึ้นสินค้า (ชั่วโมง นาที)',
            'first_sent_datetime' => 'เวลาส่งจุดแรก (DateTime)',
            'time_between_start_to_first_entry_point' => 'เวลาที่เข้าพื้นที่จุดแรก (ชั่วโมง นาที)',
            'maximum_delivery_time' => 'เวลาส่งจุดสุดท้าย (DateTime)',
            'total_time_delivery' => 'รวมเวลาที่ใช้จัดส่ง (ชั่วโมง นาที)',
            'job_cost' => 'ค่าจ้าง พขร.',
            'drop_all' => 'จำนวน (Drop)',
            'drop_success' => 'ส่งได้ (Drop)',
            '% ส่งได้ (Drop)' => '% ส่งได้ (Drop)',
            'box_all' => 'กล่องทั้งหมด',
            'box_success' => 'ส่งได้ (กล่อง)',
            '% ส่งได้ (กล่อง)' => '% ส่งได้ (กล่อง)',
            'bill_count' => 'จำนวนบิล',
            'bill_closed_with_epod_count' => 'ปิดด้วย E-POD (บิล)',
            '% E-POD' => '% E-POD',
            'bill_closed_after_6pm_count' => 'จำนวนบิลปิดหลัง 18:00 น.',
            'ได้ตาม Target' => 'ได้ตาม Target',
            '-' => '-');

        $m = 0;


        /* กำหนดให้เป็น ActiveWorkSheet */
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        // this cycle echoes all associative array
        // key where value equals "apple"
        while ($header_name = current($headers_result)) {
              
            $col = $m;
            $row = 1;
            $value = $header_name;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);

            $col = $m;
            $row = 2;
            $value = key($headers_result);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);

            $m++;

            next($headers_result);
        }



        $headers_arr= array('id', 'job_no', 'section', 'supervisor', 'vehicle_licence', 'vehicle_type', 'driver_name', 'route_code', 
                            'fingerscan_datetime', 'start_datetime', 'shipout_time', 'first_sent_datetime', 
                            'time_between_start_to_first_entry_point', 'maximum_delivery_time', 'total_time_delivery', 'job_cost',
                            'drop_all', 'drop_success', 'percentage_drop', 'box_all', 'box_success', 'percentage_box', 'bill_count', 'bill_closed_with_epod_count', 'percentage_epod', 'bill_closed_after_6pm_count', 'target_result');



        $start_row = 3;
        for ($i = 0; $i < count($reports); $i++) {

            for ($j = 0; $j < count($headers_arr); $j++) {
                $col = $j;
                $row = $start_row + $i;
                $value = $reports[$i][$headers_arr[$j]];
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
            }

            // $col = 0;
            // $row = $start_row + $i;
            // $value = $reports[$i]["id"];
            // $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);

            // $col = 1;
            // $row = $start_row + $i;
            // $value = $reports[$i]["job_no"];
            // $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);

            // $col = 2;
            // $row = $start_row + $i;
            // $value = $reports[$i]["section"];
            // $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);

            // $col = 3;
            // $row = $start_row + $i;
            // $value = $reports[$i]["supervisor"];
            // $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
            
        }






        /* Set Title */
        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Summary');


                // Set document properties
        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
                                     ->setLastModifiedBy("Maarten Balliauw")
                                     ->setTitle("Office 2007 XLSX Test Document")
                                     ->setSubject("Office 2007 XLSX Test Document")
                                     ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                                     ->setKeywords("office 2007 openxml php")
                                     ->setCategory("Test result file");


        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="01simple.xls"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $date = new DateTime();
        $fileName = 'Operation Performance('.strtoupper($postSiteName).')'.'_'.date("Y-m-d").'_'.$date->getTimestamp().'.xls';
        // $fileName = 'Test.xls';
        $filePath = '../../../files/'.$fileName;
        $objWriter->save($filePath);


        /* ************************* */
        /* เริ่มกระบวนการส่งค่ากลับ */
        /* ************************* */
        $resultText = "success";

        $reportResult = array("result" =>  $resultText,
                              "rows" => $reports,
                              "content-type" => $ContetnType);
        $app->response()->header("Content-Type", "application/json");
        echo json_encode($reportResult);


    };
        /**
     *
     * @apiName BoxOperationKPI
     * @apiGroup KPI Manager
     * @apiVersion 0.1.0
     *
     * @api {post} /kpiManager/boxOperationKPI/ Post API template
     * @apiDescription คำอธิบาย : ในส่วนนี้เป็นเทมเพล็ตสำหรับการสร้าง POST - API Template
     *
     */

    function boxOperationKPI($app, $client, $objPHPExcel) {

        /* ************************* */
        /* เริ่มกระบวนการรับค่าพารามิเตอร์จากส่วนของ Payload ซึ่งอยู่ในรูปแบบ JSON */
        /* ************************* */
        $headers = $app->request->headers;
        $ContetnType = $app->request->headers->get('Content-Type');

        /**
        * apidoc @apiSampleRequest, iOS RESTKit use content-type is "application/json"
        * Web Form, Advance REST Client App use content-type is "application/x-www-form-urlencoded"
        */

        if (($ContetnType == "application/json") || ($ContetnType == "application/json; charset=utf-8") ) {

            $request = $app->request();
            $result = json_decode($request->getBody());

            /* receive request */
            $postStartDate = $result->startDate;              /* รูปแบบ เดือน/วัน/ปี */
            $postEndDate = $result->endDate;               /* รูปแบบ เดือน/วัน/ปี */
            $postSiteName = $result->siteName;

            $app->log->debug(date("Y-m-d H:i:s")." : "."startDate : ".$postStartDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."endDate : ".$postEndDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."siteName : ".$postSiteName);

        } else if (($ContetnType == "application/x-www-form-urlencoded") || ($ContetnType == "application/x-www-form-urlencoded; charset=UTF-8")){


        } 


        $error = $client->getError();
        if ($error) {
            echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
        }

        /* ************************* */
        /* เริ่มกระบวนการเชื่อมต่อ Web Service */
        /* ************************* */

        // $postStartDate = "06/16/2016";              /* รูปแบบ เดือน/วัน/ปี */
        // $postEndDate = "06/16/2016";               /* รูปแบบ เดือน/วัน/ปี */
        // $postSiteName = "bc";
        
        $result = $client->call('getOperationKPI', array("startDate" => $postStartDate,
                                                         "endDate" => $postEndDate,
                                                         "siteName" => $postSiteName));
        $mydata = json_decode($result["getOperationKPIResult"],true);


        /* initial variable Partial */
        $header_results = array();
        $data_results = array();

        $tmpJobDate = "";
        $tmpVehicleLicence = "";
        $tmpAmount = "";
        

        /* ************************* */
        /* เริ่มกระบวนการสร้าง Excel file */
        /* ************************* */

         /* header result */
        $header_results[0] = "Box";

        // for ($i=0; $i < count($mydata["array"]); $i++) { 

        //     if (!$tmpJobDate) {
        //         $tmpJobDate = $mydata["array"][$i]['JobDate'];
        //         $tmpVehicleLicence = $mydata["array"][$i]['VehicleLicence'];
        //         array_push($header_results, date_format(date_create($tmpJobDate),"d/m/Y"));

        //     } else if ($tmpJobDate != $mydata["array"][$i]['JobDate']) {
        //         $tmpJobDate = "";
        //         $tmpJobDate = $mydata["array"][$i]['JobDate'];
        //         array_push($header_results, date_format(date_create($tmpJobDate),"d/m/Y"));

        //     } else {

        //         $tmpJobDate = $mydata["array"][$i]['JobDate'];
        //     }
        // }



        // $period = createDateRangeArray('2016-06-16', '2016-06-21');
        // MM/DD/YYYY
        $periodStartDate = substr($postStartDate,3,2);
        $periodStartMonth = substr($postStartDate,0,2);
        $periodStartYear = substr($postStartDate,6,4);
        $startDatePeriod = $periodStartYear."-".$periodStartMonth."-".$periodStartDate;

        $periodEndDate = substr($postEndDate,3,2);
        $periodEndMonth = substr($postEndDate,0,2);
        $periodEndYear = substr($postEndDate,6,4);
        $endDatePeriod = $periodEndYear."-".$periodEndMonth."-".$periodEndDate;

        $period = createDateRangeArray($startDatePeriod, $endDatePeriod);

        for ($i=0; $i < count($period); $i++) { 
            $tmpDate = substr($period[$i],8,2);
            $tmpMonth = substr($period[$i],5,2);
            $tmpYear = substr($period[$i],0,4);
            $tmpDateFormat = $tmpDate."/".$tmpMonth."/".$tmpYear;
            array_push($header_results, $tmpDateFormat);
        }

        $header_results[count($header_results)] = "Average";


        // $header_results = array("Box","16/06/2016","17/06/2016","18/06/2016","19/06/2016","20/06/2016","21/06/2016","Average");


        /* initial variable Partial */
        $tmpJobDate = "";
        $tmpVehicleLicence = "";
        $tmpVehicleLicenceArr = array();
        $tmpSumAmountOfDay = 0;
        $headerArrIndex = false;
        $tmpAmount = "";




        /* data result */
        foreach ($mydata["array"] as $key => $row) {
            $wek[$key]  = $row['VehicleLicence'];
        }
        array_multisort($wek, SORT_ASC, $mydata["array"]);


        for ($j=0; $j < count($mydata["array"]); $j++) { 

            if (!$tmpVehicleLicence) {

                // foreach($header_results as $key => $value) {
                //     $tmpVehicleLicenceArr[$key] = 0;
                // }
                $tmpVehicleLicenceArr = array_fill(0, count($header_results), 0);

                $tmpJobDate = $mydata["array"][$j]['JobDate'];
                $tmpVehicleLicence = $mydata["array"][$j]['VehicleLicence'];
                $tmpAmount = $mydata["array"][$j]['amount'];

                // array_push($tmpVehicleLicenceArr, $tmpVehicleLicence);
                // array_push($tmpVehicleLicenceArr, $tmpAmount);
                $tmpVehicleLicenceArr[0] = $tmpVehicleLicence;
                // $tmpVehicleLicenceArr[1] = $tmpAmount;

                $tmpJD = date_format(date_create($tmpJobDate),"d/m/Y");
                $headerArrIndex = array_search($tmpJD,$header_results);
                if ($headerArrIndex) {
                   $tmpVehicleLicenceArr[$headerArrIndex] = $tmpAmount;
                }
                


                // array_push($data_results, $tmpVehicleLicenceArr);
                $data_results[count($data_results)] = $tmpVehicleLicenceArr;

                $myfile = fopen("debugText.txt", "a") or die("Unable to open file!");
                $strText1 = "########################################################"."\r\n";
                fwrite($myfile, $strText1);
                $strText2 = ($j+1).") ทะเบียนรถ : ".$tmpVehicleLicence."วันที่".$tmpJobDate .", amount : ".$tmpAmount."\r\n";
                fwrite($myfile, $strText2);
                fclose($myfile);

            } else if ($tmpVehicleLicence != $mydata["array"][$j]['VehicleLicence']) {

                $tmpJobDate = "";
                $tmpVehicleLicence = "";
                $tmpVehicleLicenceArr = array();
                $tmpSumAmountOfDay = 0;
                $headerArrIndex = false;
                $tmpAmount = "";

                // foreach($header_results as $key => $value) {
                //     $tmpVehicleLicenceArr[$key] = 0;
                // }
                $tmpVehicleLicenceArr = array_fill(0, count($header_results), 0);

                $tmpJobDate = $mydata["array"][$j]['JobDate'];
                $tmpVehicleLicence = $mydata["array"][$j]['VehicleLicence'];
                $tmpAmount = $mydata["array"][$j]['amount'];

                // array_push($tmpVehicleLicenceArr, $tmpVehicleLicence);
                // array_push($tmpVehicleLicenceArr, $tmpAmount);
                $tmpVehicleLicenceArr[0] = $tmpVehicleLicence;

                
                $tmpJD = date_format(date_create($tmpJobDate),"d/m/Y");
                $headerArrIndex = array_search($tmpJD,$header_results);
                if ($headerArrIndex) {
                   $tmpVehicleLicenceArr[$headerArrIndex] = $tmpAmount;
                }

                // array_push($data_results, $tmpVehicleLicenceArr);
                $data_results[count($data_results)] = $tmpVehicleLicenceArr;


                $myfile = fopen("debugText.txt", "a") or die("Unable to open file!");
                $strText1 = "########################################################"."\r\n";
                fwrite($myfile, $strText1);
                $strText2 = ($j+1).") ทะเบียนรถ : ".$tmpVehicleLicence."วันที่".$tmpJobDate .", amount : ".$tmpAmount."\r\n";
                fwrite($myfile, $strText2);
                fclose($myfile);

            } else {

                        // $headerArrIndex = 0;
                        // $dataArrIndex = 0;

                        $tmpVehicleLicence = $mydata["array"][$j]['VehicleLicence'];
                        $tmpJobDate = $mydata["array"][$j]['JobDate'];
                        $tmpAmount = $mydata["array"][$j]['amount'];


                        // if ($tmpVehicleLicence == "อ-5257") {
                            $tmpJD = date_format(date_create($tmpJobDate),"d/m/Y");
                            $headerArrIndex = array_search($tmpJD,$header_results);

                            // $dataArrIndex = array_search($tmpVehicleLicence,$data_results);
                            $dataArrIndex = array_find_deep($data_results,$tmpVehicleLicence);

                            
                            $tmpExistArr = array();
                            $tmpNewArr = array();
                            // $tmpValue = 0;

                            $tmpExistArr = $data_results[$dataArrIndex];
                            $tmpValue = $tmpExistArr[$headerArrIndex];
                            // $tmpArr[$headerArrIndex] = $dataArrIndex.",".$headerArrIndex;
                            $tmpNewArr = $tmpExistArr;
                            $tmpNewArr[$headerArrIndex] = (int)$tmpValue + (int)$tmpAmount;
                            $data_results[$dataArrIndex] = $tmpNewArr;

                            $myfile = fopen("debugText.txt", "a") or die("Unable to open file!");
                            // $strText1 = $j.") ทะเบียนรถ : ".$tmpVehicleLicence."วันที่".$tmpJD .", Existing amount : ".$tmpValue.", New amount : ".$tmpAmount.", Total : ".$tmpArr[$headerArrIndex].", header index : ".$headerArrIndex."\r\n";
                            $strText1 = $j.") ทะเบียนรถ : ".$tmpVehicleLicence."วันที่".$tmpJobDate .", amount : ".$tmpAmount.", dataArrIndex : ".$dataArrIndex."\r\n";
                            fwrite($myfile, $strText1);
                            fclose($myfile);
                        // }
                    
            }

        }


        for ($j=0; $j < count($mydata["array"]); $j++) { 

            $tmpVehicleLicence = $mydata["array"][$j]['VehicleLicence'];
            $tmpJobDate = $mydata["array"][$j]['JobDate'];
            $tmpAmount = $mydata["array"][$j]['amount'];

            $col = 0;
            $row = $j+1;
            $value = $tmpVehicleLicence;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);

            $col = 1;
            $row = $j+1;
            $value = $tmpJobDate;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);

            $col = 2;
            $row = $j+1;
            $value = $tmpAmount;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);

            $col = 3;
            $row = $j+1;
            $tmpJD = date_format(date_create($tmpJobDate),"d/m/Y");
            $value = $tmpJD;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);

            $col = 4;
            $row = $j+1;
            // $tmpJD = "16/06/2016";
            $value = array_search($tmpJD,$header_results);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);

            $col = 5;
            $row = $j+1;
            // $tmpJD = "16/06/2016";
            // $value = array_search($tmpVehicleLicence,$data_results[0]);
            $value = array_find_deep($data_results,$tmpVehicleLicence);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
        }


        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
                                     ->setLastModifiedBy("Maarten Balliauw")
                                     ->setTitle("Office 2007 XLSX Test Document")
                                     ->setSubject("Office 2007 XLSX Test Document")
                                     ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                                     ->setKeywords("office 2007 openxml php")
                                     ->setCategory("Test result file");


        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="01simple.xls"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $date = new DateTime();
        // $fileName = 'Quickload_for_MODBUS('.$paramFastToolsDestination.')'.'_'.date("Y-m-d").'_'.$date->getTimestamp().'.xls';
        $fileName = 'Test.xls';
        $filePath = '../../../files/'.$fileName;
        $objWriter->save($filePath);


        /* ************************* */
        /* เริ่มกระบวนการส่งค่ากลับ */
        /* ************************* */


        // $header_results = array("Box", "06/06/2016", "06/07/2016", "06/08/2016", "06/09/2016", "06/10/2016", "Average");

        // $data_results[] = array("กค-3395", "20", "34", "16", "45", "45", "45");
        // $data_results[] = array("กค-3396", "21", "35", "17", "46", "45", "45");

        // $app->log->debug('Request path: ' . $request->getPathInfo());
        // $app->log->debug('Response status: ' . $response->getStatus());
        

        $reportResult = array("columns" =>  $header_results, 
                              "rows" => $data_results,
                              "filename" => $fileName,
                              "path" => url()."/iel-mis/build/files/".$fileName);
        $app->response()->header("Content-Type", "application/json");
        echo json_encode($reportResult);

    };
        /**
     *
     * @apiName GetOperationKpiSummary
     * @apiGroup KPI Manager
     * @apiVersion 0.1.0
     *
     * @api {post} /kpiManager/getOperationKpiSummary/ Get Operation KPI Summary
     * @apiDescription คำอธิบาย : ในส่วนนี้ทำหน้าที่เรียกข้อมูลสรุปเกี่ยวกับ Operation KPI มาใช้งาน ตามศูนย์และช่วงเวลาที่กำหนด
     *
     */

    function getOperationKpiSummary($app, $client) {


        /* ************************* */
        /* เริ่มกระบวนการรับค่าพารามิเตอร์จากส่วนของ Payload ซึ่งอยู่ในรูปแบบ JSON */
        /* ************************* */
        $headers = $app->request->headers;
        $ContetnType = $app->request->headers->get('Content-Type');

        /**
        * apidoc @apiSampleRequest, iOS RESTKit use content-type is "application/json"
        * Web Form, Advance REST Client App use content-type is "application/x-www-form-urlencoded"
        */

        if (($ContetnType == "application/json") || ($ContetnType == "application/json; charset=utf-8") ) {

            $request = $app->request();
            $result = json_decode($request->getBody());

            /* receive request */
            $postStartDate = $result->startDate;              /* รูปแบบ เดือน/วัน/ปี */
            $postEndDate = $result->endDate;               /* รูปแบบ เดือน/วัน/ปี */
            $postSiteName = $result->siteName;

            $app->log->debug(date("Y-m-d H:i:s")." : "."startDate : ".$postStartDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."endDate : ".$postEndDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."siteName : ".$postSiteName);

        } else if (($ContetnType == "application/x-www-form-urlencoded") || ($ContetnType == "application/x-www-form-urlencoded; charset=UTF-8")){

            /* receive request */                                                                                 
            $postStartDate = $app->request()->post('startDate');    /* รูปแบบ เดือน/วัน/ปี */
            $postEndDate = $app->request()->post('endDate');        /* รูปแบบ เดือน/วัน/ปี */
            $postSiteName = $app->request()->post('siteName');

            $app->log->debug(date("Y-m-d H:i:s")." : "."startDate : ".$postStartDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."endDate : ".$postEndDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."siteName : ".$postSiteName);
        } 



        // $postStartDate = "2016-07-24";    /* รูปแบบ เดือน/วัน/ปี */
        // $postEndDate = "2016-07-30";        /* รูปแบบ เดือน/วัน/ปี */
        // $postSiteName = "29";



            /*  Partial : Localhost */
                    // // copy file content into a string var
        // $json_file = file_get_contents('./KpiManager/getOperationKPI.json');
        // // convert the string to a json object
        // $reportResult = json_decode($json_file);


        $error = $client->getError();
        if ($error) {
            echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
        }

        /* ************************* */
        /* เริ่มกระบวนการเชื่อมต่อ Web Service */
        /* ************************* */

        $result = $client->call('MISObj_R0001Presentation_Model3', array("dateStart" => $postStartDate,
                                                         				   "dateEnd" => $postEndDate,
                                                         				   "intSite" => $postSiteName));
        $reportResult = json_decode($result["MISObj_R0001Presentation_Model3Result"],true);










        /* ************************* */
        /* เริ่มกระบวนการส่งค่ากลับ */
        /* ************************* */
        // $reportResult = array("msg" => "สวัสดี");

 
        $app->response()->header("Content-Type", "application/json");
        echo json_encode($reportResult);


    };
        /**
     *
     * @apiName GetOperationKpiSummaryInfo
     * @apiGroup KPI Manager
     * @apiVersion 0.1.0
     *
     * @api {post} /kpiManager/getOperationKpiSummaryInfo/ Post Operation KPI Summary
     * @apiDescription คำอธิบาย : ในส่วนนี้ทำหน้าที่เรียกข้อมูลสรุปเกี่ยวกับ Operation KPI มาใช้งาน ตามศูนย์และช่วงเวลาที่กำหนด
     *
     */

    function getOperationKpiSummaryInfo($app, $client) {


        /* ************************* */
        /* เริ่มกระบวนการรับค่าพารามิเตอร์จากส่วนของ Payload ซึ่งอยู่ในรูปแบบ JSON */
        /* ************************* */
        $headers = $app->request->headers;
        $ContetnType = $app->request->headers->get('Content-Type');

        $app->log->debug(date("Y-m-d H:i:s")." : "."ContetnType : ".$ContetnType);

        /**
        * apidoc @apiSampleRequest, iOS RESTKit use content-type is "application/json"
        * Web Form, Advance REST Client App use content-type is "application/x-www-form-urlencoded"
        */

        if (($ContetnType == "application/json") || ($ContetnType == "application/json; charset=utf-8") ) {
                      
            $request = $app->request();
            $result = json_decode($request->getBody());

            /* receive request */
            $postStartDate = $result->startDate;              /* รูปแบบ เดือน/วัน/ปี */
            $postEndDate = $result->endDate;               /* รูปแบบ เดือน/วัน/ปี */
            $postSiteName = $result->siteName;

            $app->log->debug(date("Y-m-d H:i:s")." : "."startDate : ".$postStartDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."endDate : ".$postEndDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."siteName : ".$postSiteName);

        } else if (($ContetnType == "application/x-www-form-urlencoded") || ($ContetnType == "application/x-www-form-urlencoded; charset=UTF-8")){
            
            /* receive request */                                                                                 
            $postStartDate = $app->request()->post('startDate');    /* รูปแบบ เดือน/วัน/ปี */
            $postEndDate = $app->request()->post('endDate');        /* รูปแบบ เดือน/วัน/ปี */
            $postSiteName = $app->request()->post('siteName');

            $app->log->debug(date("Y-m-d H:i:s")." : "."startDate : ".$postStartDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."endDate : ".$postEndDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."siteName : ".$postSiteName);
        } 







        /* ************************* */
        /* เริ่มกระบวนการส่งค่ากลับ */
        /* ************************* */
        $reportResult = array("msg" => "สวัสดี");

 
        $app->response()->header("Content-Type", "application/json");
        echo json_encode($reportResult);


    };
        /**
     *
     * @apiName GetOperationKpiSummaryInfoByWeekly
     * @apiGroup KPI Manager
     * @apiVersion 0.1.0
     *
     * @api {post} /kpiManager/getOperationKpiSummaryInfoByWeekly/ Post Operation KPI Summary By Weekly
     * @apiDescription คำอธิบาย : ในส่วนนี้ทำหน้าที่เรียกข้อมูลสรุปเกี่ยวกับ Operation KPI มาใช้งาน ตามศูนย์และช่วงเวลาที่กำหนด (แสดงผลในลักษณะ Week)
     *
     */

    function getOperationKpiSummaryInfoByWeekly($app, $client) {


        /* ************************* */
        /* เริ่มกระบวนการรับค่าพารามิเตอร์จากส่วนของ Payload ซึ่งอยู่ในรูปแบบ JSON */
        /* ************************* */
        $headers = $app->request->headers;
        $ContetnType = $app->request->headers->get('Content-Type');

        $app->log->debug(date("Y-m-d H:i:s")." : "."ContetnType : ".$ContetnType);

        /**
        * apidoc @apiSampleRequest, iOS RESTKit use content-type is "application/json"
        * Web Form, Advance REST Client App use content-type is "application/x-www-form-urlencoded"
        */

        if (($ContetnType == "application/json") || ($ContetnType == "application/json; charset=utf-8") ) {
                      
            $request = $app->request();
            $result = json_decode($request->getBody());

            /* receive request */
            $postStartDate = $result->startDate;              /* รูปแบบ เดือน/วัน/ปี */
            $postEndDate = $result->endDate;               /* รูปแบบ เดือน/วัน/ปี */
            $postSiteID = $result->siteID;

            $app->log->debug(date("Y-m-d H:i:s")." : "."startDate : ".$postStartDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."endDate : ".$postEndDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."siteName : ".$postSiteID);

        } else if (($ContetnType == "application/x-www-form-urlencoded") || ($ContetnType == "application/x-www-form-urlencoded; charset=UTF-8")){
            
            /* receive request */                                                                                 
            $postStartDate = $app->request()->post('startDate');    /* รูปแบบ เดือน/วัน/ปี */
            $postEndDate = $app->request()->post('endDate');        /* รูปแบบ เดือน/วัน/ปี */
            $postSiteID = $app->request()->post('siteID');

            $app->log->debug(date("Y-m-d H:i:s")." : "."startDate : ".$postStartDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."endDate : ".$postEndDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."siteName : ".$postSiteID);
        } 




            /*  Partial : Localhost */
                    // // copy file content into a string var
        // $json_file = file_get_contents('./KpiManager/getOperationKPI.json');
        // // convert the string to a json object
        // $reportResult = json_decode($json_file);


        $error = $client->getError();
        if ($error) {
            echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
        }

        /* ************************* */
        /* เริ่มกระบวนการเชื่อมต่อ Web Service */
        /* ************************* */

        $result = $client->call('MISObj_R0001Presentation_Model4', array("dateStart" => $postStartDate,
                                                         				   "dateEnd" => $postEndDate,
                                                         				   "intSite" => $postSiteID));
        $reportResult = json_decode($result["MISObj_R0001Presentation_Model4Result"],true);








        /* ************************* */
        /* เริ่มกระบวนการส่งค่ากลับ */
        /* ************************* */
        // $reportResult = array("msg" => "สวัสดี");

 
        $app->response()->header("Content-Type", "application/json");
        echo json_encode($reportResult);



    };



    /* Vehicle - KPI Manager Partial */
        /**
     *
     * @apiName GetVehicleKpiByDaily
     * @apiGroup KPI Manager
     * @apiVersion 0.1.0
     *
     * @api {post} /kpiManager/getVehicleKpiByDaily/ Get Vehicle KPI By Daily
     * @apiDescription คำอธิบาย : ในส่วนนี้ทำหน้าที่เรียกข้อมูล KPI ของรถ แสดงผลแบบรายวัน ตามช่วงวันที่กำหนด
     *
     */

    function getVehicleKpiByDaily($app, $client_mis) {


        /* ************************* */
        /* เริ่มกระบวนการรับค่าพารามิเตอร์จากส่วนของ Payload ซึ่งอยู่ในรูปแบบ JSON */
        /* ************************* */
        $headers = $app->request->headers;
        $ContetnType = $app->request->headers->get('Content-Type');

        /**
        * apidoc @apiSampleRequest, iOS RESTKit use content-type is "application/json"
        * Web Form, Advance REST Client App use content-type is "application/x-www-form-urlencoded"
        */

        if (($ContetnType == "application/json") || ($ContetnType == "application/json; charset=utf-8") ) {

            $request = $app->request();
            $result = json_decode($request->getBody());

            /* receive request */
            $postStartDate = $result->startDate;              /* รูปแบบ เดือน/วัน/ปี */
            $postEndDate = $result->endDate;               /* รูปแบบ เดือน/วัน/ปี */
            $postSiteName = $result->siteName;

            $app->log->debug(date("Y-m-d H:i:s")." : "."startDate : ".$postStartDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."endDate : ".$postEndDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."siteName : ".$postSiteName);

        } else if (($ContetnType == "application/x-www-form-urlencoded") || ($ContetnType == "application/x-www-form-urlencoded; charset=UTF-8")){

            /* receive request */                                                                                 
            $postStartDate = $app->request()->post('startDate');    /* รูปแบบ เดือน/วัน/ปี */
            $postEndDate = $app->request()->post('endDate');        /* รูปแบบ เดือน/วัน/ปี */
            $postSiteName = $app->request()->post('siteName');

            $app->log->debug(date("Y-m-d H:i:s")." : "."startDate : ".$postStartDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."endDate : ".$postEndDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."siteName : ".$postSiteName);
        } 



        // $postStartDate = "2016-07-24";    /* รูปแบบ เดือน/วัน/ปี */
        // $postEndDate = "2016-07-30";        /* รูปแบบ เดือน/วัน/ปี */
        // $postSiteName = "29";



            /*  Partial : Localhost */
                    // // copy file content into a string var
        // $json_file = file_get_contents('./KpiManager/getOperationKPI.json');
        // // convert the string to a json object
        // $reportResult = json_decode($json_file);


        $error = $client_mis->getError();
        if ($error) {
            echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
        }

        /* ************************* */
        /* เริ่มกระบวนการเชื่อมต่อ Web Service */
        /* ************************* */

        $result = $client_mis->call('MISObj_R0001Presentation_Model3', array("dateStart" => $postStartDate,
                                                         				                       "dateEnd" => $postEndDate,
                                                         				                       "intSite" => $postSiteName));
        $reportResult = json_decode($result["MISObj_R0001Presentation_Model3Result"],true);










        /* ************************* */
        /* เริ่มกระบวนการส่งค่ากลับ */
        /* ************************* */
        // $reportResult = array("msg" => "สวัสดี");

 
        $app->response()->header("Content-Type", "application/json");
        echo json_encode($reportResult);


    };
        /**
     *
     * @apiName GetVehicleKpiByWeekly
     * @apiGroup KPI Manager
     * @apiVersion 0.1.0
     *
     * @api {post} /kpiManager/getVehicleKpiByWeekly/ Get Vehicle KPI By Weekly
     * @apiDescription คำอธิบาย : ในส่วนนี้ทำหน้าที่เรียกข้อมูล KPI ของรถ แสดงผลแบบรายสัปดาห์ ตามช่วงวันที่กำหนด
     *
     */

    function getVehicleKpiByWeekly($app, $client_mis) {


        /* ************************* */
        /* เริ่มกระบวนการรับค่าพารามิเตอร์จากส่วนของ Payload ซึ่งอยู่ในรูปแบบ JSON */
        /* ************************* */
        $headers = $app->request->headers;
        $ContetnType = $app->request->headers->get('Content-Type');

        /**
        * apidoc @apiSampleRequest, iOS RESTKit use content-type is "application/json"
        * Web Form, Advance REST Client App use content-type is "application/x-www-form-urlencoded"
        */

        if (($ContetnType == "application/json") || ($ContetnType == "application/json; charset=utf-8") ) {

            $request = $app->request();
            $result = json_decode($request->getBody());

            /* receive request */
            $postStartDate = $result->startDate;              /* รูปแบบ เดือน/วัน/ปี */
            $postEndDate = $result->endDate;               /* รูปแบบ เดือน/วัน/ปี */
            $postSiteName = $result->siteName;

            $app->log->debug(date("Y-m-d H:i:s")." : "."startDate : ".$postStartDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."endDate : ".$postEndDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."siteName : ".$postSiteName);

        } else if (($ContetnType == "application/x-www-form-urlencoded") || ($ContetnType == "application/x-www-form-urlencoded; charset=UTF-8")){

            /* receive request */                                                                                 
            $postStartDate = $app->request()->post('startDate');    /* รูปแบบ เดือน/วัน/ปี */
            $postEndDate = $app->request()->post('endDate');        /* รูปแบบ เดือน/วัน/ปี */
            $postSiteName = $app->request()->post('siteName');

            $app->log->debug(date("Y-m-d H:i:s")." : "."startDate : ".$postStartDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."endDate : ".$postEndDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."siteName : ".$postSiteName);
        } 



        // $postStartDate = "2016-07-24";    /* รูปแบบ เดือน/วัน/ปี */
        // $postEndDate = "2016-07-30";        /* รูปแบบ เดือน/วัน/ปี */
        // $postSiteName = "29";



            /*  Partial : Localhost */
                    // // copy file content into a string var
        // $json_file = file_get_contents('./KpiManager/getOperationKPI.json');
        // // convert the string to a json object
        // $reportResult = json_decode($json_file);


        $error = $client_mis->getError();
        if ($error) {
            echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
        }

        /* ************************* */
        /* เริ่มกระบวนการเชื่อมต่อ Web Service */
        /* ************************* */

        $result = $client_mis->call('MISObj_R0001Presentation_Model4', array("dateStart" => $postStartDate,
                                                         				                       "dateEnd" => $postEndDate,
                                                         				                       "intSite" => $postSiteName));
        $reportResult = json_decode($result["MISObj_R0001Presentation_Model4Result"],true);










        /* ************************* */
        /* เริ่มกระบวนการส่งค่ากลับ */
        /* ************************* */
        // $reportResult = array("msg" => "สวัสดี");

 
        $app->response()->header("Content-Type", "application/json");
        echo json_encode($reportResult);


    };
        /**
     *
     * @apiName GetVehicleKpiByMonthly
     * @apiGroup KPI Manager
     * @apiVersion 0.1.0
     *
     * @api {post} /kpiManager/getVehicleKpiByMonthly/ Get Vehicle KPI By Monthly
     * @apiDescription คำอธิบาย : ในส่วนนี้ทำหน้าที่เรียกข้อมูล KPI ของรถ แสดงผลแบบรายเดือน ตามช่วงวันที่กำหนด
     *
     */

    function getVehicleKpiByMonthly($app, $client_mis) {


        /* ************************* */
        /* เริ่มกระบวนการรับค่าพารามิเตอร์จากส่วนของ Payload ซึ่งอยู่ในรูปแบบ JSON */
        /* ************************* */
        $headers = $app->request->headers;
        $ContetnType = $app->request->headers->get('Content-Type');

        /**
        * apidoc @apiSampleRequest, iOS RESTKit use content-type is "application/json"
        * Web Form, Advance REST Client App use content-type is "application/x-www-form-urlencoded"
        */

        if (($ContetnType == "application/json") || ($ContetnType == "application/json; charset=utf-8") ) {

            $request = $app->request();
            $result = json_decode($request->getBody());

            /* receive request */
            $postStartDate = $result->startDate;              /* รูปแบบ เดือน/วัน/ปี */
            $postEndDate = $result->endDate;               /* รูปแบบ เดือน/วัน/ปี */
            $postSiteName = $result->siteName;

            $app->log->debug(date("Y-m-d H:i:s")." : "."startDate : ".$postStartDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."endDate : ".$postEndDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."siteName : ".$postSiteName);

        } else if (($ContetnType == "application/x-www-form-urlencoded") || ($ContetnType == "application/x-www-form-urlencoded; charset=UTF-8")){

            /* receive request */                                                                                 
            $postStartDate = $app->request()->post('startDate');    /* รูปแบบ เดือน/วัน/ปี */
            $postEndDate = $app->request()->post('endDate');        /* รูปแบบ เดือน/วัน/ปี */
            $postSiteName = $app->request()->post('siteName');

            $app->log->debug(date("Y-m-d H:i:s")." : "."startDate : ".$postStartDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."endDate : ".$postEndDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."siteName : ".$postSiteName);
        } 



        // $postStartDate = "2016-07-24";    /* รูปแบบ เดือน/วัน/ปี */
        // $postEndDate = "2016-07-30";        /* รูปแบบ เดือน/วัน/ปี */
        // $postSiteName = "29";



            /*  Partial : Localhost */
                    // // copy file content into a string var
        // $json_file = file_get_contents('./KpiManager/getOperationKPI.json');
        // // convert the string to a json object
        // $reportResult = json_decode($json_file);


        $error = $client_mis->getError();
        if ($error) {
            echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
        }

        /* ************************* */
        /* เริ่มกระบวนการเชื่อมต่อ Web Service */
        /* ************************* */

        $result = $client_mis->call('MISObj_MonthlyOperationPerformanceKPIReport', array("dateStart" => $postStartDate,
                                                         				                       "dateEnd" => $postEndDate,
                                                         				                       "intSite" => $postSiteName));
        $reportResult = json_decode($result["MISObj_MonthlyOperationPerformanceKPIReportResult"],true);










        /* ************************* */
        /* เริ่มกระบวนการส่งค่ากลับ */
        /* ************************* */
        // $reportResult = array("msg" => "สวัสดี");

 
        $app->response()->header("Content-Type", "application/json");
        echo json_encode($reportResult);


    };
        /**
     *
     * @apiName GetVehicleKpiByQuarterly
     * @apiGroup KPI Manager
     * @apiVersion 0.1.0
     *
     * @api {post} /kpiManager/getVehicleKpiByQuarterly/ Get Vehicle KPI By Quarterly
     * @apiDescription คำอธิบาย : ในส่วนนี้ทำหน้าที่เรียกข้อมูล KPI ของรถ แสดงผลแบบราย Quarter ตามช่วงวันที่กำหนด
     *
     */

    function getVehicleKpiByQuarterly($app, $client_mis) {


        /* ************************* */
        /* เริ่มกระบวนการรับค่าพารามิเตอร์จากส่วนของ Payload ซึ่งอยู่ในรูปแบบ JSON */
        /* ************************* */
        $headers = $app->request->headers;
        $ContetnType = $app->request->headers->get('Content-Type');

        /**
        * apidoc @apiSampleRequest, iOS RESTKit use content-type is "application/json"
        * Web Form, Advance REST Client App use content-type is "application/x-www-form-urlencoded"
        */

        if (($ContetnType == "application/json") || ($ContetnType == "application/json; charset=utf-8") ) {

            $request = $app->request();
            $result = json_decode($request->getBody());

            /* receive request */
            $postStartDate = $result->startDate;              /* รูปแบบ เดือน/วัน/ปี */
            $postEndDate = $result->endDate;               /* รูปแบบ เดือน/วัน/ปี */
            $postSiteName = $result->siteName;

            $app->log->debug(date("Y-m-d H:i:s")." : "."startDate : ".$postStartDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."endDate : ".$postEndDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."siteName : ".$postSiteName);

        } else if (($ContetnType == "application/x-www-form-urlencoded") || ($ContetnType == "application/x-www-form-urlencoded; charset=UTF-8")){

            /* receive request */                                                                                 
            $postStartDate = $app->request()->post('startDate');    /* รูปแบบ เดือน/วัน/ปี */
            $postEndDate = $app->request()->post('endDate');        /* รูปแบบ เดือน/วัน/ปี */
            $postSiteName = $app->request()->post('siteName');

            $app->log->debug(date("Y-m-d H:i:s")." : "."startDate : ".$postStartDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."endDate : ".$postEndDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."siteName : ".$postSiteName);
        } 



        // $postStartDate = "2016-07-24";    /* รูปแบบ เดือน/วัน/ปี */
        // $postEndDate = "2016-07-30";        /* รูปแบบ เดือน/วัน/ปี */
        // $postSiteName = "29";



            /*  Partial : Localhost */
                    // // copy file content into a string var
        // $json_file = file_get_contents('./KpiManager/getOperationKPI.json');
        // // convert the string to a json object
        // $reportResult = json_decode($json_file);


        $error = $client_mis->getError();
        if ($error) {
            echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
        }

        /* ************************* */
        /* เริ่มกระบวนการเชื่อมต่อ Web Service */
        /* ************************* */

        $result = $client_mis->call('MISObj_QuarterOperationPerformanceKPIReport', array("dateStart" => $postStartDate,
                                                         				                       "dateEnd" => $postEndDate,
                                                         				                       "intSite" => $postSiteName));
        $reportResult = json_decode($result["MISObj_QuarterOperationPerformanceKPIReportResult"],true);










        /* ************************* */
        /* เริ่มกระบวนการส่งค่ากลับ */
        /* ************************* */
        // $reportResult = array("msg" => "สวัสดี");

 
        $app->response()->header("Content-Type", "application/json");
        echo json_encode($reportResult);


    };
        /**
     *
     * @apiName GetVehicleKpiByHalfYear
     * @apiGroup KPI Manager
     * @apiVersion 0.1.0
     *
     * @api {post} /kpiManager/getVehicleKpiByHalfYear/ Get Vehicle KPI By HalfYear
     * @apiDescription คำอธิบาย : ในส่วนนี้ทำหน้าที่เรียกข้อมูล KPI ของรถ แสดงผลแบบรายครึ่งปี ตามช่วงวันที่กำหนด
     *
     */

    function getVehicleKpiByHalfYear($app, $client_mis) {


        /* ************************* */
        /* เริ่มกระบวนการรับค่าพารามิเตอร์จากส่วนของ Payload ซึ่งอยู่ในรูปแบบ JSON */
        /* ************************* */
        $headers = $app->request->headers;
        $ContetnType = $app->request->headers->get('Content-Type');

        /**
        * apidoc @apiSampleRequest, iOS RESTKit use content-type is "application/json"
        * Web Form, Advance REST Client App use content-type is "application/x-www-form-urlencoded"
        */

        if (($ContetnType == "application/json") || ($ContetnType == "application/json; charset=utf-8") ) {

            $request = $app->request();
            $result = json_decode($request->getBody());

            /* receive request */
            $postStartDate = $result->startDate;              /* รูปแบบ เดือน/วัน/ปี */
            $postEndDate = $result->endDate;               /* รูปแบบ เดือน/วัน/ปี */
            $postSiteName = $result->siteName;

            $app->log->debug(date("Y-m-d H:i:s")." : "."startDate : ".$postStartDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."endDate : ".$postEndDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."siteName : ".$postSiteName);

        } else if (($ContetnType == "application/x-www-form-urlencoded") || ($ContetnType == "application/x-www-form-urlencoded; charset=UTF-8")){

            /* receive request */                                                                                 
            $postStartDate = $app->request()->post('startDate');    /* รูปแบบ เดือน/วัน/ปี */
            $postEndDate = $app->request()->post('endDate');        /* รูปแบบ เดือน/วัน/ปี */
            $postSiteName = $app->request()->post('siteName');

            $app->log->debug(date("Y-m-d H:i:s")." : "."startDate : ".$postStartDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."endDate : ".$postEndDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."siteName : ".$postSiteName);
        } 



        // $postStartDate = "2016-07-24";    /* รูปแบบ เดือน/วัน/ปี */
        // $postEndDate = "2016-07-30";        /* รูปแบบ เดือน/วัน/ปี */
        // $postSiteName = "29";



            /*  Partial : Localhost */
                    // // copy file content into a string var
        // $json_file = file_get_contents('./KpiManager/getOperationKPI.json');
        // // convert the string to a json object
        // $reportResult = json_decode($json_file);


        $error = $client_mis->getError();
        if ($error) {
            echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
        }

        /* ************************* */
        /* เริ่มกระบวนการเชื่อมต่อ Web Service */
        /* ************************* */

        $result = $client_mis->call('MISObj_HalfYearOperationPerformanceKPIReport', array("dateStart" => $postStartDate,
                                                         				                       "dateEnd" => $postEndDate,
                                                         				                       "intSite" => $postSiteName));
        $reportResult = json_decode($result["MISObj_HalfYearOperationPerformanceKPIReportResult"],true);










        /* ************************* */
        /* เริ่มกระบวนการส่งค่ากลับ */
        /* ************************* */
        // $reportResult = array("msg" => "สวัสดี");

 
        $app->response()->header("Content-Type", "application/json");
        echo json_encode($reportResult);


    };

    /* Vehicle Leader - KPI Manager Partial */
        /**
     *
     * @apiName GetVehicleLeaderKpiByDaily
     * @apiGroup KPI Manager
     * @apiVersion 0.1.0
     *
     * @api {post} /kpiManager/getVehicleLeaderKpiByDaily/ Get Vehicle Leader KPI By Daily
     * @apiDescription คำอธิบาย : ในส่วนนี้ทำหน้าที่เรียกข้อมูล KPI ของหัวหน้าสาย แสดงผลแบบรายวัน ตามช่วงวันที่กำหนด
     *
     */

    function getVehicleLeaderKpiByDaily($app, $client_mis) {


        /* ************************* */
        /* เริ่มกระบวนการรับค่าพารามิเตอร์จากส่วนของ Payload ซึ่งอยู่ในรูปแบบ JSON */
        /* ************************* */
        $headers = $app->request->headers;
        $ContetnType = $app->request->headers->get('Content-Type');

        /**
        * apidoc @apiSampleRequest, iOS RESTKit use content-type is "application/json"
        * Web Form, Advance REST Client App use content-type is "application/x-www-form-urlencoded"
        */

        if (($ContetnType == "application/json") || ($ContetnType == "application/json; charset=utf-8") ) {

            $request = $app->request();
            $result = json_decode($request->getBody());

            /* receive request */
            $postStartDate = $result->startDate;              /* รูปแบบ เดือน/วัน/ปี */
            $postEndDate = $result->endDate;               /* รูปแบบ เดือน/วัน/ปี */
            $postSiteName = $result->siteName;

            $app->log->debug(date("Y-m-d H:i:s")." : "."startDate : ".$postStartDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."endDate : ".$postEndDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."siteName : ".$postSiteName);

        } else if (($ContetnType == "application/x-www-form-urlencoded") || ($ContetnType == "application/x-www-form-urlencoded; charset=UTF-8")){

            /* receive request */                                                                                 
            $postStartDate = $app->request()->post('startDate');    /* รูปแบบ เดือน/วัน/ปี */
            $postEndDate = $app->request()->post('endDate');        /* รูปแบบ เดือน/วัน/ปี */
            $postSiteName = $app->request()->post('siteName');

            $app->log->debug(date("Y-m-d H:i:s")." : "."startDate : ".$postStartDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."endDate : ".$postEndDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."siteName : ".$postSiteName);
        } 



        // $postStartDate = "2016-07-24";    /* รูปแบบ เดือน/วัน/ปี */
        // $postEndDate = "2016-07-30";        /* รูปแบบ เดือน/วัน/ปี */
        // $postSiteName = "29";



            /*  Partial : Localhost */
                    // // copy file content into a string var
        // $json_file = file_get_contents('./KpiManager/getOperationKPI.json');
        // // convert the string to a json object
        // $reportResult = json_decode($json_file);


        $error = $client_mis->getError();
        if ($error) {
            echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
        }

        /* ************************* */
        /* เริ่มกระบวนการเชื่อมต่อ Web Service */
        /* ************************* */

        $result = $client_mis->call('MISObj_VLeader_DailyOperationPerformanceKPIReport', array("dateStart" => $postStartDate,
                                                         				                       "dateEnd" => $postEndDate,
                                                         				                       "intSite" => $postSiteName));
        $reportResult = json_decode($result["MISObj_VLeader_DailyOperationPerformanceKPIReportResult"],true);










        /* ************************* */
        /* เริ่มกระบวนการส่งค่ากลับ */
        /* ************************* */
        // $reportResult = array("msg" => "สวัสดี");

 
        $app->response()->header("Content-Type", "application/json");
        echo json_encode($reportResult);


    };
        /**
     *
     * @apiName GetVehicleLeaderKpiByWeekly
     * @apiGroup KPI Manager
     * @apiVersion 0.1.0
     *
     * @api {post} /kpiManager/getVehicleLeaderKpiByWeekly/ Get Vehicle Leader KPI By Weekly
     * @apiDescription คำอธิบาย : ในส่วนนี้ทำหน้าที่เรียกข้อมูล KPI ของหัวหน้าสาย แสดงผลแบบรายสัปดาห์และช่วงวันที่กำหนด
     *
     */

    function getVehicleLeaderKpiByWeekly($app, $client_mis) {


        /* ************************* */
        /* เริ่มกระบวนการรับค่าพารามิเตอร์จากส่วนของ Payload ซึ่งอยู่ในรูปแบบ JSON */
        /* ************************* */
        $headers = $app->request->headers;
        $ContetnType = $app->request->headers->get('Content-Type');

        /**
        * apidoc @apiSampleRequest, iOS RESTKit use content-type is "application/json"
        * Web Form, Advance REST Client App use content-type is "application/x-www-form-urlencoded"
        */

        if (($ContetnType == "application/json") || ($ContetnType == "application/json; charset=utf-8") ) {

            $request = $app->request();
            $result = json_decode($request->getBody());

            /* receive request */
            $postStartDate = $result->startDate;              /* รูปแบบ เดือน/วัน/ปี */
            $postEndDate = $result->endDate;               /* รูปแบบ เดือน/วัน/ปี */
            $postSiteName = $result->siteName;

            $app->log->debug(date("Y-m-d H:i:s")." : "."startDate : ".$postStartDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."endDate : ".$postEndDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."siteName : ".$postSiteName);

        } else if (($ContetnType == "application/x-www-form-urlencoded") || ($ContetnType == "application/x-www-form-urlencoded; charset=UTF-8")){

            /* receive request */                                                                                 
            $postStartDate = $app->request()->post('startDate');    /* รูปแบบ เดือน/วัน/ปี */
            $postEndDate = $app->request()->post('endDate');        /* รูปแบบ เดือน/วัน/ปี */
            $postSiteName = $app->request()->post('siteName');

            $app->log->debug(date("Y-m-d H:i:s")." : "."startDate : ".$postStartDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."endDate : ".$postEndDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."siteName : ".$postSiteName);
        } 



        // $postStartDate = "2016-07-24";    /* รูปแบบ เดือน/วัน/ปี */
        // $postEndDate = "2016-07-30";        /* รูปแบบ เดือน/วัน/ปี */
        // $postSiteName = "29";



            /*  Partial : Localhost */
                    // // copy file content into a string var
        // $json_file = file_get_contents('./KpiManager/getOperationKPI.json');
        // // convert the string to a json object
        // $reportResult = json_decode($json_file);


        $error = $client_mis->getError();
        if ($error) {
            echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
        }

        /* ************************* */
        /* เริ่มกระบวนการเชื่อมต่อ Web Service */
        /* ************************* */

        $result = $client_mis->call('MISObj_VLeader_WeeklyOperationPerformanceKPIReport', array("dateStart" => $postStartDate,
                                                         				                        "dateEnd" => $postEndDate,
                                                         				                        "intSite" => $postSiteName));
        $reportResult = json_decode($result["MISObj_VLeader_WeeklyOperationPerformanceKPIReportResult"],true);










        /* ************************* */
        /* เริ่มกระบวนการส่งค่ากลับ */
        /* ************************* */
        // $reportResult = array("msg" => "สวัสดี");

 
        $app->response()->header("Content-Type", "application/json");
        echo json_encode($reportResult);


    };
        /**
     *
     * @apiName GetVehicleLeaderKpiByMonthly
     * @apiGroup KPI Manager
     * @apiVersion 0.1.0
     *
     * @api {post} /kpiManager/getVehicleLeaderKpiByMonthly/ Get Vehicle Leader KPI By Monthly
     * @apiDescription คำอธิบาย : ในส่วนนี้ทำหน้าที่เรียกข้อมูล KPI ของหัวหน้าสาย แสดงผลแบบรายเดือนและช่วงวันที่กำหนด
     *
     */

    function getVehicleLeaderKpiByMonthly($app, $client_mis) {


        /* ************************* */
        /* เริ่มกระบวนการรับค่าพารามิเตอร์จากส่วนของ Payload ซึ่งอยู่ในรูปแบบ JSON */
        /* ************************* */
        $headers = $app->request->headers;
        $ContetnType = $app->request->headers->get('Content-Type');

        /**
        * apidoc @apiSampleRequest, iOS RESTKit use content-type is "application/json"
        * Web Form, Advance REST Client App use content-type is "application/x-www-form-urlencoded"
        */

        if (($ContetnType == "application/json") || ($ContetnType == "application/json; charset=utf-8") ) {

            $request = $app->request();
            $result = json_decode($request->getBody());

            /* receive request */
            $postStartDate = $result->startDate;              /* รูปแบบ เดือน/วัน/ปี */
            $postEndDate = $result->endDate;               /* รูปแบบ เดือน/วัน/ปี */
            $postSiteName = $result->siteName;

            $app->log->debug(date("Y-m-d H:i:s")." : "."startDate : ".$postStartDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."endDate : ".$postEndDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."siteName : ".$postSiteName);

        } else if (($ContetnType == "application/x-www-form-urlencoded") || ($ContetnType == "application/x-www-form-urlencoded; charset=UTF-8")){

            /* receive request */                                                                                 
            $postStartDate = $app->request()->post('startDate');    /* รูปแบบ เดือน/วัน/ปี */
            $postEndDate = $app->request()->post('endDate');        /* รูปแบบ เดือน/วัน/ปี */
            $postSiteName = $app->request()->post('siteName');

            $app->log->debug(date("Y-m-d H:i:s")." : "."startDate : ".$postStartDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."endDate : ".$postEndDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."siteName : ".$postSiteName);
        } 



        // $postStartDate = "2016-07-24";    /* รูปแบบ เดือน/วัน/ปี */
        // $postEndDate = "2016-07-30";        /* รูปแบบ เดือน/วัน/ปี */
        // $postSiteName = "29";



            /*  Partial : Localhost */
                    // // copy file content into a string var
        // $json_file = file_get_contents('./KpiManager/getOperationKPI.json');
        // // convert the string to a json object
        // $reportResult = json_decode($json_file);


        $error = $client_mis->getError();
        if ($error) {
            echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
        }

        /* ************************* */
        /* เริ่มกระบวนการเชื่อมต่อ Web Service */
        /* ************************* */

        $result = $client_mis->call('MISObj_VLeader_MonthOperationPerformanceKPIReport', array("dateStart" => $postStartDate,
                                                         				                        "dateEnd" => $postEndDate,
                                                         				                        "intSite" => $postSiteName));
        $reportResult = json_decode($result["MISObj_VLeader_MonthOperationPerformanceKPIReportResult"],true);










        /* ************************* */
        /* เริ่มกระบวนการส่งค่ากลับ */
        /* ************************* */
        // $reportResult = array("msg" => "สวัสดี");

 
        $app->response()->header("Content-Type", "application/json");
        echo json_encode($reportResult);


    };
        /**
     *
     * @apiName GetVehicleLeaderKpiByQuarterly
     * @apiGroup KPI Manager
     * @apiVersion 0.1.0
     *
     * @api {post} /kpiManager/getVehicleLeaderKpiByQuarterly/ Get Vehicle Leader KPI By Quarterly
     * @apiDescription คำอธิบาย : ในส่วนนี้ทำหน้าที่เรียกข้อมูล KPI ของหัวหน้าสาย แสดงผลแบบราย Quarter และช่วงวันที่กำหนด
     *
     */

    function getVehicleLeaderKpiByQuarterly($app, $client_mis) {


        /* ************************* */
        /* เริ่มกระบวนการรับค่าพารามิเตอร์จากส่วนของ Payload ซึ่งอยู่ในรูปแบบ JSON */
        /* ************************* */
        $headers = $app->request->headers;
        $ContetnType = $app->request->headers->get('Content-Type');

        /**
        * apidoc @apiSampleRequest, iOS RESTKit use content-type is "application/json"
        * Web Form, Advance REST Client App use content-type is "application/x-www-form-urlencoded"
        */

        if (($ContetnType == "application/json") || ($ContetnType == "application/json; charset=utf-8") ) {

            $request = $app->request();
            $result = json_decode($request->getBody());

            /* receive request */
            $postStartDate = $result->startDate;              /* รูปแบบ เดือน/วัน/ปี */
            $postEndDate = $result->endDate;               /* รูปแบบ เดือน/วัน/ปี */
            $postSiteName = $result->siteName;

            $app->log->debug(date("Y-m-d H:i:s")." : "."startDate : ".$postStartDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."endDate : ".$postEndDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."siteName : ".$postSiteName);

        } else if (($ContetnType == "application/x-www-form-urlencoded") || ($ContetnType == "application/x-www-form-urlencoded; charset=UTF-8")){

            /* receive request */                                                                                 
            $postStartDate = $app->request()->post('startDate');    /* รูปแบบ เดือน/วัน/ปี */
            $postEndDate = $app->request()->post('endDate');        /* รูปแบบ เดือน/วัน/ปี */
            $postSiteName = $app->request()->post('siteName');

            $app->log->debug(date("Y-m-d H:i:s")." : "."startDate : ".$postStartDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."endDate : ".$postEndDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."siteName : ".$postSiteName);
        } 



        // $postStartDate = "2016-07-24";    /* รูปแบบ เดือน/วัน/ปี */
        // $postEndDate = "2016-07-30";        /* รูปแบบ เดือน/วัน/ปี */
        // $postSiteName = "29";



            /*  Partial : Localhost */
                    // // copy file content into a string var
        // $json_file = file_get_contents('./KpiManager/getOperationKPI.json');
        // // convert the string to a json object
        // $reportResult = json_decode($json_file);


        $error = $client_mis->getError();
        if ($error) {
            echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
        }

        /* ************************* */
        /* เริ่มกระบวนการเชื่อมต่อ Web Service */
        /* ************************* */

        $result = $client_mis->call('MISObj_VLeader_QuarterOperationPerformanceKPIReport', array("dateStart" => $postStartDate,
                                                         				                        "dateEnd" => $postEndDate,
                                                         				                        "intSite" => $postSiteName));
        $reportResult = json_decode($result["MISObj_VLeader_QuarterOperationPerformanceKPIReportResult"],true);










        /* ************************* */
        /* เริ่มกระบวนการส่งค่ากลับ */
        /* ************************* */
        // $reportResult = array("msg" => "สวัสดี");

 
        $app->response()->header("Content-Type", "application/json");
        echo json_encode($reportResult);


    };
        /**
     *
     * @apiName GetVehicleLeaderKpiByHalfYear
     * @apiGroup KPI Manager
     * @apiVersion 0.1.0
     *
     * @api {post} /kpiManager/getVehicleLeaderKpiByHalfYear/ Get Vehicle Leader KPI By HalfYear
     * @apiDescription คำอธิบาย : ในส่วนนี้ทำหน้าที่เรียกข้อมูล KPI ของหัวหน้าสาย แสดงผลแบบรายครึ่งปี และช่วงวันที่กำหนด
     *
     */

    function getVehicleLeaderKpiByHalfYear($app, $client_mis) {


        /* ************************* */
        /* เริ่มกระบวนการรับค่าพารามิเตอร์จากส่วนของ Payload ซึ่งอยู่ในรูปแบบ JSON */
        /* ************************* */
        $headers = $app->request->headers;
        $ContetnType = $app->request->headers->get('Content-Type');

        /**
        * apidoc @apiSampleRequest, iOS RESTKit use content-type is "application/json"
        * Web Form, Advance REST Client App use content-type is "application/x-www-form-urlencoded"
        */

        if (($ContetnType == "application/json") || ($ContetnType == "application/json; charset=utf-8") ) {

            $request = $app->request();
            $result = json_decode($request->getBody());

            /* receive request */
            $postStartDate = $result->startDate;              /* รูปแบบ เดือน/วัน/ปี */
            $postEndDate = $result->endDate;               /* รูปแบบ เดือน/วัน/ปี */
            $postSiteName = $result->siteName;

            $app->log->debug(date("Y-m-d H:i:s")." : "."startDate : ".$postStartDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."endDate : ".$postEndDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."siteName : ".$postSiteName);

        } else if (($ContetnType == "application/x-www-form-urlencoded") || ($ContetnType == "application/x-www-form-urlencoded; charset=UTF-8")){

            /* receive request */                                                                                 
            $postStartDate = $app->request()->post('startDate');    /* รูปแบบ เดือน/วัน/ปี */
            $postEndDate = $app->request()->post('endDate');        /* รูปแบบ เดือน/วัน/ปี */
            $postSiteName = $app->request()->post('siteName');

            $app->log->debug(date("Y-m-d H:i:s")." : "."startDate : ".$postStartDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."endDate : ".$postEndDate);
            $app->log->debug(date("Y-m-d H:i:s")." : "."siteName : ".$postSiteName);
        } 



        // $postStartDate = "2016-07-24";    /* รูปแบบ เดือน/วัน/ปี */
        // $postEndDate = "2016-07-30";        /* รูปแบบ เดือน/วัน/ปี */
        // $postSiteName = "29";



            /*  Partial : Localhost */
                    // // copy file content into a string var
        // $json_file = file_get_contents('./KpiManager/getOperationKPI.json');
        // // convert the string to a json object
        // $reportResult = json_decode($json_file);


        $error = $client_mis->getError();
        if ($error) {
            echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
        }

        /* ************************* */
        /* เริ่มกระบวนการเชื่อมต่อ Web Service */
        /* ************************* */

        $result = $client_mis->call('MISObj_VLeader_HalfYearOperationPerformanceKPIReport', array("dateStart" => $postStartDate,
                                                         				                        "dateEnd" => $postEndDate,
                                                         				                        "intSite" => $postSiteName));
        $reportResult = json_decode($result["MISObj_VLeader_HalfYearOperationPerformanceKPIReportResult"],true);










        /* ************************* */
        /* เริ่มกระบวนการส่งค่ากลับ */
        /* ************************* */
        // $reportResult = array("msg" => "สวัสดี");

 
        $app->response()->header("Content-Type", "application/json");
        echo json_encode($reportResult);


    };

    /* Menu Manager Partial */
        /**
     *
     * @apiName ListMenu
     * @apiGroup Menu Manager
     * @apiVersion 0.1.0
     *
     * @api {post} /menuManager/listMenu/ List Menu
     * @apiDescription คำอธิบาย : ในส่วนนี้ทำหน้าสร้างรายการเมนูตามสิทธิ์การเข้าใช้งานระบบ
     *
     */

    function listMenu($app, $pdo, $db) {

        /* ************************* */
        /* เริ่มกระบวนการรับค่าพารามิเตอร์จากส่วนของ Payload ซึ่งอยู่ในรูปแบบ JSON */
        /* ************************* */
        $headers = $app->request->headers;
        $ContetnType = $app->request->headers->get('Content-Type');

        /**
        * apidoc @apiSampleRequest, iOS RESTKit use content-type is "application/json"
        * Web Form, Advance REST Client App use content-type is "application/x-www-form-urlencoded"
        */
        if (($ContetnType == "application/json") || ($ContetnType == "application/json; charset=utf-8")) {

            $request = $app->request();
            $result = json_decode($request->getBody());

            /* receive request */
            $postActiveMenu = $result->active_menu;
            $postBaseURL = $result->baseURL;


        } else if ($ContetnType == "application/x-www-form-urlencoded"){

            //$userID = $app->request()->params('userID_param');
            //$userID = $app->request()->post('userID_param');
        }


        /* ************************* */
        /* เริ่มกระบวนการเชื่อมต่อฐานข้อมูล MySQL */
        /* ************************* */
        $reports = array();
        $id = 0;


        $results = $db->menu_tb->select('DISTINCT main_menu_url');

        foreach ($results as $result) {
            $result_main_menu_detail = $db->menu_tb->where("main_menu_url = ?", $result["main_menu_url"])->fetch();

                        /* **** Sub Menu - 01 *** */
            $reports_sub_menu_01 = array();

            $results_sub_menu_level_01_url = $db->menu_tb->select('DISTINCT sub_menu_level_01_url')->where("main_menu_url = ?", $result["main_menu_url"]);

            foreach ($results_sub_menu_level_01_url as $result_sub_menu_level_01_url) {
                $result_sub_menu_level_01_detail = $db->menu_tb->where("sub_menu_level_01_url = ?", $result_sub_menu_level_01_url["sub_menu_level_01_url"])->fetch();


                if ($result_sub_menu_level_01_url["sub_menu_level_01_url"]) {
                                    /* **** Sub Menu - 02 *** */
                $reports_sub_menu_02 = array();
                                                                                  
                $results_sub_menu_level_02_url = $db->menu_tb->select('DISTINCT sub_menu_level_02_url')->where("main_menu_url = ? and sub_menu_level_01_url = ?", $result["main_menu_url"], $result_sub_menu_level_01_url["sub_menu_level_01_url"]);
                                                                                                                                                                                                       
                $app->log->debug(date("Y-m-d H:i:s")." : "."sql results_sub_menu_level_02_url : ".$results_sub_menu_level_02_url);

                foreach ($results_sub_menu_level_02_url as $result_sub_menu_level_02_url) {
                    $result_sub_menu_level_02_detail = $db->menu_tb->where("main_menu_url = ? and sub_menu_level_02_url = ?", $result["main_menu_url"], $result_sub_menu_level_02_url["sub_menu_level_02_url"])->fetch();

                    // $app->log->debug(date("Y-m-d H:i:s")." : "."results_sub_menu_level_02_url : ".$results_sub_menu_level_02_url);

                    if ($result_sub_menu_level_02_url["sub_menu_level_02_url"]) {
                                        /* **** Sub Menu - 03 *** */
                $reports_sub_menu_03 = array();
                                                                                  
                $results_sub_menu_level_03_url = $db->menu_tb->select('DISTINCT sub_menu_level_03_url')->where("main_menu_url = ? and sub_menu_level_02_url = ?", $result["main_menu_url"], $result_sub_menu_level_02_url["sub_menu_level_02_url"]);

                

                foreach ($results_sub_menu_level_03_url as $result_sub_menu_level_03_url) {
                    $result_sub_menu_level_03_detail = $db->menu_tb->where("main_menu_url = ? and sub_menu_level_03_url= ?", $result["main_menu_url"], $result_sub_menu_level_03_url["sub_menu_level_03_url"])->fetch();

                    // $app->log->debug(date("Y-m-d H:i:s")." : "."results_sub_menu_level_03_url : ".$results_sub_menu_level_03_url);

                    if ($result_sub_menu_level_03_url["sub_menu_level_03_url"]) {
                                        /* **** Sub Menu - 04 *** */
                $reports_sub_menu_04 = array();
                                                                                  
                $results_sub_menu_level_04_title = $db->menu_tb->select('DISTINCT sub_menu_level_04_title')->where("main_menu_title = ? and sub_menu_level_03_title = ?", $result["main_menu_title"], $result_sub_menu_level_03_title["sub_menu_level_03_title"]);

                

                foreach ($results_sub_menu_level_04_title as $result_sub_menu_level_04_title) {
                    $result_sub_menu_level_04_leaf = $db->menu_tb->where("main_menu_title = ? and sub_menu_level_04_title = ?", $result["main_menu_title"], $result_sub_menu_level_04_title["sub_menu_level_04_title"])->fetch();

                    // $app->log->debug(date("Y-m-d H:i:s")." : "."results_sub_menu_level_04_title : ".$results_sub_menu_level_04_title);

                    if ($result_sub_menu_level_04_title["sub_menu_level_04_title"]) {

                        if ($result_sub_menu_level_04_leaf["sub_menu_level_04_leaf"] == "FALSE") {
                            $reports_sub_menu_04[] = array(
                                "sub_menu_level_04_title" => $result_sub_menu_level_04_title["sub_menu_level_04_title"],
                                "sub_menu_level_04_url" =>  $result_sub_menu_level_04_leaf["sub_menu_level_04_url"],
                                "sub_menu_level_04_leaf" =>  $result_sub_menu_level_04_leaf["sub_menu_level_04_leaf"]
                            );
                        } else {
                            $reports_sub_menu_04[] = array(
                                "sub_menu_level_04_title" => $result_sub_menu_level_04_title["sub_menu_level_04_title"],
                                "sub_menu_level_04_url" =>  $result_sub_menu_level_04_leaf["sub_menu_level_04_url"],
                                "sub_menu_level_04_leaf" =>  $result_sub_menu_level_04_leaf["sub_menu_level_04_leaf"],
                                // "sub_menu_level_05" => ""
                                );
                        }
                    }

                }

                        if ($result_sub_menu_level_03_detail["sub_menu_level_03_leaf"] == "FALSE") {
                            $reports_sub_menu_03[] = array(
                                "sub_menu_level_03_title" => $result_sub_menu_level_03_detail["sub_menu_level_03_title"],
                                "sub_menu_level_03_url" =>  $result_sub_menu_level_03_detail["sub_menu_level_03_url"],
                                "sub_menu_level_03_leaf" =>  $result_sub_menu_level_03_detail["sub_menu_level_03_leaf"]
                            );
                        } else {
                            $reports_sub_menu_03[] = array(
                                "sub_menu_level_03_title" => $result_sub_menu_level_03_detail["sub_menu_level_03_title"],
                                "sub_menu_level_03_url" =>  $result_sub_menu_level_03_detail["sub_menu_level_03_url"],
                                "sub_menu_level_03_leaf" =>  $result_sub_menu_level_03_detail["sub_menu_level_03_leaf"],
                                "sub_menu_level_04" => $reports_sub_menu_04
                                );
                        }
                    }

                }

                        if ($result_sub_menu_level_02_detail["sub_menu_level_02_leaf"] == "FALSE") {
                            $reports_sub_menu_02[] = array(
                                "sub_menu_level_02_title" => $result_sub_menu_level_02_detail["sub_menu_level_02_title"],
                                "sub_menu_level_02_url" =>  $result_sub_menu_level_02_detail["sub_menu_level_02_url"],
                                "sub_menu_level_02_leaf" =>  $result_sub_menu_level_02_detail["sub_menu_level_02_leaf"]
                            );
                        } else {
                            $reports_sub_menu_02[] = array(
                                "sub_menu_level_02_title" => $result_sub_menu_level_02_detail["sub_menu_level_02_title"],
                                "sub_menu_level_02_url" =>  $result_sub_menu_level_02_detail["sub_menu_level_02_url"],
                                "sub_menu_level_02_leaf" =>  $result_sub_menu_level_02_detail["sub_menu_level_02_leaf"],
                                "sub_menu_level_03" => $reports_sub_menu_03
                                );
                        }
                    }

                }

                    if ($result_sub_menu_level_01_detail["sub_menu_level_01_leaf"] == "FALSE") {
                        $reports_sub_menu_01[] = array(
                            "sub_menu_level_01_title" => $result_sub_menu_level_01_detail["sub_menu_level_01_title"],
                            "sub_menu_level_01_url" =>  $result_sub_menu_level_01_detail["sub_menu_level_01_url"],
                            "sub_menu_level_01_leaf" =>  $result_sub_menu_level_01_detail["sub_menu_level_01_leaf"]
                        );
                    } else {
                        $reports_sub_menu_01[] = array(
                            "sub_menu_level_01_title" => $result_sub_menu_level_01_detail["sub_menu_level_01_title"],
                            "sub_menu_level_01_url" =>  $result_sub_menu_level_01_detail["sub_menu_level_01_url"],
                            "sub_menu_level_01_leaf" =>  $result_sub_menu_level_01_detail["sub_menu_level_01_leaf"],
                            "sub_menu_level_02" =>  $reports_sub_menu_02
                            );
                    }
                }
            }

            if ($result_main_menu_detail["main_menu_leaf"] == "FALSE") {
                $reports[] = array(
                    "main_menu_active" => ($result_main_menu_detail["main_menu_title"] == $postActiveMenu)? "active" : "",
                    "main_menu_title" => $result_main_menu_detail["main_menu_title"],
                    "main_menu_url" => $result_main_menu_detail["main_menu_url"],
                    "main_menu_leaf" => $result_main_menu_detail["main_menu_leaf"]
                    );
            } else {
                $reports[] = array(
                    "main_menu_active" => ($result_main_menu_detail["main_menu_title"] == $postActiveMenu)? "active" : "",
                    "main_menu_title" => $result_main_menu_detail["main_menu_title"],
                    "main_menu_url" => $result_main_menu_detail["main_menu_url"],
                    "main_menu_leaf" => $result_main_menu_detail["main_menu_leaf"],
                    "sub_menu_level_01" => $reports_sub_menu_01
                    );
            }

        }

        $rowCount = count($results);



        /* ************************* */
        /* เริ่มกระบวนการส่งค่ากลับ */
        /* ************************* */
        $resultText = "success";

        $reportResult = array("result" =>  $resultText, 
                              "count" => $rowCount, 
                              "baseURL" => $postBaseURL,
                              "rows" => $reports);
        
        $app->response()->header("Content-Type", "application/json");
        echo json_encode($reportResult);


    };

    /* Permission Manager Partial */
        /**
     *
     * @apiName Login
     * @apiGroup Permission Manager
     * @apiVersion 0.1.0
     *
     * @api {post} /permissionManager/login/ Log in
     * @apiDescription คำอธิบาย : ในส่วนนี้จะมีหน้าที่ Log in เพื่อเข้าสู่ระบบ
     *
     */

    function login($app, $client_mis, $key) {


    /* ************************* */
    /* เริ่มกระบวนการรับค่าพารามิเตอร์จากส่วนของ Payload ซึ่งอยู่ในรูปแบบ JSON */
    /* ************************* */
    $headers = $app->request->headers;
    $ContetnType = $app->request->headers->get('Content-Type');

    /**
    * apidoc @apiSampleRequest, iOS RESTKit use content-type is "application/json"
    * Web Form, Advance REST Client App use content-type is "application/x-www-form-urlencoded"
    */
    if (($ContetnType == "application/json") || ($ContetnType == "application/json; charset=utf-8")) {

        $request = $app->request();
        $result = json_decode($request->getBody());

        /* receive request */
        $postUserName = $result->userName;
        $postPassWord = $result->passWord;


    } else if ($ContetnType == "application/x-www-form-urlencoded"){

        // $postUserName = $app->request()->params('userName');
        // $postPassWord = $app->request()->post('passWord');
        
        $postUserName = $app->request()->params('userName');
        $postPassWord = $app->request()->params('passWord');
    }


    /* ********************************* */
    /* เริ่มกระบวนการเชื่อมต่อ Web Service */
    /* ********************************* */


        /*  Partial : Localhost */
                $error = $client_mis->getError();
        if ($error) {
            echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
        }

        /* ************************* */
        /* เริ่มกระบวนการเชื่อมต่อ Web Service */
        /* ************************* */

        $result_auth = $client_mis->call('GetTrustAccountAuthVerify', array("strAccount" => $postUserName,
                                                                              "strPassword" => $postPassWord,
                                                                              "strProgVersion" => ""));
        // $report_result_auth = json_decode($result_auth["GetTrustAccountAuthVerifyResult"],true);
        $report_result_auth = $result_auth["GetTrustAccountAuthVerifyResult"];


        $check_auth = strpos($report_result_auth, "ERR");

        if ($check_auth === false) {

            $result_account_info = $client_mis->call('GetAccountCollectionInfoJSON', array("strUsrID" => substr($report_result_auth,-6)));
            $report_result_details = json_decode($result_account_info["GetAccountCollectionInfoJSONResult"],true);

            $result = "success";
        } else {

            $result = "failure";
            $report_result_details = $report_result_auth;
        }



    /*  Partial : about JWT */
        if ($check_auth === false) {

        /* ********************************* */
        /* เริ่มกระบวนการ Generate Token JWT */
        /* ********************************* */
        $tokenId    = base64_encode(mcrypt_create_iv(32));
        $issuedAt   = time();
        $notBefore  = $issuedAt + 1;             //Adding 1 seconds
        $expire     = $notBefore + (3600*3);     // Adding 3600*3 seconds (3 hours)
        $serverName = gethostname();             // Retrieve the server name from config file
        /*
        * Create the token as an array
        */
        $data = [
            'iat'  => $issuedAt,         // Issued at: time when the token was generated
            'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
            'iss'  => $serverName,       // Issuer
            'nbf'  => $notBefore,        // Not before
            'exp'  => $expire,           // Expire
            // "users" => [
            //     "user_id" => "1",
            //     "user_name" => $postUserName
            // ],
            // "roles" => $tmpRole,
            // "permissions" => $tmpPermissions,
            // "information" => [              // Data related to the signer user
            //     "branchCode" => $tmpBranch_code
            // ]
        ];

        $jwt = JWT::encode($data, $key);  // default algorithm: 'HS256'
        // $jwt = JWT::encode($data, $key, 'HS512');

        /* ******************************* */
        /* เริ่มกระบวนการสร้างตัวแปร SESSION */
        /* ******************************* */
        $_SESSION['jwt'] = $jwt;

    } else {

        $jwt = "";

        /* ******************************* */
        /* เริ่มกระบวนการทำงานกับตัวแปร SESSION */
        /* ******************************* */
        //$_SESSION = array();
        //session_unregister("userName"); // ลบบางตัวที่ใช้งาน
        session_destroy();                  // ลบทั้งหมด
    }



    /* ********************* */
    /* เริ่มกระบวนการส่งค่ากลับ */
    /* ********************* */
    $tmpRedirectURL = "../home/";

    $return_msg = array("result" => $result, 
                        "details" => $report_result_details,
                        "redirectURL" => $tmpRedirectURL,
                        "token" => $jwt);
    
    $app->response()->header("Content-Type", "application/json");
    echo json_encode($return_msg);


    };
    	/**
	 *
	 * @apiName CheckJWT
	 * @apiGroup Permission Manager
	 * @apiVersion 0.1.0
	 *
	 * @api {post} /permissionManager/checkJWT/ Check JSON Web Token (JWT)
	 * @apiDescription คำอธิบาย : ในส่วนนี้จะมีหน้าที่ตรวจสอบรายละเอียด JWT ตามที่ร้องขอ(request)มา ซึ่งระบุ Authorization ไว้ในส่วนของ Header
	 *
	 *
	 * @apiSampleRequest /permissionManager/checkJWT/
	 *
	 * @apiSuccess {String} msg แสดงข้อความทักทายผู้ใช้งาน
	 *
	 * @apiSuccessExample Example data on success:
	 * {
	 *   "msg": "Hello, anusorn"
	 * }
	 *
	 * @apiError UserNotFound The <code>id</code> of the User was not found.
	 * @apiErrorExample {json} Error-Response:
	 *     HTTP/1.1 404 Not Found
	 *     {
	 *       "error": "UserNotFound"
	 *     }
	 *
	 */
	 function checkJWT($app, $key) {

	   /*** Extract the jwt from the Bearer ***/
       $request = $app->request();
       $authHeader = $request->headers('authorization');
       list($jwt) = sscanf( (string)$authHeader, 'Bearer %s');

       /*** iat ***/
       $myIatEpoch = $app->jwt->iat;				// Issued at: time when the token was generated

	   $dtIat = new DateTime("@$myIatEpoch");  // convert UNIX timestamp to PHP DateTime
	   $myIatHuman = $dtIat->format('Y-m-d H:i:s'); // output = 2012-08-15 00:00:00 

	   $TimeZoneNameFrom="UTC";
	   $TimeZoneNameTo="Asia/Bangkok";
	   $myIatHumanWithTimeZone = date_create($myIatHuman, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("Y-m-d H:i:s");
	   /*********/

	   /*** iat ***/
	   $myJti = $app->jwt->jti;
	   /*********/

	   /*** iss ***/
	   $myIss = $app->jwt->iss;
	   /*********/

	   /*** nbf ***/
       $myNbfEpoch = $app->jwt->nbf;				// Not before

	   $dtNbf = new DateTime("@$myNbfEpoch");  // convert UNIX timestamp to PHP DateTime
	   $myNbfHuman = $dtNbf->format('Y-m-d H:i:s'); // output = 2012-08-15 00:00:00 

	   $TimeZoneNameFrom="UTC";
	   $TimeZoneNameTo="Asia/Bangkok";
	   $myNbfHumanWithTimeZone = date_create($myNbfHuman, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("Y-m-d H:i:s");
	   /*********/

	   /*** exp ***/
       $myExpEpoch = $app->jwt->exp;				// Expire

	   $dtExp = new DateTime("@$myExpEpoch");  // convert UNIX timestamp to PHP DateTime
	   $myExpHuman = $dtExp->format('Y-m-d H:i:s'); // output = 2012-08-15 00:00:00 

	   $TimeZoneNameFrom="UTC";
	   $TimeZoneNameTo="Asia/Bangkok";
	   $myExpHumanWithTimeZone = date_create($myExpHuman, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("Y-m-d H:i:s");
	   /*********/


       // $myUsers = $app->jwt->users;
       // $myRole = $app->jwt->roles;
       // $myPermissions = $app->jwt->permissions;
       // $myInformation = $app->jwt->information;

       $app->response->headers->set('Content-Type', 'application/json');
       echo json_encode(array("AuthHeader" => $authHeader, 
       						  "iat-epoch" => $myIatEpoch,
       						  "iat-human" => $myIatHuman,
       						  "iat-human-timezone" => $myIatHumanWithTimeZone,
       						  "jti" => $myJti,
       						  "iss" => $myIss,
       						  "nbf-epoch" => $myNbfEpoch,
       						  "nbf-human" => $myNbfHuman,
       						  "nbf-human-timezone" => $myNbfHumanWithTimeZone,
       						  "exp-epoch" => $myExpEpoch,
       						  "exp-human" => $myExpHuman,
       						  "exp-human-timezone" => $myExpHumanWithTimeZone,

       						  // "users" => $myUsers,
       						  // "role" => $myRole, 
       						  // "permissions" => $myPermissions,
       						  // "information" => $myInformation
       						  ));
       
	 }
	 
    	/**
	 *
	 * @apiName GetJWT
	 * @apiGroup Permission Manager
	 * @apiVersion 0.1.0
	 *
	 * @api {get} /permissionManager/getJWT/ Get JSON Web Token (JWT)
	 * @apiDescription คำอธิบาย : ในส่วนนี้จะมีหน้าที่ส่งค่า JWT ที่เก็บไว้ในตัวแปร session กลับไป
	 *
	 *
	 * @apiSampleRequest /permissionManager/getJWT/
	 *
	 * @apiSuccess {String} msg แสดงข้อความทักทายผู้ใช้งาน
	 *
	 * @apiSuccessExample Example data on success:
	 * {
	 *   "msg": "Hello, anusorn"
	 * }
	 *
	 * @apiError UserNotFound The <code>id</code> of the User was not found.
	 * @apiErrorExample {json} Error-Response:
	 *     HTTP/1.1 404 Not Found
	 *     {
	 *       "error": "UserNotFound"
	 *     }
	 *
	 */
	 function getJWT($app) {

	 		if (!isset($_SESSION['jwt'])) {
	 			$return_m = array("jwt" => "");
	 		} else {
	 			$return_m = array("jwt" => $_SESSION['jwt']);
	 		}
	  	  

	  	  $app->response->headers->set('Content-Type', 'application/json');
	      echo json_encode($return_m);

	 }
	 
        /**
     *
     * @apiName Logout
     * @apiGroup Permission Manager
     * @apiVersion 0.1.0
     *
     * @api {post} /permissionManager/logout/ Log out
     * @apiDescription คำอธิบาย : ในส่วนนี้จะมีหน้าที่ Log out เพื่อออกจากระบบ
     *
     */

    function logout($app) {


    /* ************************* */
    /* เริ่มกระบวนการรับค่าพารามิเตอร์จากส่วนของ Payload ซึ่งอยู่ในรูปแบบ JSON */
    /* ************************* */
    $headers = $app->request->headers;
    $ContetnType = $app->request->headers->get('Content-Type');

    /**
    * apidoc @apiSampleRequest, iOS RESTKit use content-type is "application/json"
    * Web Form, Advance REST Client App use content-type is "application/x-www-form-urlencoded"
    */
    if (($ContetnType == "application/json") || ($ContetnType == "application/json; charset=utf-8")) {

        $request = $app->request();
        $result = json_decode($request->getBody());

        /* receive request */
        // $postUserName = $result->userName;
        // $postPassWord = $result->passWord;


    } else if ($ContetnType == "application/x-www-form-urlencoded"){

        //$userID = $app->request()->params('userID_param');
        //$userID = $app->request()->post('userID_param');
    }


    //$_SESSION = array();
    //session_unregister("userName"); // ลบบางตัวที่ใช้งาน
    session_destroy();                  // ลบทั้งหมด

    $return_m = array("msg" => "Good bye - user logout.");
    
    $app->response()->header("Content-Type", "application/json");
    echo json_encode($return_m);


    };
 
?>