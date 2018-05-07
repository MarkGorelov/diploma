<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 07.05.2018
 * Time: 13:58
 */

class Category
{
    public static function getCategoryList()
    {
        $db = Db::getConnection();

        $categoryList = array();

        $result = $db->query('SELECT id, name, img, description FROM category '
            . 'ORDER BY sort_order ASC');

        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['img'] = $row['img'];
            $categoryList[$i]['description'] = $row['description'];
            $i++;
        }

        return $categoryList;
    }
}