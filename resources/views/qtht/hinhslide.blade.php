@extends('qtht.layouts.home')

@section('content')
        <div class="panel panel-default">
            <div class="panel-heading  in-hoa-dam">
              <strong>Danh sách hình slide</strong>
            </div>

            <div class="panel-body">
              <div style="padding-bottom:10px">
                <a class="btn btn-primary" href="/qtht/hinh-slide/them-hinh-slide"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm hình slide</a>
              </div>

              <div class="table-responsive">
                <table class="table table-striped table-hover">
                  <tr>
                    <th>TT</th>
                    <th>Tiêu đề</th>
                    <th>Hình</th>
                    <th>Thứ tự hiện thị</th>
                    <th>Thao tác</th>
                  </tr>
                  @foreach ($slider as $slide)
                  <tr>
                    <td>{{ $slide->id }}</td>
                    <td style="text-align:left;">{{ $slide->tieude }}</td>

                    <td>
                      <a class="urlhinh" href="{{ $slide->hinh }}">
                        <img class="img-responsive" src="{{ $slide->hinh }}" style="max-width:100px; max-height:50px; float:left">
                      </a>
                    </td>

                    <td>{{ $slide->thutu }}</td>

                    <td style="text-align: center;">
                      <form action="#" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <a href="{{ url('qtht/hinh-slide/sua-hinh-slide/'.$slide->id) }}" class="btn btn-warning btn-xs">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>

                        <a href="{{ url('qtht/hinh-slide/xoa-hinh-slide/'.$slide->id.'?token='.csrf_token()) }}" class="btn btn-danger btn-xs" onclick="return confirm('Bạn chắc chắn muốn xoá hình slide này?')">
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
