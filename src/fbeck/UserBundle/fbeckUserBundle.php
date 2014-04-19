<?php

namespace fbeck\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class fbeckUserBundle extends Bundle
{
	public function getParent()
	{
    	return 'FOSUserBundle';
    }
}
