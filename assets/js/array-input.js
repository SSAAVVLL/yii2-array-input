(function( jQuery ) {
    jQuery(document).ready(function(){
        jQuery(document).on('click', '.array-input-remove', function(e){
            e.preventDefault();
            jQuery(this).parents('.wrap-input').remove();
            return false;
        });
        jQuery(document).on('click', '.array-input-plus', function(e){
            e.preventDefault();
            var inputGroup = jQuery(this).parents('.wrap-input');
            var inputClone = inputGroup.clone();
            inputClone.find('input').val('');
            var valueInput = inputGroup.find('input').val();
            var name = inputGroup.find('input').data('name');
            inputGroup.find('input').attr('name', name + '['+ valueInput +']').val('');
            inputGroup.find('.title-el').text(valueInput);
            inputGroup.after(inputClone);
            jQuery(this).removeClass('array-input-plus')
                .addClass('array-input-remove')
            .find('i')
                .removeClass('glyphicon-plus')
                .addClass('glyphicon-remove');
            return false;
        });
    })
})(jQuery)
