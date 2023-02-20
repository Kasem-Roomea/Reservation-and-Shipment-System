@extends('layouts.app')

@section('title')
    التذاكر
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
                <li class="breadcrumb-item active">التذاكر </li>
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
                                أضافة مسافر
                            </button>
                            <div class="col-12 bg-black text-white">
                                <div class="rounded   text-center font-bold fs-5 mt-2">  رقم الرحلة :<span class="">{{$numTrips->id}}</span> </div>
                                <div class="rounded   text-center font-bold fs-5 mt-2">  تاريخ الرحلة :<span class="">{{$numTrips->dateTrip}}</span> </div>
                                <div class="rounded   text-center font-bold fs-5 mt-2">   من :  <span class="">{{$numTrips->from}}</span> </div>
                                <div class="rounded   text-center font-bold fs-5 mt-2">  الى :  <span class="">{{$numTrips->to}}</span> </div>
                                <div class="rounded   text-center font-bold fs-5 mt-2">  عدد الركاب :  <span class="">{{$countTickets}}</span> </div>
                            </div>
                            <div class="card-body">
                                <br><br>

                                <div class="table-responsive">
                                    <table id="" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>المقعد</th>
                                            <th>رقم التذكرة</th>
                                            <th>الأسم</th>
                                            <th>من</th>
                                            <th>الى</th>
                                            <th>مدفوع</th>
                                            <th>الجنسية</th>
                                            <th>رقم الجواز</th>
                                            <th>تاريخ الجواز</th>
                                            <th>مكان الجواز</th>
                                            <th>رقم التأشيرة</th>
                                            <th>العمليات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0; ?>
                                        @foreach($tickets as $ticket)
                                            <tr>
                                                <?php $i++; ?>
                                                <td>{{ $i }}</td>
                                                <td>{{$ticket->numTicket}}</td>
                                                <td>{{$ticket->namePerson}}</td>
                                                <td>{{$ticket->from}}</td>
                                                <td>{{$ticket->to}}</td>
                                                <td>{{$ticket->paid}}</td>
                                                <td>{{$ticket->Nationality}}</td>
                                                <td>{{$ticket->numPassport}}</td>
                                                <td>{{$ticket->datePassport}}</td>
                                                <td>{{$ticket->placePassport}}</td>
                                                <td>{{$ticket->numVisa}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal"
                                                            data-target="#transfer{{ $ticket->id }}"
                                                            title="نقل راكب"><i
                                                            class="fa fa-arrow-left"></i></button>
                                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                            data-target="#edit{{ $ticket->id }}"
                                                            title="تعديل"><i class="fa fa-edit"></i></button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                            data-target="#delete{{ $ticket->id }}"
                                                            title="حذف"><i
                                                            class="fa fa-trash"></i></button>
                                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                            data-target="#details{{ $ticket->id }}"
                                                            title="التفاصيل"><i
                                                            class="fa fa-eye"></i></button>
                                                </td>
                                            </tr>

                                            <!-- start edit -->
                                            <div class="modal fade" id="edit{{ $ticket->id }}" tabindex="-1" role="dialog"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class=" modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                id="exampleModalLabel">
                                                                تعديل التذكرة
                                                            </h5>

                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- add_form -->
                                                            <form class=" row mb-30" action="{{route('updateTickets')}}" method="POST">
                                                                {{ method_field('patch') }}
                                                                @csrf
                                                                <div class="card-body text-right">
                                                                    <div class="repeater text-right">
                                                                        <div >
                                                                            <div class="row">

                                                                                <div class="col-3 ">
                                                                                    <label for="numTicket" class="mr-sm-2">رقم التذكرة</label>
                                                                                    <input class="form-control" type="number" name="numTicket" value="{{$ticket->numTicket}}"/>
                                                                                    <input class="form-control" type="hidden" name="idTrips" value="{{$numTrips->id}}"/>
                                                                                    <input class="form-control" type="hidden" name="id" value="{{$ticket->id}}"/>
                                                                                </div>

                                                                                <div class="col-3 ">
                                                                                    <label for="namePerson" class="mr-sm-2">اسم المسافر</label>
                                                                                    <input class="form-control" name="namePerson" type="text"  value="{{$ticket->namePerson}}"/>
                                                                                </div>

                                                                                <div class="col-3 ">
                                                                                    <label for="phonePerson" class="mr-sm-2">الهاتف</label>
                                                                                    <input class="form-control" type="number" name="phonePerson" value="{{$ticket->phonePerson}}"/>
                                                                                </div>

                                                                                <div class="col-3 pt-4 mt-2">
                                                                                    <label for="gender" class="mr-sm-2">الجنس :  </label>
                                                                                    @if($ticket->gender =='ذكر' )
                                                                                    <input checked type="radio" name="gender" value="ذكر" />ذكر
                                                                                    <input class="me-2" type="radio" name="gender" value="أنثى" />أنثى
                                                                                        @else
                                                                                        <input  type="radio" name="gender" value="ذكر" />ذكر
                                                                                        <input checked class="me-2" type="radio" name="gender" value="أنثى" />أنثى
                                                                                    @endif
                                                                                </div>

                                                                                <div class="col-3 mt-2">
                                                                                    <label for="from" class="mr-sm-2">من</label>
                                                                                    <input class="form-control" type="text" name="from" value="{{$ticket->from}}"/>
                                                                                </div>

                                                                                <div class="col-3 mt-2">
                                                                                    <label for="to" class="mr-sm-2">الى</label>
                                                                                    <input class="form-control" type="text" name="to" value="{{$ticket->to}}"/>
                                                                                </div>

                                                                                <div class="col-3 mt-2">
                                                                                    <label for="Nationality" class="mr-sm-2">الجنسية</label>
                                                                                    <input class="form-control" type="text" name="Nationality" value="{{$ticket->Nationality}}"/>
                                                                                </div>

                                                                                <br><br>

                                                                                <div class="col-3 mt-2">
                                                                                    <label for="Birth" class="mr-sm-2">تاريخ الميلاد</label>
                                                                                    <input class="form-control" type="date" name="Birth" value="{{$ticket->Birth}}"/>
                                                                                </div>

                                                                                <div class="col-3 mt-2">
                                                                                    <label for="numPassport" class="mr-sm-2"> رقم الجواز</label>
                                                                                    <input class="form-control" type="number" name="numPassport" value="{{$ticket->numTicket}}"/>
                                                                                </div>

                                                                                <div class="col-3 mt-2">
                                                                                    <label for="datePassport" class="mr-sm-2"> تاريخ الجواز</label>
                                                                                    <input class="form-control" type="date" name="datePassport" value="{{$ticket->datePassport}}"/>
                                                                                </div>

                                                                                <div class="col-3 mt-2">
                                                                                    <label for="placePassport" class="mr-sm-2"> مكان أصدار الجواز</label>
                                                                                    <input class="form-control" type="text" name="placePassport" value="{{$ticket->placePassport}}"/>
                                                                                </div>

                                                                                <div class="col-3 mt-2">
                                                                                    <label for="numVisa" class="mr-sm-2"> رقم التأشيرة</label>
                                                                                    <input class="form-control" type="number" name="numVisa" value="{{$ticket->numVisa}}"/>
                                                                                </div>

                                                                                <div class="col-4 mt-2">
                                                                                    <label for="priceTicket" class="mr-sm-2">سعر التذكرة</label>
                                                                                    <input id="price" class="form-control" type="number" name="priceTicket" value="{{$ticket->priceTicket}}"/>
                                                                                </div>

                                                                                <div class="col-4 mt-2">
                                                                                    <label for="paid" class="mr-sm-2">المدفوع</label>
                                                                                    <input id="paid" onkeyup="subPaid()" class="form-control" type="number" name="paid" value="{{$ticket->paid}}"/>
                                                                                </div>

                                                                                <div class="col-4 mt-2">
                                                                                    <label for="rest" class="mr-sm-2">الباقي</label>
                                                                                    <input id="rest" class="form-control" type="number" name="rest" value="{{$ticket->rest}}"/>
                                                                                </div>

                                                                                <div class="col-12 mt-2">
                                                                                    <label for="description" class="mr-sm-2">الوصف</label>
                                                                                    <textarea class="form-control" name="description" >{{$ticket->description}}</textarea>
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
                                            <div class="modal fade" id="delete{{ $ticket->id }}" tabindex="-1" role="dialog"
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
                                                            <form action="{{ route('deleteTickets') }}" method="post">
                                                                @csrf
                                                                سيتم حذف التذكرة نهائيا
                                                                <input id="id" type="hidden" name="id" class="form-control"
                                                                       value="{{ $ticket->id }}">
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
                                            <div class="modal fade" id="transfer{{ $ticket->id }}" tabindex="-1" role="dialog"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                id="exampleModalLabel">
                                                                نقل راكب
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-right">
                                                            <form action="{{ route('TransferTickets') }}" method="post">
                                                                @csrf
                                                                <div class="card-body text-right">
                                                                    <div class="repeater text-right">
                                                                        <div >
                                                                            <div class="row">
                                                                                <input id="id" type="hidden" name="id" class="form-control"
                                                                       value="{{ $ticket->id }}">
                                                                <div class="col-12">
                                                                    <label for="trips_id" class="mr-sm-2">سيتم نقل الراكب الى الرحلة المحددة</label>
                                                                    <select class="fancyselect" name="trips_id">
                                                                        <option value="{{ $numTrips->id }}">{{ $numTrips->dateTrip??'' }}</option>
                                                                        @foreach ($tripsDate as $tripDate)
                                                                            <option value="{{ $tripDate->id }}">{{ $tripDate->dateTrip }}</option>
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
                                            <div class="modal fade" id="details{{ $ticket->id }}" tabindex="-1" role="dialog"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class=" modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                id="exampleModalLabel">
                                                                تفاصيل التذكرة
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
                                                                                    <label  class="mr-sm-2 fs-3 text-center">رقم التذكرة</label>
                                                                                    <h2 class="bg-success rounded text-center">{{$ticket->numTicket}}</h2>
                                                                                </div>

                                                                                <div class="col-4 text-center">
                                                                                    <label  class="mr-sm-2 fs-3 text-center">اسم المسافر</label>
                                                                                    <h2 class="bg-success rounded text-center">{{$ticket->namePerson}}</h2>
                                                                                </div>
                                                                                <div class="col-4 text-center">
                                                                                    <label  class="mr-sm-2 fs-3 text-center">رقم الهاتف</label>
                                                                                    <h2 class="bg-success rounded text-center">{{$ticket->phonePerson}} </h2>
                                                                                </div>
                                                                                <div class="col-4 text-center">
                                                                                    <label  class="mr-sm-2 fs-3 text-center">الجنس</label>
                                                                                    <h2 class="bg-success rounded text-center">{{$ticket->gender}}</h2>
                                                                                </div>
                                                                                <br><br>
                                                                                <div class="col-4 text-center">
                                                                                    <label  class="mr-sm-2 fs-3 text-center">من</label>
                                                                                    <h2 class="bg-success rounded text-center">{{$ticket->from}}</h2>
                                                                                </div>
                                                                                <div class="col-4 text-center">
                                                                                    <label  class="mr-sm-2 fs-3 text-center">الى</label>
                                                                                    <h2 class="bg-success rounded text-center">{{$ticket->to}}</h2>
                                                                                </div>
                                                                                <div class="col-4 text-center">
                                                                                    <label  class="mr-sm-2 fs-3 text-center">سعر التذكرة</label>
                                                                                    <h2 class="bg-success rounded text-center">{{$ticket->priceTicket}}</h2>
                                                                                </div>
                                                                                <br><br>
                                                                                <div class="col-4 text-center">
                                                                                    <label  class="mr-sm-2 fs-3 text-center">المدفوع</label>
                                                                                    <h2 class="bg-success rounded text-center">{{$ticket->paid}}</h2>
                                                                                </div>
                                                                                <div class="col-4 text-center">
                                                                                    <label  class="mr-sm-2 fs-3 text-center">الباقي</label>
                                                                                    <h2 class="bg-success rounded text-center">{{$ticket->rest}}</h2>
                                                                                </div>

                                                                                <div class="col-4 text-center">
                                                                                    <label  class="mr-sm-2 fs-3 text-center">الجنسية</label>
                                                                                    <h2 class="bg-success rounded text-center">{{$ticket->Nationality}}</h2>
                                                                                </div>

                                                                                <div class="col-4 text-center">
                                                                                    <label  class="mr-sm-2 fs-3 text-center">المواليد</label>
                                                                                    <h2 class="bg-success rounded text-center">{{$ticket->Birth}}</h2>
                                                                                </div>
                                                                                <div class="col-4 text-center">
                                                                                    <label  class="mr-sm-2 fs-3 text-center">رقم الجواز</label>
                                                                                    <h2 class="bg-success rounded text-center">{{$ticket->numPassport}}</h2>
                                                                                </div>
                                                                                <div class="col-4 text-center">
                                                                                    <label  class="mr-sm-2 fs-3 text-center">تاريخ الجواز</label>
                                                                                    <h2 class="bg-success rounded text-center">{{$ticket->datePassport}}</h2>
                                                                                </div>

                                                                                <div class="col-4 text-center">
                                                                                    <label  class="mr-sm-2 fs-3 text-center">مكان أصدار الجواز</label>
                                                                                    <h2 class="bg-success rounded text-center">{{$ticket->placePassport}}</h2>
                                                                                </div>

                                                                                <div class="col-4 text-center">
                                                                                    <label  class="mr-sm-2 fs-3 text-center">رقم التأشيرة</label>
                                                                                    <h2 class="bg-success rounded text-center">{{$ticket->numVisa}}</h2>
                                                                                </div>

                                                                                <div class="col-12 text-center">
                                                                                    <label  class="mr-sm-2 fs-3 text-center">الوصف</label>
                                                                                    <h2 class="bg-success rounded text-center">@if(!empty($ticket->description)){{$ticket->description??''}}@else {{"لا يوجد ملاحظات"}} @endif</h2>
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

                                    <form class=" row mb-30" action="{{route('storeTickets')}}" method="POST">
                                        @csrf
                                        <div class="card-body text-right">
                                            <div class="repeater text-right">
                                                <div >
                                                    <div class="row">

                                                        <div class="col-3 ">
                                                            <label for="numTicket" class="mr-sm-2">رقم التذكرة</label>
                                                            <input class="form-control" type="number" name="numTicket"/>
                                                            <input class="form-control" type="hidden" name="idTrips" value="{{$numTrips->id}}"/>
                                                        </div>

                                                        <div class="col-3 ">
                                                            <label for="namePerson" class="mr-sm-2">اسم المسافر</label>
                                                            <input class="form-control" name="namePerson" type="text" />
                                                        </div>

                                                        <div class="col-3 ">
                                                            <label for="phonePerson" class="mr-sm-2">الهاتف</label>
                                                            <input class="form-control" type="number" name="phonePerson" />
                                                        </div>

                                                        <div class="col-3 pt-4 mt-2">
                                                            <label for="phonePerson" class="mr-sm-2">الجنس :  </label>
                                                            <input class="" type="radio" name="gender" value="أنثى" />ذكر
                                                            <input class="me-2" type="radio" name="gender" value="ذكر" />أنثى
                                                        </div>

                                                        <div class="col-3 mt-2">
                                                            <label for="from" class="mr-sm-2">من</label>
                                                            <input class="form-control" type="text" name="from" />
                                                        </div>

                                                        <div class="col-3 mt-2">
                                                            <label for="to" class="mr-sm-2">الى</label>
                                                            <input class="form-control" type="text" name="to" />
                                                        </div>

                                                        <div class="col-3 mt-2">
                                                            <label for="Nationality" class="mr-sm-2">الجنسية</label>
                                                            <input class="form-control" type="text" name="Nationality" />
                                                        </div>

                                                        <br><br>

                                                        <div class="col-3 mt-2">
                                                            <label for="Birth" class="mr-sm-2">تاريخ الميلاد</label>
                                                            <input class="form-control" type="date" name="Birth" />
                                                        </div>

                                                        <div class="col-3 mt-2">
                                                            <label for="numPassport" class="mr-sm-2"> رقم الجواز</label>
                                                            <input class="form-control" type="number" name="numPassport" />
                                                        </div>

                                                        <div class="col-3 mt-2">
                                                            <label for="datePassport" class="mr-sm-2"> تاريخ الجواز</label>
                                                            <input class="form-control" type="date" name="datePassport" />
                                                        </div>

                                                        <div class="col-3 mt-2">
                                                            <label for="placePassport" class="mr-sm-2"> مكان أصدار الجواز</label>
                                                            <input class="form-control" type="text" name="placePassport" />
                                                        </div>

                                                        <div class="col-3 mt-2">
                                                            <label for="numVisa" class="mr-sm-2"> رقم التأشيرة</label>
                                                            <input class="form-control" type="number" name="numVisa" />
                                                        </div>

                                                        <div class="col-4 mt-2">
                                                            <label for="priceTicket" class="mr-sm-2">سعر التذكرة</label>
                                                            <input id="price" class="form-control" type="number" name="priceTicket" />
                                                        </div>

                                                        <div class="col-4 mt-2">
                                                            <label for="paid" class="mr-sm-2">المدفوع</label>
                                                            <input id="paid" onkeyup="subPaid()" class="form-control" type="number" name="paid" />
                                                        </div>

                                                        <div class="col-4 mt-2">
                                                            <label for="rest" class="mr-sm-2">الباقي</label>
                                                            <input id="rest" class="form-control" type="number" name="rest" />
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

<script>


    function subPaid ()
    {
        document.getElementById('rest').value = document.getElementById('price').value - document.getElementById('paid').value ;
    }

</script>
@endsection
