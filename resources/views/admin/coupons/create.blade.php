@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('coupons.coupons')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.coupons.index') }}">@lang('coupons.coupons')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">
                <form method="post" action="{{ route('admin.coupons.store') }}  " enctype="multipart/form-data" >
                    @csrf
                    @method('post')

                    @include('admin.partials._errors')
                    <div class="row">
                        <div class="col-md-6">
                            {{--category--}}
                            <div class="form-group">
                                <label>@lang('coupons.category')<span class="text-danger">*</span></label>
                                <select name="category_id" class="form-control" required autofocus>
                                    <option value="">@lang('coupons.select_one')</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{--brand--}}
                            <div class="form-group">
                                <label>@lang('coupons.brand')<span class="text-danger">*</span></label>
                                <select name="brand_id" class="form-control" required>
                                    <option value="">@lang('coupons.select_one')</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{--title--}}
                            <div class="form-group">
                                <label>@lang('coupons.title')<span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required >
                            </div>
                            {{--des--}}
                            <div class="form-group">
                                <label>@lang('coupons.des')<span class="text-danger">*</span></label>
                                <input type="text" name="des" class="form-control" value="{{ old('des') }}" required >
                            </div>

                        </div><!-- end of column -->

                        <div class="col-md-6">

                            {{--code--}}
                            <div class="form-group">
                                <label>@lang('coupons.code')  <span class="text-danger">*</span></label>
                                <input type="text" name="code" class="form-control"  maxlength="10" value="{{ old('code') }}"  >
                            </div>
                            {{--url--}}
                            <div class="form-group">
                                <label>@lang('coupons.url')  <span class="text-danger">*</span></label>
                                <textarea  type="text" name="url" class="form-control" aria-label="With textarea" > {{old('url')}}</textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.create')</button>
                            </div>
                        </div><!-- end of column -->

                    </div><!-- end of row -->

                </form
                ><!-- end of form -->
                </div><!--end of shadow> -->

            </div><!-- end of column -->

        </div><!-- end of row -->


    </div><!-- end of row -->

@endsection


