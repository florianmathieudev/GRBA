<?php
//
namespace App\Service;

use App\Entity\Parameter as EntityParameter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Parameter
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    public function get(String $keyIndex){

        $param = $this->em->getRepository(EntityParameter::class)->findOneBy(["keyIndex" => $keyIndex]);
        
        if(!empty($param)){
            return $param->getValue();
        }
        dd($param);
        return "";
    }

    public function set(String $keyIndex, String $value){

        $param = $this->em->getRepository(EntityParameter::class)->findOneBy(["keyIndex" => $keyIndex]);
        
        if(!empty($param)){
            $param->setValue($value);
            
        }

    }

}