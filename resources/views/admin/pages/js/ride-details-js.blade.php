<script>
    $(document).ready(function(){
        $(document).on('change','#format-selector',function (e) {
            e.preventDefault();
            alert(this.value);
            if(this.value == 'Daily'){
                $('#picker').html('<div class="view-ridemate-profile-popup" id="dailypicker01"></div>');
                $('#dailypicker01').datetimepicker({
                    inline: true,
                    format: 'DD',
                    viewMode: 'days',
                });
            }
            if(this.value == 'Weekly'){
                $('#picker').html('<div class="view-ridemate-profile-popup" id="dailypicker02"></div><div id="week-start"></div>');
                var dateText = '<?php echo date("m/d/Y");?>',
                    display = $('#week-start');
                display.text(dateText);
                $('#dailypicker02').weekpicker({
                    currentText: dateText,
                    onSelect: function(dateText, startDateText, startDate, endDate, inst) {
                        display.text(startDateText);
                        //alert(startDate.toISOString().split('T')[0]);
                        //alert(endDate.toISOString().split('T')[0]);
                    }
                });
            }
            if(this.value == 'Monthly'){
                $('#picker').html('<div class="view-ridemate-profile-popup" id="dailypicker03"></div>');
                $('#dailypicker03').datetimepicker({
                    inline: true,
                    format: 'MM',
                    viewMode: 'months'
                });
            }
            if(this.value == 'Yearly'){
                $('#picker').html('<div class="view-ridemate-profile-popup" id="dailypicker04"></div>');
                $('#dailypicker04').datetimepicker({
                    inline: true,
                    format: 'YYYY',
                    viewMode: 'years'
                });
            }
        });
        $(document).on('change','#format-selector-req',function (e) {
            e.preventDefault();
            if(this.value == 'Daily'){
                $('#picker-req').html('<div class="view-ridemate-profile-popup" id="dailypicker01"></div>');
                $('#dailypicker01').datetimepicker({
                    inline: true,
                    format: 'DD',
                    viewMode: 'days',
                });
            }
            if(this.value == 'Weekly'){
                $('#picker-req').html('<div class="view-ridemate-profile-popup" id="dailypicker02"></div><div id="week-start"></div>');
                var dateText = '<?php echo date("m/d/Y");?>',
                    display = $('#week-start');
                display.text(dateText);
                $('#dailypicker02').weekpicker({
                    currentText: dateText,
                    onSelect: function(dateText, startDateText, startDate, endDate, inst) {
                        display.text(startDateText);
                        //alert(startDate.toISOString().split('T')[0]);
                        //alert(endDate.toISOString().split('T')[0]);
                    }
                });
            }
            if(this.value == 'Monthly'){
                $('#picker-req').html('<div class="view-ridemate-profile-popup" id="dailypicker03"></div>');
                $('#dailypicker03').datetimepicker({
                    inline: true,
                    format: 'MM',
                    viewMode: 'months'
                });
            }
            if(this.value == 'Yearly'){
                $('#picker-req').html('<div class="view-ridemate-profile-popup" id="dailypicker04"></div>');
                $('#dailypicker04').datetimepicker({
                    inline: true,
                    format: 'YYYY',
                    viewMode: 'years'
                });
            }
        });
    });
</script>