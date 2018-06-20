<?php

 /************************************************************************/
 /* PHP-NUKE: Web Portal System                                          */
 /* ===========================                                          */
 /*                                                                      */
 /* Copyright (c) 2005 by Francisco Burzi                                */
 /* http://phpnuke.org                                                   */
 /*                                                                      */
 /* This program is free software. You can redistribute it and/or modify */
 /* it under the terms of the GNU General Public License as published by */
 /* the Free Software Foundation; either version 2 of the License.       */
 /************************************************************************/

if (!defined('MODULE_FILE')) {
	die ("You can't access this file directly...");
}
if (!isset($genderCheck)) $genderCheck="female";
	include_once("colorWayFunc.php");
?>
<form action="modules.php?name=clearpage&op=frame_index_redirect_v1" method="post" name="amira<?=$genderCheck;?>" target="_blank" id="amira<?=$genderCheck;?>">
  <input name="auto_color" type="checkbox" id="auto_color" value="1"/>
  Auto Color &nbsp;&nbsp;
  <table width="500" border="1" cellspacing="1" cellpadding="1">
<tr>
<td width="15%" bgcolor="#FFFFFF"><div align="center">Color ID </div></td>
<td width="5%" bgcolor="#FF0000"><div align="center">A</div></td>
<td width="5%" bgcolor="#00CC00"><div align="center">B</div></td>
<td width="5%" bgcolor="#0099CC"><div align="center">C</div></td>
<td width="5%" bgcolor="#990099"><div align="center">D</div></td>
<td width="5%" bgcolor="#FF6600"><div align="center">E</div></td>
<td width="5%" bgcolor="#33FF66"><div align="center">F</div></td>
<td width="5%" bgcolor="#CC3399"><div align="center">G</div></td>
<td width="5%" bgcolor="#0066FF"><div align="center">H</div></td>
<td width="5%" bgcolor="#CC9900"><div align="center">I</div></td>
<td width="5%" bgcolor="#66CCFF"><div align="center">J</div></td>
<td width="5%" bgcolor="#FF9900"><div align="center">K</div></td>
<td width="5%" bgcolor="#CCFF66"><div align="center">L</div></td>
<td width="5%" bgcolor="#FFFF00"><div align="center">M</div></td>
<td width="5%" bgcolor="#FF3399"><div align="center">N</div></td>
<td width="5%" bgcolor="#004400"><div align="center">O</div></td>
<td width="5%" bgcolor="#663300"><div align="center">P</div></td>
<td width="5%" bgcolor="#666666"><div align="center">Q</div></td>
</tr>
</table><br>
<table width="98%" border="0" cellpadding="0" cellspacing="0" bgcolor="#333333">
<?php
/*
$Neuron_num=count($searchresult);
$recorder_array=array();

for ($z=0;$z<$Neuron_num;$z=$z+2) {		
	if (isset($Neuron[$z])){
		$idid=$Neuron[$z];
		$sql="SELECT nid,neuron,gender,age,driver,neurotransmitter,birthtiming,author,annotation,somaX,somaY,somaZ,somaVolume,neuronVolume,motif,updated from neuronList ";
		$result = sql_query($sql);
		while ($row = sql_fetchrow($result)) {
			$nid=trim($row[0]);	
			$neuron=trim($row[1]);	
			$gender=trim($row[2]);
			if ($gender=="female"){	
				$gen="&#9792;";					
			}else{
				$gen="&#9794;";							
			}			
			$age=trim($row[3]);	
			$driver=trim($row[4]);	
			$neurotransmitter=trim($row[5]);	
			$birthtiming=trim($row[6]);	
			if ($birthtiming==10){
				$birthtiming="unknown";
			}elseif ($birthtiming==0){
				$birthtiming="embryo";
			}else{
				$birthtiming="day ".$birthtiming;
			}	
			$author=trim($row[7]);	
			$annotation=trim($row[8]);	
			$somaX=trim($row[9]); $somaY=trim($row[10]); $somaZ=trim($row[11]); $somaVolume=trim($row[12]); $neuronVolum=trim($row[13]); 
			$motif=trim($row[14]);
			$updated=trim($row[15]);
			$lsmImg="/flycircuitSourceData/NeuronData/".$neuron."/".$neuron."_lsm.png";$lsmResizeImg="/flycircuitSourceData/NeuronData/".$neuron."/".$neuron."_lsmResize.png";
			$neuronImg="/flycircuitSourceData/NeuronData/".$neuron."/".$neuron."_neuron.png";$neuronResizeImg="/flycircuitSourceData/NeuronData/".$neuron."/".$neuron."_neuronResize.png";
			$brainSurfaceImg="/flycircuitSourceData/NeuronData/".$neuron."/".$neuron."_brainSurface.png";$brainSurfaceResizeImg="/flycircuitSourceData/NeuronData/".$neuron."/".$neuron."_brainSurfaceResize.png";
			
			$neuronDetail="<a href=\"modules.php?name=clearpage&op=detail_table&nid=".$idid."\" target=\"_blank\">".$gen." ".$neuron." (".$birthtiming.")</a>";

			$color_user=0;	
			$color_id_tmp="color_".$neuron;
			if ((isset($$color_id_tmp)) && ($$color_id_tmp!="0")){
				$color_user=$$color_id_tmp;
			}			
		}
		if ($color_user!="0"){
			$pathHx="<input name=\"Neuron[]\" type=\"checkbox\" value=\"$idid\" checked=\"checked\">".gene_color($idid,$color_user,0);					
		}else{	
			$selected++;
			$pathHx="<input name=\"Neuron[]\" type=\"checkbox\" value=\"$idid\" checked=\"checked\">".gene_color($idid,$selected,0);		
		}
		$pic="<a href=\"".$lsmImg."\" target=\"_blank\"><img src=\"".$lsmResizeImg."\" border=\"0\"></a>";			


		array_push($recorder_array,$neuronDetail);
		array_push($recorder_array,$pathHx);
		array_push($recorder_array,$pic);	
		array_push($recorder_array,$idid);	

	}
	if (isset($Neuron[$z+1])){
		$idid=$Neuron[$z+1];
		$sql="SELECT nid,neuron,gender,age,driver,neurotransmitter,birthtiming,author,annotation,somaX,somaY,somaZ,somaVolume,neuronVolume,motif,updated from neuronList where nid='".$idid."'";
		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result)) {
			$nid=trim($row[0]);	
			$neuron=trim($row[1]);	
			$gender=trim($row[2]);
			if ($gender=="female"){	
				$gen="&#9792;";					
			}else{
				$gen="&#9794;";							
			}			
			$age=trim($row[3]);	
			$driver=trim($row[4]);	
			$neurotransmitter=trim($row[5]);	
			$birthtiming=trim($row[6]);	
			if ($birthtiming==10){
				$birthtiming="unknown";
			}elseif ($birthtiming==0){
				$birthtiming="embryo";
			}else{
				$birthtiming="day ".$birthtiming;
			}	
			$author=trim($row[7]);	
			$annotation=trim($row[8]);	
			$somaX=trim($row[9]); $somaY=trim($row[10]); $somaZ=trim($row[11]); $somaVolume=trim($row[12]); $neuronVolum=trim($row[13]); 
			$motif=trim($row[14]);
			$updated=trim($row[15]);
			$lsmImg="/flycircuitSourceData/NeuronData/".$neuron."/".$neuron."_lsm.png";$lsmResizeImg="/flycircuitSourceData/NeuronData/".$neuron."/".$neuron."_lsmResize.png";
			$neuronImg="/flycircuitSourceData/NeuronData/".$neuron."/".$neuron."_neuron.png";$neuronResizeImg="/flycircuitSourceData/NeuronData/".$neuron."/".$neuron."_neuronResize.png";
			$brainSurfaceImg="/flycircuitSourceData/NeuronData/".$neuron."/".$neuron."_brainSurface.png";$brainSurfaceResizeImg="/flycircuitSourceData/NeuronData/".$neuron."/".$neuron."_brainSurfaceResize.png";
			
			$neuronDetail="<a href=\"modules.php?name=clearpage&op=detail_table&nid=".$idid."\" target=\"_blank\">".$gen." ".$neuron." (".$birthtiming.")</a>";

			$color_user=0;	
			$color_id_tmp="color_".$neuron;
			if ((isset($$color_id_tmp)) && ($$color_id_tmp!="0")){
				$color_user=$$color_id_tmp;
			}			
		}
		if ($color_user!="0"){
			$pathHx="<input name=\"Neuron[]\" type=\"checkbox\" value=\"$idid\" checked=\"checked\">".gene_color($idid,$color_user,0);					
		}else{	
			$selected++;
			$pathHx="<input name=\"Neuron[]\" type=\"checkbox\" value=\"$idid\" checked=\"checked\">".gene_color($idid,$selected,0);		
		}
		$pic="<a href=\"".$lsmImg."\" target=\"_blank\"><img src=\"".$lsmResizeImg."\" border=\"0\"></a>";		
		array_push($recorder_array,$neuronDetail);
		array_push($recorder_array,$pathHx);
		array_push($recorder_array,$pic);	
		array_push($recorder_array,$idid);							
	}		
}

$recorder_num=count($recorder_array);
for($i=0;$i<$recorder_num;$i=$i+8){
	$neuronDetail_1=""; $pathHx_1=""; $pic_1=""; $idid_1="";
	$neuronDetail_2=""; $pathHx_2=""; $pic_2=""; $idid_2="";
	$neuronDetail_1=$recorder_array[$i];
	$pathHx_1=$recorder_array[$i+1];
	$pic_1=$recorder_array[$i+2];	
	$idid_1=$recorder_array[$i+3];	
	if (isset($recorder_array[$i+4])){
		$neuronDetail_2=$recorder_array[$i+4];
		$pathHx_2=$recorder_array[$i+5];
		$pic_2=$recorder_array[$i+6];
		$idid_2=$recorder_array[$i+7];				
	}
	*/
