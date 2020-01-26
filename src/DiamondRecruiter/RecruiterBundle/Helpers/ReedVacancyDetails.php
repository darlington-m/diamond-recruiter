<?php
/**
 * Created by PhpStorm.
 * User: darlington
 * Date: 19/03/17
 * Time: 12:25
 */

namespace DiamondRecruiter\RecruiterBundle\Helpers;

use GuzzleHttp\Client;


class ReedVacancyDetails
{
    /**
     * @return vacancy
     * @param $id
     */
    public function getVacancy($id) {
        $client = new Client();
        $response = $client->request('GET', 'http://www.reed.co.uk/api/1.0/jobs/' . $id, [
            'auth' => ['0dcc6c37-0ff0-46ec-b689-8e72c40e2e37', '']
        ]);

        $vacancy = json_decode($response->getBody()->getContents(), true);
        return $vacancy;
    }
}