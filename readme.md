## About Results Management System

<p>Using this web based system students can access to their past results, GPA marks and they may get some guidance to achieve their academic carrier. Faculty staff and examination branch staff can use system to publish and manage student results, generate various reports and authorized persons can maintain and view student and lecturer profiles.</p>

<p>Rational Unified Process was selected as the process model among all other software development methodologies by considering its advantages over other process models. Object oriented analysis and design techniques were used for the project and UML was used for modelling the system. The system was developed using MVC [17] architecture with Laravel [16] framework version 5.5 and used responsive design. Apache 2.4 was used as webserver. Object oriented PHP 7.1 for server side scripting, JavaScript for client side scripting, MySQL 5.7 for database and HTML5, CSS, Bootstrap [13] for the interface design were used.</p>

<p>After implementing the system results publishing process take less time and managing results will be an easy task. Student and lecturer profiles data can be used for various purposes without consuming additional time. Apart from that, students can monitor and plan their academic carrier activities effectively. 
</p>

<p>
For more information please refer document directory.
</p>

## Instructions to prepare environment file
Please copy ".env.example" file into root directory as ".env". 

### Generate app key
Run this command using command line in root directory
<pre>php artisan key:generate</pre>

### Other properties
<strong>Database related properties<strong>

<pre>
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=[Database Name]
DB_USERNAME=[Database Username]
DB_PASSWORD=[Database User Password]
</pre>

<strong>Email related properties</strong>

<pre>
MAIL_DRIVER=smtp
MAIL_HOST=[If you are using Mailtrap Ex-smtp.mailtrap.io]
MAIL_PORT=[2525]
MAIL_USERNAME=[Username]
MAIL_PASSWORD=[Password]
MAIL_ENCRYPTION=tls
</pre>

## About Laravel

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>


Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb combination of simplicity, elegance, and innovation give you tools you need to build any application with which you are tasked.

## Learning Laravel

Laravel has the most extensive and thorough documentation and video tutorial library of any modern web application framework. The [Laravel documentation](https://laravel.com/docs) is thorough, complete, and makes it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 900 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.
