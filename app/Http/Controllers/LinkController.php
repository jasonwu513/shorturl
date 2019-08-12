<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Link;
use App\Click;

class LinkController extends Controller
{
    public function make(Request $request){
        // echo $request->input('url');
        //validator 檢查輸入的網址是否符合 url 規範
        $validator = Validator::make($request->all(),[
            'url' => 'required|url|max:500'
        ]);
        if($validator->fails()){
            // 如果輸入錯誤 返回error
            return redirect('/')->withErrors($validator);
        } else{
            //如果輸入正確
            $url = $request->input('url');
            $code = null;
            //檢查此網址是否已經存在
            $existsUrl = Link::where('url', '=', $url);
            if($existsUrl->count() === 1){
                //如果已經存在,將已存在的code 顯示出來 印成link 的模式
                $code = $existsUrl->first()->code;
                $url = $existsUrl->first()->url;
                //短網址為
                $shortenUrl = url('/').'/'.$code;

                // return view('home', compact('url','code'));
                return view('home') -> with('shortenUrl' , $shortenUrl );
                
            }else{
                // 如果不存在創造一個新的短網址 
                // 隨機產稱生str_random(8) (62^8 種可能性)
                // 檢查是否有重複生成的短碼 如果重複再生成一個直到不重複
                do {
                $code = str_random(8);
                $existsCode = Link::where('code', '=', $code);
                } while ($existsCode->count() === 1);

                // 將不重複的code and url 存入資料庫,
                $createShortUrl = Link::create(['url' => $url , 'code' => $code ]) ;
                // 返回主頁
                $shortenUrl = url('/').'/'.$code;
                return view('home') -> with('shortenUrl' , $shortenUrl );
            }
        }

    }
    public function redirectTo($code){
        //將帶有參數的輸入轉址至url 網頁

        // 利用$code 找出對應的網址

        // echo $code;
        $findOrigin = Link::where('code', '=', $code)->first();
        echo $findOrigin;
        if ($findOrigin) {
            //轉址到對應的網站;
            $ip =  $_SERVER['REMOTE_ADDR'];
            // echo $findOrigin->id;
            $ip_data = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));

            if($ip_data && $ip_data->geoplugin_countryName != null){
                $country = $ip_data->geoplugin_countryCode;
                $city = $ip_data->geoplugin_city;
                $recordClick = Click::create(['ip' => $ip, 'country' => $country , 'city' => $city   , 'link_id' => $findOrigin->id]) ;
            } else {
                $country = "unknown";
                $city = "unknown";
                $recordClick = Click::create(['ip' => $ip, 'country' => $country , 'city' => $city   , 'link_id' => $findOrigin->id]) ;
                // echo $country;
            }


            return redirect($findOrigin->url);
        }else{
            return view('home') -> with('notFound' , 'OOPS 找不到您所輸入的網址' );
        }
        
    }
}
