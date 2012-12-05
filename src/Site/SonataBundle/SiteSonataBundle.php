<?php

namespace Site\SonataBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SiteSonataBundle extends Bundle
{
  public function getParent()
  {
    return 'SonataAdminBundle';
  }
}
