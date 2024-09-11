@extends('layouts.app')

@section('content')
    <div class="container bg-white border rounded-3">
        <form id="form">
            @csrf
            <div class="row my-5 min-h-title">
                <div class="col-lg-6">
                    <div class="d-flex align-items-center justify-content-between justify-content-md-start h-100">
                        <h1><strong>Tambah Pegawai</strong></h1>
                    </div>
                </div>
                <hr class="hr hr-blurry" />
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="pills-id" role="tabpanel"
                            aria-labelledby="pills-id-tab">
                            <label for="name"><strong>Name </strong> </strong><span class="text-danger">*</span></label>
                            <div class="form-group mb-2">
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                    placeholder="Nama">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="content"><strong>Jenis Kelamin</strong><span
                                        class="text-danger">*</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" name="gander" type="radio" value="l"
                                        id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Laki-laki
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gander" value="p"
                                        id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content"><strong>Email</strong><span class="text-danger">*</span></label>
                                <input type="text" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                    placeholder="Email">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="content"><strong>Tanggal Lahir</strong><span
                                        class="text-danger">*</span></label>
                                <div class="input-group date" id="date" data-target-input="nearest">
                                    <input type="text" name="birthdate" id="date"
                                        class="form-control datetimepicker-input"
                                        data-toggle="datetimepicker" data-target="#date" placeholder="Choose date and time"
                                        value="{{ old('birthdate') }}" />
                                    <div class="input-group-append" data-target="#date" data-toggle="datetimepicker">
                                        <div class="input-group-addon d-flex align-items-center justify-content-center"><i
                                                class="far fa-clock"></i></div>
                                    </div>
                                    @error('date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content"><strong>Posisi</strong><span class="text-danger">*</span></label>
                                <select name="positions_id" id="positions_id"
                                    class="form-control select2 js-example-basic-single @error('positions_id') is-invalid @enderror">

                                </select>
                                @error('positions_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="content"><strong>Alamat</strong><span class="text-danger">*</span></label>
                                <input type="text" name="address"
                                    class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}"
                                    placeholder="Address">

                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="content"><strong>Image</strong><span class="text-danger">*</span></label>
                                <input id="file-upload" name="file" type="file" class="form-control">
                            </div>

                        </div>
                    </div>
                    <div class="col d-flex justify-content-between">
                        <a href="#" type="button" class="btn btn-danger  mt-3 ">Back</a>
                        <input type="submit" value="Tambah"  class="btn btn-success mt-3">
                    </div>
                    {{-- <button type="submit" class="btn btn-primary mt-3">Tambah</button> --}}
                 </div>

            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajax({
                url: "/api/positions",
                method: "GET",
                success: function(response) {
                    if (response.success) {
                        $.each(response.data, function(key, position) {
                            var newOption = new Option(position.name, position.id, false,
                            false);
                            $('#positions_id').append(newOption).trigger('change');
                        });
                    } else {
                        alert('Gagal mengambil data posisi.');
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Error: " + error);
                }
            });

            $('.js-example-basic-single').select2({
                placeholder: "Pilih kategori",
                allowClear: true
            });
            

            $('.datetimepicker-input').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true
            });

            $("#file-upload").fileinput({
                // allowedFileExtensions: ["jpg", "jpeg", "png"],
                maxFileSize: 1000,
                showUpload: false,
                showCaption: true,
                browseClass: "btn btn-primary",
                maxFileCount: 1,
                theme: "fas"
            });


            // Validasi form menggunakan jQuery Validation
            $('#form').validate({
                rules: {
                    positions_id: {
                        required: true
                    },
                    name: {
                        required: true
                    },
                    email: {
                        required: true
                    },
                    gander: {
                        required: true
                    },
                    address: {
                        required: true
                    },
                    birthdate: {
                        required: true,
                        date: true
                    },
                    file: {
                        required: true,
                        // extension: "jpg|png",
                        filesize: 1000000
                    }
                },
                messages: {
                    positions_id: "Wajib pilih posisi",
                    birthdate: {
                        required: "Tanggal lahir diperlukan.",
                        date: "Masukkan tanggal yang valid."
                    },
                    name: "Nama wajib diisi",
                    email: "Email wajib diisi",
                    address: "Alamat wajib diisi",
                    gander: "Gender wajib diisi",
                    file: {
                        required: "Silakan upload file gambar.",
                        extension: "Format file harus jpg atau png.",
                        filesize: "Ukuran file tidak boleh lebih dari 1MB."
                    }
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    // Proses submit via AJAX jika validasi sukses
                    var formData = new FormData(form); // Ambil semua data dari form, termasuk file
                    
                    $.ajax({
                        url: "{{ url('api/employees/store') }}",
                        type: 'POST',
                        data: formData,
                        processData: false, // Jangan proses data, biarkan FormData mengurusnya
                        contentType: false, // Jangan set tipe konten, biarkan browser menentukannya
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content') // Tambahkan token CSRF
                        },
                        success: function(response) {
                            alert('Data berhasil disimpan');
                            console.log(response);
                        },
                        error: function(xhr) {
                            alert('Terjadi kesalahan saat menyimpan data');
                            console.log(xhr.responseText);
                        }
                    });
                }
            });
            // $.validator.addMethod('extension', function(value, element, param) {
            //     console.log(value);
            //     var fileName = value;
            //     var fileExtension = fileName.split('.').pop().toLowerCase();
            //     console.log(fileExtension);
            //     return this.optional(element) || $.inArray(fileExtension, param) !== -1;
            // }, 'Format file harus jpg atau png');
            $.validator.addMethod('filesize', function(value, element, param) {
                return this.optional(element) || (element.files[0].size <= param);
            }, 'Ukuran file tidak boleh lebih dari 1MB.');
        });
    </script>
@endpush
<style>
    .error{
        color: red;
    }
</style>
