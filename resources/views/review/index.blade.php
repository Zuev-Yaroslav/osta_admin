@extends('layouts.admin')

@section('review')
active
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Отзывы</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Отзывы</li>
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
                            <a href="{{ route('admin.review.create') }}" class="btn btn-primary">Добавить</a>
                        </div>
                        @if($reviews->count() > 0)
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
                                    <th>Автор</th>
                                    <th>Текст</th>
                                    <th>Удалить</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $review)
                                <tr>
                                    <td class="d-none checkbox-id">
                                        <div class="icheck-primary">
                                            <input type="checkbox" class="checkbox-id" data-delete-url="{{ route('admin.review.delete', $review->id) }}" id="checkbox{{ $review->id }}" />
                                            <label for="checkbox{{ $review->id }}"></label>
                                        </div>   
                                    </td>
                                    <td><a href="{{ route('admin.review.edit', $review->id) }}">{{ $review->author_ru }}</a></td>
                                    <td>{!! $review->text_ru !!}</a></td>
                                    <td>
                                        <form class="review-delete" action="{{ route('admin.review.delete', $review->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger">Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if(method_exists($reviews, 'links'))
                        {{ $reviews->links('vendor.pagination.bootstrap-4') }}
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
<script src="{{ asset('js/review.js') }}"></script>
@endsection