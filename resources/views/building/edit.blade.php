@extends('layouts.admin')

@section('building')
active
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/building.css') }}">
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Редактировать постройку</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Редактировать постройку</li>
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
            <form id="building-update" action="{{ route('admin.building.update', $building->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="title_ru" class="form-label">Заголовок (РУ)</label>
                    <input type="text" value="{{ $building->title_ru }}" name="title_ru" id="title_ru" class="form-control" placeholder="Заголовок (РУ)">
                    <div class="error invalid-feedback title_ru"></div>
                </div>
                <div class="form-group">
                    <label for="title_tt" class="form-label">Заголовок (ТАТ)</label>
                    <input type="text" value="{{ $building->title_tt }}" name="title_tt" id="title_tt" class="form-control" placeholder="Заголовок (ТАТ)">
                    <div class="error invalid-feedback title_tt"></div>
                </div>

                <div class="form-group">
                    <label for="text_ru" class="form-label">Контент (РУ)</label>
                    <textarea id="text_ru" class="editor">{{ $building->text_ru }}</textarea>
                    <div class="error invalid-feedback text_ru"></div>
                </div>
                <div class="form-group">
                    <label for="text_tt" class="form-label">Контент (ТАТ)</label>
                    <textarea id="text_tt" class="editor">{{ $building->text_tt }}</textarea>
                    <div class="error invalid-feedback text_tt"></div>
                </div>
                <div class="form-group" style="width: 300px">
                    <label for="compatibility" class="form-label">Вместимость</label>
                    <input type="number" value="{{ $building->compatibility }}" name="compatibility" id="compatibility" class="form-control" placeholder="Вместимость">
                    <div class="error invalid-feedback compatibility"></div>
                </div>
                <div class="form-group">
                    <label class="form-label">Этап разработки</label>
                    <select name="development_id" id="development_id" class="custom-select">
                        @foreach ($developments as $development)
                            <option value="{{ $development->id }}" 
                                @if($building->development_id === $development->id)
                                @selected(true)
                                @endif
                                >{{ $development->name_ru }}</option>
                        @endforeach
                    </select>
                    <div class="error invalid-feedback development_id"></div>
                </div>
                @include('includes.admin.building.dropzone-images')
                <div id="images" class="row row-cols-auto gap-4 ml-2 mb-3 mt-4">  
                    @foreach ($building->images()->orderBy('sort_index')->get() as $index => $image)
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
                    <button type="submit" class="btn btn-primary">Изменить сохранения</button>
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
                <a href="{{ route('admin.building.index') }}" class="btn btn-default">Выйти</a>
                <a href="{{ route('admin.building.edit', $building->id) }}" class="btn btn-primary">Остаться</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@include('includes.admin.crud-modals.crud-modals')


@endsection

@section('scripts')
<script src="{{ asset('js/building.js') }}"></script>
@endsection
