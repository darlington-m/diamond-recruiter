<?php

namespace DiamondRecruiter\RecruiterBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class DiamondRecruiterRecruiterBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
