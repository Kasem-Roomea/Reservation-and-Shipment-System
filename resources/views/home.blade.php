@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

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

                <!-- Start tabel -->
                <div class="text-right">


                    <a class="btn btn-dark text-white x-small me-4 " href="{{url('micro')}}" >
                    الباصات
                </a>
                <a  class="btn btn-dark text-white x-small" href="{{url('driver')}}">
                    السائقين
                </a>

                    <input id="now" type="checkbox" class="form-check-input ml-4" style="width:20px;height:20px" @if(isset($check))
                    {
                        checked
                    }@endif
                    }} >
                    <label class="ml-5 mt-1 font-bold">الرحلات الحالية</label>
                    </input>
                </div>
                <div class="col-md-12 mb-30">
                    <div class="card card-statistics h-100">
                        <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                            أضافة رحلة
                        </button>

                        <div class="card-body">
                            <br><br>

                            <div class="table-responsive">

                                <table id="table_trips" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                       style="text-align: center" >
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>رقم الرحلة</th>
                                        <th>تاريخ الرحلة</th>
                                        <th>من</th>
                                        <th>الى</th>
                                        <th>الباص</th>
                                        <th>أسم السائق</th>
                                        <th>عدد الركاب الكلي</th>
                                        <th>الأمانات</th>
                                        <th>الركاب</th>
                                        <th>العمليات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 0; ?>
                                    @foreach($trips as $trip)
                                        <tr>
                                            <?php $i++; ?>
                                            <td>{{ $i }}</td>
                                            <td>{{$trip->id}}</td>
                                            <td>{{$trip->dateTrip}}</td>
                                            <td>{{$trip->from}}</td>
                                            <td>{{$trip->to}}</td>
                                            <td>{{$trip->micro->name??''}}</td>
                                            <td>{{$trip->driver->name??''}}</td>
                                            <td>{{$trip->numPeople}}</td>
                                            <td>
                                                <a  class="btn btn-warning btn-sm" href="trustees/{{$trip->id}}" title="الأمانات"><i class="fa fa-hand-grab-o"></i></a>
                                            </td>
                                            <td>
                                                <a  class="btn btn-secondary btn-sm" href="tickets/{{ $trip->id }}" title="الركاب"><i class="fa fa-user"></i></a>
                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                        data-target="#edit{{ $trip->id }}"
                                                        title="تعديل"><i class="fa fa-edit"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#delete{{ $trip->id }}"
                                                        title="حذف"><i
                                                        class="fa fa-trash"></i></button>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                        data-target="#details{{ $trip->id }}"
                                                        title="التفاصيل"><i
                                                        class="fa fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        <!-- start edit -->
                                        <div class="modal fade" id="edit{{ $trip->id }}" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class=" modal-dialog modal-lg" role="document">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                            id="exampleModalLabel">
                                                            تعديل الرحلة
                                                        </h5>

                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- add_form -->
                                                        <form class=" row mb-30" action="{{ route('home.update', 'test') }}" method="POST">
                                                            {{ method_field('patch') }}
                                                            @csrf
                                                            <div class="card-body text-right">
                                                                <div class="repeater text-right">
                                                                        <div >
                                                                            <div class="row">

                                                                                <div class="col-4">
                                                                                    <label for="date" class="mr-sm-2">تاريخ الرحلة</label>
                                                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                                                           value="{{ $trip->id }}">
                                                                                    <input class="form-control" type="date" name="dateTrip" value="{{$trip->dateTrip}}" />
                                                                                </div>
                                                                                <div class="col-4">
                                                                                    <label for="from" class="mr-sm-2">من</label>
                                                                                    <input class="form-control" type="text" name="from" value="{{$trip->from}}" />
                                                                                </div>
                                                                                <div class="col-4">
                                                                                    <label for="to" class="mr-sm-2">الى</label>
                                                                                    <input class="form-control" type="text" name="to"  value="{{$trip->to}}"/>
                                                                                </div>
                                                                                <br><br>
                                                                                <div class="col-4">
                                                                                    <label for="driver_id" class="mr-sm-2">السائق</label>
                                                                                    <select class="fancyselect" name="driver_id">
                                                                                        <option value="{{ $trip->driver->id }}">{{ $trip->driver->name??'' }}</option>
                                                                                        @foreach ($drivers as $driver)
                                                                                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-4">
                                                                                    <label for="driver1_id" class="mr-sm-2">المرافق</label>
                                                                                    <select class="fancyselect" name="driver_id2">
                                                                                        <option value="{{ $trip->fDriver->id }}">{{ $trip->fDriver->name??'' }}</option>
                                                                                        @foreach ($drivers as $driver)
                                                                                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-4">
                                                                                    <label for="micro_id" class="mr-sm-2">الباص</label>
                                                                                    <select class="fancyselect" name="micro_id">
                                                                                        <option value="{{ $trip->micro->id }}">{{ $trip->micro->name??'' }}</option>
                                                                                        @foreach ($micros as $micro)
                                                                                            <option value="{{ $micro->id }}">{{ $micro->name }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <br><br>
                                                                                <div class="col-4">
                                                                                    <label for="feels" class="mr-sm-2">مصروف الرحلة</label>
                                                                                    <input class="form-control" type="number" name="feels" value="{{$trip->feels}}" />
                                                                                </div>
                                                                                <div class="col-4">
                                                                                    <label for="numPeople" class="mr-sm-2">عدد الركاب</label>
                                                                                    <input class="form-control" type="number" name="numPeople" value="{{$trip->numPeople}}" />
                                                                                </div>

                                                                                <div class="col-4">
                                                                                    <label for="notes" class="mr-sm-2">ملاحظة</label>
                                                                                    <input class="form-control" type="text" name="notes" value="{{$trip->notes}}" />
                                                                                </div>
                                                                                <br>
                                                                                <br>
                                                                                <br>
                                                                                <br>
                                                                                <br>

                                                                                <div class="modal-footer text-center">
                                                                                    <button type="submit" class="btn btn-success col-5 ">تعديل</button>
                                                                                    <button type="button" class="btn btn-secondary col-5" data-dismiss="modal">الغاء</button>
                                                                                </div>


                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                        </div>
                                        <!-- end edit -->

                                        <!-- start details -->
                                        <div class="modal fade" id="details{{ $trip->id }}" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class=" modal-dialog modal-lg" role="document">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                            id="exampleModalLabel">
                                                            تفاصيل الرحلة
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

                                                                            <div class="col-12 text-center">
                                                                                <label  class="mr-sm-2 fs-3 text-center">رقم الرحلة</label>
                                                                                <h2 class="bg-success rounded text-center">{{$trip->id}}</h2>
                                                                            </div>
                                                                            <div class="col-4 text-center">
                                                                                <label  class="mr-sm-2 fs-3 text-center">تاريخ الرحلة</label>
                                                                                <h2 class="bg-success rounded text-center">{{$trip->dateTrip}}</h2>
                                                                            </div>
                                                                            <div class="col-4 text-center">
                                                                                <label  class="mr-sm-2 fs-3 text-center">من</label>
                                                                                <h2 class="bg-success rounded text-center">{{$trip->from}} </h2>
                                                                            </div>
                                                                            <div class="col-4 text-center">
                                                                                <label  class="mr-sm-2 fs-3 text-center">الى</label>
                                                                                <h2 class="bg-success rounded text-center">{{$trip->to}}</h2>
                                                                            </div>
                                                                            <br><br>
                                                                            <div class="col-4 text-center">
                                                                                <label  class="mr-sm-2 fs-3 text-center">السائق</label>
                                                                                <h2 class="bg-success rounded text-center">{{$trip->driver->name??''}}</h2>
                                                                            </div>
                                                                            <div class="col-4 text-center">
                                                                                <label  class="mr-sm-2 fs-3 text-center">المرافق</label>
                                                                                <h2 class="bg-success rounded text-center">{{$trip->fDriver->name??'لا يوجد مرافق'}}</h2>
                                                                            </div>
                                                                            <div class="col-4 text-center">
                                                                                <label  class="mr-sm-2 fs-3 text-center">الباص</label>
                                                                                <h2 class="bg-success rounded text-center">{{$trip->micro->name??''}}</h2>
                                                                            </div>
                                                                            <br><br>
                                                                            <div class="col-3 text-center">
                                                                                <label  class="mr-sm-2 fs-3 text-center">المصروف</label>
                                                                                <h2 class="bg-success rounded text-center">{{$trip->feels??''}}</h2>
                                                                            </div>
                                                                            <div class="col-3 text-center">
                                                                                <label  class="mr-sm-2 fs-3 text-center">عدد الركاب</label>
                                                                                <h2 class="bg-success rounded text-center">{{$trip->numPeople??''}}</h2>
                                                                            </div>

                                                                            <div class="col-3 text-center">
                                                                                <label  class="mr-sm-2 fs-3 text-center"> الركاب الحاليين</label>
                                                                                <h2 class="bg-success rounded text-center">{{$trip->allOpTickets->count()}}</h2>
                                                                            </div>

                                                                            <div class="col-3 text-center">
                                                                                <label  class="mr-sm-2 fs-3 text-center">عدد الأمانات</label>
                                                                                <h2 class="bg-success rounded text-center">{{$trip->allOpTrustees->count()}}</h2>
                                                                            </div>

                                                                            <div class="col-6 text-center">
                                                                                <label  class="mr-sm-2 fs-3 text-center">عدد النساء</label>
                                                                                <h2 class="bg-success rounded text-center">{{$trip->numW->count()}}</h2>
                                                                            </div>
                                                                            <div class="col-6 text-center">
                                                                                <label  class="mr-sm-2 fs-3 text-center">عدد الرجال</label>
                                                                                <h2 class="bg-success rounded text-center">{{$trip->numM->count()}}</h2>
                                                                            </div>

                                                                            <div class="col-6 text-center">
                                                                                <label  class="mr-sm-2 fs-3 text-center"> المدفوع للأمانات </label>
                                                                                <h2 class="bg-success rounded text-center">{{$trip->allOpTrustees->sum('paid')}}</h2>
                                                                            </div>

                                                                            <div class="col-6 text-center">
                                                                                <label  class="mr-sm-2 fs-3 text-center"> الكامل للأمانات </label>
                                                                                <h2 class="bg-success rounded text-center">{{$trip->allOpTrustees->sum('price')}}</h2>
                                                                            </div>

                                                                            <div class="col-6 text-center">
                                                                                <label  class="mr-sm-2 fs-3 text-center">  المدفوع للركاب </label>
                                                                                <h2 class="bg-success rounded text-center">{{$trip->allOpTickets->sum('paid')}}</h2>
                                                                            </div>

                                                                            <div class="col-6 text-center">
                                                                                <label  class="mr-sm-2 fs-3 text-center"> الكامل للركاب </label>
                                                                                <h2 class="bg-success rounded text-center">{{$trip->allOpTickets->sum('priceTicket')}}</h2>
                                                                            </div>

                                                                            <div class="col-12 text-center">
                                                                                <label  class="mr-sm-2 fs-3 text-center"> الكامل للرحلة </label>
                                                                                <h2 class="bg-success rounded text-center">{{$trip->allOpTickets->sum('priceTicket') + $trip->allOpTrustees->sum('price')}}</h2>
                                                                            </div>

                                                                            <div class="col-12 text-center">
                                                                                <label  class="mr-sm-2 fs-3 text-center">ملاحظة</label>
                                                                                <h2 class="bg-success rounded text-center">@if(!empty($trip->notes)){{$trip->notes??''}}@else {{"لا يوجد ملاحظات"}} @endif</h2>
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

                                        <!-- start delete -->
                                        <div class="modal fade" id="delete{{ $trip->id }}" tabindex="-1" role="dialog"
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
                                                        <form action="{{ route('home.destroy', 'delete') }}" method="post">
                                                            {{ method_field('Delete') }}
                                                            @csrf
                                                            سيتم حذف الرحلة نهائيا
                                                            <input id="id" type="hidden" name="id" class="form-control"
                                                                   value="{{ $trip->id }}">
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

                <!-- start add_modal_class -->
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

                                <form class=" row mb-30" action="{{ route('home.store') }}" method="POST">
                                    @csrf
                                    <div class="card-body text-right">
                                        <div class="repeater text-right">
                                                <div >
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <label for="date" class="mr-sm-2">تاريخ الرحلة</label>
                                                            <input class="form-control" type="date" name="dateTrip"/>
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="from" class="mr-sm-2">من</label>
                                                            <input class="form-control" name="from" />
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="to" class="mr-sm-2">الى</label>
                                                            <input class="form-control" type="text" name="to" />
                                                        </div>
                                                        <br><br>
                                                        <div class="col-4">
                                                            <label for="driver_id" class="mr-sm-2">السائق</label>
                                                            <select class="fancyselect" name="driver_id">
                                                                @foreach ($drivers as $driver)
                                                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="driver1_id" class="mr-sm-2">المرافق</label>
                                                            <select class="fancyselect" name="driver_id2">
                                                                @foreach ($drivers as $driver)
                                                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="micro_id" class="mr-sm-2">الباص</label>
                                                            <select class="fancyselect" name="micro_id">
                                                                @foreach ($micros as $micro)
                                                                    <option value="{{ $micro->id }}">{{ $micro->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <br><br>
                                                        <div class="col-4">
                                                            <label for="feels" class="mr-sm-2">مصروف الرحلة</label>
                                                            <input class="form-control" type="number" name="feels" />
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="numPeople" class="mr-sm-2">عدد الركاب</label>
                                                            <input class="form-control" type="number" name="numPeople" />
                                                        </div>

                                                        <div class="col-4">
                                                            <label for="notes" class="mr-sm-2">ملاحظة</label>
                                                            <input class="form-control" type="text" name="notes" />
                                                        </div>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <br>

                                                        <div class="modal-footer text-center">
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


                <!-- end add_modal_class -->
                <!-- row closed -->
            @endsection
            @section('js')

                <script>

              $check = document.getElementById('now');

              $check.onchange = function () {
                  if($check.checked === true)
                  {
                      window.location.href = "/homes";
                  }
                  else
                      {
                          window.location.href = "/home";
                      }
              }

                </script>

            @endsection

        </div>
    </div>
</div>

@endsection
