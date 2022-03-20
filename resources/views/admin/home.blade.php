@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('site.home')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item">@lang('site.home')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            {{--top statistics--}}
            <div class="row" id="top-statistics">

                <div class="col-md-4">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-list"></span> @lang('categories.categories')</p>
                                <a href="{{ route('admin.categories.index') }}">@lang('site.show_all')</a>
                            </div>

                            <div class="loader loader-sm"></div>

                            <h3 class="mb-0" id="categories-count" style="display: none"></h3>
                        </div>

                    </div>

                </div><!-- end of col -->

                <div class="col-md-4">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-film"></span> @lang('coupons.coupons')</p>
                                <a href="{{ route('admin.coupons.index') }}">@lang('site.show_all')</a>
                            </div>

                            <div class="loader loader-sm"></div>

                            <h3 class="mb-0" id="coupons-count" style="display: none;"></h3>
                        </div>

                    </div>

                </div><!-- end of col -->

                <div class="col-md-4">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-address-book-o"></span> @lang('brands.brands')</p>
                                <a href="{{ route('admin.brands.index') }}">@lang('site.show_all')</a>
                            </div>

                            <div class="loader loader-sm"></div>

                            <h3 class="mb-0" id="brands-count" style="display: none;"></h3>
                        </div>

                    </div>

                </div><!-- end of col -->

            </div><!-- end of row -->

        </div><!-- end of col -->

    </div><!-- end of row -->
@endsection

@push('scripts')

    <script>

        $(function () {

            topStatistics();


        });
        function topStatistics() {
            $.ajax({
                url: "{{ route('admin.home.top_statistics') }}",
                cache: false,
                success: function (data) {

                    $('#top-statistics .loader-sm').hide();

                    $('#top-statistics #categories-count').show().text(data.categories_count);
                    $('#top-statistics #brands-count').show().text(data.brands_count);
                    $('#top-statistics #coupons-count').show().text(data.coupons_count);

                },

            });//end of ajax call
        }

    </script>
@endpush
