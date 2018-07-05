<div id="allMember" align="center">
    <table border="1" width="100%">
        <tr><td class="heading">Programming & Algorithms Group</td></tr>
        <tr><td>
                <ol start="1">
                    <?php
                        foreach ($group_member as $row) {
                            if($row->GroupId == 'G01'){
                                echo '<li>'.$row->Name.' ('.$row->StudentId.')'.br();
                            }
                        }
                    ?>
                </ol>
        </td></tr>
        <tr><td class="heading">Application & Project Group</td></tr>
        <tr><td>
                <ol start="1">
                    <?php
                        foreach ($group_member as $row) {
                            if($row->GroupId == 'G02'){
                                echo '<li>'.$row->Name.' ('.$row->StudentId.')'.br();
                            }
                        }
                    ?>
                </ol>
        </td></tr>
        <tr><td class="heading">Network & Communication Group</td></tr>
        <tr><td>
                <ol start="1">
                    <?php
                        foreach ($group_member as $row) {
                            if($row->GroupId == 'G03'){
                                echo '<li>'.$row->Name.' ('.$row->StudentId.')'.br();
                            }
                        }
                    ?>
                </ol>
        </td></tr>
        <tr><td class="heading">Multimedia & Gaming Group</td></tr>
        <tr><td>
                <ol start="1">
                    <?php
                        foreach ($group_member as $row) {
                            if($row->GroupId == 'G04'){
                                echo '<li>'.$row->Name.' ('.$row->StudentId.')'.br();
                            }
                        }
                    ?>
                </ol>
        </td></tr>
        <tr><td class="heading">Co-Curricular activities Group</td></tr>
        <tr><td>
                <ol start="1">
                    <?php
                        foreach ($group_member as $row) {
                            if($row->GroupId == 'G05'){
                                echo '<li>'.$row->Name.' ('.$row->StudentId.')'.br();
                            }
                        }
                    ?>
                </ol>
        </td></tr>
        <tr><td class="heading">Li-aison & Publications Group</td></tr>
        <tr><td>
                <ol start="1">
                    <?php
                        foreach ($group_member as $row) {
                            if($row->GroupId == 'G06'){
                                echo '<li>'.$row->Name.' ('.$row->StudentId.')'.br();
                            }
                        }
                    ?>
                </ol>
        </td></tr>
    </table>
</div>