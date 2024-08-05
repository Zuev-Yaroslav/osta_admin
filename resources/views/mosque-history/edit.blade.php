@extends('layouts.admin')

@section('mosque-history')
active
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mosque-history.css') }}">
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Редактировать историю мечети</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Редактировать историю мечети</li>
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
            <form id="mosque-history-update" action="{{ route('admin.mosque-history.update', $mosqueHistory->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="title_ru" class="form-label">Заголовок (РУ)</label>
                    <input type="text" value="{{ $mosqueHistory->title_ru }}" name="title_ru" id="title_ru" class="form-control" placeholder="Заголовок (РУ)">
                    <div class="error invalid-feedback title_ru"></div>
                </div>
                <div class="form-group">
                    <label for="title_tt" class="form-label">Заголовок (ТАТ)</label>
                    <input type="text" value="{{ $mosqueHistory->title_tt }}" name="title_tt" id="title_tt" class="form-control" placeholder="Заголовок (ТАТ)">
                    <div class="error invalid-feedback title_tt"></div>
                </div>

                <div class="form-group">
                    <label for="text_ru" class="form-label">Контент (РУ)</label>
                    <textarea id="text_ru" name="text_ru" class="form-control">{{ $mosqueHistory->text_ru }}</textarea>
                    <div class="error invalid-feedback text_ru"></div>
                </div>
                <div class="form-group">
                    <label for="text_tt" class="form-label">Контент (ТАТ)</label>
                    <textarea id="text_tt" name="text_tt" class="form-control">{{ $mosqueHistory->text_tt }}</textarea>
                    <div class="error invalid-feedback text_tt"></div>
                </div>
                @include('includes.admin.building.dropzone-images')
                <div id="images" class="row row-cols-auto gap-4 ml-2 mb-3 mt-4">  
                    @foreach ($mosqueHistory->images()->orderBy('sort_index')->get() as $index => $image)
                    <div class="image">
                        <input type="hidden" class="sort_index" name="images[{{ $index }}][sort_index]" value="{{ $image->sort_index }}">
                        <input type="hidden" name="images[{{ $index }}][id]" value="{{ $image->id }}">
                        <div class="position-relative image-hover" style="width: 200px">
                            <button type="button" class="p-0 border-0 rounded" data-toggle="modal" data-target="#image{{ $index }}">
                                <span class="position-absolute top-50 start-50 translate-middle text-white w-100 alt-title">{{ $image->alt_ru }}</span>
                                <img class="rounded" src="{{ $image->getSrcUrl() }}" alt="{{ $image->alt_ru }}" width="200px" height="auto">
                            </button>
                            <div class="invalid-feedback images{{ $index }}">Ошибка</div>
                            <button type="button" data-id="{{ $image->id }}" class="position-absolute top-0 start-0 translate-middle btn btn-danger btn-sm image-delete"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                        <div class="grab" style="cursor: grab" >Зажми, чтобы перетащить</div>
                        <div class="modal fade" id="image{{ $index }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Информация о фотографии</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="mb-3">
                                            <img src="{{ $image->getSrcUrl() }}" alt="{{ $image->alt_ru }}" class="rounded" width="100%" height="10%">
                                        </div>
                                        <div class="mb-3">
                                            <input type="hidden" name="images[{{ $index }}][id]" value="{{ $image->id }}">
                                            <label for="alt_ru{{ $index }}">Alt заголовок (РУ)</label>
                                            <input type="text" class="form-control alt_ru" name="images[{{ $index }}][alt_ru]" id="alt_ru{{ $index }}" value="{{ $image->alt_ru }}">
                                            <div class="invalid-feedback images_{{ $index }}_alt_ru"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="alt_tt{{ $index }}">Alt заголовок (ТАТ)</label>
                                            <input type="text" class="form-control alt_tt" name="images[{{ $index }}][alt_tt]" id="alt_tt{{ $index }}" value="{{ $image->alt_tt }}">
                                            <div class="invalid-feedback images_{{ $index }}_alt_tt"></div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-end">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                </div>
            </form>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<div class="modal fade" id="success" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p>Изменения сохранены!</p>
            </div>
            <div class="modal-footer justify-content-between">
                <a href="{{ route('admin.mosque-history.index') }}" class="btn btn-default">Выйти</a>
                <a href="{{ route('admin.mosque-history.edit', $mosqueHistory->id) }}" class="btn btn-primary">Остаться</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@include('includes.admin.crud-modals.crud-modals')


@endsection

@section('scripts')
<script src="{{ asset('js/mosque-history.js') }}"></script>
@endsection
