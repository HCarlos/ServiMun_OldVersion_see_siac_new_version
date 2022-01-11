            <table id="basic-datatable" class="table table-striped dt-responsive dataTable nowrap" >
                <thead>
                    <tr role="row">
                        <th class="sorting_asc" aria-sort="ascending" aria-label="Name: activate to sort column descending">ID</th>
                        <th class="sorting" >Username</th>
                        <th class="sorting">Nombre Completo</th>
                        <th class="sorting">Email</th>
                        <th class="sorting">CURP</th>
                        <th class="sorting ">Roles</th>
                        <th class="sorting ">Ubi</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td >{{$item->id}}</td>
                        <td>{{$item->username}}</td>
                        <td>{{($item->FullName)}}</td>
                        <td>{{($item->email)}}</td>
                        <td>{{($item->curp)}}</td>
                        <td>
                            @foreach($item->roles as $role)
                                <span class="badge badge-primary">{{$role->name}}</span>
                                @if($role->name=="ENLACE")
                                    <b>{{$item->dependencias->first()->abreviatura}}</b>
                                @endif
                            @endforeach
                        </td>
                        <td>{{($item->ubicacion_id)}}</td>
                        <td class="table-action w-100">
                            <div class="button-list w-100">
                                @include('shared.ui_kit.__edit_item')
                                @if (Auth::user()->hasRole('Administrator'))
                                    @include('shared.ui_kit.__remove_item')
                                @endif
{{--                                @include('shared.ui_kit.__edit_item_becas')--}}
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
