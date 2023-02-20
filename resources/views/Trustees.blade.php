@extends('layouts.app')

@section('title')
    الأمانات
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
                    <li class="breadcrumb-item active">الأمانات </li>
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
                                    أضافة أمانة
                                </button>

                                <div class="col-12 bg-black text-white">
                                     <div class="rounded   text-center font-bold fs-5 mt-2">  رقم الرحلة :<span class="">{{$numTrips->id}}</span> </div>
                                     <div class="rounded   text-center font-bold fs-5 mt-2">  تاريخ الرحلة :<span class="">{{$numTrips->dateTrip}}</span> </div>
                                     <div class="rounded   text-center font-bold fs-5 mt-2">   من :  <span class="">{{$numTrips->from}}</span> </div>
                                     <div class="rounded   text-center font-bold fs-5 mt-2">  الى :  <span class="">{{$numTrips->to}}</span> </div>
                                     <div class="rounded   text-center font-bold fs-5 mt-2">  عدد الأمانات :  <span class="">{{$countTrustees}}</span> </div>
                                </div>
                                <div class="card-body">
                                    <br><br>

                                    <div class="table-responsive">
                                        <table id="" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                               style="text-align: center">
                                            <thead>
                                            <tr>
                                                <th>رقم الأمانة</th>
                                                <th>المرسل</th>
                                                <th>هاتف المرسل</th>
                                                <th>جهة الأرسال</th>
                                                <th>المرسل اليه</th>
                                                <th>هاتف المرسل اليه</th>
                                                <th>وصف الطرد</th>
                                                <th>السعر</th>
                                                <th>العمولة</th>
                                                <th>العمليات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($trustees as $trustee)
                                                <tr>

                                                    <td>{{$trustee->id}}</td>
                                                    <td>{{$trustee->senderName}}</td>
                                                    <td>{{$trustee->senderPhone}}</td>
                                                    <td>{{$trustee->senderPlace}}</td>
                                                    <td>{{$trustee->receiverName}}</td>
                                                    <td>{{$trustee->receivedPhone}}</td>
                                                    <td>{{$trustee->description}}</td>
                                                    <td>{{$trustee->price}}</td>
                                                    <td>%</td>
                                                    <td>
                                                        <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal"
                                                                data-target="#transfer{{ $trustee->id }}"
                                                                title="نقل الأمانة"><i
                                                                class="fa fa-arrow-left"></i></button>
                                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                                data-target="#edit{{ $trustee->id }}"
                                                                title="تعديل"><i class="fa fa-edit"></i></button>
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                                data-target="#delete{{ $trustee->id }}"
                                                                title="حذف"><i
                                                                class="fa fa-trash"></i></button>
                                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                                data-target="#details{{ $trustee->id }}"
                                                                title="التفاصيل"><i
                                                                class="fa fa-eye"></i></button>
                                                    </td>
                                                </tr>
                                                <!-- start edit -->
                                                <div class="modal fade" id="edit{{ $trustee->id }}" tabindex="-1" role="dialog"
                                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class=" modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                    id="exampleModalLabel">
                                                                    تعديل الأمانة
                                                                </h5>

                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- add_form -->
                                                                <form class=" row mb-30" action="{{route('updateTrustees')}}" method="POST">
                                                                    {{ method_field('patch') }}
                                                                    @csrf
                                                                    <div class="card-body text-right">
                                                                        <div class="repeater text-right">
                                                                            <div >
                                                                                <div class="row">

                                                                                    <div class="col-4 ">
                                                                                        <label for="senderName" class="mr-sm-2">أسم المرسل</label>
                                                                                        <input class="form-control" type="text" name="senderName" value="{{$trustee->senderName}}"/>
                                                                                        <input class="form-control" type="hidden" name="idTrips" value="{{$numTrips->id}}"/>
                                                                                        <input class="form-control" type="hidden" name="id" value="{{$trustee->id}}"/>
                                                                                    </div>

                                                                                    <div class="col-4 ">
                                                                                        <label for="senderPlace" class="mr-sm-2">مكان الأرسال</label>
                                                                                        <input class="form-control" name="senderPlace" type="text"  value="{{$trustee->senderPlace}}"/>
                                                                                    </div>

                                                                                    <div class="col-4 ">
                                                                                        <label for="senderPhone" class="mr-sm-2">هاتف المرسل </label>
                                                                                        <input class="form-control" type="number" name="senderPhone" value="{{$trustee->senderPhone}}"/>
                                                                                    </div>


                                                                                    <div class="col-4 mt-2">
                                                                                        <label for="receiverName" class="mr-sm-2">أسم المرسل اليه</label>
                                                                                        <input class="form-control" type="text" name="receiverName" value="{{$trustee->receiverName}}"/>
                                                                                    </div>

                                                                                    <div class="col-4 mt-2">
                                                                                        <label for="receivedPhone" class="mr-sm-2"> هاتف المرسل اليه </label>
                                                                                        <input class="form-control" type="number" name="receivedPhone" value="{{$trustee->receivedPhone}}"/>
                                                                                    </div>

                                                                                    <div class="col-4 mt-2">
                                                                                        <label for="receivedPhoneS" class="mr-sm-2"> هاتف المرسل اليه الاحتياطي</label>
                                                                                        <input class="form-control" type="number" name="receivedPhoneS" value="{{$trustee->receivedPhoneS??0}}"/>
                                                                                    </div>

                                                                                    <br><br>

                                                                                    <div class="col-4 mt-2">
                                                                                        <label for="price" class="mr-sm-2">السعر</label>
                                                                                        <input class="form-control" type="number" name="price" value="{{$trustee->price}}"/>
                                                                                    </div>

                                                                                    <div class="col-4 mt-2">
                                                                                        <label for="paid" class="mr-sm-2">مدفوع</label>
                                                                                        <input class="form-control" type="number" name="paid" value="{{$trustee->paid}}"/>
                                                                                    </div>

                                                                                    <div class="col-4 mt-2">
                                                                                        <label for="byName" class="mr-sm-2">مسجل الامانة</label>
                                                                                        <input class="form-control" type="text" name="byName" value="{{$trustee->byName}}" disabled/>
                                                                                    </div>

                                                                                    <div class="col-12 mt-2">
                                                                                        <label for="description" class="mr-sm-2">الوصف</label>
                                                                                        <textarea class="form-control" name="description" >{{$trustee->description}}</textarea>
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
                                                <div class="modal fade" id="delete{{ $trustee->id }}" tabindex="-1" role="dialog"
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
                                                                <form action="{{ route('deleteTrustees') }}" method="post">
                                                                    @csrf
                                                                    سيتم حذف الأمانة نهائيا
                                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                                           value="{{ $trustee->id }}">
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

                                                <!-- start transfer -->
                                                <div class="modal fade" id="transfer{{ $trustee->id }}" tabindex="-1" role="dialog"
                                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                    id="exampleModalLabel">
                                                                     نقل أمانة
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-right">
                                                                <form action="{{ route('TransferTrustees') }}" method="post">
                                                                    @csrf
                                                                    <div class="card-body text-right">
                                                                        <div class="repeater text-right">
                                                                            <div >
                                                                                <div class="row">
                                                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                                                           value="{{ $trustee->id }}">
                                                                                    <div class="col-12">
                                                                                        <label for="trips_id" class="mr-sm-2">سيتم نقل الامانة الى الرحلة المحددة</label>
                                                                                        <select class="fancyselect" name="trips_id">
                                                                                            <option value="{{ $numTrips->id }}">{{ $numTrips->dateTrip??'' }}</option>
                                                                                            @foreach ($tripsDate as $tripDate)
                                                                                                <option value="{{ $tripDate->id }}">{{ $tripDate->dateTrip??'' }}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                     </div>
                                                                                </div>
                                                                                </div>
                                                                                </div>
                                                                                </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-success">نقل</button>
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">أغلاق</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end  transfer -->

                                                <!-- start details -->
                                                <div class="modal fade" id="details{{ $trustee->id }}" tabindex="-1" role="dialog"
                                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class=" modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                    id="exampleModalLabel">
                                                                    تفاصيل الأمانة
                                                                </h5>

                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <div class="card-body text-right">
                                                                    <div class="repeater text-right">
                                                                        <div data-repeater-list="List_Classes">
                                                                            <div data-repeater-item>
                                                                                <div class="row">

                                                                                    <div class="col-4 text-center">
                                                                                        <label  class="mr-sm-2 fs-3 text-center">اسم المرسل</label>
                                                                                        <h2 class="bg-success rounded text-center">{{$trustee->senderName}}</h2>
                                                                                    </div>

                                                                                    <div class="col-4 text-center">
                                                                                        <label  class="mr-sm-2 fs-3 text-center">رقم المرسل</label>
                                                                                        <h2 class="bg-success rounded text-center">{{$trustee->senderPhone}}</h2>
                                                                                    </div>
                                                                                    <div class="col-4 text-center">
                                                                                        <label  class="mr-sm-2 fs-3 text-center"> الجهة المرسلة للأمانة</label>
                                                                                        <h2 class="bg-success rounded text-center">{{$trustee->senderPlace}} </h2>
                                                                                    </div>
                                                                                    <div class="col-4 text-center">
                                                                                        <label  class="mr-sm-2 fs-3 text-center">اسم المرسل اليه</label>
                                                                                        <h2 class="bg-success rounded text-center">{{$trustee->receiverName}}</h2>
                                                                                    </div>
                                                                                    <br><br>
                                                                                    <div class="col-4 text-center">
                                                                                        <label  class="mr-sm-2 fs-3 text-center">هاتف المرسل اليه</label>
                                                                                        <h2 class="bg-success rounded text-center">{{$trustee->receivedPhone}}</h2>
                                                                                    </div>
                                                                                    <div class="col-4 text-center">
                                                                                        <label  class="mr-sm-2 fs-3 text-center">هاتف المرسل اليه 2 </label>
                                                                                        <h2 class="bg-success rounded text-center">{{$trustee->receivedPhoneS??0}}</h2>
                                                                                    </div>
                                                                                    <div class="col-4 text-center">
                                                                                        <label  class="mr-sm-2 fs-3 text-center">السعر </label>
                                                                                        <h2 class="bg-success rounded text-center">{{$trustee->price}}</h2>
                                                                                    </div>
                                                                                    <br><br>
                                                                                    <div class="col-4 text-center">
                                                                                        <label  class="mr-sm-2 fs-3 text-center">المدفوع</label>
                                                                                        <h2 class="bg-success rounded text-center">{{$trustee->paid}}</h2>
                                                                                    </div>
                                                                                    <div class="col-4 text-center">
                                                                                        <label  class="mr-sm-2 fs-3 text-center">مسجل الأمانة</label>
                                                                                        <h2 class="bg-success rounded text-center">{{$trustee->byName}}</h2>
                                                                                    </div>

                                                                                    <div class="col-12 text-center">
                                                                                        <label  class="mr-sm-2 fs-3 text-center">الوصف</label>
                                                                                        <h2 class="bg-success rounded text-center">@if(!empty($trustee->description)){{$trustee->description??''}}@else {{"لا يوجد وصف"}} @endif</h2>
                                                                                    </div>
                                                                                    <br>
                                                                                    <br>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end details -->
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

                                        <form class=" row mb-30" action="{{route('storeTrustees')}}" method="POST">
                                            @csrf
                                            <div class="card-body text-right">
                                                <div class="repeater text-right">
                                                    <div >
                                                        <div class="row">

                                                            <div class="col-4 ">
                                                                <label for="senderName" class="mr-sm-2">أسم المرسل</label>
                                                                <input class="form-control" type="text" name="senderName"/>
                                                                <input class="form-control" type="hidden" name="idTrips" value="{{$numTrips->id}}"/>
                                                            </div>

                                                            <div class="col-4 ">
                                                                <label for="senderPlace" class="mr-sm-2">مكان الأرسال</label>
                                                                <input class="form-control" name="senderPlace" type="text" />
                                                            </div>

                                                            <div class="col-4 ">
                                                                <label for="senderPhone" class="mr-sm-2">هاتف المرسل </label>
                                                                <input class="form-control" type="number" name="senderPhone" />
                                                            </div>


                                                            <div class="col-4 mt-2">
                                                                <label for="receiverName" class="mr-sm-2">أسم المرسل اليه</label>
                                                                <input class="form-control" type="text" name="receiverName" />
                                                            </div>

                                                            <div class="col-4 mt-2">
                                                                <label for="receivedPhone" class="mr-sm-2"> هاتف المرسل اليه </label>
                                                                <input class="form-control" type="number" name="receivedPhone" />
                                                            </div>

                                                            <div class="col-4 mt-2">
                                                                <label for="receivedPhoneS" class="mr-sm-2"> هاتف المرسل اليه الاحتياطي</label>
                                                                <input class="form-control" type="number" name="receivedPhoneS" />
                                                            </div>

                                                            <br><br>

                                                            <div class="col-4 mt-2">
                                                                <label for="price" class="mr-sm-2">السعر</label>
                                                                <input class="form-control" type="number" name="price" />
                                                            </div>

                                                            <div class="col-4 mt-2">
                                                                <label for="paid" class="mr-sm-2">مدفوع</label>
                                                                <input class="form-control" type="number" name="paid" />
                                                            </div>

                                                            <div class="col-4 mt-2">
                                                                <label for="byName" class="mr-sm-2">مسجل الامانة</label>
                                                                <input class="form-control" type="text" name="byName" value="{{Auth::User()->name}}" disabled/>
                                                            </div>

                                                            <div class="col-12 mt-2">
                                                                <label for="description" class="mr-sm-2">الوصف</label>
                                                                <textarea class="form-control" name="description" ></textarea>
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
