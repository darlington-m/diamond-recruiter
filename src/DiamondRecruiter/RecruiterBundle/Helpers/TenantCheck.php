<?php
/**
 * Created by PhpStorm.
 * User: darlington
 * Date: 22/04/17
 * Time: 15:00
 */

namespace DiamondRecruiter\RecruiterBundle\Helpers;


use DiamondRecruiter\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class TenantCheck
{

    public function check(User $user, Request $request) {

        if ($user->getTenant()->getName() == $request->get('tenant')) {
            return true;
        } else {
            return false;
        }
    }

}