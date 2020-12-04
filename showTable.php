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
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="container body">
                    <div class="main_container">
                        <!-- page content -->
                        <div class="right_col" role="main">
                            <div class="">
                                <?php include "selectTable.php" ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="x_panel">
                                            <div class="x_content">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <h2>Data From Table <?php echo @$table ?></h2>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <?php
                                                                $columns = columnName("id3",@$table);
                                                                $count = 0;
                                                                while($count < count($columns))
                                                                {
                                                                    echo "<th>".$columns[$count]."</th>";
                                                                    $count++;
                                                                }
                                                                ?>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            $count2 = 0;
                                                            $tableData = "select * from $table";
                                                            $tableShow = mysqli_query($con,$tableData);
                                                            while($tableResult = @mysqli_fetch_assoc($tableShow)){
                                                                echo "<tr>";
                                                                foreach($tableResult as $key => $value){
                                                                    echo "<td>".$value."</td>";
                                                                }
                                                                echo "</tr>";
                                                            }
                                                            ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="attributes">
                                    <div class="col-md-12">
                                        <form action="result.php" method="post" class="was-validated">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" value="<?php echo @$table ?>" name="tableName" />
                                                    <label for="columns" class="col-md-6 control-label">Selected Class Attribute</label>
                                                    <div class="col-md-5">
                                                        <select name="ClassAttribute" id="classAttribute" class="form-control select-column">
                                                            <?php
                                                            $columns = columnName("id3",@$table);
                                                            $count = 0;
                                                            while($count < count($columns))
                                                            {
                                                                if($count == 0)
                                                                {
                                                                    $count++;
                                                                    continue;
                                                                }

                                                                ?>
                                                                <option <?php if($count == count($columns) - 1) echo "selected"; ?> value='<?php echo $columns[$count]; ?>'><?php echo $columns[$count]; ?></option>
                                                                <?php
                                                                $count++;
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <h2>Select Attributes:</h2>
                                                <div class="form-group">
                                                    <div id="class-and-attr">
                                                    <?php
                                                    $columns = columnName("id3",@$table);
                                                    $count = 0;
                                                    while($count < count($columns))
                                                    {
                                                        //to exclude the first column
                                                        if($count == 0)
                                                        {
                                                            $count++;
                                                            continue;
                                                        }

                                                        //To exclude the last column
                                                        /*if($count == count($columns) - 1)
                                                        {
                                                            $count++;
                                                            break;
                                                        }*/

                                                        echo "
                                                            <label id='$columns[$count]' class='chk-lbl control-label'>$columns[$count]
                                                                <input type='checkbox' class='' name='columns[]' value='$columns[$count]' />
                                                                <span class='checkmark'></span>
                                                            </label>
                                                              ";
                                                        $count++;
                                                    }
                                                    ?>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input type="submit" name="run" value="Run" class="btn btn-primary btn-sm" />
                                                    <input type="submit" name="runWithDetails" value="Run With Details" class="btn btn-primary btn-sm" formaction="result2.php"/>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>

<?php include "footer.php"; ?>