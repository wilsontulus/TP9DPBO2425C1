<?php

interface KontrakView
{
    public function tampilList($list): string;
    public function tampilForm($data = null): string;
}

?>