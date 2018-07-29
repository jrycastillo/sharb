@extends('layouts.app')

@section('style')
    <style>
        td.details-control {
            text-align: center;
            color: forestgreen;
            cursor: pointer;
        }

        tr.shown td.details-control {
            text-align: center;
            color: red;
        }
    </style>
@endsection


@section('content')

    <div class="container">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> Loading List
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" class="display" id="example" cellspacing="0">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Week</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('scripts')
    <script>
        $(document).ready(function () {
            var table = $('#example').DataTable({
                "data": object.data,
                select: "single",
                "columns": [
                    {
                        "className": 'details-control',
                        "orderable": false,
                        "data": null,
                        "defaultContent": '',
                        "render": function () {
                            return '<i class="fa fa-plus-square" aria-hidden="true"></i>';
                        },
                        width: "15px"
                    },
                    {"data": "week_no"}

                ],
                "order": [[1, 'asc']]
            });

            // event listener sa close ug open buttons
            $('#example tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var tdi = tr.find("i.fa");
                var row = table.row(tr);

                if (row.child.isShown()) {
                    // sa close
                    row.child.hide();
                    tr.removeClass('shown');
                    tdi.first().removeClass('fa-minus-square');
                    tdi.first().addClass('fa-plus-square');
                }
                else {
                    // para sa open
                    row.child(format(row.data())).show();
                    tr.addClass('shown');
                    tdi.first().removeClass('fa-plus-square');
                    tdi.first().addClass('fa-minus-square');
                }
            });

            table.on("user-select", function (e, dt, type, cell, originalEvent) {
                if ($(cell.node()).hasClass("details-control")) {
                    e.preventDefault();
                }
            });
        });

        function format(d) {
            // `d` is the original data object for the row
            var gg = tr(d.details);

            return gg;
        }

        function tr(d) {
            var out = '';
            d.forEach((loading_id) => {
                out += '<table cellpadding="0" cellspacing="0" border="0" style="padding-left:50px;">' +
                    '<tr>' +
                    '<td>BL no:</td>' +
                    '<td>' + loading_id.BN + '</td>' + '<td>' + '<a type="button" class="btn" href=" /uncheckloading/' + loading_id.id+'">Show Loading Details</a>' + '</td>' +
                    // '<td>' + loading_id.BN + '</td>' + '<td>' + '<a type="button" class="btn" href="">Show Loading Details</a>' + '</td>' +
                    '</tr>' +
                    '</table>';
            });

            return out;
        }

        var object = {
            "data": []
        };


                @foreach($loadingDetails as $details)
        var ass = {
                "week_no": "",
                "actions": "",
                "details": []
            };
        @foreach($details as  $detail)
            ass.week_no = {{$detail->productionWeek}}
        ass.details.push({"BN": "{{$detail->BL_no}}", "id": "{{$detail->loading_id}}"});
        @endforeach
        object.data.push(ass);
        @endforeach



    </script>

@endsection