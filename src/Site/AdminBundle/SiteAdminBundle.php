<?php

namespace Site\AdminBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SiteAdminBundle extends Bundle
{
  public function getParent()
  {
    return 'SonataAdminBundle';
  }
}
