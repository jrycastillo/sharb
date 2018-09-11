@extends('layouts.app')

@section('content')
    <div class="container" id="pricing">
        <div class="card mb-3">
            <div class="card-header">
                <h3>Supplier</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td><h5>Supplier</h5></td>
                        @foreach($pricings as $pricing)
                            <td>
                                <h5>{{$pricing->value}} kg class({{($pricing->class)}})</h5>
                            </td>
                        @endforeach
                        <td><h5>Total</h5></td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="supplier in suppliers">
                        <td>@{{ supplier.name }}</td>
                        <td v-for="i in supplier.data">
                            @{{ i.qty }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        new Vue({
            el: '#pricing',
            data: {
                suppliers: [],
            },
            methods: {
                getData() {
                    let supps = [];
                    @foreach($suppliers as $supplier)
                    supps.push({
                        'supplier_id': +"{{$supplier->supplier_id}}",
                        'data': this.getPriceHeader(),
                        'name': "{{$supplier->supplier->name}}"
                    });
                    @endforeach
                        return supps;
                },
                getPriceHeader() {
                    let pricings = [];
                    @foreach($pricings as $pricing)
                        pricings = [...pricings, {
                        'class': "{{$pricing->class}}",
                        'value': "{{$pricing->value}}",
                        'qty': "{{$pricing->qty}}"
                    }];
                    @endforeach

                        return pricings;
                },
                getQuantity() {
                    let data = [];
                    @foreach($data as $i)
                        data = [...data, {
                        'supplier_id': +"{{$i->supplier_id}}",
                        'class': "{{$i->class}}",
                        'value': "{{$i->value}}",
                        'qty': "{{$i->qty}}"
                    }];
                    @endforeach
                        return data;
                },
                setPrice() {
                    let supps = this.getData();
                    let quantity = this.getQuantity();
                    supps.forEach((data) => {
                        data.data.forEach((vals) => {
                            let c = true;
                            quantity.forEach((qty) => {
                                if(qty.supplier_id === data.supplier_id && qty.value === vals.value && qty.class === vals.class){
                                    vals.qty = qty.qty;
                                    c = false;
                                }
                            });
                            if(c){
                                vals.qty = '';
                            }
                        });
                    });
                    this.suppliers = supps;
                }
            },
            mounted() {
                this.setPrice();
            }
        })
    </script>
@endsection