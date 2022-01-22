<DOCTYPE html>
<html>
  <head>
      <title>Hotel</title>
  </head>
  <body>


<form name="search" method="GET" action="<?= site_url("ReservationController/reserve") ?>">
    <input type="hidden" name="controller" value="Reservation"/>
    <input type="hidden" name="akcija" value="reserve"/>
    <table>
        <tr>
            <td>Naziv:</td>
            <td><input type="text" required name="naziv" value=""/></td>
        </tr>
        <tr>
            <td>Grad:</td>
            <td>
                <select name="grad">
                    <option value=''>Izaberite grad</option>
                <?php
                if(!empty($gradovi)){
                    foreach ($gradovi as $grad){
                        echo "<option value='{$grad->getPostbr()}'>{$grad->getPostbr()} {$grad->getNaziv()}</option>";
                    }
                }
                ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Datum pocetka:</td>
            <td>
                <input type='date' required name='datumPocetka'/>
            </td>
        </tr>
        <tr>
            <td>Datum kraja:</td>
            <td>
                <input type='date' required name='datumKraja'/>
            </td>
        </tr>
        
        <tr>
            <td>Tip sobe:</td>
            <td>
                <input type="radio" name="tip" value="standardna" id="standardna">
                <label for="standardna"/>Standardna</label>
                <input type="radio" name="tip" value="luks" id="luks">
                <label for="luks"/>Luks</label>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" name="Rezervisi" value="Rezervisi"/>
            </td>
        </tr>
    </table>
</form>
<br>
<?php
if(!empty($poruka)){
    echo $poruka;
}

?>
 
        
        
         <footer align="center">
      Copyright &#169; ETF 13S113PSI, 2021
    </footer>
  <body>
<html>