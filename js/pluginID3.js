$(document).ready(function () {

    /*******************************************************************************************/
    /*
    * page: index.php
    * usage: hide the license section and show the section of selecting table
    * */
    $("#start").click(function () {
        $(this).parents('.license').slideUp(500);
        $("#choose-table").removeClass("hide").slideDown(500);
    });






    /*******************************************************************************************/
    /*
    * Page: showTable.php
    * usage: hide the attribute that selected as classAttribute from the attribute list, and show the others
    * */

    var classAttr = $("#classAttribute").val();
    $("#"+classAttr).fadeOut();

    $("#classAttribute").change(function () {
        $("#class-and-attr label").each(function () {
            $(this).fadeIn();
        });

        var classAttr = $(this).val();
        $("#"+classAttr).fadeOut();
    });




    /*******************************************************************************************/
    /*
    * Page: index.php
    * usage: enable the button (next >>) if the checkbox is checked and disable the button if the checkbox is unchecked
    * */
    $("#chk-accept").change(function () {
        if(this.checked)
        {
            $(".accept button").removeAttr('disabled');
        }
        else
        {
            $(".accept button").attr('disabled', 'disabled');
        }
    });



    /*******************************************************************************************/
    /*
    * Page: showTable.php
    * usage: enable the buttons (run) (run with details) if the table is selected from the select menu, and disable them if no table is selected from the select menu
    * */

    if($("#table").val() != "")
    {
        $('[name="run"]').removeAttr('disabled');
        $('[name="runWithDetails"]').removeAttr('disabled');
    }
    else if($("#table").val() == "")
    {
        $('[name="run"]').attr('disabled', 'disabled');
        $('[name="runWithDetails"]').attr('disabled', 'disabled');
    }

    $('[name="select"]').click(function () {
        if($("#table").val() != "")
        {
            $('[name="run"]').removeAttr('disabled');
            $('[name="runWithDetails"]').removeAttr('disabled');
        }
        else if($("#table").val() == "")
        {
            $('[name="run"]').attr('disabled', 'disabled');
            $('[name="runWithDetails"]').attr('disabled', 'disabled');
        }
    });

});