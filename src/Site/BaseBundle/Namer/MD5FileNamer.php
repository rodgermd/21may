<?php

namespace Site\BaseBundle\Namer;
use Vich\UploaderBundle\Naming\NamerInterface;

class MD5FileNamer implements NamerInterface
{
  public function name($obj, $field)
  {
    $field_getter = \Doctrine\Common\Util\Inflector::camelize('get_' . $field);
    /** @var \Symfony\Component\HttpFoundation\File\UploadedFile $file  */
    $file = $obj->$field_getter();
    $original_filename = $file->getClientOriginalName();
    $original_extension = pathinfo($original_filename, PATHINFO_EXTENSION);
    $filename = $this->prepareFilename();
    if ($original_extension) $filename .= '.' . $original_extension;
    return $filename;
  }

  public function prepareFilename()
  {
    return md5(uniqid() . time());
  }

}
