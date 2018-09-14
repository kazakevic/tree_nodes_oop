<?php

/**
 * Simple Tree nodes structure for OOP
 */
class Node {

    public $node_value = null;

    public $children = [];

    public $depth = 0;
    public $is_father = false;

    public function __construct($value)
    {
        $this->node_value = $value;
    }

    public function addChildren(Node $node){
        array_push($this->children, $node);
        $this->is_father = true;
    }

    public function getDeph(){
        $node = json_decode(json_encode($this), true);
        array_walk_recursive($node, function($val, $key){
            if($key == "is_father" && $val == 1){
                $this->depth++;
            }
        }, $this->depth);
        
        return $this->depth; 
    }
}
/**
 * Tree example
 *      0 
 *  1       2 
 *              3 
 *          4       5 
 *      2      7
 */

$node0 = new Node(0);
$node1 = new Node(1);
$node2 = new Node(2);
$node3 = new Node(3);
$node4 = new Node(4);
$node5 = new Node(5);
$node7 = new Node(7);

$node0->addChildren($node1);
$node0->addChildren($node2);

$node2->addChildren($node3);  

$node3->addChildren($node4);   
$node3->addChildren($node5);   

$node4->addChildren($node7);

echo $node0->getDeph();
