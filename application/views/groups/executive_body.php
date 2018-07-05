<div id="executiveBody">
    <h1 style="letter-spacing: -1px;">
        EXECUTIVE BODY - <?php date_default_timezone_set('Asia/Dhaka');echo date("Y");?>
    </h1>
    <b>Groups:</b> <a href = "mailto:duetcomputersociety@googlegroups.com">duetcomputersociety@googlegroups.com</a><br/>
    <b>E-mail:</b> <a href = "mailto:duetcs2010@gmail.com">duetcs2010@gmail.com</a>
    <hr style="border-color: transparent">
    <center>
        <table align="center" width="100%">
            <tr>
                <td colspan="2" style="text-align: center;color: blueviolet;font-size: 20px;font-weight: bold;">
                    Teacher’s Body Member
                </td>
            </tr>
            <tr>
                <td width="30%"><b>Chief Patron :</b></td>
                <td width="70%">
                    <b>Dr. Md. Nasim Akhter</b><br/>Associate Professor & Head, Dept. of CSE.
                </td>
            </tr>
            <tr>
                <td width="30%"><b>Moderator :</b></td>
                <td width="70%">
                    <b>Md. Mahbub Alam</b><br/>Lecturer, CSE.
                </td>
            </tr>
            <tr>
                <td width="30%"><b>Panel of Advisor :</b></td>
                <td width="70%">Faculty Members<br/>Computer Science &AMP; Engineering Department</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;color: blueviolet;font-size: 20px;font-weight: bold;">
                    Student’s Body Member
                </td>
            </tr>
            <tr>
                <td width="30%"><b>President :</b></td>
                <td width="70%">
                    <?php
                         foreach ($group_member as $row) {
                           if($row->Responsibility == 'President')
                           {
                              echo "<b>{$row->Name}</b><br/><b>Email: </b>{$row->Email}<br/><b>Cell no.: </b>{$row->ContractNo}<br/><br/>";
                           }
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="30%"><b>Vice-President :</b></td>
                <td width="70%">
                   <?php
                         foreach ($group_member as $row) {
                           if($row->Responsibility == 'VicePresident')
                           {
                              echo "<b>{$row->Name}</b><br/><b>Email: </b>{$row->Email}<br/><b>Cell no.: </b>{$row->ContractNo}<br/><br/>";
                           }
                        }
                    ?>
            </tr>
            <tr>
                <td width="30%"><b>General Secretary :</b></td>
                <td width="70%">
                    <?php
                         foreach ($group_member as $row) {
                           if($row->Responsibility == 'GeneralSecretary')
                           {
                              echo "<b>{$row->Name}</b><br/><b>Email: </b>{$row->Email}<br/><b>Cell no.: </b>{$row->ContractNo}<br/><br/>";
                           }
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="30%"><b>Assistant General Secretary :</b></td>
                <td width="70%">
                    <?php
                         foreach ($group_member as $row) {
                           if($row->Responsibility == 'AssGeneralSecretary')
                           {
                              echo "<b>{$row->Name}</b><br/><b>Email: </b>{$row->Email}<br/><b>Cell no.: </b>{$row->ContractNo}<br/><br/>";
                           }
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="30%"><b>Finance Director:</b></td>
                <td width="70%">
                    <?php
                         foreach ($group_member as $row) {
                           if($row->Responsibility == 'Finance')
                           {
                              echo "<b>{$row->Name}</b><br/><b>Email: </b>{$row->Email}<br/><b>Cell no.: </b>{$row->ContractNo}<br/><br/>";
                           }
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="30%"><b>Additional Finance Director:</b></td>
                <td width="70%">
                    <?php
                         foreach ($group_member as $row) {
                           if($row->Responsibility == 'AFinance')
                           {
                              echo "<b>{$row->Name}</b><br/><b>Email: </b>{$row->Email}<br/><b>Cell no.: </b>{$row->ContractNo}<br/><br/>";
                           }
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;color: blueviolet;font-size: 20px;font-weight: bold;">
                    COMMITTEE DIRECTORS
                </td>
            </tr>
            
           <tr>
                <td width="50%" align="center">
                <table class="pa">
                    <tr><th style="text-align: center;color: blue;font-size: 16px;font-weight: bold;border-bottom: 1px solid black;">Programming & Algorithms:</th></tr>
                    <?php
                        foreach ($group_member as $row) {
                            if($row->GroupId == 'G01'){
                                if($row->Responsibility == 'SectionChief')
                                {
                                    echo '<tr><td><b>'.$row->Name.'(<span style="color:#FF0000">Chief</span>)</b><br/>Email :'.$row->Email.'<br/>Contact No :'.$row->ContractNo.'</td></tr>';
                                }
                                else
                                {
                                    echo '<tr><td><b>'.$row->Name.'</b><br/>Email :'.$row->Email.'<br/>Contract No :'.$row->ContractNo.'</td></tr>';
                                }
                            }
                        }
                    ?>
                </table>
                </td>
                <td width="50%" align="center">
                <table class="ap">
                    <tr><th style="text-align: center;color: blue;font-size: 16px;font-weight: bold;border-bottom: 1px solid black;">Application & Project:</th></tr>
                    <?php
                        foreach ($group_member as $row) {
                            if($row->GroupId == 'G02'){
                                if($row->Responsibility == 'SectionChief')
                                {
                                    echo '<tr><td><b>'.$row->Name.'(<span style="color:#FF0000">Chief</span>)</b><br/>Email :'.$row->Email.'<br/>Contact No :'.$row->ContractNo.'</td></tr>';
                                }
                                else
                                {
                                    echo '<tr><td><b>'.$row->Name.'</b><br/>Email :'.$row->Email.'<br/>Contact No :'.$row->ContractNo.'</td></tr>';
                                }
                            }
                        }
                    ?>
                </table>
                </td>
            </tr>
            
            <tr>
                <td width="50%" align="center">
                <table class="nc">
                    <tr><th style="text-align: center;color: blue;font-size: 16px;font-weight: bold;border-bottom: 1px solid black;">Network & Communication:</th></tr>
                    <?php
                        foreach ($group_member as $row) {
                            if($row->GroupId == 'G03'){
                                if($row->Responsibility == 'SectionChief')
                                {
                                    echo '<tr><td><b>'.$row->Name.'(<span style="color:#FF0000">Chief</span>)</b><br/>Email :'.$row->Email.'<br/>Contact No :'.$row->ContractNo.'</td></tr>';
                                }
                                else
                                {
                                    echo '<tr><td><b>'.$row->Name.'</b><br/>Email :'.$row->Email.'<br/>Contact No :'.$row->ContractNo.'</td></tr>';
                                }
                            }
                        }
                    ?>
                </table>
                </td>
                <td width="50%" align="center">
                <table class="mg">
                    <tr><th style="text-align: center;color: blue;font-size: 16px;font-weight: bold;border-bottom: 1px solid black;">Multimedia & Gaming:</th></tr>
                    <?php
                        foreach ($group_member as $row) {
                            if($row->GroupId == 'G04'){
                                if($row->Responsibility == 'SectionChief')
                                {
                                    echo '<tr><td><b>'.$row->Name.'(<span style="color:#FF0000">Chief</span>)</b><br/>Email :'.$row->Email.'<br/>Contact No :'.$row->ContractNo.'</td></tr>';
                                }
                                else
                                {
                                    echo '<tr><td><b>'.$row->Name.'</b><br/>Email :'.$row->Email.'<br/>Contact No :'.$row->ContractNo.'</td></tr>';
                                }
                            }
                        }
                    ?>
                </table>
                </td>
            </tr>
            
            <tr>
                <td width="50%" align="center">
                <table class="ca">
                    <tr><th style="text-align: center;color: blue;font-size: 16px;font-weight: bold;border-bottom: 1px solid black;">Co-Curricular activities:</th></tr>
                    <?php
                        foreach ($group_member as $row) {
                            if($row->GroupId == 'G05'){
                                if($row->Responsibility == 'SectionChief')
                                {
                                    echo '<tr><td><b>'.$row->Name.'(<span style="color:#FF0000">Chief</span>)</b><br/>Email :'.$row->Email.'<br/>Contact No :'.$row->ContractNo.'</td></tr>';
                                }
                                else
                                {
                                    echo '<tr><td><b>'.$row->Name.'</b><br/>Email :'.$row->Email.'<br/>Contact No :'.$row->ContractNo.'</td></tr>';
                                }
                            }
                        }
                    ?>
                </table>
                </td>
                <td width="50%" align="center">
                <table class="lp">
                    <tr><th style="text-align: center;color: blue;font-size: 16px;font-weight: bold;border-bottom: 1px solid black;">Li-aison & Publications:</th></tr>
                    <?php
                        foreach ($group_member as $row) {
                            if($row->GroupId == 'G06'){
                                if($row->Responsibility == 'SectionChief')
                                {
                                    echo '<tr><td><b>'.$row->Name.'(<span style="color:#FF0000">Chief</span>)</b><br/>Email :'.$row->Email.'<br/>Contact No :'.$row->ContractNo.'</td></tr>';
                                }
                                else
                                {
                                    echo '<tr><td><b>'.$row->Name.'</b><br/>Email :'.$row->Email.'<br/>Contact No :'.$row->ContractNo.'</td></tr>';
                                }
                            }
                        }
                    ?>
                </table>
                </td>
            </tr>
        </table>
    </center>
</div>
