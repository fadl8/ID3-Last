<div class="row">
    <div class="col-md-12">
        <h2>Select Table or Import File</h2>
        <div class="table-choose">
            <form action="showTable.php" method="post">
                <div class="form-group">
                    <label for="table" class="control-label col-md-2">Select Table: </label>
                    <div class="col-md-3">
                        <select name="table" id="table" class="form-control select-table">
                            <option value="" selected></option>
                            <?php
                            foreach(getTables('id3') as $tab)
                            {
                                ?>
                                <option <?php if($table == $tab) echo "selected"; ?> value="<?php echo $tab ?>"><?php echo $tab; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <input type="submit" name="select" value="Apply" class="bt btn-primary " id="chooseTable" data-target="collapseOne" data-toggle="collapse" />
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-2">
                        or &nbsp;&nbsp; <input type="submit" name="select" value="Import File" class="bt btn-primary" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>