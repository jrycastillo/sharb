@extends('layouts.app')



@section('style')
@endsection

@section('content')
    <div id="pricing">
        <v-app class="white">
            <v-container grid-list-md>
                <v-layout align-center justify-start row wrap>
                    <v-flex class="display-1 text-md-center" md12 sm12>Pricing List per Week</v-flex>
                    <v-flex sm12 md5>
                        <v-combobox
                                v-model="select"
                                :items="items"
                                label="Select Year"
                        ></v-combobox>
                    </v-flex>

                </v-layout>
                <v-layout align-center justify-start row wrap>
                    <v-flex md2 sm12 v-for="i in 53" :key="i" @click="pricing(i)">
                        <v-card
                                style="cursor: pointer;"
                                :ripple="{ class: 'error--text' }"
                        >
                            <v-card-title>
                                <div>
                                    <span>Week @{{ i }}</span>
                                </div>
                            </v-card-title>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-app>
    </div>

@endsection


@section('scripts')
    <script>
        new Vue({
            el: '#pricing',
            data: {
                select: '',
                items: [],
            },
            methods: {
                getYear() {
                    let currentYear = new Date().getFullYear(), years = [];
                    let startYear = 2014;
                    while (startYear <= currentYear) {
                        years.push(startYear++);
                    }
                    this.items = years;
                    this.select = this.items[this.items.length - 1];
                },
                pricing(week) {

                    window.location.href = '{{url('/pricing')}}' + '/' + week + '?year=' + this.select;
                }
            },
            mounted() {
                this.getYear();
            }
        })
    </script>
@endsection
