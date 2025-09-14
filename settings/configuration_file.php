<?php

	spl_autoload_register(

		function ($Class) {

			if(str_ends_with($Class, 'Constants'))
				require_once dirname(__FILE__)."/../app/constants/$Class.php";
			elseif(str_ends_with($Class, 'Helper'))
				require_once dirname(__FILE__)."/../app/helpers/$Class.php";
			else
				require_once dirname(__FILE__)."/../app/services/$Class.php";

		}

	);