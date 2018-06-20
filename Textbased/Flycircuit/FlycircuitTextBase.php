<?php
if (!defined('MODULE_FILE')) {
	die ("You can't access this file directly...");
}
include("dro_config.php");
require_once("db/dbtool.php");
$sql="SELECT * FROM `neurontable` GROUP BY `driver`";
$result=execute_sql($sql,$link,"Flycircuit");
$rownum=sql_numrows($result);
$sqlneuron="SELECT * FROM `neurondetail`";
$resultneuron=execute_sql($sqlneuron,$link,"Flycircuit");
$neuronrow=sql_numrows($resultneuron);
for($i=0;$i<$neuronrow;$i++)
{
	$searchall  = get_row($resultneuron);
	$neuron[$i] = $searchall['neuron'];
}

?>
<script>
function disable(id)
{
	var obj = document.getElementsByClassName(id);
	var mode ;
	var i;
	for (i = 0;i < obj.length; i++) 
	{
		mode = !obj[i].disabled;
		obj[i].disabled = mode;
    }
}
</script>
<?php

	$neuronname="";
	$searchresult="";
	$searchresult[0]="";
	$Gender;
	$allresult;
	$finalresult=0; //chek the result exist or not
	function test_input($data) 
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}	
	if (empty($_POST['neuronname'])) 
	{
		$neuronname = "";
	} 
	else 
	{
		$neuronname = test_input($_POST['neuronname']);
		$searchresult = explode("\r",$neuronname); //Get the neuron name when the user type in
	}
//echo $_POST['imageresult'];
	if(isset($_POST['imageresult']))
        {
                $neuronname=str_replace ("_","\r",$_POST['imageresult']);
                $searchresult = explode("\r",$neuronname);
        }
	if(isset($_GET['neuronindex']))
        {
				$neuronindex = $_POST['checkbrain'];
				$checkfinal = implode(",",$neuronindex);
                $neuronname= str_replace (",","\r",$checkfinal);
                $searchresult = explode("\r",$neuronname);
        }
	if(isset($_POST['driverbasedresult']))
        {
                $driverresult = $_POST['driverbasedresult'];
                $checkfinal = implode(",",$driverresult);
                $neuronname= str_replace (",","\r",$checkfinal);
                $searchresult = explode("\r",$neuronname);
        }
	for($j=1;$j<count($searchresult);$j++) //the new string may begin with \n so we need to replace it with "".
	{
		$searchresult[$j]= str_replace ("\n","",$searchresult[$j]);
	}
	if(isset($_POST["g_head"]))
	{
		if (isset($_POST["head"])) //check it's brain or not
		{
			//$output=0;
			for($i=0;$i<count($searchresult);$i++) //all neuron
			{
				if(substr($searchresult[$i],-7,-6)==$_POST['head'][0]&&substr($searchresult[$i],-9,-8)==$_POST['head'][0]){}//cehck it is brain or not
				else if(substr($searchresult[$i],-8,-7)==$_POST['head'][0]){}//cehck it is head or not
				else
				{
					$searchresult[$i]="";
				}
			}
		}
	}
	if(isset($_POST["g_gender"]))
	{
		if (isset($_POST["drivergender"])) //check it's brain or not
		{
			//$output=0;
			for($i=0;$i<count($searchresult);$i++) //all neuron
			{
				if(substr($searchresult[$i],-8,-7)==$_POST['drivergender'][0])//check brain's gender
				{
					if($i==0)$Gender[$i]=1;
					else $Gender[$i]=0;
				} 
				else if(substr($searchresult[$i],-8,-7)=='a'&&substr($searchresult[$i],-9,-8)==$_POST['drivergender'][0])//check heads's gender
				{
					if($i==0)$Gender[$i]=1;
					else $Gender[$i]=0;
				}
				else
				{
					$searchresult[$i]="";
					$Gender[$i]=-1;
				}
			}
		}
	}
	
	if(isset($_POST['driver']))
	{
		for($i=0;$i<count($searchresult);$i++) //all neuron
		{
			if(substr($searchresult[$i],0,-9)==substr($_POST['driverselect'],0,-5))
			{
				
			}
			else
				$searchresult[$i]="";
		}
	}
	if(isset($_POST['birth']))
	{
		for($i=0;$i<count($searchresult);$i++) //all neuron
		{
			$birthsql="SELECT  `birthtiming` FROM  `neurondetail` where `neuron`='".$searchresult[$i]."'";
			$birthresult=execute_sql($birthsql,$link,"Flycircuit");
			$row=get_row($birthresult);
			if($row['birthtiming']!=$_POST['birthselect'])
				$searchresult[$i]="";
		}
	}	

	if(count($searchresult)>1||$searchresult[0]!='')
	{
		for($j=0;$j<count($searchresult);$j++)
		{
			for($i=0;$i<$neuronrow;$i++)
			{	
				if($searchresult[$j]==$neuron[$i])
				{
					$finalresult=1;
					$allresult[$j]=1;
					break;
				}
				else
					$allresult[$j]=0;
			}
		}
	}
