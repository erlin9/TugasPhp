		<?php
		/*********************************************************************
		script kalender ini tidak dilindungi dengan hak cipta
		bebas disebarluaskan dan dimodifikasi oleh siapapun

		Safartantio,2002
		************************************************************************/

		define ('ADAY', (60*60*24));
		$datearray = getdate();
		$month = $datearray['mon'];
		$year = $datearray['year'];

		$start= mktime(0,0,0,$month,1,$year);
		$firstdayarray = getdate($start);

		$months =array('January'=>'JANUARI','February'=>'FEBRUARI','March'=>'MARET','April'=>'APRIL','May'=>'MEI','June'=>'JUNI','July'=>'JULI','August'=>'AGUSTUS','September'=>'SEPT','October'=>'OKTOBER','November'=>'NOVEMBER','December'=>'DESEMBER');
		$days = array('M','S','S','R','K','J','S');
		
		$Y = date("Y");
		$m = date("m");
		$d = date("d");
		$hari = array('Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu');
		// w adalah 0-6 utk hari minggu sampai sabtu
		$w=$hari[date("w",mktime(0,0,0,$m,$d,$Y))];

		?><body bgcolor="#FFFFFF">
     	<table width="100%" border=0 align="center" style="border:solid 0px #4D2702;cursor:default">
  				<tr> 
    				<td colspan="7" bordercolor="ffffff" > 
    					<div align="center">
    						<font color="#ff0000">
    						<font size="1pt">
							<i>
							
       						<? 
	  								//echo $months[$datearray[month]]." $year";
	  								echo $w.","." ".$d." ".$months[$datearray[month]]." $year";//tanggal,bulan,tahun
	  		 				?>
							</i>
        					</font>
        					</font>
        				</div>
        			</td>
  				</tr>
  				<?
				foreach($days as $day)
				{
					?>
  					<td bordercolor="ffffff"> 
  						<div align="center">
  							<font color="#000000">
								<font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
      								<?echo"$day";?> 
      							</font>
      						</font>
      					</div>
      				</td>
 					<?
				}
				for( $count=0;$count<(6*7);$count++)
				{
					$dayarray = getdate($start);
					if((($count) % 7) == 0)
					{
						if($dayarray['mon'] != $datearray['mon'])
						break;
						echo "</tr><tr>";
					}
					if($count < $firstdayarray['wday'] || $dayarray['mon'] != $month)
					{
						echo "<td bordercolor=ffffff><br></td>";
					}
					else
					{
						if($dayarray['mday'] == $datearray['mday'])
						{
							?>
  							<td> 
  								<div align="center">
  								<strong><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#CC0000"> 
      							<u> <? echo "$dayarray[mday]";?></u> 
      							</font>
      							</strong>
      							</div>
      						</td>
  							<?
							$start += ADAY;
						}
						else
						{
							?>
  							<td bordercolor="ffffff"> 
  								<div align="center">
  								<font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
      							<? echo "$dayarray[mday]";?> 
      							</font>
      							</div>
      						</td>
  							<?
							$start += ADAY;
						}
					}
				}
				?>
				</tr>
			</table>