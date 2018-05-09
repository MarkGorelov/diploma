<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 09.05.2018
 * Time: 17:10
 */

class Vacancy
{
    const SHOW_BY_DEFAULT = 10;

    /*
     * Returns an array of vacancies
     */
    public static function getLatestVacancy($count = self::SHOW_BY_DEFAULT)
    {
        $count = intval($count);

        $db = Db::getConnection();

        $vacanciesList = array();

        $result = $db->query('SELECT id, img, company_name, job_title, type_of_employment, short_description, location, salary, gender FROM vacancy '
            . 'WHERE status = "1"'
            . 'ORDER BY id DESC '
            . 'LIMIT ' . $count);

        $i = 0;
        while ($row = $result->fetch()) {
            $vacanciesList[$i]['id'] = $row['id'];
            $vacanciesList[$i]['img'] = $row['img'];
            $vacanciesList[$i]['company_name'] = $row['company_name'];
            $vacanciesList[$i]['job_title'] = $row['job_title'];
            $vacanciesList[$i]['type_of_employment'] = $row['type_of_employment'];
            $vacanciesList[$i]['short_description'] = $row['short_description'];
            $vacanciesList[$i]['location'] = $row['location'];
            $vacanciesList[$i]['salary'] = $row['salary'];
            $vacanciesList[$i]['gender'] = $row['gender'];
            $i++;
        }

        return $vacanciesList;
    }


    /*
     * Return company item by id
     * @param integer $id
     */
    public static function getVacancyById($id)
    {
        $id = intval($id);

        if ($id) {
            $db = Db::getConnection();

            $result = $db->query('SELECT * FROM vacancy WHERE id=' . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            return $result->fetch();
        }
    }

    public static function getVacanciesListByCompany($companyId = false)
    {
        if ($companyId) {
            $db = Db::getConnection();
            $vacancies = array();
            $result = $db->query("SELECT id, img, job_title, company_name, type_of_employment, short_description, location, salary, gender FROM vacancy "
                . "WHERE status = '1' AND company_id = '$companyId' "
                . "ORDER BY id ASC "
                . "LIMIT " . self::SHOW_BY_DEFAULT);

            $i = 0;
            while ($row = $result->fetch()) {
                $vacancies[$i]['id'] = $row['id'];
                $vacancies[$i]['img'] = $row['img'];
                $vacancies[$i]['job_title'] = $row['job_title'];
                $vacancies[$i]['company_name'] = $row['company_name'];
                $vacancies[$i]['type_of_employment'] = $row['type_of_employment'];
                $vacancies[$i]['short_description'] = $row['short_description'];
                $vacancies[$i]['location'] = $row['location'];
                $vacancies[$i]['salary'] = $row['salary'];
                $vacancies[$i]['gender'] = $row['gender'];
                $i++;
            }

            return $vacancies;
        }
    }
}