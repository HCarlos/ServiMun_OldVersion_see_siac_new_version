<table  id="tblCat" class="table table-bordered table-striped dt-responsive dataTable " role="grid" aria-describedby="datatable-buttons_info" style="width: 100%; position: relative; z-index:0;" width="100%">
    <thead>
    <tr role="row">
        <th class="sorting_asc" aria-sort="ascending" aria-label="Name: activate to sort column descending">ID</th>
        <th class="sorting" >Folio</th>
        <th class="sorting">Ciudadano</th>
        <th class="sorting">Fecha</th>
        <th class="sorting ">Estatus</th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    @foreach($items as $item)
        <tr>
            <td class="table-user">{{$item->id}}</td>
            <td>{{$item->ciudadano->FullName}}</td>
            <td>{{($item->Fecha)}}</td>
            <td>{{($item->Estatus)}}</td>
            <td class="table-action">
                <div class="button-list">
                    @include('shared.ui_kit.__edit_item')
                    @include('shared.ui_kit.__remove_item')
                </div>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>