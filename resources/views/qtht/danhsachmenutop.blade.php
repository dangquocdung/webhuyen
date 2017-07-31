@extends('qtht.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading  in-hoa-dam"><strong>Danh sách menu </strong></div>

            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover">
                  <tr>
                    <th>TT</th>
                    <th>Tên</th>
                    <th>Thứ tự</th>
                    <th>Ẩn/Hiện</th>
                    <th></th>
                    <th></th>
                  </tr>
                  <?php  $stt=1; ?>
                  @foreach ($menutop as $mt)
                  <tr>
                    <td>{{ $stt }}</td>
                    <td>
                      {{ $mt->ten }}
                    </td>
                    <td>
                      {{ $mt->thutu }}
                    </td>
                    <td>

                      @if ($mt->hienthi == 1)
                      <input type="checkbox" checked>
                      @else
                      <input type="checkbox">
                      @endif

                    </td>
                    <td style="text-align: center;">
                      <form action="/qtht/xoa-Menu/{{ $mt->id }}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <button onclick="return confirm('Bạn muốn xóa tin này?')" type="submit" class="btn btn-sm btn-danger">Xoá</button>
                      </form>
                    </td>
                    <td>
                      <a class="btn btn-sm btn-warning" href="#">Sửa</a>

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
