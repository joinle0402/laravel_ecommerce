@extends('admin.layouts.index')

@section('styles')
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css" integrity="sha512-uyGg6dZr3cE1PxtKOCGqKGTiZybe5iSq3LsqOolABqAWlIRLo/HKyrMMD8drX+gls3twJdpYX0gDKEdtf2dpmw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div class="container-fluid py-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Danh sách người dùng</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-12 flex justify-between">
                                <div>
                                    <label for="per_page" style="margin-bottom: 0;">
                                        <select class="form-control" id="per_page" onchange="window.location = this.value">
                                            <option value="{{ request()->fullUrlWithQuery(['per_page' => 10]) }}" @selected(request()->query('per_page', 10) === '10')>10</option>
                                            <option value="{{ request()->fullUrlWithQuery(['per_page' => 50]) }}" @selected(request()->query('per_page', 10) === '50')>50</option>
                                            <option value="{{ request()->fullUrlWithQuery(['per_page' => 100]) }}" @selected(request()->query('per_page', 10) === '100')>100</option>
                                            <option value="{{ request()->fullUrlWithQuery(['per_page' => 500]) }}" @selected(request()->query('per_page', 10) === '500')>500</option>
                                        </select>
                                    </label>
                                </div>
                                <div class="flex gap-2">
                                    <div class="input-group">
                                        <label for="keyword" style="margin-bottom: 0;">
                                            <input type="text" class="form-control" id="keyword" placeholder="Nhập từ khoá">
                                        </label>
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button" id="button-addon2">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-danger" onclick="handleButtonDeleteMultiple()">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <a  type="button" href="{{ route('admin.users.create') }}" class="btn btn-success">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <form id="form" method="POST">
                                    @csrf
                                    @method('POST')
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col" style="width: 50px;">
                                                <div class="icheck-primary">
                                                    <input type="checkbox" id="check_all">
                                                    <label for="check_all"></label>
                                                </div>
                                            </th>
                                            <th scope="col" class="table-column" style="width: 50px;">
                                                STT
                                            </th>
                                            <th scope="col" class="table-column">
                                                Thông tin cá nhân
                                            </th>
                                            <th scope="col" class="table-column">
                                                Địa chỉ
                                            </th>
                                            <th scope="col" class="table-column" style="width: 50px;">
                                                Hoạt động
                                            </th>
                                            <th scope="col" class="table-column" style="width: 100px;">
                                                Thao tác
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($users as $index => $user)
                                            <tr class="vertical-middle">
                                                <th class="vertical-middle" scope="row">
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" class="checkbox-row" id="checkbox-row-{{ $index }}" name="checkedRows[]" value="{{ $user->id }}">
                                                        <label for="checkbox-row-{{ $index }}"></label>
                                                    </div>
                                                </th>
                                                <td class="text-center vertical-middle">{{ $index + 1 }}</td>
                                                <td class="vertical-middle">
                                                    <ul>
                                                        <li>
                                                            <strong>Họ tên:</strong>
                                                            <span>{{ $user->name }}</span>
                                                        </li>
                                                        <li>
                                                            <strong>Email:</strong>
                                                            <span>{{ $user->email }}</span>
                                                        </li>
                                                        <li>
                                                            <strong>Điện thoại:</strong>
                                                            <span>{{ $user->phone }}</span>
                                                        </li>
                                                        <li>
                                                            <strong>Ngày Sinh:</strong>
                                                            <span>{{ date('d/m/Y', strtotime($user->birthday)) }}</span>
                                                        </li>
                                                        <li>
                                                            <strong>Nhóm thành viên:</strong>
                                                            <span>{{ $user->role_id === '1' ? 'Quản trị viên' : 'Cộng tác viên' }}</span>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="vertical-top">
                                                    <ul>
                                                        <li>
                                                            <strong>Tỉnh thành:</strong>
                                                            <span>{{ $user->province->full_name }}</span>
                                                        </li>
                                                        <li>
                                                            <strong>Quận huyện:</strong>
                                                            <span>{{ $user->district->full_name }}</span>
                                                        </li>
                                                        <li>
                                                            <strong>Phường xã:</strong>
                                                            <span>{{ $user->ward->full_name }}</span>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="vertical-middle text-center">
                                                    <label for="active-{{$index}}"></label>
                                                    <input type="checkbox" id="active-{{$index}}" class="switchery" @checked($user->active) />
                                                </td>
                                                <td class="vertical-middle">
                                                    <div class="flex gap-2">
                                                        <button type="button" class="btn btn-danger" onclick="handleButtonDeleteOneClick({{ $user->id }})">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-primary">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                            <div class="col-md-12 flex justify-end">
                                {{ $users->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js" integrity="sha512-lC8vSUSlXWqh7A/F+EUS3l77bdlj+rGMN4NB5XFAHnTR3jQtg4ibZccWpuSSIdPoPUlUxtnGktLyrWcDhG8RvA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('admin/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.switchery').each(function() {
                var switchery = new Switchery($(this)[0], {
                    color: '#2196F3'
                });
            });

            $('#check_all').on('click', function() {
                $('.checkbox-row').prop('checked', $(this).prop('checked'));
            });

            $('.checkbox-row').on('click', function() {
                $('#check_all').prop('checked', $('.checkbox-row:checked').length === $('.checkbox-row').length);
            });
        });

        function conformDialog(callback) {
            Swal.fire({
                title: "Bạn có chắc không?",
                text: "Bạn sẽ không thể hoàn nguyên điều này!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Thực hiện",
                cancelButtonText: "Hủy",
            }).then((result) => {
                if (result.isConfirmed) {
                    callback();
                }
            });
        }

        function handleButtonDeleteMultiple() {
            conformDialog(function () {
                if ($('.checkbox-row:checked').length > 0) {
                    $('input[name="_method"]').val('DELETE');
                    $('#form').attr('action', '{{ route('admin.users.deleteMany') }}').submit();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Bạn chưa chọn các dòng cần thực hiện chức năng này!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        }

        function handleButtonDeleteOneClick(id) {
            conformDialog(function () {
                $('input[name="_method"]').val('DELETE');
                const url = "{{ route('admin.users.destroy', ":id") }}".replace(':id', id);
                $('#form').attr('action', url).submit();
            });
        }
    </script>
@endsection
