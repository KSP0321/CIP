<?php
            $con=mysqli_connect("cip2.cqq628j9la9u.ap-northeast-2.rds.amazonaws.com","admin","1q2w3e4r","CIP2")or die("MySQL 접속 실패");
            $idx = $_GET['index'];
            $query="SELECT * FROM PARKING WHERE PARKING_ID = $idx ";
            $set = mysqli_query($con,$query);
            //$array = mysqli_fetch_array($set);

            $o = array();
            while ($array = mysqli_fetch_object($set)) {
                $t = new stdClass();
                $t->number = $array->PARKING_NUMBER;
                $t->name = $array->PARKING_NAME;
                $t->address = $array->PARKING_ADDRESS;
                $t->phone = $array->PARKING_PHONE;
                $t->runtime = $array->PARKING_RUNTIME;
                $o[] = $t;
                unset($t);
            }

            echo json_encode($o,JSON_UNESCAPED_UNICODE);
               

?>