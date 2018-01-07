<?php
$serverName = "(local)";
$connectionInfo =  array("UID"=>"sa","PWD"=>"Lin999999","Database"=>"QPTreasureDB");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
$now = date('Y-m-d 00:00:00');
$today = new DateTime($now);
$day   = new DateInterval('P1D'); // P開頭代表日期，10D 代表 10 天
$last = $today->sub($day)->format('Y-m-d 23:59:59');
if( $conn ){
    try{
        $sql = <<<sql
SELECT UserID, SUM(OrderAmount) as TotalAmt, SUM(CardGold) as TotalGold
FROM [QPTreasureDB].[dbo].[OnLineOrder] 
where OrderStatus=2 and ApplyDate >= '{$last}' and ApplyDate <= '{$now}'
group by UserID
sql;

        $result = sqlsrv_query($conn, $sql);
        $fp = fopen('log/success_'.date('Y-m-d').'.txt', 'a+');
        $scoreBack = fopen('log/scoreback_'.date('Y-m-d').'.txt', 'a+');
        $log_temp = "用户ID:[%s] \t 充值总金额: %s \r\n";
        $scoreback_temp = "返回金币--->用户ID:[%s] \t 总充值金币: %s \t 返送金币: %s \r\n";
        if(sqlsrv_has_rows($result)) {
            while($re = sqlsrv_fetch_array($result)) {
                $addScore = $re['TotalGold'] * 0.1;
                $update = "UPDATE [QPTreasureDB].[dbo].[GameScoreInfo] SET Score=Score+{$addScore} WHERE UserID={$re['UserID']}";
                sqlsrv_query($conn, $update);
                $log_str = sprintf($log_temp, $re['UserID'], $re['TotalAmt']);
                $scoreback_str = sprintf($scoreback_temp, $re['UserID'], $re['TotalGold'], $addScore);
                fwrite($fp,$log_str);
                fwrite($scoreBack, $scoreback_str);
                print_r($re);
            }
            fclose($fp);
            fclose($scoreBack);
        }
    } catch (Exception $e) {
        $handle = fopen('log/error.txt', 'a+');
        fwrite($handle, $e);
        fclose($handle);
    }
}
sqlsrv_close( $conn);
?>
