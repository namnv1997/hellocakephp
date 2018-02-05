<?php
/**
 * Created by PhpStorm.
 * User: n
 * Date: 05/02/2018
 * Time: 22:52
 */

namespace App\View;


class Froala extends AppView
{
    public function froalaAdd()
    {
        echo $this->element('froalaAdd');
    }

    public function froalaEdit()
    {
        echo $this->element('froalaEdit');
    }

}