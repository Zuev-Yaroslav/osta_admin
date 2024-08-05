@extends('layouts.admin')

@section('mosque-history')
active
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Истории мечетей</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Истории мечетей</li>
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
                            <a href="{{ route('admin.mosque-history.create') }}" class="btn btn-primary">Добавить</a>
                        </div>
                        @if($mosqueHistories->count() > 0)
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
                                    <th>Изображение</th>
                                    <th>Удалить</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mosqueHistories as $mosqueHistory)
                                <tr>
                                    <td class="d-none checkbox-id">
                                        <div class="icheck-primary">
                                            <input type="checkbox" class="checkbox-id" data-delete-url="{{ route('admin.mosque-history.delete', $mosqueHistory->id) }}" id="checkbox{{ $mosqueHistory->id }}" />
                                            <label for="checkbox{{ $mosqueHistory->id }}"></label>
                                        </div>   
                                    </td>
                                    <td><a href="{{ route('admin.mosque-history.edit', $mosqueHistory->id) }}">{{ $mosqueHistory->title_ru }}</a></td>
                                    <td>
                                        <img width="auto" height="150px" src="{{ $mosqueHistory->getFirstImage()->getSrcUrl() }}" class="rounded mb-3" alt="{{ $mosqueHistory->getFirstImage()->alt_ru }}">
                                    </td>
                                    <td>
                                        <form class="mosque-history-delete" action="{{ route('admin.mosque-history.delete', $mosqueHistory->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger">Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if(method_exists($mosqueHistories, 'links'))
                        {{ $mosqueHistories->links('vendor.pagination.bootstrap-4') }}
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
<script src="{{ asset('js/mosque-history.js') }}"></script>
@endsection