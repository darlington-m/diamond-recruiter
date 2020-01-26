<?php
/**
 * Created by PhpStorm.
 * User: darlington
 * Date: 11/03/17
 * Time: 10:01
 */

namespace DiamondRecruiter\RecruiterBundle\Helpers;

use GuzzleHttp\Client;


class ReedVacancies
{
    /**
     * ReedVacancies
     * @param $queryString
     */
    public function getVacancies($queryString) {
        $client = new Client();
        $response = $client->request('GET', 'http://www.reed.co.uk/api/1.0/search?' . $queryString, [
            'auth' => ['0dcc6c37-0ff0-46ec-b689-8e72c40e2e37', '']
        ]);

        $v = json_decode($response->getBody()->getContents(), true);
        $vacancies = $v['results'];
        return $vacancies;
    }
}