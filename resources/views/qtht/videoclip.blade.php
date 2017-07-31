@extends('qtht.layouts.home')

@section('content')
        <div class="panel panel-default">
            <div class="panel-heading  in-hoa-dam">
              <strong>Danh sách video</strong>
            </div>

            <div class="panel-body">
              <div style="padding-bottom:10px">
                <a class="btn btn-primary" href="/qtht/video-clip/them-video"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm video</a>
              </div>

              <div class="table-responsive">
                <table class="table table-striped table-hover">
                  <tr>
                    <th>TT</th>
                    <th>Tiêu đề</th>
                    <th>Video</th>
                    <th>Thứ tự hiện thị</th>
                    <th>Thao tác</th>
                  </tr>
                  @foreach ($videos as $video)
                  <tr>
                    <td>{{ $video->id }}</td>
                    <td style="text-align:left;">{{ $video->tieude }}</td>

                    <td>
                      <div class="video-container">
                        {!! $video->videoclip !!}
                      </div>
                    </td>

                    <td>{{ $video->thutu }}</td>

                    <td style="text-align: center;">
                      <form action="#" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <a href="{{ url('qtht/video-clip/sua-video/'.$video->id) }}" class="btn btn-warning btn-xs">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>

                        <a href="{{ url('qtht/video-clip/xoa-video/'.$video->id.'?token='.csrf_token()) }}" class="btn btn-danger btn-xs" onclick="return confirm('Bạn chắc chắn muốn xoá video này?')">
                          <span class="glyphicon glyphicon-trash"></span>
                        </a>
                      </form>
                    </td>
                  </tr>

                  @endforeach
                </table>
              </div>
            </div>
        </div>

@endsection
