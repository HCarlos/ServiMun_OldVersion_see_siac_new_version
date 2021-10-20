            <table  id="tblCat" class="table table-bordered table-striped dt-responsive dataTable " role="grid" aria-describedby="datatable-buttons_info" style="width: 100%; position: relative; z-index:0;" width="100%">
                <thead>
                    <tr role="row">
                        <th class="sorting_asc" aria-sort="ascending" aria-label="Name: activate to sort column descending">ID</th>
                        <th class="sorting" >Username</th>
                        <th class="sorting">Nombre Completo</th>
                        <th class="sorting">Email</th>
                        <th class="sorting">CURP</th>
                        <th class="sorting">Genero</th>
                        <th class="sorting ">Roles</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td class="table-user">{{$item->id}}</td>
                        <td>{{$item->username}}</td>
                        <td>{{($item->FullName)}}</td>
                        <td>{{($item->email)}}</td>
                        <td>{{($item->curp)}}</td>
                       <td class="action-icon text-center">@if($item->genero==0)
                               <i class="fas fa-female text-danger"></i>
                           @else
                               <i class="fas fa-male text-primary"></i>
                           @endif
                       </td>
                        <td>
                            @foreach($item->roles as $role)
                                <span class="badge badge-primary">{{$role->name}}</span>
                            @endforeach
                        </td>
                        <td class="table-action">
                            <div class="button-list">
                                @include('shared.ui_kit.__edit_item')
                                @include('shared.ui_kit.__remove_item')
                                @include('shared.ui_kit.__edit_item_becas')
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
