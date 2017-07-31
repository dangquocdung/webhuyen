@extends('front.layouts.home')

@section('title')
  <title>{{ $tin->tieude}}</title>
@endsection

@section('content')

  <div class="list-group">
    <div  class="list-group-item active main-color-bg in-hoa-dam">
      {{-- <a href="/"><i class="fa fa-home" aria-hidden="true"></i> &nbspTrang chủ</a> /  --}}
      <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> &nbsp{{ $tin->loaitin->ten}}

      <p class="pull-right visible-xs" >
        <a data-toggle="offcanvas" style="color:red">
          <span class="glyphicon glyphicon-forward site-logo" aria-hidden="true"></span>
        </a>
      </p>
    </div>






    {{-- <div class="panel panel-default" style="margin-bottom: 0">
      <div class="panel-heading in-hoa-dam">
          <i class="fa fa-calendar" aria-hidden="true"></i><a href="/loai-tin/{{ $tin->loaitin->slug}}">  Tin {{ $tin->loaitin->ten}}</a> / {{ $tin->tieude }}
         <p class="pull-right visible-xs" >
           <a data-toggle="offcanvas" style="color:red">
             <span class="glyphicon glyphicon-forward site-logo" aria-hidden="true"></span>
           </a>
         </p>
      </div>
    </div> --}}

    <div class="list-group-item">
      <div class="chi-tiet-tin">
        <h3>{{ $tin->tieude }}</h3>
        <div class="thong-tin">
          <p style="margin: 10px 0 20px"><span class="glyphicon glyphicon-time"></span> {{ Carbon\Carbon::parse($tin->created_at)->format('h:m d-m-Y ') }}</p>
          {{-- <span>- <strong>{{ $tin->nguoidang->name }}</strong></span> --}}
        </div>

        <div class="news-desc">
          <p>{{ $tin->tomtat }}</p>
        </div>
          <div class="noi-dung">
            {!! $tin->noidung !!}
          </div>

          @if ( Auth::user() && Auth::user()->is_admin() )
            <div class="" style="text-align:right">
              <form action="#" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <a href="{{ url('qtht/sua-tin-bai/'.$tin->tieudekhongdau) }}" class="btn btn-warning btn-xs">
                  <span class="glyphicon glyphicon-edit"></span>
                </a>

                <a href="{{ url('qtht/xoa-tin-bai/'.$tin->id.'?token='.csrf_token()) }}" class="btn btn-danger btn-xs" onclick="return confirm('Bạn chắc chắn muốn xoá tin?')">
                  <span class="glyphicon glyphicon-trash"></span>
                </a>
              </form>

            </div>

          @endif
      </div>

      <hr>


    <h4>Các tin mới đăng</h4>
    @foreach ($namtinmoinhat as $ttl)
        <a href="/chi-tiet-tin/{{ $ttl->tieudekhongdau }}">
          <h5> <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
          {{ $ttl->loaitin->ten}}: &nbsp{{ $ttl->tieude }}</h5>
        </a>


    @endforeach
  {{-- </div> --}}

  @php

    $namtincungloai  = $loaitinchitiet->tintuc->where('active','1')->sortByDesc('created_at')->take(5);

  @endphp

  <hr>

  <h4>Các cùng loại</h4>
  @foreach ($namtincungloai as $ttl)
      <a href="/chi-tiet-tin/{{ $ttl->tieudekhongdau }}">
        <h5><span class="glyphicon glyphicon-check" aria-hidden="true"></span>
        {{ $ttl->loaitin->ten}}: &nbsp{{ $ttl->tieude }}</h5>
      </a>


  @endforeach
  </div>

</div>




@endsection
