<script>
    $(document).ready(function(){
        $(document).on('change','#format-selector',function (e) {
            e.preventDefault();
            if(this.value == 'Daily'){
                $('#search-mode').val('d');
                $('#picker').html('<div class="view-ridemate-profile-popup" id="dailypicker01"></div>');
                $('#dailypicker01').datetimepicker({
                    inline: true,
                    format: 'DD',
                    viewMode: 'days',
                });
                $('#rides-date').val(('#dailypicker01').find(".active").data("day"));
                $('#dailypicker01').on('dp.change', function(ev){
                    ev.preventDefault();
                    $('#rides-date').val($(this).find(".active").data("day"));
                });
            }
            if(this.value == 'Weekly'){
                $('#search-mode').val('w');
                $('#picker').html('<div class="view-ridemate-profile-popup" id="dailypicker02"></div><div id="week-start"></div>');
                var dateText = '<?php echo date("m/d/Y");?>',
                    display = $('#week-start');
                display.text(dateText);
                $('#dailypicker02').weekpicker({
                    currentText: dateText,
                    onSelect: function(dateText, startDateText, startDate, endDate, inst) {
                        display.text(startDateText);
                        $('#start-date').val(startDate.toISOString().split('T')[0]);
                        $('#end-date').val(endDate.toISOString().split('T')[0]);
                    }
                });
            }
            if(this.value == 'Monthly'){
                $('#search-mode').val('m');
                $('#picker').html('<div class="view-ridemate-profile-popup" id="dailypicker03"></div>');
                $('#dailypicker03').datetimepicker({
                    inline: true,
                    format: 'MM',
                    viewMode: 'months'
                });
                $('#rides-date').val(('#dailypicker03').find(".active").data("day"));
                $('#dailypicker03').on('dp.change', function(ev){
                    ev.preventDefault();
                    $('#rides-date').val($(this).find(".active").data("day"));
                });
            }
            if(this.value == 'Yearly'){
                $('#search-mode').val('y');
                $('#picker').html('<div class="view-ridemate-profile-popup" id="dailypicker04"></div>');
                $('#dailypicker04').datetimepicker({
                    inline: true,
                    format: 'YYYY',
                    viewMode: 'years'
                });
                $('#rides-date').val(('#dailypicker04').find(".active").data("day"));
                $('#dailypicker04').on('dp.change', function(ev){
                    ev.preventDefault();
                    $('#rides-date').val($(this).find(".active").data("day"));
                });
            }
        });
        $(document).on('change','#format-selector-req',function (e) {
            e.preventDefault();
            if(this.value == 'Daily'){
                $('#search-mode-req').val('rd');
                $('#picker-req').html('<div class="view-ridemate-profile-popup" id="dailypicker01"></div>');
                $('#dailypicker01').datetimepicker({
                    inline: true,
                    format: 'DD',
                    viewMode: 'days',
                });
                $('#rides-date-req').val(('#dailypicker01').find(".active").data("day"));
                $('#dailypicker01').on('dp.change', function(ev){
                    ev.preventDefault();
                    $('#rides-date-req').val($(this).find(".active").data("day"));
                });
            }
            if(this.value == 'Weekly'){
                $('#search-mode-req').val('rw');
                $('#picker-req').html('<div class="view-ridemate-profile-popup" id="dailypicker02"></div><div id="week-start"></div>');
                var dateText = '<?php echo date("m/d/Y");?>',
                    display = $('#week-start');
                display.text(dateText);
                $('#dailypicker02').weekpicker({
                    currentText: dateText,
                    onSelect: function(dateText, startDateText, startDate, endDate, inst) {
                        display.text(startDateText);
                        $('#start-date-req').val(startDate.toISOString().split('T')[0]);
                        $('#end-date-req').val(endDate.toISOString().split('T')[0]);
                    }
                });
            }
            if(this.value == 'Monthly'){
                $('#search-mode-req').val('rm');
                $('#picker-req').html('<div class="view-ridemate-profile-popup" id="dailypicker03"></div>');
                $('#dailypicker03').datetimepicker({
                    inline: true,
                    format: 'MM',
                    viewMode: 'months'
                });
                $('#rides-date-req').val(('#dailypicker03').find(".active").data("day"));
                $('#dailypicker03').on('dp.change', function(ev){
                    ev.preventDefault();
                    $('#rides-date-req').val($(this).find(".active").data("day"));
                });
            }
            if(this.value == 'Yearly'){
                $('#search-mode-req').val('ry');
                $('#picker-req').html('<div class="view-ridemate-profile-popup" id="dailypicker04"></div>');
                $('#dailypicker04').datetimepicker({
                    inline: true,
                    format: 'YYYY',
                    viewMode: 'years'
                });
                $('#rides-date-req').val(('#dailypicker04').find(".active").data("day"));
                $('#dailypicker04').on('dp.change', function(ev){
                    ev.preventDefault();
                    $('#rides-date-req').val($(this).find(".active").data("day"));
                });
            }
        });
    });
</script>