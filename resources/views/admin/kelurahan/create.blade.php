<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            <a href="{{ route('admin.propinsi.index') }}">
                ←
            </a>
            {{ $title }} &raquo; {{ $action }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="">
                @if ($errors->any())
                    <div class="mb-5" role="alert">
                        <div class="px-4 py-2 font-bold text-white bg-red-500 rounded-t">
                            Ada kesalahan!
                        </div>
                        <div class="px-4 py-3 text-red-700 bg-red-100 border border-t-0 border-red-400 rounded-b">
                            <p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            </p>
                        </div>
                    </div>
                @endif
                <form class="w-full" action="{{ route('admin.kelurahan.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Kode Propinsi *
                            </label>
                            <select name="kd_propinsi" id="kd_propinsi" onchange="getdati2(this.value)"
                                class="text-base w-full font-medium focus:border-primary focus:outline-none placeholder:text-secondary placeholder:font-normal px-[26px] py-4 border border-grey rounded-[50px] focus:before:appearance-none focus:before:!content-none"
                                placeholder="Payment Method" require>
                                @foreach ($propinsi as $key => $p)
                                    <option value="{{ $p->kd_propinsi_new }}">{{ $p->kd_propinsi_new }} -
                                        {{ $p->nm_propinsi }} </option>
                                @endforeach
                            </select>
                            <div class="mt-2 text-sm text-gray-500">
                                Kode Propinsi Wajib diisi. Harus Angka
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Kode Kabupaten *
                            </label>
                            <select name="kd_dati2" id="kd_dati2"
                                onchange="getkecamatan($('#kd_propinsi').val(),this.value)"
                                class="text-base w-full font-medium focus:border-primary focus:outline-none placeholder:text-secondary placeholder:font-normal px-[26px] py-4 border border-grey rounded-[50px] focus:before:appearance-none focus:before:!content-none"
                                placeholder="Payment Method" require>
                                @foreach ($dati2 as $p)
                                    <option value="{{ $p->kd_dati2_new }}">{{ $p->kd_dati2_new }} -
                                        {{ $p->nm_propinsi }} </option>
                                @endforeach
                            </select>
                            <div class="mt-2 text-sm text-gray-500">
                                Kode Propinsi Wajib diisi. Harus Angka
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Kode Kecamatan *
                            </label>
                            <select name="kd_kecamatan" id="kd_kecamatan"
                                class="text-base w-full font-medium focus:border-primary focus:outline-none placeholder:text-secondary placeholder:font-normal px-[26px] py-4 border border-grey rounded-[50px] focus:before:appearance-none focus:before:!content-none"
                                placeholder="Pilih Kecamatan" require>
                                @foreach ($kecamatan as $p)
                                    <option value="{{ $p->kd_kecamatan_new }}">{{ $p->kd_kecamatan_new }} -
                                        {{ $p->nm_propinsi }} </option>
                                @endforeach
                            </select>
                            <div class="mt-2 text-sm text-gray-500">
                                Kode Propinsi Wajib diisi. Harus Angka
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Kode {{ $title }} *
                            </label>
                            <input value="{{ old('kd_kelurahan') }}" name="kd_kelurahan" maxlength="3"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="Kode {{ $title }}" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Kode {{ $title }} Wajib diisi. Harus Angka
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Nama {{ $title }} *
                            </label>
                            <input value="{{ old('nm_kelurahan') }}" name="nm_kelurahan"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="Nama  {{ $title }}" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Nama {{ $title }} Wajib diisi. Maksimal 255 karakter.
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap mb-6 -mx-3">
                        <div class="w-full px-3 text-right">
                            <button type="submit"
                                class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                                Simpan {{ $title }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-slot name="script">
        <script>
            // AJAX onclick
            function getdati2(kd_propinsi = '') {
                console.log(kd_propinsi);
                $.ajax({
                    url: "{{ url('/') }}/api/get/dati2/" + kd_propinsi,
                    method: "GET",
                    success: function(response) {
                        console.log(response.length);
                        var option = "<option value=''> - Pilih Kabupaten - </option>";
                        if (response.length > 0) {
                            response.forEach(value => {
                                console.log(value);
                                option += "<option value='" + value.kd_dati2_new + "''>" + value
                                    .kd_dati2_new + " - " + value.nm_dati2 + " </option>"
                            });
                        } else {

                        }
                        $('#kd_dati2').html(option);
                        // document.getElementById("disp").innerHTML = response;
                    },
                    error: function(error) {
                        // alert("error" + error);
                    }
                });
            }

            function getkecamatan(kd_propinsi = '', kd_dati2 = '') {
                $.ajax({
                    url: "{{ url('/') }}/api/get/kecamatan/" + kd_propinsi + "/" + kd_dati2,
                    method: "GET",
                    success: function(response) {
                        console.log(response.length);
                        var option = "<option value=''> - Pilih Kecamatan - </option>";
                        if (response.length > 0) {
                            response.forEach(value => {
                                console.log(value);
                                option += "<option value='" + value.kd_kecamatan_new + "''>" + value
                                    .kd_kecamatan_new + " - " + value.nm_kecamatan + " </option>"
                            });
                        } else {

                        }
                        $('#kd_kecamatan').html(option);
                        // document.getElementById("disp").innerHTML = response;
                    },
                    error: function(error) {
                        // alert("error" + error);
                    }
                });
            }
        </script>
    </x-slot>
</x-app-layout>
