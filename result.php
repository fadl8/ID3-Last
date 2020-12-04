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
    if (isset($_POST['run'])) {

        $allTables = array();

        $table = $_POST['tableName'];
        $classAttribute = $_POST['ClassAttribute'];
        @$tableColumns = $_POST['columns'];



        $tree = new Tree();
        $node = new Tree_Node('');
        $tree->nodes->add($node);

        $tree = ID3($table, $tableColumns, $node);

        echo "<pre>";
            print_r($tree -> __ToString());
        echo "</pre>";

        DropTables($allTables);

        }

/**
 * @param $table
 * @param $attributes
 * @param $node
 * @return Tree
 */
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

        //number of the rows in the dataset(database)
        $rowsNumber = RowsNumber($table);

        //The distinct values of the column classAttribute
        $classAttributeValues = DistValue($classAttribute, $table);
        //The number of duplication for each distinct value of the classAttribute
        $ClassAttrVals = valueNum2($table, $classAttribute, $classAttributeValues);


        foreach($ClassAttrVals as $key => $value){
            if($value == $rowsNumber){
                //These varibles will be used below
                $classVal = $key;
                $classValCount = $value;
            }
        }


        //if no attributes are selected from interface
        if (count($attributes) == null) {

            //array_flip: keys from array become values and values from array become keys.
            $maxOn = array_flip($ClassAttrVals);
            $max = $maxOn[max($ClassAttrVals)]; // ann

            $temp = new Tree_Node($max);
            $node->nodes->add($temp);

        }

        //if all rows of the classAttribute in the table are yes or all rows of the classAttribute in the table are no
        else if ($rowsNumber == $classValCount) {
            $temp = new Tree_Node($classVal);
            $node->nodes->add($temp);
        }

        else  {

            //calculate the entropy
            $entropy = Entropy($classAttribute, $table);


            //loop to calculate the information
            foreach ($attributes as $key => $value) {
                $information[] = information($table, $value, $classAttribute);
            }


            //loop to calculate the gain
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


            //add the node to the tree
            $temp = new Tree_Node($element[0]);
            $node->nodes->add($temp);


            //create tables according to the number of distinct values of the root element(any element)
            //The keys of $newTable array is the name of created tables, values are nodes in the tree
            $newTable = createNewTable($elementDisValues, $attributes, $table, $element[0], $classAttribute,$temp);


            foreach ($newTable as $item => $val) {
                if (!empty($attributes)) {
                    /*
                     * $item: is name of the table
                     * $attributes: are the attributes of the table $item
                     * $val: is the node to add new nodes to it
                     * */
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
