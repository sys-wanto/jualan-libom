<x-app-layout>

    <x-slot name="script">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // AJAX DataTable
            var datatable = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                ajax: {
                    url: '{!! url()->current() !!}',
                },
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/id.json'
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                    },
                    {
                        data: 'user.name',
                        name: 'user.name'
                    },
                    {
                        data: 'item.brand.name',
                        name: 'item.brand.name'
                    },
                    {
                        data: 'item.name',
                        name: 'item.name'
                    },
                    {
                        data: 'start_date',
                        name: 'start_date'
                    },
                    {
                        data: 'end_date',
                        name: 'end_date'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'payment_status',
                        name: 'payment_status'
                    },
                    {
                        data: 'total_price',
                        name: 'total_price'
                    },
                ],
            });

            let color_pembelian = [];
            var dynamicColors = function() {
                var r = Math.floor(Math.random() * 255);
                var g = Math.floor(Math.random() * 255);
                var b = Math.floor(Math.random() * 255);
                return "rgb(" + r + "," + g + "," + b + ")";
                if (!color_pembelian.has(color)) {
                    color_pembelian.add(color);
                    return color;
                } else {
                    return dynamicColors();
                }
            };

            // AJAX chartjs
            (function() {

                let pembelian_arr = {!! json_encode($pembelians) !!};
                console.log(pembelian_arr);
                let label_pembelian = [];
                let data_pembelian = [];
                pembelian_arr.forEach(element => {
                    color_pembelian.push(dynamicColors())
                    label_pembelian.push(element['status'])
                    data_pembelian.push(element['total'])
                });
                const ctx2 = document.getElementById('myChart2');

                new Chart(ctx2, {
                    type: 'bar',
                    data: {
                        labels: label_pembelian,
                        datasets: [{
                            label: 'Pembelian',
                            backgroundColor: color_pembelian,
                            data: data_pembelian,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })()
        </script>
    </x-slot>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="columns-2">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <canvas id="myChart2"></canvas>
                    </div>
                </div>
                <div class="columns-1">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <table id="dataTable">
                            <thead>
                                <tr>
                                    <th style="max-width: 1%">ID</th>
                                    <th>User</th>
                                    <th>Brand</th>
                                    <th>Item</th>
                                    <th>Mulai</th>
                                    <th>Selesai</th>
                                    <th>Status Booking</th>
                                    <th>Status Pembayaran</th>
                                    <th>Total Dibayar</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
