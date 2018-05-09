<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 09.05.2018
 * Time: 15:40
 */

class Company
{
    const SHOW_BY_DEFAULT = 10;

    /*
     * Returns an array of companies
     */
    public static function getLatestCompany($count = self::SHOW_BY_DEFAULT)
    {
        $count = intval($count);

        $db = Db::getConnection();

        $companiesList = array();

        $result = $db->query('SELECT id, img, company_name, headline, short_description FROM company '
            . 'WHERE status = "1"'
            . 'ORDER BY id DESC '
            . 'LIMIT ' . $count);

        $i = 0;
        while ($row = $result->fetch()) {
            $companiesList[$i]['id'] = $row['id'];
            $companiesList[$i]['img'] = $row['img'];
            $companiesList[$i]['company_name'] = $row['company_name'];
            $companiesList[$i]['headline'] = $row['headline'];
            $companiesList[$i]['short_description'] = $row['short_description'];
            $i++;
        }

        return $companiesList;
    }


    /*
     * Return company item by id
     * @param integer $id
     */
    public static function getCompanyById($id)
    {
        $id = intval($id);

        if ($id) {
            $db = Db::getConnection();

            $result = $db->query('SELECT * FROM company WHERE id=' . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            return $result->fetch();
        }
    }
}