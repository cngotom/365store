<?
$row = 1;
$handle = fopen("1.csv","r");
while($data = fgetcsv($handle,1000,","))
{
	$num = count($data);
	print "$num  fields in line $row:<br";
	$row++;
	for($c=0;$c<$num;$c++)
	{
		print $data[$c]."<br>";
	}
}
fclose($handle);
?>