$selectcolor="<select><label>
			<option style='color: #000000; background-color: #FF0000' value='1' class='genmed'>A</option>  
			<option style='color: #000000; background-color: #00CC00' value='2' class='genmed'>B</option>  
			<option style='color: #000000; background-color: #0099CC' value='3' class='genmed'>C</option>  
			<option style='color: #000000; background-color: #990099' value='4' class='genmed'>D</option>  
			<option style='color: #000000; background-color: #FF6600' value='5' class='genmed'>E</option>  
			<option style='color: #000000; background-color: #33FF66' value='6' class='genmed'>F</option>  
			<option style='color: #000000; background-color: #CC3399' value='7' class='genmed'>G</option>  
			<option style='color: #000000; background-color: #0066FF' value='8' class='genmed'>H</option>  
			<option style='color: #000000; background-color: #CC9900' value='9' class='genmed'>I</option>  
			<option style='color: #000000; background-color: #66CCFF' value='10' class='genmed'>J</option>  
			<option style='color: #000000; background-color: #FF9900' value='11' class='genmed'>K</option>  
			<option style='color: #000000; background-color: #CCFF66' value='12' class='genmed'>L</option>  
			<option style='color: #000000; background-color: #FFFF00' value='13' class='genmed'>M</option>  
			<option style='color: #000000; background-color: #FF3399' value='14' class='genmed'>N</option>  
			<option style='color: #000000; background-color: #004400' value='15' class='genmed'>O</option>  
			<option style='color: #000000; background-color: #663300' value='16' class='genmed'>P</option>  
			<option style='color: #000000; background-color: #666666' value='17' class='genmed'>Q</option> 
			</label></select> ";	
