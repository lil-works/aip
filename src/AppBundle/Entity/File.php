<?php
namespace AppBundle\Entity;


class File
{

    private $file;

    public function getFile()
    {
        return $this->file;
    }

    public function setBrochure($file)
    {
        $this->file = $file;

        return $this;
    }
}