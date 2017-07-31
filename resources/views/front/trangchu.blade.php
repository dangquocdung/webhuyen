@extends('front.layouts.home')
@section('title')
  <title>{{ config('app.name', 'Dang Quoc Dung') }}</title>
@endsection
@section('content')

{{-- <div class="row"> --}}
  <!-- slider -->
  <div class="list-group">

       <div class="list-group-item active main-color-bg">
         <a href="/lich-cong-tac" style="text-transform:uppercase; color:white">
           <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
           {{ Carbon\Carbon::now()->formatLocalized('Ngày %d tháng %m năm %Y | %H:%M GMT+7') }}
         </a>
         <p class="pull-right visible-xs" >
           <a data-toggle="offcanvas" style="color:red">
             <span class="glyphicon glyphicon-forward site-logo" aria-hidden="true"></span>
           </a>
         </p>
       </div>
       <div class="tab-group-item">
         <!-- Tab panes -->
         <div class="tab-content">
           <div class="row">
             @php

               $tenNews = $mt->tintuc->where('active','1')->sortByDesc('created_at')->take(10);

               $toptenNews = $mt->tintuc->where('active','1')->where('tinnoibat',1)->sortByDesc('created_at')->take(11);

               $fn = $toptenNews->shift();

             @endphp

           </div>


         </div>
       </div>
  </div>

  <div class="list-group">
    <img src="/img/banner/thuong-binh-liet-sy.jpg" alt="" width="100%">
  </div>

    @php
      $mt = $menutop->find(2);
      $loaitin = $mt->loaitin->all();
    @endphp

    @foreach ($loaitin as $lt)

        <div class="list-group">
          <a class="list-group-item active main-color-bg" href="/loai-tin/{{ $lt->slug }}" style="text-transform:uppercase">
            <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>  <strong>&nbsp{{ $lt->ten }}</strong>
            <p class="pull-right" >
              <span class="glyphicon glyphicon-forward" aria-hidden="true"></span>
            </p>
          </a>
          <div class="list-group-item" style="padding-bottom:0px; padding-left:0px; padding-right:0px; overflow:hidden">
            <div class="row">

              @php
                $data = $lt->tintuc->where('active','1')->sortByDesc('created_at')->take(5);
                $tin1 = $data->shift();
              @endphp

              <div class="col-md-7 col-sm-12 col-xs-12 tintuc">
                <div class="col-md-5 col-sm-5 minhhoa">
                  @if ($tin1['urlhinh'])
                    <a href="/chi-tiet-tin/{{ $tin1['tieudekhongdau']}}">
                        <img src="{{ $tin1['urlhinh'] }}" alt="" width="100%">
                    </a>
                  @else
                    <a href="/chi-tiet-tin/{{ $tin1['tieudekhongdau']}}">
                        <img src="image/placeholder.png" alt="" width="100%">
                    </a>
                  @endif
                </div>
                <div class="col-md-7 col-sm-7">
                  <a href="/chi-tiet-tin/{{ $tin1['tieudekhongdau']}}">
                    <h4>
                      {{ $tin1['tieude'] }}
                    </h4>
                  </a>
                  <div class="news-desc">

                      {{ str_limit($tin1['tomtat'], $limit=200, $end='...') }}

                  </div>
                </div>
              </div>

              <div class="col-md-5 col-sm-5 hidden-xs hidden-sm">
                @foreach ($data as $tt)
                  {{-- <a href="/chi-tiet-tin/{{ $tt->tieudekhongdau}}">
                    <h5>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      {{ $tt->tieude }}
                    </h5>
                  </a> --}}

                  <div class="tin-moi-theo-loai">
                    <table>
                      <tr>
                        <td>
                        @if ($tt->urlhinh)
                          <img src="{{ $tt->urlhinh }}" alt="" style="max-width:50px;">
                        @else
                            <img src="image/placeholder.png" alt="" style="max-width:50px;">
                        @endif
                        </td>
                        <td  style="text-align:left; padding-left: 10px;"><a href="/chi-tiet-tin/{{$tt->tieudekhongdau}}">{{ $tt->tieude }}</a></td>
                      </tr>
                    </table>
                  </div>
                @endforeach
              </div>
            </div>
            <div class="footer-mega-link">
              <a href="/loai-tin/{{ $lt->slug }}"><small>Nhiều hơn...</small></a>
            </div>
          </div>
        </div>

  @endforeach

{{-- </div> --}}
@endsection