?>
<form id="form1" method="post" action="http://140.114.95.72/index.php?neurontext_based=1&&showresult=1">
	<center><u><font size="+1"><strong>Flycircuit Text-based Search</strong></font></u></center><p>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#000000">
		<tr>
			<td><table width="100%" border="0" cellspacing="1" cellpadding="3">
				<tr>
				<td width="20%" bgcolor="#CCCCCC"><strong>
				<input type="checkbox" id="name" name="queryall" <?php if(isset($_POST['queryall'])){echo "checked";}?>>
				</strong><strong>Name List </strong><br />
				<table border="0" width="100%"><tr><td width="10%"></td><td>
				Example:<br >
				VGlut-F-300424<br>
				5HT1A-M-000000</td>
				<tr></table></td>
					<td colspan="3" bgcolor="#FFFFFF">
					<?php
					echo"<textarea name='neuronname' cols='80' rows='5' class='drivertext'>";
						if(isset($_GET['showresult']))
							echo"$neuronname";
					
					echo"</textarea>";
					?>
					</td>
				</tr>
				<tr>
					<td width="20%" bgcolor="#CCCCCC">
					<strong><input name="g_head" type="checkbox" id="brain" <?php if(isset($_POST['g_head'])){echo "checked";}?>></strong>
					<strong>Brain/Head</strong></td>
					<td colspan="3" bgcolor="#FFFFFF">
					<input  name="head[]" class="brainhead" type="radio" value="-" <?php if(isset($_POST['g_head'])){if($_POST['head'][0]=="-"){echo "checked";}}?>/>
					Brain  
					<input  name="head[]" class="brainhead" type="radio" value="a" <?php if(isset($_POST['g_head'])){if($_POST['head'][0]=="a"){echo "checked";}}?>/>
					Head
					</td>
				</tr>
				<tr>
					<td width="20%" bgcolor="#CCCCCC">
					<strong><input name="g_gender" type="checkbox" id="gender" <?php if(isset($_POST['g_gender'])){echo "checked";}?> ></strong>
					<strong>Gender</strong></td>
					<td colspan="3" bgcolor="#FFFFFF">
					<input  name="drivergender[]" class="drivergender" type="radio" value="F" <?php if(isset($_POST['g_gender'])){if($_POST['drivergender'][0]=="F"){echo "checked";}}?> />
					Female  
					<input  name="drivergender[]" class="drivergender" type="radio" value="M" <?php if(isset($_POST['g_gender'])){if($_POST['drivergender'][0]=="M"){echo "checked";}}?> />
					Male
					</td>
				</tr>		
				<tr>
					<td width="20%" bgcolor="#CCCCCC"><strong>
						<input name="driver" type="checkbox" id="type"  <?php if(isset($_POST['driver'])){echo "checked";}?>  />
						Driver</strong> 
					</td>	
					<td width="20%" bgcolor="#FFFFFF"><label>
						<select  name='driverselect'>
						<?php
						for($i=0;$i<$rownum;$i++)
						{
							$row = get_row($result);
							$type[$i]= $row['driver'];
							if(isset($_POST['driver'])&&$i==0)
								echo"<option>$_POST[driverselect]</option>";
							echo"<option value='".$type[$i]."'>$type[$i]</option>";
						}
						?>
						</select>
						</label>
					</td>
					<td width="15%" bgcolor="#CCCCCC"><strong>
						<input  type="checkbox" id="g_birth" name="birth" <?php if(isset($_POST['birth'])){echo "checked";}?> />
						Putative birth time</strong> 
					</td>
					<td width="20%" bgcolor="#FFFFFF"><label>
						<select name="birthselect">
						<?php
						if(isset($_POST['birthselect']))
                                                	echo"<option>$_POST[birthselect]</option>";
						?>
						<option value="embryo">embryo</option>
						<option value="day2">day1</option>
						<option value="day2">day2</option>
						<option value="day3">day3</option>
						<option value="day4">day4</option>
						<option value="day5">day5</option>
						<option value="day6">day6</option>
						<option value="day7">day7</option>
						<option value="day8">day8</option>
						<option value="day9">day9</option>
						</select>
						</label>
					</td>
				</tr>
				<tr>
					<td width="20%" bgcolor="#CCCCCC"><strong>
						<input type="checkbox" id="transmit" name="transmit" <?php if(isset($_POST['transmit'])){echo "checked";}?> />
						Neurotransmitter</strong> 
					</td>	
					<td width="20%" bgcolor="#FFFFFF"><label>
						<select name="neurotransmitter">
						<?php
						if(isset($_POST['neurotransmitter'])&&isset($_POST['transmit']))
                                                	echo"<option>$_POST[neurotransmitter]</option>";
						?>
						<option value='Acetylcholine'>Acetylcholine</option>
						<option value='Dopamine'>Dopamine</option>
						<option value='GABA'>GABA</option>
						<option value='Glutamate'>Glutamate</option>
						<option value='Octopamine'>Octopamine</option>
						<option value='Serotonin'>Serotonin</option>
						<option value='unknown'>unknown</option>
						</select>
						</label>
					</td>
					<td width="15%" bgcolor="#CCCCCC"><strong>
						<input type="checkbox" id="Annotation" name="Annotation" <?php if(isset($_POST['Annotation'])){echo "checked";}?>/>
						Annotation</strong> 
					</td>
					<td width="20%" bgcolor="#FFFFFF"><label>
						<input type="text" name="annotation" 
						<?php
						if(isset($_POST['annotation'])&&isset($_POST['Annotation']))
                            echo" value = ".$_POST['annotation']."";
						?>
						>
						
						</input>
						</label>
					</td>
				</tr>				
				<tr>
				<td valign="top" bgcolor="#CCCCCC"><strong>
					<input name="g_innervation" type="checkbox" id="g_innervation" <?php if(isset($_POST['g_innervation'])){echo "checked";}?> />
					Innervation sites </strong><br />
					Define <font color="#0000ff"> &quot;AND Function&quot;</font>  as
					<br>Innervated (N) > &nbsp
					<select name="innervationnumber">
					<?php
						if(isset($_POST['g_innervation'])&&isset($_POST[innervationnumber]))
							echo"<option>$_POST[innervationnumber]</option>";
					?>	
						<option value="0">0</option>
						<option value="100">100</option>
						<option value="200">200</option>
						<option value="300">300</option>
						<option value="400">400</option>
						<option value="500">500</option>
						<option value="1000">1000</option>
						<option value="5000">5000</option>
						<option value="10000">10000</option>
					</select>
					<br /><br />Define 
					<font color="#FF0000">&quot;NOT function&quot;</font> as <br />
					<br> Innervated (N) <=
					<select name="notinnervationnumber">
					<?php
						if(isset($_POST['g_innervation'])&&isset($_POST[notinnervationnumber]))
						echo"<option>$_POST[notinnervationnumber]</option>";
					?>	
						<option value="0">0</option>
						<option value="100">100</option>
						<option value="200">200</option>
						<option value="300">300</option>
						<option value="400">400</option>                              
						<option value="500">500</option>
						<option value="1000">1000</option>
						<option value="5000">5000</option>
						<option value="10000">10000</option>
					</select>        
				</td>
				<td colspan="3" valign="top" bgcolor="#FFFFFF"><a href="#t1" onClick="Innervation_site_switch()" title="Innervation_site_switch">More details</a></p>
				<div id="Innervation_site">
