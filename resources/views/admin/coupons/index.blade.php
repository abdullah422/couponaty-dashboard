@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('coupons.coupons')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('coupons.coupons')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <div class="row mb-2">

                    <div class="col-md-12">

                        @if (auth()->user()->hasPermission('read_coupons'))
                            <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary"><i
                                    class="fa fa-plus"></i> @lang('site.create')</a>
                        @endif

                        @if (auth()->user()->hasPermission('delete_coupons'))
                            <form method="post" action="{{ route('admin.coupons.bulk_delete') }}"
                                  style="display: inline-block;">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="record_ids" id="record-ids">
                                <button type="submit" class="btn btn-danger" id="bulk-delete" disabled="true"><i
                                        class="fa fa-trash"></i> @lang('site.bulk_delete')</button>
                            </form><!-- end of form -->
                        @endif

                    </div>

                </div><!-- end of row -->

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" id="data-table-search" class="form-control" autofocus
                                   placeholder="@lang('site.search')">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select id="category" class="form-control select2" required>
                                <option value="">@lang('site.all') @lang('Categories.categories')</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == request()->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select id="brand" class="form-control select2" required>
                                <option value="">@lang('site.all') @lang('brands.brands')</option>
                                @if ($brand)
                                    <option value="{{ $brand->id }}" {{ $brand->id == request()->brand_id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endif
                            </select>
                        </div>
                    </div>

                </div><!-- end of row -->

                <div class="row">

                    <div class="col-md-12">

                        <div class="table-responsive">

                            <table class="table datatable" id="coupons-table" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>
                                        <div class="animated-checkbox">
                                            <label class="m-0">
                                                <input type="checkbox" id="record__select-all">
                                                <span class="label-text"></span>
                                            </label>
                                        </div>
                                    </th>
                                    <th>@lang('coupons.title')</th>
                                    <th>@lang('coupons.brand')</th>
                                    <th>@lang('coupons.category')</th>
                                    <th>@lang('coupons.favourite_by')</th>
                                    <th>@lang('site.created_at')</th>
                                    <th>@lang('site.action')</th>
                                </tr>
                                </thead>
                            </table>

                        </div><!-- end of table responsive -->

                    </div><!-- end of col -->

                </div><!-- end of row -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection

@push('scripts')

    <script>

        let category = '{{request()->category_id}}';
        let brand = '{{request()->brand_id}}';


        let couponsTable = $('#coupons-table').DataTable({
            dom: "tiplr",
            serverSide: true,
            processing: true,
            /* "language": {
                 "url": "{{ asset('admin_assets/datatable-lang/' . app()->getLocale() . '.json') }}"
            },*/
            ajax: {
                url: '{{ route('admin.coupons.data') }}',
                data: function (d) {
                    d.category_id = category;
                    d.brand_id = brand;
                }
            },
            columns: [
                {data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'},
                {data: 'title', name: 'title'},
                {data: 'brand', name: 'brand', searchable: false, sortable: false},

                {data: 'category', name: 'category', searchable: false, sortable: false},
                {data: 'favourite_by_user_count', name: 'favourite_by_user_count', searchable: false},
                {data: 'created_at', name: 'created_at', searchable: false},
                {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '20%'},
            ],
            order: [[5, 'desc']],
            drawCallback: function (settings) {
                $('.record__select').prop('checked', false);
                $('#record__select-all').prop('checked', false);
                $('#record-ids').val();
                $('#bulk-delete').attr('disabled', true);
            }
        });

        $('#data-table-search').keyup(function () {
            couponsTable.search(this.value).draw();
        })

        $('#category').on('change', function () {
            category = this.value;
            couponsTable.ajax.reload();
        })
        $('#brand').on('change', function () {
            brand = this.value;
            couponsTable.ajax.reload();
        })
        $('#brand').select2({
            ajax: {
                url: "{{ route('admin.brands.index') }}",
                dataType: 'json',
                data: function (params) {
                    return {
                        search: params.term,
                    }
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                }
            }
        });

    </script>

@endpush
