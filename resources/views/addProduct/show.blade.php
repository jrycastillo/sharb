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
                            <v-flex mb-1 pa-3><span class="headline">SEAL NO. @{{ breakdown.van_no }}</span></v-flex>
                            <v-flex mb-1 style="grid-column: 1 / 3;">
                                <v-data-table
                                        :headers=breakdown.headers
                                        :items=breakdown.items
                                        hide-actions
                                        :loading="loading"

                                >
                                    <template slot="items" slot-scope="props">
                                        <td>@{{ props.item.product }}</td>
                                        <td>@{{ props.item.name }}</td>
                                        <td>@{{ props.item.unit }}</td>
                                        <td>@{{ props.item.class }}</td>
                                        <td>@{{ props.item.quantity }}</td>
                                        <td class="justify-center layout px-0">
                                            <v-icon small class="mr-2" @click="editItem(props.item)">edit</v-icon>
                                            <v-icon small @click="">delete</v-icon>
                                        </td>
                                    </template>
                                    <template slot="no-data">
                                        <v-alert :value="true" color="error" icon="warning">
                                            Sorry, nothing to display here :(
                                        </v-alert>
                                    </template>
                                </v-data-table>
                            </v-flex>
                            <v-dialog style="grid-column: 1 / 3; margin: 0 0.5rem;" v-model="dialog" max-width="500px" persistent >
                                <v-btn block color="teal darken-3" dark slot="activator"
                                       @click="fillData(breakdown, key)">
                                    <v-icon>add_circle_outline</v-icon>
                                    Add Product
                                </v-btn>
                                <v-card>
                                    <v-card-title>
                                        <span class="headline">@{{ formTitle }}</span>
                                    </v-card-title>
                                    <v-card-text>
                                        <v-container grid-list-md>
                                            <v-layout wrap>
                                                <v-flex xs6 sm6 md6 v-if="formTitle === 'Edit Product'">
                                                    <v-text-field v-model="editedItem.name" label="Name"></v-text-field>
                                                </v-flex>
                                                <v-flex xs6 sm6 md6 v-else>
                                                    <v-select
                                                            v-model="select"
                                                            :items="products"
                                                            label="Product"
                                                            item-text="text"
                                                            item-value="id"
                                                            required
                                                    ></v-select>
                                                </v-flex>
                                                <v-flex xs6 sm6 md6>
                                                    <v-text-field v-model="editedItem.quantity"
                                                                  label="Quantity"></v-text-field>
                                                </v-flex>
                                            </v-layout>
                                        </v-container>
                                    </v-card-text>
                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn color="blue darken-1" flat @click.native="close">Cancel</v-btn>
                                        <v-btn color="blue darken-1" flat @click.native="save">Save</v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-dialog>
                        </v-card>
                    </v-flex>
                    <v-flex md12>
                        <v-btn block color="success" @click="sendForApproval"><v-icon style="margin-right: 0.5rem;">send</v-icon>Send</v-btn>
                    </v-flex>

                    <v-snackbar
                            v-model="snackbar"
                            :color="color"
                            :timeout="timeout"
                    >
                        Product already been added
                        <v-btn
                                dark
                                flat
                                @click="snackbar = false"
                        >
                            Close
                        </v-btn>
                    </v-snackbar>
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
                editedItem: {
                    product_id: '',
                    van_id: '',
                    name: '',
                    quantity: '',
                    id: '',
                    product: '',
                    unit: '',
                    class: '',
                    breakdownIndex: ''
                },
                defaultItem: {
                    product_id: '',
                    van_id: '',
                    name: '',
                    quantity: '',
                    id: '',
                    product: '',
                    unit: '',
                    class: '',
                    breakdownIndex: ''
                },
                products: [],
                containerSize: '',
                select: {},
                snackbar: false,
                color: 'error',
                timeout: 2000
            },
            computed: {
                formTitle() {
                    return this.editedIndex === -1 ? 'Add Product' : 'Edit Product'
                }
            },
            methods: {
                getSummary() {
                    axios.get("{{url('/api/addproduct')}}" + '?type=loading&id={{$id}}')
                        .then(res => {
                            this.loading = true;
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
                                            text: detail.product.name + ' - ' +detail.product.class,
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
                                        {
                                            text: 'Actions',
                                            sortable: false,
                                            value: '5'
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
                                        product: '',
                                        name: value.product.name,
                                        unit: value.product.unit.value,
                                        class: value.product.class,
                                        quantity: value.quantity,
                                        breakdownIndex: index
                                    }];
                                });
                            });

                            this.loading = false;
                            //console.log(this.breakdowns);
                        });
                },
                getProduct() {
                    axios.get("{{url('/api/addproduct')}}" + '?type=product')
                        .then(res => {
                            this.products = res.data;

                            this.products.forEach((val, index) => {
                                val = {...val, text: val.name + ' - Class '+ val.class};
                                Object.assign(this.products[index], val);
                            });
                        });
                },
                storeContainerProduct() {
                    const containerDetail = {
                        van_id: this.editedItem.van_id,
                        product_id: this.editedItem.product_id,
                        quantity: this.editedItem.quantity
                    };

                    axios.post("{{url('/api/addproduct')}}", containerDetail)
                        .then(res => {
                            window.location.href = '{{route("addproduct.show", ['id'=>$id])}}';
                        })
                },
                editItem(item) {
                    this.editedIndex = this.breakdowns[item.breakdownIndex].items.indexOf(item);
                    this.breakdownIndex = item.breakdownIndex;
                    this.editedItem = Object.assign({}, item);
                    this.dialog = true
                },
                close() {
                    this.dialog = false;
                    setTimeout(() => {
                        this.editedItem = Object.assign({}, this.defaultItem);
                        this.editedIndex = -1;
                        this.breakdownIndex = -1;
                        this.select = {};
                    }, 300);
                },
                save() {
                    if (this.editedIndex > -1) {
                        Object.assign(this.breakdowns[this.breakdownIndex].items[this.editedIndex], this.editedItem);
                    } else {
                        this.editedItem.product_id = this.products[this.select - 1].id;
                        this.editedItem.name = this.products[this.select - 1].name;
                        //this.editedItem.id = ++this.containerSize;
                        this.editedItem.product = '';
                        this.editedItem.unit = this.products[this.select - 1].unit.value;
                        this.editedItem.class = this.products[this.select - 1].class;
                        this.editedItem.breakdownIndex = this.breakdownIndex;
                        const isExisting = this.breakdowns[this.breakdownIndex].items.some((item) => {
                            return item.product_id === this.editedItem.product_id;
                        });
                        if(isExisting){
                            this.snackbar = true;
                        }else{
                            this.breakdowns[this.breakdownIndex].items = [...this.breakdowns[this.breakdownIndex].items, this.editedItem];
                            this.storeContainerProduct();
                        }

                    }
                    this.close();
                },
                fillData(data, index) {
                    this.editedItem.van_id = data.id;
                    this.breakdownIndex = index;
                },
                sendForApproval() {
                    axios.put("{{url('/api/addproduct')}}" + '/' + "{{$loadingDetail->id}}")
                        .then(res =>{
                            window.location.href = '{{route('addproduct.index')}}';
                        });
                }

            },
            watch: {
                dialog(val) {
                    val || this.close()
                }

            },
            mounted() {
                this.getSummary();
                this.getProduct();
            }
        })
    </script>

@endsection