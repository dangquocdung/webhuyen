<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use App\MenuTop;
use App\MenuVB;
use App\LoaiTin;
use App\TinTuc;
use App\BannerTop;
use App\HinhSlide;
use App\LoaiVB;
use App\VanBan;
use App\LichCongTac;
use App\VideoClip;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer(['front.trangchu', 'front.loaitin', 'front.chitiettin', 'front.video', 'front.lichcongtac', 'front.datcauhoi', 'front.thugopy', 'front.hoidap', 'front.vanban'],function($view){

          $menutop = MenuTop::all();
          $view->with('menutop',$menutop);

          $menuvb = MenuVB::all();
          $view->with('menuvb',$menuvb);

          $loaivb = LoaiVB::all();
          $view->with('loaivb',$loaivb);

          $thongbao = VanBan::where('loaivb_id', '1')->where('active', '1')->orderby('created_at','desc')->limit(5)->get();
          $view->with('thongbao',$thongbao);

          $video1 = VideoClip::orderby('thutu','asc')->orderby('created_at','desc')->first();
          $view->with('video1',$video1);

          // $loaitin = LoaiTin::where('menutop_id',2)->orderby('id','asc')->get();
          // $view->with('loaitin',$loaitin);

          $slider = HinhSlide::orderby('thutu','asc')->get();
          $view->with('slider',$slider);

          $vanban = VanBan::orderby('created_at','desc')->get();
          $view->with('vanban',$vanban);

          $namtinmoinhat = TinTuc::where('active', '1')->orderby('id','desc')->limit(5)->get();
          $view->with('namtinmoinhat',$namtinmoinhat);

        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
