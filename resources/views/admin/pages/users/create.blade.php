@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid py-3">
        <div class="row">
            <div class="col-md-12">
                <h2>Thêm mới người dùng</h2>
            </div>
        </div>
        <form id="form" action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="row mt-3">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email: <span style="color: red;">(*)</span></label>
                                        <input type="email" @class(['form-control', 'is-invalid' => $errors->has('email')]) id="email" name="email" value="{{ old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Họ tên: <span style="color: red;">(*)</span></label>
                                        <input type="text" @class(['form-control', 'is-invalid' => $errors->has('name')]) id="name" name="name" value="{{ old('name') }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mật khẩu:</label>
                                        <div class="relative">
                                            <input @class(['form-control', 'is-invalid' => $errors->has('password')]) type="password" id="password" name="password" value="{{ old('confirm_password') }}">
                                            <button type="button" class="button-icon" onclick="handleButtonToggleShowPasswordClicked(this)">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nhập lại mật khẩu:</label>
                                        <div class="relative">
                                            <input @class(['form-control', 'is-invalid' => $errors->has('confirm_password')]) type="password" id="confirm_password" name="confirm_password" value="{{ old('confirm_password') }}">
                                            <button type="button" class="button-icon" onclick="handleButtonToggleShowPasswordClicked(this)">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            @error('confirm_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role_id">Nhóm thành viên: <span
                                                style="color: red;">(*)</span></label>
                                        <select
                                            @class(['form-control select2', 'is-invalid' => $errors->has('role_id')]) id="role_id"
                                            name="role_id">
                                            <option value="">Chọn nhóm thành viên</option>
                                            <option value="1" @selected(old('role_id') === '1')>Quản trị viên</option>
                                            <option value="2" @selected(old('role_id') === '2')>Cộng tác viên</option>
                                        </select>
                                        @error('role_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="birthday">Ngày sinh:</label>
                                        <input type="text"
                                               @class(['form-control', 'is-invalid' => $errors->has('birthday')]) id="birthday"
                                               name="birthday" value="{{ old('birthday') }}" autocomplete="off">
                                        @error('birthday')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="avatar">Ảnh đại diện: {{ old('avatar') }}</label>
                                        <input type="file"
                                               @class(['form-control-file', 'is-invalid' => $errors->has('avatar')]) onchange="handleInputAvatarChange(this)"
                                               accept="image/*" id="avatar" name="avatar">
                                        @error('avatar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div id="image-preview" style="display: none;"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Số điện thoại: </label>
                                        <input type="text"
                                               @class(['form-control', 'is-invalid' => $errors->has('phone')]) id="phone"
                                               name="phone" value="{{ old('phone') }}">
                                        @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="province_code">Tỉnh thành:</label>
                                        <select class="form-control select2 select2-primary" id="province_code"
                                                name="province_code" onchange="handleSelectProvinceChange()"
                                                data-dropdown-css-class="select2-primary" style="width: 100%;">
                                            <option value="">Chọn thành phố</option>
                                            @foreach ($provinces as $province)
                                                <option
                                                    value="{{ $province->code }}" @selected($province->code === old('province_code'))>
                                                    {{ $province->full_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('province_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="district_code">Quận Huyện:</label>
                                        <select class="form-control select2 select2-primary"
                                                onchange="handleSelectDistrictChange()" id="district_code"
                                                name="district_code" data-dropdown-css-class="select2-primary"
                                                style="width: 100%;">
                                            <option value="">Chọn quận huyện</option>
                                            @if (!empty(old('province_code')))
                                                @php $districts = App\Models\District::query()->where('province_code', old('province_code'))->get(); @endphp
                                                @foreach ($districts as $district)
                                                    <option
                                                        value="{{ $district->code }}" @selected($district->code === old('district_code'))>
                                                        {{ $district->full_name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('district_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ward_code">Phường Xã:</label>
                                        <select class="form-control select2 select2-primary" id="ward_code"
                                                name="ward_code" onchange="updateTextareaAddress()"
                                                data-dropdown-css-class="select2-primary" style="width: 100%;">
                                            <option value="">Chọn quận huyện</option>
                                            @if (!empty(old('district_code')))
                                                @php $wards = App\Models\Ward::query()->where('district_code', old('district_code'))->get(); @endphp
                                                @foreach ($wards as $ward)
                                                    <option
                                                        value="{{ $ward->code }}" @selected($ward->code === old('ward_code'))>
                                                        {{ $ward->full_name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('ward_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="street">Đường: </label>
                                        <input type="text"
                                               @class(['form-control', 'is-invalid' => $errors->has('street')]) onchange="updateTextareaAddress()"
                                               id="street" name="street" value="{{ old('street') }}">
                                        @error('street')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Địa chỉ: </label>
                                        <textarea class="form-control" id="address" name="address"
                                                  rows="3">{{ old('address') }}</textarea>
                                        @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="note">Ghi chú: </label>
                                        <textarea class="form-control" id="note" name="note"
                                                  rows="3">{{ old('note') }}</textarea>
                                        @error('note')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-md-8 flex gap-2 justify-end">
                    <a type="button" href="{{ route('admin.users.index') }}" class="btn btn-secondary">Trờ về</a>
                    <button type="button" class="btn btn-primary" onclick="handleButtonThemClick()">Thêm</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.css') }}">
    <style>
        .ui-datepicker td span, .ui-datepicker td a {
            padding: 0.5em;
        }

        .ui-datepicker .ui-datepicker-prev, .ui-datepicker .ui-datepicker-next {
            height: 100%;
            padding: 0 16px;
        }

        .ui-datepicker-header {
            background-color: #FF8C00;
        }

        .ui-datepicker-title select {
            padding: 4px;
        }

        #confirm_password.form-control.is-invalid,
        #password.form-control.is-invalid,
        .was-validated .form-control:invalid {
            background-image: none;
        }
    </style>
@endsection

@section('scripts')
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/jquery-ui/jquery.ui.datepicker-vi-VN.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.select2').select2();
            $('#birthday').datepicker({
                showAnim: "slideDown",
                dateFormat: "dd/mm/yy",
                minDate: "01/01/1950",
                maxDate: new Date(),
                changeMonth: true,
                changeYear: true,
                showOtherMonths: true,
                selectOtherMonths: false,
                yearRange: `1950:+0`,
            });
        });

        function options(data, {value = 'id', text = 'name_vn', defaultText = "", defaultValue = "", dataset = {}}) {
            if (!Array.isArray(data) && data.length > 0) return false;
            if (typeof value === 'string') value = [...value.split(',').map(field => field.trim())];
            if (typeof text === 'string') text = [...text.split(',').map(field => field.trim())];

            const result = [`<option value="${defaultValue}">${defaultText}</option>`];
            for (const item of data) {
                const datasetOption = [];
                for (const [key, datasetField] of Object.entries(dataset))
                    if (typeof datasetField === 'string' && item.hasOwnProperty(datasetField))
                        datasetOption.push(`data-${key}="${item[datasetField]}"`);
                const valueOption = value.map((valueField) => item[valueField]).join(',');
                const textOption = text.map((displayField) => item[displayField]).join(' - ');
                result.push(`<option value="${valueOption}" ${datasetOption.join(' ')}>${textOption}</option>`);
            }
            return result.join('');
        }

        async function handleSelectProvinceChange() {
            const province_code = $('#province_code').val();
            if (province_code) {
                const response = await ajax("GET", `/api/provinces/${province_code}/districts`);
                $('#district_code').html(options(response, {
                    value: 'code',
                    text: 'full_name',
                    defaultText: 'Chọn quận huyện'
                }));
                updateTextareaAddress();
            } else {
                $('#district_code').val(null).trigger('change');
            }
        }

        async function handleSelectDistrictChange() {
            const district_code = $('#district_code').val();
            if (district_code) {
                const response = await ajax('GET', `/api/districts/${district_code}/wards`);
                $('#ward_code').html(options(response, {
                    value: 'code',
                    text: 'full_name',
                    defaultText: 'Chọn phường xã'
                }));
                updateTextareaAddress();
            } else {
                $('#ward_code').val(null).trigger('change');
            }
        }

        function handleInputAvatarChange(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                $('#image-preview').show();
                reader.onload = function (event) {
                    $('#image-preview').html("<img src='' alt='avatar' id='avatar-preview' width='50' style='object-fit: cover;' />");
                    $('#avatar-preview').attr('src', event.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function updateTextareaAddress() {
            const address = [];
            address.push($("#street").val());
            address.push($("#ward_code").find(":selected").val() ? $("#ward_code").find(":selected").text() : '');
            address.push($("#district_code").find(":selected").val() ? $("#district_code").find(":selected").text() : '');
            address.push($("#province_code").find(":selected").val() ? $("#province_code").find(":selected").text() : '');
            $('#address').val(address.filter(v => v).map(v => v.trim()).join(', '));
        }

        function handleButtonThemClick() {
            Swal.fire({
                text: "Bạn có chắc muốn thực hiện thao tác này?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Thực hiện",
                cancelButtonText: "Hủy",
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#form').submit();
                }
            });
        }

        function handleButtonToggleShowPasswordClicked(element) {
            console.log('handleButtonToggleShowPasswordClicked:', {element});
            const icon = $(element).find('i');
            const input = $(element).prev('input');
            if (input.attr('type') === 'text') {
                input.attr('type', 'password');
                icon.removeClass('fa-eye-slash');
                icon.addClass('fa-eye');
            } else {
                input.attr('type', 'text');
                icon.addClass('fa-eye-slash');
                icon.removeClass('fa-eye');
            }
        }
    </script>
@endsection
