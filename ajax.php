<?php
require_once 'db_config.php';
require_once 'location.php';
$sql=array();
$dis= array();
$Location= new Location();
$dbconn=new  dbconnection();
$sql=$Location->display_location($dbconn->conn);

    
$fixedprice=array('CedMicro'=>50, 'CedMini'=>150, 'CedRoyal'=>200,'CedSUV'=>250);
$date=$_POST['da'];
$pick=$_POST['p'];
$drop=$_POST['d'];
$luggage=$_POST['l'];
$cab=$_POST['c'];
$d1;
$d2;
$fixedfare;
$totalfare;
$distance=abs($Location ->get_distance($dbconn->conn, $pick)-$Location->get_distance($dbconn->conn, $drop));


foreach ($fixedprice as $key=> $v) {
    global $fixedfare;
    if ($cab==$key) {
        $fixedfare=$v;
        if ($key=='CedMicro') {
            if ($distance<=10) {
                $disteq10=$distance*13.50;
                $totalfare=$fixedfare+$disteq10;
            }
            if ($distance>10 and $distance<=60) {
                $dist=12.00*($distance-10);
                $dist1=13.50*10;
                $totalfare=$dist+$dist1+$fixedfare;
            }
            if ($distance>60 and $distance<=160) {
                $d=$distance-60;
                $d1=60-10;
                $dist=12.00*$d1;
                $dist1=10.20*$d;
                $dist2=13.50*10;
                $totalfare=$dist+$dist1+$dist2+$fixedfare;
            }
            if ($distance>160) {
                $dist=13.50*10;
                $dist1=12.00*50;
                $dist2=10.20*100;
                $dist3=8.50*abs($distance-160);
                $totalfare=$dist+$dist1+$dist2+$dist3+$fixedfare;
            }
        }
        if ($key=='CedMini') {
            if ($distance<=10) {
                $disteq10=$distance*14.50;
                $totalfare=$fixedfare+$disteq10;
                if ($luggage<=10) {
                    $totalfare=$fixedfare+$disteq10+50;
                }
                if ($luggage>10 and $luggage<=20) {
                    $totalfare=$fixedfare+$disteq10+100;
                }
                if ($luggage>20) {
                    $totalfare=$fixedfare+$disteq10+200;
                }
            }
            if ($distance>10 and $distance<=60) {
                $dist=13.00*($distance-10);
                $dist1=14.50*10;

                if ($luggage<=10) {
                    $totalfare=$dist+$dist1+$fixedfare+50;
                }
                if ($luggage>10 and $luggage<=20) {
                    $totalfare=$dist+$dist1+$fixedfare+100;
                }
                if ($luggage>20) {
                    $totalfare=$dist+$dist1+$fixedfare+200;
                }
            }
            if ($distance>60 and $distance<=160) {
                $d=$distance-60;
                $d1=60-10;
                $dist=13.00*$d1;
                $dist1=11.20*$d;
                $dist2=14.50*10;
                if ($luggage<=10) {
                    $totalfare=$dist+$dist1+$dist2+$fixedfare+50;
                }
                if ($luggage>10 and $luggage<=20) {
                    $totalfare=$dist+$dist1+$dist2+$fixedfare+100;
                }
                if ($luggage>20) {
                    $totalfare=$dist+$dist1+$dist2+$fixedfare+200;
                }
            }
            if ($distance>160) {
                $dist=14.50*10;
                $dist1=13.00*50;
                $dist2=11.20*100;
                $dist3=9.50*abs($distance-160);

                if ($luggage<=10) {
                    $totalfare=$dist+$dist1+$dist2+$dist3+$fixedfare+50;
                }
                if ($luggage>10 and $luggage<=20) {
                    $totalfare=$dist+$dist1+$dist2+$dist3+$fixedfare+100;
                }
                if ($luggage>20) {
                    $totalfare=$dist+$dist1+$dist2+$dist3+$fixedfare+200;
                }
            }
        }
        if ($key=='CedRoyal') {
            if ($distance<=10) {
                $disteq10=$distance*15.50;

                if ($luggage<=10) {
                    $totalfare=$fixedfare+$disteq10+50;
                }
                if ($luggage>10 and $luggage<=20) {
                    $totalfare=$fixedfare+$disteq10+100;
                }
                if ($luggage>20) {
                    $totalfare=$fixedfare+$disteq10+200;
                }
            }
            if ($distance>10 and $distance<=60) {
                $dist=14.00*($distance-10);
                $dist1=15.50*10;

                if ($luggage<=10) {
                    $totalfare=$dist+$dist1+$fixedfare+50;
                }
                if ($luggage>10 and $luggage<=20) {
                    $totalfare=$dist+$dist1+$fixedfare+100;
                }
                if ($luggage>20) {
                    $totalfare=$dist+$dist1+$fixedfare+200;
                }
            }
            if ($distance>60 and $distance<=160) {
                $d=$distance-60;
                $d1=60-10;
                $dist=14.00*$d1;
                $dist1=12.20*$d;
                $dist2=15.50*10;

                if ($luggage<=10) {
                    $totalfare=$dist+$dist1+$dist2+$fixedfare+50;
                }
                if ($luggage>10 and $luggage<=20) {
                    $totalfare=$dist+$dist1+$dist2+$fixedfare+100;
                }
                if ($luggage>20) {
                    $totalfare=$dist+$dist1+$dist2+$fixedfare+200;
                }
            }
            if ($distance>160) {
                $dist=15.50*10;
                $dist1=14.00*50;
                $dist2=12.20*100;
                $dist3=10.50*abs($distance-160);

                if ($luggage<=10) {
                    $totalfare=$dist+$dist1+$dist2+$dist3+$fixedfare+50;
                }
                if ($luggage>10 and $luggage<=20) {
                    $totalfare=$dist+$dist1+$dist2+$dist3+$fixedfare+100;
                }
                if ($luggage>20) {
                    $totalfare=$dist+$dist1+$dist2+$dist3+$fixedfare+200;
                }
            }
        }
        if ($key=='CedSUV') {
            if ($distance<=10) {
                $disteq10=$distance*16.50;

                if ($luggage<=10) {
                    $totalfare=$fixedfare+$disteq10+50;
                }
                if ($luggage>10 and $luggage<=20) {
                    $totalfare=$fixedfare+$disteq10+100;
                }
                if ($luggage>20) {
                    $totalfare=$fixedfare+$disteq10+200;
                }
            }
            if ($distance>10 and $distance<=60) {
                $dist=15.00*($distance-10);
                $dist1=16.50*10;

                if ($luggage<=10) {
                    $totalfare=$dist+$dist1+$fixedfare+50;         
                }
                if ($luggage>10 and $luggage<=20) {
                    $totalfare=$dist+$dist1+$fixedfare+100;
                }
                if ($luggage>20) {
                    $totalfare=$dist+$dist1+$fixedfare+200;
                }
            }
            if ($distance>60 and $distance<=160) {
                $d=$distance-60;
                $d1=60-10;
                $dist=15.00*$d1;
                $dist1=13.20*$d;
                $dist2=16.50*10;

                if ($luggage<=10) {
                    $totalfare=$dist+$dist1+$dist2+$fixedfare+50;
                }
                if ($luggage>10 and $luggage<=20) {
                    $totalfare=$dist+$dist1+$dist2+$fixedfare+100;
                }
                if ($luggage>20) {
                    $totalfare=$dist+$dist1+$dist2+$fixedfare+200;
                }
            }
            if ($distance>160) {
                $dist=16.50*10;
                $dist1=15.00*50;
                $dist2=13.20*100;
                $dist3=11.50*abs($distance-160);

                if ($luggage<=10) {
                    $totalfare=$dist+$dist1+$dist2+$dist3+$fixedfare+100;
                }
                if ($luggage>10 and $luggage<=20) {
                    $totalfare=$dist+$dist1+$dist2+$dist3+$fixedfare+200;
                }
                if ($luggage>20) {
                    $totalfare=$dist+$dist1+$dist2+$dist3+$fixedfare+400;
                }
            }
        }
    }
}

$arr = array('distance'=> $distance, 'fare'=>$totalfare);
$display=json_encode($arr);
echo $display;
?>