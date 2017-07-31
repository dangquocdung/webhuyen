@extends('qtht.layouts.home')
@section('content')
  <div class="row">
    <div class="list-group">

      <a  class="list-group-item active main-color-bg">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> {{ $tin->loaitin->ten}}
      </a>

      <div class="list-group-item">

        <div class="chi-tiet-tin">
          <h3>{{ $tin->tieude }}</h3>
          <br>
          <div class="news-desc">
              {{ $tin->tomtat }}
          </div>
          
          <div class="noi-dung">
            {!! $tin->noidung !!}
        </div>
        </div>
      </div>
    </div>

  </div><!--/row-->
@endsection
