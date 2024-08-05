@extends('layouts.admin')

@section('achievement')
active
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Достижения</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Достижения</li>
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
                            <a href="{{ route('admin.achievement.create') }}" class="btn btn-primary">Добавить</a>
                        </div>
                        @if($achievements->count() > 0)
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
                                    <th>Текст</th>
                                    <th>Изображение</th>
                                    <th>Удалить</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($achievements as $achievement)
                                <tr>
                                    <td class="d-none checkbox-id">
                                        <div class="icheck-primary">
                                            <input type="checkbox" class="checkbox-id" data-delete-url="{{ route('admin.achievement.delete', $achievement->id) }}" id="checkbox{{ $achievement->id }}" />
                                            <label for="checkbox{{ $achievement->id }}"></label>
                                        </div>   
                                    </td>
                                    <td><a href="{{ route('admin.achievement.edit', $achievement->id) }}">{{ $achievement->text_ru }}</a></td>
                                    <td>
                                        <img width="auto" height="150px" src="{{ $achievement->getImageUrl() }}" class="rounded mb-3" alt="">
                                    </td>
                                    <td>
                                        <form class="achievement-delete" action="{{ route('admin.achievement.delete', $achievement->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger">Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if(method_exists($achievements, 'links'))
                        {{ $achievements->links('vendor.pagination.bootstrap-4') }}
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
<script src="{{ asset('js/achievement.js') }}"></script>
@endsection