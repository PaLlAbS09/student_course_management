

$(document).ready(function() {

    $.ajaxSetup({
        cache: false,
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("AJAX Error: " + textStatus + " - " + errorThrown);
            alert("An error occurred while processing your request. Please check the console for details.");
        }
    });
    $('.modal').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        $(this).find('.alert').remove(); 
    });
    window.setTimeout(function() {
        $(".alert-auto-dismiss").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
    }, 3000);

    $(document).on('click', '.btn-delete-confirm', function(e) {
        if (!confirm("Are you sure you want to delete this record? This action cannot be undone.")) {
            e.preventDefault();
            return false;
        }
    });

});