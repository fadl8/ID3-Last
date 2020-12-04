<?php

require_once('Tree/Node.php');
require_once('Tree/NodeCollection.php');

class Tree
{
    /**
    * Child nodes
    * @var object
    */
    public $nodes;


    /**
    * Constructor
    */
    function __construct()
    {
        $this->nodes = new Tree_NodeCollection($this);
    }


    /**
    * Creates a Tree structure using a Reader driver.
    *
    * @param  RecursiveIterator $it   Iterator to create tree from
    * @param  mixed             $node Internal use only
    * @return Tree                    Tree object
    */
    /*public static function factory(Tree_Factory_Iterator $it, $node = null)
    {
        if (is_null($node)) {
            $node = new Tree();
        }

        foreach ($it as $v) {
            $newNode = $node->nodes->add(new Tree_Node($v->getTag()));

            if ($v->hasChildren()) {
                Tree::factory($v->getChildren(), $newNode);
            }
        }

        return $node;
    }*/


    /**
    * Merges two or more tree structures into one. Can take either
    * Tree objects or Tree_Node objects as arguments to merge. This merge
    * simply means the nodes from the second+ argument(s) are added to
    * this object.
    *
    * @param ...  Any number of Tree or Tree_Node objects to be merged
    *             with the first argument.
    * @return int Number of nodes merged
    */
    /*public function merge()
    {
        $args = func_get_args();
        $num  = 0;

        if (!empty($args)) {
            foreach ($args as $obj) { // Loop thru all given args
                if ($obj instanceof Tree_Node) {
                    $this->nodes->add($obj);
                } else {
                    foreach ($obj->nodes as $node) { // Loop thru all nodes (via Iterator, as nodes is a Tree_NodeCollection object)
                        $this->nodes->add($node);
                        $num++;
                    }
                }
            }
        }

        return $num;
    }*/


    /**
    * Returns true/false as to whether this node
    * has any child nodes or not.
    *
    * @return bool Any child nodes or not
    */
    public function hasChildren()
    {
        return $this->nodes->count() > 0;
    }


    /**
    * Returns itself, always
    *
    * @return Tree The Tree object ($this)
    */
    public function getTree()
    {
        return $this;
    }


    /**
    * __toString() method
    *
    * Dumps a HTML friendly representation of the Trees'
    * tag data.
    */
    /*public function __toString()
    {
        $nodeList = $this->nodes->getFlatList();
        $str      = '';

        foreach ($nodeList as $node) {
            $str .= str_repeat('&nbsp;&nbsp;&nbsp;', $node->depth()) . $node->getTag() . "\n<br>";
        }

        return $str;
    }*/

    public function __toString()
    {
        $nodeList = $this->nodes->getFlatList();
        $str      = '';

        foreach ($nodeList as $node) {
            if($node->depth() == 0)
                continue;
            else if($this->is_even_odd($node->depth()) == false)
                $str .= str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $node->depth()) . "<span class='odd-nodes'>" . $node->getTag() . "</span>" . "\n<br>";
            else if($this->is_even_odd($node->depth()) == true)
                $str .= str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $node->depth()) . "<span class='even-nodes'>" . $node->getTag() . "</span>" . "\n<br>";

        }

        return $str;
    }

    /**
     * @param $number: number to check weather the number is odd or even
     * @return bool: return true if number is even, else return false if number is odd
     */
    function is_even_odd($number)
    {
        if(($number % 2) == 0)
            return true;
        else if(($number % 2) != 0)
            return false;
    }
}
?>
