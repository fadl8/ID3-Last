<?php
    include 'database.php';
    include 'header.php';
?>

<?php
    /*
     * This section to handle the selected table
     */
    $table = null;
    if(isset($_POST["select"]))
        $table = $_POST['table'];
?>

<div class="row">
    <div class="license">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="container body">
                <div class="main_container">
                    <div class="right_col" role="main">
                        <h2>License Details</h2>
                        <div class="license-section">
                           [PLEASE NOTE:  ID3 Group licenses this supplement to you.  You may use it with each validly licensed copy of ID3 Group .  You may not use the supplement if you do not have a license for the software.  The license terms for the software apply to your use of this supplement. 
                        </div>
                        <div class="accept">
                            <div class="pull-left">
                                <label class='chk-lbl control-label'>Accept
                                    <input type='checkbox' id="chk-accept" name='accept' />
                                    <span class='checkmark'></span>
                                </label>
                            </div>
                            <div class="pull-right">
                                <button class="btn btn-primary" id="start" disabled="disabled">Next >></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

<div class="row">
    <div class="hide" id="choose-table">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="container body">
                <div class="main_container">
                    <div class="right_col" role="main">
                        <?php include 'selectTable.php' ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

<?php include "footer.php" ?>