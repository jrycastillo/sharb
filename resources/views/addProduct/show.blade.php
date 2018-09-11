@extends('layouts.app')

@section('style')
    <style>
        h1, h2, h3, h4, h5, h6 {
            margin: 0;
        }

    </style>
@endsection

@section('content')
    <div id="addshowproduct">
        <v-app class="white">
            <v-container>
                <v-layout row wrap justify-space-between>
                    <v-flex xs12 md12 mb-1 class="text-lg-center text-xs-center"><h6>MOHAMMAD A. SHARBATLY CO. LTD.</h6>
                    </v-flex>
                    <v-flex xs12 md12 class="text-lg-center text-xs-center"><h6>DAVAO BRANCH</h6></v-flex>
                    <v-flex xs6 md2 mb-1>Shipment Date</v-flex>
                    <v-flex xs6 md6 mb-1>: {{$loadingDetail->ETA}}</v-flex>
                    <v-flex xs6 md2 mb-1>Supplier</v-flex>
                    <v-flex xs6 md2 mb-1>: {{$loadingDetail->supplier}}</v-flex>
                    <v-flex xs6 md2 mb-1>Vessel Name</v-flex>
                    <v-flex xs6 md6 mb-1>: {{$loadingDetail->vessel}}</v-flex>
                    <v-flex xs6 md2 mb-1>Exporter</v-flex>
                    <v-flex xs6 md2 mb-1>: {{$loadingDetail->exporter}}</v-flex>
                    <v-flex xs6 md2 mb-1>Voyage Number</v-flex>
                    <v-flex xs6 md6 mb-1>: {{$loadingDetail->voyage_no}}</v-flex>
                    <v-flex xs6 md2 mb-1>Carrier</v-flex>
                    <v-flex xs6 md2 mb-1>: {{$loadingDetail->carrier}}</v-flex>
                    <v-flex xs12 md12 mb-1>{{$loadingDetail->POD}}</v-flex>
                    <v-flex xs12 md12 mb-5>
                        <v-data-table
                                :headers="headers"
                                :items="items"
                                hide-actions
                                :loading="loading"
                                class="elevation-1"
                        >
                            <template slot="items" slot-scope="props">
                                <td>@{{ props.item.vn}}</td>
                                <td v-for="item in props.item.gg" :key="item.value">
                                    @{{item.s}}
                                </td>
                                <td>@{{ props.item.total }}</td>
                            </template>
                        </v-data-table>
                    </v-flex>

                    <v-flex xs12 md12 lg6 mb-3 px-2 v-for="(breakdown, key) in breakdowns" :key="breakdown.id">
                        <v-card style="display: grid; grid-template-columns: 1fr 1fr">
                            <v-flex mb-1 pa-3><span class="headline">VAN NO. @{{ breakdown.van_no }}</span></v-flex>
                            <v-flex mb-1 pa-3><span class="headline">SEAL NO. @{{ breakdown.seal }}</span></v-flex>
                            <v-flex mb-1 style="grid-column: 1 / 3;">
                                <v-data-table
                                        :headers=breakdown.headers
                                        :items=breakdown.items
                                        hide-actions
                                        :loading="loading"
                                >
                                    <template slot="items" slot-scope="props">
                                        <td>@{{ props.item.fruit }}</td>
                                        <td>@{{ props.item.name }}</td>
                                        <td>@{{ props.item.unit }}</td>
                                        <td>@{{ props.item.class }}</td>
                                        <td>@{{ props.item.quantity }}</td>
                                    </template>
                                    <template slot="no-data">
                                        <v-alert :value="true" color="error" icon="warning">
                                            Sorry, nothing to display here :(
                                        </v-alert>
                                    </template>
                                </v-data-table>
                            </v-flex>
                            <v-flex px-1 style="grid-column: 1 / 3;">
                                <v-btn block color="secondary" @click="showContainer(breakdown.id)">Add Product</v-btn>
                            </v-flex>
                        </v-card>
                    </v-flex>
                    <v-flex md12>
                        <v-btn block color="success" @click="sendForApproval">
                            <v-icon style="margin-right: 0.5rem;">send</v-icon>
                            Send
                        </v-btn>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-app>
    </div>
@endsection

@section('scripts')
    <script>
        new Vue({
            el: '#addshowproduct',
            data: {
                headers: [
                    {
                        text: 'Week No',
                        align: 'left',
                        sortable: false,
                        value: '0'
                    }
                ],
                loading: false,
                items: [],
                breakdowns: [],
                dialog: false,
                editedIndex: -1,
                breakdownIndex: -1,
                products: [],
                containerSize: '',
                select: {},
                snackbar: false,
                color: 'error',
                timeout: 2000
            },
            methods: {
                getSummary() {
                    axios.get("{{url('/api/addproduct')}}" + '?type=loading&id={{$id}}')
                        .then(res => {
                            this.loading = true;
                            //HEADERS
                            res.data.forEach((val) => {
                                val.van_details.forEach(detail => {
                                    let check = true;

                                    this.headers.forEach(val => {
                                        if (val.value === detail.product.id) {
                                            check = false;
                                        }
                                    });
                                    if (check) {
                                        this.headers = [...this.headers, {
                                            text: detail.product.name + ' - ' + detail.product.class,
                                            sortable: false,
                                            value: detail.product.id
                                        }];
                                    }
                                });

                            });
                            this.headers.sort((a, b) => {
                                return a.value - b.value;
                            });
                            this.headers = [...this.headers, {
                                text: 'Total',
                                sortable: false,
                                value: 999999999
                            }];
                            //HEADERS SUMMARY ITEMS
                            res.data.forEach((val, index) => {
                                this.items = [...this.items, {vn: 'Van no: ' + val.van_no, value: 0, gg: [], total: 0}];
                                this.headers.forEach((header, i) => {
                                    if (i !== 0 && i !== this.headers.length - 1) {
                                        let quantityNotExist = true;
                                        val.van_details.forEach((detail) => {
                                            if (header.value === detail.product.id) {
                                                quantityNotExist = false;
                                                this.items[index].gg = [...this.items[index].gg, {
                                                    s: detail.quantity,
                                                    val: i
                                                }];
                                            }
                                        });
                                        if (quantityNotExist) {
                                            this.items[index].gg = [...this.items[index].gg, {s: '', val: i}];
                                        }
                                    }
                                });
                                this.items[index].total = +this.items[index].gg.reduce((sum, item) => sum + +item.s, 0);
                            });

                            this.items = [...this.items, {vn: 'Total', value: 0, gg: [], total: 0}];
                            this.headers.forEach((header, i) => {
                                if (i !== 0 && i !== this.headers.length - 1) {
                                    let sum = 0;
                                    for (let index = 0; index < res.data.length; index++) {
                                        if (this.items[index].gg[i - 1].s !== '') {
                                            sum += +this.items[index].gg[i - 1].s;
                                        }
                                    }
                                    this.items[this.items.length - 1].gg = [...this.items[this.items.length - 1].gg, {
                                        s: sum,
                                        val: i
                                    }];
                                }
                            });
                            this.items[this.items.length - 1].total = this.items[this.items.length - 1].gg.reduce((sum, item) => sum + +item.s, 0);

                            //BREAKDOWN
                            res.data.forEach((val, index) => {
                                this.breakdowns = [...this.breakdowns, {
                                    headers: [
                                        {
                                            text: 'Product',
                                            sortable: false,
                                            value: '0'
                                        },
                                        {
                                            text: 'Name',
                                            sortable: false,
                                            value: '1'
                                        },
                                        {
                                            text: 'Unit',
                                            sortable: false,
                                            value: '2'
                                        },
                                        {
                                            text: 'Class',
                                            sortable: false,
                                            value: '3'
                                        },
                                        {
                                            text: 'Quantity',
                                            sortable: false,
                                            value: '4'
                                        },

                                    ],
                                    items: [],
                                    seal: val.seal_no,
                                    van_no: val.van_no,
                                    id: val.id
                                }];
                                val.van_details.forEach((value) => {
                                    this.breakdowns[index].items = [...this.breakdowns[index].items, {
                                        product_id: value.product.id,
                                        van_id: value.van_id,
                                        id: value.id,
                                        name: value.product.name,
                                        unit: value.product.unit.value,
                                        fruit: value.product.fruit.name,
                                        class: value.product.class,
                                        quantity: value.quantity,
                                        breakdownIndex: index
                                    }];
                                });
                            });
                            this.loading = false;
                        });
                },
                getProduct() {
                    axios.get("{{url('/api/addproduct')}}" + '?type=product')
                        .then(res => {
                            this.products = res.data;

                            this.products.forEach((val, index) => {
                                val = {...val, text: val.name + ' - Class ' + val.class};
                                Object.assign(this.products[index], val);
                            });
                        });
                },
                fillData(data, index) {
                    this.editedItem.van_id = data.id;
                    this.breakdownIndex = index;
                },
                sendForApproval() {
                    axios.put("{{url('/api/addproduct')}}" + '/' + "{{$loadingDetail->id}}")
                        .then(res => {
                            window.location.href = '{{route('addproduct.index')}}';
                        });
                },
                showContainer(id) {
                    window.location.href = '{{$url}}/container/' + id;
                }

            },
            mounted() {
                this.getSummary();
                this.getProduct();
            }
        })
    </script>

@endsection