?>
<tr>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="2">
	<?php
		if($TEST1=='F')
		{
			for($i=0;$i<count($finalfemaleresult);$i+=2)
			{
				echo"<tr>";
				echo"<td width='50' bgcolor='#FFFFFF'><div align='center'>";
				echo"<input type='checkbox' checked></input>";
					echo"$selectcolor";
				echo"<font color='red' size='+2'>&#9792</font><a target=\"_blank\" href=neuron/neurondetail.php?neuron=".$finalfemaleresult[$i].">";
				echo"$finalfemaleresult[$i]";
				echo"</a></div></td>";
				echo"<td width='50%' bgcolor='#FFFFFF'><div align='center'>";
				$i++;
        if($i<count($finalfemaleresult))
				{
					echo"<input type='checkbox' checked></input>";
					echo"$selectcolor";
					echo"<font color='red' size='+2'>&#9792</font><a target=\"_blank\" href=neuron/neurondetail.php?neuron=".$finalfemaleresult[$i].">";
					echo"$finalfemaleresult[$i]</a>";
				}
        $i--;
				echo"</div></td>";
				echo"</tr>";
				echo"<tr>";
        echo"<td width='50%' bgcolor='#FFFFFF'><div align='center'>";
				echo"<a target=\"_blank\" href=\"neuron/neuronIMG/$finalfemaleresult[$i]/".$finalfemaleresult[$i]."_lsm.png\">";
		    echo"<img src=\"neuron/neuronIMG/$finalfemaleresult[$i]/".$finalfemaleresult[$i]."_lsmResize.png\"></a>";
				echo"</div></td>";
				echo"<td width='50%' bgcolor='#FFFFFF'><div align='center'>";
		    $i++;
        if($i<count($finalfemaleresult))
				{
          echo"<a target=\"_blank\" href=\"neuron/neuronIMG/$finalfemaleresult[$i]/".$finalfemaleresult[$i]."_lsm.png\">";  
				  echo"<img src=\"neuron/neuronIMG/$finalfemaleresult[$i]/".$finalfemaleresult[$i]."_lsmResize.png\"></a>";
        }
        $i--;
				echo"</div></td>";
				echo"</tr>";
			}
		}
		if($TEST1=='M')
		{
			for($i=0;$i<count($finalmaleresult);$i+=2)
			{
				echo"<tr>";
				echo"<td width='50' bgcolor='#FFFFFF'><div align='center'>";
				echo"<input type='checkbox' checked></input>";
					echo"$selectcolor";
				echo"<font color='blue' size='+2'>&#9794</font><a target=\"_blank\" href=neuron/neurondetail.php?neuron=".$finalmaleresult[$i].">";
				echo"$finalmaleresult[$i]";
				echo"</a></div></td>";
				echo"<td width='50%' bgcolor='#FFFFFF'><div align='center'>";
        $i++;
				if($i<count($finalmaleresult))
				{
					echo"<input type='checkbox' checked></input>";
					echo"$selectcolor";
					echo"<font color='blue' size='+2'>&#9794</font><a target=\"_blank\" href=neuron/neurondetail.php?neuron=".$finalmaleresult[$i].">";
					echo"$finalmaleresult[$i]</a>";
				}
        $i--;
				echo"</div></td>";
				echo"</tr>";
				echo"<tr>";
        echo"<td width='50%' bgcolor='#FFFFFF'><div align='center'>";
				echo"<a target=\"_blank\" href=\"neuron/neuronIMG/$finalmaleresult[$i]/".$finalmaleresult[$i]."_lsm.png\">";
		    echo"<img src=\"neuron/neuronIMG/$finalmaleresult[$i]/".$finalmaleresult[$i]."_lsmResize.png\"></a>";
				echo"</div></td>";
				echo"<td width='50%' bgcolor='#FFFFFF'><div align='center'>";
        $i++;
        if($i<count($finalmaleresult))
				{
          echo"<a target=\"_blank\" href=\"neuron/neuronIMG/$finalmaleresult[$i]/".$finalmaleresult[$i]."_lsm.png\">";  
				  echo"<img src=\"neuron/neuronIMG/$finalmaleresult[$i]/".$finalmaleresult[$i]."_lsmResize.png\"></a>";
        }
        $i--;
				echo"</div></td>";
				echo"</tr>";
			}
		}
    ?>
	</table></td>
