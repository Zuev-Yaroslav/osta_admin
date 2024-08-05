@extends('layouts.admin')

@section('building')
active
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Постройки</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Постройки</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="mb-3 row row-cols-auto">
                            <a href="{{ route('admin.building.create') }}" class="btn btn-primary">Добавить</a>
                        </div>
                        @if($buildings->count() > 0)
                        <div class="row row-cols-auto gap-3">
                            <button id="SelectPossible" type="button" class="btn btn-outline-primary">Множественный выбор</button>
                            <button id="DeleteMultiple" type="button" class="btn btn-danger d-none" disabled>Удалить навсегда</button>
                        </div>
                        @endif
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th class="d-none checkbox-id"></th>
                                    <th>Заголовок</th>
                                    <th>Вместимость</th>
                                    <th>Статус</th>
                                    <th>Изображение</th>
                                    <th>Удалить</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($buildings as $building)
                                <tr>
                                    <td class="d-none checkbox-id">
                                        <div class="icheck-primary">
                                            <input type="checkbox" class="checkbox-id" data-delete-url="{{ route('admin.building.delete', $building->id) }}" id="checkbox{{ $building->id }}" />
                                            <label for="checkbox{{ $building->id }}"></label>
                                        </div>   
                                    </td>
                                    <td><a href="{{ route('admin.building.edit', $building->id) }}">{{ $building->title_ru }}</a></td>
                                    <td>{{ $building->compatibility }} человек</td>
                                    <td>{{ $building->development->name_ru }}</td>
                                    <td>
                                        <img width="auto" height="150px" src="{{ $building->getFirstImage()->getSrcUrl() }}" class="rounded mb-3" alt="{{ $building->getFirstImage()->alt_ru }}">
                                    </td>
                                    <td>
                                        <form class="building-delete" action="{{ route('admin.building.delete', $building->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger">Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if(method_exists($buildings, 'links'))
                        {{ $buildings->links('vendor.pagination.bootstrap-4') }}
                        @endif
                    </div>

                </div>

            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@section('scripts')
<script src="{{ asset('js/building.js') }}"></script>
@endsection