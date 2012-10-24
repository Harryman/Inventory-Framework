<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Math for Gears script</title>
</head>


<?php

$A = 0;
$B = 0;
$C = 0;
$D = 0;
$N = 32;
$G = 0;
$F = 0;
					$_13 = 0;
					$_14 = 0;
					$_15 = 0;
					$_16 = 0;
					$_17 = 0;
					$_18 = 0; 
					$_19 = 0;
					$_20 = 0;
					$_21 = 0;
					$_22 = 0;
					$_23 = 0;
					$_24 = 0;
					$_25 = 0;
					$_26 = 0;
					$_27 = 0;
					$E = 0;


// 216 < a + b < 216
echo "A,B,C,D,N,G";
echo "<br/>";

$con = mysql_connect("192.168.1.150:3306", "user","1q2w3e4r");
if (!$con)
{
	die('Could not connect: ' .mysql_error());
	echo "failure";
	break;
}

mysql_select_db("mathforgears",$con);



$result = mysql_query( "SELECT * FROM gears_owned", $con);
if(!$result){
	echo "<br/>";
	echo "query failed please try again";
}
while($row = mysql_fetch_assoc($result))
{ 
	$A = $row["change gear teeth"];
	$resultb = mysql_query( "SELECT * FROM gears_owned", $con);
	while($rowb = mysql_fetch_assoc($resultb)){
		$B = $rowb["change gear teeth"];
		$resultc = mysql_query( "SELECT * FROM gears_owned", $con);
			while($rowc = mysql_fetch_assoc($resultc)){
				$C = $rowc["change gear teeth"];
				$resultd = mysql_query( "SELECT * FROM gears_owned", $con);
				while($rowd = mysql_fetch_assoc($resultd)){
					$D = $rowd["change gear teeth"];
					$resultn = mysql_query("SELECT * FROM cutters WHERE `pitch` = '8'",$con);//change pitch manually
						while($rown = mysql_fetch_assoc($resultn)){
							$N = $rown["teeth_num"];
							$G = ($A*$C*$N)/($B*$D);
							$K = $C + $D; 
						if ( $A + $B < 217 and $A + $B > 78 and $K == 120 and $A <= 124 and $B <= 96 and $C <= 96 and $D <= 96){
							if($G > 28.9 and $G < 29.1 ){
							//	$sql = "INSERT INTO all_combos(`A`, `B`, `C`, `D`, `G`, `N`, `pitch`) VALUES('".$A."', '".$B."', '".$C."', '".$D."', '".$G."', '".$N."', '8')";
							//mysql_query($sql,$con); //change pitch manually
							
							
				/*	$_13 = 0;
					$_14 = 0;
					$_15 = 0;
					$_16 = 0;
					$_17 = 0;
					$_18 = 0; 
					$_19 = 0;
					$_20 = 0;
					$_21 = 0;
					$_22 = 0;
					$_23 = 0;
					$_24 = 0;
					$_25 = 0;
					$_26 = 0;
					$_27 = 0;		
				if($G == 13){
					$_13 = 1;
				}
				if($G == 14){
					$_14 = 1;
				}
				if($G == 15){
					$_15 = 1;
				}
				if($G == 16){
					$_16 = 1;
				}
				if($G == 17){
					$_17 = 1;
				}
				if($G == 18){
					$_18 = 1;
				}
				if($G == 19){
					$_19 = 1;
				}
				if($G == 20){
					$_20 = 1;
				}
				if($G == 21){
					$_21 = 1;
				}
				if($G == 22){
					$_22 = 1;
				}
				if($G == 23){
					$_23 = 1;
				}
				if($G == 24){
					$_24 = 1;
				}
				if($G == 25){
					$_25 = 1;
				}
				if($G == 26){
					$_26 = 1;
				}
				if($G == 27){
					$_27 = 1;
				}
				*/
					echo "$A";
					echo ",";
					echo "$B";
					echo ",";
					echo "$C";
					echo ",";
					echo "$D";
					echo ",";
					echo "$N";
					echo ",";
					echo "$G";
					//echo ",";
					//echo $sql;
				/*	echo "$_13";
					echo ",";
					echo "$_14";
					echo ",";
					echo "$_15";
					echo ",";
					echo "$_16";
					echo ",";
					echo "$_17";
					echo ",";
					echo "$_18";
					echo ",";
					echo "$_19";
					echo ",";
					echo "$_20";
					echo ",";
					echo "$_21";
					echo ",";
					echo "$_22";
					echo ",";
					echo "$_23";
					echo ",";
					echo "$_24";
					echo ",";
					echo "$_25";
					echo ",";
					echo "$_26";
					echo ",";
					echo "$_27";*/
					echo "<br/>";
						}
					}
				}
			}
		}
	}
}
		echo "$E";
		echo "<br/>";
		echo "done";
mysql_free_result($result);
mysql_close($con);
?>
<body>
</body>
</html>