</tr>

<?php	
//}

?>  
  <tr>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <td bgcolor="#CCCCCC">
          <div align="center"> <br />
	    Visualization options :
          <input name="voltex_on" type="checkbox" id="voltex_on" value="1" checked="checked" />
            Voltex  
  <input name="lineset_on" type="checkbox" id="lineset_on" value="1" />
            Skeleton 
            <select name="lineWidth" id="lineWidth">
              <option value="0.5">0.5</option>
              <option value="1.0">1.0</option>
              <option value="1.5">1.5</option>
              <option value="2.0" selected="selected">2.0</option>
              <option value="2.5">2.5</option>
              <option value="3.0">3.0</option>	
              <option value="3.5">3.5</option>
              <option value="4.0">4.0</option>	
              <option value="4.5">4.5</option>
              <option value="5.0">5.0</option>				  			  		  			  
            </select>
            Skeleton width 
            <input name="soma_on" type="checkbox" id="soma_on" value="1" />
            Constellation 
            <br />
            
             <br>
	     <input name="amira_type" type="radio" value="Submit" onClick="document.amira<?=$genderCheck;?>.action='modules.php?name=clearpage&op=frame_index_redirect_v1';document.amira<?=$genderCheck;?>.target='_blank'" checked="checked"/> 
	     3D-Neuron Viewer
	     <input name="amira_type" type="radio" onClick="document.amira<?=$genderCheck;?>.action='modules.php?name=search&parent=search&op=gene_query_text_base';document.amira<?=$genderCheck;?>.target='_self'" value="Save" />
	     Save ,
		 <select name="userColorSet" id="userColorSet">
