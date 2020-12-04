<!doctype HTML>
<html>
    <head>
        <title>Title Page</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="container">






<?php
    /*
     * This section to handle the class attribute and the selected attributes
     *
     */
    include 'Tree/Tree.php';
    include 'database.php';



    if (isset($_POST['runWithDetails'])) {

    $Detail = array();
    $AllDetail = array();

    $allTables = array();

        $table = $_POST['tableName'];
        $classAttribute = $_POST['ClassAttribute'];
        @$tableColumns = $_POST['columns'];




        $tree = new Tree();
        $node = new Tree_Node('root');
        $tree->nodes->add($node);

        $tree = ID3($table, $tableColumns, $node);
//        print_r($tree -> __ToString());
        ?>


            <?php
                foreach ($AllDetail as $key => $value){?>
                    <table class="table table-striped">
            <thead style="background: #202529;color:white">
            <tr >
                <th scope="col">Data</th>
                <th scope="col">Values </th>
            </tr>
            </thead>
            <tbody>
                    <?php
                    foreach ($value as $k => $v){
                        if(is_array($v)){
                            foreach($v as $kv => $vv){
                            ?>
                            <tr>
                                <th scope="row"><?php echo $k ?> </th>
                                <td><?php echo $vv ?></td>
                            </tr>
                        <?php }} else {?>

                        <tr>
                            <th scope="row"><?php echo $k ?> </th>
                            <td><?php echo $v ?></td>
                        </tr>

                    <?php }}
                }
            ?>
            </tbody>
        </table>


<?php
        DropTables($allTables);


        }

    function ID3($table, $attributes, $node)
    {

        global $Detail;
        global $AllDetail;

        global $tree;
        global $classAttribute;
        $maxOn = array();


        $Detail["Table"] = $table;
        $Detail["Class Atribute"] = $classAttribute;

        $classVal = null;
        $classValCount = null;

        $negNum = null;


        $rowsNumber = RowsNumber($table);

        $Detail["Row Numbers"] = $rowsNumber;


        $classAttributeValues = DistValue($classAttribute, $table);



        $ClassAttrVals = valueNum2($table, $classAttribute, $classAttributeValues);

        foreach($ClassAttrVals as $key => $value){
            if($value == $rowsNumber){
                $classVal = $key;
                $classValCount = $value;
            }
        }

        if (count($attributes) == null) {

            $maxOn = array_flip($ClassAttrVals);
            $max = $maxOn[max($ClassAttrVals)]; // ann


            $temp = new Tree_Node($max);
            $node->nodes->add($temp);

        }


        else if ($rowsNumber == $classValCount) {
            $temp = new Tree_Node($classVal);
            $node->nodes->add($temp);
        }

        else  {

            $entropy = Entropy($classAttribute, $table);

            $entropy = round($entropy,2);

            $Detail["Entropy : "] = $entropy;

            //This loop to calculate the information
            foreach ($attributes as $key => $value) {
                $information[] = round(information($table, $value, $classAttribute),2);
                $Detail["Information for ".$value." : "] = round(information($table, $value, $classAttribute),2);
            }

            //This loop to calculate the gain

            $counter1 = 0;
            foreach ($attributes as $key => $value) {
                $gain[$value] = $entropy - $information[$counter1];
                $Detail["Gain for ".$value." : "]= $gain[$value];
                ++$counter1;
            }

            //Get The Bigest value of the gain to be in the tree
            $maxGain = max($gain);
            $element = array_keys($gain, $maxGain);

                $Detail["Max Gain Attributes : "] = $element[0];

            //distinct values of the $element
            $elementDisValues = DistValue($element[0], $table);

                $Detail["Distnect Value for Most Gain Attribute for Table : ".$table] = $elementDisValues;

            //delete the element
            $attributes = deleteEle($element, $attributes);


            $temp = new Tree_Node($element[0]);
            $node->nodes->add($temp);


            $newTable = createNewTable($elementDisValues, $attributes, $table, $element[0], $classAttribute,$temp);


                foreach ($newTable as $item => $val) {
                    if (!empty($attributes)) {
                        array_push($AllDetail,$Detail);
                        ID3($item, $attributes, $val);
                    } else {

                         $MajorVal = Major($elementDisValues,$classAttributeValues,$table,$element[0],$classAttribute);

                        $emp = new Tree_Node($MajorVal[$item]);
                        $val->nodes->add($emp);
                    }
                }

        }

        array_push($AllDetail,$Detail);
        return $tree;
    }


    function deleteEle($element, $array)
    {
        $indexElement = array_search($element, $array);
        unset($array[$indexElement]);
        $newArray = array_values($array);//to reindex the array, because the unset() function donot reindex the array after deletion process
        return $newArray;
    }

?>
    </body>
</html>
