Yii2 Checkout
===================




Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

`
php composer.phar require --prefer-dist "c006/yii2-checkout" "*"
`

or add

`
"c006/yii2-checkout": "*"
`

to the require section of your `composer.json` file.



Composer.json
------------

>
    "repositories": [
        {
          "type": "vcs",
          "url": "https://github.com/c006/yii2-checkout.git"
        }
      ]
  
  
  
  
  
Setup
------------
  
>
    'modules'    => [
        'checkout'            => [
            'class'     => 'c006\checkout\Module',
        ],
    ],




























