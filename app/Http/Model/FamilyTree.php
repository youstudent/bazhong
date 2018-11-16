<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/10/16
 * Time: 下午4:23
 */

namespace App\Http\Model;


class FamilyTree
{

    /**
     * @var array
     */
    private $_tree;

    private $_parentSign = "pid";


    /**
     * FamilyTree constructor.
     *
     * @param array $tree
     */
    public function __construct(array $tree)
    {
        $this->_tree = $tree;
    }

    /**
     * @return array
     */
    public function getTree()
    {
        return $this->_tree;
    }

    /**
     * @param array $tree
     * @return FamilyTree
     */
    public function setTree($tree)
    {
        $this->_tree = $tree;
        return $this;
    }

    /**
     * @return string
     */
    public function getParentSign()
    {
        return $this->_parentSign;
    }

    /**
     * @param string $parentSign
     * @return FamilyTree
     */
    public function setParentSign($parentSign)
    {
        $this->_parentSign = $parentSign;
        return $this;
    }

    /**
     * 获取某节点的所有子节点
     *
     * @param $id
     * @return array
     */
    public function getSons($id)
    {
        $sons = [];
        foreach ($this->_tree as $key => $value) {
            if ($value[$this->_parentSign] == $id) {
                $sons[] = $value;
            }
        }
        return $sons;
    }

    /**
     * 获取某节点的所有子孙节点
     *
     * @param $id
     * @param int $level
     * @return array
     */
    public function getDescendants($id, $level = 1)
    {
        $nodes = [];
        foreach ($this->_tree as $key => $value) {
            if ($value[$this->_parentSign] == $id) {
                $value['level'] = $level;
                $nodes[] = $value;
                $nodes = array_merge($nodes, $this->getDescendants($value['id'], $level + 1));
            }
        }
        return $nodes;
    }


    /**
     * @return array
     */
    public static function getCategoriesName()
    {
        $categories = Category::getCategories();
        $data = [];
        foreach ($categories as $k => $category){
            if( isset($categories[$k+1]['level']) && $categories[$k+1]['level'] == $category['level'] ){
                $name = ' ├' . $category['category_name'];
            }else{
                $name = ' └' . $category['category_name'];
            }
            if( end($categories) == $category ){
                $sign = ' └';
            }else{
                $sign = ' │';
            }
            $data[$category['id']] = str_repeat($sign, $category['level']-1) . $name;
        }
        return $data;
    }


}