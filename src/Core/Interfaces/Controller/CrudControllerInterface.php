<?php

namespace Core\Interfaces\Controller;

interface CrudControllerInterface
{
    #
    public function index();

    public function add();

    public function edit();

    public function submit();

    public function delete();
}
