<h1>Cach setup</h1>
<b>$cp .env.example .env $ composer install $ npm install $ php artisan key:generate</b>
<br>
Tao database va edit config trong env
<br>
$ php artisan migrate
<br>
$ php artisan db:seed
<br>
$ php artisan serve
<br>
Done

<br>
<h2>Route list<h2>
<br>
+--------+-----------+-----------------------------+------------------+------------------------------------------------+--------------+
| Domain | Method    | URI                         | Name             | Action                                         | Middleware   |
+--------+-----------+-----------------------------+------------------+------------------------------------------------+--------------+
|        | GET|HEAD  | /                           |                  | Closure                                        | web          |
|        | GET|HEAD  | api/contacts                | contacts.index   | App\Http\Controllers\ContactController@index   | api          |
|        | POST      | api/contacts                | contacts.store   | App\Http\Controllers\ContactController@store   | api          |
|        | GET|HEAD  | api/contacts/create         | contacts.create  | App\Http\Controllers\ContactController@create  | api          |
|        | GET|HEAD  | api/contacts/{contact}      | contacts.show    | App\Http\Controllers\ContactController@show    | api          |
|        | PUT|PATCH | api/contacts/{contact}      | contacts.update  | App\Http\Controllers\ContactController@update  | api          |
|        | DELETE    | api/contacts/{contact}      | contacts.destroy | App\Http\Controllers\ContactController@destroy | api          |
|        | GET|HEAD  | api/contacts/{contact}/edit | contacts.edit    | App\Http\Controllers\ContactController@edit    | api          |
|        | GET|HEAD  | api/user                    |                  | Closure                                        | api,auth:api |
+--------+-----------+-----------------------------+------------------+------------------------------------------------+--------------+
