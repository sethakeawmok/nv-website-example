jQuery(function() {

    var postcode;

    jQuery("#sel_province").on("change", function(e) {
        e.preventDefault();
        
        var $this = $(this);
        var province_val = $(this).val();
        var html_sel_amphor = '';
        $('#sel_district').html('');

        jQuery.ajax({
            type: 'post',
            url: '/line-liff-starter/controller/helper_controller.php',
            dataType: 'json',
            data: {
                    'action': 'sel_province',
                    'province_val': province_val 
            },
            beforeSend: function () {
                jQuery('#sel_amphur').html('<option class="" value="" selected>กำลังโหลด...</option>');
                
            },
            success: function (data) { 

                html_sel_amphor ='<option class="" value="" selected>---เลือกอำเภอ---</option>';
                $.each(data, function( index, value ) { 
                    html_sel_amphor +='<option value="'+value.AMPHUR_ID+'" >'+value.AMPHUR_NAME+'</option>';
                });
                jQuery('#sel_amphur').html(html_sel_amphor);
                jQuery('#hid_respone_district').val(JSON.stringify(data));
             
            },
            error: function (xhr, status, error) {
                // var err = eval("(" + xhr.responseText + ")");
                // console.log(err.Message);
            } 
        });
        

    });

    jQuery("#sel_amphur").on("change", function(e) {
        e.preventDefault();
        
        var $this = $(this);
        var province_id = $('#sel_province').val();
        var amphur_id = $(this).val(); 
        var hid_respone_district = $('#hid_respone_district').val();
        var hid_respone_district = JSON.parse(hid_respone_district);
        $.each(hid_respone_district, function( index, value ) { 
            if (value.AMPHUR_ID == amphur_id) {
                $('#postcode').val(value.POSTCODE);
            }           
        });

        jQuery.ajax({
            type: 'post',
            url: '/line-liff-starter/controller/helper_controller.php',
            dataType: 'json',
            data: {
                    'action': 'sel_amphur',
                    'province_id': province_id,
                    'amphur_id': amphur_id 
            },
            beforeSend: function () {
                jQuery('#sel_district').html('<option class="" value="" selected>กำลังโหลด...</option>');
                
            },
            success: function (data) {
                
                html_sel_district ='<option class="" value="" selected>---เลือกตำบล---</option>';
                $.each(data, function( index, value ) { 

                    html_sel_district +='<option value="'+value.DISTRICT_ID+'" >'+value.DISTRICT_NAME+'</option>';
                });
                jQuery('#sel_district').html(html_sel_district);
             
            },
            error: function (xhr, status, error) {
                // var err = eval("(" + xhr.responseText + ")");
                // console.log(err.Message);
            } 
        });
        

    });

});