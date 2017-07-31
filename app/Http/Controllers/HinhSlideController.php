<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


use App\HinhSlide;

class HinhSlideController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');


  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $search = $request->get('search');
      $slider = HinhSlide::where('tieude','like','%'.$search.'%')->orderBy('created_at')->get();

      return view('qtht.hinhslide',['slider'=>$slider]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //
      if (Auth::user()->is_tbbt() || Auth::user()->is_admin() ){

        return view('qtht.themhinhslide');

      }else{
        return redirect ('/')->withErrors('Bạn không có quyền đăng bài!');
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $slide = new HinhSlide;
      $slide->user_id = Auth::user()->id;
      $slide->tieude = $request->get('tieude');

      if ($request->file('hinh')){
        $file = $request->file('hinh');
        $tenhinh = Storage::put('public/img/hinh-slide', $file);
      }else{
        $tenhinh = $slide->urlhinh;
      }
      $slide->hinh = $tenhinh;
      $slide->thutu = $request->get('thutu');
      $slide->ghichu = $request->get('ghichu');

      $slide->save();

      return redirect('qtht/hinh-slide/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $slide = HinhSlide::find($id);
      if ($slide && ( Auth::user()->is_tbbt() || Auth::user()->is_admin())){

        return view ('qtht.suahinhslide')->with('slide',$slide);
      }else{
        return redirect ('qtht/hinh-slide/home')->withErrors('Bạn không có quyền sửa tin bài này!');
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $slide_id = $request->get('id');

      $slide = HinhSlide::find($slide_id);

      if ($slide && (Auth::user()->is_tbbt() || Auth::user()->is_admin())){
        $slide->tieude = $request->get('tieude');

        if ($request->file('hinh')){
          $file = $request->file('hinh');
          $tenhinh = Storage::put('public/img/hinh-slide', $file);
          $slide->hinh = $tenhinh;
        }
        $slide->thutu = $request->get('thutu');
        $slide->ghichu = $request->get('ghichu');

        $slide->save();

        return redirect('qtht/hinh-slide/home');

      }else{
        return redirect ('qtht/hinh-slide/home')->withErrors('Bạn không có quyền sửa tin bài này!');
      }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $slide = HinhSlide::find($id);

      if ($slide && (Auth::user()->is_tbbt() || Auth::user()->is_admin())){
        $slide->delete();
        $data['message'] = 'Xoá hình slide thành công!';
      }else{
        $data['errors'] = 'Bạn không có quyền xoá tin này!';
      }

      return redirect('qtht/hinh-slide/home')->with($data);
    }
}
