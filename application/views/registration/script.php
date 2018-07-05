<!--Load address for selecting Resident-->
<script type="text/javascript">
    $("input[name='resident']").click(function(){
        var resident = $(this).val();
        if(resident == 'yes'){
            var address = '<td width="32%" align="right" bgcolor="#E0F0E8"><span style="color:#FF0000">*</span>Resident Hall</td>'
            address += '<td width="36%"><select name="hallName" id="hallName" class="input">';
            address += '<option value="Dr. Fazlur Rahman Khan Hall">Dr. Fazlur Rahman Khan Hall</option>';
            address += '<option value="Dr. Qudrat-E-Khuda Hall">Dr. Qudrat-E-Khuda Hall</option>';
            address += '<option value="Kazi Nazrul Islam Hall">Kazi Nazrul Islam Hall</option>';
            address += '<option value="Shahid Muktijodda Hall">Shahid Muktijodda Hall</option>';
            address += '<option value="Madam Curie Hall">Madam Curie Hall</option>';
            address += '<option value="Shaheed Tajuddin Ahmad Hall">Shaheed Tajuddin Ahmad Hall</option>';
            address += '</td>';
            address += '<td width="12%" align="right" bgcolor="#E0F0E8"><span style="color:#FF0000">*</span>Room #</td>';
            address += '<td width="20%" colspan="2"><input type="text" name="roomNo" id="roomNo" class="input" style="width:97%"></td>';
            $('#address').html(address);
        }else{
            var address = '<td align="right" bgcolor="#E0F0E8"><span style="color:#FF0000">*</span>Present Address</td>';
            address += '<td colspan="4"><textarea style="width: 99%;" class="input" cols="45" rows="5" name="presentAddresst" id="presentAddresst"></textarea></td>';
            $('#address').html(address);
        }
    });
    $("input[name='agree']").on('click',function(){
    if($("input[name='agree']").is(':checked')){
            $("input[name='createAcc']").attr('disabled',false);
        }else{
            $("input[name='createAcc']").attr('disabled',true);
        }
    });
    function check_checked_radio(){
        var checked_count =0;
        var chkRadio = document.frmRegistration.chkGroups;
        //checked_count = $(chkRadio+':checked').length -1;
        for (i = chkRadio.length-1; i >= 0; i--)
        {
            if(chkRadio[i].checked == true)
            {
                checked_count++;
            }
        }
        
        if(checked_count >2)
        {
            alert('You can select maximum two field !');
            for (i = chkRadio.length-1; i >= 0; i--)
            {
                chkRadio[i].checked = false;
            }
            chkRadio[0].checked = true;
        }
    }
</script>