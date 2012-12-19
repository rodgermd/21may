<?php

namespace Site\BaseBundle\Twig;

use Twig_Extension;
use Twig_Filter_Method;
use Twig_Function_Method;
use Symfony\Component\DependencyInjection\Container;
use Liip\ImagineBundle\Templating\ImagineExtension;

class ImageHelper extends Twig_Extension
{
  protected $uploader_helper;
  protected $imagine_twig_extension;

  public function __construct(Container $container, ImagineExtension $imagine_twig_extension)
  {
    $this->container              = $container;
    $this->uploader_helper        = $container->get('vich_uploader.templating.helper.uploader_helper');
    $this->imagine_twig_extension = $imagine_twig_extension;
  }

  public function getFilters()
  {
    return array(
      'uploaded_image'     => new Twig_Filter_Method($this, 'uploaded_image', array("is_safe" => array("html"))),
      'uploaded_image_uri' => new Twig_Filter_Method($this, 'uploaded_image_uri', array("is_safe" => array("html"))),
    );
  }

  public function getFunctions()
  {
    return array(
      'uploaded_image'     => new Twig_Function_Method($this, 'uploaded_image', array("is_safe" => array("html"))),
      'uploaded_image_uri' => new Twig_Function_Method($this, 'uploaded_image_uri', array("is_safe" => array("html"))),
    );
  }

  public function uploaded_image($obj, $filter = null, $field = 'file', array $options = array())
  {
    $filename  = $this->uploader_helper->asset($obj, $field);
    $thumbnail = $this->imagine_twig_extension->filter($filename, $filter);

    return $this->image_tag($thumbnail, $options);
  }

  public function uploaded_image_uri($obj, $filter = null, $field = 'file', array $options = array())
  {
    $filename = $this->uploader_helper->asset($obj, $field);
    return $this->imagine_twig_extension->filter($filename, $filter);
  }


  /**
   * Renders image tag
   * @param $filename
   * @param array $options
   * @return string
   */
  public function image_tag($filename, array $options = array())
  {
    $options['src'] = $filename;
    $result         = array();
    foreach ($options as $key => $option) $result[] = strtr('%key%="%value%"', array('%key%' => $key, '%value%' => $option));

    return strtr('<img %options%/>', array('%options%' => implode(' ', $result)));
  }


  public function getName()
  {
    return 'image_helper';
  }
}
