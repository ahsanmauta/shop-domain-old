<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\MenuServiceProvider::class,
	Mews\Captcha\CaptchaServiceProvider::class,
	Biscolab\ReCaptcha\ReCaptchaServiceProvider::class,
	October\Rain\Config\ServiceProvider::class,
];
