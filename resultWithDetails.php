<?php
    include 'Tree/Tree.php';
    include 'database.php';
    include 'header.php';
?>

<div class="container">
    <div class="row">
        <div class="result">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="main_container result-data">
                    <div>
                        <h1 class="text-center">The Result </h1>


<?php
    if (isset($_POST['runWithDetails'])) {

        $allTables = array();

        $table = $_POST['tableName'];
        $classAttribute = $_POST['ClassAttribute'];
        @$tableColumns = $_POST['columns'];

        $tree = new Tree();
        $node = new Tree_Node('');
        $tree->nodes->add($node);

        $tree = ID3($table, $tableColumns, $node);


        /*********************************************************************************************************
        *   usage: use to show the detials
        **********************************************************************************************************/

        //show the table name
        echo "<pre>";
        echo "# The Table Name is: ";
        print_r($table);
        echo "</pre>";


        //show the attributes
        echo "<pre>";
        echo "<span># The Attributes are: </span>";
        if(isset($tableColumns ))
        {
            foreach($tableColumns as $ky => $val)
            {
                echo $val . ", ";
            }
        }
        else
        {
            echo "<span>No Attribute Was Selected.</span>";
        }
        echo "</pre>";

        //show the class attribute.
        echo "<pre>";
        echo "<span># The Class Attribute is: </span>";
        print_r($classAttribute);
        echo "<br /><span># The Distinct Values of The Class Attribute are: </span>";
        foreach(DistValue($classAttribute, $table) as $ky => $val)
        {
            echo $val . ", ";
        }
        echo "</pre>";


        //show the decision tree structure
        echo "<pre>";
        echo "# The Decision Tree Structure: ";
        echo "</pre>";
        echo "<pre>";
        print_r($tree -> __ToString());
        echo "</pre>";


        DropTables($allTables);

        }

    function ID3($table, $attributes, $node)
    {

        if($attributes == null){
            echo "<pre>";
                echo "<span>No Attributes Are Selected</span>";
            echo "</pre>";
        }
        global $tree;
        global $classAttribute;
        $maxOn = array();


        $classVal = null;
        $classValCount = null;

        $negNum = null;


        $rowsNumber = RowsNumber($table);


        $classAttributeValues = DistValue($classAttribute, $table);


        $ClassAttrVals = valueNum2($table, $classAttribute, $classAttributeValues);
//
//        print_r($ClassAttrVals);
//        $temp =  max($ClassAttrVals);
//        $temp2 = array_keys($ClassAttrVals,$temp);
//








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


            //This loop to calculate the information
            foreach ($attributes as $key => $value) {
                $information[] = information($table, $value, $classAttribute);
            }

            //This loop to calculate the gain

            $counter1 = 0;
            foreach ($attributes as $key => $value) {
                $gain[$value] = $entropy - $information[$counter1];
                ++$counter1;
            }

            //Get The Bigest value of the gain to be in the tree
            $maxGain = max($gain);
            $element = array_keys($gain, $maxGain);

            //distinct values of the $element
            $elementDisValues = DistValue($element[0], $table);

            //delete the element
            $attributes = deleteEle($element, $attributes);


            $temp = new Tree_Node($element[0]);
            $node->nodes->add($temp);


            $newTable = createNewTable($elementDisValues, $attributes, $table, $element[0], $classAttribute,$temp);


                foreach ($newTable as $item => $val) {
                    if (!empty($attributes)) {
//                        echo $val." This is here <br>";
                        ID3($item, $attributes, $val);
                    } else {

                         $MajorVal = Major($elementDisValues,$classAttributeValues,$table,$element[0],$classAttribute);

                        $emp = new Tree_Node($MajorVal[$item]);
                        $val->nodes->add($emp);
                    }
                }

        }
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

                        </div>
                    </div>
                </div>
            </div>
        <div class="col-md-2"></div>
    </div>
</div>
<?php include 'footer.php'; ?>
