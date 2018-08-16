@extends('layouts.app')

@section('style')

@endsection

@section('content')
    <div id="container">
        <v-app class="white">
            <v-container class="elevation-1" mb-3>
                <v-toolbar flat color="white">
                    <v-toolbar-title>Van no. @{{ van_no }}</v-toolbar-title>
                    <v-divider
                            class="mx-2"
                            inset
                            vertical
                    ></v-divider>
                    <v-toolbar-title>
                        <v-layout align-center>
                            <v-text-field
                                    label="Seal no."
                                    outline
                                    full-width
                                    readonly
                                    v-model="seal_no"
                            ></v-text-field>
                        </v-layout>
                    </v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-dialog v-model="dialog" max-width="500px">
                        <v-btn slot="activator" color="primary" dark class="mb-2">New Item</v-btn>
                        <v-card>
                            <v-card-title>
                                <span class="headline">@{{ formTitle }}</span>
                            </v-card-title>
                            <v-card-text>
                                <v-container grid-list-md>
                                    <v-layout wrap>
                                        <v-flex xs12 sm6 md4>
                                            <v-select
                                                    :items="products"
                                                    v-model="editedItem.product"
                                                    auto
                                                    label="Select"
                                                    hide-details
                                                    single-lines
                                                    item-text="text"
                                                    return-object
                                                    required
                                            ></v-select>
                                        </v-flex>
                                        <v-flex xs12 sm6 md4>
                                            <v-text-field v-model="editedItem.quantity" label="Quantity"></v-text-field>
                                        </v-flex>
                                        <v-flex md12>
                                            <v-alert
                                                    :value="alert"
                                                    type="error"
                                            >
                                                @{{ alertMessage }}
                                            </v-alert>
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
                </v-toolbar>
                <v-data-table
                        :headers="headers"
                        :items="containers"
                        hide-actions
                        class="elevation-1"
                >
                    <template slot="items" slot-scope="props">
                        <td>@{{ props.item.product.fruit.name }}</td>
                        <td>@{{ props.item.product.name }}</td>
                        <td>@{{ props.item.product.unit.value }}</td>
                        <td>@{{ props.item.product.class }}</td>
                        <td>@{{ props.item.quantity }}</td>
                        <td class="justify-center layout px-0">
                            <v-icon
                                    small
                                    class="mr-2"
                                    @click="editItem(props.item)"
                            >
                                edit
                            </v-icon>
                            <v-icon
                                    small
                                    {{--@click="deleteItem(props.item)"--}}
                            >
                                delete
                            </v-icon>
                    </template>
                </v-data-table>
                <v-btn block color="secondary" class="light-green accent-4 black--text" @click="returnToLoading">Return
                    To Loading
                </v-btn>
            </v-container>
        </v-app>
    </div>

@endsection

@section('scripts')

    <script>
        new Vue({
            el: '#container',
            data: {
                dialog: false,
                alert: false,
                alertMessage: '',
                van_id: '',
                van_no: '',
                seal_no: '',
                headers: [
                    {text: 'Fruits', align: 'left', value: 'fruit', sortable: false},
                    {text: 'Name', value: 'name', sortable: false},
                    {text: 'Unit', value: 'unit', sortable: false},
                    {text: 'Class', value: 'class', sortable: false},
                    {text: 'Quantity', value: 'quantity', sortable: false},
                    {text: 'Action', value: 'action', sortable: false},
                ],
                containers: [],
                products: [],
                editedIndex: -1,
                editedTemp: {},
                editedItem: {
                    id: null,
                    van_id: null,
                    product: null,
                    quantity: null
                },
                defaultItem: {
                    id: null,
                    van_id: null,
                    product: null,
                    quantity: null
                },
            },
            computed: {
                formTitle() {
                    return this.editedIndex === -1 ? 'New Product' : 'Edit Product';
                }
            },
            watch: {
                dialog(val) {
                    val || this.close()
                }
            },
            methods: {
                async getContainer() {
                    const res = await
                        axios.get("{{url('/api/addproduct')}}" + '/' + "{{$first}}" + '/container/' + "{{$second}}");
                    res.data.van_details.forEach((val) => {
                        val.product = {...val.product, text: val.product.name + ' - ' + val.product.class};
                        this.containers = [...this.containers, {
                            id: val.id,
                            van_id: val.van_id,
                            quantity: val.quantity,
                            product: val.product
                        }];
                    });
                    this.van_no = res.data.van_no;
                    this.seal_no = res.data.seal_no;
                    this.van_id = res.data.id;
                },
                async getProduct() {
                    const res = await axios.get("{{url('/api/product')}}");
                    res.data.forEach((val) => {
                        val = {...val, text: val.name + ' - ' + val.class};
                        this.products = [...this.products, val];
                    });
                },
                editItem(item) {
                    this.editedIndex = this.containers.indexOf(item);
                    this.editedItem = Object.assign({}, item);
                    this.editedTemp = {...item};
                    this.dialog = true;
                },
                close() {
                    this.dialog = false;
                    this.alert = false;
                    this.alertMessage = '';
                    this.editedTemp = {};
                    setTimeout(() => {
                        this.editedItem = Object.assign({}, this.defaultItem);
                        this.editedIndex = -1
                    }, 300)
                },
                save() {
                    if (this.editedIndex > -1) {
                        const isExisting = this.containers.some((item) => {
                            return item.product.id === this.editedItem.product.id;
                        });
                        const same = this.editedItem.product.id === this.editedTemp.product.id;
                        if (isExisting && !same) {
                            this.alert = true;
                            this.alertMessage = 'Item already existing';
                            return;
                        }
                        if (this.editedItem.quantity === null || this.editedItem.quantity.length === 0) {
                            this.alert = true;
                            this.alertMessage = 'Enter Quantity';
                            return;
                        }
                        this.putVanDetails();
                        Object.assign(this.containers[this.editedIndex], this.editedItem);

                    } else {
                        if (this.editedItem.product === null) {
                            this.alert = true;
                            this.alertMessage = 'Please select a product';
                            return;
                        }
                        const isExisting = this.containers.some((item) => {
                            return item.product.id === this.editedItem.product.id;
                        });
                        if (isExisting) {
                            this.alert = true;
                            this.alertMessage = 'Item already existing';
                            return;
                        }
                        if (this.editedItem.quantity === null || this.editedItem.quantity.length === 0) {
                            this.alert = true;
                            this.alertMessage = 'Enter Quantity';
                            return;
                        }
                        this.editedItem.van_id = this.van_id;
                        this.postVanDetails();
                        this.containers.push(this.editedItem);
                    }
                    this.close()
                },
                returnToLoading() {
                    window.location.href = '{{route("addproduct.show", ["id"=>$first])}}';
                },
                async postVanDetails() {
                    const data = {
                        van_id: this.editedItem.van_id,
                        product_id: this.editedItem.product.id,
                        quantity: this.editedItem.quantity
                    };
                    const res = await axios.post('{{route("addproduct.container.store", ["id"=>$first])}}', data);
                    this.editedItem.id = res.data.id;
                },
                async putVanDetails() {
                    const data = {
                        id: this.editedItem.id,
                        van_id: this.editedItem.van_id,
                        product_id: this.editedItem.product.id,
                        quantity: this.editedItem.quantity
                    };

                    await axios.put('{{route("addproduct.container.update", ["id"=>$first,"van_id"=>$second])}}', data);


                }

            },
            mounted() {
                this.getContainer();
                this.getProduct();
            }
        })
        ;
    </script>
@endsection