<!--				style="display:none">-->
				<table width="100%" border="1" cellspacing="2" cellpadding="2">
				<tr>
				<td colspan="6" bgcolor="#CCCCCC">AND, NOT Function </td>
				</tr>
<?php
		$neuroncounts= array("");
		$or_option_1="";
		$or_option_2="";
		$or_option_3="";
		$or_option_4="";
		$or_option_5="";
		$or_option_6="";
		$zone_option_1="";
		$zone_option_2="";
		$zone_option_3="";																
		for($i=0;$i<count($neuropilArr);$i++){
			$neuronpil=$neuropilArr[$i];
			$t1="t_innervation_or_1_".$neuronpil;
			$or_option_1.="<option value=\"".$neuronpil."\"".$t1.">".$neuronpil."</option>\n";
			$t2="t_innervation_or_2_".$neuronpil;
			$or_option_2.="<option value=\"".$neuronpil."\"".$t2.">".$neuronpil."</option>\n";
			$t3="t_innervation_or_3_".$neuronpil;
			$or_option_3.="<option value=\"".$neuronpil."\"".$t3.">".$neuronpil."</option>\n";
			$t4="t_innervation_or_4_".$neuronpil;
			$or_option_4.="<option value=\"".$neuronpil."\"".$t4.">".$neuronpil."</option>\n";
			$t5="t_innervation_or_5_".$neuronpil;
			$or_option_5.="<option value=\"".$neuronpil."\"".$t5.">".$neuronpil."</option>\n";
			$t6="t_innervation_or_6_".$neuronpil;
			$or_option_6.="<option value=\"".$neuronpil."\"".$t6.">".$neuronpil."</option>\n";

			$z1="zone1_".$neuronpil;
			$zone_option_1.="<option value=\"".$neuronpil."\"".$z1.">".$neuronpil."</option>\n";															
			$z2="zone2_".$neuronpil;
			$zone_option_2.="<option value=\"".$neuronpil."\"".$z2.">".$neuronpil."</option>\n";			
			$z3="zone3_".$neuronpil;
			$zone_option_3.="<option value=\"".$neuronpil."\"".$z3.">".$neuronpil."</option>\n";						
		}


	for($i=0;$i<count($neuropilArr);$i++){
		$neuronpil=$neuropilArr[$i];	
		$t_innervation_name="t_innervation_".$neuronpil;

		if (($i%6)==0) 
		{
?>
		<tr>
<?php
		}
		$t0="t_innervation_0_".$neuronpil;
		$t1="t_innervation_1_".$neuronpil;
		$t2="t_innervation_2_".$neuronpil;
?>
		<td>
			<select name=<?php echo $t_innervation_name;?>>
			<?php
				if(isset($_POST[$t_innervation_name]))
					if(substr($t_innervation_name,14)==substr($_POST[$t_innervation_name],16))
					{
						//echo substr($t_innervation_name,14);
						if(substr($_POST[$t_innervation_name],14,1)==1)
						{
							echo"<option value= $t1>and</option>";
							if(substr($t_innervation_name,14,1)<91)
								array_push($neuroncounts,"1".strtolower(substr($t_innervation_name,14))."l");
							else
								array_push($neuroncounts,"1".strtolower(substr($t_innervation_name,14))."r");
						}
						elseif(substr($_POST[$t_innervation_name],14,1)==2)
						{
							echo"<option value= $t2>not</option>";
							if(substr($t_innervation_name,14,1)<91)
								array_push($neuroncounts,"2".strtolower(substr($t_innervation_name,14))."l");
							else
								array_push($neuroncounts,"2".strtolower(substr($t_innervation_name,14))."r");
						}
					}
			?>
			<option></option>
			<option <?php echo"value = $t1";?>>and</option>
			<option <?php echo"value = $t2";?>>not</option>
			</select>
			&nbsp;
			<a href="search/neuropil/<?php echo"$neuronpil";?>.jpg" target="_blank">
			<?php echo $neuronpil;?>
			</a>
		</td>
		<?php
		if (($i%6)==5) {
		?>
		</tr>
		
		<?php
		}
	}
	//echo substr($_POST['t_innervation_AL'],16,2);
	print_r($neuroncounts);
	$other=6-(count($neuropilArr)%6);
	if ($other>0){
	for($i=0;$i<$other;$i++){
	echo "<td>&nbsp;</td>";
	}	
	echo "</tr>";
	}		
