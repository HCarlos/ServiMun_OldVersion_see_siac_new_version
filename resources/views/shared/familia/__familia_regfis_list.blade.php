{{--@include('shared.code.__paginate_search')--}}

<div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer" style="position: relative; z-index: 0">
    <div class="row">
        <div class="col-sm-12">
            <table  id="tblCat" class="table table-bordered table-striped dt-responsive nowrap dataTable " role="grid" aria-describedby="datatable-buttons_info" style="width: 100%; position: relative; z-index:0;" width="100%">
                <thead>
                <tr role="row">
                    <th class="sorting_asc" aria-sort="ascending" aria-label="Name: activate to sort column descending">ID</th>
                    <th class="sorting">RFC</th>
                    <th class="sorting">Datos</th>
                    <th class="sorting text-center">Default</th>
                    <th style="width: 100vw"></th>
                </tr>
                </thead>
                <tbody>
                @if($parents->count()>0)
                @foreach($parents as $item)
                    <tr>
                        <td class="table-user">{{$item->id}}</td>
                        <td>{{($item->rfc->rfc)}}</td>
                        <td>{{($item->rfc->razon_social)}}</td>
                        <td class="text-center">
                            @if($item->isDefault())
                                <span class="success"><i class="fas fa-check"></i></span>
                            @endif
                        </td>
                        <td class="table-action">
                            <div class="button-list">
                                @include('shared.ui_kit.__remove_item')
                            </div>
                        </td>
                    </tr>
                @endforeach
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>

{{--@include('shared.code.__submit_form')--}}
