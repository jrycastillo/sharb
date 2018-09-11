@extends('layouts.app')


@section('style')
    <style>
        h1, h2, h3, h4, h5, h6 {
            margin: 0;
        }
        .bg-white {
            background-color: white;
        }

        .card-width {
            width: 60vw;
        }

        .card-center {
            margin: 0 auto;
        }

        .vcard-padd {
            padding: 2px 2px;
        }
    </style>

@endsection


@section('content')
    <div id="addProduct">
        <v-app>
            <v-container>
                <v-card class="card-width card-center">
                    <v-card-title primary-title>
                        <v-layout align-center justify-space-between row fill-height pa-3>
                            <v-flex class="headline" lg6>Add Products</v-flex>
                            <v-flex>
                                <v-divider
                                        class="mx-2"
                                        inset
                                        vertical
                                >
                                </v-divider>
                            </v-flex>
                            <v-spacer></v-spacer>
                            <v-combobox
                                    v-model="select"
                                    :items="items"
                                    label="Select Year"
                                    @change="getData"
                            ></v-combobox>
                        </v-layout>
                    </v-card-title>
                    <v-container fluid>
                        <v-data-table
                                :headers="headers"
                                :items="loadings"
                                hide-actions
                                item-key="week_no"
                                :headers-length="100"
                                class="elevation-1"
                        >
                            <template slot="items" slot-scope="props">
                                <tr @click="expand(props)">
                                    <td>
                                        <v-layout align-center justify-space-between row fill-height mx-3>
                                            <v-flex xs11 class="title">
                                                @{{ props.item.week_no }}
                                            </v-flex>
                                            <v-flex xs1>
                                                <v-icon style="cursor: pointer;">
                                                    @{{ props.item.arrow }}
                                                </v-icon>
                                            </v-flex>
                                        </v-layout>
                                    </td>
                                </tr>
                            </template>
                            <template slot="expand" slot-scope="props">
                                <v-card flat v-for="detail in props.item.details" :key="detail.id">
                                    <v-card-text class="vcard-padd">
                                        <v-layout align-center justify-space-between row fill-height mx-3>
                                            <span>Booking Number: <strong>@{{ detail.BN }}</strong></span>
                                            <v-btn color="info" :href="'/addproduct/' + detail.id ">View Detail
                                            </v-btn>
                                        </v-layout>
                                    </v-card-text>
                                </v-card>
                            </template>
                        </v-data-table>
                    </v-container>
                </v-card>
            </v-container>
        </v-app>
    </div>
@endsection


@section('scripts')
    <script>
        new Vue({
            el: '#addProduct',
            data: {
                loadings: [],
                url: "{{ url('/addproduct') }}",
                headers: [
                    {
                        text: 'Week Number',
                        align: 'left',
                        sortable: false,
                        value: 'name',
                        width: '100%',
                        class: ['title']
                    },
                ],
                items: [],
                select: '',
            },
            watch: {
                loadings(value) {
                    this.loadings = value;
                }
            },
            methods: {
                async getData() {
                    const res = await axios.get("{{ url('/api/addproduct') }}" + '?type=year&year=' + this.select);
                    let data = [];
                    for (let gg in res.data) {
                        let loading = {
                            "week_no": "",
                            arrow: 'keyboard_arrow_down',
                            "details": []
                        };
                        res.data[gg].forEach((val) => {
                            loading.week_no = val.productionWeek;
                            loading.details = [...loading.details, {"BN": val.BL_no, "id": val.loading_id}];
                        });
                        data = [...data, loading];
                    }
                    this.loadings = data;

                },
                expand: function (props) {
                    props.item.arrow = !props.expanded ? 'keyboard_arrow_up' : 'keyboard_arrow_down';
                    return props.expanded = !props.expanded
                },
                getYear() {
                    let currentYear = new Date().getFullYear(), years = [];
                    let startYear = 2014;
                    while(startYear <= currentYear) {
                        years.push(startYear++);
                    }
                    this.items = years;
                    this.select = this.items[this.items.length-1];
                }
            },
            mounted() {
                this.getYear();
                this.getData();
            }

        })
    </script>

@endsection