<?php
function gene_color($gene_num,$select,$user_check){
	include("dro_config.php");
	if ($user_check==1){
	$colormap="user_";
	}else{
	$colormap="";
	}
	$select=($select-1)%17+1;
	
	if ($select==1) $select_1=' selected="selected"';
	if ($select==2) $select_2=' selected="selected"';
	if ($select==3) $select_3=' selected="selected"';
	if ($select==4) $select_4=' selected="selected"';
	if ($select==5) $select_5=' selected="selected"';
	if ($select==6) $select_6=' selected="selected"';
	if ($select==7) $select_7=' selected="selected"';
	if ($select==8) $select_8=' selected="selected"';
	if ($select==9) $select_9=' selected="selected"';
	if ($select==10) $select_10=' selected="selected"';
	if ($select==11) $select_11=' selected="selected"';
	if ($select==12) $select_12=' selected="selected"';
	if ($select==13) $select_13=' selected="selected"';
	if ($select==14) $select_14=' selected="selected"';
	if ($select==15) $select_15=' selected="selected"';
	if ($select==16) $select_16=' selected="selected"';
	if ($select==17) $select_17=' selected="selected"';

	$color_result="\n<select name=\"".$colormap."Colormap_".$gene_num."\">\n"
		."<option style=\"color: #000000; background-color: #FF0000\" value=\"1\" class=\"genmed\" ".$select_1.">A</option>\n"  
		."<option style=\"color: #000000; background-color: #00CC00\" value=\"2\" class=\"genmed\" ".$select_2.">B</option>\n"  
		."<option style=\"color: #000000; background-color: #0099CC\" value=\"3\" class=\"genmed\" ".$select_3.">C</option>\n"  
		."<option style=\"color: #000000; background-color: #990099\" value=\"4\" class=\"genmed\" ".$select_4.">D</option>\n"  
		."<option style=\"color: #000000; background-color: #FF6600\" value=\"5\" class=\"genmed\" ".$select_5.">E</option>\n"  
		."<option style=\"color: #000000; background-color: #33FF66\" value=\"6\" class=\"genmed\" ".$select_6.">F</option>\n"  
		."<option style=\"color: #000000; background-color: #CC3399\" value=\"7\" class=\"genmed\" ".$select_7.">G</option>\n"  
		."<option style=\"color: #000000; background-color: #0066FF\" value=\"8\" class=\"genmed\" ".$select_8.">H</option>\n"  
		."<option style=\"color: #000000; background-color: #CC9900\" value=\"9\" class=\"genmed\" ".$select_9.">I</option>\n"  
		."<option style=\"color: #000000; background-color: #66CCFF\" value=\"10\" class=\"genmed\" ".$select_10.">J</option>\n"  
		."<option style=\"color: #000000; background-color: #FF9900\" value=\"11\" class=\"genmed\" ".$select_11.">K</option>\n"  
		."<option style=\"color: #000000; background-color: #CCFF66\" value=\"12\" class=\"genmed\" ".$select_12.">L</option>\n"  
		."<option style=\"color: #000000; background-color: #FFFF00\" value=\"13\" class=\"genmed\" ".$select_13.">M</option>\n"  
		."<option style=\"color: #000000; background-color: #FF3399\" value=\"14\" class=\"genmed\" ".$select_14.">N</option>\n"  
		."<option style=\"color: #000000; background-color: #004400\" value=\"15\" class=\"genmed\" ".$select_15.">O</option>\n"  
		."<option style=\"color: #000000; background-color: #663300\" value=\"16\" class=\"genmed\" ".$select_16.">P</option>\n"  
		."<option style=\"color: #000000; background-color: #666666\" value=\"17\" class=\"genmed\" ".$select_17.">Q</option>\n"  

		."</select>\n";
	
	return $color_result;
}
?>
