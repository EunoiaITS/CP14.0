<script>
    $(document).on('change','#format-selector',function (e) {
        e.preventDefault();

        if(this.value == 'Daily'){
            $('#picker').html('<div class="view-ridemate-profile-popup" id="dailypicker01"></div>');
            $('#dailypicker01').datetimepicker({
                inline: true,
                format: 'DD',
                viewMode: 'days',
            });
            $(document).on('click','#generate',function (e) {
                e.preventDefault();
                $('#loading').html('<i class="alert alert-success">Loading...</i>');
                setTimeout(function() {
                    $('#loading').html('');
                }, 500);
                var date = $("#dailypicker01").find(".active").data("day");
                let link = '<?php echo url('/admin/total-income');?>';
                var html = '';
                var count = 1;
                $.ajax({
                    type: 'GET',
                    url: link,
                    data: {'section':'daily','date':date},
                    dataType: 'text',
                    success: function(data, textStatus, xhr){
                        //console.log(data);
                        var total = 0;
                        $.each(JSON.parse(data),function (i,e) {
                            if(e.checked === 'yes') {
                                html += '<tr>' +
                                    '<td>'+count+'</td>' +
                                    '<td>'+e.ride_no+'</td>' +
                                    '<td>'+e.name+'</td>' +
                                    '<td>'+e.start_time+'</td>' +
                                    '<td>'+e.time+'</td>' +
                                    '<td class="total-amount">'+e.amount+'</td>' +
                                    '</tr>';
                                count++;
                                total += parseInt(e.amount);
                            }
                        });
                        $('#income-data').html(html+'<tr>' +
                            '<td></td><td></td><td></td>'+
                            '<td colspan="2">Total Income</td>' +
                            '<td>'+total+'</td>' +
                            '</tr>');
                    },
                    error: function(xhr, textStatus, error){
                        //alert(textStatus);
                    }
                });
                return false;
            });
        }else if(this.value == 'Weekly'){
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
                    $(document).on('click','#generate',function (e) {
                        e.preventDefault();
                        $('#loading').html('<i class="alert alert-success">Loading...</i>');
                        setTimeout(function() {
                            $('#loading').html('');
                        }, 500);
                        let link = '<?php echo url('/admin/total-income');?>';
                        var html = '';
                        var count = 1;
                        $.ajax({
                            type: 'GET',
                            url: link,
                            data: {'section':'weekly','start_date':startDate.toISOString().split('T')[0],'end_date':endDate.toISOString().split('T')[0]},
                            dataType: 'text',
                            success: function(data, textStatus, xhr){
                                console.log(data);
                                var total = 0;
                                $.each(JSON.parse(data),function (i,e) {
                                    if(e.checked === 'yes') {
                                        html += '<tr>' +
                                            '<td>'+count+'</td>' +
                                            '<td>'+e.ride_no+'</td>' +
                                            '<td>'+e.name+'</td>' +
                                            '<td>'+e.start_time+'</td>' +
                                            ' <td>'+e.time+'</td>' +
                                            '<td>'+e.amount+'</td>' +
                                            '</tr>';
                                        count++;
                                        total += parseInt(e.amount);
                                    }
                                });
                                $('#income-data').html(html+'<tr>' +
                                    '<td></td><td></td><td></td>'+
                                    '<td colspan="2">Total Income</td>' +
                                    '<td>'+total+'</td>' +
                                    '</tr>');
                            },
                            error: function(xhr, textStatus, error){
                                //alert(textStatus);
                            }
                        });
                        return false;
                    });
                }
            });
        }else if(this.value == 'Monthly'){
            $('#picker').html('<div class="view-ridemate-profile-popup" id="dailypicker03"></div>');
            $('#dailypicker03').datetimepicker({
                inline: true,
                format: 'MM',
                viewMode: 'months'
            });
            $(document).on('click','#generate',function (e) {
                e.preventDefault();
                $('#loading').html('<i class="alert alert-success">Loading...</i>');
                setTimeout(function() {
                    $('#loading').html('');
                }, 500);
                var date = $("#dailypicker03").find(".active").data("day");
                let link = '<?php echo url('/admin/total-income');?>';
                //alert(date);
                var html = '';
                var count = 1;
                $.ajax({
                    type: 'GET',
                    url: link,
                    data: {'section':'monthly','date':date},
                    dataType: 'text',
                    success: function(data, textStatus, xhr){
                        //console.log(data);
                        var total = 0;
                        $.each(JSON.parse(data),function (i,e) {
                            if(e.checked === 'yes') {
                                html += '<tr>' +
                                    '<td>'+count+'</td>' +
                                    '<td>'+e.ride_no+'</td>' +
                                    '<td>'+e.name+'</td>' +
                                    '<td>'+e.start_time+'</td>' +
                                    ' <td>'+e.time+'</td>' +
                                    '<td class="total-amount">'+e.amount+'</td>' +
                                    '</tr>';
                                count++;
                                total += parseInt(e.amount);
                            }
                        });
                        $('#income-data').html(html+'<tr>' +
                            '<td></td><td></td><td></td>'+
                            '<td colspan="2">Total Income</td>' +
                            '<td>'+ total +'</td>' +
                            '</tr>');
                    },
                    error: function(xhr, textStatus, error){
                        //alert(textStatus);
                    }
                });
                return false;
            });
        }else if(this.value == 'Yearly'){
            $('#picker').html('<div class="view-ridemate-profile-popup" id="dailypicker04"></div>');
            $('#dailypicker04').datetimepicker({
                inline: true,
                format: 'YYYY',
                viewMode: 'years'
            });
            $(document).on('click','#generate',function (e) {
                e.preventDefault();
                $('#loading').html('<i class="alert alert-success">Loading...</i>');
                setTimeout(function() {
                    $('#loading').html('');
                }, 500);
                var date = $("#dailypicker04").find(".active").data("day");
                let link = '<?php echo url('/admin/total-income');?>';
                //alert(date);
                var html = '';
                var count = 1;
                $.ajax({
                    type: 'GET',
                    url: link,
                    data: {'section':'yearly','date':date},
                    dataType: 'text',
                    success: function(data, textStatus, xhr){
                        //console.log(data);
                        var total = 0;
                        $.each(JSON.parse(data),function (i,e) {
                            if(e.checked === 'yes') {
                                html += '<tr>' +
                                    '<td>'+count+'</td>' +
                                    '<td>'+e.ride_no+'</td>' +
                                    '<td>'+e.name+'</td>' +
                                    '<td>'+e.start_time+'</td>' +
                                    ' <td>'+e.time+'</td>' +
                                    '<td>'+e.amount+'</td>' +
                                    '</tr>';
                                count++;
                                total += parseInt(e.amount);
                            }
                        });
                        $('#income-data').html(html+'<tr>' +
                            '<td></td><td></td><td></td>'+
                            '<td colspan="2">Total Income</td>' +
                            '<td>'+total+'</td>' +
                            '</tr>');
                    },
                    error: function(xhr, textStatus, error){
                        //alert(textStatus);
                    }
                });
                return false;
            });
        }
    });
</script>