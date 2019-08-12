## 關於這個專案

1.create a url shorten application
2.try to merge laravel admin

## 預計的schedule

day 1
1. Search for related technologies 2hr
2. build enviroment 1 hour
3. survey relative applicaton PicSee Lihi.io reurl  2hr
4. make router and view 3hr

day 2
1. make migration and Model 2 hr
2. make Controller 2 hr   (validation) (if url repeat) (create short url) 4hr
3. test

day 3
1. study Laravel admin 4hr (use about 1hr)
2. test Laravel admin 4hr  (use about 3hr 2hour at set config for upload file)

day 4 
1. merge Laravel admin and the app 8hr (use about 2 hour);



## 搜尋類似軟體功能 PicSee Lihi.io reurl .

### PicSee

會員能有提供額外服務:

1. 成效追蹤頁面: 不確定實際功能
2. Facebook讚數累計 : use fb FQL (need to check)
3. 追蹤 點擊來源 : by UTM
4. 使用者是用 手機 or 電腦 : detect dvice screen size or var x = "User-agent header sent: " + navigator.userAgent;
5. 點擊來源地圖: use ip to record where the click from
6. 可以抓網站圖: 不知道抓圖的根據是 ?? 可自訂圖片
7. 每小時點讚統計: 另創一個table 紀錄點擊的短網址(FK) and 時間戳

### Lihi.io 

1. AB test 分流: 紀錄點擊數, 利用%2 決定前往哪個網站
2. 可帶入UTM
3. 可埋 pixel/GTM
4. 圖表: 時間and訪客數 , useragent and 訪客數 , global map darker with more visitors


### reurl

1. 可插入UTM
2. 可以導入QRCode: can use google api 


安裝

1. 將專案複製到目的資料夾
```
git clone https://github.com/jasonwu513/shorturl.git
```

2. 安裝會用到的套件
```
composer install
```

3. 針對專案設定資料庫 and 資料庫使用者
```
mysqladmin -u root password
create database shorturl;
CREATE USER 'shorturl'@'localhost' IDENTIFIED BY 'yourpassword';
GRANT ALL PRIVILEGES ON shorturl.* TO ‘shorturl’@'localhost’;

```

4. 設定 .env 檔案
```
根據環境設定.env file 
```

5. 產生專案的 key
```
php artisan key:generate
```

6. 用migration 產生資料庫
```
php artisan migrate
```

如果出現錯誤
```
[PDOException]
SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes
```

調整預設資料長度

>  app/Providers/AppServiceProvider.php

at head add below content

```php
use Illuminate\Support\Facades\Schema;

```
and in boot function add
```php
public function boot()
{
    Schema::defaultStringLength(191);
}
```

將全部資料庫丟掉重新生成

```
php artisan migrate:fresh
```

7. 參考以下資料安裝 laravel admin
> https://laravel-admin.org/docs/zh/installation

8. > config/filesystems.php  進行 laravel admin 設定

```
        'admin' => [
            'driver'     => 'local',
            'root'       => public_path('upload'),
            'visibility' => 'public',
            'url' => env('APP_URL').'/upload/',
        ],
```

9. 根據路徑 設定 nginx or Apache Document Root

10. 設定DNS

## 使用說明 (User)

1. 在瀏覽器網址輸入 https://yaoshou365.com/

2. 將想要縮短的網址填入並送出
![user1](https://imgur.com/EaxhQSz.png)

3. 複製產生的短網址並使用
![user2](https://imgur.com/1okc92w.png)

## 使用說明 (Admin)

1. 在瀏覽器網址輸入 https://yaoshou365.com/admin/ 使用密碼登入

2. 點擊左方 Link Icon
![admin1](https://imgur.com/QsJAOUV.png)
1. 瀏覽資料並進行編輯
![admin2](https://imgur.com/UJTCX2Q.png)




<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of any modern web application framework, making it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 1100 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for helping fund on-going Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell):

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[British Software Development](https://www.britishsoftware.co)**
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Pulse Storm](http://www.pulsestorm.net/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
