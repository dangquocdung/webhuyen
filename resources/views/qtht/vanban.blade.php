@extends('qtht.layouts.home')

@section('content')

@if ( Auth::user()->level > 1 )
  <div class="panel panel-default">
      <div class="panel-heading  in-hoa-dam">
        {{-- {!! Form::open(['method'=>'GET','url'=>'qtht/home','role'=>'search'])!!}
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">Danh sách tin tức</h4>
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search..." style="max-width:180px; float:right;">
            <div class="input-group-btn">
              <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
              <button class="btn btn-primary"><i class="glyphicon glyphicon-wrench"></i></button>
            </div>
        </div>
        {!! Form::close()!!} --}}
        <strong>Danh sách văn bản</strong>
        {{-- {!! Form::open(['method'=>'GET','url'=>'qtht/home','class'=>'navbar-form navbar-right','role'=>'search'])!!}
          <div class="input-group custom-search-form">
            <input type="text" name="search" class="form-control" placeholder="Search....">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-default-sm">
                <i class="fa fa-search"></i>
              </button>
            </span>
          </div>
        {!! Form::close()!!} --}}
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-2 col-xs-4">
            <div style="padding-bottom:10px">
              <a class="btn btn-primary" href="/qtht/van-ban/them-van-ban"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm văn bản</a>
            </div>
          </div>
          <div class="col-md-4 col-md-push-6 col-xs-6 col-xs-push-2">
            {!! Form::open(['method'=>'GET', 'ulr'=>'qtht/van-ban/home', 'role'=>'search']) !!}
              <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search...">
                <div class="input-group-btn">
                  <button class="btn btn-default" type="submit">
                    <i class="glyphicon glyphicon-search"></i>
                  </button>
                </div>
              </div>
            {!! Form::close() !!}

          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <tbody>


            <tr>
              <th>Ngày ban hành</th>
              <th>Số</th>
              <th>Trích yếu</th>
              <th>Tệp Văn bản</th>
              <th>Người kí</th>
              <th>Loại văn bản</th>
              <th>Chuyên mục</th>
              <th>Người đăng</th>
              <th>Đã duyệt</th>
              <th>Thao tác</th>

            </tr>
            @foreach ($vanban as $vb)
            <tr>
              <td>{{ $vb->ngaybanhanhvb }}</td>
              <td>{{ $vb->sovb }}</td>
              <td style="text-align:left;">{{ str_limit($vb->trichyeuvb, $limit=120, $end='......') }}</td>
              <td style="text-align:left;">
                <a href="{{$vb->tepvanban}}" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
              </td>
              <td>{{ $vb->nguoiki }}</td>
              <td>{{ $vb->loaivb->ten }}</td>
              <td>{{ $vb->menuvb->ten }}</td>
              <td>{{ $vb->nguoidang->name }}</td>



              <td>
                @if ($vb->active==0)
                  <input type="checkbox" name="" value="" disabled="">
                @else
                  <input type="checkbox" name="" value="" checked="" disabled="">
                @endif
              </td>


              <td style="text-align: center;">
                @if ($vb->active==0 || Auth::user()->level > 2 )
                  <form action="#" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                    <a href="{{ url('qtht/van-ban/sua-van-ban/'.$vb->slug) }}" class="btn btn-warning btn-xs">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>

                    <a href="{{ url('qtht/van-ban/xoa-van-ban/'.$vb->id.'?token='.csrf_token()) }}" class="btn btn-danger btn-xs" onclick="return confirm('Bạn chắc chắn muốn xoá văn bản này?')">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </form>
                @endif
              </td>
            </tr>
            @endforeach
            </tbody>
          </table>
          {{-- pagination --}}
          {!! $vanban->links() !!}
        </div>
      </div>
  </div>
@endif

@endsection
