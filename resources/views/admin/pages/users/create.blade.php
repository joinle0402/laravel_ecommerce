@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid py-3">
        <div class="row">
            <div class="col-md-12">
                <h2>Thêm mới người dùng</h2>
            </div>
        </div>
        <form id="form" action="{{ route('admin.users.store') }}" method="POST">
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
                                        <label for="role_id">Nhóm thành viên: <span style="color: red;">(*)</span></label>
                                        <select @class(['form-control', 'is-invalid' => $errors->has('role_id')]) id="role_id" name="role_id">
                                            <option value="">[Chọn nhóm thành viên]</option>
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
                                        <input type="date" @class(['form-control', 'is-invalid' => $errors->has('birthday')]) id="birthday" name="birthday" value="{{ old('birthday') }}">
                                        @error('birthday')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="avatar">Ảnh đại diện:</label>
                                        <input type="file" class="form-control-file" onchange="handleInputAvatarChange(this)" accept="image/*" id="avatar" name="avatar">
                                        @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div id="image-preview" style="display: none;"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Số điện thoại: </label>
                                        <input type="text" @class(['form-control', 'is-invalid' => $errors->has('phone')]) id="phone" name="phone" value="{{ old('phone') }}">
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
                                        <select class="form-control select2 select2-primary" id="province_code" name="province_code" onchange="handleSelectProvinceChange()" data-dropdown-css-class="select2-primary" style="width: 100%;">
                                            <option value="">Chọn thành phố</option>
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->code }}" @selected($province->code === old('province_code'))>
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
                                        <select class="form-control select2 select2-primary" onchange="handleSelectDistrictChange()" id="district_code" name="district_code" data-dropdown-css-class="select2-primary" style="width: 100%;">
                                            <option value="">Chọn quận huyện</option>
                                            @if (!empty(old('province_code')))
                                                @php $districts = App\Models\District::query()->where('province_code', old('province_code'))->get(); @endphp
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district->code }}" @selected($district->code === old('district_code'))>
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
                                        <select class="form-control select2 select2-primary" id="ward_code" name="ward_code" onchange="updateTextareaAddress()" data-dropdown-css-class="select2-primary" style="width: 100%;">
                                            <option value="">Chọn quận huyện</option>
                                            @if (!empty(old('district_code')))
                                                @php $wards = App\Models\Ward::query()->where('district_code', old('district_code'))->get(); @endphp
                                                @foreach ($wards as $ward)
                                                    <option value="{{ $ward->code }}" @selected($ward->code === old('ward_code'))>
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
                                        <input type="text" @class(['form-control', 'is-invalid' => $errors->has('street')]) onchange="updateTextareaAddress()" id="street" name="street" value="{{ old('street') }}">
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
                                        <textarea class="form-control" id="address" name="address" rows="3">{{ old('address') }}</textarea>
                                        @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="note">Ghi chú: </label>
                                        <textarea class="form-control" id="note" name="note" rows="3">{{ old('note') }}</textarea>
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
@endsection

@section('scripts')
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.select2').select2();
        });

        async function handleSelectProvinceChange() {
            const province_code = $('#province_code').val();
            if (province_code) {
                const response = await ajax("GET", `/api/provinces/${province_code}/districts`);
                const template = response?.reduce(function (html, district) {
                    return html + `<option value="${district.code}">${district.full_name}</option>`;
                }, '<option value="">Chọn quận huyện</option>');
                $('#district_code').html(template);
                updateTextareaAddress();
            }
        }

        async function handleSelectDistrictChange() {
            const district_code = $('#district_code').val();
            if (district_code) {
                const response = await ajax('GET', `/api/districts/${district_code}/wards`);
                const template = response?.reduce(function (html, ward) {
                    return html + `<option value="${ward.code}">${ward.full_name}</option>`;
                }, '<option value="">Chọn phường xã</option>');
                $('#ward_code').html(template);
                updateTextareaAddress();
            }
        }

        function handleInputAvatarChange(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                $('#image-preview').show();
                reader.onload = function(event) {
                    $('#image-preview').html("<img src='' alt='avatar' id='avatar-preview' width='300' style='object-fit: cover;' />");
                    $('#avatar-preview').attr('src', event.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function updateTextareaAddress () {
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
    </script>
@endsection
