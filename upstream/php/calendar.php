<?PHP
$Kategorie = REX_VALUE[1];
$anzeigeArt = REX_VALUE[2];
//Ab hier bitte keine Änderungen vornehmen -> Konfiguration der Darstellung über CSS
$katText = "";
if ($Kategorie != "alle"){ $katText = "AND KategorieTitel='".$Kategorie."' "; }
$sqlConn = new rex_sql();
$sql  = "SELECT * FROM ".$REX['TABLE_PREFIX']."calendar_"."events ";
$sql .= "WHERE Datum>='".date('Y-m-d')."' ".$katText;

$sql .= "ORDER BY Datum, ID";

$Termine = $sqlConn->getArray($sql);

$AktDatum = date("d.m.Y");
$tstamp  = mktime(0, 0, 0, date("m")-1, date("d"), date("Y"));
$letztermonat = date("d.m.Y", $tstamp);

$existTermine = array();

foreach($Termine as $termin){
   $thisDate = explode("-",$termin['Datum']);
   $Datum = $thisDate[2].".".$thisDate[1].".".$thisDate[0];

   $EndDate = explode("-",$termin['EndDatum']);
   $EndDatum = $EndDate[2].".".$EndDate[1].".".$EndDate[0];

   $zeit = "";
   if ($termin['Start'] != ""){
      $zeit = $termin['Start'];
      if ($termin['Ende'] != ""){
         $zeit .= "-".$termin['Ende'];
      }
   }

   $aktTitel = $termin['Titel'];
   $aktTermin = [$zeit, $aktTitel];
   if (in_array($aktTermin, $existTermine)) {
     continue;
   } else {
     $existTermine[] = $aktTermin;
   }

   if ($anzeigeArt == 1){ /* ohne Bild */

      echo '<div id="termin">';

      if ($AktDatum == $Datum) {
         echo '<img src="files/images/pfeil_01.png" alt="Termin Heute " title="Termin Heute ">';
      }
      else {
         echo '<img src="files/images/pfeil_01.png" alt="Termin " title="veralteter Termin ">';
      }

      echo '<b>'.$Datum.'</b>';
      if ($EndDatum == '' or $EndDatum == "00.00.0000") {}
      else { echo ' – <b>'.$EndDatum.'</b>';}

      if ($zeit == '') {}
      else { echo ' | <b>'.$zeit.'</b> Uhr';}

      echo ' | ';
      echo '<span id="terminTitel"><b>'.$termin['Titel'].'</b> ('.$termin['KategorieTitel'].')</span><br />';

      echo '</div>';
      echo '<div id="terminSatz">';

      echo $termin['Beschreibung'].'<br /><br />';
      if ($termin['Link'] != ""){
         echo '<div id="download" class="klein"><b>Link</b><img src="files/images/pfeil_02.png"><a href="'.$termin['Link'].'" target="_blank" border="0"> '.$termin['Link'].'</a></div>';
      }
      echo '<div class="klein"><b>Veranstaltungsort</b><img src="files/images/pfeil_02.png"> '.$termin['VOrt'].'</div>';
      if ($termin['AlterA'] != "" && $termin['AlterE'] != "") {
         echo '<div class="klein"><b>Alter</b><img src="files/images/pfeil_02.png"> '.$termin['AlterA'].' bis '.$termin['AlterE'].' Jahre</div>';
      } else if ($termin['AlterA'] != "") {
         echo '<div class="klein"><b>Alter</b><img src="files/images/pfeil_02.png"> '.$termin['AlterA'].' Jahren</div>';
      }
      if ($termin['Teilnehmer'] != "") {
         echo '<div class="klein"><b>Teilnehmer</b><img src="files/images/pfeil_02.png"> '.$termin['Teilnehmer'].' Pers.</div>';
      }
      if ($termin['Kosten'] != "") {
         echo '<div class="klein"><b>Preis</b><img src="files/images/pfeil_02.png"> '.$termin['Kosten'].',-€ | '.$termin['KostenM'].',-€ (für Mitglieder)</div>';
      }
      echo '</div>';
      echo '<div class="clear"></div>';
      echo '<hr><br />';

      }

      if ($anzeigeArt == 2){ /* Bild links */

         echo '<div id="termin">';

         if ($AktDatum == $Datum) {
            echo '<img src="files/images/pfeil_01.png" alt="Termin Heute " title="Termin Heute ">';
         }
         else {
            echo '<img src="files/images/pfeil_01.png" alt="Termin " title="veralteter Termin ">';
         }


         echo '<b>'.$Datum.'</b>';
         if ($EndDatum == '' or $EndDatum == "00.00.0000") {}
            else {echo ' – <b>'.$EndDatum.'</b>';	}

            if ($zeit == '') {}
               else {echo ' | <b>'.$zeit.'</b> Uhr';}

               echo ' | ';
               echo '<span id="terminTitel"><b>'.$termin['Titel'].'</b> ('.$termin['KategorieTitel'].')</span><br />';
               echo '</div>';

               echo '<div id="terminBildLinks">';
               if ($termin['Image'] != ""){
                  echo '<img src="./files/'.$termin['Image'].'" vspace=5 hspace=5 align=left width=200px>';
               }
               if ($termin['Beschreibung'] != ""){echo $termin['Beschreibung'].'<br /><br />';}
               if ($termin['Link'] != ""){
                  echo '<div id="download" class="klein"><b>Link</b><img src="files/images/pfeil_02.png"><a href="'.$termin['Link'].'" target="_blank" border="0"> '.$termin['Link'].'</a></div>';
               }
               if($termin['VOrt'] != "") {echo '<div class="klein"><b>Veranstaltungsort</b><img src="files/images/pfeil_02.png"> '.$termin['VOrt'].'</div>';}


               if ($termin['AlterA'] !=  $termin['AlterE'] && $termin['AlterE'] != "")
               {echo '<div class="klein"><b>Alter</b><img src="files/images/pfeil_02.png"> '.$termin['AlterA'].' bis '.$termin['AlterE'].' Jahre</div>';}
               else if ($termin['AlterA'] != $termin['AlterE'] && $termin['AlterE'] == "")
               {echo '<div class="klein"><b>Alter</b><img src="files/images/pfeil_02.png"> '.$termin['AlterA'].' Jahren</div>';}
               elseif ($termin['AlterA'] ==  $termin['AlterE'] and $termin['AlterA']>='0')
               {echo '<div class="klein"><b>Alter</b><img src="files/images/pfeil_02.png"> '.$termin['AlterA'].' Jahren</div>';}
               else
               {echo '<div class="klein">keine Altersangabe</div>';}

               if($termin['Teilnehmer'] != "") {echo '<div class="klein"><b>Teilnehmer</b><img src="files/images/pfeil_02.png"> '.$termin['Teilnehmer'].' Pers.</div>';}
               if($termin['Kosten'] != "" || $termin['KostenM'] != "") {echo '<div class="klein"><b>Preis</b><img src="files/images/pfeil_02.png"> '.$termin['Kosten'].',-€ | '.$termin['KostenM'].',-€ (für Mitglieder)</div>';}
               echo '</div>';
               echo '<div class="clear"></div>';
               echo '<hr><br />';
            }


         if ($anzeigeArt == 3){  /* Bild rechts */

            echo '<div id="termin">';

            if ($AktDatum == $Datum) {
               echo '<img src="files/images/pfeil_01.png" alt="Termin Heute " title="Termin Heute ">';
            }
            else {echo '<img src="files/images/pfeil_01.png" alt="Termin " title="veralteter Termin ">';}

            echo '<b>'.$Datum.'</b>';
            if ($EndDatum == '' or $EndDatum == "00.00.0000") {}
               else { echo ' – <b>'.$EndDatum.'</b>';	}

               if ($zeit == '') {}
                  else { echo ' | <b>'.$zeit.'</b> Uhr'; }

                  echo ' | ';
                  echo '<span id="terminTitel"><b>'.$termin['Titel'].'</b> ('.$termin['KategorieTitel'].')</span><br />';

                  echo '</div>';
                  echo '<div id="terminBildRechts">';
                  if ($termin['Image'] != ""){ echo '<img src="./files/'.$termin['Image'].'" vspace=5 hspace=5 align=right width=200px>'; }
                  if ($termin['Beschreibung'] != ""){ echo $termin['Beschreibung'].'<br /><br />'; }
                  if ($termin['Link'] != ""){ echo '<div id="download" class="klein"><b>Link</b><img src="files/images/pfeil_02.png"><a href="'.$termin['Link'].'" target="_blank" border="0"> '.$termin['Link'].'</a></div>'; }
                  if($termin['VOrt'] != "") { echo '<div class="klein"><b>Veranstaltungsort</b><img src="files/images/pfeil_02.png"> '.$termin['VOrt'].'</div>'; }
                  if($termin['AlterA'] != "" && $termin['AlterE'] != "") { echo '<div class="klein"><b>Alter</b><img src="files/images/pfeil_02.png"> '.$termin['AlterA'].' bis '.$termin['AlterE'].' Jahre</div>'; }
                  else if ($termin['AlterA'] != "") { echo '<div class="klein"><b>Alter</b><img src="files/images/pfeil_02.png"> '.$termin['AlterA'].' Jahren</div>'; }
                  if($termin['Teilnehmer'] != "") { echo '<div class="klein"><b>Teilnehmer</b><img src="files/images/pfeil_02.png"> '.$termin['Teilnehmer'].' Pers.</div>'; }
                  if($termin['Kosten'] != "" || $termin['KostenM'] != "") { echo '<div class="klein"><b>Preis</b><img src="files/images/pfeil_02.png"> '.$termin['Kosten'].',-€ | '.$termin['KostenM'].',-€ (für Mitglieder)</div>'; }
                  echo '</div>';
                  echo '<div class="clear"></div>';
                  echo '<hr><br />';

      }

}
?>