?>
				<tr>
				<td bgcolor="#CCCCCC">OR Function 1</td>
				<td colspan="5"> (
				<select name="t_innervation_or_1">
				<option value="0"></option>
				<?php echo"$or_option_1";?>
				</select>
				or
				<select name="t_innervation_or_2">
				<option value="0"></option>
				<?php echo"$or_option_2";?>
				</select>
				) </td>
				</tr>
				<tr>
				<td bgcolor="#CCCCCC">OR Function 2</td>
				<td colspan="5"> (
				<select name="t_innervation_or_3">
				<option value="0"></option>
				<?php echo"$or_option_3";?>
				</select>
				or
				<select name="t_innervation_or_4">
				<option value="0"></option>
				<?php echo"$or_option_4";?>
				</select>
				) </td>
				</tr>
				<tr>
				<td bgcolor="#CCCCCC">OR Function 3</td>
				<td colspan="5"> (
				<select name="t_innervation_or_5">
				<option value="0"></option>
				<?php echo"$or_option_5";?>
				</select>
				or
				<select name="t_innervation_or_6">
				<option value="0"></option>
				<?php echo"$or_option_6";?>
				</select>
				) </td>
				</tr>
				</table>
				</div></td>
				</tr>
				<tr>
				<td valign="top" bgcolor="#CCCCCC"><strong>
				<input name="g_innervation_percent" type="checkbox" id="g_innervation_percent" value="1" >          
				Innervation (%) </strong>

				<select name="t_innervation_percent_value_upper">
				<option value="100">Innervated (%) <= 100</option>
				<option value="90">Innervated (%) <= 90</option>
				<option value="80">Innervated (%) <= 80</option>
				<option value="70">Innervated (%) <= 70</option>
				<option value="60">Innervated (%) <= 60</option>
				<option value="50">Innervated (%) <= 50</option>
				<option value="40">Innervated (%) <= 40</option>
				<option value="30">Innervated (%) <= 30</option>
				<option value="20">Innervated (%) <= 20</option>
				<option value="10">Innervated (%) <= 10</option>
				</select><br /><center>and</center> 
				<select name="t_innervation_percent_value">
				<option value="90">Innervated (%) >= 90</option>
				<option value="80">Innervated (%) >= 80</option>
				<option value="70">Innervated (%) >= 70</option>
				<option value="60">Innervated (%) >= 60</option>
				<option value="50">Innervated (%) >= 50</option>
				<option value="40">Innervated (%) >= 40</option>
				<option value="30">Innervated (%) >= 30</option>
				<option value="20">Innervated (%) >= 20</option>
				<option value="10">Innervated (%) >= 10</option>
				<option value="0">Innervated (%) >= 0</option>
				</select>        </td>
				<td valign="top" colspan="3" bgcolor="#FFFFFF"><a name="t2"></a>
				<a href="#t2" onClick="Innervation_percentage_switch()" title="Innervation_percentage_switch">More details</a></p>
				
				
