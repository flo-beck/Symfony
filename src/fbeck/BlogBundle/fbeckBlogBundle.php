<?php

namespace fbeck\BlogBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class fbeckBlogBundle extends Bundle
{
	public function getParent()
	{
    return 'FOSUserBundle';
    }
}
