<!doctype html>
<head>
<title>Ban lista</title>
<style type="text/css">
body {
	background-color: #e1e1e1;
	width:80%;
	margin:0px auto;
}
</style><!-- your html stuff -->
<meta charset="UTF-8">
</head>
<body>
<?php

$ftp_ip="178.32.137.193"; //
$ftp_user="srv_108705_S0p"; //
$ftp_pass="KvYSG9dq"; //


$ftp_log_path="cstrike/addons/amxmodx/configs/mdbBans/banlist.txt";
$temporary_file="bans.tmp";

$conn_id = ftp_connect($ftp_ip);
$login_result = ftp_login($conn_id, $ftp_user, $ftp_pass);

$local = fopen($temporary_file, "w");
$result = ftp_fget($conn_id, $local, $ftp_log_path, FTP_ASCII);

ftp_close($conn_id);


$myFile = $temporary_file;
$fh = fopen($myFile, 'r');
$theData = fread($fh, filesize($myFile));
fclose($fh);

'<h1 style="color:#000;margin:0px;padding:0px;font-size:50px;"><center>Ban lista</center></h1>'; //NASLOV
echo "<table border=\"0\" cellpadding=\"2\" style=\"width: 100%;\">\n";
echo "<tr>\n";
echo "<td style=\"background-color: #333333; color: #FFFFFF; font-size: small;\">Igrac</td>\n";
echo "<td style=\"background-color: #333333; color: #FFFFFF; font-size: small;\">STEAM ID</td>\n";
echo "<td style=\"background-color: #333333; color: #FFFFFF; font-size: small;\">IP</td>\n";
echo "<td style=\"background-color: #333333; color: #FFFFFF; font-size: small;\">mID</td>\n";
echo "<td style=\"background-color: #333333; color: #FFFFFF; font-size: small;\">Vreme</td>\n";
echo "<td style=\"background-color: #333333; color: #FFFFFF; font-size: small;\">Trajanje bana</td>\n";
echo "<td style=\"background-color: #333333; color: #FFFFFF; font-size: small;\">Admin</td>\n";
echo "<td style=\"background-color: #333333; color: #FFFFFF; font-size: small;\">Razlog</td>\n";
echo "<td style=\"background-color: #333333; color: #FFFFFF; font-size: small;\">Tip bana</td>\n";
echo "</tr>\n";


$file1 = $temporary_file;
$lines = file($file1);
$line_num = -1;
foreach($lines as $linenum => $line){
 $line_num++;
}
while($line_num > -1){
$line = $lines[$line_num];
if(strlen($line) == 1){
	$line_num--;
	continue;
}
$lista = explode(' -%- ', $line);

$nik = strpbrk($lista[0], ' ');
$tip = substr($lista[0],0,strrpos($lista[0],'+'));

echo "<tr>\n";
echo "<td style=\"background-color: #eee; color: #000000; font-size: small;\">";
echo htmlspecialchars($nik);
echo "</td>\n";

echo "<td style=\"background-color: #eee; color: #000000; font-size: small;\">";
echo $lista[1];
echo "</td>\n";

echo "<td style=\"background-color: #eee; color: #000000; font-size: small;\">";
echo $lista[2];
echo "</td>\n";

echo "<td style=\"background-color: #eee; color: #000000; font-size: small;\">";
echo $lista[3];
echo "</td>\n";

echo "<td style=\"background-color: #eee; color: #000000; font-size: small;\">";
echo $lista[4];
echo "</td>\n";

echo "<td style=\"background-color: #eee; color: #000000; font-size: small;\">";
if($lista[5] == '0')
	echo 'Za stalno';
else
	echo $lista[5];
echo "</td>\n";

echo "<td style=\"background-color: #eee; color: #000000; font-size: small;\">";
echo $lista[6];
echo "</td>\n";

echo "<td style=\"background-color: #eee; color: #000000; font-size: small;\">";
echo $lista[7];
echo "</td>\n";

echo "<td style=\"background-color: #eee; color: #000000; font-size: small;\">";
if($tip == 'cen')
	echo 'Cenzura';
else if ($tip == 'tban') 
	echo 'Smart Ban';
else if ($tip == 'ban')
	echo 'Smart Ban';
else echo 'Pwn';
echo "</td>\n";

echo "</tr>\n";

$line_num--;
}
echo "</table>\n";
?>
</body>
</html>