<div id="Innervation_percentage" style="display:none">		
<table width="100%" border="1" cellspacing="2" cellpadding="2">
<?php
for($i=0;$i<count($neuropilArr);$i++){
$neuronpil=$neuropilArr[$i];	
$t_innervation_percent_name="t_innervation_percent_".$neuronpil;


if (($i%6)==0) {
?>
<tr>
<?php
}
$t0="t_innervation_0_".$neuronpil_number;
$t1="t_innervation_1_".$neuronpil_number;
$t2="t_innervation_2_".$neuronpil_number;

?>
<td><input type="checkbox" name="t_innervation_percent[]"  />&nbsp;
<a href="search/neuropil/<?php echo"$neuronpil";?>.jpg" target="_blank"><?php echo"$neuronpil";?></a></td>
<?php
if (($i%6)==5) {
?>
</tr>
<?php
}
}
$other=6-(count($neuropilArr)%6);
if ($other>0){
for($i=0;$i<$other;$i++){
echo "<td>&nbsp;</td>";
}	
echo "</tr>";
}		

?>
</table></div>
				
				</tr>
				<tr>
					<td bgcolor="#CCCCCC"><br />
					<strong>
					<input name="g_sorting" type="checkbox" id="g_sorting" value="1">
					Cell body domain</strong><br /></td>
					<td colspan="3" bgcolor="#FFFFFF">The distance between neuronpil  
					<select name="sort_by" id="sort_by" >
					<option value="0">Name</option>
					<option value="1">Birth Timing</option>
					<option value="2">Driver</option>
					<option value="3">Neurotransmitter</option>
					<option value="4">Cellbody Size</option>
					<option value="5">Neuron Size</option>
					<option value="6">Cellbody Domain</option>
					<option value="7">Release Date</option>
					</select>
					surface and soma <=  
					<select name="order_by" id="order_by">
					<option value="0">10</option>
					<option value="0">20</option>
					<option value="0">30</option>
					<option value="0">40</option>
					<option value="0">50</option>
					<option value="0">60</option>
					<option value="0">70</option>
					<option value="0">80</option>
					<option value="0">90</option>
					<option value="0">100</option>
					</select>
					micrometers</br>
					<input type="radio" name="with">with/
					<input type="radio" name="with">without the cell body enclosed. ( this search takes more time. ). 
				</tr>				
				<tr>
					<td bgcolor="#CCCCCC"><br />
					<strong>
					<input name="g_sorting" type="checkbox" id="g_sorting" <?php if(isset($_POST['g_sorting'])){echo "checked";}?>>
					Result order</strong><br /></td>
					<td colspan="3" bgcolor="#FFFFFF">&nbsp;&nbsp;Sort by 
					<select name="sort_by" id="sort_by" >
					<?php
						if(isset($_POST['sort_by'])&&isset($_POST['g_sorting']))
							echo"<option>$_POST[sort_by]</option>";
					?>
					<option value="Name">Name</option>
					<option value="Birth Timing">Birth Timing</option>
					<option value="Driver">Driver</option>
					<option value="Neurotransmitter">Neurotransmitter</option>
					<option value="Cellbody Size">Cellbody Size</option>
					<option value="Neuron Size">Neuron Size</option>
					<option value="Cellbody Domain">Cellbody Domain</option>
					<option value="Release Date">Release Date</option>
					</select>
					, Order by 
					<select name="order_by" id="order_by">
					<?php
						if(isset($_POST['order_by'])&&isset($_POST['g_sorting']))
							echo"<option>$_POST[order_by]</option>";
					?>
					<option value="Z to A (Large to Small)">Z to A (Large to Small)</option>
					<option value="A to Z (Small to Large)">A to Z (Small to Large)</option>
					</select>
					, Result
					lists  
					<select name="list_by" id="list_by">
					<?php
						if(isset($_POST['list_by'])&&isset($_POST['g_sorting']))
							echo"<option>$_POST[list_by]</option>";
					?>
					<option value="10">10</option>
					<option value="20">20</option>
					<option value="30">30</option>
					<option value="40">40</option>
					<option value="50">50</option>
					<option value="60">60</option>
					<option value="70">70</option>
					<option value="80">80</option>
					<option value="90">90</option>
					<option value="100">100</option>
					<option value="200">200</option>
					<option value="300">300</option>
					<option value="400">400</option>
					<option value="500">500</option>
					<option value="600">600</option>     
					<option value="4000">4000</option>     
					</select></td>
				</tr>
				<tr>
				<td bgcolor="#CCCCCC"><a name="r1"></a></td>
				<td colspan="3" bgcolor="#FFFFFF"><input name="Submit" type="submit" id="Submit" value="LimitQuery" />
				<input type="reset" name="Submit2" value="Reset" />
				<a name="t1"></a></td>
				</tr>
			</table></td>
		</tr>
	</table>
