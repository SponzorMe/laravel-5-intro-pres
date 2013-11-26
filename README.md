# Outline

## What is Laravel and what are its goals?

* Laravel is a web application framework with expressive, elegant syntax.
* Laravel is accessible, yet powerful.
* Built on good programming principles plus sugar for rapid prototyping
* Emphasis on testability - testing in mind from the beginning
* Great documentation

## What are some handy features?

* Facades
** Use Input::* as example.
** Auth::user() / guest()
** Eloquent and query builder
*** $post = DB::table('posts')->where('slug', 'l4-presentation')->first();
*** $posts = Post::withTag('laravel')->all();
* Form model binding
* Validator
** $data = ..., $rules = ...
** $validator = Validator::make(array('name' => 'David'), array('')
** if ($validator->fails()) return View::('fail')->withErrors($validator->getMessages());
* Security
** Auth::user(), Auth::guest()
* Helpers (array_*, str_*)
* Lots of others: Session, Cache, Mail, Queue, Event

## How do I do something simple?
* Download composer
* Generate project
** composer.phar create-project --prefer-dist laravel/laravel simple
* Route::get("/simple", function() {
   return "Howdy ho!";
});
* php artisan serve --port 8000

## Zero to CRUD
* generate migration - edit
* generate seeder - edit
** php artisan migrate --seed
* generate controller
** php artisan controller:maker GuestbookController - edit
* add route
** Route::resource('guests', 'GuestbookController');

## Where do I learn more?
* laravel.com: docs, api, forums
* http://laravel.io/
* IRC, http://laravel.io/irc
* Paid:
** https://leanpub.com/laravel
** https://laracasts.com/
** https://leanpub.com/laravel-testing-decoded

