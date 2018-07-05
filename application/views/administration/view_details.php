<div align="center">
    <table class="stdInfoTable">
       <?php
           $bgcolor = '#FFCCCC';
           foreach($stdTable[0] as $key => $value){
                   echo "<tr bgcolor=\"$bgcolor\"><td>".$key.'</td><td>'.$value.'</td></tr>';
                   $bgcolor = ($bgcolor == '#FFCCCC')? '#99FF66':'#FFCCCC';
           }
       ?>
    </table>
    <a href="javascript:window.history.go(-1);" style="text-decoration:none"><< Go back</a>
</div>