</form>

<?php
$femaleresult="";
$maleresult="";	
$femalecount=0;
$malecount=0;
$neurotrans = ""; //Search neurotransmitter
$annotation = ""; //Search neurotransmitter
$sort = "";
$by = "";
$limit = "";
$neuroncount = "";
	if(isset($_GET['showresult']))
	{
		echo $queryall;
		//print_r($_POST['checkbrain']);
		if($finalresult==1)
		{
			if(isset($_POST['neurotransmitter'])&&isset($_POST['transmit']))
			{
				$neurotrans = " and a.`neurotransmitter` = '".$_POST['neurotransmitter']."'";
			}
			if(isset($_POST['Annotation'])&&isset($_POST['annotation']))
			{
				$annotation = " and a.`annotation` = '".$_POST['annotation']."'";
			}
			if(isset($_POST['g_sorting']))
			{
				if($_POST['sort_by']=="Name")$sort = "order by a.`neuron`";
				elseif($_POST['sort_by']=="Birth Timing")$sort = "order by a.`birthtiming`";
				elseif($_POST['sort_by']=="Driver")$sort = "order by a.`neuron`";
				elseif($_POST['sort_by']=="Neurotransmitter")$sort = "order by a.`neurotransmitter`";
				elseif($_POST['sort_by']=="Cellbody Size")$sort = "order by a.`neuron`";
				elseif($_POST['sort_by']=="Neuron Size")$sort = "order by a.`size`";
				elseif($_POST['sort_by']=="Cellbody Domain")$sort = "order by a.`somaVolume`";
				elseif($_POST['sort_by']=="Release Date")$sort = "order by a.`updated`";					
				if($_POST['order_by']=="Z to A (Large to Small)")$by = " desc ";
				elseif($_POST['order_by']=="A to Z (Small to Large)")$by = " asc ";
				$limit = "limit ".$_POST['list_by'];
			}
			for($output=0;$output<count($searchresult);$output++)
			{
				if($allresult[$output]==1)
				{
					$sql2="SELECT a.*,(a.somaX*a.somaY*a.somaZ) as `size`,b.* FROM `neurondetail` a, `neuronCounts` b WHERE a.`neuron`='".$searchresult[$output]."'".$neurotrans.$annotation.$sort.$by.$limit;
					$result=execute_sql($sql2,$link,"Flycircuit");
					$finalshow  = get_row($result);
					$Gender[$output]=$finalshow['gender'];
					if($Gender[$output]=="female")
					{
						$femaleresult[$femalecount]=$searchresult[$output];
						$femalecount++;
					}
					else if($Gender[$output]=="male")
					{
						$maleresult[$malecount]=$searchresult[$output];
						$malecount++;
					}
				}
			}
			if($femalecount == 0 && $malecount ==0)
			{
				echo"<h2 align='center'><font color='red'>No Data Query</font></h2>";
			}	
		}
		else
		{
			echo"<h2 align='center'><font color='red'>No Result</font></h2>";
		}
	}
	echo"<div id = '1'></div>";
	
	if($femalecount>0)
	{
		echo"<h1 align='center'><font color='red'>Female flycircuit</font></h1>";
		$finalfemaleresult=array_unique($femaleresult);
		$TEST1='F';
		include ("search/Textbased/Flycircuit/colorWay.php");
	}
	if($malecount>0)
	{
		echo"<h1 align='center'><font color='blue'>Male flycircuit</font></h1>";
		$finalmaleresult=array_unique($maleresult);
		$TEST1='M';
		include ("search/Textbased/Flycircuit/colorWay.php");
	}
?>
