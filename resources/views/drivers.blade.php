@extends('layouts.app')

@section('title')
    السائقين
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"></h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item active">السائقين </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                @section('content')
                    <!-- row -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show text-right" role="alert">
                                <strong>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true" class="font-bold">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session()->has('Success'))
                            <div class="alert alert-success text-right alert-dismissible fade show" role="alert">
                                <strong>{{ session('Success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session()->has('Delete'))
                            <div class="alert alert-danger text-right alert-dismissible fade show" role="alert">
                                <strong>{{ session('Delete') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                    <!-- Start tabel -->
                        <div class="col-md-12 mb-30">
                            <div class="card card-statistics h-100">
                                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                                    أضافة سائق
                                </button>

                                <div class="card-body">
                                    <br><br>

                                    <div class="table-responsive">
                                        <table id="" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                               style="text-align: center">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>الأسم</th>
                                                <th>رقم الهاتف</th>
                                                <th>العنوان</th>
                                                <th>الجنسة</th>
                                                <th>العمليات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i=0;?>
                                            @foreach($drivers as $driver)
                                                    <?php $i++?>
                                                <tr>

                                                    <td>{{$i}}</td>
                                                    <td>{{$driver->name}}</td>
                                                    <td>{{$driver->phone}}</td>
                                                    <td>{{$driver->address}}</td>
                                                    <td>{{$driver->nationality}}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                                data-target="#edit{{ $driver->id }}"
                                                                title="تعديل"><i class="fa fa-edit"></i></button>
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                                data-target="#delete{{ $driver->id }}"
                                                                title="حذف"><i
                                                                class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                <!-- start edit -->
                                                <div class="modal fade" id="edit{{ $driver->id }}" tabindex="-1" role="dialog"
                                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class=" modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                    id="exampleModalLabel">
                                                                    تعديل السائق
                                                                </h5>

                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- add_form -->
                                                                <form class=" row mb-30" action="{{route('driver.update', 'test')}}" method="POST">
                                                                    {{ method_field('patch') }}
                                                                    @csrf
                                                                    <div class="card-body text-right">
                                                                        <div class="repeater text-right">
                                                                            <div>
                                                                                <div class="row">

                                                                                    <div class="col-4">
                                                                                        <label for="name" class="mr-sm-2">أسم السائق</label>
                                                                                        <input class="form-control" type="text" name="name" value="{{$driver->name}}"/>
                                                                                        <input class="form-control" type="hidden" name="id" value="{{$driver->id}}"/>
                                                                                    </div>

                                                                                    <div class="col-3 ">
                                                                                        <label for="phone" class="mr-sm-2">هاتف السائق</label>
                                                                                        <input class="form-control" name="phone" type="number"  value="{{$driver->phone}}"/>
                                                                                    </div>

                                                                                    <div class="col-3">
                                                                                        <label for="address" class="mr-sm-2">عنوان السائق</label>
                                                                                        <input class="form-control" type="text" name="address" value="{{$driver->address}}"/>
                                                                                    </div>


                                                                                    <div class="col-2 ">
                                                                                        <label for="nationality" class="mr-sm-2">الجنسية</label>
                                                                                        <input class="form-control" type="text" name="nationality" value="{{$driver->nationality}}"/>
                                                                                    </div>

                                                                                    <br>
                                                                                    <br>
                                                                                    <br>
                                                                                    <br>

                                                                                    <div class="modal-footer text-center mt-3">
                                                                                        <button type="submit" class="btn btn-success col-5 ">تعديل</button>
                                                                                        <button type="button" class="btn btn-secondary col-5" data-dismiss="modal">الغاء</button>
                                                                                    </div>


                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end edit -->
                                                <!-- start delete -->
                                                <div class="modal fade" id="delete{{ $driver->id }}" tabindex="-1" role="dialog"
                                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                    id="exampleModalLabel">
                                                                    حذف
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-right">
                                                                <form action="{{ route('driver.destroy', 'test') }}" method="post">
                                                                    {{ method_field('Delete') }}
                                                                    @csrf
                                                                    سيتم حذف السائق نهائيا
                                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                                           value="{{ $driver->id }}">
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-danger">حذف</button>
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">أغلاق</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end  delete -->
                                            @endforeach
                                            </tbody>
                                        </table>

                                    </div>

                                </div>


                            </div>
                        </div>
                        <!-- end tabel -->

                        <!-- start add -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header text-right">
                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title text-right" id="exampleModalLabel">
                                            أغلاق
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form class=" row mb-30" action="{{route('driver.store', 'test')}}" method="POST">
                                            @csrf
                                            <div class="card-body text-right">
                                                <div class="repeater text-right">
                                                    <div >
                                                        <div class="row">

                                                            <div class="col-4 ">
                                                                <label for="name" class="mr-sm-2">أسم السائق</label>
                                                                <input class="form-control" type="text" name="name" />
                                                            </div>

                                                            <div class="col-3 ">
                                                                <label for="address" class="mr-sm-2">عنوان السائق</label>
                                                                <input class="form-control" type="text" name="address"/>
                                                            </div>

                                                            <div class="col-3 ">
                                                                <label for="phone" class="mr-sm-2">هاتف السائق</label>
                                                                <input class="form-control" name="phone" type="number" />
                                                            </div>


                                                            <div class="col-2">
                                                                <label for="nationality" class="mr-sm-2">الجنسية</label>
                                                                <input class="form-control" type="text" name="nationality"/>
                                                            </div>


                                                            <br>
                                                            <br>
                                                            <br>
                                                            <br>

                                                            <div class="modal-footer text-center mt-3">
                                                                <button type="submit" class="btn btn-success col-5 ">أضافة</button>
                                                                <button type="button" class="btn btn-secondary col-5" data-dismiss="modal">الغاء</button>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>

                            </div>

                        </div>
                        <!-- end add -->


                        <!-- row closed -->
                    @endsection
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')

@endsection
