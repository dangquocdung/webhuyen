@extends('qtht.layouts.home')

@section('content')
        <div class="panel panel-default">
            <div class="panel-heading in-hoa-dam">
              <strong>Danh sách Loại tin</strong>
            </div>

            <div class="panel-body">
              <div style="padding-bottom:10px">
                <a class="btn btn-primary" href="/qtht/chuyen-muc/them-chuyen-muc"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm Chuyên mục</a>
              </div>

              <div class="table-responsive">
                <table class="table table-striped table-hover">
                  <tr>
                    <th>TT</th>
                    <th>Chuyên mục</th>
                    <th>URL</th>
                    <th>TT Hiển thị</th>
                    <th>Số Loại tin</th>
                    <th>Số tin</th>
                    <th>Ghi chú</th>
                    <th>Thao tác</th>
                  </tr>
                  @foreach ($chuyenmuc as $cm)
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td style="text-align:left;">{{ $cm->ten }}</td>
                    <td style="text-align:left;">{{ $cm->slug }}</td>
                    <td>{{ $cm->thutu }}</td>
                    <td>
                      <?php $i=0; ?>
                      @foreach ($loaitin as $lt)
                        @if ($lt->menutop_id == $cm->id)
                          <?php $i++ ; ?>
                        @endif
                      @endforeach
                      {{ $i }}
                    </td>
                    <td>
                      <?php $i=0; ?>
                      @foreach ($tintuc as $tt)
                        @if ($tt->loaitin->menutop->id == $cm->id)
                          <?php $i++ ; ?>
                        @endif
                      @endforeach
                      {{ $i }}
                    </td>
                    <td style="text-align:left;">{{ $cm->ghichu }}</td>
                    <td style="text-align: center;">
                      <form action="#" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <a href="{{ url('qtht/chuyen-muc/sua-chuyen-muc/'.$cm->slug) }}" class="btn btn-warning btn-xs">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>

                        <a href="{{ url('qtht/chuyen-muc/xoa-chuyen-muc/'.$cm->id.'?token='.csrf_token()) }}" class="btn btn-danger btn-xs" onclick="return confirm('Bạn chắc chắn muốn xoá chuyên mục này?')">
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