<option style="color: #000000; background-color: #FFFFFF" value="0" class="genmed">None color</option>  
<option style="color: #000000; background-color: #FFFFFF" value="18" class="genmed">Default color above</option>  
<option style="color: #000000; background-color: #FF0000" value="1" class="genmed">A</option>  
<option style="color: #000000; background-color: #00CC00" value="2" class="genmed">B</option>  
<option style="color: #000000; background-color: #0099CC" value="3" class="genmed">C</option>  
<option style="color: #000000; background-color: #990099" value="4" class="genmed">D</option>  
<option style="color: #000000; background-color: #FF6600" value="5" class="genmed">E</option>  
<option style="color: #000000; background-color: #33FF66" value="6" class="genmed">F</option>  
<option style="color: #000000; background-color: #CC3399" value="7" class="genmed">G</option>  
<option style="color: #000000; background-color: #0066FF" value="8" class="genmed">H</option>  
<option style="color: #000000; background-color: #CC9900" value="9" class="genmed">I</option>  
<option style="color: #000000; background-color: #66CCFF" value="10" class="genmed">J</option>  
<option style="color: #000000; background-color: #FF9900" value="11" class="genmed">K</option>  
<option style="color: #000000; background-color: #CCFF66" value="12" class="genmed">L</option>  
<option style="color: #000000; background-color: #FFFF00" value="13" class="genmed">M</option>  
<option style="color: #000000; background-color: #FF3399" value="14" class="genmed">N</option>  
<option style="color: #000000; background-color: #004400" value="15" class="genmed">O</option>  
<option style="color: #000000; background-color: #663300" value="16" class="genmed">P</option>  
<option style="color: #000000; background-color: #666666" value="17" class="genmed">Q</option>  
</select> Save Neuron Color <br /><br><font color="#666666">
*Unless you sign up, 3D-Neuron viewer can not display more than 5 pieces of 3D Neuroimaging data.
</font><br>
          </div>
          </td>
        </tr>
    </table></td>

  </tr>

    <tr>
    <td>
    <table width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <td bgcolor="#CCCCCC"><div align="center"><br>
                  <input type="submit" name="Submit_form" class="style102" value="Submit"><br><br></div>
         </td>
        </tr>
    </table>
    
    </td>
  </tr>
</table>
</form>

