@extends('qtht.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading  in-hoa-dam"><strong>Danh sách tin/bài trong mục {{ $tenloai->ten }}</strong></div>

            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover">
                  <tr>
                    <th>TT</th>
                    <th>Tiêu đề</th>
                    <th>Loại tin</th>
                    <th>Minh hoạ</th>
                    <th>Hiện/Ẩn</th>
                    <th>Ngày tạo</th>
                    <th>Ghi chú</th>
                    <th>
                      <a class="btn btn-sm btn-primary" href="#">Thêm</a>
                    </th>
                    <th></th>
                  </tr>
                  <?php  $stt=1; ?>
                  @foreach ($tintheoloai as $tin)
                  <tr>
                    <td>{{ $stt }}</td>
                    <td>
                      <a href="/{{$tin->loaitin->menutop->tenkhongdau}}/{{$tin->loaitin->tenkhongdau}}/{{$tin->id}}-{{$tin->tieudekhongdau}}" target="_blank">{{ $tin->tieude }}</a>
                    </td>
                    <td>{{ $tin->loaitin->ten }}</td>

                    <td>
                      <a class="urlhinh" href="{{ url('storage/tin-tuc/img/'.$tin->urlhinh }}">
                        <img src="{{ url('storage/tin-tuc/img/'.$tin->urlhinh) }}" >
                      </a>
                    </td>
                    <td>
                      @if ($tin->hienthi == 1)
                      <input type="checkbox" checked>
                      @else
                      <input type="checkbox">
                      @endif
                    </td>
                    <td>{{ $tin->created_at}}</td>


                    <td>{{ $tin->ghichu }}</td>

                    <td style="text-align: center;">
                      <form action="#" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">


                        <button onclick="return confirm('Bạn muốn xóa tin này?')" type="submit" class="btn btn-sm btn-danger">Xoá</button>
                      </form>
                    </td>
                    <td>
                      <a class="btn btn-sm btn-warning" href="/qtht/tin-bai/sua/{{ $tin->id }}">Sửa</a>

                    </td>
                  </tr>

                  <?php  $stt++; ?>
                  @endforeach
                </table>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
