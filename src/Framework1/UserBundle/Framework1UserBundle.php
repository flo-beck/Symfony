<?php

namespace Framework1\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class Framework1UserBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
