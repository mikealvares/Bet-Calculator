function calcOdds(){
    let oddsFormat = jQuery("select.oddsFormat").children("option:selected").val();
    let stake = parseFloat(jQuery('#stakeamt').val());
    let total = 0;
    if (oddsFormat==2){
        total = stake;
        jQuery('input[name^="odds"]').each(function() {
            if(jQuery(this).val()!='')  
                total *= parseFloat(jQuery(this).val());
        });
    }else{
        total = stake;
        jQuery('input[name^="odds"]').each(function() {
            if(jQuery(this).val()!=''){
                let odds = jQuery(this).val().split('/');
                let n = parseInt(odds[0]);
                let d = parseInt(odds[1]);
                total += (total/d)*n;
            }  
        });
    }
    if(isNaN(total)) total=0.00;
    total = parseFloat(total).toFixed(2);
    jQuery('#payout').html('&euro; '+total);
}
jQuery('body').on('keyup', '.isdec', function(){
    let oddsFormat = jQuery("select.oddsFormat").children("option:selected").val();
    let valid ='';
    let val = this.value;
    if (oddsFormat==2){
        valid = /^\d{0,9}(\.\d{0,2})?$/.test(this.value);
        val = val.replace(/(\.)(.)(\.)/g, ".$2");
        val = val.replace(/[^0-9.]/g, "");
    }else{
        valid = /^\d{0,9}(\/\d{0,2})?$/.test(this.value);
        val = val.replace(/(\.)(.)(\.)/g, ".$2");
        val = val.replace(/[^0-9/]/g, "");
    }
    if (!valid) {
        let dotCheck = val.indexOf("..");
        if (dotCheck >= 0) {
            val = val.replace("..", ".");
        }
        val = val.replace(/,/g, "");
        let totalLength = val.length;
        let only2DecimalsCount = val.indexOf(".");
        if (only2DecimalsCount >= 0 && totalLength > (only2DecimalsCount + 2)) {
            val = val.substring(0, (only2DecimalsCount + 3));
        }
        this.value = val;
    }
});

jQuery("body").on("click",".delODD",function(){ 
    jQuery(this).parents(".oddrow").remove();
    calcOdds();
});
jQuery(document).ready(function(){
    jQuery('#addOdds').click(function(){  
        jQuery('#newOdds').append('<div class="form-group row"><label class="label-center col-lg-12 col-md-6 col-12"></label><div class="col-lg-12 col-md-6 col-10 center oddrow"><input type="text" name="odds[]" onkeyup="calcOdds()" class="form-control odds isdec" id="oddeamt" onkeyup="calcOdds()" />&nbsp;<i class="delODD fas fa-minus-circle red-text"></i></div></div>');
    });
    jQuery("select.oddsFormat").change(function(){
        oddsFormat = jQuery(this).children("option:selected").val();
    });
    jQuery("#stakeamt").on("keyup", function () {
        calcOdds();
    });
});